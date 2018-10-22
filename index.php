<?php
include($_SERVER['DOCUMENT_ROOT'] . '/init/overhead.php');
// Redirect Logged in User
if ($user->isLoggedIn()) {
    header('location: ' . $user->getDashboardLink());
    exit();
}


$title = 'Key Distribution'; //define page title
?>
    <!-- include header -->
<?php include('init_html/header.php'); ?>

    <section class="top-padding"></section>
    <section>
        <div class="row">
            <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-md-6 col-md-offset-3">
                <h1 class="text-center">Key Distribution System</h1>
                <h3 class="text-center">Welcome!</h3>
                <div class="col-xs-12 col-sm-6 col-sm-offset-3">
                    <a class="btn btn-lg btn-success btn-block" href="/login.php">Log in</a>
                </div>
                <div class="col-xs-12 col-sm-6 col-sm-offset-3">
                    <a class="btn btn-lg btn-success btn-block" style="margin-top:10px;" href="/register.php">Register</a>
                </div>

            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </section>
    <!-- include footer -->
<?php include('init_html/footer.php'); ?>
