<div class="row">
    <div class="col-md-4">
        <h2>Reset password</h2>
        <?php echo form_open('user/reset_password/process'); ?>
            <div class="form-group">
                <label for="email">Your Email</label>
                <input type="email" name="email" class="form-control" value="<?php old_value('email');?>">
            </div>
            <div class="form-group">
                <input type="submit" name="submit_reset_password" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>