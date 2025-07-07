<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();
		  /* Load :: Common */
        $this->lang->load('admin/settings');
        $this->load->model('admin/settings_model');
        /* Title Page :: Common */
        $this->page_title->push(lang('settings'));
        $this->data['pagetitle'] = $this->page_title->show();

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, lang('contact'), 'admin/settings');
    }

	public function site()
	{
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        if (isset($_POST) && ! empty($_POST))
		{
		    $data = array(
                    'address'         => $this->input->post('address'),
                    'phone_reception'       => $this->input->post('phone_reception'),
                    'phone_office'      => $this->input->post('phone_office'),
                    'email_office' => $this->input->post('email_office'),
                    'email_site'         => $this->input->post('email_site'),
                    'facebook_link'          => $this->input->post('facebook_link'),
                    'google_link'       => $this->input->post('google_link'),
                    'youtube_link'    =>  $this->input->post('youtube_link'),
                    'twitter_link'         => $this->input->post('twitter_link'),
                    'instragram_link'          =>$this->input->post('instragram_link')
                   
                );
			
		$this->settings_model->update_settings('settings', $data,1);
		$this->session->set_flashdata('message','Your changes has been saved successfully.');
        redirect('admin/settings/site', 'refresh');
		}	
                else
                {
            /* Breadcrumbs */
            $this->data['breadcrumb'] = $this->breadcrumbs->show();
			/* Get all donations */
            $this->data['settings'] =$this->settings_model->list_settings('settings');
            
            /* Data */
            $this->data['error'] = NULL;

            /* Load Template */
            $this->template->admin_render('admin/settings/site', $this->data);
        }
	}
	
	public function seo()
	{
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        if (isset($_POST) && ! empty($_POST))
		{
		    $data = array(
                    'google_analytic'       => $this->input->post('google_analytic'),
                    'google_verify'       => $this->input->post('google_verify'),
                    'bing_verify'       => $this->input->post('bing_verify'),
                );
		$this->settings_model->update_settings('settings', $data,1);
		$this->session->set_flashdata('message','Your changes has been saved successfully.');
                redirect('admin/settings/seo', 'refresh');
		}	
        else
        {
            /* Breadcrumbs */
            $this->data['breadcrumb'] = $this->breadcrumbs->show();
			/* Get all donations */
            $this->data['settings'] =$this->settings_model->list_settings('settings');
            
            /* Data */
            $this->data['error'] = NULL;

            /* Load Template */
            $this->template->admin_render('admin/settings/seo', $this->data);
        }
	}
	
	public function customcss()
	{
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        if (isset($_POST) && ! empty($_POST))
		{

		$data = array(
                'custom_css'       => $this->input->post('custom_css')
                );
			
			$this->settings_model->update_settings('settings', $data,1);
			$this->session->set_flashdata('message','Your changes has been saved successfully.');
			redirect('admin/settings/customcss', 'refresh');
		}	
        else
        {
            /* Breadcrumbs */
            $this->data['breadcrumb'] = $this->breadcrumbs->show();
			/* Get all donations */
            $this->data['settings'] =$this->settings_model->list_settings('settings');
            
            /* Data */
            $this->data['error'] = NULL;

            /* Load Template */
            $this->template->admin_render('admin/settings/customcss', $this->data);
        }
	}

	public function ads()
	{
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        if (isset($_POST) && ! empty($_POST))
		{

		$data = array(
                'header_ads'         => $this->input->post('header_ads'),
                'footer_ads'       => $this->input->post('footer_ads'),
                'pref'      => $this->input->post('pref'),  
                );
			
			$this->settings_model->update_settings('ads', $data,1);
			$this->session->set_flashdata('message','Your changes has been saved successfully.');
            redirect('admin/settings/ads', 'refresh');
		}	
        else
        {
            /* Breadcrumbs */
            $this->data['breadcrumb'] = $this->breadcrumbs->show();
			/* Get all donations */
            $this->data['ads'] =$this->settings_model->list_ads('ads');

            /* Data */
            $this->data['error'] = NULL;

            /* Load Template */
            $this->template->admin_render('admin/settings/ads', $this->data);
        }
	}
	
	public function layout()
	{
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        if (isset($_POST) && ! empty($_POST))
		{
			
		$data = array(
                'name'         => $this->input->post('name'),
                'description'       => $this->input->post('desc'),
                'bgcolor'      => $this->input->post('bgcolor'),
                );
			
		$this->settings_model->update_settings('layout', $data,1);
                redirect('admin/settings/layout', 'refresh');
		}	
        else
        {
            /* Breadcrumbs */
            $this->data['breadcrumb'] = $this->breadcrumbs->show();
			/* Get all donations */
            $this->data['layout'] =$this->settings_model->list_data('layout');
            
            /* Data */
            $this->data['error'] = NULL;

            /* Load Template */
            $this->template->admin_render('admin/settings/layout', $this->data);
        }
	}
	
	public function call2action()
	{
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        if (isset($_POST) && ! empty($_POST))
		{
			$this->form_validation->set_rules('title', 'Title', 'required');
			$this->form_validation->set_rules('desc', 'Description', 'required');
			$this->form_validation->set_rules('link', 'Link', 'required');
				//run validation on post data
        if ($this->form_validation->run() == TRUE)
        {
		
		$data = array(
                'title'         => $this->input->post('title'),
                'description'       => $this->input->post('desc'),
                'link'      => $this->input->post('link'),
                );
			
		$this->settings_model->update_settings('call2action', $data,1);
		}
		$this->session->set_flashdata('message','Your changes has been saved successfully.');
        redirect('admin/settings/call2action', 'refresh');
		}	
        else
        {
            /* Breadcrumbs */
            $this->data['breadcrumb'] = $this->breadcrumbs->show();
			/* Get all donations */
            $this->data['call2action'] =$this->settings_model->list_data('call2action');

            /* Data */
            $this->data['error'] = NULL;

            /* Load Template */
            $this->template->admin_render('admin/settings/call2action', $this->data);
        }
	}
	
	public function logo()
	{
		
		 $this->data['breadcrumb'] = $this->breadcrumbs->show();
		  /* Data */
         $this->data['error'] = NULL;
		$this->data['settings'] =$this->settings_model->list_settings('settings');
		/* Load Template */
            $this->template->admin_render('admin/settings/logo', $this->data);
	}

	public function upload_logo()
	{
        if (!$this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
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
            $this->breadcrumbs->unshift(2, lang('menu_files'), 'admin/settings');
            $this->data['breadcrumb'] = $this->breadcrumbs->show();
            
           $this->data['settings'] =$this->settings_model->list_settings('settings');
		  if(!empty($_FILES['logo']['name']))
		  {
            if (!$this->upload->do_upload('logo'))
            {
                /* Data */
                $this->data['error'] = $this->upload->display_errors();

                /* Load Template */
                $this->template->admin_render('admin/settings/logo', $this->data);
            }
            else
            {
				 $data = array(
				'logo'    => $this->upload->data('file_name'),

			);
			$this->settings_model->update_settings('settings', $data,1);
			}
			}
			
			//favicon
			
			if(!empty($_FILES['fevicon']['name']))
		  {
            if (!$this->upload->do_upload('fevicon'))
            {
                /* Data */
                $this->data['error'] = $this->upload->display_errors();

                /* Load Template */
                $this->template->admin_render('admin/settings/logo', $this->data);
            }
            else
            {
				 $data = array(
				'fevicon'    => $this->upload->data('file_name'),
			);
			$this->settings_model->update_settings('settings', $data,1);
			}
			}
			$data = array(
				'buy_sell'       => $this->input->post('buy_sell'),
                'copyright'       => $this->input->post('copyright'),
                'phone_office'      => $this->input->post('phone_office'),
                'ticker'       => $this->input->post('ticker'),
				'header_top'       => $this->input->post('header_top'),
				'header_gdpr'       => $this->input->post('header_gdpr'),
				'site_layout'       => $this->input->post('site_layout')

			);
			$this->settings_model->update_settings('settings', $data,1);
			$this->session->set_flashdata('message','Your changes has been saved successfully.');
            redirect('admin/settings/logo', 'refresh');
            
        }
	}

}