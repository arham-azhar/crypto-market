<?php $this->load->view('include/header'); ?>
<?php setlocale(LC_MONETARY,"en_US"); ?>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"  ></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.1/js/responsive.bootstrap4.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.bootstrap4.min.css"/>
<script type="text/javascript">
		$(document).ready(function() {
		$.noConflict();
		$('#coins-info-table').dataTable( {
          "order":  [[ 0, "asc" ]],
          "pageLength": 10,
          "lengthChange": false,
          "searching": true,
          "pagingType": "numbers",
          "bPaginate":true,
          "bInfo" : false,
          "bProcessing": true,
		 "bDeferRender": true,
          
		} );
		} );
	</script>
<?php
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
		 function custom_vol_format($n) {
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

        $exchangename   = $exchangemData->name;
        $exchangeimage   = $exchangemData->image;
        $exchangeurl    = $exchangemData->url;
        $exchangeyear    = $exchangemData->year_established;
        $exchangecountry    = $exchangemData->country;
        $exchangerank   = $exchangemData->trust_score_rank;
        $exchangetvol   = $exchangemData->trade_volume_24h_btc;
        $exchangevol    = $exchangemData->trade_volume_24h_btc_normalized;

?>
                <div class="page-title py-3">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-12 text-left">
                                <h1><?php echo $exchangename;?> Exchange & Trading Pairs Info</h1>
                                     
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
			  <img class="mr-3" src="<?php echo $exchangeimage;?>">
			    <div class="align-self-center media-body">
				  <h2 class="font-weight-bold" style="margin-bottom:0px;"><?php echo $exchangename;?> <span class="badge badge-success align-middle" style="margin-top:-0.3em;"><?php if(isset($exchangerank)) echo '#'.$exchangerank; else echo 'N/A';?></span></h2>
 				  <h1 style="margin-bottom:0;"><span id="coin_price"><?php echo strtok($convertSymbol, " ");?><?php echo number_format($exchangetvol*$btcPrice/$convertRate);?></span> <small class="text-muted">(24h Volume)</small></h1>
				</div>
			</div>
	<div class="container"><div class="row pt-4">
<?php if ($exchangemData->facebook_url != "") { ?>		
<a href="<?php echo $exchangemData->facebook_url; ?>" target="_blank"><span class="badge linking"><i class="fa fa-facebook"></i> Facebook <i class="fa fa-external-link"></i></span></a>
<?php } ?>
<?php if ($exchangemData->reddit_url != "") { ?>		
<a href="<?php echo $exchangemData->reddit_url; ?>" target="_blank"><span class="badge linking"><i class="fa fa-reddit"></i> Reddit <i class="fa fa-external-link"></i></span></a>
<?php } ?>
<?php if ($exchangemData->telegram_url != "") { ?>		
<a href="<?php echo $exchangemData->telegram_url; ?>" target="_blank"><span class="badge linking"><i class="fa fa-telegram"></i> Telegram <i class="fa fa-external-link"></i></span></a>
<?php } ?>
<?php if ($exchangemData->slack_url != "") { ?>		
<a href="<?php echo $exchangemData->slack_url; ?>" target="_blank"><span class="badge linking"><i class="fa fa-slack"></i> Slack <i class="fa fa-external-link"></i></span></a>
<?php } ?>
<?php if ($exchangemData->other_url_1 != "") { ?>		
<a href="<?php echo $exchangemData->other_url_1; ?>" target="_blank"><span class="badge linking"><i class="fa fa-medium"></i> medium.com <i class="fa fa-external-link"></i></span></a>
<?php } ?>
<?php if ($exchangemData->other_url_2 != "") { ?>		
<a href="<?php echo $exchangemData->other_url_2; ?>" target="_blank"><span class="badge linking"><i class="fa fa-globe"></i> steemit.com <i class="fa fa-external-link"></i></span></a>
<?php } ?>
<?php if ($exchangemData->twitter_handle != "") { ?>		
<a href="https://x.com/<?php echo $exchangemData->twitter_handle; ?>" target="_blank"><span class="badge linking"><i class="fa fa-twitter"></i> Twitter <i class="fa fa-external-link"></i></span></a>
<?php } ?>
</div></div>
        <div class="pt-3 pb-2">
					<h4><i class="fa fa-eye"></i> Exchange Overview</h4>
					<p><?php if ($exchangemData->description != "") { ?><?php echo $exchangemData->description; ?> <?php } ?></p>
					<p><span class="font-weight-bold"><?php echo $exchangename;?></span> exchange is established in <span class="font-weight-bold"><?php echo $exchangeyear ?></span> and is registered in <span class="font-weight-bold"><?php echo $exchangecountry ?></span>. The exchange 24 hours trading volume is <span class="font-weight-bold" id="price_coin"><?php echo strtok($convertSymbol, " ");?><?php echo number_format($exchangetvol*$btcPrice/$convertRate);?></span>. There are <span class="font-weight-bold"><?php if(isset($exchangemData->coins)) echo $exchangemData->coins; else echo '(Not Available)';?></span> coins and <span class="font-weight-bold"><?php if(isset($exchangemData->pairs)) echo $exchangemData->pairs; else echo '(Not Available)';?></span> trading pairs are available on the exchange. <span class="font-weight-bold"><?php echo $exchangename;?></span> exchangee secured <span class="font-weight-bold">Rank <?php if(isset($exchangerank)) echo $exchangerank; else echo '(Not Available)';?></span> in the cryptocurrency exchange market.</p>
					<hr>
					<p>Live <span class="font-weight-bold"><?php echo $exchangename;?></span> exchange markets data. Stay up to date with the latest crypto trading price movements on <span class="font-weight-bold"><?php echo $exchangeData->name;?></span> exchange. Check our exchange market data and see when there is an opportunity to buy or sell <span class="font-weight-bold">cryptocurrency</span> at best price in the market.</p>
				</div>
			
		<div class="row">
			<div class="col-sm">
				<a target = '_blank' href="<?php echo $exchangeurl; ?>" class="btn btn-dark btn-block mb-1"><i class="fa fa-link"></i> Official <?php echo $exchangename;?> Website</a>
			</div>
			<div class="col-sm">
			<a target = '_blank' href="<?php echo $settingData[0]['buy_sell'] ?>" class="btn btn-warning btn-block"><i class="fa fa-cart-plus"></i> Start Crypto Trading</a>
			</div>
		</div>
		
		<div class="pt-4 pb-3">
			<div class="card-deck">
				<?php		$score = isset($exchangemData->trust_score) ? $exchangemData->trust_score : null;
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
        } ?>
				<div class="card bg-light">
				<div class="card-body">
      				<h5 class="card-title">Trust Score</h5>
      				<p class="card-text"><span class="<?php echo $score_class ?> px-2 py-1 rounded d-inline-block"><?php echo $score_text ?></span></p>
    			</div>
			</div>
			
				<div class="card bg-light">
				<div class="card-body">
      				<h5 class="card-title">Year Established</h5>
      				<p class="card-text"><?php echo $exchangeyear ?></p>
    			</div>
			</div>
			
				<div class="card bg-light">
				<div class="card-body">
      				<h5 class="card-title">Incorporation Country</h5>
      				<p class="card-text"><?php echo $exchangecountry ?></p>
    			</div>
			</div>
			
			      		<div class="card bg-light">
    			<div class="card-body">
      				<h5 class="card-title">Coins #</h5>
      				<p class="card-text"><?php if(isset($exchangemData->coins)) echo $exchangemData->coins; else echo 'N/A';?></p>
    			</div>
			</div>
			
					<div class="card bg-light">
    			<div class="card-body">
      				<h5 class="card-title">Pairs #</h5>
      				<p class="card-text"><?php if(isset($exchangemData->pairs)) echo $exchangemData->pairs; else echo 'N/A';?></p>
    			</div>
			</div>


			</div>
		</div>
        <div class="card-deck">
        			<div class="card bg-light">
    			<div class="card-body">
    			 <h5 class="card-title">Volume(24h)</h5>
      				<p class="card-text mb-1"><?php echo strtok($convertSymbol, " ");?><?php echo number_format($exchangetvol*$btcPrice/$convertRate);?></p>
      				<small><span class="bg-warning px-2 py-1 rounded d-inline-block"><b><?php echo number_format($exchangetvol);?> BTC</b></span></small>
    			</div>
			</div>
			      		<div class="card bg-light">
				<div class="card-body">
      				<h5 class="card-title">Volume(24h) Normalized</h5>
      				<p class="card-text mb-1"><?php echo strtok($convertSymbol, " ");?><?php echo number_format($exchangevol*$btcPrice/$convertRate);?></p>
      				<small><span class="bg-warning px-2 py-1 rounded d-inline-block"><b><?php echo number_format($exchangevol);?> BTC</b></span></small>
    			</div>
			</div>
			</div>
        		<!-- Price Chart  -->
        		<style>
.chart-range {
  display: flex;
  gap: 6px;
  margin-bottom: 20px;
}

.chart-range .range-btn {
  padding: 6px 14px;
  border: 1px solid #ddd;
  background-color: #fff;
  font-size: 14px;
  border-radius: 4px;
  cursor: pointer;
  color: #333;
  transition: all 0.2s ease;
}

.chart-range .range-btn.active {
  background-color: #f0f5ff;
  border-color: #3b8beb;
  color: #3b8beb;
  font-weight: 600;
}
</style>
<h4 class="pt-5 pb-3"><i class="fa fa-area-chart"></i> <?php echo $exchangename;?> Exchange Trade Volume</h4>

<div class="chart-range" id="range-switcher">
  <button class="range-btn" data-range="7D">7D</button>
  <button class="range-btn" data-range="14D">14D</button>
  <button class="range-btn" data-range="1M">1M</button>
  <button class="range-btn" data-range="3M">3M</button>
  <button class="range-btn active" data-range="1Y">1Y</button>
</div>
<div id="exchange-volume-chart" style="width:100%; height:400px;"></div>

        <!-- End Price Chart  -->
        
		<!-- Ad Code Bottom  -->
		<div class="pt-4 pb-4">
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
        		<div class="pb-5">
        		    <h4 class="py-3"><i class="fa fa-exchange"></i> <?php echo $exchangename; ?> Spot Markets</h4>
		<!-- End Coin Data  -->
		<table id="coins-info-table" class="table table-striped table-bordered dt-responsive wrap" cellspacing="0" width="100%">
			<thead>
            <tr>
                <th>#</th>
                <th>Currency</th>
                <th>Pair</th>
                <th>Price</th>
                <th>Volume(24h)</th>
                <th>Trust Score</th>
            </tr>
			</thead>
			
						<tbody>
			    <?php
             setlocale(LC_MONETARY,"en_US");
             $i = 1;
             foreach ($exchangemData->tickers as $res)
				{
					 ?>
				
				<tr>
					<td><?php echo $i++;?></td>
					<td><a href="<?php echo base_url(); ?>coin/<?php echo $res->coin_id; ?>"><span class="coin-name"><?php echo ucwords(strtolower(str_replace('-',' ',$res->coin_id))); ?></span></a></td>
					<td><a class="coin-name" href="<?php echo $res->trade_url; ?>" target="_blank"><?php echo $res->base; ?>/<?php echo $res->target; ?> <i class="fa fa-external-link"></i></a></td>
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

<!-- News Section Start  -->
<div class="container pb-5">
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
        <script>
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
 <!-- Chart Script  -->
<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

<script>
  (function() {
    const exchangeId = "<?php echo $exchange; ?>";
    const btcPrice = <?php echo $btcPrice; ?>;            // current BTC price in target currency
    const convertRate = <?php echo $convertRate; ?>;      // conversion rate from your PHP
    const convertSymbol = '<?php echo strtok($convertSymbol, " "); ?>';  // e.g. "$"

    am5.ready(function() {
      const root = am5.Root.new("exchange-volume-chart");

      root.setThemes([am5themes_Animated.new(root)]);

      const chart = root.container.children.push(
        am5xy.XYChart.new(root, {
          panX: true,
          panY: false,
          wheelX: "panX",
          wheelY: "zoomX",
          layout: root.verticalLayout
        })
      );

      chart.setAll({
        paddingLeft: 0,
        paddingRight: 0,
      });

      const xAxis = chart.xAxes.push(
        am5xy.DateAxis.new(root, {
          maxDeviation: 0.2,
          baseInterval: { timeUnit: "day", count: 1 },
          renderer: am5xy.AxisRendererX.new(root, {})
        })
      );
const formatter = am5.NumberFormatter.new(root, {
  bigNumberPrefixes: [
    { number: 1e3, suffix: "K" },
    { number: 1e6, suffix: "M" },
    { number: 1e9, suffix: "B" },  // Replace default "G" with "B" here
    { number: 1e12, suffix: "T" }
  ]
});
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

      const series = chart.series.push(
        am5xy.LineSeries.new(root, {
          name: "Volume",
          xAxis: xAxis,
          yAxis: yAxis,
          valueYField: "value",
          valueXField: "timestamp",
          tooltip: tooltip
        })
      );

      

      series.get("tooltip").label.adapters.add("text", function(text, target) {
        const dataItem = target.dataItem;
        if (!dataItem) return "";

        const ts = dataItem.get("valueX");
        const date = new Date(ts);
        const value = dataItem.get("valueY");
        const formattedValue = customNumberFormat(value);

        return date.toLocaleString('en-US', {
          year: 'numeric',
          month: 'short',
          day: 'numeric',
          hour: '2-digit',
          minute: '2-digit',
          timeZoneName: 'short'
        }) + "\n" +
          `Volume: [bold]${convertSymbol}${formattedValue}[/]`;
      });

      let allData = [];

      function filterData(days) {
        const cutoff = Date.now() - days * 86400000;
        const filtered = allData.filter(d => d.timestamp >= cutoff);
        series.data.setAll(filtered);
        series.strokes.template.setAll({
        strokeWidth: 2,
        stroke: am5.color(0x00b386)
      });

      series.fills.template.setAll({
        visible: true,
        fillOpacity: 0.2,
        fill: am5.color(0x00b386)
      });
        chart.appear(1000, 100);
      }

      fetch(`<?php echo base_url('exchanges/get_exchange_volume_json/'); ?>${exchangeId}?granularity=daily`)
        .then(res => res.json())
        .then(data => {
          allData = data.map(([timestamp, volume]) => ({
            timestamp: timestamp,
            value: (parseFloat(volume) * btcPrice) / convertRate
          }));

          filterData(365); // Default 1Y
        });

      document.querySelectorAll('.range-btn').forEach(btn => {
        btn.addEventListener('click', () => {
          document.querySelectorAll('.range-btn').forEach(b => b.classList.remove('active'));
          btn.classList.add('active');

          const range = btn.getAttribute('data-range').toUpperCase();
          let days;

          if (range.endsWith('D')) {
            days = parseInt(range);
          } else if (range.endsWith('M')) {
            days = parseInt(range) * 30;
          } else if (range.endsWith('Y')) {
            days = parseInt(range) * 365;
          } else {
            days = 365;
          }

          filterData(days);
        });
      });

      chart.set("cursor", am5xy.XYCursor.new(root, { behavior: "zoomX" }));
    });
  })();
</script>

<script src="<?php echo base_url(); ?>assets/js/front/jquery-3.3.1.slim.min.js"></script>
<?php $this->load->view('include/footer'); ?>