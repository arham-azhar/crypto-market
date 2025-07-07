<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Donation_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }


    public function list_donations($table)
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
    function add_donation($data)
		{
			
			$this->db->insert('donation', $data);
		}

    public function update_donation($table, $data,$id)
    {
        $where = "id =".$id;

        return $this->db->update($table, $data, $where);
    }
    
    public function update_donation_heading($table, $data)
    {
          return $this->db->update($table, $data);
    }
    
   public function get_donation($id)
    {
		$this->db->where('id', $id);
        $query = $this->db->get('donation');

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
