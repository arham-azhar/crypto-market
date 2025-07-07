<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }
  
    //function for get cms data
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
    
    //common function for get listing of any table data
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
    
    //function for get page data according to page id
	public function page_data($table,$id)
    {
		$this->db->where('id', $id);
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
    
    //function for get page data according to page seourl
     public function page_display_data($table,$seourl)
	{
		$this->db->where('seo_url', $seourl);
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
    
    //function for update record of table
    public function update_settings($table, $data,$id)
    {
        $where = "id =".$id;

        return $this->db->update($table, $data, $where);
    }
    
    //function for check existing admin email in user table
    public function check_email()
    {
		$this->db->select('email');
		$q = $this->db->get('users');
		$data = $q->result_array();
 
	if($data[0]['email']!='')
		return '1';
		else
		return '0';
 }
  
}