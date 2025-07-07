<?php $this->load->view('include/header'); ?>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" ></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js" ></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js" ></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.1/js/responsive.bootstrap4.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.bootstrap4.min.css"/> 
<script type="text/javascript">
    $(document).ready(function() {
        $.noConflict();
        var table = $('#coins-info-table').DataTable({
            "order": [0, 'asc'],
            "pageLength": 10,
            lengthChange: false,
            "bInfo": false,
            "bProcessing": true,
            "bDeferRender": true,
            "pagingType": "numbers",
        });

        // Function to render sparklines in visible rows
        function renderSparklines() {
         $('.sparkline').each(function () {
            const values = $(this).data('values').toString().split(',').map(parseFloat);
            if (values.length < 2) return;

            const color = values[values.length - 1] >= values[0] ? '#28a745' : '#dc3545';

            $(this).sparkline(values, {
                type: 'line',
                width: '100',
                height: '30',
                lineColor: color,
                fillColor: false,
                spotRadius: 1,
                lineWidth: 1,
                disableInteraction: true,
                tooltipFormatter: () => ''
            });
        });
        }

        // Initial render
        renderSparklines();

        // Re-render on table redraw (pagination, search, etc.)
        table.on('draw', function() {
            renderSparklines();
        });
    });
</script>

 <?php
	function custom_number_format($n, $precision = 2) {
        if ($n < 100000) {
        // Default
         $n_format = number_format($n);
        } else if ($n < 9000000) {
        // Thousand
        $n_format = number_format($n / 1000, $precision, '.', ''). 'K';
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
<div class="page-title py-3">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12 text-center">
        <h1>
          Follow Your Favourite Cryptocurrencies
        </h1>
        <h6 class="pb-3">
          Track your favorite cryptocurrencies with ease. Stay updated on the latest prices, market capitalization, and performance of your selected coins all in one place. The coins in the watchlist stays for 30 days and watchlist does not work in incognito mode of the browser.
        </h6>

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
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12 text-left">
      <div class="py-2">

        <?php if (!empty($watchlist)): ?>
          <table id="coins-info-table" class="table table-striped table-bordered dt-responsive wrap" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Price</th>
                <th>24h</th>
                <th>1h</th>
                <th>7d</th>
                <th>Volume(24h)</th>
                <th>Market Cap</th>
                <th>Last 7 Days</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($watchlist as $coin_name): ?>
                <?php
                $coinFound = false;
                foreach ($coinWData as $res) {
                    if ($res->id == $coin_name) {
                        $coinFound = true;
                        break;
                    }
                }

                if (!$coinFound && isset($fallbackCoinData[$coin_name])) {
                    $res = $fallbackCoinData[$coin_name];
                }

                if (!empty($res)):
                    $coinrank = $res->market_cap_rank ?? $res->rank ?? '-';
                    $coinname = $res->name ?? $coin_name;
                    $coinImage = $res->image->large ?? $res->image ?? '';
                    $coinprice = $res->market_data->current_price->usd ?? $res->current_price ?? 0;
                    $coinsymbol = $res->symbol ?? $coin_name;
                    $coinmcap = $res->market_data->market_cap->usd ?? $res->market_cap ?? 0;
                    $coinchange = $res->market_data->price_change_percentage_24h ?? $res->price_change_percentage_24h ?? 0;
                    $coinvolume = $res->market_data->total_volume->usd ?? $res->total_volume ?? 0;
                    $coinsupply = $res->market_data->total_supply ?? $res->total_supply ?? 0;
                    $coincode = $res->id;
                    $coin1h = round($res->market_data->price_change_percentage_1h_in_currency->usd ?? $res->price_change_percentage_1h_in_currency ?? 0, 2);
                    $coin7d = round($res->market_data->price_change_percentage_7d_in_currency->usd ?? $res->price_change_percentage_7d_in_currency ?? 0, 2);
                    $sparkline = !empty($res->market_data->sparkline_7d->price) 
                        ? implode(",", $res->market_data->sparkline_7d->price) 
                        : (isset($res->sparkline_in_7d->price) 
                            ? implode(",", $res->sparkline_in_7d->price) 
                            : '');
                ?>
                  <tr id="BTC_<?php echo $coinsymbol; ?>">
                    <td><a href="<?= site_url('watchlist/remove/' . $coin_name) ?>"><i class="fa fa-star" title="Remove from Watchlist"></i></a> <?php echo $coinrank; ?></td>
                    <td><img src="<?php echo str_replace('/large/', '/small/', $coinImage); ?>"><a href="<?php echo base_url() ?>coin/<?php echo $coincode; ?>"><span class="coin-name"><?php echo $coinname; ?></span></a> <span class="badge badge-warning"><?php echo strtoupper($coinsymbol); ?></span></td>
                    <td class="price" data-sort="<?php echo $coinprice; ?>"><?php echo strtok($convertSymbol, " "); ?><?php echo custom_prc_format($coinprice / $convertRate); ?></td>
                    <td data-sort="<?php echo $coinchange; ?>"><span class="p-<?php echo $coinchange > 0 ? 'up' : 'down' ?>"><i class="fa fa-caret-<?php echo $coinchange > 0 ? 'up' : 'down' ?>"></i> <?php echo str_replace('-', '', round($coinchange, 2)); ?>%</span></td>
                    <td data-sort="<?php echo $coin1h; ?>"><span class="p-<?php echo $coin1h > 0 ? 'up' : 'down' ?>"><i class="fa fa-caret-<?php echo $coin1h > 0 ? 'up' : 'down' ?>"></i> <?php echo str_replace('-', '', round($coin1h, 2)); ?>%</span></td>
                    <td data-sort="<?php echo $coin7d; ?>"><span class="p-<?php echo $coin7d > 0 ? 'up' : 'down' ?>"><i class="fa fa-caret-<?php echo $coin7d > 0 ? 'up' : 'down' ?>"></i> <?php echo str_replace('-', '', round($coin7d, 2)); ?>%</span></td>
                    <td data-sort="<?php echo $coinvolume; ?>"><?php echo strtok($convertSymbol, " "); ?><?php echo custom_number_format($coinvolume / $convertRate); ?></td>
                    <td data-sort="<?php echo $coinmcap; ?>"><?php echo strtok($convertSymbol, " "); ?><?php echo custom_number_format($coinmcap / $convertRate); ?></td>
                    <td><span class="sparkline" data-values="<?php echo $sparkline; ?>"></span></td>
                  </tr>
                <?php endif; ?>
              <?php endforeach; ?>
            </tbody>
          </table>
        <?php else: ?>
          <div class="alert alert-danger text-center">
            Your watchlist is currently empty. Start adding your favorite cryptocurrencies to track their prices, market capitalization, and performance all in one place.
          </div>
        <?php endif; ?>

      </div>
    </div>
  </div>
</div>



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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-sparklines/2.1.2/jquery.sparkline.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/front/jquery-3.3.1.slim.min.js"></script>
<?php $this->load->view('include/footer'); ?>
