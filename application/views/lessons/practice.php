<div class="article">
    
    <table class="lesson">
        <tr>
            <td colspan="3" style="padding-bottom:20px">
                <h3><?php echo $category->name; ?> - Lesson <?php echo $lesson->num." - ".$lesson->name; ?></h3>
                <p>
                    <?php if($lesson->num > 1){?>
                    <a href="<?php echo base_url("lessons/practice/".$category->slug."/".($lesson->num-1));?>" >Previous lesson</a>&nbsp;
                    <?php }?>
                    <?php if($lesson->num < $total_lessons){?>
                    <a href="<?php echo base_url("lessons/practice/".$category->slug."/".($lesson->num+1));?>">Next lesson</a>
                    <?php }?>
                </p>
            </td>
        </tr>
        <?php
        
        $answers = json_decode($lesson->answers);
        $stt = 0;
        foreach($answers as $answer)
        {
        ?>
        <tr>
            <td style="width: 25px" align="right"><?php echo 1+ $stt++; ?></td>
            <td>
                <button class="btn-listen" onclick="togglePlay(<?php echo $stt ?>);">Listen</button>
                <audio id="audio<?php echo $stt;?>">
                    <source src="<?php echo base_url("public/mp3/{$category->slug}/{$lesson->num}/{$stt}.mp3");?>">
                </audio>
            </td>
            <td height="50px;">
                <input class="answer" tabindex="<?php echo $stt;?>" onkeydown="doAction(event, <?php echo $stt;?>);">
                <p class="result" id="result<?php echo $stt;?>"><?php echo $answer;?></p>
            </td>
            <td><button class="btn-check" onclick="check(<?php echo $stt; ?>);">Check</button></td>
        </tr>
        <?php
        }
        ?>
        <tr>
            <td colspan="3">
            <p>
                <?php if($lesson->num > 1){?>
                <a href="<?php echo base_url("lessons/practice/".$category->slug."/".($lesson->num-1));?>" >Previous lesson</a>&nbsp;
                <?php }?>
                <?php if($lesson->num < $total_lessons){?>
                <a href="<?php echo base_url("lessons/practice/".$category->slug."/".($lesson->num+1));?>">Next lesson</a>
                <?php }?>
            </p>
            </td>
        </tr>
    </table>
    <?php $this->load->view('lessons/comment');//require_once("comment.php"); ?>
</div>

<script>
    function show_reply_form(id_parent_comment){
        var reply_form = '<li class="reply_form"><form method="post" action="<?php echo base_url("lessons/comment/{$lesson->id}");?>"><textarea placeholder="Write a reply..." style="width: 99%" rows="5" name="reply'+id_parent_comment+'"></textarea><input type="submit" name="submit_reply"></form></li>';
        var parent_comment = document.getElementById("comment"+id_parent_comment);
        var sub_comment = parent_comment.querySelector('ul');
        if(parent_comment.querySelector('.reply_form') == null){
            sub_comment.insertAdjacentHTML('beforeend',reply_form);
        }
        reply_form = document.getElementsByName("reply"+id_parent_comment)[0];
        reply_form.focus();
        return false;
    }
    
    function doAction(event, num){
        if(event.ctrlKey) togglePlay(num);
        
        var key = event.which || event.keyCode;
        if(key == 13) check(num);
    }
    
    function togglePlay(num){
        var audio = document.getElementById("audio"+num);
        return audio.paused ? audio.play() : audio.pause();
    }
    
    function check(num){
        var result = document.getElementById("result"+num);
        if(result.style.display != 'block') result.style.display = 'block';
         else result.style.display = 'none';
    }
</script>