<?php  include('../../init/overhead.php'); ?>
<?php
$title = "System Administrator Dashboard";
?>
<?php include('../../init_html/header.php'); ?>
    <section>
        <div class="row">
            <div class="col-xs-12">
                <h2><?php echo $user->getRoleName() ?> Dashboard</h2>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </section>
    <!-- include footer -->
<?php include('../../init_html/footer.php'); ?>