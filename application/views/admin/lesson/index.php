<div class="row">
    <div class="col-md-12">
        <h1>Lessons</h1>
        <div class="row">
            <div class="col-md-3">
                <form method="get">
                    <div class="form-group">
                        <select name="cat_id" class="form-control" onchange="this.form.submit();">
                            <option value=0>All Categories</option>
                            <?php foreach($categories as $cat){?>
                            <option value="<?php echo $cat->id?>" <?php if(isset($_GET['cat_id']) && $_GET['cat_id'] == $cat->id) echo "selected";?>><?php echo $cat->name?></option>
                            <?php }?>
                        </select>
                    </div>
                </form>
            </div>
            <div class="col-md-3 col-md-offset-6">
                <a href="<?php echo admin_url('lessons/create'); ?>" class="btn btn-success btn-block">Create new lesson</a>
            </div>
        </div>
    <table class="table table-striped">
        <thead>
            <th>ID</th>
            <?php if(!isset($_GET['cat_id']) || $_GET['cat_id'] < 1) echo '<th>Category</th>' ?>
            <th>Name</th>
            <th>Order</th>
        </thead>
        <tbody>
            <?php foreach($lessons as $lesson){?>
            <tr>
                <td><?php echo $lesson->id;?></td>
                <?php 
                if(!isset($_GET['cat_id']) || $_GET['cat_id'] < 1){
                    $cat = $this->category_model->get_single('id', $lesson->cat_id);
                    echo '<td>'.$cat->name.'</td>';
                }
                ?>
                <td><?php echo $lesson->name;?></td>
                <td><?php echo $lesson->num;?></td>
            </tr>
            <?php }?>
        </tbody>
    </table>
    </div>
</div>