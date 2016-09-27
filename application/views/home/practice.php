<div class="article">
<table class="lesson">
    <tr>
        <td></td>
        <td colspan="2" style="padding-bottom:20px">
            <h3><?php echo $category->name; ?> - Lesson <?php echo $lesson->num." - ".$lesson->name; ?></h3>
            <p>
                <?php if($lesson->num > 1){?>
                <a href="<?php echo base_url("practice/".$category->slug."/".($lesson->num-1));?>" >Previous lesson</a>&nbsp;
                <?php }?>
                <?php if($lesson->num < $total_lessons){?>
                <a href="<?php echo base_url("practice/".$category->slug."/".($lesson->num+1));?>">Next lesson</a>
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
            <button style="margin: 0 5px;" onclick="togglePlay(<?php echo $stt ?>);">Listen</button>
            <audio id="audio<?php echo $stt;?>">
                <source src="<?php echo base_url("public/mp3/{$lesson->cat_id}/{$lesson->num}/{$stt}.mp3");?>">
            </audio>
        </td>
        <td height="50px;">
            <input class="answer" tabindex="<?php echo $stt;?>" onkeydown="doAction(event, <?php echo $stt;?>);">
            <p class="result" id="result<?php echo $stt;?>"><?php echo $answer;?></p>
        </td>
        <td><button style="margin: 0 5px;" onclick="check(<?php echo $stt; ?>);">Check</button></td>
    </tr>
    <?php
    }
    ?>
    <tr>
        <td></td>
        <td colspan="2">
        <p>
            <?php if($lesson->num > 1){?>
            <a href="<?php echo base_url("practice/".$category->slug."/".($lesson->num-1));?>" >Previous lesson</a>&nbsp;
            <?php }?>
            <?php if($lesson->num < $total_lessons){?>
            <a href="<?php echo base_url("practice/".$category->slug."/".($lesson->num+1));?>">Next lesson</a>
            <?php }?>
        </p>
        </td>
    </tr>
</table>
</div>

<script>
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