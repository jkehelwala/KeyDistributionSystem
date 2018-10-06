<?php include($_SERVER['DOCUMENT_ROOT'] . '/init/overhead.php'); ?>
<?php
$title = "System Administrator Dashboard";
$userAd = new UserSysAdmin($user->getRole());
$requests = $userAd->getRequestsToProcess();
?>
<?php include('../../init_html/header.php'); ?>
    <section><h3><?php echo $user->getRoleName() ?> Dashboard</h3></section>
    <section class="semi-top-padding">
        <div class="row">
            <div class="col-xs-9">

                <?php foreach ($requests as $keyReq) { ?>

                    <!-- Starting Request Block-->
                    <div class="col-xs-4">
                        <div class="panel panel-primary">
                            <div class="panel-heading">New Key Request <span class="badge pull-right"><?php echo $keyReq->id; ?></span> </div>
                            <div class="panel-body">
                                <div class="col-xs-12">
                                    <table class="request-view">
                                        <tr>
                                            <td class="text-right"><span class="label label-danger">Machine</span>
                                            </td>
                                            <td><?php echo $keyReq->machine->machine_name; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-right"><span class="label label-primary">Key Type</span>
                                            </td>
                                            <td><?php echo $keyReq->key_type; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-right"><span class="label label-default">Approved By</span>
                                            </td>
                                            <td class="text-muted"><?php echo $keyReq->responding_admin->getUsername(); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-right"><span class="label label-default">Requested By</span>
                                            </td>
                                            <td class="text-muted"><?php echo $keyReq->requesting_user->getUsername(); ?></td>
                                        </tr>
                                    </table>
                                </div>

                            </div>
                            <div class="panel-footer text-center">
                                <a class="btn btn-success" href="#">Add Key</a>
                            </div>
                        </div>
                    </div>
                    <!-- Ending Request Block-->
                <?php } ?>

            </div>
            <div class="col-xs-3">

            </div>
        </div> <!-- /.row -->
    </section>
    <!-- include footer -->
<?php include('../../init_html/footer.php'); ?>