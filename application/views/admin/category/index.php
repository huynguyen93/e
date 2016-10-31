<div class="row">
    
    <div class="col-md-9">
        <h1>Categories</h1>
        <table class="table table-bordered">
            <thead>
                <th>ID</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Order</th>
                <th>Status</th>
                <th>Action</th>
            </thead>
            <?php foreach($categories as $cat){?>
            <tr>
                <td><?php echo $cat->id;?></td>
                <td><?php echo $cat->name;?></td>
                <td><?php echo $cat->slug;?></td>
                <td><?php echo $cat->num;?></td>
                <td><?php echo $cat->status;?></td>
                <td><a href="#">Delete</a></td>
            </tr>
            <?php }?>
        </table>
    </div>
    
    <div class="col-md-3">
        <h1>Add new</h1>
        <?php echo form_open(admin_url('categories/create'), 'class="well"'); ?>
            <div class="form-group">
                <label>Category name:</label>
                <input type="text" name="name" class="form-control">
            </div>
            <div class="form-group">
                <label>Category slug:</label>
                <input type="text" name="slug" class="form-control">
            </div>
            <div class="form-group">
                <label>Order number:</label>
                <input type="text" name="num" class="form-control">
            </div>
            <div class="form-group">
                <p><b>Status</b></p>
                <label class="radio-inline">
                    <input type="radio" name="status" value="1" checked>Show
                </label>
                <label class="radio-inline">
                    <input type="radio" name="status" value="0">Hidden
                </label>
            </div>
            <div class="form-group">
                <input type="submit" name="add_new_cat_btn" class="btn btn-primary btn-block btn-lg">
            </div>
        </form>
    </div>
</div>