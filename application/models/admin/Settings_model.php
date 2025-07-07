<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }


    public function list_settings($table)
    {
        $query = $this->db->get($table);

        if ($query->num_rows() > 0)
        {
            return $query->result_array();
        }
        else
        {
            return FALSE;
        }
    

	}
	
	 public function list_ads($table)
    {
        $query = $this->db->get($table);

        if ($query->num_rows() > 0)
        {
            return $query->result_array();
        }
        else
        {
            return FALSE;
        }
    

	}
	
	 public function list_data($table)
    {
        $query = $this->db->get($table);

        if ($query->num_rows() > 0)
        {
            return $query->result_array();
        }
        else
        {
            return FALSE;
        }
    

	}
	
	 public function update_settings($table, $data,$id)
    {
        $where = "id =".$id;

        return $this->db->update($table, $data, $where);
    }
    
}
