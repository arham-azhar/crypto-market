<?php $this->load->view('include/header'); ?>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"  ></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.1/js/responsive.bootstrap4.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.bootstrap4.min.css"/>
<script type="text/javascript">
let currentBatch = 1;
let rowsPerPage = 50;
let switching = false;

$(document).ready(function () {
    $.noConflict();

    let table = $('#coins-info-table').DataTable({
        processing: true,
        pageLength: rowsPerPage,
        lengthChange: false,
        pagingType: "simple",
        searching: false,
        info: false,
        bPaginate: true,
        ajax: {
            url: "<?php echo base_url(); ?>home/coindata",
            data: function (d) {
                d.batch = currentBatch;
            }
        },
        columns: [
            { data: '#' },
            { data: 'Name' },
            { data: 'Price', render: function (coinprice) {  
                var cprice = coinprice/<?php echo $convertRate;?>;
                return '<span class="price">' + '<?php echo strtok($convertSymbol, " ");?>' + custom_prc_format(cprice) + '</span>';
            }},
            { data: '1h' },
            { data: '24h' },
            { data: '7d' },
            { data: 'Volume(24h)', render: function (vol) {  
                var volume = vol/<?php echo $convertRate;?>;
                return '<?php echo strtok($convertSymbol, " ");?>' + formatCash(volume);
            }},
            { data: 'Market Cap', render: function (mcap) {  
                var marketcap = mcap/<?php echo $convertRate;?>;
                return '<?php echo strtok($convertSymbol, " ");?>' + formatCash(marketcap);  
            }},
            { data: 'Last 7 Days' }
        ]
    });

    $('#coins-info-table').on('draw.dt', function () {
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
    });

    const formatCash = n => {
        if (n < 1e3) return n;
        if (n >= 1e3 && n < 1e6) return +(n / 1e3).toFixed(2) + "K";
        if (n >= 1e6 && n < 1e9) return +(n / 1e6).toFixed(2) + "M";
        if (n >= 1e9 && n < 1e12) return +(n / 1e9).toFixed(2) + "B";
        return +(n / 1e12).toFixed(2) + "T";
    };

    function custom_prc_format($n) {
        if ($n >= 1) return $n.toFixed(2);
        if ($n >= 0.1) return $n.toFixed(3);
        if ($n >= 0.01) return $n.toFixed(4);
        if ($n >= 0.001) return $n.toFixed(6);
        if ($n >= 0.0001) return $n.toFixed(8);
        return $n.toFixed(10);
    }

    $('#coins-info-table').on('page.dt', function () {
         // ✅ Scroll on **every page change**, regardless of batch
const info = table.page.info();
const isBatchSwitch = (info.page === info.pages - 1 || (info.page === 0 && currentBatch > 1));

if (!isBatchSwitch) {
    setTimeout(function() {
        $('html, body').animate({
            scrollTop: $('#coins-info-table').offset().top - 50
        }, 300);
    }, 50);
}

        if (switching) return;

        //const info = table.page.info();

        // ✅ If on the last page, load next batch
        if (info.page === info.pages - 1) {
            switching = true;
            currentBatch++;
            fetch("<?php echo base_url(); ?>home/get_or_create_common_json?page=" + currentBatch)
                .then(() => {
                    return fetch("<?php echo base_url(); ?>home/coindata?batch=" + currentBatch);
                })
                .then(response => response.json())
                .then(json => {
                    table.rows.add(json.data).draw(false); // Append next 250 coins
                    initializeWebSocket(); // Reinitialize WebSocket after new rows are loaded
                    // ✅ Prevent unwanted focus by scrolling to top _again_
setTimeout(function() {
    $('html, body').animate({
        scrollTop: $('#coins-info-table').offset().top - 50
    }, 300);
}, 50);
                    switching = false;
                });
        }

        // ✅ If on first page, go back a batch
        if (info.page === 0 && currentBatch > 1) {
            switching = true;
            currentBatch--;
            fetch("<?php echo base_url(); ?>home/get_or_create_common_json?page=" + currentBatch)
                .then(() => {
                    return fetch("<?php echo base_url(); ?>home/coindata?batch=" + currentBatch);
                })
                .then(response => response.json())
                .then(json => {
                    table.clear().rows.add(json.data).draw(false);
                    initializeWebSocket(); // Reinitialize here as well

                    // 🔁 Automatically jump to last page of previous batch
                    const totalPages = Math.ceil(json.data.length / rowsPerPage);
                    table.page(totalPages - 1).draw(false);

                    switching = false;
                });
        }
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
          <?php echo $pageData[0]['home_title']?>
        </h1>
        <h6 class="pb-2">
          <?php echo $pageData[0]['description']?>
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
<!-- Data Table  -->


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 text-left">
            <h3>Cryptocurrency Prices by Market Cap</h3>
            <p>The worldwide cryptocurrency market cap today is <span class="font-weight-bold"><?php echo strtok($convertSymbol, " ");?><?php echo custom_number_format($coingData->data->total_market_cap->usd/$convertRate);?></span>. The total crypto trading volume in the last 24 hours is <span class="font-weight-bold"><?php echo strtok($convertSymbol, " ");?><?php echo custom_number_format($coingData->data->total_volume->usd/$convertRate);?></span>. Bitcoin dominance is at <span class="font-weight-bold"><?php echo number_format($btcCap/$coingData->data->total_market_cap->usd*100, 1);?>%</span> with a market cap of <span class="font-weight-bold"><?php echo strtok($convertSymbol, " ");?><?php echo custom_number_format($btcCap/$convertRate);?></span> and Ethereum dominance is at <span class="font-weight-bold"><?php echo number_format($ethCap/$coingData->data->total_market_cap->usd*100, 1);?>%</span> with a market cap of <span class="font-weight-bold"><?php echo strtok($convertSymbol, " ");?><?php echo custom_number_format($ethCap/$convertRate);?></span>. The ranks of the coins are based on marketcap, trading volume, and prices.</p>
 <div style="position: relative;">
    <input type="text" id="coinSearch" placeholder="Search <?php echo $coingData->data->active_cryptocurrencies; ?> Coins" style="width:100%;height:40px;padding-left:10px;border:1px solid #dedede;" autocomplete="off" />
    <div id="searchResults" style="border:1px solid #ccc; display:none; position:absolute; background:#fff;"></div>
</div>

<script>
let coinData = [];

// Load coin data via AJAX when the page loads
fetch('<?php echo base_url("home/get_coin_search_data"); ?>')
  .then(response => response.json())
  .then(data => {
    coinData = data;
  });

// Elements
const input = document.getElementById('coinSearch');
const results = document.getElementById('searchResults');

// Search Handler
input.addEventListener('input', function() {
    const query = this.value.toLowerCase().trim();
    results.innerHTML = '';
    results.style.display = 'none';

    if (query.length < 1 || coinData.length === 0) return;

    const terms = query.split(/\s+/); // Split by spaces

    const filtered = coinData
      .filter(c => {
        const combined = `${c.name.toLowerCase()} ${c.symbol.toLowerCase()}`;
        return terms.every(term => combined.includes(term));
      })
      .sort((a, b) => {
        const aExact = a.name.toLowerCase() === query || a.symbol.toLowerCase() === query;
        const bExact = b.name.toLowerCase() === query || b.symbol.toLowerCase() === query;
        if (aExact && !bExact) return -1;
        if (!aExact && bExact) return 1;
        return 0;
      })
     // .slice(0, 10); // Limit to top 10 results

    if (filtered.length > 0) {
        filtered.forEach(c => {
            const link = document.createElement('a');
            link.href = '<?php echo base_url("coin/"); ?>' + c.id;
            link.innerHTML = `${c.name} <small>${c.symbol.toUpperCase()}</small>`;
            link.style.display = 'block';
            link.style.padding = '5px';
            link.style.textDecoration = 'none';
            link.style.color = '#000';
            results.appendChild(link);
        });
        results.style.display = 'block';
    }
});
</script> 
<table id="coins-info-table" class="table table-striped table-bordered dt-responsive wrap" cellspacing="0" width="100%">
			<thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Price</th>
                <th>1h</th>
                <th>24h</th>
                <th>7d</th>
                <th>Volume(24h)</th>
                <th>Market Cap</th>
                <th>Last 7 Days</th>
            </tr>
			</thead>
		   </table>  
			
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

<!-- Donation Box  -->
<?php $this->load->view('include/donation'); ?>
<!-- End Donation Box  -->
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
<style>
    .increment {
        color: green;
    }
    .decrement {
        color: red;
    }
</style>

<script type="text/javascript">
    var formatter = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: "<?php echo $convertCode;?>",
        minimumFractionDigits: 2,
    });

    let pricesWs;

    function initializeWebSocket() {
        let symbols = [];
        $('#coins-info-table tbody tr').each(function() {
            let id = $(this).attr('id');
            if (id) {
                let symbol = id.replace('BTC_', '').toLowerCase() + 'usdt';
                symbols.push(symbol);
            }
        });

        if (symbols.length === 0) {
            symbols = ['btcusdt', 'ethusdt', 'bnbusdt'];
        }

        const streams = symbols.map(s => `${s}@ticker`).join('/');
        const wsUrl = `wss://stream.binance.com:9443/stream?streams=${streams}`;

        if (pricesWs) {
            pricesWs.close();
        }

        pricesWs = new WebSocket(wsUrl);

        pricesWs.onmessage = function (msg) {
            const parsed = JSON.parse(msg.data);
            const data = parsed.data;
            const symbol = data.s.toLowerCase();
            const priceValue = parseFloat(data.c);
            const coin = 'BTC_' + symbol.replace('usdt', '');

            const _coinTable = $('#coins-info-table');
            const row = _coinTable.find("tr#" + coin);
            const price = _coinTable.find("tr#" + coin + " .price");

            if (price.length) {
                const _priceFormatted = formatter.format(priceValue / <?php echo $convertRate;?>);
                const previous_price = $(price).data('usd') || 0;
                const _class = previous_price < priceValue ? 'increment' : 'decrement';

                $(price).html(_priceFormatted).removeClass().addClass(_class + ' price').data("usd", priceValue);

                if (priceValue !== previous_price) {
                    $(row).addClass(_class);
                    setTimeout(() => $(row).removeClass('increment decrement'), 300);
                }
            }
        };
    }

    // Trigger on DataTables draw
    $('#coins-info-table').on('draw.dt', function () {
        initializeWebSocket();
    });

    // Initial trigger on page load
    $(document).ready(function () {
        initializeWebSocket();
    });
</script>






<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-sparklines/2.1.2/jquery.sparkline.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/front/jquery-3.3.1.slim.min.js"></script>
<?php $this->load->view('include/footer'); ?>