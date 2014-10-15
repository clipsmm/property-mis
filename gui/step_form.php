<?php
use Entity\Address;
$em = $system->getDatabaseManager();
$counties = $em->getRawEntity('county');
$towns = $em->getRawEntity('towns');
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['source']) && $_POST['source'] == 0){
$system->redirect('property.php?wizard=step_2&address='.$_POST['address']);
}
?>
<div class="row">
    <div class="span12">
        <form action="" method="post">
            <fieldset>
                <input type="hidden" name="source" value="0">
                <div class="control-group">
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on">Town</span>
                            <select name="address" required="">
                                <?php while($add = $em->fetch($addresses)) { ?>
                                    <option value="<?php echo $add['id'] ?>">
                                        <?php
                                        echo
                                            $add['building'].", ".$add['street'].", ".$add['area'].", ".$add['town'].", ".$add['county'];

                                        ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="control-group">
                            <button type="submit" class="btn btn-primary" id="register-submit-btn">Next</button>
                        </div>
                        <div class="control-group">
                            <a class="btn btn-link" id="register-submit-btn" href="?wizard=step_1">Create Address</a>
                        </div>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>