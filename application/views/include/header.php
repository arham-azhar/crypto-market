<!DOCTYPE>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo $pageDescription;?>">
    <meta name="author" content="">
    <!-- google verify code if any -->
    <?php if(!empty($settingData[0]['google_verify']) && (strpos($settingData[0]['google_verify'], '<meta') !== false)) { 	echo $settingData[0]['google_verify']; } ?>
    <!-- bing verify code if any -->
	<?php if(!empty($settingData[0]['bing_verify'])  && (strpos($settingData[0]['bing_verify'], '<meta') !== false)) { 	echo $settingData[0]['bing_verify']; } ?>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>upload/<?php echo $settingData[0]['fevicon']?>">
    <title><?php echo $pageTitle;?></title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/front/bootstrap.min.css">
	<?php if($settingData[0]['site_layout']==1) { ?> 
        <link href="<?php echo base_url(); ?>assets/css/front/style-yellow.css" rel="stylesheet">
	<?php } else if($settingData[0]['site_layout']==2) { ?>
	    <link href="<?php echo base_url(); ?>assets/css/front/style-lightgreen.css" rel="stylesheet">
	<?php }  else if($settingData[0]['site_layout']==3) { ?>
	    <link href="<?php echo base_url(); ?>assets/css/front/style-red.css" rel="stylesheet">
	<?php }  else if($settingData[0]['site_layout']==4) { ?>
		<link href="<?php echo base_url(); ?>assets/css/front/style-navy.css" rel="stylesheet">
	<?php }  else if($settingData[0]['site_layout']==5) { ?>
		<link href="<?php echo base_url(); ?>assets/css/front/style-cyan.css" rel="stylesheet">
	<?php }  else if($settingData[0]['site_layout']==6) { ?>
		<link href="<?php echo base_url(); ?>assets/css/front/style-white-cyan.css" rel="stylesheet">
	<?php }  else if($settingData[0]['site_layout']==7) { ?>
		<link href="<?php echo base_url(); ?>assets/css/front/style-white-blue.css" rel="stylesheet">
	<?php }  else if($settingData[0]['site_layout']==8) { ?>
		<link href="<?php echo base_url(); ?>assets/css/front/style-white-green.css" rel="stylesheet">
	<?php }  else if($settingData[0]['site_layout']==9) { ?>
		<link href="<?php echo base_url(); ?>assets/css/front/style-white-red.css" rel="stylesheet">
	<?php }  else { ?>
	    <link href="<?php echo base_url(); ?>assets/css/front/style-white-black.css" rel="stylesheet">
	<?php } ?>
    <script  type="text/javascript" src="<?php echo base_url(); ?>assets/js/front/jquery-1.12.4.js" > </script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" defer></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<!-- google analytic code if any -->
<?php if(!empty($settingData[0]['google_analytic']) && (strpos($settingData[0]['google_analytic'], '<script>') !== false) && (strpos($settingData[0]['google_analytic'], '</script>') !== false)) { 	echo $settingData[0]['google_analytic'];  } ?>
<?php if(!empty($settingData[0]['custom_css'])) { 	echo '<style>'. $settingData[0]['custom_css'] .'</style>';  } ?>
</head>
<body class="">
	<?php if($settingData[0]['header_top']==1) { ?> 
	<div class="preheader">
	<div class="container">
	<div class="row ptop">
	<div class="col">
	    <ul style="padding-left:0px;">
	        <li><small class="text-top-small"><span>Cryptos</span> <?php echo $coingData->data->active_cryptocurrencies;?></small></li>
	        <li><small class="text-top-small"><span>Exchanges</span> <?php echo $coingData->data->markets;?></small></li>
	    	<li><small class="text-top-small"><span>Market Cap</span> <?php echo strtok($convertSymbol, " ");?><?php echo custom_number_format($coingData->data->total_market_cap->usd/$convertRate);?> <span class="p-<?php echo $coingData->data->market_cap_change_percentage_24h_usd > 0 ? 'up':'down'?>"><i class="fa fa-caret-<?php echo $coingData->data->market_cap_change_percentage_24h_usd > 0 ? 'up':'down'?>"></i> <?php echo str_replace('-','',round($coingData->data->market_cap_change_percentage_24h_usd,2))?>%</span></small></li>
	        <li><small class="text-top-small"><span>24h Vol</span> <?php echo strtok($convertSymbol, " ");?><?php echo custom_number_format($coingData->data->total_volume->usd/$convertRate);?></small></li>
	        <li><small class="text-top-small"><span>Dominance</span> BTC <?php echo number_format($btcCap/$coingData->data->total_market_cap->usd*100, 1);?>% ETH <?php echo number_format($ethCap/$coingData->data->total_market_cap->usd*100, 1);?>%</small></li>
	    </ul>
    </div>
    <span style="font-weight:bold;font-size:16px;">
        <select class="form-control js-example-basic-price" id="from_fiat">
            <?php foreach ($priceData->data as $res) { ?>
            <option value="<?php echo $res->rateUsd; ?>" data-symbol="<?php echo $res->currencySymbol; ?>" data-code="<?php echo $res->symbol; ?>" <?php if ($res->symbol == $convertCode) echo "Selected"; ?>><?php echo $res->symbol;?></option>
                <?php } ?>
        </select>
  
<script type="text/javascript">
$(document).ready(function() {
    $('.js-example-basic-price').select2();
});
</script>
<script>
$(document).ready(function() {
    $("#from_fiat").change(function() {
        var rate = $("#from_fiat").val();
        var symbol = $(this).find('option:selected').data('symbol');  // $ or ₹
        var code = $(this).find('option:selected').data('code');      // USD or INR
		 $.ajax({
            url: '<?=base_url();?>home/set_rate',
            type: 'POST',
            data: {rate : rate, symbol : symbol, code: code},
            success: function() {
                 location.reload();
            }
        });
    });
});
</script>
</span>
	   <span style="margin-top:2px; margin-left:10px; margin-right:15px;">
        <a onclick="myFunction()" id="Knop"> 
        <div id="toggleknop"><i style="font-weight:bold;font-size:16px;" class="fa fa-moon-o"></i></div>
        </a>
<script>
function myFunction() {
   var element = document.body;
   element.classList.toggle("dark-mode");
   document.getElementById('toggleknop').innerHTML = document.body.classList.contains('dark-mode') ? '<i style="font-weight:bold;font-size:16px;" class="fa fa-sun-o"></i>' : '<i style="font-weight:bold;font-size:16px;" class="fa fa-moon-o"></i>';
 	if (document.body.classList.contains('dark-mode'))
         localStorage.setItem('mode', 'dark-mode');
       else
   localStorage.setItem('mode', '');
}
$(document).ready(function($) {
 var mode = localStorage.getItem('mode');
  if (mode) 
  {
	document.getElementById('toggleknop').innerHTML = '<i style="font-weight:bold;font-size:16px;" class="fa fa-sun-o"></i>';
  	$('body').addClass(mode); 
  }
});
</script>
</span>
</div></div></div>
	<?php } ?>
	<div class="header">
        <div class="container">
            <nav class="navbar navbar-expand-lg h2-nav">
                <a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>upload/<?php echo $settingData[0]['logo']  ?>" alt="logo" /></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#header1" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                       <span class="ti-menu">&#9776;</span>
                    </button>
                        <div class="collapse navbar-collapse" id="header1">
                            <ul class="navbar-nav ml-auto">
                             <!-- 	<li class="nav-item active"><a class="nav-link" href="<?php echo base_url(); ?>">Home</a></li> -->
                              	<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>">Coins</a></li>
                                <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>exchanges">Exchanges</a></li>	
								<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>top-gainer-coins">Top Gainers</a></li>	
                              	 <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>top-loser-coins">Top Losers</a></li>
                              	 <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>calculator">Calculator</a></li>
                              	 <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>watchlist">Watchlist</a></li>
                              	 <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>news">News</a></li>
                                <li class="nav-item last"><a target = '_blank' class="btn btn-outline-info" href="<?php echo $settingData[0]['buy_sell'] ?>">BUY / SELL</a></li>
                            </ul>
                        </div>
            </nav>
        </div> 
    </div>