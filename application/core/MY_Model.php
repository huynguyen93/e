<?php
class MY_Model extends CI_Model{
    var $table = '';
    
    function get_list($cond = array()){
        if(isset($cond['select'])) $this->db->select($cond['select']);
        if(isset($cond['where'])) $this->db->where($cond['where']);
        
        $this->db->order_by('num', 'asc');
        $query = $this->db->get($this->table);
        return $query->result();
    }
    
    function get_total_rows($cond=array()){
        if(isset($cond['where'])) {
            $this->db->where($cond['where']);
            return $this->db->count_all_results($this->table);
        } else {
            return $this->db->count_all($this->table);
        }
        
    }
    
    function get_detail($cond=array()){
        if(isset($cond['select'])) $this->db->select($cond['select']);
        if(isset($cond['where'])) $this->db->where($cond['where']);
        $query = $this->db->get($this->table);
        if($query->num_rows()) return $query->row();
        return false;
    }
    
    function create($data){
        if($this->db->insert($this->table, $data)) return true;
        else return false;
    }
    
    function update($id, $data){
        
    }
}