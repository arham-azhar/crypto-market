<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Watchlist extends G_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('cookie', 'url'));
        $this->load->library('session');
        $this->load->model('public/home_model');
    }

public function add($coin_name)
{
    $watchlist = $this->input->cookie('watchlist', TRUE);
    $watchlist = $watchlist ? json_decode($watchlist, true) : [];
    if (!in_array($coin_name, $watchlist)) {
        $watchlist[] = $coin_name;
    }
    set_cookie('watchlist', json_encode($watchlist), 2592000); // 30 days

    if ($this->input->is_ajax_request()) {
        ini_set('zlib.output_compression', 'Off'); // Disable output compression for this response
        $this->output->set_content_type('application/json')
                     ->set_output(json_encode(['status' => 'success', 'action' => 'added']));
    } else {
        redirect('/watchlist');
    }
}

public function remove($coin_name)
{
    $watchlist = $this->input->cookie('watchlist', TRUE);
    $watchlist = $watchlist ? json_decode($watchlist, true) : [];
    if (($key = array_search($coin_name, $watchlist)) !== false) {
        unset($watchlist[$key]);
    }
    set_cookie('watchlist', json_encode(array_values($watchlist)), 2592000); // 30 days

    if ($this->input->is_ajax_request()) {
        ini_set('zlib.output_compression', 'Off'); // Disable output compression for this response
        $this->output->set_content_type('application/json')
                     ->set_output(json_encode(['status' => 'success', 'action' => 'removed']));
    } else {
        redirect('/watchlist');
    }
}

private function loadAllCommonJsonData() {
    $data = [];
    foreach (glob(FCPATH . 'upload/json/common_*.json') as $file) {
        $jsonContent = json_decode(file_get_contents($file));
        if (isset($jsonContent) && is_array($jsonContent)) {
            $data = array_merge($data, $jsonContent);
        }
    }
    return $data;
}
private function loadCoinFileByName($coinName)
{
    $filePath = FCPATH . 'upload/json/' . $coinName . '.json';
    if (file_exists($filePath)) {
        return json_decode(file_get_contents($filePath));
    }
    return null;
}

    public function view()
    {
               $watchlist = $this->input->cookie('watchlist', TRUE);
        $watchlistArray = $watchlist ? json_decode($watchlist, true) : [];

    $data['watchlist'] = $watchlistArray;
        //$data['watchlist'] = $watchlist ? json_decode($watchlist, true) : [];
        //$url = file_get_contents(FCPATH . 'upload/json/common_1.json'); // path to your JSON file
		//$data['coinWData']   = json_decode($url);
        $data['coinWData'] = $this->loadAllCommonJsonData();
        $fallbackData = [];
    foreach ($watchlistArray as $coinName) {
        $fallbackData[$coinName] = $this->loadCoinFileByName($coinName);
    }
    $data['fallbackCoinData'] = $fallbackData;
        $data['ads']             = $this->home_model->list_data('ads');
        $data['call2Action']     = $this->home_model->list_data('call2action');
        $data['donations']       = $this->home_model->list_data('donation');
        $data['settingData']     = $this->home_model->list_data('settings');
        $data['pageData']        = $this->home_model->list_data('cms');
        $data['pageTitle']       = 'Follow Your Favourite Cryptocurrencies - '.$data['pageData'][0]['meta_title'];
        $data['pageDescription'] = 'Track your favorite cryptocurrencies with ease. Stay updated on the latest prices, market capitalization, and performance of your selected coins all in one place.';
        $this->load->view('watchlist', $data);
    }
}
