<?php
//@author:NiroshJ
 include($_SERVER['DOCUMENT_ROOT'] . '/init/overhead.php'); ?>
<?php try { ?>
    <?php $user->authorizeView(UserRole::MachineUser); ?>
    <?php
    $title = "Developer Dashboard";
    $userAc = $user->getActions();
    $issuedReq = $userAc->getKeyIssuedRequests();
    ?>
    <?php include($path . '/init_html/header.php'); ?>
    <section><h3><?php echo $user->getRoleName() ?> Dashboard</h3></section>
    <!--dash board row header-->   

    <div class="col-xs-9">
        <div class="col-xs-12">
            <div class="col-xs-12 merge-block">
                <div class="col-xs-12 top full title text-left">
                    <i class="fa fa-key"></i> &nbsp;&nbsp; <?php echo "Issued Keys"; ?>
                    <span class="badge pull-right"><?php echo ""; ?></span>
                </div>
                <div class="col-xs-12 bottom full">
                    <?php if(sizeof($issuedReq) == 0){?>
                    <div class="col-xs-12 merge-block">
                        <div class="bottom">No Issued Keys</div>
                    </div>
                    <?php } else { ?>
                    <?php foreach ($issuedReq as $req) { 
                        $m_name = $req[0];
                        $mk = $req[1];
                        include('snip_issued_key.php');
                    ?>
                    <?php }
                        } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-3">
        <?php include($path . '/users/regular/snip_menu.php'); ?>
    </div>
    <!-- include footer -->
    <?php include($path . '/init_html/footer.php'); ?>
    <?php
} catch (Exception $e) {
    echo $e;
    $_SESSION['msg'] = new AlertMessage(true, $e);
    //header('location: ' . $user->getLogout());
}
?>
