<form method="post">
    <select name="cat_id">
        <?php foreach($categories as $cat){?>
        <option value="<?php echo $cat->id;?>"><?php echo $cat->name;?></option>
        <?php }?>
    </select>
    <p><input type="text" name="name" placeholder="name"></p>
    <p><input type="text" name="num" placeholder="order"></p>
    <p><textarea name="answers" cols="90" rows="30" id="answers"></textarea></p>
    <button type="button" id="check" onclick="check_lines()">check</button>
    <input type="submit" name="submit">
</form>

<script>
    function check_lines(){
        var str = document.getElementById('answers').value;
        var arr = str.split(/\n/);
        for(i=0; i<arr.length; i++){
            console.log((i+1) + arr[i]);
        }
    }
</script>