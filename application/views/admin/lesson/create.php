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
                <input type="text" name="num" placeholder="order" id="lesson_num" value="<?php echo isset($num) ? $num : ''; ?>" class="form-control">
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
                <button type="button" onclick="sort_lines(); return false;">Sort</button>
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
        var audios = document.getElementsByTagName('audio');
        var length = audios.length;
        var current_audio = document.getElementById("audio"+num);
        
        for(var i = 0; i < length; i++){
            if(audios[i] == current_audio) continue;
            else audios[i].pause();
        }
        
        current_audio.paused ? current_audio.play() : current_audio.pause();
        current_audio.currentTime = 0;
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
    
    function sort_lines(){
        var lines = document.getElementById('answers').value;
        lines = lines.replace('/\n/', '.').replace(/\,"/g, '",').replace(/\."/g, '".').replace(/\n/g, '');
        lines = lines.split('.');
        for(i=0; i<lines.length; i++){
            lines[i] = lines[i].trim();
        }
        lines = lines.join('.').replace(/\./g, '.\n');
        document.getElementById('answers').value = lines;
    }
</script>