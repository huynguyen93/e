<table border="1" width="800">
    <thead>
        <th>ID</th>
        <th>Name</th>
        <th>Slug</th>
        <th>Order</th>
        <th>Status</th>
    </thead>
    <?php foreach($categories as $cat){?>
    <tr>
        <td><?php echo $cat->id;?></td>
        <td><?php echo $cat->name;?></td>
        <td><?php echo $cat->slug;?></td>
        <td><?php echo $cat->num;?></td>
        <td><?php echo $cat->status;?></td>
    </tr>
    <?php }?>
</table>
<?php print_r($categories);