<div class="row">
    <div class="col-md-4">
        
        <form class="form-inline">
            <b>Sort by:</b>
            <select name="sort_by" onchange="this.form.submit();" class="form-control input-sm">
                <option value="time">Time</option>
                <option value="popularity" <?php if(isset($_GET['sort_by']) && $_GET['sort_by'] == 'popularity') echo 'selected'; ?>>Popularity</option>
            </select>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-md-8 text-justify">
        <?php
        foreach($posts as $post)
        {
        ?>
        <h3>
            <a href="<?=base_url("blog/show_post/{$post->slug}")?>"><?=$post->title;?></a>
            <p>
                <small>Posted on <?=date('F j, Y', $post->date)?> - <?=$post->view_count?> views</small>
            </p>
        </h3>
        <p></p>
        <p><?=$post->intro?></p>
        <a href="<?=base_url("blog/show_post/{$post->slug}")?>">Read More</a>
        <hr>
        <?php
        }
        ?>
    </div>
</div>