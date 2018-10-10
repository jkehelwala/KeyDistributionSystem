<div class="col-xs-12">
    <div class="col-xs-12 merge-block">
        <div class="col-xs-3 top"><i class="fa fa-desktop"></i></div>
        <div class="col-xs-9 bottom"><?php echo $keyReq->machine->machine_name; ?></div>
    </div>
    <div class="col-xs-12 merge-block">
        <div class="col-xs-3 top"><i class="fa fa-key"></i></div>
        <div class="col-xs-9 bottom"><?php echo $keyReq->key_type; ?></div>
    </div>
    <div class="col-xs-12 merge-block">
        <div class="col-xs-3 top"><i class="fa fa-gavel"></i></div>
        <div class="col-xs-9 bottom"><?php echo $keyReq->responding_admin->getUsername(); ?></div>
    </div>
    <div class="col-xs-12 merge-block">
        <div class="col-xs-3 top"><i class="fa fa-user"></i></div>
        <div class="col-xs-9 bottom"><?php echo $keyReq->requesting_user->getUsername(); ?></div>
    </div>
</div>