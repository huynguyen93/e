<p>Lần đầu đến đây? <a href="#">Xem hướng dẫn</a> rồi quay lại chọn các bài bên dưới để học hỉ!</p>
<?php
foreach($categories as $cat)
{
?>
<div class="article lesson-list">
    <h3><?php echo $cat->name;?></h3>
    <?php foreach($cat->lesson_list as $lesson){?>
    <a href="<?php echo base_url("lessons/practice/".$cat->slug."/".$lesson->num)?>"><?php echo $lesson->num;?></a>
    <?php }?>
</div>
<?php
}
?>