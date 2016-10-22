<div class="row">
    <div class="col-md-12">
        <h1>Thống kê</h1>
        <hr>
        <?php if($user->stats == null) echo "Bạn chưa làm bài nào!" ?>
        
        <?php if($user->stats != null): ?>
        <table class="stats-table">
            <thead>
                <tr>
                    <th>Ngày</th>
                    <th colspan="2">Số từ</th>
                </tr>
            </thead>
            
            <tbody>
                <?php
                $stats = json_decode($user->stats, true);
                
                $max_word_count = 0;
                foreach($stats as $date=>$word_count){
                    if($word_count >= $max_word_count) $max_word_count = $word_count;
                }
                
                foreach($stats as $date=>$word_count):
                    $percent = $word_count/$max_word_count*100;
                ?>
                <tr>
                    <td class="date"><?php echo date('j M, Y', $date);?></td>
                    <td class="word-count"><b><?php echo $word_count;?></b></td>
                    <td>
                        <div class="progress">
                            <div class="progress-bar <?php echo (time() < $date + 60*60*24) ? "progress-bar-striped active" : "progress-bar-info progress-bar-striped"?>" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $percent; ?>%">
                            </div>
                        </div>
                    </td>
                </tr>
                <?php
                endforeach;
                ?>
            </tbody>
        </table>
        <?php endif;?>
    </div>
</div>