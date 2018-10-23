<?php
/**
 * @author [NiroshJ]
 * @desc [Dashboard of regular users where they can 
 *        make requests for machines]
*/
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/init/overhead.php'); ?>
<?php try { ?>
    <?php $user->authorizeView(UserRole::MachineUser); ?>
    <?php
    $title = "Developer Dashboard";
    $userAc = $user->getActions();
    $macRequests = $userAc->getMachines();
    $counter = 0;
    ?>
    <?php include($path . '/init_html/header.php'); ?>
    <section><h3><?php echo $user->getRoleName() ?> Dashboard</h3></section>
    <!--dash board row header-->   
    
    <!-- start showing machines to make request for -->
    <div class="col-xs-9">
        <div class="col-xs-12">
            <div class="col-xs-12 merge-block">
                <div class="col-xs-12 top full title text-left">
                    <i class="fa fa-key"></i> &nbsp;&nbsp; <?php echo "Request Keys"; ?>
                    <span class="badge pull-right"><?php echo ""; ?></span>
                </div>
                <div class="col-xs-12 bottom full">
                    <?php if(sizeof($macRequests) == 0){?>
                    <div class="col-xs-12 merge-block">
                        <div class="bottom">No Machines</div>
                    </div>
                    <?php } else { ?>
                        <form action=<?php echo "../../scripts/regular/machine_req_add.php"; ?> method="post">
                        <?php include('snip_request_key.php'); ?>
                        </form>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <!-- end showing machines to make request for -->

    <!-- strip menu -->
    <div class="col-xs-3">
        <?php include($path . '/users/regular/snip_menu.php'); ?>
    </div>


    <!-- include footer -->
    <?php include($path . '/init_html/footer.php'); ?>
    <?php
} catch (Exception $e) {
    $_SESSION['msg'] = new AlertMessage(true, $e);
    header('location: ' . $user->getLogout());
}
?>
