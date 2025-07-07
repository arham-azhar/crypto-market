<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

            <div class="content-wrapper">
                <section class="content-header">
                    <?php echo $pagetitle; ?>
                    <?php echo $breadcrumb; ?>
                </section>

                <section class="content">
                    <div class="row">
						<?php

							if($this->session->flashdata('message')) {
						?>
						<div class="alert alert-success">
				<a href="#" class="close" data-dismiss="alert">&times;</a>
					<?php echo $this->session->flashdata('message'); ?>
				</div>
						<?php } ?>
						<?php

							if($this->session->flashdata('demo_msg')) {
						?>
						<div class="alert alert-danger">
				<a href="#" class="close" data-dismiss="alert">&times;</a>
					<?php echo $this->session->flashdata('demo_msg'); ?>
				</div>
						<?php } ?>
                        <div class="col-md-12">
<?php echo $error;?>

<?php echo form_open_multipart('admin/settings/upload_logo');?>
<div class="box-body">
	
                                             <div class="form-group">
                                                <label class="col-sm-2 control-label">Logo</label>
                                                <div class="col-sm-10">
                                                       <input type="file" name="logo" size="20" />
                                                       <i>Recommended Logo Size 200 x 75 px (PNG Format)</i>
                                                </div>
                                            </div>
<img src="<?php echo base_url()?>upload/<?php echo $settings[0]['logo'];?>" width="50" height="50">
<br /><br />
 <div class="form-group">
                                                <label class="col-sm-2 control-label">Favicon</label>
                                                <div class="col-sm-10">
                                                       <input type="file" name="fevicon" size="20" />
                                                        <i>Recommended Favicon Size 16 x 16 px</i>
                                                </div>
                                            </div>
<img src="<?php echo base_url()?>upload/<?php echo $settings[0]['fevicon'];?>" width="16" height="16">
<br /><br />
 <div class="form-group">
                                                <label class="col-sm-2 control-label"><?php echo lang('buy_sell'); ?></label>
                                                <div class="col-sm-10">
                                                        <input type="text"  class="form-control" name="buy_sell" id="buy_sell" value="<?php echo $settings[0]['buy_sell'];?>">
                                                        <p><?php echo lang('link_desc'); ?></p>
                                                </div>
                                            </div>
											
											<br/><br/>	
                                              <div class="form-group">
                                                <label class="col-sm-2 control-label"><?php echo lang('copyright'); ?></label>
                                                <div class="col-sm-10">
                                                        <input type="text"  class="form-control" name="copyright" id="copyright" value="<?php echo $settings[0]['copyright'];?>">

                                                </div>
                                            </div>
                                            <br/><br/>	
                                              <div class="form-group">
                                                <label class="col-sm-2 control-label">API Key (CoinGecko)</label>
                                                <div class="col-sm-10">
                                                        <input type="text"  class="form-control" name="phone_office" id="phone_office" value="<?php echo $settings[0]['phone_office'];?>">

                                                </div>
                                            </div>
											<br/><br/>	
                                              <div class="form-group">
                                                <label class="col-sm-2 control-label"><?php echo lang('ticker'); ?></label>
                                                <div class="col-sm-10">
                                                    <label class="radio-inline">
                                                        <input type="radio" name="ticker" id="ticker" value="1" <?php echo  $settings[0]['ticker'] == 1 ? 'checked' : NULL; ?>> <?php echo lang('action_show'); ?>
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="ticker" id="ticker" value="0" <?php echo  $settings[0]['ticker'] == 0 ? 'checked' : NULL; ?>> <?php echo lang('action_hide'); ?>
                                                    </label>
                                                </div>
                                            </div>
										<br/><br/>	
 <div class="form-group">
                                                <label class="col-sm-2 control-label"><?php echo lang('header_top'); ?></label>
                                                <div class="col-sm-10">
                                                    <label class="radio-inline">
                                                        <input type="radio" name="header_top" id="header_top" value="1" <?php echo  $settings[0]['header_top'] == 1 ? 'checked' : NULL; ?>> <?php echo lang('action_show'); ?>
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="header_top" id="header_top" value="0" <?php echo  $settings[0]['header_top'] == 0 ? 'checked' : NULL; ?>> <?php echo lang('action_hide'); ?>
                                                    </label>
                                                </div>
                                            </div>
										<br/><br/>	
                                              <div class="form-group">
                                                <label class="col-sm-2 control-label"><?php echo lang('header_gdpr'); ?></label>
                                                <div class="col-sm-10">
                                                    <label class="radio-inline">
                                                        <input type="radio" name="header_gdpr" id="header_gdpr" value="1" <?php echo  $settings[0]['header_gdpr'] == 1 ? 'checked' : NULL; ?>> <?php echo lang('action_show'); ?>
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="header_gdpr" id="header_gdpr" value="0" <?php echo  $settings[0]['header_gdpr'] == 0 ? 'checked' : NULL; ?>> <?php echo lang('action_hide'); ?>
                                                    </label>
                                                </div>
                                            </div>
											<br/><br/>	
                                              <div class="form-group">
                                                <label class="col-sm-2 control-label"><?php echo lang('site_layout'); ?></label>
                                                <div class="col-sm-10">
                                                    <label class="radio-inline">
                                                        <input type="radio" name="site_layout" id="site_layout" value="1" <?php echo  $settings[0]['site_layout'] == 1 ? 'checked' : NULL; ?>> Black & Yellow
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="site_layout" id="site_layout" value="2" <?php echo  $settings[0]['site_layout'] == 2 ? 'checked' : NULL; ?>> Dark Blue & Light Green
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="site_layout" id="site_layout" value="3" <?php echo  $settings[0]['site_layout'] == 3 ? 'checked' : NULL; ?>> Black & Red
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="site_layout" id="site_layout" value="4" <?php echo  $settings[0]['site_layout'] == 4 ? 'checked' : NULL; ?>> Dark Navy & Bright Grey
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="site_layout" id="site_layout" value="5" <?php echo  $settings[0]['site_layout'] == 5 ? 'checked' : NULL; ?>> Soft Navy & Bright Cyan
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="site_layout" id="site_layout" value="6" <?php echo  $settings[0]['site_layout'] == 6 ? 'checked' : NULL; ?>> White & Cyan
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="site_layout" id="site_layout" value="7" <?php echo  $settings[0]['site_layout'] == 7 ? 'checked' : NULL; ?>> White & Blue
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="site_layout" id="site_layout" value="8" <?php echo  $settings[0]['site_layout'] == 8 ? 'checked' : NULL; ?>> White & Green
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="site_layout" id="site_layout" value="9" <?php echo  $settings[0]['site_layout'] == 9 ? 'checked' : NULL; ?>> White & Red
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="site_layout" id="site_layout" value="10" <?php echo  $settings[0]['site_layout'] == 10 ? 'checked' : NULL; ?>> White & Black
                                                    </label>
                                                </div>
                                            </div>
										<br/><br/>			
						<div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <div class="btn-group">
                                                    <?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-primary btn-flat', 'content' => lang('actions_submit'))); ?>
                                                    <?php echo form_button(array('type' => 'reset', 'class' => 'btn btn-warning btn-flat', 'content' => lang('actions_reset'))); ?>
                                                    <?php echo anchor('admin/settings/logo', lang('actions_cancel'), array('class' => 'btn btn-default btn-flat')); ?>
                                                </div>
                                            </div>
                                        </div>					

<div class="box-body">
</form>
                        </div>
                    </div>
                </section>
            </div>
