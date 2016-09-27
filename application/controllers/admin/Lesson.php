<?php
class Lesson extends MY_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('lessons');
        
        //get category list:
        $this->load->model('categories');
        $cond['select'] = 'id, name';
        $this->data['categories'] = $this->categories->get_list($cond);
    }
    
    function index(){        
        $cond = array();
        if(isset($_GET['cat_id']) && $_GET['cat_id'] > 0){
            $cond['where'] = "cat_id={$_GET['cat_id']}";
        }
        
        $lessons = $this->lessons->get_list($cond);
        
        $this->data['lessons'] = $lessons;
        $this->data['view'] = 'admin/lesson/index';
        $this->load->view("admin/index", $this->data);
    }
    
    function create(){
        if(isset($_POST['submit'])){
//            $answers = $this->db->escape_str($_POST['answers']);
            $answers = $_POST['answers'];
            $answers = explode("\n", $answers);
            $filtered_answers = array();
            foreach($answers as $answer){
                $answer = trim($answer);
                $filtered_answers[] = $answer;
            }
            echo "<pre>";
            print_r($filtered_answers);
            $filtered_answers = json_encode($filtered_answers);
//            die($filtered_answers);
            $data = array(
                'cat_id' => $_POST['cat_id'],
                'name' => $this->db->escape_str($_POST['name']),
                'answers' => $filtered_answers,
                'num' => $_POST['num']
            );
            $this->lessons->create($data);
        }
        
        $this->data['view'] = 'admin/lesson/create';
        $this->load->view("admin/index", $this->data);
    }
}