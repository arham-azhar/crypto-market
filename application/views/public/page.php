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
<!-- Page Title  -->
<div class="page-title py-3">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12 text-left">
        <h1>
          <?php echo $results[0]['title'];?>
        </h1>
      </div>
    </div>        
  </div>    
</div>
<!-- End Page Title  -->
<!-- Page Content  -->
<div class="container">
  <div class="py-5">
    <?php echo $results[0]['description'];?>
  </div>
</div>
<!-- End Page Content  -->
<?php $this->load->view('include/footer'); ?>