<div class="bg-donation py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-7 text-center">
        <h2 class="pt-2"><?php echo $donations[0]['heading']?></h2>
        <h6><?php echo $donations[0]['paragraph']?></h6>
      </div>
    </div>
    <div class="row pt-4">
      <?php foreach ($donations as $donation) { ?>
      <div class="col-lg-6 mb-4">
        <div class="card">
          <div class="row">
            <div class="col-md-12">
              <div class="card-body d-flex">
                <div class="mr-2">
                  <img src="<?php echo base_url()?>upload/<?php echo $donation['image'];?>" width="60" />
                </div>
                <div class="col">
                  <h5><?php echo $donation['title']?></h5>
                  <h6><?php echo $donation['description']?></h6>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php } ?>
    </div>
  </div>
</div>