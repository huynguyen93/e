<h2>Login</h2>
<?php if(isset($_SESSION['message'])) {echo $_SESSION['message']; unset($_SESSION['message']);}?>
<?php if (validation_errors()) : ?>
<p><?php echo validation_errors();?></p>
<?php endif; ?>
<form method="post">
    <input type="email" name="email" class="form-input" placeholder="Email" value="<?php echo $_POST['email'] ?? ''; ?>">
    <input type="password" name="password" class="form-input" placeholder="Password">
    <input type="submit" name="submit_login" value="Login">
    <a href="">Forgot password?</a>
</form>