<?php
class Home extends MY_Controller{
    function index(){
        $this->load->model('categories');
        $this->load->model('lessons');
        
        //get category list:
        $cond['select'] = 'id, name, slug';
        $cond['where'] = 'status=1';
        $categories = $this->categories->get_list($cond);
        
        //get lesson list and append to category list:
        $cond['select'] = 'id, slug, num';
        foreach($categories as $cat){
            $cond['where'] = 'status=1 AND cat_id='.$cat->id;
            $cat->lesson_list = $this->lessons->get_list($cond);   
        }
        
        $this->data['categories'] = $categories;
        $this->data['view'] = 'home/index';
        $this->load->view('layout', $this->data);
    }
    
    function practice(){
        if(!$this->uri->rsegment(4)) redirect(base_url());
        
        $this->load->model('categories');
        $cat_slug = $this->uri->rsegment(3);
        $cond = array();
        $cond['select'] = 'id, name, slug';
        $cond['where'] = "slug='$cat_slug'";
        $category = $this->categories->get_detail($cond);
        
        $lesson_num = $this->uri->rsegment(4);
        $this->load->model('lessons');
        $cond = array();
        $cond['where'] = "cat_id={$category->id}";
        $total_lessons = $this->lessons->get_total_rows($cond);
        
        $cond = array();
        $cond['select'] = 'id, cat_id, name, answers, num';
        $cond['where'] = 'status=1 AND num='.$lesson_num;
        $lesson = $this->lessons->get_detail($cond);
        if(!$lesson){
            $_SESSION['fail'] = '<p class="fail">The lesson is not available right now, please choose another lesson!</p>';
            redirect(base_url());
        }
        
        $this->data['category'] = $category;
        $this->data['total_lessons'] = $total_lessons;
        $this->data['lesson'] = $lesson;
        $this->data['view'] = 'home/practice';
        $this->load->view('layout', $this->data);
    }
}