<?php include($_SERVER['DOCUMENT_ROOT'] . '/init/overhead.php'); ?>
<?php
$title = "System Administrator Dashboard";
$userAc = $user->getActions();
$requests = $userAc->getRequestsToProcess();
?>
<?php include($path .'/init_html/header.php'); ?>
    <section><h3><?php echo $user->getRoleName() ?> Dashboard</h3></section>
    <section class="semi-top-padding">
        <div class="row">
            <div class="col-xs-9">
                <?php foreach ($requests as $keyReq) { ?>
                    <div class="col-xs-4">
                        <!-- Starting Request Block-->
                        <div class="panel panel-primary">
                            <div class="panel-heading"><span class="panel-title">New Key Request</span>
                                <span class="badge pull-right"><?php echo $keyReq->id; ?></span></div>
                            <div class="panel-body">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-xs-12 merge-block">
                                            <div class="col-xs-12 top"><i class="fa fa-desktop"></i></div>
                                            <div class="col-xs-12 bottom"><?php echo $keyReq->machine->machine_name; ?></div>
                                        </div>
                                        <div class="col-xs-12 merge-block">
                                            <div class="col-xs-12 top"><i class="fa fa-key"></i></div>
                                            <div class="col-xs-12 bottom"><?php echo $keyReq->key_type; ?></div>
                                        </div>
                                        <div class="col-xs-6 merge-block">
                                            <div class="col-xs-12 top"><i class="fa fa-gavel"></i></div>
                                            <div
                                                    class="col-xs-12 bottom"><?php echo $keyReq->responding_admin->getUsername(); ?></div>
                                        </div>
                                        <div class="col-xs-6 merge-block">
                                            <div class="col-xs-12 top"><i class="fa fa-user"></i></div>
                                            <div
                                                    class="col-xs-12 bottom"><?php echo $keyReq->requesting_user->getUsername(); ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer text-right">
                                <a class="btn btn-success "
                                   href="/users/sysadmin/add_key.php?id=<?php echo $keyReq->id; ?>">Add Key</a>
                            </div>
                        </div>
                    </div>
                    <!-- Ending Request Block-->


                <?php } ?>

            </div>
            <div class="col-xs-3">
                <?php include($path .'/users/sysadmin/snip_menu.php'); ?>
            </div>
        </div> <!-- /.row -->
    </section>
    <!-- include footer -->
<?php include('../../init_html/footer.php'); ?>