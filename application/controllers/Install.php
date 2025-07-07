<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Install extends CI_Controller {
	
	public function __construct()
    {
        parent::__construct();
        $this->load->add_package_path(APPPATH.'third_party/ion_auth/');
		$this->load->library('ion_auth');
      	$this->load->model('public/home_model');
		
    }

	//function for second step for installation process
	public function step2()
	{
	    

		//check if already installation done
		$check=$this->home_model->check_email();
		if($check==1)
		header('Location:'. base_url());
		if($this->input->post())
		{
				$identity = $this->input->post('email');
				$password = $this->input->post('password');
				$api_key  = $this->input->post('api_key');
				//run validation on post data
				if($identity=='' || !filter_var($identity, FILTER_VALIDATE_EMAIL))
				{
				$data['error_msg']='Please enter a valid email address';
				$this->load->view('install/step2',$data);
				}
				
			    else if($password=='')
				{
				$data['error_msg']='Please enter password';
				$this->load->view('install/step2',$data);
				}
				else if(strlen($password)<8)
				{
				$data['error_msg']='Minimum password length must be 8';
				$this->load->view('install/step2',$data);
				}
			
		        else
                {
        		$identity = $this->input->post('email');
				$password = $this->input->post('password');
				$baseURL = $this->input->post('base_url');
				$data = array(
                    'email'         => $identity 
                                      
                );
				if($this->home_model->update_settings('users',$data,1))
				{
					
					$change = $this->ion_auth_model->change_password($identity, 'password', $password );
					// Save API key to settings table
                    $settings_data = ['phone_office' => $this->input->post('api_key')];
                    $this->home_model->update_settings('settings', $settings_data, 1);
					redirect($baseURL, 'refresh');
				}	
				
                }	
		}
		else
		{
			  $this->load->view('install/step2',$data);
               
         }      
		
	}

}
