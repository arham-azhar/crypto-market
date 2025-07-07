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
            url: "<?php echo base_url(); ?>exchanges/exchangesdata",
            data: function (d) {
                d.batch = currentBatch;
            }
        },
			columns: [
			{ data: '#' },
			{ data: 'Name' },
			{ data: 'Trust Score' },
            { data: 'Volume(24h) Normalized' },
			{ data: 'Volume(24h)' },
			{ data: 'Established' },
			{ data: 'Official Website' },
		]
    });

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
            fetch("<?php echo base_url(); ?>exchanges/get_or_create_exchanges_json?page=" + currentBatch)
                .then(() => {
                    return fetch("<?php echo base_url(); ?>exchanges/exchangesdata?batch=" + currentBatch);
                })
                .then(response => response.json())
                .then(json => {
                    table.rows.add(json.data).draw(false); // Append next 250 coins
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
            fetch("<?php echo base_url(); ?>exchanges/get_or_create_exchanges_json?page=" + currentBatch)
                .then(() => {
                    return fetch("<?php echo base_url(); ?>exchanges/exchangesdata?batch=" + currentBatch);
                })
                .then(response => response.json())
                .then(json => {
                    table.clear().rows.add(json.data).draw(false);

                    // 🔁 Automatically jump to last page of previous batch
                    const totalPages = Math.ceil(json.data.length / rowsPerPage);
                    table.page(totalPages - 1).draw(false);

                    switching = false;
                });
        }
    });
});
</script>



<!-- <script type="text/javascript">
	$(document).ready(function () {
	    $.noConflict();
    $('#coins-info-table').DataTable({
        	"oLanguage": {
			"sProcessing": "Loading Exchanges..."
				},
			processing: true,
			iDisplayLength: 25,
			ajax: "<?php echo base_url()?>exchanges/exchangesdata",
			bServerSide: false,
			bDeferRender: true,
			lengthChange: false,
			searching: false,
			bInfo: false,
			"pagingType": "numbers",
			bPaginate:true,
			columns: [
			{ data: '#' },
			{ data: 'Name' },
			{ data: 'Trust Score' },
            { data: 'Volume(24h) Normalized' },
			{ data: 'Volume(24h)' },
			{ data: 'Established' },
			{ data: 'Official Website' },
		]
		});
		} );
		
		
	</script> -->

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
          Top Cryptocurrency Exchanges List
        </h1>
        <h6 class="pb-3">
          List of top crypto exchanges platform. The exchange rank is based on based on traffic, liquidity, trading volumes, and confidence in the legitimacy of trading volumes reported. View live cryptourrency exchanges rank, markets data, 24h volume, trading pairs and info.
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
    <div style="position: relative;">
    <input type="text" id="exchangeSearch" placeholder="Search <?php echo $coingData->data->markets; ?> Exchanges" style="width:100%;height:40px;padding-left:10px;border:1px solid #dedede;" autocomplete="off" />
    <div id="searchResults" style="border:1px solid #ccc; display:none; position:absolute; background:#fff;"></div>
</div>

<script>
let exchangeData = [];

// Load exchange data via AJAX when the page loads
fetch('<?php echo base_url("exchanges/get_exchange_search_data"); ?>')
  .then(response => response.json())
  .then(data => {
    exchangeData = data;
  });

// Elements
const input = document.getElementById('exchangeSearch');
const results = document.getElementById('searchResults');

// Search Handler
input.addEventListener('input', function() {
    const query = this.value.toLowerCase().trim();
    results.innerHTML = '';
    results.style.display = 'none';

    if (query.length < 1 || exchangeData.length === 0) return;

    const terms = query.split(/\s+/);

    const filtered = exchangeData
      .filter(c => {
        const combined = c.name.toLowerCase();
        return terms.every(term => combined.includes(term));
      })
      .sort((a, b) => {
        const aExact = a.name.toLowerCase() === query;
        const bExact = b.name.toLowerCase() === query;
        if (aExact && !bExact) return -1;
        if (!aExact && bExact) return 1;
        return 0;
      });

    if (filtered.length > 0) {
        filtered.forEach(c => {
            const link = document.createElement('a');
            link.href = '<?php echo base_url("exchange/"); ?>' + c.id;
            link.innerHTML = `${c.name}`;
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

    <div class="row justify-content-center">
        <div class="col-md-12 text-left">
			<table id="coins-info-table" class="table table-striped table-bordered dt-responsive wrap" cellspacing="0" width="100%">
			<thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Trust Score</th>
                <th>Volume(24h) Normalized</th>
                <th>Volume(24h)</th>
                <th>Established</th>
				<th>Official Website</th>
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
<script src="<?php echo base_url(); ?>assets/js/front/jquery-3.3.1.slim.min.js"></script>
<?php $this->load->view('include/footer'); ?>