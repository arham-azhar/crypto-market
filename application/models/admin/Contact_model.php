<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }
	
    public function list_contacts($table)
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
	
	 public function row_delete($id)
    {
        $this->db->where('id', $id);
		$this->db->delete('contact');
	}
    
}
