<form method="post">
    <select name="cat_id" id="cat">
        <?php foreach($categories as $cat){?>
        <option value="<?php echo $cat->id;?>"><?php echo $cat->name;?></option>
        <?php }?>
    </select>
    <input type="text" name="name" placeholder="name" id="lesson_name">
    <input type="text" name="num" placeholder="order" id="lesson_num">
    <p><textarea name="answers" cols="90" rows="30" id="answers" oninput="check_lines();"></textarea></p>
    <button onclick="check_lines(); return false;">Check</button>
    <input type="submit" name="submit" onclick="return confirm('OK?');">
</form>
<div id="result">
    
</div>
<script>
    function check_lines(){
        var lesson_name = document.getElementById('cat').selectedOptions[0].text;
        var lesson_slug = toSlug(lesson_name);
        var lesson_num = document.getElementById('lesson_num').value;
        var sentence = ''
        var str = document.getElementById('answers').value;
        var arr = str.split(/\n/);
        for(i=0; i<arr.length;i++){
            j= i+1;
            sentence += '<p>'+j+'<audio controls><source src="http://localhost/e/public/mp3/'+lesson_slug+'/'+lesson_num+'/'+j+'.mp3"></audio>'+arr[i]+'</p></hr>';
            
        }
        var result = document.getElementById('result');
        result.innerHTML = sentence;
    }
    
    function toSlug(name){
        return name.toLowerCase().replace(/[^a-z0-9-]/g, ' ').replace(/  /g, '-').replace(/\s+/g, '-');
    }
</script>