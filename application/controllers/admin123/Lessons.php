<?php
class Lessons extends MY_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('lesson_model');
        
        //get category list:
        $this->load->model('category_model');
        $cond['select'] = 'id, name';
        $this->data['categories'] = $this->category_model->get_list($cond);
    }
    
    function index(){        
        $cond = array();
        if(isset($_GET['cat_id']) && $_GET['cat_id'] > 0){
            $cond['where'] = "cat_id={$_GET['cat_id']}";
        }
        
        $lessons = $this->lesson_model->get_list($cond);
        
        $this->data['lessons'] = $lessons;
        $this->data['view'] = 'admin/lesson/index';
        $this->load->view("admin/index", $this->data);
    }
    
    function create(){
        if(isset($_POST['submit'])){
            $answers = $_POST['answers'];
            $answers = explode("\n", $answers);
            $filtered_answers = array();
            foreach($answers as $answer){
                $answer = trim($answer);
                $filtered_answers[] = $answer;
            }
//            echo "<pre>";
//            print_r($filtered_answers);
//            echo "</pre>";
            $filtered_answers = json_encode($filtered_answers);
            $data = array(
                'cat_id' => $_POST['cat_id'],
                'name' => trim($_POST['name']),
                'answers' => $filtered_answers,
                'num' => $_POST['num']
            );
            $this->lesson_model->create($data);
            $this->data['num'] = $_POST['num'] + 1;
        }
        
        $this->data['view'] = 'admin/lesson/create';
        $this->load->view("admin/index", $this->data);
    }
    
    function replace_words(){
        $words = array(
            'honour',
            'labour',
        );
    }
}