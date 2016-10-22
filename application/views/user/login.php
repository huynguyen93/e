<div class="row">
    <div class="col-sm-4">
        <h2>Login</h2>
        
        <?php echo form_open('user/login/process'); ?>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Enter your email" value="<?php old_value('email');?>">
            </div>
            <div class="form-group">
                <label for="email">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter your password">
            </div>
            <div class="form-group">
                <input type="checkbox" name="remember"> Remember me
            </div>
            <div>
                <input type="submit" name="submit_login" class="btn btn-primary" value="Login">
                <a href="<?php echo base_url('user/reset_password'); ?>">Forgot password?</a>
            </div>
        </form>
    
    </div>
</div>