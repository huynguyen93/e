<div class="row">
    <div class="col-md-12">
        <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>"><?php echo $category->name; ?></a></li>
                <li class="active"><b>Bài <?php echo $lesson->num." - ".$lesson->name; ?></b></li>
                <div class="next-prev">
                    <?php if($lesson->num > 1) { ?>
                    <a href="<?php echo base_url($category->slug."/".($lesson->num-1));?>" class="nav-link" style="margin-right: 10px;"><span aria-hidden="true">&laquo;</span> Bài trước</a>
                    <?php } ?>
                    <?php if($lesson->num < $category->total_lessons) { ?>
                    <a href="<?php echo base_url($category->slug."/".($lesson->num+1));?>" class="nav-link">Bài tiếp theo <span aria-hidden="true">&raquo;</span></a>
                    <?php }?>
                </div>
                <div id="quote"></div>
            </ol>
    <p class="text-warning">**Phím tắt: Ctrl+Space = Nghe. Enter = Hiện đáp án. Ctrl+Enter = Ẩn đáp án. Tab hoặc &darr;  = Xuống dòng. &uarr; = Lên dòng.</p>
    <?php echo form_open('user/stats/update', array('id' => 'lesson_form', 'autocomplete'=>"off", 'onkeydown'=>'prevent_submit_form(event);'));?>
        <input type="hidden" style="display:none" name="lesson_id" value="<?php echo $lesson->id; ?>">
        <input type="hidden" style="display:none" name="start_time" value="<?php echo time(); ?>">
        <input type="hidden" style="display:none" name="listen_count" id="listen_count" value="0">
    <table class="lesson">
        <?php
        $answers = json_decode($lesson->answers);
        $stt = 0;
        foreach($answers as $answer)
        {
        ?>
        <tr>
            <td style="width: 25px" align="right"><?php echo 1+ $stt++; ?></td>
            <td style="width: 25px">
                <button type="button" class="btn btn-sm btn-default btn-listen" onclick="play(<?php echo $stt ?>);">Listen</button>
                <audio id="audio<?php echo $stt;?>">
                    <source src="<?php echo base_url("public/mp3/{$category->slug}/{$lesson->num}/{$stt}.mp3");?>">
                </audio>
            </td>
            <td>
                <input name="answer[]" id="input<?php echo $stt;?>" class="user-answer form-control input-sm" tabindex="<?php echo $stt;?>" onkeydown="doAction(event, <?php echo $stt;?>);">
                <?php $answer = explode("|", $answer); ?>
                <p class="result" id="result<?php echo $stt;?>"></p>
                <p class="answer" id="answer<?php echo $stt;?>"><?php echo $answer[0];?></p>
                <p class="translation" id="translation<?php echo $stt;?>" style="display:none"><?php if(isset($answer[1])) echo $answer[1];?></p>
            </td>
            <td style="width: 25px">
                <button type="button" id="check_btn<?php echo $stt; ?>" class="btn btn-sm btn-default btn-check" onclick="check(<?php echo $stt; ?>);">Check</button>
            </td>
        </tr>
        <?php
        }
        ?>
        <tr>
            <td colspan="4"><input type="submit" name="save_progress_btn" id="save_progress_btn" class="btn btn-lg btn-block btn-success" value="Lưu thành tích"></td>
        </tr>
    </table>
    </form>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('lessons');?>"><?php echo $category->name; ?></a></li>
        <li class="active"><b>Bài <?php echo $lesson->num." - ".$lesson->name; ?></b></li>
        <li>
        <?php if($lesson->num > 1) { ?>
        <a href="<?php echo base_url($category->slug."/".($lesson->num-1));?>" class="nav-link" style="margin-right: 10px;"><span aria-hidden="true">&laquo;</span> Bài trước</a>
        <?php } ?>
        <?php 
        if($lesson->num < $category->total_lessons)
        {
        ?>
        <a href="<?php echo base_url($category->slug."/".($lesson->num+1));?>" class="nav-link">Bài tiếp theo <span aria-hidden="true">&raquo;</span></a>
        <?php 
        }
        ?>
        </li>
    </ol>


    <hr>
    <div id="comment-section">
        <h3>Thảo luận</h3>
        <div id="disqus_thread"></div>
<script>

/**
*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
/*
var disqus_config = function () {
this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
};
*/
    var disqus_config = function () {
        this.page.url = '<?php echo current_url(); ?>'
        this.page.identifier = '<?php echo $this->uri->rsegment('3').'/'.$this->uri->rsegment(4); ?>';
    };
(function() { // DON'T EDIT BELOW THIS LINE
var d = document, s = d.createElement('script');
s.src = '//freedictations.disqus.com/embed.js';
s.setAttribute('data-timestamp', +new Date());
    
(d.head || d.body).appendChild(s);
})();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
    </div>
</div>
</div>
<hr>

<script>
    $(document).ready(function(){
        $(".user-answer").focus(function(){
            $('html, body').animate({scrollTop: $(this).offset().top - 100});
        });
    });
    
    function prevent_submit_form(event){
        if (event.keyCode == 13) event.preventDefault();
    }
    
    function doAction(event, num){
        //keyCode: 13 => enter, 32 => Ctrl+Space, 38 => up arrow, 40 => down arrow. 
        if(event.ctrlKey && event.keyCode == 32) play(num);
        
        else if(event.ctrlKey && event.keyCode == 13)
            document.getElementById('result'+num).style.display = 'none';
            
        else if(event.keyCode == 13) check(num);
        
        else if(event.keyCode== 40 || event.keyCode==38) {
            var inputs = document.querySelectorAll('[tabindex]');
            var currentInputIndex = document.activeElement.getAttribute('tabindex');
            
            if(event.keyCode == 40) {
                var nextInput = inputs[currentInputIndex];
                if(nextInput == undefined) return false;
                nextInput.focus();
            } else {
                var previousInputIndex = parseInt(currentInputIndex)-2;
                var previousInput = inputs[previousInputIndex];
                if(previousInput == undefined) return false;
                previousInput.focus();
            }
        }
    }
    
    function play(num){
        var audios = document.getElementsByTagName('audio');
        var length = audios.length;
        var current_audio = document.getElementById("audio"+num);
        
        for(var i = 0; i < length; i++){
            if(audios[i] == current_audio) continue;
            else audios[i].pause();
        }
        
        current_audio.paused ? current_audio.play() : current_audio.pause();
        current_audio.currentTime = 0;
        
        var listen_count = parseInt(document.getElementById('listen_count').value);
        document.getElementById('listen_count').value = listen_count+1;
    }
    
    function check(num){
        var current_input = document.getElementById('input'+num);
        var answer = document.getElementById("answer"+num);
        
        result = answer.innerHTML.split(' ');
        input = current_input.value.trim().toLowerCase().replace(/[^\w\s-]*/g, '').replace(/  /g, ' ').split(" ");
        answer = answer.innerHTML.trim().toLowerCase().replace(/[^\w\s-]*/g, '').replace(/  /g, ' ').split(" ");
        
        var mistaken = false;
        for(i=0; i<result.length; i++){
            
            if(answer[i] != input[i]){
                result[i] = "<span class='wrong'>"+result[i]+"</span>";
                mistaken = true;
            }
        }
        
        if(input.length > answer.length) {
            result[result.length - 1] = "<span class='wrong'>"+result[result.length - 1]+"</span>";
            mistaken = true;
        }
        
        result = result.join(" ");
        
        document.getElementById("result"+num).innerHTML = result;
        result = document.getElementById("result"+num);
        
        if(mistaken){
            result.style.display = 'block';
        } else {
            var check_btn = document.getElementById('check_btn'+num);
            if (check_btn != null){
                check_btn.insertAdjacentHTML('afterend', '<b class="glyphicon glyphicon-ok text-success"></b>');
                check_btn.parentElement.removeChild(check_btn);
            }
            result.style.display = 'none';
            current_input.value = result.innerHTML;
        }
        document.getElementById('translation'+num).style.display = 'block';
    }
</script>