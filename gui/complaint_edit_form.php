<?php
use Entity\Complaint;
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create']) && $_POST['create'] == "update"){
    $err = 0;
    if(!isset($_POST['client'])){
        $err += 1;
        echo "Fill client";
    }else{
        $client = stripslashes($_POST['client']);
    }
    if(!isset($_POST['category'])){
        $err += 1;
        echo "Category ";
    }else{
        $category = stripslashes($_POST['category']);
    }
    if(!isset($_POST['title'])){
        $err += 1;
        echo "title";
    }else{
        $title = stripslashes($_POST['title']);
    }
    if(!isset($_POST['issue'])){
        $err += 1;
        echo "issue";
    }else{
        $issue = stripslashes($_POST['issue']);
    }
    if(!isset($_POST['date'])){
        $err += 1;
        echo "date";
    }else{
        $date = stripslashes($_POST['date']);
    }
    if(!isset($_POST['view'])){
        $err += 1;
        echo "view";
    }else{
        $view = stripslashes($_POST['view']);
    }

    if($err == 0){
        $com = new Complaint();
        $com->setId($id);
        $com->setClientId($client);
        $com->setCmpCat($category);
        $com->setCmpDate($date);
        $com->setCmpView($view);
        $com->setCmpTitle($title);
        $com->setCmpDesc($issue);
        $msgs = $com->updateComplaint();
    }else{
        $msgs = $err.": Please fill all fields!";
    }
}
?>
<div id="myModal2" class="span12">
    <form  action="" method="post">
        <div id="alerts-container">
            <?php if(!empty($msgs)){ ?>
                <div class="toast toasttext01">
                    <button type="button" class="close" data-dismiss="alert"></button>
                    <div class="toast-body">
                        <p><?php echo $msgs ?></p>
                    </div>
                </div>
            <?php } ?>
        </div>
        <fieldset>
            <legend>Edit Complaint</legend>
            <div class="row">
                <div class="span6">
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">Client</span>
                                <select type="text" name="client" required="">
                                    <?php
                                    while ($client = $em->fetch($clients)){ ?>
                                        <option value="<?php echo $client['id'] ?>"
                                            <?php
                                            if($client['id'] == $entity['client_id'])echo 'selected="selected"'
                                            ?>
                                            ><?php echo $client['client_last_name'].', '.
                                     $client['client_first_name']?></option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" value="update" name="create">
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">Category</span>
                                <select type="text" name="category" required="">
                                    <?php
                                    while ($cat = $em->fetch($cats)){ ?>
                                        <option <?php
                                        if($cat['cat_name'] == $entity['cmp_cat'])echo 'selected="selected"'
                                        ?>><?php echo $cat['cat_name'] ?></option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">Title</span>
                                <input type="text"  placeholder="e.g. Poor sanitation" name="title" required=""
                                       value="<?php echo $entity['cmp_title'] ?>" >
                            </div>
                        </div>
                    </div>
                    <input type="hidden" value="<?php echo $_SESSION['nonce'] ?>" name="nonce">
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">Issue</span>
                                <textarea class="textarea" name="issue" required=""
                                          "><?php echo $entity['cmp_desc'] ?> </textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on">Date</span>
                            <input type="text" id="dp3" data-date-format="yyyy/mm/dd" name="date"
                                   class="datepicker" data-provide="datepicker"
                                   value="<?php echo $entity['cmp_date'] ?>">
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on">Viewed</span>
                            <select type="text" name="view" required="">
                                    <option value="0" <?php
                                    if($entity['cmp_cat'] == 0)echo 'selected="selected"'?>>
                                    No</option>
                                <option value="1" <?php
                                if($entity['cmp_cat'] == 1)echo 'selected="selected"'?>>
                                    Yes</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="control-group">
                    <div class="controls">
                        <div class="control-group">
                            <button type="submit" class="btn btn-primary" id="register-submit-btn">Update</button>
                        </div>
                    </div>
                </div>
            </div>
</div>
</fieldset>
</form>
</div>