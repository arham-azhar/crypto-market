<?php $this->load->view('include/header'); ?>
<?php	function custom_number_format($n, $precision = 2) {
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
		} ?>
<div class="page-title py-3">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12 text-center">
        <h1>
          Cryptocurrency Calculator And Converter Tool
        </h1>
        <h6 class="pb-3">
           Crypto calculator helps you convert prices between two currencies in real time. You can convert prices for top 250 cryptocurrency to fiat currency. To convert more crypto prices, visit the coin single page.
        </h6>
                <div class="pb-3">
        <a target = '_blank' href="<?php echo $settingData[0]['buy_sell'] ?>" class="btn btn-outline-dark btn-lg">
            Start Crypto Trading
        </a>
        </div>
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
<!-- Calculator Start  -->
<div class="container">
 <div class="row">
<div class="col-md-6 mb-3">
 <input type="number" class="form-control" id="from_ammount" placeholder="Enter Amount To Convert" value=10 />
 </div></div>

 <div class="row">
 <div class="col-md-6">
 <select class="form-control js-example-basic-single" id="from_currency" onchange=calculate();>
 <?php foreach ($coinListtData as $res) { ?>
		<option value="<?php echo $res->current_price; ?>"><?php echo $res->name.' ('.strtoupper($res->symbol).')'; ?></option>
 <?php } ?>
 </select>
</div>

<div class="col-md-6">
  <select class="form-control js-example-basic-single" id="to_currency" onchange="calculate();">
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
const from_ammountEl = document.getElementById('from_ammount');
const to_currencyEl = document.getElementById('to_currency');
const to_ammountEl = document.getElementById('to_ammount');

from_ammountEl.addEventListener('input', calculate);
to_ammountEl.addEventListener('input', calculate);

function calculate() {
    var fromSymbol = $('#from_currency option:selected').text();
    var toSymbol = $('#to_currency option:selected').data('symbol');
    var convertedValue = from_ammountEl.value * from_currencyEl.value / to_currencyEl.value;
    var formattedValue = custom_prc_format(convertedValue);
    to_ammountEl.innerText = 
    from_ammountEl.value + ' ' + fromSymbol + ' = ' +
    toSymbol + formattedValue;
}
calculate();


</script>

        </div>        
<!-- Calculator End  -->
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
<!-- End Ad Code Bottom  -->   

<!-- News Section Start  -->
<div class="container pt-3 pb-5">
<h2 class="pb-2">Cryptocurrency Latest News & Updates</h2>
<div class="card-deck">
   <?php
   $i=1;
             setlocale(LC_MONETARY,"en_US");
             foreach ($newsData->channel->item as $res)
				{
				    if($i>3)
				    continue; 
					 ?>
<div style="padding-left:0px;padding-right:0px;" class="col-md-4">
<div style="margin-bottom:20px;padding-left:0px;padding-right:0px;min-height:500px;" class="card">
<img src="<?php echo $res->enclosure->{"@attributes"}->url;?>" class="card-img-left">
<div class="card-body">
<span class="badge linking"> <?php echo substr($res->pubDate, 0, 16);?> </span>
<h6 class="card-title"><?php echo $res->title;?></h6>
<p><?php echo strip_tags(substr($res->description, 0, 450));?>...</p>
<a href="<?php echo $res->link;?>" class="btn btn-warning" target="_blank">Read More</a>
</div></div></div>
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
	
<?php $this->load->view('include/footer'); ?>