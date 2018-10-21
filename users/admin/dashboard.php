<?php include($_SERVER['DOCUMENT_ROOT'] . '/init/overhead.php'); ?>
<?php try { ?>
    <?php $user->authorizeView(UserRole::Administrator); ?>
    <?php
    $title = "Administrator Dashboard";
    $userAc = $user->getActions();
    $requests = $userAc->getRequestsToProcess();       
    ?>
    <?php include($path . '/init_html/header.php'); ?>
    <section><h3><?php echo $user->getRoleName() ?> Dashboard</h3></section>
    <!--dash board row header-->    
    <section class="grid-container">
        <div class="grid-item-header"> Req.Id </div>
        <div class="grid-item-header"> UserName </div>
        <div class="grid-item-header"> Machine </div>
        <div class="grid-item-header"> KeyType </div>
        <div class="grid-item-header"> Status </div>
        <div class="grid-item-header"> Submit </div>             
    </section>

    <section class="grid-container">
    <?php foreach ($requests as $keyReq) { ?> 
        <div class="grid-item"> <?php echo $keyReq->getId(); ?> </div>
        <div class="grid-item"> <?php echo $keyReq->getRequestingUser()->getUsername();?> </div>
        <div class="grid-item"> <?php echo $keyReq->getMachine()->getMachineName();?> </div>
        <div class="grid-item"> <?php echo $keyReq->getKeyType();?> </div>
        <div class="grid-item"> 
            <select id="status" name="status">
                <option value="" disabled selected>Select</option>
                <option value="1">Approve</option>
                <option value="0">Reject</option> 
                <option value="null">Revoke</option>      
            </select>
        </div>
        <div class="grid-item"> 
            <!-- TODO: SCRIPT/ADDKEY   -->
            <!-- TODO: ADD MACHINE PART -->
            <input type="submit" value="Submit" name="submitkey">
            <?php  ?>
        </div>   
    <?php } ?>  
    </section>
    <!-- include footer -->
    <?php include($path . '/init_html/footer.php'); ?>
    <?php
} catch (Exception $e) {
    $_SESSION['msg'] = new AlertMessage(true, $e);
    header('location: ' . $user->getLogout());
}
?>
