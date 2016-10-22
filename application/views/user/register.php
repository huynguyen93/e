<div class="row">
    <div class="col-sm-4">
        <h2>Register</h2>
        <?php if(isset($_SESSION['message'])){ echo $_SESSION['message']; unset($_SESSION['message']); } ?>

        <?php if (validation_errors()) echo "<p class='text-danger'>".validation_errors()."</p>" ?>

        <?php echo form_open('user/register/process'); ?>
        <div class="form-group">
            <label for="username">Nickname</label>
            <input type="text" name="username" placeholder="Enter your nickname" class="form-control" value="<?php old_value('username'); ?>">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" placeholder="Enter your email" class="form-control" value="<?php old_value('email'); ?>">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Enter a password" class="form-control" >
        </div>
        <div class="form-group">
            <label for="password_confirm">Confirm password</label>
            <input type="password" name="password_confirm" placeholder="Confirm your password" class="form-control">
        </div>
        <div class="form-group">
            <label for="captcha">Captcha</label>
            <img src="<?php echo base_url('captcha');?>" class="">
            <input type="text" name="captcha" placeholder="Enter the numbers above" class="form-control">
        </div>
        <div class="form-group">
            <input type="submit" name="submit_register" class="btn btn-primary" value="Register">
        </div>
        </form>
    </div>
</div>