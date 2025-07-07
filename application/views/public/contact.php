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
        <h1>Contact Us</h1>
      </div>
    </div>        
  </div>    
</div>
<!-- End Page Title  -->
<!-- Contact Form and Company Details  -->
    <div class="container">
      <div class="py-5">
        <div class="row m-0">
          <div class="col-lg-8 pl-0">
            <?php echo $this->session->flashdata('msg'); ?>
            <div class="pr-5">
			  <?php echo $results[0]['description'];?>
			  <div class="pt-4"></div>
              <form data-aos="fade-left" data-aos-duration="1200" method="post" action="">
                <div class="row">
                  <div class="col-lg-4">
                    <div class="form-group">
                      <input class="form-control" type="text" placeholder="Name" name="name" id="name">
                      <span class="text-danger">
                        <?php echo form_error('name'); ?>
                      </span>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <input class="form-control" type="text" placeholder="Email" name="email" id="email">
                      <span class="text-danger">
                        <?php echo form_error('email'); ?>
                      </span>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <input class="form-control" type="text" placeholder="Phone" name="phone" id="phone">
                      <span class="text-danger">
                        <?php echo form_error('phone'); ?>
                      </span>
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="form-group">
                      <textarea class="form-control" rows="3" placeholder="Message" id="message" name="message"></textarea>
                      <span class="text-danger">
                        <?php echo form_error('message'); ?>
                      </span>
                    </div>
                  </div>
				  <div class="col-lg-12">
					<div class="form-check">
						<input type="checkbox" class="form-check-input" name="consent_check" id="consent_check">
						<label class="form-check-label" for="consent_check">I consent to having this website store my submitted information for respond to my inquiry.</label>
						<span class="text-danger">
                        <?php echo form_error('consent_check'); ?>
                      </span>
					</div>
				  </div>
                  <div class="col-lg-12">
                    <button type="submit" class="btn btn-warning mt-2">
                      <span> Submit 
                        <i class="ti-arrow-right">
                        </i>
                      </span>
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="p-4 bg-warning">
              <h2>Company Headquarters</h2>
              <p>Phone: <?php echo $settingData[0]['phone_reception'] ?>
                <br> Email: <?php echo $settingData[0]['email_office'] ?>
              </p>
              <p>
                <?php echo $settingData[0]['address'] ?>
              </p>
			  <div class="social light">
              <a href="<?php echo $settingData[0]['facebook_link'] ?>" target="_blank"><i class="fa fa-facebook-square"></i>
              </a> 
              <a href="<?php echo $settingData[0]['twitter_link'] ?>" target="_blank"><i class="fa fa-twitter-square"></i>
              </a>
              <a href="<?php echo $settingData[0]['instragram_link'] ?>" target="_blank"><i class="fa fa-instagram"></i>
              </a>
              <a href="<?php echo $settingData[0]['google_link'] ?>" target="_blank"><i class="fa fa-telegram"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
	  </div>
    </div>
<!-- End Contact Form and Company Details  -->
<!-- Donation Box  -->
<?php $this->load->view('include/donation'); ?>
<!-- End Donation Box  --> 
<?php $this->load->view('include/footer'); ?>
