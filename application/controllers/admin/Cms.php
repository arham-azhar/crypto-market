<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cms extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();
	/* Load :: Common */
        $this->lang->load('admin/cms');
        $this->load->model('admin/cms_model');
        /* Title Page :: Common */
        $this->page_title->push(lang('cms'));
        $this->data['pagetitle'] = $this->page_title->show();

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, lang('cms'), 'admin/cms');
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
            $this->data['cmsData'] =$this->cms_model->list_cms('cms');
;
            /* Data */
            $this->data['error'] = NULL;

            /* Load Template */
            $this->template->admin_render('admin/cms/index', $this->data);
        }
	}

	public function create()
	{

        /* Breadcrumbs */
        $this->breadcrumbs->unshift(2, lang('menu_cms_create'), 'admin/cms/create');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();

        /* Variables */
		$tables = $this->config->item('tables', 'ion_auth');

	/* Load Template */
        $this->template->admin_render('admin/cms/create', $this->data);
       
	}		

	public function edit($id)
	{
        $id = (int) $id;

		if ( ! $this->ion_auth->logged_in() OR ( ! $this->ion_auth->is_admin() && ! ($this->ion_auth->user()->row()->id == $id)))
		{
			redirect('auth', 'refresh');
		}
		
		if (isset($_POST) && ! empty($_POST))
		{
		$this->form_validation->set_rules('title', 'Title', 'required');		
		$this->form_validation->set_rules('desc', 'Description', 'required');
		$this->form_validation->set_rules('meta_title', 'Meta Title', 'required');
		$this->form_validation->set_rules('meta_desc', 'Meta Desc', 'required');
		
	//run validation on post data
        if ($this->form_validation->run() == TRUE)
        {
			//if(!empty())
			$data = array(
			'title'  => $this->input->post('title'),
				'description'  => $this->input->post('desc'),
				'home_title'    => $this->input->post('home_title'),
				'meta_title'    => $this->input->post('meta_title'),
				'seo_url'    => strtolower(str_replace(' ','-',$this->input->post('title'))),
				'meta_description'    => $this->input->post('meta_desc'),
				'updated_date'    => date('Y-m-d H:i:s'),
				
			);
			
			 $this->cms_model->update_cms('cms', $data,$id);

              
		}
		$this->session->set_flashdata('message','Your changes has been saved successfully.');
		  redirect('admin/cms', 'refresh');
	}	
		
		else
		
		{

        /* Breadcrumbs */
        $this->breadcrumbs->unshift(2, lang('menu_cms_edit'), 'admin/cms/edit');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();

        /* Data */
		$this->data['cms']          = $this->cms_model->get_cms($id);
		
		/* Load Template */
		$this->template->admin_render('admin/cms/edit', $this->data);
		
	}
	}
	
	function activate($id = NULL)
	{
        $id = (int) $id;

		$data = array(
			
			'active'    => 1,
				
			);
			
			 $this->cms_model->update_cms('cms', $data,$id);

                redirect('admin/cms', 'refresh');
		
	}
	
	function deactivate($id = NULL)
	{
        $id = (int) $id;

		$data = array(
			
			'active'    => 0,
				
			);
			
			 $this->cms_model->update_cms('cms', $data,$id);

                redirect('admin/cms', 'refresh');	
	}
}
