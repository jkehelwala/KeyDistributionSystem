<?php
/**
 * @author [NiroshJ]
 * @desc [view for specifically designed for making request 
 *      for machines.
 *      Called in dashboard.php]
*/
?>
<div class="col-xs-15">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title text-left">
                <i class="fa fa-envelope-open"></i> &nbsp;&nbsp; <?php echo "Select Machine and Key Type"; ?>
            </div>
        </div>
        <div class="panel-body">
            <div class="col-xs-15">
                <div class="col-xs-12 merge-block">
                    <label style="width:10%"> Machine</label>
                    <select name="cmbMachine" style="width:80%">
                        <option value="" disabled selected>Select</option>
                        <?php foreach ($macRequests as $machine) { ?>
                            <option value="<?php echo $machine->getId(); ?>" ><?php echo $machine->getMachineName();?></option>
                        <?php } ?>
                    </select>            
                </div>
                <div class="col-xs-12 merge-block">
                    <label style="width:10%">Key Type</label>
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

