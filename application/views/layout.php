<!DOCTYPE html>
<html>
    <head>
        <?php $this->load->view('partials/_head'); ?>
    </head>
    
    <body>
        <?php $this->load->view('partials/_nav'); ?>
        <div class="container">
            <?php $this->load->view('partials/_message');?>
            <?php $this->load->view($view);?>
        </div>
        <script id="dsq-count-scr" src="//freedictaions.disqus.com/count.js" async></script>
    </body>
</html>