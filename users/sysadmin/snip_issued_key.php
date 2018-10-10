<div class="col-xs-6">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title text-left">
                <i class="fa fa-envelope-open"></i> &nbsp;&nbsp; <?php echo $keyReq->id; ?>
            </div>
        </div>
        <div class="panel-body">
            <div class="col-xs-12">
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
            <div class="col-xs-12">
                <div class="col-xs-12 merge-block">
                    <div class="col-xs-12 top full title"><i class="fa fa-sticky-note"></i> &nbsp;&nbsp; <span class="small"> Maintenance Notes </span> </div>
                    <div class="col-xs-12 bottom full"><?php echo $issuedKey->notes;?></div>
                </div>
            </div>
        </div>
    </div>
</div>

