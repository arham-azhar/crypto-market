<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends G_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->library('session');
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
	
        $data['donations']       = $this->home_model->list_data('donation');
        $data['settingData']     = $this->home_model->list_data('settings');
        $data['pageData']        = $this->home_model->list_data('cms');
        $data['ads']             = $this->home_model->list_data('ads');
        $data['call2Action']     = $this->home_model->list_data('call2action');
        $data['pageTitle']       = $data['pageData'][0]['meta_title'];
        $data['pageDescription'] = $data['pageData'][0]['meta_description'];
		
		//table data code start
	
		$url = file_get_contents(FCPATH . 'upload/json/common_1.json'); // path to your JSON file
		$data['coinHomeData']   = json_decode($url);
		//end
		
        $this->load->view('home', $data);
        }
    
    public function get_coin_search_data()
    {
        $settingData = $this->Settings_model->list_settings('settings');
        $cgApiKey = $settingData[0]['phone_office'];
    $filename = FCPATH . "upload/json/coins.json";
    $duration = file_exists($filename)
        ? round(abs(time() - filemtime($filename)) / 60, 2)
        : 99999;

    if ($duration <= 1440) {
        $coin_result = file_get_contents($filename);
    } else {
        $murl = "https://api.coingecko.com/api/v3/coins/list?x_cg_demo_api_key=$cgApiKey";
        $coin_result = $this->request($murl);
        file_put_contents($filename, $coin_result);
    }

    header('Content-Type: application/json');
    echo $coin_result;
    exit;
}

    
    /* function for coin detail page */
    public function coin()
    {
        $settingData = $this->Settings_model->list_settings('settings');
        $cgApiKey = $settingData[0]['phone_office'];
        //coin single page
        $coin           = $this->uri->segment(2); //get coin name from url
        $data['coin']       = $coin;
        //$url = file_get_contents(FCPATH . 'upload/json/common_.json'); // path to your JSON file
        //$data['coinData']              = json_decode($url);
        
        $data['settingData']           = $this->home_model->list_data('settings');
        $data['pageData']              = $this->home_model->list_data('cms');
        $data['donations']             = $this->home_model->list_data('donation');
        $data['ads']                   = $this->home_model->list_data('ads');
        $data['call2Action']           = $this->home_model->list_data('call2action');

        $data['pageTitle']             = ucwords(str_replace('-', ' ', $data['coin'])) . ' Live Price, MarketCap & Info';
        $data['pageDescription']       = 'Live ' . ucwords(str_replace('-', ' ', $data['coin'])) . ' prices, market Capitalization, historical data chart, volume & supply. Stay up to date with the latest ' . ucwords(str_replace('-', ' ', $data['coin'])) . ' info & markets data. Check our coins stats data to see when there is an opportunity to buy or sell ' . ucwords(str_replace('-', ' ', $data['coin'])). ' at best price.';
		
		$filename = FCPATH . "upload/json/{$coin}.json";

        // Check cache duration (24 hours = 1440 minutes)
        $duration = file_exists($filename)
        ? round(abs(time() - filemtime($filename)) / 60, 2)
        : 99999;

        if ($duration <= 30) {
        $coin_result = file_get_contents($filename);
        } else {
        $murl = "https://api.coingecko.com/api/v3/coins/$coin?localization=false&community_data=false&developer_data=false&sparkline=true&x_cg_demo_api_key=$cgApiKey";
        $coin_result = $this->request($murl);
        file_put_contents($filename, $coin_result);
        }
        
        $data['coinmData']  = json_decode($coin_result);
        
        $coinhistory = FCPATH . "upload/json/{$coin}-price-history.json";

        $results = file_get_contents($coinhistory);
        $data['priceHistory'] = json_decode($results);

		$this->load->view('coin', $data);
    }
    
    public function get_coin_price_json($coin_id)
    {
        $settingData = $this->Settings_model->list_settings('settings');
        $cgApiKey = $settingData[0]['phone_office'];
    if (!$coin_id) {
        show_404(); // or return an error
    }

    $filename = FCPATH . "upload/json/{$coin_id}-price-history.json";

    $duration = file_exists($filename)
        ? round(abs(time() - filemtime($filename)) / 60, 2)
        : 99999;

    if ($duration <= 1440) {
        $results = file_get_contents($filename);
    } else {
        
        $url = "https://api.coingecko.com/api/v3/coins/$coin_id/market_chart?vs_currency=usd&interval=daily&days=365&x_cg_demo_api_key=$cgApiKey";
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
	 
	 public function set_rate()
	 {
		 $rate=$this->input->post('rate');
		 $this->session->set_userdata('convert_rate', $rate);
		
		 
		 $symbol=$this->input->post('symbol');
		 $this->session->set_userdata('convert_symbol', $symbol);
		 
		 $code = $this->input->post('code');
         $this->session->set_userdata('convert_code', $code);
	 }
	 
	 public function get_or_create_common_json()
    {
        $settingData = $this->Settings_model->list_settings('settings');
        $cgApiKey = $settingData[0]['phone_office'];
    $page = $this->input->get('page');
    if (!$page || !is_numeric($page) || $page < 1) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid page number']);
        exit;
    }

    $filename = FCPATH . "upload/json/common_{$page}.json";

    $duration = 999999;
    if (file_exists($filename)) {
        $create_time = date("Y-m-d H:i:s", filemtime($filename));
        $current_time = date("Y-m-d H:i:s");
        $to_time = strtotime($current_time);
        $from_time = strtotime($create_time);
        $duration = round(abs($to_time - $from_time) / 60, 2); // in minutes
    }

    if ($duration <= 30 && file_exists($filename)) {
        // File is still fresh, no need to fetch
        echo json_encode(['status' => 'ok', 'message' => "common_{$page}.json is up to date."]);
    } else {
        // Fetch new data and save
        $url = "https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&price_change_percentage=1h,7d,14d,30d,200d,1y&sparkline=true&per_page=250&page={$page}&x_cg_demo_api_key=$cgApiKey";
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

	 
    public function coindata()
    {
    $batch = $this->input->get('batch');
    $batch = ($batch && is_numeric($batch) && $batch >= 1) ? intval($batch) : 1;

    $file = FCPATH . "upload/json/common_{$batch}.json";

    if (!file_exists($file)) {
        echo json_encode([
            'draw' => 1,
            'recordsTotal' => 0,
            'recordsFiltered' => 0,
            'data' => []
        ]);
        exit;
    }

    $coinMarketData = json_decode(file_get_contents($file));
    $data = [];
    $watchlist = $this->input->cookie('watchlist', TRUE);
    $watchlist = $watchlist ? json_decode($watchlist, true) : [];
    foreach ($coinMarketData as $res) {
        $row = [];
        $action_link = in_array($res->id, $watchlist) ? 
        '<a href="#" class="watchlist-action" data-action="remove" data-coin="' . $res->id . '"><i class="fa fa-star" title="Remove from Watchlist"></i></a>' :
        '<a href="#" class="watchlist-action" data-action="add" data-coin="' . $res->id . '"><i class="fa fa-star-o" title="Add to Watchlist"></i></a>';
        $row['#'] = $action_link . ' ' . $res->market_cap_rank;
        $row['Name'] = '<img src="' . str_replace('/large/', '/small/', $res->image) . '"><a href="' . base_url() . 'coin/' . $res->id . '"><span class="coin-name">' . $res->name . '</span></a> <span class="badge badge-warning">' . strtoupper($res->symbol) . '</span>';
        $row['Price'] = $res->current_price;
        $row['1h'] = ($res->price_change_percentage_1h_in_currency > 0)
            ? '<span class="p-up"><i class="fa fa-caret-up"></i> ' . round($res->price_change_percentage_1h_in_currency, 2) . '%</span>'
            : '<span class="p-down"><i class="fa fa-caret-down"></i> ' . round($res->price_change_percentage_1h_in_currency, 2) . '%</span>';
        $row['24h'] = ($res->price_change_percentage_24h > 0)
            ? '<span class="p-up"><i class="fa fa-caret-up"></i> ' . round($res->price_change_percentage_24h, 2) . '%</span>'
            : '<span class="p-down"><i class="fa fa-caret-down"></i> ' . round($res->price_change_percentage_24h, 2) . '%</span>';
        $row['7d'] = ($res->price_change_percentage_7d_in_currency > 0)
            ? '<span class="p-up"><i class="fa fa-caret-up"></i> ' . round($res->price_change_percentage_7d_in_currency, 2) . '%</span>'
            : '<span class="p-down"><i class="fa fa-caret-down"></i> ' . round($res->price_change_percentage_7d_in_currency, 2) . '%</span>';
        $row['Volume(24h)'] = $res->total_volume;
        $row['Market Cap'] = $res->market_cap;
        $sparkline = implode(",", $res->sparkline_in_7d->price ?? []);
        $row['Last 7 Days'] = '<span class="sparkline" data-values="' . $sparkline . '"></span>';
        $row['DT_RowId'] = "BTC_" . strtolower($res->symbol);
        $data[] = $row;
    }

    echo json_encode([
        'draw' => 1,
        'recordsTotal' => count($data),
        'recordsFiltered' => count($data),
        'data' => $data
    ]);
    exit;
}

	/* this function used to convert price to Trillion/Billion/Million/Thousand */
	public function custom_number_format($n, $precision = 2) {
        if ($n < 100000) {
        // Default
         $n_format = number_format($n);
        } else if ($n < 9000000) {
        // Thousand
        $n_format = number_format($n / 1000, $precision). 'K';
        } else if ($n < 900000000) {
        // Million
        $n_format = number_format($n / 1000000, $precision). 'M';
        } else if ($n < 900000000000) {
        // Billion
        $n_format = number_format($n / 1000000000, $precision). 'B';
        } else {
        // Trillion
        $n_format = number_format($n / 1000000000000, $precision). 'T';
    }
    return $n_format;
		}
}