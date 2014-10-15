<div class="span12">

    
    <div class="row">
        <div class="span12">
            <form action=""  method="post" id="frmTable">
                <input type="hidden" name="delete" value="delete">
                <table class="table table-condensed table-hover">
                    <thead>
                    <tr>
                        <th class="span1"></th>
                        <th class="span2">Name</th>
                        <th class="span2">Type</th>
                        <th class="span2">Owner</th>
                        <th class="span2">Units</th>
                        <th class="span2">Size(SqrMtr)</th>
                        <th class="span2">Rent/Unit (Kshs)</th>
                        <th class="span2">Sale (Kshs)</th>
                        <th class="span2">Sold?</th>
                        <th></th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $em = $system->getDatabaseManager();
                    $entities = $em->getRawEntity('property');
                    if (isset($_GET['term']) && !empty($_GET['term'])){
                                $term = $_GET['term'];
                                $entities = $em->searchEntity($page,$term);
                            }

                            if (!$entities || $entities == false){
                                echo '
                                    <tr>
                                    <td colspan="4"><b>No records found</b></td>
                                    </tr>
                                ';
                            }else{
                    while($entity = $em->fetch($entities)){ ?>
                        <tr>
                            <td class="align-center">
                                <label class="checkbox">
                                    <input name="data[]" value="<?php echo $entity['id'] ?>" type="checkbox"><span class="metro-checkbox"></span>
                                </label>
                            </td>
                            <td class="span2"><?php echo $entity['prop_name']?></td>
                            <td class="span2"><?php echo $entity['type_id']?></td>
                            <td class="span2"><?php echo $entity['client_id']?></td>
                            <td class="span2"><?php echo $entity['prop_rooms']?></td>
                            <td class="span2"><?php echo $entity['prop_area']?></td>
                            <td class="span2"><?php echo $entity['rent_price']?></td>
                            <td class="span2"><?php echo $entity['sale_price']?></td>
                            <td class="span2"><?php echo YesNo($entity['prop_status'])?></td>
                            <td class="span2"><a class="btn btn-primary"
                                                 href="edit.php?table=property&id=<?php echo $entity['id'] ?>">
                                    <i class="icon icon-pencil"></i></a> </td>
                        </tr>
                    <?php }
                }
                    ?>


                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>