<?php 
//@author:NiroshJ
include($_SERVER['DOCUMENT_ROOT'] . '/init/overhead.php'); ?>
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
    <div class="col-xs-3">
        <?php include($path . '/users/regular/snip_menu.php'); ?>
    </div>
    

    <?php /*?>
    <?php foreach ($macRequests as $machine) { ?>
        <form action=<?php echo "../../scripts/regular/machine_req_add.php?mid=" . $machine->getId(); ?> method="post">
        <section class="grid-container" style="background-color:white;">
            <div></div> 
                <div class="grid-item"> <?php echo $machine->getId(); ?> </div>
                <div class="grid-item"> <?php echo $machine->getMachineName();?> </div>
                <div class="grid-item"> 
                    <select name="cmbKeyType" style="width:80%">
                        <option value="" disabled selected>Select</option>
                        <option value="UserAccount">User Account</option>
                        <option value="NewPublicKey">New Public Key</option> 
                        <option value="GuestPublicKey">Guest Public Key</option>      
                    </select>
                </div>
                <div class="grid-item">
                    <!-- TODO: SCRIPT/ADDKEY   -->
                    <!-- TODO: ADD MACHINE PART -->
                    <input type="submit" value="Request" name="machineRequest">
                </div>
        </section>
        </form>
    <?php } ?>
    */ ?>
    
    <!-- include footer -->
    <?php include($path . '/init_html/footer.php'); ?>
    <?php
} catch (Exception $e) {
    $_SESSION['msg'] = new AlertMessage(true, $e);
    header('location: ' . $user->getLogout());
}
?>
