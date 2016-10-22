<?php
foreach($categories as $cat)
{
?>
<div class="text-justify">
    <h3><?php echo $cat->name;?></h3>
    <?php
    for($i=1; $i<$cat->total_lessons; $i++)
    {
    ?>
    <a href="<?php echo base_url("$cat->slug/$i")?>"><?php echo $i;?></a>
    <?php
    }
    ?>
</div>
<?php
}
?>