<?php include($_SERVER['DOCUMENT_ROOT'] . '/init/overhead.php'); ?>
<?php try { ?>
    <?php $user->authorizeView(UserRole::SysAdmin); ?>
    <?php
    $title = "System Administrator Dashboard";
    $userAc = $user->getActions();
    $requests = $userAc->getRequestsToProcess();
    ?>
    <?php include($path . '/init_html/header.php'); ?>
    <section><h3><?php echo $user->getRoleName() ?> Dashboard</h3></section>
    <section class="semi-top-padding">
        <div class="row">
            <div class="col-xs-9">
                <?php foreach ($requests as $keyReq) { ?>
                    <div class="col-xs-4">
                        <!-- Starting Request Block-->
                        <div class="panel panel-primary">
                            <div class="panel-heading"><span class="panel-title"><i class="fa fa-envelope"></i> &nbsp;&nbsp; Key Request</span>
                                <span class="badge pull-right"><?php echo $keyReq->getId(); ?></span></div>
                            <div class="panel-body">
                                <div class="row">
                                    <?php include($path . '/users/sysadmin/snip_request.php'); ?>
                                </div>
                            </div>
                            <div class="panel-footer text-right">
                                <a class="btn btn-success "
                                   href="/users/sysadmin/add_key.php?id=<?php echo $keyReq->getId(); ?>">Add Key</a>
                            </div>
                        </div>
                    </div>
                    <!-- Ending Request Block-->
                <?php } ?>
            </div>
            <div class="col-xs-3">
                <?php include($path . '/users/sysadmin/snip_menu.php'); ?>
            </div>
        </div> <!-- /.row -->
    </section>
    <!-- include footer -->
    <?php include($path . '/init_html/footer.php'); ?>
    <?php
} catch (Exception $e) {
    $_SESSION['msg'] = new AlertMessage(true, $e);
    header('location: ' . $user->getLogout());
}
?>
