<div class="row">
    <div class="col-md-12">
        <?php echo form_open(admin_url('lessons/create'), 'class="row"') ?>
            <div class="col-md-3 form-group">
                <select name="cat_id" id="cat" class="form-control">
                    <?php foreach($categories as $cat){?>
                    <option value="<?php echo $cat->id;?>"><?php echo $cat->name;?></option>
                    <?php }?>
                </select>
            </div>
        
            <div class="col-md-3 form-group">
                <input type="text" name="name" placeholder="name" id="lesson_name" class="form-control">
            </div>
        
            <div class="col-md-3 form-group">
                <input type="text" name="num" placeholder="order" id="lesson_num" class="form-control">
            </div>
        <div class="row" style="clear:both; ">
            <div class="col-md-1" id="result" style="white-space: nowrap; text-align: right; margin-top: 5px; padding-right:0;">
            </div>
            <div class="col-md-11" class="form-group">
                <textarea name="answers" rows="40" id="answers" oninput="check_lines();" class="form-control"></textarea>
            </div>
        </div>
            
        
            <div class="col-md-12 form-group">
                <button onclick="check_lines(); return false;">Check</button>
                <input type="submit" name="submit" onclick="return confirm('OK?');">
            </div>
        </form>
        
    </div>
</div>    


<script>
    function check_lines(){
        var lesson_name = document.getElementById('cat').selectedOptions[0].text;
        var lesson_slug = toSlug(lesson_name);
        var lesson_num = document.getElementById('lesson_num').value;
        var sentence = ''
        var str = document.getElementById('answers').value;
        var arr = str.split(/\n/);
        
        for(i=0; i<=arr.length;i++){
            j= i+1;
            sentence += '<p style="margin: 0;">'+j+' <a href="#" onclick="play(event,'+j+');">play</a> <audio controls id="audio'+j+'" style="display:none"><source src="http://localhost/e/public/mp3/'+lesson_slug+'/'+lesson_num+'/'+j+'.mp3"></audio></p></hr>';

        }
        var result = document.getElementById('result');
        result.innerHTML = sentence;
        document.getElementById('lesson_name').value = arr[0];
        document.getElementById('answers').setAttribute('rows', arr.length+2);
    }
    
    function play(event, num){
        event.preventDefault();
        var audio = document.getElementById("audio"+num);
        audio.paused ? audio.play() : audio.pause();
        audio.currentTime = 0;
    }
    
    function update_line(){
        var lines = document.getElementsByClassName('lines');
        var answers = '';
        for(i=0; i<lines.length; i++){
            answers += lines[i].value + '\n';
        }
        document.getElementById('answers').value = answers;
    }
    
    function toSlug(name){
        return name.toLowerCase().replace(/[^a-z0-9-]/g, ' ').replace(/  /g, '-').replace(/\s+/g, '-');
    }
</script>