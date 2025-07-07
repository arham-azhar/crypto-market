<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Exchanges extends G_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('public/home_model');
        $this->load->model('admin/Settings_model');
        
    }
    
    /**
     * Index Page for this controller.
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     */
    
    public function index()
    {
        $settingData = $this->Settings_model->list_settings('settings');
        $cgApiKey = $settingData[0]['phone_office'];
	    $data['donations']       = $this->home_model->list_data('donation');
        $data['settingData']     = $this->home_model->list_data('settings');
        $data['pageData']        = $this->home_model->list_data('cms');
        $data['ads']             = $this->home_model->list_data('ads');
        $data['call2Action']     = $this->home_model->list_data('call2action');
        
        $data['pageTitle']       = 'Top Cryptocurrency Exchanges List | '. $data['pageData'][0]['meta_title'] .'';
        $data['pageDescription'] = 'List of top crypto exchanges ranked by 24 hours trading volume. View cryptourrency exchanges market data, info, trading pairs and information.';
		
		$filename=FCPATH . 'upload/json/exchanges_1.json';
		$create_time=date ("Y-m-d H:i:s", filemtime($filename));
		$current_time=date ("Y-m-d H:i:s");
		$to_time = strtotime($current_time);
		$from_time = strtotime($create_time);
		$duration= round(abs($to_time - $from_time) / 60,2);
		if($duration<=60)
		$exchanges_results = file_get_contents($filename, true);
	    else
		 {	
			$url  = "https://api.coingecko.com/api/v3/exchanges?per_page=250&x_cg_demo_api_key=$cgApiKey"; // path to your JSON file
	        $exchanges_results  = $this->request($url);
	        $file = fopen(FCPATH.'upload/json/exchanges_1.json','w');
            fwrite($file, $exchanges_results);
            fclose($file);
		 }
		
		$data['coinExchangesData']   = json_decode($exchanges_results);
		
        $this->load->view('exchanges/index', $data);
    }
    
    public function get_exchange_search_data()
    {
    $settingData = $this->Settings_model->list_settings('settings');
    $cgApiKey = $settingData[0]['phone_office'];
    $filename = FCPATH . "upload/json/exchange-list.json";
    $duration = file_exists($filename)
        ? round(abs(time() - filemtime($filename)) / 60, 2)
        : 99999;

    if ($duration <= 1440) {
        $coin_result = file_get_contents($filename);
    } else {
        $murl = "https://api.coingecko.com/api/v3/exchanges/list?x_cg_demo_api_key=$cgApiKey";
        $coin_result = $this->request($murl);
        file_put_contents($filename, $coin_result);
    }

    header('Content-Type: application/json');
    echo $coin_result;
    exit;
    }
  
    /* function for exchange detail page */
    public function detail()
    {
        $settingData = $this->Settings_model->list_settings('settings');
        $cgApiKey = $settingData[0]['phone_office'];
        $exchange       = strtolower($this->uri->segment(2)); //
        $data['exchange']       = $exchange;
        $url = file_get_contents(FCPATH . 'upload/json/exchanges.json'); // path to your JSON file
        $data['exchangeData'] = json_decode($url);
        
        setlocale(LC_MONETARY, "en_US");
        foreach ($data['exchangeData']->data as $res) {
            if($res->exchangeId==$exchange)
			$data['ename']=$res->name;
        }
        
        $data['settingData']           = $this->home_model->list_data('settings');
        $data['pageData']              = $this->home_model->list_data('cms');
        $data['donations']             = $this->home_model->list_data('donation');
        $data['ads']                   = $this->home_model->list_data('ads');
        $data['call2Action']           = $this->home_model->list_data('call2action');

        $data['pageTitle']             = $data['ename'] . ' Markets, Trade Volume, Pairs & Info';
        $data['pageDescription']       = 'Checkout ' . $data['ename'] . ' 24 hours trading volume & pairs info. Stay up to date with the latest crypto trading price movements on ' . $data['ename'] . ' exchange.';
       
       $filename = FCPATH . "upload/json/{$exchange}.json";

// Check cache duration (24 hours = 1440 minutes)
$duration = file_exists($filename)
    ? round(abs(time() - filemtime($filename)) / 60, 2)
    : 99999;

if ($duration <= 60) {
    $exchange_result = file_get_contents($filename);
} else {
    $eurl = "https://api.coingecko.com/api/v3/exchanges/$exchange?x_cg_demo_api_key=$cgApiKey";
    $exchange_result = $this->request($eurl);
    file_put_contents($filename, $exchange_result);
}

        $data['exchangemData']  = json_decode($exchange_result);
        
		$this->load->view('exchanges/exchange', $data);
    }
    
    public function get_exchange_volume_json($exchange_id)
{
    $settingData = $this->Settings_model->list_settings('settings');
    $cgApiKey = $settingData[0]['phone_office'];
    if (!$exchange_id) {
        show_404(); // or return an error
    }

    $filename = FCPATH . "upload/json/{$exchange_id}-vol.json";

    $duration = file_exists($filename)
        ? round(abs(time() - filemtime($filename)) / 60, 2)
        : 99999;

    if ($duration <= 720) {
        $results = file_get_contents($filename);
    } else {
        $url = "https://api.coingecko.com/api/v3/exchanges/$exchange_id/volume_chart?days=365&x_cg_demo_api_key=$cgApiKey";
        $results = $this->request($url);
        file_put_contents($filename, $results);
    }

    header('Content-Type: application/json');
    echo $results;
    exit;
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
     
     
    public function get_or_create_exchanges_json()
    {
        $settingData = $this->Settings_model->list_settings('settings');
        $cgApiKey = $settingData[0]['phone_office'];
    $page = $this->input->get('page');
    if (!$page || !is_numeric($page) || $page < 1) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid page number']);
        exit;
    }

    $filename = FCPATH . "upload/json/exchanges_{$page}.json";

    $duration = 999999;
    if (file_exists($filename)) {
        $create_time = date("Y-m-d H:i:s", filemtime($filename));
        $current_time = date("Y-m-d H:i:s");
        $to_time = strtotime($current_time);
        $from_time = strtotime($create_time);
        $duration = round(abs($to_time - $from_time) / 60, 2); // in minutes
    }

    if ($duration <= 60 && file_exists($filename)) {
        // File is still fresh, no need to fetch
        echo json_encode(['status' => 'ok', 'message' => "common_{$page}.json is up to date."]);
    } else {
        // Fetch new data and save
        $url = "https://api.coingecko.com/api/v3/exchanges?per_page=250&page={$page}&x_cg_demo_api_key=$cgApiKey";
        $api_results = $this->request($url);

        if ($api_results) {
            file_put_contents($filename, $api_results);
            echo json_encode(['status' => 'ok', 'message' => "common_{$page}.json created."]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'API fetch failed.']);
        }
    }

    exit;
}
     
    public function exchangesdata()
	{
	    
	$batch = $this->input->get('batch');
    $batch = ($batch && is_numeric($batch) && $batch >= 1) ? intval($batch) : 1;

    $file = FCPATH . "upload/json/exchanges_{$batch}.json";

    if (!file_exists($file)) {
        echo json_encode([
            'draw' => 1,
            'recordsTotal' => 0,
            'recordsFiltered' => 0,
            'data' => []
        ]);
        exit;
    }

    $exchangeData = json_decode(file_get_contents($file));
    $data = [];
	    
	//	$url = file_get_contents(FCPATH . 'upload/json/exchanges.json'); // path to your JSON file
	//	$exchangeData = json_decode($url); 
	
		foreach($exchangeData as $res)
        {
            $score = isset($res->trust_score) ? $res->trust_score : null;
        if ($score === null) {
            $score_class = 'bg-secondary text-white';
            $score_text = 'N/A';
        } elseif ($score >= 6) {
            $score_class = 'bg-success text-white'; // Green
            $score_text = $score . '/10';
        } elseif ($score <= 5) {
            $score_class = 'bg-warning text-dark'; // Yellow
            $score_text = $score . '/10';
        } elseif ($score <= 2) {
            $score_class = 'bg-danger text-white'; // Red
            $score_text = $score . '/10';
        }
		//	$row = array();
		    $row = [];
			if (!isset($res->trust_score_rank)) continue;
            $row['#'] = $res->trust_score_rank;
            $row['Name'] = '<img src="'.$res->image.'"><a href="'.base_url().'exchange/'.$res->id.'"><span class="coin-name">'.$res->name.'</span></a>';
			$row['Trust Score'] = '<span class="' . $score_class . ' px-2 py-1 rounded d-inline-block">' . $score_text . '</span>';
			$row['Volume(24h) Normalized'] = $this->custom_prc_format($res->trade_volume_24h_btc_normalized).' <small>BTC</small>';
			$row['Volume(24h)'] = $this->custom_prc_format($res->trade_volume_24h_btc).' <small>BTC</small>';
            $row['Established'] = '<center>' . (!empty($res->year_established) ? $res->year_established : '<span class="text-muted">N/A</span>') . '</center>';
            $row['Official Website'] = '<a href="'.$res->url.'";><center><i class="fa fa-external-link"></i></center></a>';
		    $row['DT_RowId'] = "EX_".strtolower($res->name);
            $data[] = $row;
		}
		
		    echo json_encode([
        'draw' => 1,
        'recordsTotal' => count($data),
        'recordsFiltered' => count($data),
        'data' => $data
    ]);
    exit;
    
	//	$results = array(
	//	"draw" => 1,
	//	"recordsTotal" => count($data),
	//	"recordsFiltered" => count($data),
	//	"data"=>$data);
	//	echo json_encode($results);
	//	exit;
	}
	public function custom_prc_format($n) {
        if ($n >= 1) {
        $n_format = number_format($n, 2);
        } else if ($n >= 0.1 && $n < 1) {
        $n_format = number_format($n, 3);
        } else if ($n >= 0.01 && $n < 0.1) {
        $n_format = number_format($n, 4);
        } else if ($n >= 0.001 && $n < 0.01) {
        $n_format = number_format($n, 6);
        } else if ($n >= 0.0001 && $n < 0.001) {
        $n_format = number_format($n, 8);
        }
        else {
        $n_format = number_format($n, 10);
    }
			return $n_format;
		}

}