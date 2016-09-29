<h2>Register</h2>

<?php
if(isset($_SESSION['message'])){
    echo $_SESSION['message'];
    unset($_SESSION['message']);
}
?>

<?php if (validation_errors()) : ?>
<p><?php echo validation_errors();?></p>
<?php endif; ?>

<?php echo form_open('user/register'); ?>
    <input type="text" name="username" placeholder="Enter a username" class="form-input" value="<?php echo $_POST['username'] ?? ''; ?>">
    <input type="email" name="email" placeholder="Enter your email" class="form-input" value="<?php echo $_POST['email'] ?? ''; ?>">
    <input type="password" name="password" placeholder="Enter a password" class="form-input" >
    <input type="password" name="password_confirm" placeholder="Confirm your password" class="form-input">
    <img src="<?php echo base_url('user/get_captcha');?>" class="form-input">
    <input type="text" name="captcha" placeholder="Enter the numbers above" class="form-input">
    <input type="submit" name="submit_register" value="Register">
</form>