<!-- footer -->
<!-- Call-to-Action  -->
<?php
	function custom_price_format($n) {
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
        $n_format = number_format($n, 8);
    }
			return $n_format;
		}
?>
<div class="cta-box py-4">
  <div class="container">
    <div class="d-flex">
      <div class="cta-text">
        <?php echo $call2Action[0]['description'] ?>
      </div>
      <div class="btn-cta">
        <a target = '_blank' href="<?php echo $call2Action[0]['link'] ?>" class="btn btn-outline-dark btn-md">
          <?php echo $call2Action[0]['title'] ?>
        </a>
      </div>
    </div>
  </div>
</div>
<!-- End Call-to-Action  -->
<div class="footer py-5">
    <div class="container">
                <div class="row pb-4">
			<div class="col text-left">
			    		<h5>Top 10 Coins</h5>
		 <?php
             setlocale(LC_MONETARY,"en_US");
             $i=0;
             foreach ($coinListtData as $res)
				{
				    if($i==10) continue; 
					 ?>
					 
	<a href="<?php echo base_url() ?>coin/<?php echo $res->id; ?>">
    <span class="badge badge-light">  <img src="<?php echo str_replace('/large/', '/small/', $res->image);?>" width="15px"/> <?php echo $res->name;?> <span class="badge badge-warning"><?php echo strtoupper($res->symbol);?></span></span>
</a>
	<?php
		++$i;
		}
				?>
				
				<h5 class="pt-4">Market Dominance</h5>
						 <?php
             setlocale(LC_MONETARY,"en_US");
             $i=0;
             foreach ($coinListtData as $res)
				{
				    if($i==10) continue;
					 ?>
					 
	<a href="<?php echo base_url() ?>coin/<?php echo $res->id; ?>">
    <span class="badge badge-light">  <img src="<?php echo str_replace('/large/', '/small/', $res->image);?>" width="15px"/> <?php echo strtoupper($res->symbol);?> <?php echo number_format($res->market_cap/$coingData->data->total_market_cap->usd*100, 1);?>%</span>
</a>
	<?php
		++$i;
		}
				?>
				
			    </div></div>
			    
        <div class="row">
			<div class="col-sm">
				<div class="d-flex justify-content-between align-items-center"><h5>Top Gainers</h5>
				<a href="<?php echo base_url(); ?>top-gainer-coins" class="small" style="text-decoration: none;">View More ></a></div>
					<?php $i=0; foreach ($coinChange24DesSort as $key => $value)
                        {
                            if (!isset($value)) continue;
                            if ($coinUsdVolume[$key] < 50000) continue;
							if($i>4)   continue; ?>
                        <ul>
							<li><span class="coin-code"><img src="<?php echo str_replace('/large/', '/small/', $coinImage[$key]);?>" width="15px" /> <a href="<?php echo base_url() ?>coin/<?php echo $coinId[$key]; ?>"><b><?php echo $coinName[$key];?></b> <small><?php echo $coinCode[$key];?></small></a></span><?php echo strtok($convertSymbol, " ");?><?php echo custom_price_format(str_replace(',','',$coinPrice[$key]/$convertRate)); ?> <span class="change-g"><?php echo round($coinChange24[$key],2);?>%</span></li>
						</ul>
                    <?php ++$i;} ?>
			</div>
			<div class="col-sm">
				<h5>Top Rank</h5>
					<?php for($i=0;$i<5;$i++) { ?>
                      <ul>
						<li><span class="coin-code"><img src="<?php echo str_replace('/large/', '/small/', $coinImage[$i]);?>" width="15px" /> <a href="<?php echo base_url() ?>coin/<?php echo $coinId[$i]; ?>"><b><?php echo $coinName[$i];?></b> <small><?php echo $coinCode[$i];?></small></a></span><?php echo strtok($convertSymbol, " ");?><?php echo custom_price_format(str_replace(',','',$coinPrice[$i]/$convertRate)); ?>
                      <span <?php if($coinChange24[$i] > 0) echo 'class="change-g"'; else echo 'class="change-l"';  ?>> <?php echo round($coinChange24[$i],2);?>%</span></li>
					  </ul>
                    <?php } ?>
			</div>
			<div class="col-sm">
			<div class="d-flex justify-content-between align-items-center"><h5>Top Losers</h5>
				<a href="<?php echo base_url(); ?>top-loser-coins" class="small" style="text-decoration: none;">View More ></a></div>
					<?php 
                         $i=0;
                          foreach ($coinChange24Sort as $key => $value)
								{
								    if (!isset($value)) continue;
								    if ($coinUsdVolume[$key] < 50000) continue;
									if($i>4)   continue; ?>
                            <ul>
							<li><span class="coin-code"><img src="<?php echo str_replace('/large/', '/small/', $coinImage[$key]);?>" width="15px" /> <a href="<?php echo base_url() ?>coin/<?php echo $coinId[$key]; ?>"><b><?php echo $coinName[$key];?></b> <small><?php echo $coinCode[$key];?></small> </a></span><?php echo strtok($convertSymbol, " ");?><?php echo custom_price_format(str_replace(',','',$coinPrice[$key]/$convertRate)); ?> <span class="change-l"><?php echo round($coinChange24[$key],2);?>%</span></li>
						</ul>
                    <?php ++$i;} ?>
			</div>
		</div>
                <div class="copyright-nav">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex">
                                <div class="f-nav mr-auto">
                                    <?php if($pageData[1]['active'] ==1) {?>
                                    <a href="<?php echo base_url(); ?>pages/<?php echo $pageData[1]['seo_url']?>" class="p-10 p-l-0"><?php echo $pageData[1]['title']?></a> -&nbsp;  
                                    <?php } ?>
									<?php if($pageData[3]['active'] ==1) {?>
                                    <a href="<?php echo base_url(); ?>pages/<?php echo $pageData[3]['seo_url']?>" class="p-10"><?php echo $pageData[3]['title']?></a> -  
                                    <?php } ?>
                                    <?php if($pageData[4]['active'] ==1) {?>
                                    <a href="<?php echo base_url(); ?>pages/<?php echo $pageData[4]['seo_url']?>" class="p-10"> <?php echo $pageData[4]['title']?></a> -  
                                    <?php } ?>
                                    <?php if($pageData[5]['active'] ==1) {?>
                                    <a href="<?php echo base_url(); ?>pages/<?php echo $pageData[5]['seo_url']?>" class="p-10"> <?php echo $pageData[5]['title']?></a> -  
                                    <?php } ?>
                                    <?php if($pageData[2]['active']==1) { ?>
                              	    <a href="<?php echo base_url(); ?>contact-us" class="p-10"> <?php echo $pageData[2]['title']?></a>
                              	    <?php } ?>
                              	    <br>
                                    <p><small><a style="padding-right:10px;" href="<?php echo $settingData[0]['facebook_link'] ?>" target="_blank"><i class="fa fa-facebook-square"></i> <b>Facebook</b></a> 
                                    <a style="padding-right:10px;" href="<?php echo $settingData[0]['twitter_link'] ?>" target="_blank"><i class="fa fa-twitter-square"></i> <b>Twitter</b></a> 
                                    <a style="padding-right:10px;" href="<?php echo $settingData[0]['instragram_link'] ?>" target="_blank"><i class="fa fa-instagram"></i> <b>Instagram</b></a> 
                                    <a href="<?php echo $settingData[0]['google_link'] ?>" target="_blank"><i class="fa fa-telegram"></i> <b>Telegram</b></a></small></p>
                                </div>
                                 <p><?php echo $settingData[0]['copyright'] ?><br><small>Data provided by <a href="https://coingecko.com/" rel="nofollow" target="_blank"> CoinGecko</a></small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
<!-- End footer -->
<!-- Footer Ticker -->
<?php if($settingData[0]['ticker']==1) { ?> 
<div class="ticker-bottom">
	<div class="ticker">

		
	<?php 
	for($j=0;$j<25;$j++)
				{ 	
	?>
<div class="ticker__item"><img src="<?php echo str_replace('/large/', '/small/', $coinImage[$j]) ?>" /> <span><a href="<?php echo base_url() ?>coin/<?php echo $coinId[$j]; ?>"><?php echo $coinCode[$j];?></a></span> <div class="cmlp-price"><?php echo strtok($convertSymbol, " ");?><?php echo custom_price_format(str_replace(',','',$coinPrice[$j]/$convertRate)); ?></div> <span><i class="fa fa-caret-<?php echo $coinChange24[$j] > 0 ? 'up':'down'?>"></i> <?php echo str_replace('-','',round($coinChange24[$j],2));?>%</span></div>
	<?php } ?>
	</div>
</div>
<?php } ?>
<!-- End Footer Ticker -->
<!-- Bootstrap Core JavaScript -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/front/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" crossorigin="anonymous" ></script>
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.js"></script>
<?php if($settingData[0]['header_gdpr'] ==1) {?>
<script>
window.addEventListener("load", function(){
window.cookieconsent.initialise({
  "palette": {
    "popup": {
      "background": "#ffffff",
      "text": "#18191a"
    },
    "button": {
      "background": "#ffc107",
      "text": "#18191a"
    }
  },
  "position": "top",
  "static": true,
  "content": {
    "message": "Our website uses cookies to make your browsing experience better. By using our site you agree to our use of cookies.",
    "dismiss": "I CONSENT",
    "link": "Learn More",
    "href": "<?php echo base_url(); ?>pages/privacy-policy"
  }
})});
</script>
<?php } ?>
</body>