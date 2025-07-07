<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Sitemap extends G_Controller
{
        public function __construct()
    {
        parent::__construct();
		$this->load->library('session');
        $this->load->model('public/home_model');
    }
    /**
     * Index Page for this controller.
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     */
    public function index()
    {
		$url = file_get_contents(FCPATH . 'upload/json/common_1.json'); // path to your JSON file
		$data['coinHomeData']   = json_decode($url);

        $url1 = file_get_contents(FCPATH . 'upload/json/exchanges_1.json'); // path to your JSON file
		$data['coinExchangeData']   = json_decode($url1);
		
        $this->load->view('sitemap', $data);
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