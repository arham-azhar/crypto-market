<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends G_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('public/home_model');
        
    }
    
    /**
     * Index Page for this controller.
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     */
    
    public function index()
    {
        $data['donations']       = $this->home_model->list_data('donation');
        $data['settingData']     = $this->home_model->list_data('settings');
        $data['pageData']        = $this->home_model->list_data('cms');
        $data['ads']             = $this->home_model->list_data('ads');
        $data['call2Action']     = $this->home_model->list_data('call2action');
        
        $data['pageTitle']       = 'Cryptocurrency Latest News & Updates | '. $data['pageData'][0]['meta_title'] .'';
        $data['pageDescription'] = 'This section covers fintech, blockchain and Bitcoin bringing you the latest news and analyses on the future of money.';
		
        $this->load->view('news', $data);
    }

    //curl call function 
    public function request($url)
     {


        $curl = curl_init();

         curl_setopt_array($curl, array(
		 CURLOPT_URL => $url,
         CURLOPT_RETURNTRANSFER => true,
         CURLOPT_ENCODING => "",
         CURLOPT_MAXREDIRS => 10,
         CURLOPT_TIMEOUT => 0,
         CURLOPT_FOLLOWLOCATION => false,
         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
         CURLOPT_CUSTOMREQUEST => "GET",
          ));

        $response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

	if ($err) {
        return "cURL Error #:" . $err;
	} else {
       return $response;
      }

     }
}