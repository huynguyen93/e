<div class="row">
    <div class="col-md-4">
        <h3 class="text-center">Xếp hạng trong ngày<br><small>Cập nhật liên tục</small></h3>
        <table class="table table-hover table-striped" style="width: 100%">
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Username</th>
                <th class="text-center">số từ</th>
            </tr>
            <?php
            $number = 1;
            foreach($top_users_today as $user):
            ?>
            <tr class="<?php if($user->username == $_SESSION['user_nickname']) echo "info";?>">
                <td class="text-center"><?php echo $number++;?></td>
                <td class="text-center"><?=$user->username;?></td>
                <td class="text-center"><?=$user->recent_word_count;?></td>
            </tr>
            <?php
            endforeach;
            ?>
        </table>
    </div>
    
    <div class="col-md-4">
        <h3 class="text-center">Xếp hạng trong tuần<br><small>Cập nhật mỗi ngày</small></h3>
        <table class="table table-hover table-striped" style="width: 100%">
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Username</th>
                <th class="text-center">số từ</th>
            </tr>
            <?php
            $number = 1;
            foreach($top_users_this_week as $user => $word_count)
            {
            ?>
            <tr class="<?php if($user == $_SESSION['user_nickname']) echo "info";?>">
                <td class="text-center"><?php echo $number++;?></td>
                <td class="text-center"><?=$user;?></td>
                <td class="text-center"><?=$word_count;?></td>
            </tr>
            <?php
            }
            ?>
        </table>
    </div>
    
    <div class="col-md-4">
        <h3 class="text-center">Xếp hạng trong tháng<br><small>Cập nhật mỗi ngày</small></h3>
        <table class="table table-hover" style="width: 100%">
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Username</th>
                <th class="text-center">số từ</th>
            </tr>
            <?php
            $number = 1;
            foreach($top_users_this_month as $user => $word_count)
            {
            ?>
            <tr class="<?php if($user == $_SESSION['user_nickname']) echo "info";?>">
                <td class="text-center"><?php echo $number++;?></td>
                <td class="text-center"><?=$user;?></td>
                <td class="text-center"><?=$word_count;?></td>
            </tr>
            <?php
            }
            ?>
        </table>
        
    </div>
</div>