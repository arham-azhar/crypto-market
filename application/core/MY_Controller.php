<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
        
        /* COMMON :: ADMIN & PUBLIC */
        /* Load */
        $this->load->database();
        $this->load->add_package_path(APPPATH . 'third_party/ion_auth/');
        $this->load->config('common/dp_config');
        $this->load->config('common/dp_language');
        $this->load->library(array('form_validation', 'ion_auth', 'template', 'common/mobile_detect'));
        $this->load->helper(array('array', 'language', 'url'));
		$this->load->helper('file');
        $this->load->model('common/prefs_model');
		

        /* Data */
        $this->data['lang']           = element($this->config->item('language'), $this->config->item('language_abbr'));
        $this->data['charset']        = $this->config->item('charset');
        $this->data['frameworks_dir'] = $this->config->item('frameworks_dir');
        $this->data['plugins_dir']    = $this->config->item('plugins_dir');
        $this->data['avatar_dir']     = $this->config->item('avatar_dir');

        /* Any mobile device (phones or tablets) */
        if ($this->mobile_detect->isMobile())
        {
            $this->data['mobile'] = TRUE;

            if ($this->mobile_detect->isiOS()){
                $this->data['ios']     = TRUE;
                $this->data['android'] = FALSE;
            }
            else if ($this->mobile_detect->isAndroidOS())
            {
                $this->data['ios']     = FALSE;
                $this->data['android'] = TRUE;
            }
            else
            {
                $this->data['ios']     = FALSE;
                $this->data['android'] = FALSE;
            }

            if ($this->mobile_detect->getBrowsers('IE')){
                $this->data['mobile_ie'] = TRUE;
            }
            else
            {
                $this->data['mobile_ie'] = FALSE;
            }
        }
        else
        {
            $this->data['mobile']    = FALSE;
            $this->data['ios']       = FALSE;
            $this->data['android']   = FALSE;
            $this->data['mobile_ie'] = FALSE;
        }
	}
}

class G_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('admin/Settings_model');
        $settingData = $this->Settings_model->list_settings('settings');
        $cgApiKey = $settingData[0]['phone_office'];
        /* COMMON API For Footer, Ticker, Calculator, Gainer and Looser Page */
		//json file save code start
		 $filename=FCPATH . 'upload/json/common_1.json';
		 $create_time=date ("Y-m-d H:i:s", filemtime($filename));
		 $current_time=date ("Y-m-d H:i:s");
		 $to_time = strtotime($current_time);
		 $from_time = strtotime($create_time);
		 $duration= round(abs($to_time - $from_time) / 60,2);
		 if($duration<=30)
		 $api_results = file_get_contents($filename, true);
	     else
		 {	
			$url  = "https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&price_change_percentage=1h%2C7d%2C14d%2C30d%2C200d%2C1y&sparkline=true&per_page=250&page=1&x_cg_demo_api_key=$cgApiKey"; // path to your JSON file
	        $api_results  = $this->request($url);
	        $file = fopen(FCPATH.'upload/json/common_1.json','w');
            fwrite($file, $api_results);
            fclose($file);
		 }
			
		
		// json file save code end`
		
		
        $coinMarketData         = json_decode($api_results);
        
        /* For Calculator, Top Gainer & Looser Page */
        $data['coinListtData'] =$coinMarketData;
        
	   //loop listing into coin elements
        setlocale(LC_MONETARY, "en_US");
        foreach ($coinMarketData as $res) {
            $coinRank[]            = $res->market_cap_rank;
            $coinName[]            = $res->name;
            $coinImage[]            = $res->image;
            $coinPrice[]           = $res->current_price;
            $coinId[]              = $res->id;
            $coinCode[]            = strtoupper($res->symbol);
            $coinChange24[]        = $res->price_change_percentage_24h;
            $coinChange24Sort[]    = $res->price_change_percentage_24h;
            $coinChange24DesSort[] = $res->price_change_percentage_24h;
            $coinMkcap[]           = $res->market_cap;
            $coinSupply[]          = $res->total_supply;
            $coinUsdVolume[]       = $res->total_volume;
            if($res->symbol=='btc'){
			$data['btcCap']= $res->market_cap;
			$data['btcPrice']= $res->current_price;
            }
		    if($res->symbol=='eth')
			$data['ethCap']= $res->market_cap;
        }
        $data['coinRank']      = $coinRank;
        $data['coinName']      = $coinName;
        $data['coinImage']      = $coinImage;
        $data['coinPrice']     = $coinPrice;
        $data['coinId']        = $coinId;
        $data['coinCode']      = $coinCode;
        $data['coinChange24']  = $coinChange24;
        $data['coinMkcap']     = $coinMkcap;
        $data['coinSupply']    = $coinSupply;
        $data['coinUsdVolume'] = $coinUsdVolume;
        
        //sort coin elements and assign into variable for top gainer and top loser
        arsort($coinChange24DesSort);
        asort($coinChange24Sort);
        
        $data['coinChange24Sort']    = $coinChange24Sort;
        $data['coinChange24DesSort'] = $coinChange24DesSort;
        
        //$data['totalCap']= array_sum($coinMkcap);
		//$data['totalvol']= array_sum($coinUsdVolume);
		//$data['coinTotal']= count($coinMarketData);
		
		$gfilename = FCPATH . "upload/json/global.json";

        // Check cache duration (24 hours = 1440 minutes)
        $duration = file_exists($gfilename)
        ? round(abs(time() - filemtime($gfilename)) / 60, 2)
        : 99999;

        if ($duration <= 360) {
        $global_result = file_get_contents($gfilename);
        } else {
        $gurl = "https://api.coingecko.com/api/v3/global?x_cg_demo_api_key=$cgApiKey";
        $global_result = $this->request($gurl);
        file_put_contents($gfilename, $global_result);
        }
        
        $data['coingData']  = json_decode($global_result);
		
        /* For News Data */
		//json file save code start
         $filename=FCPATH . 'upload/json/news.json';
		 $create_time=date ("Y-m-d H:i:s", filemtime($filename));
		 $current_time=date ("Y-m-d H:i:s");
		 $to_time = strtotime($current_time);
		 $from_time = strtotime($create_time);
		 $duration= round(abs($to_time - $from_time) / 60,2);
		 if($duration<=60)
		 $news_results = file_get_contents($filename, true);
	     else
		 {		
            $xml_string = 'https://crypto.news/feed';
            $xml = file_get_contents($xml_string);
            $xml =simplexml_load_string($xml, "SimpleXMLElement", LIBXML_NOCDATA);
            $news_results = json_encode($xml);
            $file = fopen(FCPATH.'upload/json/news.json','w');
            fwrite($file, $news_results);
            fclose($file);
		 }
		 
        $data['newsData']         = json_decode($news_results);
        
        
        //Currency Switcher
        
$filename = FCPATH . 'upload/json/rates.json';
$create_time = date("Y-m-d H:i:s", filemtime($filename));
$current_time = date("Y-m-d H:i:s");
$to_time = strtotime($current_time);
$from_time = strtotime($create_time);
$duration = round(abs($to_time - $from_time) / 60, 2);

if ($duration <= 480) {
    $rates_results = file_get_contents($filename, true);
} else {
    // Fetch from new API
    $rates_url = 'https://open.er-api.com/v6/latest/USD';
    $api_results = $this->request($rates_url);
    $api_data = json_decode($api_results, true);

$symbolMap = [
    'USD' => '$',
    'AED' => 'AED',
    'AFN' => 'AFN',
    'ALL' => 'ALL',
    'AMD' => 'AMD',
    'ANG' => 'ANG',
    'AOA' => 'AOA',
    'ARS' => 'AR$',
    'AUD' => 'A$',
    'AWG' => 'AWG',
    'AZN' => 'AZN',
    'BAM' => 'BAM',
    'BBD' => 'Bds$',
    'BDT' => '৳',
    'BGN' => 'BGN',
    'BHD' => 'BHD',
    'BIF' => 'BIF',
    'BMD' => 'BM$',
    'BND' => 'B$',
    'BOB' => 'Bs',
    'BRL' => 'R$',
    'BSD' => 'B$',
    'BTN' => 'Nu',
    'BWP' => 'P',
    'BYN' => 'Br',
    'BZD' => 'BZ$',
    'CAD' => 'CA$',
    'CDF' => 'CDF',
    'CHF' => 'CHF',
    'CLP' => 'CL$',
    'CNY' => 'CN¥',
    'COP' => 'CO$',
    'CRC' => '₡',
    'CUP' => 'CU$',
    'CVE' => 'CVE',
    'CZK' => 'Kč',
    'DJF' => 'DJF',
    'DKK' => 'DKK',
    'DOP' => 'RD$',
    'DZD' => 'DZD',
    'EGP' => 'EG£',
    'ERN' => 'ERN',
    'ETB' => 'ETB',
    'EUR' => '€',
    'FJD' => 'FJ$',
    'FKP' => 'FK£',
    'FOK' => 'FOK',
    'GBP' => '£',
    'GEL' => 'GEL',
    'GGP' => 'GG£',
    'GHS' => 'GH₵',
    'GIP' => 'GIP',
    'GMD' => 'GMD',
    'GNF' => 'GNF',
    'GTQ' => 'Q',
    'GYD' => 'GY$',
    'HKD' => 'HK$',
    'HNL' => 'L',
    'HRK' => 'HRK',
    'HTG' => 'HTG',
    'HUF' => 'Ft',
    'IDR' => 'Rp',
    'ILS' => '₪',
    'IMP' => 'IMP',
    'INR' => '₹',
    'IQD' => 'IQD',
    'IRR' => 'IRR',
    'ISK' => 'ISK',
    'JEP' => 'JEP',
    'JMD' => 'J$',
    'JOD' => 'JOD',
    'JPY' => 'JP¥',
    'KES' => 'KSh',
    'KGS' => 'KGS',
    'KHR' => '៛',
    'KID' => 'KID',
    'KMF' => 'KMF',
    'KRW' => '₩',
    'KWD' => 'KWD',
    'KYD' => 'KY$',
    'KZT' => 'KZT',
    'LAK' => '₭',
    'LBP' => 'LBP',
    'LKR' => 'Rs',
    'LRD' => 'L$',
    'LSL' => 'LSL',
    'LYD' => 'LYD',
    'MAD' => 'MAD',
    'MDL' => 'MDL',
    'MGA' => 'MGA',
    'MKD' => 'MKD',
    'MMK' => 'MMK',
    'MNT' => '₮',
    'MOP' => 'MOP$',
    'MRU' => 'MRU',
    'MUR' => 'Rs',
    'MVR' => 'MVR',
    'MWK' => 'MWK',
    'MXN' => 'MX$',
    'MYR' => 'RM',
    'MZN' => 'MZN',
    'NAD' => 'N$',
    'NGN' => '₦',
    'NIO' => 'C$',
    'NOK' => 'NOK',
    'NPR' => 'Rs',
    'NZD' => 'NZ$',
    'OMR' => 'OMR',
    'PAB' => 'B/.',
    'PEN' => 'S/',
    'PGK' => 'PGK',
    'PHP' => '₱',
    'PKR' => 'Rs',
    'PLN' => 'zł',
    'PYG' => '₲',
    'QAR' => 'QAR',
    'RON' => 'RON',
    'RSD' => 'RSD',
    'RUB' => 'RUB',
    'RWF' => 'RWF',
    'SAR' => 'SAR',
    'SBD' => 'SI$',
    'SCR' => 'SCR',
    'SDG' => 'SDG',
    'SEK' => 'SEK',
    'SGD' => 'S$',
    'SHP' => 'SH£',
    'SLE' => 'SLE',
    'SLL' => 'SLL',
    'SOS' => 'SOS',
    'SRD' => 'SR$',
    'SSP' => 'SSP',
    'STN' => 'STN',
    'SYP' => 'SYP',
    'SZL' => 'SZL',
    'THB' => '฿',
    'TJS' => 'TJS',
    'TMT' => 'TMT',
    'TND' => 'TND',
    'TOP' => 'T$',
    'TRY' => '₺',
    'TTD' => 'TT$',
    'TVD' => 'TV$',
    'TWD' => 'NT$',
    'TZS' => 'TSh',
    'UAH' => '₴',
    'UGX' => 'USh',
    'UYU' => '$U',
    'UZS' => 'UZS',
    'VES' => 'Bs.',
    'VND' => '₫',
    'VUV' => 'VT',
    'WST' => 'WS$',
    'XAF' => 'XAF',
    'XCD' => 'EC$',
    'XCG' => 'XCG',
    'XDR' => 'XDR',
    'XOF' => 'XOF',
    'XPF' => 'XPF',
    'YER' => 'YER',
    'ZAR' => 'ZAR',
    'ZMW' => 'ZMW',
    'ZWL' => 'ZWL'
];

    $converted = ['data' => []];
    foreach ($api_data['rates'] as $symbol => $rate) {
        $currencySymbol = $symbolMap[$symbol] ?? '';
        $converted['data'][] = [
            'symbol' => $symbol,
            'currencySymbol' => $currencySymbol,
            'rateUsd' => (string)(1 / $rate),
        ];
    }

    $rates_results = json_encode($converted);
    file_put_contents($filename, $rates_results);
}

// Assign to your views
$data['rateData']  = json_decode($rates_results);
$data['priceData'] = json_decode($rates_results);


		
		//set curreny conversion parameter
		if($this->session->userdata('convert_rate'))
		{
			$convertRate=$this->session->userdata('convert_rate');
		}
		else
		{
			$convertRate=1;
			
		}
		$data['convertRate']=$convertRate;
		
		if($this->session->userdata('convert_symbol'))
		{
			$convertSymbol=$this->session->userdata('convert_symbol');
		}
		else
		{
			$convertSymbol='$ USD';
			
		}
		
		$data['convertSymbol']=$convertSymbol;
		
		$data['convertCode'] = $this->session->userdata('convert_code') ?? 'USD';

		//end
        
        $this->load->vars($data);
	}
}

class Admin_Controller extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            /* Load */
            $this->load->config('admin/dp_config');
            $this->load->library('admin/page_title');
            $this->load->library('admin/breadcrumbs');
            $this->load->model('admin/core_model');
            $this->load->helper('menu');
            $this->lang->load(array('admin/main_header', 'admin/main_sidebar', 'admin/footer', 'admin/actions'));

            /* Load library function  */
            $this->breadcrumbs->unshift(0, $this->lang->line('menu_dashboard'), 'admin/dashboard');

            /* Data */
            $this->data['title']       = $this->config->item('title');
            $this->data['title_lg']    = $this->config->item('title_lg');
            $this->data['title_mini']  = $this->config->item('title_mini');
            $this->data['admin_prefs'] = $this->prefs_model->admin_prefs();
            $this->data['user_login']  = $this->prefs_model->user_info_login($this->ion_auth->user()->row()->id);

            if ($this->router->fetch_class() == 'dashboard')
            {
                $this->data['dashboard_alert_file_install'] = $this->core_model->get_file_install();
                $this->data['header_alert_file_install']    = NULL;
            }
            else
            {
                $this->data['dashboard_alert_file_install'] = NULL;
                $this->data['header_alert_file_install']    = NULL; /* << A MODIFIER !!! */
            }
        }
    }
}


class Public_Controller extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

        if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin())
        {
            $this->data['admin_link'] = TRUE;
        }
        else
        {
            $this->data['admin_link'] = FALSE;
        }

        if ($this->ion_auth->logged_in())
        {
            $this->data['logout_link'] = TRUE;
        }
        else
        {
            $this->data['logout_link'] = FALSE;
        }
	}
}
