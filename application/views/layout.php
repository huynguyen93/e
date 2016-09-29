<!DOCTYPE html>
<html>
<head>
	<title>English Dictations</title>
    <link rel="stylesheet" href="<?php echo base_url('public/css/style.css'); ?>">
</head>
<body>
<div class="container">
    <div class="header">
        <div class="brand">
            <h1>Free Dictations</h1>
            <p><i>Web luyện chép chính tả tiếng anh.</i></p>
        </div>
        <ul class="top-menu">
            <li><a href="<?php echo base_url();?>">Lessons</a></li>
            <li><a href="<?php echo base_url('faq');?>">Q&amp;A</a></li>
            <li><a href="#">Blog</a></li>
            <li><a href="#">Discussion</a></li>
            <p style="clear:left;" align="right">
            <?php if(!isset($_SESSION['username'])){?>
                <a href="<?php echo base_url('user/login');?>">Login</a>|<a href="<?php echo base_url('user/register');?>">Register</a>
            <?php } else {?>
                <a href="#"><?php echo $_SESSION['username'];?></a>
                <b><?php echo number_format("12345634234", 0, ',', '.') ?> words</b>
                <a href="<?php echo base_url('user/logout');?>">Logout</a>
            <?php }?>
            </p>
        </ul>
        
        
    </div>
    
    <div class="section">
        <?php if(isset($_SESSION['fail'])) {echo $_SESSION['fail']; unset($_SESSION['fail']);}?>
        <?php $this->load->view($view);?>
    </div>
</div>
<div class="footer">
</div>
</body>
</html>