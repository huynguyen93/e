<?php
class MY_Model extends CI_Model{
    var $table = '';
    
    function get_list($cond = array()){
        if(isset($cond['select'])) $this->db->select($cond['select']);
        if(isset($cond['where'])) $this->db->where($cond['where']);
        if(isset($cond['order'][0]) && isset($cond['order'][1])) $this->db->order_by($cond['order'][0], $cond['order'][1]);
        if(isset($cond['limit'][0]) && isset($cond['limit'][1])) $this->db->limit($cond['limit'][0], $cond['limit'][1]);
        
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
    
    function get_single($column, $value){
        if(isset($cond['select'])) $this->db->select($cond['select']);
        $query = $this->db->where($column, $value);
        $query = $this->db->get($this->table);
        if($query->num_rows()) return $query->row();
        return false;
    }
    
    function get_detail($cond=array()){
        if(isset($cond['select'])) $this->db->select($cond['select']);
        if(isset($cond['where'])) $this->db->where($cond['where']);
        $query = $this->db->get($this->table);
        if($query->num_rows()) return $query->row();
        return false;
    }
    
    function create($data){
        if($this->db->insert($this->table, $data)) return $this->db->insert_id();
        else return false;
    }
    
    function update($cond = array()){
        if(isset($cond['set'])) $this->db->set($cond['set']);
        if(isset($cond['where'])) $this->db->where($cond['where']);
        if($this->db->update($this->table)) return true;
        
        return false;
    }
}