<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <title>FreeDictations <?php echo isset($title) ? $title : '' ; ?></title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!--<link rel="stylesheet" href="<?php echo base_url('public/css/bootstrap.min.css'); ?>">-->
        <link rel="stylesheet" href="<?php echo base_url('public/css/style.css'); ?>">

        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </head>
    
    <body>
        <div>
            <nav class="navbar navbar-default navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        </button>
                    </div>
                    <ul class="nav navbar-nav">
                        <li><a href="<?php echo admin_url('dashboard'); ?>">Dashboard</a></li>
                        <li><a href="<?php echo admin_url('categories'); ?>">Categories</a></li>
                        <li><a href="<?php echo admin_url('lessons'); ?>">Lessons</a></li>
                        <li><a href="<?php echo admin_url('blog'); ?>">Blog</a></li>
                        <li><a href="<?php echo admin_url('logout'); ?>">Logout</a></li>
                    </ul>
                </div>
            </nav>
            
            <div class="container">
            <?php $this->load->view('partials/_message');?>
            <?php $this->load->view($view);?>
            </div>
        </div>
    </body>
</html>