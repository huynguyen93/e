<?php
class Lessons extends MY_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('category_model');
        $this->load->model('lesson_model');
    }
    
    function index(){
        //get category list:
        $cond = array('where' => 'status=1');
        $categories = $this->category_model->get_list($cond);
        
        $_SESSION['back'] = current_url();
        $this->data['categories'] = $categories;
        $this->data['view'] = 'lessons/lesson_list';
        $this->load->view('layout', $this->data);
    }
    
    function practice(){
        if(!$this->uri->rsegment(4)) redirect(base_url());
        $this->load->helper('form');
        $lesson_num = $this->uri->rsegment(4);
        $cat_slug = $this->uri->rsegment(3);
        
        //get category info
        $category = $this->category_model->get_single('slug', $cat_slug);
        
        //get lesson info
        $cond = array('where' => 'cat_id='.$category->id.' AND num='.$lesson_num);
        $lesson = $this->lesson_model->get_detail($cond);
        if(!$lesson){
            $this->session->set_flashdata('fail', 'The lesson is not available right now, please choose another lesson!');
            redirect(base_url('lessons'));
        }
        
        $_SESSION['back'] = current_url();
        
        if($lesson->num < $category->total_lessons) $_SESSION['next_lesson'] = base_url($category->slug."/".($lesson->num+1));
        else $_SESSION['next_lesson'] = $_SESSION['back'];
        
        $this->data['category'] = $category;
        $this->data['lesson'] = $lesson;
        $this->data['view'] = 'lessons/practice';
        $this->load->view('layout', $this->data);
    }
}