<?php $this->load->view('include/header'); ?>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"  ></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.1/js/responsive.bootstrap4.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.bootstrap4.min.css"/>
<?php setlocale(LC_MONETARY,"en_US"); ?>
<?php
	function custom_number_format($n, $precision = 2) {
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
	function custom_prc_format($n) {
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
?>
 <?php
       $coinname = $coinmData->name;
       $coinsymbol = $coinmData->symbol;
       $coinid = $coinmData->id;
       $coinrank = $coinmData->market_cap_rank;
       $coinurl = $coinmData->links->homepage;
       $coinvwap = $coinmData->vwap24Hr;
       
       $coinvolume = $coinmData->market_data->total_volume->usd;
       
       $coinmcap = $coinmData->market_data->market_cap->usd;
       $coinfdv = $coinmData->market_data->fully_diluted_valuation->usd;
       $coinmcapchange = $coinmData->market_data->market_cap_change_24h;
       $coinmcap24h = round($coinmData->market_data->market_cap_change_percentage_24h, 2);
       $coinfdvr = $coinmData->market_data->market_cap_fdv_ratio;
       
       $coinsupply = $coinmData->market_data->total_supply;
       $coinmsupply = $coinmData->market_data->max_supply;
       $coincsupply = $coinmData->market_data->circulating_supply;
      // $csymbol = strtolower($convertCode);
       $coinath = $coinmData->market_data->ath->usd;
       $coinathchange = round($coinmData->market_data->ath_change_percentage->usd, 2);
       $coinathdate = $coinmData->market_data->ath_date->usd;
       $coinatl = $coinmData->market_data->atl->usd;
       $coinatlchange = round($coinmData->market_data->atl_change_percentage->usd, 2);
       $coinatldate = $coinmData->market_data->atl_date->usd;
       $coinhigh24 = $coinmData->market_data->high_24h->usd;
       $coinlow24 = $coinmData->market_data->low_24h->usd;
       
       $coinprice = $coinmData->market_data->current_price->usd;
       $coinpricechange = $coinmData->market_data->price_change_24h;
       $coin1h = round($coinmData->market_data->price_change_percentage_1h_in_currency->usd, 2);
       $coinchange = $coinmData->market_data->price_change_percentage_24h;
       $coin7d = round($coinmData->market_data->price_change_percentage_7d, 2);
       $coin14d = round($coinmData->market_data->price_change_percentage_14d, 2);
       $coin30d = round($coinmData->market_data->price_change_percentage_30d, 2);
       $coin60d = round($coinmData->market_data->price_change_percentage_60d, 2);
       $coin200d = round($coinmData->market_data->price_change_percentage_200d, 2);
       $coin1y = round($coinmData->market_data->price_change_percentage_1y, 2);
 ?>
                <div class="page-title py-3">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-12 text-left">
                                <h1><?php echo $coinname;?> Live Price Update & Market Capitalization</h1>
                           </div>
                        </div>        
                    </div>    
                </div>
		<!-- Ad Code Top  -->
		<div class="py-4">
		<?php if($ads[0]['pref']==0 || $ads[0]['pref']==2) { ?>
               <div class="container">
               		<div class="row justify-content-center">
						<?php echo  $ads[0]['header_ads']?>
                    </div>    
				</div>
		<?php } ?>
		</div>
        <!-- End Ad Code Top  -->
        <!-- Coin Data  -->

        <div class="container">
			<div class="media">
			  <img class="mr-3" src="<?php echo $coinmData->image->large; ?>">
			    <div class="align-self-center media-body">
				  <h2 class="font-weight-bold" style="margin-bottom:5px;"><?php echo $coinname;?> <span class="badge badge-secondary align-middle" style="margin-top:-0.3em;" id="bitcode"><?php echo strtoupper($coinsymbol);?></span> <span class="badge badge-success align-middle" style="margin-top:-0.3em;"><?php if(isset($coinrank)) echo '#'.$coinrank; else echo 'N/A';?></span></h2>
 				  <h1 style="margin-bottom:0;"><span id="coin_price"><?php echo strtok($convertSymbol, " ");?><?php echo custom_prc_format($coinprice/$convertRate); ?></span> <small><span class="p-<?php echo $coinchange > 0 ? 'up':'down'?>"><i class="fa fa-caret-<?php echo $coinchange > 0 ? 'up':'down'?>"></i> <?php echo str_replace('-','',round($coinchange,2))?>% (1d)</span></small></h1>
				</div>
			</div>
<div class="container">
  <div class="row pt-4">
<?php $watchlist = $this->input->cookie('watchlist', TRUE);
        $watchlist = $watchlist ? json_decode($watchlist, true) : []; ?>
   <?php 
$action_link = in_array($coin, $watchlist) ? 
    '<a href="#" id="watchlist-action" data-action="remove" data-coin="' . $coin . '"><span style="margin: 0px 5px 10px 0px;border: 1px solid red;color: red;" class="badge">Remove from Watchlist</span></a>' :
    '<a href="#" id="watchlist-action" data-action="add" data-coin="' . $coin . '"><span style="margin: 0px 5px 10px 0px;border: 1px solid green;color: green;" class="badge">Add to Watchlist</span></a>';
echo $action_link;
?>
    <!-- Website -->
    <?php
    if (!empty($coinmData->links->homepage)) {
        foreach ($coinmData->links->homepage as $coinurl) {
            if (!empty($coinurl)) {
                echo '<a href="' . $coinurl . '" target="_blank"><span class="badge linking"><i class="fa fa-globe"></i> Official Website <i class="fa fa-external-link"></i></span></a> ';
            break;
                
            }
        }
    }

    // Whitepaper
    if (!empty($coinmData->links->whitepaper)) {
        echo '<a href="' . $coinmData->links->whitepaper . '" target="_blank"><span class="badge linking"><i class="fa fa-file"></i> View Whitepaper <i class="fa fa-external-link"></i></span></a> ';
    }
    
     // Forums
    if (!empty($coinmData->links->official_forum_url)) {
        foreach ($coinmData->links->official_forum_url as $forumUrl) {
            if (!empty($forumUrl)) {
                echo '<a href="' . $forumUrl . '" target="_blank"><span class="badge linking"><i class="fa fa-comments"></i> Forum <i class="fa fa-external-link"></i></span></a> ';
           break;
            }
        }
    }
    
        // Reddit
    if (!empty($coinmData->links->subreddit_url)) {
        echo '<a href="' . $coinmData->links->subreddit_url . '" target="_blank"><span class="badge linking"><i class="fa fa-reddit"></i> Reddit <i class="fa fa-external-link"></i></span></a> ';
    }
    
        // Twitter
    if (!empty($coinmData->links->twitter_screen_name)) {
        echo '<a href="https://twitter.com/' . $coinmData->links->twitter_screen_name . '" target="_blank"><span class="badge linking"><i class="fa fa-twitter"></i> Twitter <i class="fa fa-external-link"></i></span></a> ';
    }

    // Facebook
    if (!empty($coinmData->links->facebook_username)) {
        echo '<a href="https://facebook.com/' . $coinmData->links->facebook_username . '" target="_blank"><span class="badge linking"><i class="fa fa-facebook"></i> Facebook <i class="fa fa-external-link"></i></span></a> ';
    }

    // Blockchain Explorers
    if (!empty($coinmData->links->blockchain_site)) {
        foreach ($coinmData->links->blockchain_site as $blockchainUrl) {
            if (!empty($blockchainUrl)) {
                echo '<a href="' . $blockchainUrl . '" target="_blank"><span class="badge linking"><i class="fa fa-link"></i> Block Explorer <i class="fa fa-external-link"></i></span></a> ';
                break; 
            }
        }
    }

    // GitHub Repositories
    if (!empty($coinmData->links->repos_url->github)) {
        foreach ($coinmData->links->repos_url->github as $githubUrl) {
            if (!empty($githubUrl)) {
                echo '<a href="' . $githubUrl . '" target="_blank"><span class="badge linking"><i class="fa fa-github"></i> GitHub <i class="fa fa-external-link"></i></span></a> ';
            break;
            }
        }
    }
    ?>

  </div>
</div>

			
				<div class="pt-3 pb-2">
					<h4><i class="fa fa-eye"></i> Market Overview</h4>
					<p><span class="font-weight-bold"><?php echo $coinname;?></span> current market price is <span class="font-weight-bold" id="price_coin"><?php echo strtok($convertSymbol, " ");?><?php echo custom_prc_format($coinprice/$convertRate);?></span> with a 24 hour trading volume of <span class="font-weight-bold"><?php echo strtok($convertSymbol, " ");?><?php echo custom_number_format($coinvolume/$convertRate);?></span>. The total available supply of <span class="font-weight-bold"><?php echo $coinname;?></span> is <span class="font-weight-bold"><?php echo custom_number_format($coinsupply); ?> <?php echo strtoupper($coinsymbol);?></span><?php if(isset($coinmsupply)) echo " with a maximum supply of "."<b>".custom_number_format($coinmsupply)." ".strtoupper($coinsymbol)."</b>"; else echo '';?>. It has secured <span class="font-weight-bold">Rank <?php if(isset($coinrank)) echo $coinrank; else echo '(Not Available)';?></span> in the cryptocurrency market with a marketcap of <span class="font-weight-bold"><?php echo strtok($convertSymbol, " ");?><?php echo custom_number_format($coinmcap/$convertRate);?></span>. The <span class="font-weight-bold"><?php echo strtoupper($coinsymbol);?></span> price is <i class="fa fa-caret-<?php echo $coin1h > 0 ? 'up':'down'?>"></i><span class="font-weight-bold"><?php echo str_replace('-','',$coin1h);?>%</span> <?php if($coin1h > 0) echo 'up'; else echo 'down';?> in the last one hour.</p>
					<hr>
					<p>The high price of the <span class="font-weight-bold"><?php echo $coinname;?></span> is <span class="font-weight-bold"><?php echo strtok($convertSymbol, " ");?><?php echo custom_prc_format($coinhigh24/$convertRate); ?></span> and low price is <span class="font-weight-bold"><?php echo strtok($convertSymbol, " ");?><?php echo custom_prc_format($coinlow24/$convertRate); ?></span> in the last 24 hours. Live <span class="font-weight-bold"><?php echo $coinData->name;?></span> prices from all markets and <span class="font-weight-bold"><?php echo strtoupper($coinData->symbol);?></span> coin market Capitalization. Stay up to date with the latest <span class="font-weight-bold"><?php echo $coinData->name;?></span> price movements. Check our coin stats data and see when there is an opportunity to buy or sell <span class="font-weight-bold"><?php echo $coinData->name;?></span> at best price in the market.</p>
				</div>
		<div class="row">
			<div class="col-sm">
				<a target = '_blank' href="<?php echo $settingData[0]['buy_sell'] ?>" class="btn btn-dark btn-block mb-1"><i class="fa fa-cart-plus"></i> Buy <?php echo $coinname;?> (<?php echo strtoupper($coinsymbol);?>)</a>
			</div>
			<div class="col-sm">
			<a target = '_blank' href="<?php echo $settingData[0]['buy_sell'] ?>" class="btn btn-warning btn-block"><i class="fa fa-cart-arrow-down"></i> Sell <?php echo $coinname;?> (<?php echo strtoupper($coinsymbol);?>)</a>
			</div>
		</div>
		<div class="pt-4 pb-3">
			<div class="card-deck">
			    			<div class="card bg-light">
    			<div class="card-body">
      				<h6 class="card-title"><?php echo $coinname;?> Rank</h6>
      				<p class="card-text"><?php if(isset($coinrank)) echo $coinrank; else echo '(Not Available)';?> </p>
    			</div>
			</div>
			<div class="card bg-light">
    			<div class="card-body">
      				<h6 class="card-title"><?php echo $coinname;?> Price</h6>
      				<p class="card-text"><?php echo strtok($convertSymbol, " ");?><?php echo custom_prc_format($coinprice/$convertRate);?></p>
    			</div>
			</div>
			<div class="card bg-light">
    			<div class="card-body">
      				<h6 class="card-title">Market Cap</h6>
      				<p class="card-text"><?php echo strtok($convertSymbol, " ");?><?php echo custom_number_format($coinmcap/$convertRate);?> <span class="p-<?php echo $coinmcap24h > 0 ? 'up':'down'?>">
      				    <i class="fa fa-caret-<?php echo $coinmcap24h > 0 ? 'up':'down'?>"></i> <?php echo str_replace('-','',$coinmcap24h)?>%</span>
      				</p>
    			</div>
			</div>
      		<div class="card bg-light">
    			<div class="card-body">
      				<h6 class="card-title">Fully Diluted Valuation</h6>
      				<p class="card-text"><?php echo strtok($convertSymbol, " ");?><?php echo custom_number_format($coinfdv/$convertRate);?> </p>
    			</div>
			</div>

			</div>
		</div>

		<div class="pb-3">
			<div class="card-deck">
			
      		<div class="card bg-light">
    			<div class="card-body">
      				<h6 class="card-title">Trading Volume(24h)</h6>
      				<p class="card-text"><?php echo strtok($convertSymbol, " ");?><?php echo custom_number_format($coinvolume/$convertRate);?></p>
    			</div>
			</div>
      		<div class="card bg-light">
    			<div class="card-body">
      				<h6 class="card-title">Circulating Supply</h6>
      				<p class="card-text"><?php echo custom_number_format($coincsupply); ?> <?php echo strtoupper($coinsymbol); ?></p>
    			</div>
			</div>
			<div class="card bg-light">
    			<div class="card-body">
      				<h6 class="card-title">Total Supply</h6>
      				<p class="card-text"><?php echo custom_number_format($coinsupply); ?> <?php echo strtoupper($coinsymbol); ?></p>
    			</div>
			</div>
			<div class="card bg-light">
    			<div class="card-body">
      				<h6 class="card-title">Max Supply</h6>
      				<p class="card-text"><?php if(isset($coinmsupply)) echo custom_number_format($coinmsupply)." ".strtoupper($coinsymbol); else echo '(Not Available)';?></p>
    			</div>
			</div>
			</div>
		</div>
		

		<div class="pb-3">
			<div class="card-deck">
			<div class="card bg-light">
    			<div class="card-body">
      				<h6 class="card-title">High(24h)</h6>
      				<p class="card-text"><?php echo strtok($convertSymbol, " ");?><?php echo custom_prc_format($coinhigh24/$convertRate);?> </p>
    			</div>
			</div>

      		<div class="card bg-light">
    			<div class="card-body">
      				<h6 class="card-title">Low(24h)</h6>
      				<p class="card-text"><?php echo strtok($convertSymbol, " ");?><?php echo custom_prc_format($coinlow24/$convertRate);?></p>
    			</div>
			</div>
			
      		<div class="card bg-light">
    			<div class="card-body">
      				<h6 class="card-title">All-time High</h6>
      					<p class="card-text"><?php echo strtok($convertSymbol, " ");?><?php echo custom_prc_format($coinath/$convertRate);?> <span class="p-<?php echo $coinathchange > 0 ? 'up':'down'?>">
      				    <i class="fa fa-caret-<?php echo $coinathchange > 0 ? 'up':'down'?>"></i> <?php echo str_replace('-','',$coinathchange)?>%</span>
      				   
      				     <br/> <small> <?php echo date('d M Y', strtotime($coinathdate));?></small> </p>
    			</div>
			</div>
			<div class="card bg-light">
    			<div class="card-body">
      				<h6 class="card-title">All-time Low</h6>
      					<p class="card-text"><?php echo strtok($convertSymbol, " ");?><?php echo custom_prc_format($coinatl/$convertRate);?> <span class="p-<?php echo $coinatlchange > 0 ? 'up':'down'?>">
      				    <i class="fa fa-caret-<?php echo $coinatlchange > 0 ? 'up':'down'?>"></i> <?php echo str_replace('-','',$coinatlchange)?>%</span>
      				  <br/> <small> <?php echo date('d M Y', strtotime($coinatldate));?></small>
      				    </p>
      				    
    			</div>
			</div>
			</div>
		</div>
		
		<!-- Calculator  -->
		 <h4 class="pt-3 pb-2"><i class="fa fa-calculator"></i> Cryptocurrency <?php echo $coinname;?> Calculator</h4>
		 <div class="container bg-donation pt-4 pb-3 px-4">
   
 <div class="row">
<div class="col-md-6 mb-3">
 <input type="number" class="form-control" id="from_ammount" placeholder="Enter Amount To Convert" value=10 />
 </div>
 <div class="col-md-6 mb-3">
     <input type="text" class="form-control" id="from_cryptoc" value="<?php echo $coinname;?> (<?php echo strtoupper($coinsymbol);?>)" disabled/>
     <input type="hidden" class="form-control" id="from_currency" value="<?php echo $coinprice;?>" />
</div></div>
<div class="row">
<div class="col-md-6">
 <select class="form-control js-example-basic-single" id="to_currency" onchange=calculate();>
<?php foreach ($rateData->data as $res) { ?>
<option value="<?php echo $res->rateUsd; ?>" data-symbol="<?php echo $res->currencySymbol; ?>" <?php if ($res->symbol == $convertCode) echo "Selected"; ?>><?php echo $res->symbol; ?></option>
 <?php } ?>
 </select>
 </div>
 </div>
<h5 class="pt-4 text-center"><div class="col-md-12"><div id="to_ammount"></div></div></h5>
<script type="text/javascript">
$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>
<script>
function custom_prc_format(n) {
    if (n >= 1) {
        return n.toFixed(2);
    } else if (n >= 0.1 && n < 1) {
        return n.toFixed(3);
    } else if (n >= 0.01 && n < 0.1) {
        return n.toFixed(4);
    } else if (n >= 0.001 && n < 0.01) {
        return n.toFixed(6);
    } else if (n >= 0.0001 && n < 0.001) {
        return n.toFixed(8);
    } else {
        return n.toFixed(10);
    }
}
const from_currencyEl = document.getElementById('from_currency');
const from_cryptocEl = document.getElementById('from_cryptoc');
const from_ammountEl = document.getElementById('from_ammount');
const to_currencyEl = document.getElementById('to_currency');
const to_ammountEl = document.getElementById('to_ammount');

from_ammountEl.addEventListener('input', calculate);
to_ammountEl.addEventListener('input', calculate);

function calculate() {
    var toSymbol = $('#to_currency option:selected').data('symbol');
    var convertedValue = from_ammountEl.value * from_currencyEl.value / to_currencyEl.value;
    var formattedValue = custom_prc_format(convertedValue);
    
    to_ammountEl.innerText = 
    (from_ammountEl.value) + ' ' + (from_cryptocEl.value) + ' ' + '=' + ' ' +
    toSymbol + formattedValue;
}
calculate();
</script>
        </div>
        <div class="cta-box py-4 mb-3">
<p class="lead text-center mb-2">Want to convert more cryptocurrencies?</p>
   <div class="text-center mb-2"> <a href="<?php echo base_url(); ?>calculator" class="btn btn-outline-dark btn-sm"><i class="fa fa-calculator"></i> Use Crypto Calculator</a> </div>
   </div>
        
		<!--
			<h4 class="pt-3 pb-2"><i class="fa fa-area-chart"></i> <?php echo $coinname;?> Historical Data Price Chart</h4>
  			<div class="coin-chart" data-coin-period="365day" data-coin-id="<?php echo $coinid; ?>" data-chart-color="
			<?php if($settingData[0]['site_layout']==1) echo '#FFBA00';else if($settingData[0]['site_layout']==2)   echo '#65bc7b';else if($settingData[0]['site_layout']==3)   echo '#cc0000';else if($settingData[0]['site_layout']==4)   echo '#4d39e9';else if($settingData[0]['site_layout']==5)   echo '#4fb2aa';else if($settingData[0]['site_layout']==6)   echo '#17a2b8';else if($settingData[0]['site_layout']==7)   echo '#007bff';else if($settingData[0]['site_layout']==8)   echo '#28a745';else if($settingData[0]['site_layout']==9)   echo '#dc3545';else  echo '#343a40'; ?>">
				<div class="cmc-wrp"  id="COIN-CHART-<?php echo $coinid; ?>" style="width:100%; height:100%;" >
				</div>
			</div>
       End Price Chart  -->
        	<!-- Price Chart  -->
			<h4 class="pt-4 pb-3"><i class="fa fa-area-chart"></i><?php echo $coinname; ?> Historical Data Chart</h4>
<!-- Chart Tabs -->
<!-- amCharts CDN -->
<!-- Chart UI -->
<style>.chart-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 12px;
  flex-wrap: wrap;
}

.chart-tabs,
.chart-range {
  display: flex;
  gap: 6px;
}

.chart-tabs .tab-btn,
.chart-range .range-btn {
  padding: 6px 14px;
  border: 1px solid #ddd;
  background-color: #fff;
  font-size: 14px;
  border-radius: 4px;
  cursor: pointer;
  color: #333;
  margin-bottom:10px;
  transition: all 0.2s ease;
}

.chart-tabs .tab-btn.active,
.chart-range .range-btn.active {
  background-color: #f0f5ff;
  border-color: #3b8beb;
  color: #3b8beb;
  font-weight: 600;
}
}

</style>
<div class="chart-header">
  <div class="chart-tabs">
    <button class="tab-btn active" data-tab="price">Price</button>
    <button class="tab-btn" data-tab="marketcap">Market Cap</button>
    <button class="tab-btn" data-tab="tradingview">TradingView</button>
  </div>

  <div class="chart-range" id="range-switcher">
    <button class="range-btn" data-range="7D">7D</button>
    <button class="range-btn" data-range="1M">1M</button>
    <button class="range-btn" data-range="3M">3M</button>
    <button class="range-btn active" data-range="1Y">1Y</button>
  </div>
</div>


<div id="echart" style="height: 400px; width: 100%;"></div>

<div id="tradingview-widget" style="display: none; height: 400px;">
  <iframe src="https://s.tradingview.com/widgetembed/?symbol=BINANCE:<?php echo strtoupper($coinsymbol); ?>USDT&interval=D&theme=light"
    width="100%" height="100%" frameborder="0" allowtransparency="true" scrolling="no"></iframe>
</div>



        
        		<div class="pb-3 mt-4">
			<div class="card-deck">
			<div class="card bg-light">
    			<div class="card-body">
      				<h6 class="card-title">1h</h6>
      				<p class="card-text">
      				    <span class="p-<?php echo $coin1h > 0 ? 'up':'down'?>">
      				    <i class="fa fa-caret-<?php echo $coin1h > 0 ? 'up':'down'?>"></i> <?php echo str_replace('-','',$coin1h)?>%</span>
      				    </p>
    			</div>
			</div>
<div class="card bg-light">
    			<div class="card-body">
      				<h6 class="card-title">24h</h6>
      				<p class="card-text">
      				    <span class="p-<?php echo $coinchange > 0 ? 'up':'down'?>">
      				    <i class="fa fa-caret-<?php echo $coinchange > 0 ? 'up':'down'?>"></i> <?php echo str_replace('-','',round($coinchange,2))?>%</span>
      				    </p>
    			</div>
			</div>
			
			<div class="card bg-light">
    			<div class="card-body">
      				<h6 class="card-title">7d</h6>
      				<p class="card-text">
      				    <span class="p-<?php echo $coin7d > 0 ? 'up':'down'?>">
      				    <i class="fa fa-caret-<?php echo $coin7d > 0 ? 'up':'down'?>"></i> <?php echo str_replace('-','',$coin7d)?>%</span>
      				    </p>
    			</div>
			</div>
			
			<div class="card bg-light">
    			<div class="card-body">
      				<h6 class="card-title">14d</h6>
      				<p class="card-text">
      				    <span class="p-<?php echo $coin14d > 0 ? 'up':'down'?>">
      				    <i class="fa fa-caret-<?php echo $coin14d > 0 ? 'up':'down'?>"></i> <?php echo str_replace('-','',$coin14d)?>%</span>
      				    </p>
    			</div>
			</div>
			
			<div class="card bg-light">
    			<div class="card-body">
      				<h6 class="card-title">30d</h6>
      				<p class="card-text">
      				    <span class="p-<?php echo $coin30d > 0 ? 'up':'down'?>">
      				    <i class="fa fa-caret-<?php echo $coin30d > 0 ? 'up':'down'?>"></i> <?php echo str_replace('-','',$coin30d)?>%</span>
      				    </p>
    			</div>
			</div>
			
			<div class="card bg-light">
    			<div class="card-body">
      				<h6 class="card-title">60d</h6>
      				<p class="card-text">
      				    <span class="p-<?php echo $coin60d > 0 ? 'up':'down'?>">
      				    <i class="fa fa-caret-<?php echo $coin60d > 0 ? 'up':'down'?>"></i> <?php echo str_replace('-','',$coin60d)?>%</span>
      				    </p>
    			</div>
			</div>
			
			<div class="card bg-light">
    			<div class="card-body">
      				<h6 class="card-title">200d</h6>
      				<p class="card-text">
      				    <span class="p-<?php echo $coin200d > 0 ? 'up':'down'?>">
      				    <i class="fa fa-caret-<?php echo $coin200d > 0 ? 'up':'down'?>"></i> <?php echo str_replace('-','',$coin200d)?>%</span>
      				    </p>
    			</div>
			</div>
			
			<div class="card bg-light">
    			<div class="card-body">
      				<h6 class="card-title">1y</h6>
      				<p class="card-text">
      				    <span class="p-<?php echo $coin1y > 0 ? 'up':'down'?>">
      				    <i class="fa fa-caret-<?php echo $coin1y > 0 ? 'up':'down'?>"></i> <?php echo str_replace('-','',$coin1y)?>%</span>
      				    </p>
    			</div>
			</div>

			</div>
		</div>

        	       <?php if (!empty($priceHistory) && !empty($priceHistory->prices)): ?>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-12 text-left">
                <div class="pb-4">
                    <h4 class="pt-3"><i class="fa fa-calendar"></i> <?php echo $coinname;?> Historical Data</h4>
                                <p class="lead pb-3">Historical data of <?php echo $coinname;?> past 365 days (00:00 UTC)</p>
                    
                    <table id="history-table" class="table table-striped table-bordered dt-responsive wrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Market Cap</th>
                                <th>Volume</th>
                                <th>Close</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($priceHistory->prices as $index => $coinPrice): 
                                $timestamp  = $coinPrice[0] / 1000;
                                $closePrice = $coinPrice[1];

                                $marketCap = isset($priceHistory->market_caps[$index][1]) ? $priceHistory->market_caps[$index][1] : 0;
                                $volume    = isset($priceHistory->total_volumes[$index][1]) ? $priceHistory->total_volumes[$index][1] : 0;
                            ?>
                                <tr>
                                    <td data-order="<?php echo $timestamp; ?>"><?php echo date('Y-m-d', $timestamp); ?></td>
                                    <td><?php echo strtok($convertSymbol, " "); ?><?php echo number_format($marketCap / $convertRate, 2); ?></td>
                                    <td><?php echo strtok($convertSymbol, " "); ?><?php echo number_format($volume / $convertRate, 2); ?></td>
                                    <td><?php echo strtok($convertSymbol, " "); ?><?php echo number_format($closePrice / $convertRate, 2); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    <p class="text-center">No historical data available for <?php echo ucfirst($coin_id); ?>.</p>
<?php endif; ?>

		<!-- End Coin Data  -->
        
        		<!-- Ad Code Bottom  -->
		<div class="py-4">
		<?php if($ads[0]['pref']==1 || $ads[0]['pref']==2) { ?>
            <div class="container">
               	<div class="row justify-content-center">
					<?php echo  $ads[0]['footer_ads']?>
                </div>    
			</div>
		<?php } ?>
		</div>
		</div>
        <!-- End Ad Code Bottom  -->
        
        <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 text-left">
        <div class="pb-4">
            <h4 class="pt-3"><i class="fa fa-exchange"></i> <?php echo $coinname;?> Markets</h4>
            <p class="lead pb-3">Compare live prices of <?php echo $coinname;?> on top exchanges.</p>
        	<table id="markets-table" class="table table-striped table-bordered dt-responsive wrap" cellspacing="0" width="100%">
			<thead>
            <tr>
                <th>#</th>
                <th>Exchange</th>
                <th>Pair</th>
                <th>Price</th>
                <th>Volume(24h)</th>
                <th>Trust Score</th>
            </tr>
			</thead>
			<tbody>
			    <?php
             setlocale(LC_MONETARY,"en_US");
             foreach ($coinmData->tickers as $res)
				{
					 ?>
				<tr>
					<td></td>
					<td><a href="<?php echo base_url(); ?>exchange/<?php echo $res->market->identifier; ?>"><span class="coin-name"><?php echo $res->market->name;?></span></a></td>
					<td><a class="coin-name" href="<?php echo $res->trade_url; ?>" target="_blank"><?php echo $res->base ?>/<?php echo $res->target; ?> <i class="fa fa-external-link"></i></a></td>
					<td data-sort="<?php echo $res->converted_last->usd;?>"><?php echo strtok($convertSymbol, " ");?><?php echo custom_prc_format($res->converted_last->usd/$convertRate); ?></td>
					<td data-sort="<?php echo $res->converted_volume->usd;?>"><?php echo strtok($convertSymbol, " ");?><?php echo number_format($res->converted_volume->usd/$convertRate); ?></td>
					<td>
  <?php
    $score = strtolower($res->trust_score ?? '');
    $colorClass = 'text-muted';
    $label = 'N/A';

    if ($score === 'green') {
        $colorClass = 'text-success';
    } elseif ($score === 'yellow') {
        $colorClass = 'text-warning';
    } elseif ($score === 'red') {
        $colorClass = 'text-danger';
    }

    echo '<center><i class="fa fa-circle ' . $colorClass . '"></i></center>';
  ?>
</td>
				</tr>
			<?php
		}
				?>
			    
			</tbody>
		   </table>
        </div>
        </div></div></div>
		<!-- End Coin Data  -->

<div class="container pb-5 pt-3">
    <h4 class="pt-3">About <?php echo $coinname;?></h4>
    <?php if (!empty($coinmData->description->en)): ?>
        <p><?php echo $coinmData->description->en; ?></p>
    <?php endif; ?>
</div>
   
<!-- News Section Start  -->
<div class="container pb-5">
<h4 class="pb-2">Cryptocurrency Latest News & Updates</h4>
<div class="card-deck">
   <?php
   $i=1;
             setlocale(LC_MONETARY,"en_US");
             foreach ($newsData->channel->item as $res)
				{
				    if($i>3)
				    continue;
					 ?>
<div style="padding-left:0px;padding-right:0px;" class="col-md-12">
<div style="margin-bottom:20px;" class="card">
<div class="row no-gutters">
<div class="col-md-3">
<img src="<?php echo $res->enclosure->{"@attributes"}->url;?>" width="100%;"></div>
<div class="col-md-9">
<div class="card-body">
<h6 class="card-title"><?php echo $res->title;?></h6>
<p><?php echo strip_tags(substr($res->description, 0, 500));?>...</p>
<a href="<?php echo $res->link;?>" class="btn btn-warning" target="_blank">Read More</a>
</div></div></div></div></div>
	<?php
	++$i;
		}
				?>
</div>  
<a href="<?php echo base_url(); ?>news" class="btn btn-warning btn-block">View More</a>
</div>   
<!-- News Section End  -->
        
        <!-- Donation Box  -->
        <?php $this->load->view('include/donation'); ?>
        <!-- End Donation Box  -->
 <!-- Chart Script  -->
<!-- Highcharts JS -->
<script>
function customPriceFormat(n) {
    if (n >= 1) {
        return n.toFixed(2);
    } else if (n >= 0.1) {
        return n.toFixed(3);
    } else if (n >= 0.01) {
        return n.toFixed(4);
    } else if (n >= 0.001) {
        return n.toFixed(6);
    } else if (n >= 0.0001) {
        return n.toFixed(8);
    } else {
        return n.toFixed(10);
    }
}

function customNumberFormat(n, precision = 2) {
    if (n < 1000) {
        return n.toLocaleString('en-US');
    } else if (n < 9000000) {
        return (n / 1000).toFixed(precision) + 'K';
    } else if (n < 900000000) {
        return (n / 1000000).toFixed(precision) + 'M';
    } else if (n < 900000000000) {
        return (n / 1000000000).toFixed(precision) + 'B';
    } else {
        return (n / 1000000000000).toFixed(precision) + 'T';
    }
}

</script>
<!-- Load amCharts 5 libraries -->
<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

<script>
var coinId = '<?php echo $coin; ?>';
var convertRate = <?php echo $convertRate; ?>;
var convertSymbol = '<?php echo strtok($convertSymbol, " "); ?>';

let rawData = {};
let currentField = 'prices';

am5.ready(function () {
  const root = am5.Root.new("echart");
  root.setThemes([am5themes_Animated.new(root)]);

  const chart = root.container.children.push(am5xy.XYChart.new(root, {
    panX: true,
    panY: false,
    wheelX: "panX",
    wheelY: "zoomX"
  }));
  
  chart.setAll({
  paddingLeft: 0,
  paddingRight: 0,
});

  const xAxis = chart.xAxes.push(am5xy.DateAxis.new(root, {
    baseInterval: { timeUnit: "day", count: 1 },
    renderer: am5xy.AxisRendererX.new(root, {})
  }));

// Create a custom NumberFormatter with your desired suffixes
const formatter = am5.NumberFormatter.new(root, {
  bigNumberPrefixes: [
    { number: 1e3, suffix: "K" },
    { number: 1e6, suffix: "M" },
    { number: 1e9, suffix: "B" },  // Replace default "G" with "B" here
    { number: 1e12, suffix: "T" }
  ]
});

// Assign this formatter to your axis
const yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
  renderer: am5xy.AxisRendererY.new(root, {}),
  numberFormatter: formatter,  // Set your custom formatter here
  numberFormat: "#a"           // Use abbreviation format
}));




const tooltip = am5.Tooltip.new(root, {
  pointerOrientation: "horizontal",
  labelText: "{valueY}",
  getFillFromSprite: false
});

tooltip.get("background").setAll({
  fill: am5.color(0xffffff),
  fillOpacity: 1,
  shadowColor: am5.color(0x000000),
  shadowBlur: 16,
  shadowOffsetX: 0,
  shadowOffsetY: 4,
  shadowOpacity: 0.75
});


tooltip.set("cornerRadius", 8);

  const series = chart.series.push(am5xy.LineSeries.new(root, {
    name: "Value",
    xAxis: xAxis,
    yAxis: yAxis,
    valueXField: "timestamp",
    valueYField: "value",
    tooltip: tooltip
  }));

  chart.set("cursor", am5xy.XYCursor.new(root, { behavior: "zoomX" }));

  fetch('<?php echo base_url('home/get_coin_price_json/'); ?>' + coinId)
    .then(res => res.json())
    .then(json => {
      rawData = json;
      updateChart('prices', '1Y');
    });

  function getRange(label) {
    const now = Date.now();
    const map = { '7D': 7, '1M': 30, '3M': 90, '1Y': 365 };
    return now - (map[label] * 86400000);
  }

  function updateChart(field = 'prices', rangeLabel = '1Y') {
    const start = getRange(rangeLabel);
    const now = Date.now();
    const source = rawData[field] || [];
    const volumes = rawData.total_volumes || [];

    const data = source.map((point, i) => {
      const ts = Number(point[0]);
      const rawVal = parseFloat(point[1]);
      const volVal = parseFloat(volumes[i]?.[1]);

      if (!ts || isNaN(ts) || isNaN(rawVal)) return null;
      if (ts < start) return null;

      return {
        timestamp: ts,
        value: rawVal / convertRate,
        volume: isNaN(volVal) ? 0 : volVal / convertRate
      };
    }).filter(item => item !== null);

    if (!data.length) return;

    series.data.setAll(data);
    
    // Apply visual styling like amCharts demo
series.strokes.template.setAll({
  strokeWidth: 2,
  stroke: am5.color(currentField === 'prices' ? 0x00b386 : 0x3b8beb)
});

series.fills.template.setAll({
  visible: true,
  fillOpacity: 0.2,
  fill: am5.color(currentField === 'prices' ? 0x00b386 : 0x3b8beb)
});


    series.get("tooltip").label.adapters.add("text", function (_, target) {
      const dataItem = target.dataItem;
      if (!dataItem) return "";

      const ts = dataItem.get("valueX");
      const date = new Date(ts);
      const value = dataItem.get("valueY");
      const volume = dataItem.dataContext.volume;

      const formattedValue =
  currentField === 'prices'
    ? customPriceFormat(value)
    : customNumberFormat(value);

      const formattedVolume = customNumberFormat(volume);

      return `${date.toLocaleString('en-US', {
  year: 'numeric',
  month: 'short',
  day: 'numeric',
  hour: '2-digit',
  minute: '2-digit',
  timeZoneName: 'short'
})}\n` +
             `${currentField === 'prices' ? 'Price' : 'Market Cap'}: [bold]${convertSymbol}${formattedValue}[/]\n` +
             `Volume: [bold]${convertSymbol}${formattedVolume}[/]`;
    });


  }

  document.querySelectorAll('.tab-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      const tab = btn.dataset.tab;
      if (tab === 'tradingview') {
        document.getElementById('echart').style.display = 'none';
        document.getElementById('range-switcher').style.display = 'none';
        document.getElementById('tradingview-widget').style.display = 'block';
      } else {
        currentField = tab === 'marketcap' ? 'market_caps' : 'prices';
        document.getElementById('echart').style.display = 'block';
        document.getElementById('range-switcher').style.display = 'flex';
        document.getElementById('tradingview-widget').style.display = 'none';
        const activeRange = document.querySelector('.range-btn.active')?.dataset.range || '1Y';
        updateChart(currentField, activeRange);
      }
    });
  });

  document.querySelectorAll('.range-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      document.querySelectorAll('.range-btn').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      updateChart(currentField, btn.dataset.range);
    });
  });
});
</script>

<script type="text/javascript">
$(document).ready(function() {
    $.noConflict();

    // Initialize Markets Table
    var marketsTable = $('#markets-table').DataTable({
        "columnDefs": [{
            "searchable": false,
            "orderable": false,
            "targets": 0
        }],
        "order": [[4, "desc"]],
        "pageLength": 10,
        "lengthChange": false,
        "pagingType": "numbers",
        "bInfo": false,
        "bProcessing": true,
        "bDeferRender": true
    });

    marketsTable.on('order.dt search.dt', function() {
        marketsTable.column(0, { search: 'applied', order: 'applied' }).nodes().each(function(cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();

    // Initialize Historical Data Table
    $('#history-table').DataTable({
        "searching": false,
        "lengthChange": false,
        "order": [[0, "desc"]],
        "pageLength": 10,
        "pagingType": "numbers",
        "bInfo": false,
        "bProcessing": true,
        "bDeferRender": true
    });
});
</script>
<script type="text/javascript">
    var base_url = '<?php echo base_url(); ?>';
</script>
<script>
$(document).ready(function() {
    $('#watchlist-action').on('click', function(e) {
        e.preventDefault();
        var action = $(this).data('action');
        var coin = $(this).data('coin');
        var url = action === 'add' ? base_url + '/watchlist/add/' + coin : base_url + '/watchlist/remove/' + coin;

        $.ajax({
            url: url,
            type: 'POST',
            success: function(response) {
                if (action === 'add') {
                    $('#watchlist-action').data('action', 'remove').find('span').css('border', '1px solid red').css('color', 'red').text('Remove from Watchlist');
                } else {
                    $('#watchlist-action').data('action', 'add').find('span').css('border', '1px solid green').css('color', 'green').text('Add to Watchlist');
                }
            },
            error: function() {
                alert('There was an error updating your watchlist. Please try again.');
            }
        });
    });
});
</script>
<style>
    .increment {
        background-color: green;
        color: #fff;
        border-radius:5px;
        padding:0px 5px 0px 5px;
    }
    .decrement {
        background-color: red;
        color: #fff;
        border-radius:5px;
        padding:0px 5px 0px 5px;
    }
</style>

<script>
    var formatter = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: "<?php echo $convertCode;?>",
        minimumFractionDigits: 2,
    });

    var convertRate = <?php echo $convertRate; ?>;
    let previousPrice = null;

    const wsUrl = "wss://stream.binance.com:9443/ws/<?php echo strtolower($coinmData->symbol); ?>usdt@ticker";
    const coinPriceWs = new WebSocket(wsUrl);

    coinPriceWs.onmessage = function (msg) {
        const data = JSON.parse(msg.data);
        const priceValue = parseFloat(data.c);  // USDT price

        const convertedPrice = priceValue / convertRate;
        const formattedPrice = formatter.format(convertedPrice);

        const priceElement = document.getElementById('coin_price');

        if (previousPrice !== null) {
            const directionClass = priceValue > previousPrice ? 'increment' : (priceValue < previousPrice ? 'decrement' : '');

            if (directionClass) {
                priceElement.classList.remove('increment', 'decrement');
                priceElement.classList.add(directionClass);

                setTimeout(() => {
                    priceElement.classList.remove('increment', 'decrement');
                }, 300);
            }
        }

        priceElement.innerHTML = formattedPrice;
        previousPrice = priceValue;
    };
</script>



<script src="<?php echo base_url(); ?>assets/js/front/jquery-3.3.1.slim.min.js"></script>
<?php $this->load->view('include/footer'); ?>