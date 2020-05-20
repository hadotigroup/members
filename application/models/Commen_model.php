<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Commen_model extends CI_Model {

    public function get_data_from_table($table, $where = '', $whereVal = '', $limit = FALSE, $start = FALSE){
        if(!empty($where)){
            $this->db->where($where, $whereVal);
        }
        if($limit && $start){
            $this->db->limit($limit, $start);
        }
        return $this->db->get($table)->result();
    }

    public function get_data($table, $get){ //$where = '', $whereVal = '', $limit = FALSE, $start = FALSE){
        if(!empty($get['where']) && !empty($get['where_value'])){
            $this->db->where($get['where'], $get['where_value']);
        }
        if(!empty($get['limit']) && !empty($get['start'])){
            $this->db->limit($get['limit'], $get['start']);
        }
        if($get['order_by_col']){

            $this->db->order_by($get['order_by_col'], !empty($get['order_by_order'])? $get['order_by_order'] : 'desc');
        }
        return $this->db->get($table)->result();
    }
    
    public function get_data_from_table_like($table, $where = '', $whereVal = '', $limit = FALSE, $start = FALSE){
        if(!empty($where)){
            $this->db->like($where, $whereVal);
        }
        if($limit && $start){
            $this->db->limit($limit, $start);
        }
        return $this->db->get($table)->result();
    }

    public function fetch_single_row($tbl, $col = FALSE, $colVal = FALSE){
        if($col && $colVal){
            $this->db->where($col, $colVal);
        }
        return $this->db->get($tbl)->result();
    }

    public function insert_into_table($table, $data = array()){
        if(!empty($data)){
            $this->db->insert_id();
            return $this->db->insert($table,$data);
        }
        return FALSE;
    }

    public function update_table_with_id($table, $data = array(), $id = ''){
        if(!empty($id)){
            $this->db->where('id', $id);
            return $this->db->update($table, $data);
        }
        return FALSE;
    }

    public function delete_table_row($table, $id  = ''){
        if(!empty($id)){
            $this->db->where('id', $id);
            return $this->db->delete($table);
        }
        return FALSE;
    }
    
    public function fetch_table_data($table = '', $group_by = FALSE){
        if(!empty($table)){
            if($group_by){
                $this->db->group_by($group_by);
                $this->db->order_by('name', 'desc');
                return $this->db->get($table)->result();
            }
            $this->db->order_by('name', 'desc');
            return $this->db->get($table)->result();
        }
        return FALSE;
    }
    
    public function fetch_table_data_by_id($table = '', $id = ''){
        if(!empty($table && !empty($id))){
            return $this->db->where('id', $id)->get($table)->result();
        }
        return FALSE;
    }

}

/* End of file Commen_model.php */


?>