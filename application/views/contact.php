<div class="row">
    <div class="col-md-6">
        <h1>Contact</h1>
        <?php echo form_open('contact/send_message');?>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" value="<?php if(isset($_SESSION['user_email'])) echo $_SESSION['user_email'] ?>">
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea name="message" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <input type="submit" name="send_email" class="btn btn-primary" value="Send">
            </div>
        </form>
    </div>
</div>