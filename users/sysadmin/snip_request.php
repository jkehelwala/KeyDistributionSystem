<div class="col-xs-12">
    <div class="col-xs-12 merge-block">
        <div class="col-xs-3 top"><i class="fa fa-desktop"></i></div>
        <div class="col-xs-9 bottom"><?php echo $keyReq->getMachine()->getMachineName(); ?></div>
    </div>
    <div class="col-xs-12 merge-block">
        <div class="col-xs-3 top"><i class="fa fa-key"></i></div>
        <div class="col-xs-9 bottom"><?php echo $keyReq->getKeyType(); ?></div>
    </div>
    <div class="col-xs-12 merge-block">
        <div class="col-xs-3 top"><i class="fa fa-gavel"></i></div>
        <div class="col-xs-9 bottom"><?php echo $keyReq->getRespondingAdmin()->getUsername(); ?></div>
    </div>
    <div class="col-xs-12 merge-block">
        <div class="col-xs-3 top"><i class="fa fa-user"></i></div>
        <div class="col-xs-9 bottom"><?php echo $keyReq->getRequestingUser()->getUsername(); ?></div>
    </div>
</div>