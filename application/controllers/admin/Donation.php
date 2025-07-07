<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Donation extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();
		  /* Load :: Common */
        $this->lang->load('admin/donation');
        $this->load->model('admin/donation_model');
        /* Title Page :: Common */
        $this->page_title->push(lang('donation'));
        $this->data['pagetitle'] = $this->page_title->show();

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, lang('donation'), 'admin/donation');
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
            $this->data['donations'] =$this->donation_model->list_donations('donation');
;
            /* Data */
            $this->data['error'] = NULL;

            /* Load Template */
            $this->template->admin_render('admin/donation/index', $this->data);
        }
	}

	public function create()
	{
        /* Breadcrumbs */
        $this->breadcrumbs->unshift(2, lang('menu_donation_create'), 'admin/donation/create');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();

        /* Variables */
		$tables = $this->config->item('tables', 'ion_auth');

		/* Load Template */
        $this->template->admin_render('admin/donation/create', $this->data);
       
	}		

	public function do_upload()
	{
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            /* Conf */
            $config['upload_path']      = './upload/';
            $config['allowed_types']    = 'gif|jpg|png';
            $config['max_size']         = 2048;
            $config['max_width']        = 1024;
            $config['max_height']       = 1024;
            $config['file_ext_tolower'] = TRUE;

            $this->load->library('upload', $config);

            /* Breadcrumbs */
            $this->breadcrumbs->unshift(2, lang('menu_files'), 'admin/donation');
            $this->data['breadcrumb'] = $this->breadcrumbs->show();
            
            $this->form_validation->set_rules('title', 'Title', 'required');
			$this->form_validation->set_rules('desc', 'Description', 'required');
			//run validation on post data
       // if ($this->form_validation->run() == FALSE)
        //{   //validation fails
			//echo 'hi';die;
          // $this->load->view('public/contact',$data);
       // }
            if ( ! $this->upload->do_upload('userfile'))
            {
                /* Data */
                $this->data['error'] = $this->upload->display_errors();

                /* Load Template */
                $this->template->admin_render('admin/donation/index', $this->data);
            }
            else
            {
				 $data = array(
				'title' => $this->input->post('title'),
				'description'  => $this->input->post('desc'),
				'image'    => $this->upload->data('file_name'),
				'active'    => 1,
				
			);
			$this->donation_model->add_donation($data);

                redirect('admin/donation', 'refresh');
            }
        }
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
				//run validation on post data
        if ($this->form_validation->run() == FALSE)
        {   //validation fails
		
		$this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
           $this->template->admin_render('admin/donation/edit', $this->data);
        }
        
        else
        {
        
			
			if(!empty($_FILES['userfile']['name']))
			{
			$config['upload_path']      = './upload/';
            $config['allowed_types']    = 'gif|jpg|png';
            $config['max_size']         = 2048;
            $config['max_width']        = 1024;
            $config['max_height']       = 1024;
            $config['file_ext_tolower'] = TRUE;

            $this->load->library('upload', $config);
            
             if ( ! $this->upload->do_upload('userfile'))
            {
                /* Data */
                $this->data['error'] = $this->upload->display_errors();

                /* Load Template */
                $this->template->admin_render('admin/donation/edit', $this->data);
            }
			else
            {
				 $data = array(
				'title' => $this->input->post('title'),
				'description'  => $this->input->post('desc'),
				'image'    => $this->upload->data('file_name'),
				
				
			);
			}	
		}
		else
		{
			//if(!empty())
			$data = array(
				'title' => $this->input->post('title'),
				'description'  => $this->input->post('desc'),
				//'image'    => $this->upload->data('file_name'),
				//'status'    => 1,
				
			);
			 

		}	
		$this->donation_model->update_donation('donation', $data,$id);
		$this->session->set_flashdata('message','Your changes has been saved successfully.');
	}
			
                redirect('admin/donation', 'refresh');
		}	
		
		else
		
		{

        /* Breadcrumbs */
        $this->breadcrumbs->unshift(2, lang('menu_donation_edit'), 'admin/donation/edit');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();

        /* Data */
		$this->data['donation']          = $this->donation_model->get_donation($id);
		
		/* Load Template */
		$this->template->admin_render('admin/donation/edit', $this->data);
		
	}
	}
	
	public function edit_heading()
	{
     	
		if (isset($_POST) && ! empty($_POST))
		{
			 $this->form_validation->set_rules('heading', 'Mian Title', 'required');
			$this->form_validation->set_rules('paragraph', 'Main Description', 'required');
				//run validation on post data
        if ($this->form_validation->run() == FALSE)
        {   //validation fails
		
		$this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
           $this->template->admin_render('admin/donation/index', $this->data);
        }
        
        else
        {
        
			
		
			//if(!empty())
			$data = array(
				'heading' => $this->input->post('heading'),
				'paragraph'  => $this->input->post('paragraph'),
				
			);
			 $this->donation_model->update_donation_heading('donation', $data);

			
		
		}
			$this->session->set_flashdata('message','Your changes has been saved successfully.');
                redirect('admin/donation', 'refresh');
		}	
		
		
	}
	
	public function activate($id = NULL)
	{
        $id = (int) $id;

		$data = array(
			
			'active'    => 1,
				
			);
			
			 $this->donation_model->update_donation('donation', $data,$id);

                redirect('admin/donation', 'refresh');
		
	}
	
	public function deactivate($id = NULL)
	{
        $id = (int) $id;

		$data = array(
			
			'active'    => 0,
				
			);
			
			 $this->donation_model->update_donation('donation', $data,$id);

                redirect('admin/donation', 'refresh');
		
	}


	

}