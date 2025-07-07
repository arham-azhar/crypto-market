<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends G_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('public/home_model');
        //$this->load->library(array('session', 'form_validation'));
    }
    
    /**
     * Display method for this controller.
     * it will display page according to page name
     * like about us, privacy policy etc
    
     */
    
    public function display()
    {
        $seourl                 = $this->uri->segment(2); //get seourl which identify page name
        $data['pageData']            = $this->home_model->list_data('cms');
        $data['results']             = $this->home_model->page_display_data('cms', $seourl);
        $data['settingData']         = $this->home_model->list_data('settings');
        $data['donations']           = $this->home_model->list_data('donation');
        $data['call2Action']         = $this->home_model->list_data('call2action');
        $data['pageTitle']           = $data['results'][0]['meta_title'];
        $data['pageDescription']     = $data['results'][0]['meta_description'];

        $this->load->view('public/page', $data);
    }
    
    /**
     * Contact method for this controller.
     * it will display contact page
     */
    
    
    public function contact()
    {
        $seourl                 = $this->uri->segment(1);
        $data['pageData']            = $this->home_model->list_data('cms');
        $data['settingData']         = $this->home_model->list_data('settings');
        $data['donations']           = $this->home_model->list_data('donation');
        $data['call2Action']         = $this->home_model->list_data('call2action');
        $data['results']             = $this->home_model->page_data('cms', 4);
        $data['pageTitle']           = $data['results'][0]['meta_title'];
        $data['pageDescription']     = $data['results'][0]['meta_description'];
		
		//end
        if ($this->input->post()) {
            //set validation rules
            $this->form_validation->set_rules('name', 'Name', 'trim|required');
            $this->form_validation->set_rules('email', 'Email ID', 'trim|required|valid_email');
            $this->form_validation->set_rules('phone', 'Phone', 'trim|required');
            //$this->form_validation->set_rules('message', 'Message', 'trim|required');
			$this->form_validation->set_rules('consent_check', 'Consent checkbox', 'required');
            
            //run validation on post data
            if ($this->form_validation->run() == FALSE) { //validation fails
                
                $this->load->view('public/contact', $data);
            } else {
                
                //insert the contact form data into database
                $data = array(
                    'name' => $this->input->post('name'),
                    'email' => $this->input->post('email'),
                    'phone' => $this->input->post('phone'),
                    'message' => $this->input->post('message'),
                    'created_date' => date('Y-m-d H:i:s')
                );
                $data = $this->security->xss_clean($data);
                if ($this->db->insert('contact', $data)) {
                    
                    // success
                    $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">We received your message! Will get back to you shortly!!!</div>');
                    redirect('contact-us');
                } else {
                    
                    // error
                    $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Oops! Some Error.  Please try again later!!!</div>');
                    redirect('contact-us');
                }
            }
            
        }
        else
        $this->load->view('public/contact', $data);
    }
    
    /**
     * Top gainer coin method for this controller.
     * it have logic for top 5 gainer coin of last 24 hrs
     */
    
    
    public function top_gainer_coins()
    {
        $data['donations']       = $this->home_model->list_data('donation');
        $data['settingData']     = $this->home_model->list_data('settings');
        $data['pageData']        = $this->home_model->list_data('cms');
        $data['ads']             = $this->home_model->list_data('ads');
        $data['call2Action']     = $this->home_model->list_data('call2action');
        $data['pageTitle']       = 'Top Crypto Gainers - '.$data['pageData'][0]['meta_title'];
        $data['pageDescription'] = 'Checkout top crypto gainers stats data to see an opportunity to buy or sell coin at best price in the cryptocurrency market.';
		//end
        $this->load->view('public/top_gainer_coins', $data);
    }
    
    /**
     * Top loser coin method for this controller.
     * it have logic for top 5 loser coin of last 24 hrs
     */
    public function top_loser_coins()
    {
        $data['donations']       = $this->home_model->list_data('donation');
        $data['settingData']     = $this->home_model->list_data('settings');
        $data['pageData']        = $this->home_model->list_data('cms');
        $data['ads']             = $this->home_model->list_data('ads');
        $data['call2Action']     = $this->home_model->list_data('call2action');

        $data['pageTitle']       = 'Top Crypto Losers - '.$data['pageData'][0]['meta_title'];
        $data['pageDescription'] = 'Checkout top crypto losers stats data to see an opportunity to buy or sell coin at best price in the cryptocurrency market.';
		//end
        $this->load->view('public/top_loser_coins', $data);
    }
    
     //curl call function 
    public function request($url)
     {


         $curl = curl_init();

         curl_setopt_array($curl, array(
             CURLOPT_RETURNTRANSFER => 1,
             CURLOPT_URL => $url,
             CURLOPT_USERAGENT => 'Agent'
         ));

         return curl_exec($curl);

         curl_close($curl);

     }

}