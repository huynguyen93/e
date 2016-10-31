<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="<?php echo base_url(); ?>" class="navbar-brand">
                FreeDictations
                <small>Best way to learn English</small>
            </a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="<?php if($this->uri->rsegment(1) == 'lessons') echo 'active';?>"><a href="<?php echo base_url('lessons');?>">Học</a></li>
                <li class="<?php if($this->uri->rsegment(1) == 'faq') echo 'active';?>"><a href="<?php echo base_url('faq'); ?>">Hướng dẫn</a></li>
                <li class="<?php if($this->uri->rsegment(1) == 'top') echo 'active';?>"><a href="<?php echo base_url('top'); ?>">Xếp hạng</a></li>
                <li class="<?php if($this->uri->rsegment(1) == 'blog') echo 'active';?>"><a href="<?php echo base_url('blog'); ?>">Blog</a></li>
                <li class="<?php if($this->uri->rsegment(1) == 'contact') echo 'active';?>"><a href="<?php echo base_url('contact'); ?>">Liên hệ</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
            <?php if(!isset($_SESSION['user_id'])){?>
                <li><a href="<?php echo base_url('user/login');?>">Đăng nhập</a></li>
                <li><a href="<?php echo base_url('user/register');?>">Đăng kí</a></li>
            <?php } else {?>
                <li class="">
                    <p class="user-info">Chào <b><?php echo $_SESSION['user_nickname'];?></b>, hôm nay bạn đã gõ <b><?php echo ($_SESSION['user_updated_at'] > strtotime(date('Y-m-d', time()))) ? $_SESSION['user_recent_word_count'] : 0;  ?></b> chữ!</p>
                </li>
                <li class="<?php if($this->uri->segment(1) == 'user') echo 'active';?>">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Tài khoản<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url('user/stats');?>">Thống kê</a></li>
                        <li><a href="<?php echo base_url('user/change_password');?>">Đổi mật khẩu</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="<?php echo base_url('user/logout');?>">Thoát</a></li>
                    </ul>
                </li>
            <?php }?>
            </ul>
        </div>
    </div>
</nav>