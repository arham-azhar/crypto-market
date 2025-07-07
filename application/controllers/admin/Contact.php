<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();
		  /* Load :: Common */
        $this->lang->load('admin/contact');
        $this->load->model('admin/contact_model');
        /* Title Page :: Common */
        $this->page_title->push(lang('contact'));
        $this->data['pagetitle'] = $this->page_title->show();

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, lang('contact'), 'admin/contact');
    }


	public function index()
	{
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            /* Breadcrumbs */
            $this->data['breadcrumb'] = $this->breadcrumbs->show();
			/* Get all donations */
            $this->data['contacts'] =$this->contact_model->list_contacts('contact');
           
            /* Data */
            $this->data['error'] = NULL;

            /* Load Template */
            $this->template->admin_render('admin/contact/index', $this->data);
        }
	}

	 /* delete record according to id */
	public function erase($id)
	{
       $id = (int) $id;
	   $this->contact_model->row_delete($id);
	   $this->session->set_flashdata('message','Record has been deleted successfully.');
       redirect('admin/contact', 'refresh');
		
	}
	

	

}
