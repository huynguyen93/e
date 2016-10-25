<?php
class Top extends MY_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('user_model');
    }
    
    function index(){
        $today_timestamp = strtotime(date('Y-m-d', time()));
        $cond = array(
            'select' => 'username, recent_word_count',
            'where' => 'updated_at >'. $today_timestamp,
            'order' => array('recent_word_count', 'desc')
        );
        $top_users_today = $this->user_model->get_list($cond);
        
        
        
        $this_week_timestamp = strtotime('this week') - (time() - $today_timestamp);
        $cond = array(
            'select' => 'username, stats',
            'where' => 'updated_at >'. $this_week_timestamp
        );
        $all_users_this_week = $this->user_model->get_list($cond);
        $top_users_this_week = $this->sort_users_by_words($all_users_this_week, 7);
            
        $this_month_timestamp = strtotime(date('Y-m', time()));
        $cond = array(
            'select' => 'username, stats',
            'where' => 'updated_at >'. $this_month_timestamp
        );
        $all_users_this_month = $this->user_model->get_list($cond);
        $top_users_this_month = $this->sort_users_by_words($all_users_this_month, 30);
        
        $this->data['top_users_today'] = $top_users_today;
        $this->data['top_users_this_week'] = $top_users_this_week;
        $this->data['top_users_this_month'] = $top_users_this_month;
        $this->data['view'] = 'top';
        $this->load->view('layout', $this->data);
    }
    
    private function sort_users_by_words($user_list, $days){
        $result = array();
        foreach($user_list as $user){
            $total_words = 0;
            
            $records = json_decode($user->stats, true); reset($records);
            for($i=1; $i<=$days; $i++)
            {
                if(!key($records)) continue;
                $total_words += current($records);
                next($records);
            }
            $result[$user->username] = $total_words;
        }
        arsort($result);
        return $result;
    }
}