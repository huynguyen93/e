
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea#tinymce', menubar: false });</script>

<div class="row">
    <div class="col-md-8">
        <h1>Create new post</h1>
        
        <?php echo form_open(admin_url('blog/create')); ?>
            <div class="form-group">
                <label>Title:</label>
                <input type="text" name="title" id="title" class="form-control" onblur="ChangeToSlug()">
            </div>
            
            <div class="form-group">
                <label>Slug:</label>
                <input type="text" name="slug" id="slug" class="form-control">
            </div>
            
            <div class="form-group">
                <label>Intro:</label>
                <textarea name="intro" class="form-control"></textarea>
            </div>
            
            <div class="form-group">
                <label>Body:</label>
                <textarea name="body" class="form-control" id="tinymce"></textarea>
            </div>
            
            <div class="form-group">
                <input type="submit" name="add_post_btn" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>
<script src="<?php echo base_url('public/js/url_slug.js');?>"></script>
