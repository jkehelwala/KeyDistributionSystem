<?php
/**
 * @author [NiroshJ]
 * @desc [specifically designed for showing keys
 *        Called in key_issued1.php]
*/
?>

<div class="col-xs-6">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title text-left">
                <i class="fa fa-envelope-open"></i> &nbsp;&nbsp; <?php echo "Req.ID: " . $mk->getRequestId(); ?>
            </div>
        </div>
        <div class="panel-body">
            <div class="col-xs-12">
                <div class="col-xs-12 merge-block">
                    <div class="col-xs-3 top"><i class="fa fa-desktop"></i></div>
                    <div class="col-xs-9 bottom"><?php echo $mac->getMachineName(); ?></div>
                </div>
                <div class="col-xs-12 merge-block">
                    <div class="col-xs-3 top"><i class="fa fa-key"></i></div>
                    <div class="col-xs-9 bottom"><?php echo $actualReq->getKeyType(); ?></div>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="col-xs-12 merge-block">
                    <div class="col-xs-12 top full title"><i class="fa fa-unlock"></i> &nbsp;&nbsp; <span
                                class="small"> Issued Key </span></div>
                    <div class="col-xs-12 bottom full"><?php echo $mk->getKey();  ?></div>
                </div>
            </div>
        </div>
    </div>
</div>

