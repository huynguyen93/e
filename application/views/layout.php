<!DOCTYPE html>
<html>
<head>
	<title>English Dictations</title>
    <link rel="stylesheet" href="<?php echo base_url('public/css/style.css'); ?>">
</head>
<body>

<div class="container">
    <div class="header">
        <h1 class="brand">Free Dictations</h1>
        <ul class="top-menu">
            <li><a href="<?php echo base_url();?>">Practice</a></li>
            <li><a href="#">Q&amp;A</a></li>
            <li><a href="#">Blog</a></li>
            <li><a href="#">Discussion</a></li>
        </ul>
    </div>
    
    <div class="section">
        <?php if(isset($_SESSION['fail'])) {echo $_SESSION['fail']; unset($_SESSION['fail']);}?>
        <?php $this->load->view($view);?>
    </div>
</div>

</body>
</html>