<form method="get">
    <select name="cat_id" onchange="this.form.submit();">
        <option value=0>All Categories</option>
        <?php foreach($categories as $cat){?>
        <option value="<?php echo $cat->id?>" <?php if(isset($_GET['cat_id']) && $_GET['cat_id'] == $cat->id) echo "selected";?>><?php echo $cat->name?></option>
        <?php }?>
    </select>
</form>
<table border="1" width="900">
    <thead>
        <th>ID</th>
        <?php if(!isset($_GET['cat_id']) || $_GET['cat_id'] < 1) echo '<th>Category</th>' ?>
        <th>Name</th>
        <th>Order</th>
        <th>Status</th>
    </thead>
    <tbody>
        <?php foreach($lessons as $lesson){?>
        <tr>
            <td><?php echo $lesson->id;?></td>
            <?php 
            if(!isset($_GET['cat_id']) || $_GET['cat_id'] < 1){
                $cond['id'] = $lesson->cat_id;
                $cat = $this->category_model->get_detail($cond['id']);
                echo '<td>'.$cat->name.'</td>';
            }
            ?>
            <td><?php echo $lesson->name;?></td>
            <td><?php echo $lesson->num;?></td>
            <td><?php if($lesson->status == 1) echo "active"; else echo "hidden";?></td>
        </tr>
        <?php }?>
    </tbody>
</table>
