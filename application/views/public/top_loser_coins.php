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
		$('#coins-info-table').dataTable( {
          "order": [],
          "pageLength": 30,
          "bInfo" : false,
          "paging": false,
          "searching": false,
          "bProcessing": true,
		 "bDeferRender": true,
          
		} );
		} );
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
<!-- Page Title  -->
<div class="page-title py-3">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12 text-left">
        <h1>Top Crypto Losers Today</h1>
      </div>
    </div>        
  </div>    
</div>
<!-- End Page Title  -->

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
<!-- Data Table  -->
<div class="container">
    <div class="alert alert-danger" role="alert">Discover crypto coins (from top 250) with volume(24h) > US$50,000 have lost the most based on price movements in the last 24 hours?</div>
	<div class="row justify-content-center">
		<div class="col-md-12 text-left">
		<div class="py-2">  
        <table id="coins-info-table" class="table table-striped table-bordered dt-responsive wrap" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Price</th>
              <th>Volume(24h)</th>
              <th>Change(24h)</th>
            </tr>
          </thead>	
        <tbody>
			<?php
				$cnt=0;
				setlocale(LC_MONETARY,"en_US");
				foreach ($coinChange24Sort as $key => $value)
				{
				    if (!isset($value)) continue;
				    if ($coinUsdVolume[$key] < 50000) continue;
                    if($cnt > 29) continue;
					 ?>
				<tr id="BTC_<?php echo $coinCode[$key];?>">
				     <?php $watchlist = $this->input->cookie('watchlist', TRUE);
        $watchlist = $watchlist ? json_decode($watchlist, true) : []; ?>
				    	<?php	$action_link = in_array($coinId[$key], $watchlist) ? 
            '<a href="#" class="watchlist-action" data-action="remove" data-coin="' . $coinId[$key] . '"><i class="fa fa-star" title="Remove from Watchlist"></i></a>' :
            '<a href="#" class="watchlist-action" data-action="add" data-coin="' . $coinId[$key] . '"><i class="fa fa-star-o" title="Add to Watchlist"></i></a>'; ?>
					<td><?php echo $action_link . ' '.$coinRank[$key];?></td>
					<td><img src="<?php echo str_replace('/large/', '/small/', $coinImage[$key]) ?>"><a href="<?php echo base_url() ?>coin/<?php echo $coinId[$key]; ?>"><span class="coin-name"><?php echo $coinName[$key];?></span></a> <span class="badge badge-warning"><?php echo $coinCode[$key];?></span></td>
					<td class="price" data-sort="<?php echo $coinPrice[$key];?>"><?php echo strtok($convertSymbol, " ");?><?php echo custom_prc_format($coinPrice[$key]/$convertRate);?></td>
					<td data-sort="<?php echo $coinUsdVolume[$key];?>"><?php echo strtok($convertSymbol, " ");?><?php echo number_format(round($coinUsdVolume[$key] / $convertRate), 0, '.', ','); ?></td>
					<td data-sort="<?php echo $coinChange24[$key];?>"><span class="p-down"><i class="fa fa-caret-down"></i> <?php echo str_replace('-','',round($coinChange24[$key],2));?>%</span></td>
				</tr>	
		 <?php ++$cnt;
		}
				?>
        </tbody>
    </table>      
		</div>  
		</div>        
	</div>    
</div>
<!-- End Data Table  -->
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
<script type="text/javascript">
    var base_url = '<?php echo base_url(); ?>';
</script>
<script>
$(document).ready(function() {
    $(document).on('click', '.watchlist-action', function(e) {
        e.preventDefault();
        var action = $(this).data('action');
        var coin = $(this).data('coin');
        var url = action === 'add' ? base_url + '/watchlist/add/' + coin : base_url + '/watchlist/remove/' + coin;

        $.ajax({
            url: url,
            type: 'POST',
            success: function(response) {
                if (response.status === 'success') {
                    if (action === 'add') {
                        $('a[data-coin="' + coin + '"]').data('action', 'remove').html('<i class="fa fa-star" title="Remove from Watchlist"></i>');
                    } else {
                        $('a[data-coin="' + coin + '"]').data('action', 'add').html('<i class="fa fa-star-o" title="Add to Watchlist"></i>');
                    }
                } else {
                    alert('There was an error updating your watchlist. Please try again.');
                }
            },
            error: function() {
                alert('There was an error updating your watchlist. Please try again.');
            }
        });
    });
});
</script>
<script src="<?php echo base_url(); ?>assets/js/front/jquery-3.3.1.slim.min.js"></script>
<?php $this->load->view('include/footer'); ?>