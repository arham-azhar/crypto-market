<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cms_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }


    public function list_cms($table)
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
    function add_cms($data)
		{
			
			$this->db->insert('cms', $data);
		}

    public function update_cms($table, $data,$id)
    {
        $where = "id =".$id;

        return $this->db->update($table, $data, $where);
    }
    
   public function get_cms($id)
    {
		$this->db->where('id', $id);
        $query = $this->db->get('cms');

        if ($query->num_rows() > 0)
        {
            return $query->result_array();
        }
        else
        {
            return FALSE;
        }
    }



    
}
