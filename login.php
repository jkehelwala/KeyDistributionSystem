<?php
include($_SERVER['DOCUMENT_ROOT'].'/init/overhead.php');
$title = 'Login';  // page title
?>
<!---------------------------------------- Header Start, Do not touch ----------------------------------------- -->
    <?php include('init_html/header.php'); ?>
    <!---------------------------------------- Add Page Edits Below ----------------------------------------------- -->
    <section class="top-padding"></section>
    <section id="login">
        <div class="row">
            <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-md-6 col-md-offset-3">
                <div class="form-wrap">
                    <h1>Log in</h1>
                    <form role="form" action="/scripts/login.php" method="post" autocomplete="off">
                        <div class="form-group">
                            <label for="email" class="sr-only">Username</label>
                            <input type="text" name="uname" class="form-control" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label for="key" class="sr-only">Password</label>
                            <input type="password" name="pass" class="form-control"
                                   placeholder="Password">
                        </div>

                        <input type="submit" id="btn-login" class="btn btn-success btn-lg btn-block" value="Log in">
                    </form>
                    <hr>
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </section>
    <!-- include footer -->
    <!---------------------------------------- End of page edits ---------------------------------------------------->
<?php include('init_html/footer.php'); 