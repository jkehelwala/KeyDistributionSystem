<?php include('../../init/overhead.php'); ?>
<?php
$title = "System Administrator Dashboard";
?>
<?php include('../../init_html/header.php'); ?>
    <section><h3><?php echo $user->getRoleName() ?> Dashboard</h3></section>
    <section class="semi-top-padding">
        <div class="row">
            <div class="col-xs-12 col-sm-8">
                <div class="col-xs-12">
                    <div class="panel panel-primary">
                        <div class="panel-body bg-primary">
                            Panel content
                        </div>
                    </div>
                </div>
                <?php $userAd = new UserSysAdmin($user->getRole()) ?>
            </div>
            <div class="col-xs-12 col-sm-4">

            </div>
        </div> <!-- /.row -->
    </section>
    <!-- include footer -->
<?php include('../../init_html/footer.php'); ?>