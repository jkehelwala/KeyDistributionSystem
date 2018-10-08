<?php
/**
 * Created by PhpStorm.
 * User: Janani
 * Date: 10/8/2018
 * Time: 3:00 PM
 */

include($_SERVER['DOCUMENT_ROOT'] . '/init/overhead.php');
$request_id = NULL;
if ($_GET) {
    if (!array_key_exists('id', $_GET))
        throw new Exception("Required variables not set");
    if ($_GET['id'])
        $request_id = $_GET['id'];
}
if ($request_id === NULL)
    throw new Exception("Required variables not set");

$keyReq = $user->getActions()->getAccessibleRequest($request_id);
$title = "Add Key";
?>
<?php include('../../init_html/header.php'); ?>
<section><h3><?php echo $user->getRoleName() ?> Dashboard</h3></section>
<section class="semi-top-padding">
    <div class="row">
        <div class="col-xs-3">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="panel-title">Request</div>
                </div>
                <div class="panel-body">
                    <div class="col-xs-12">
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
        </div>
        <div class="col-xs-9">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="panel-title">Add Key for Request</div>
                </div>
                <div class="panel-body">

                    <form action="/scripts/sysadmin/add_key.php?id=<?php echo $request_id ?>" method="post">
                        <div class="form-group">
                            <label for="key">Key</label>
                            <textarea class="form-control" name="key" rows="8" placeholder="Key Data"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="notes">Maintainer Notes</label>
                            <textarea class="form-control" name="note" rows="2"
                                      placeholder="Maintainer's Notes"></textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-lg btn-block btn-success" name="addkey" value="1" type="submit">Add
                                Key
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div> <!-- /.row -->
</section>
<!-- include footer -->
<?php include('../../init_html/footer.php'); ?>


