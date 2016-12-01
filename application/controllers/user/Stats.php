<?php
class Stats extends MY_Controller{
    public function index(){
        $user = $this->user_model->get_single('id', $_SESSION['user_id']);
        
        $this->data['user'] = $user;
        $this->data['view'] = 'user/stats';
        $this->load->view('layout', $this->data);
    }
    
    public function update(){
        // when user want to update their status but forgot to login before doing the lesson:
        if(isset($_SESSION['post_data'])){
            foreach($_SESSION['post_data'] as $key => $val){
                $_POST[$key] = $val;
            }
            unset($_SESSION['post_data']);
        }
        
        //validation:
        if(!$this->input->post('save_progress_btn') || !$this->input->post('start_time') || !is_numeric($this->input->post('lesson_id')))
           redirect('user/stats');
        
        //get the lesson answers:
        $this->load->model('lesson_model');
        $lesson = $this->lesson_model->get_single('id', $this->input->post('lesson_id'));
        $lesson_answers = json_decode($lesson->answers, true);
        
        //compare user's answers with lesson answers and get the number of words typed by the user
        $user_answers = $this->input->post('answer');
        $answer_count = 0;
        $total_words = 0;
        for($i=0; $i<count($user_answers); $i++){
            if($user_answers[$i] == '') continue;
            
            $lesson_answers[$i] = explode("|", $lesson_answers[$i]);
            $lesson_answers[$i] = $lesson_answers[$i][0];
            
            $lesson_answers_length = count(explode(" ", $lesson_answers[$i]));
            $user_answers_length = count(explode(" ", $user_answers[$i]));
            
            //if user's answer is shorter or longer than lesson answer, don't count that answer
            if($lesson_answers_length != $user_answers_length) continue;
            
            $total_words += $lesson_answers_length;
            $answer_count ++;
        }
        //check if the user listen before typing:
        if($this->input->post('listen_count') < $answer_count-1) $total_words = 0;
        
        //check if the user copy and paste: (typing speed is higher than 60 words/60 seconds = 1 wps)
        $total_time = time() - $this->input->post('start_time');
        if($total_words / $total_time > 1) $total_words = 0;
        
        if($total_words == 0) {
            $this->session->set_flashdata('fail', 'Bạn làm lại nhé!');
            redirect($_SESSION['back']);
        }
        
        //get recent user's stats
        $user = $this->user_model->get_single('id', $_SESSION['user_id']);        
        
        if(is_null($user->stats)) $user_stats = array();
        else {
            $user_stats = json_decode($user->stats, true);
            if(count($user_stats) > 90) array_pop($user_stats);
        }
        
        //update user's stats
        $today_timestamp = strtotime(date('Y-m-d', time()));
        if(isset($user_stats[$today_timestamp])) $user_stats[$today_timestamp] += $total_words;
        else {
            $user_stats = array_reverse($user_stats, true);
            $user_stats[$today_timestamp] = $total_words;
            $user_stats = array_reverse($user_stats, true);
        }
        
        $cond = array(
            'set' => array('stats' => json_encode($user_stats), 'updated_at' => time(), 'recent_word_count' => $user_stats[$today_timestamp]),
            'where' => 'id='.$_SESSION['user_id']
        );
        if($this->user_model->update($cond)) {
            $this->session->set_flashdata('success', 'Cập nhật thành công!');
            $user = $this->user_model->get_single('id', $_SESSION['user_id']);
            $this->session->set_userdata('user_updated_at', $user->updated_at);
            $this->session->set_userdata('user_recent_word_count', $user->recent_word_count);
            redirect($_SESSION['next_lesson']);
        }
        else $this->session->set_flashdata('fail', 'Có lỗi xảy ra, bạn làm lại nhé!');
        
        redirect($_SESSION['back']);
    }
}