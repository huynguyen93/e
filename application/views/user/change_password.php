<div class="row">
    <div class="col-md-4">
        <h2>Change password</h2>
        <?php echo form_open('user/change_password/process'); ?>
            <div class="form-group">
                <label for="password">Old Password</label>
                <input type="password" name="old_password" class="form-control" value="<?php old_value('old_password');?>">
            </div>
        
            <div class="form-group">
                <label for="password">New Password</label>
                <input type="password" name="new_password" class="form-control" value="<?php old_value('new_password');?>">
            </div>
        
            <div class="form-group">
                <label for="password">Confirm New Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php old_value('confirm_password');?>">
            </div>
            <div class="form-group">
                <input type="submit" name="submit_change_password" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>