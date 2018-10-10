<?php include($_SERVER['DOCUMENT_ROOT'] . '/init/overhead.php'); ?>
<?php $user->authorizeView(UserRole::SysAdmin) ;?>
<?php
$title = "System Administrator Dashboard";
$userAc = $user->getActions();
$machines = $userAc->getAuthorizedMachines();
?>
<?php include($path . '/init_html/header.php'); ?>
    <section><h3><?php echo $user->getRoleName() ?> Actions</h3></section>
    <section class="semi-top-padding">
        <div class="row">
            <div class="col-xs-9">
                <?php foreach ($machines as $machine) { ?>
                    <div class="col-xs-12">
                        <!-- Starting Machine Block-->
                        <div class="col-xs-12 merge-block">
                            <div class="col-xs-12 top full title text-left">
                                <i class="fa fa-desktop"></i> &nbsp;&nbsp; <?php echo $machine->machine_name; ?>
                                <span class="badge pull-right"><?php echo $machine->id; ?></span>
                            </div>
                            <div class="col-xs-12 bottom full">
                                <?php $requests = $machine->getKeyIssuedRequests() ?>
                                <?php if (count($requests) == 0) { ?>
                                    <div class="col-xs-12 merge-block">
                                        <div class="bottom">No Issued Keys</div>
                                    </div>
                                <?php } else { ?>
                                    <?php foreach ($requests as $keyReq) { ?>
                                        <?php $issuedKey = $keyReq->getIssuedKey(); ?>
                                        <?php include($path . '/users/sysadmin/snip_issued_key.php'); ?>
                                    <?php } ?>
                                <?php } // End if  ?>
                            </div>
                        </div>
                    </div>
                    <!-- Ending Machine Block-->
                <?php } ?>
            </div>
            <div class="col-xs-3">
                <?php include($path . '/users/sysadmin/snip_menu.php'); ?>
            </div>
        </div> <!-- /.row -->
    </section>
    <!-- include footer -->
<?php include($path . '/init_html/footer.php'); ?>