<div class="col-xs-6">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title text-left">
                <i class="fa fa-envelope-open"></i> &nbsp;&nbsp; <?php echo "Machine $counter"; ?>
            </div>
        </div>
        <div class="panel-body">
            <div class="col-xs-12">
                <div class="col-xs-12 merge-block">
                    <div class="col-xs-3 top"><i class="fa fa-desktop"></i></div>
                    <div class="col-xs-9 bottom"><?php echo $machine->getMachineName(); ?></div>
                </div>
                <div class="col-xs-12 merge-block">
                    <div class="col-xs-3 top"><i class="fa fa-envelope-open"></i></div>
                    <div class="col-xs-9 bottom"><?php echo $machine->getId();; ?></div>
                </div>
                <div class="col-xs-12 merge-block">
                    <label>Select Key Type</label>
                    <select name="cmbKeyType" style="width:80%">
                        <option value="" disabled selected>Select</option>
                        <option value="UserAccount">User Account</option>
                        <option value="NewPublicKey">New Public Key</option> 
                        <option value="GuestPublicKey">Guest Public Key</option>      
                    </select>
                </div>
                <div class="col-xs-12 merge-block">
                    <input type="submit" value="Request" name="machineRequest">
                </div>
            </div>
        </div>
    </div>
</div>

