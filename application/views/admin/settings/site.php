<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<script src="<?php echo base_url(); ?>assets/js/ckeditor/ckeditor.js"></script>

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
                        <div class="col-md-12">


<?php //echo $error;?>
<?php echo form_open_multipart('admin/settings/site');?>
<div class="box-body">
	                         
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label"><?php echo lang('address'); ?></label>
                                                <div class="col-sm-10">
                                                        <input type="text"  class="form-control" name="address" id="address" value="<?php echo $settings[0]['address'];?>">   
                                                </div>
                                            </div>
                                            <br/><br/>		
                                             <div class="form-group">
                                                <label class="col-sm-2 control-label"><?php echo lang('phone_reception'); ?></label>
                                                <div class="col-sm-10">
                                                    
                                                        <input type="text"  class="form-control" name="phone_reception" id="phone_reception" value="<?php echo $settings[0]['phone_reception'];?>">
                                                   
                                                   
                                                </div>
                                            </div>
                                           
                                            <br/><br/>		
                                             <div class="form-group">
                                                <label class="col-sm-2 control-label"><?php echo lang('email_office'); ?></label>
                                                <div class="col-sm-10">
                                                    
                                                        <input type="text"  class="form-control" name="email_office" id="email_office" value="<?php echo $settings[0]['email_office'];?>">
                                                   
                                                   
                                                </div>
                                            </div>
                                            <br/><br/>		
                                             		                                     
                                             <div class="form-group">
                                                <label class="col-sm-2 control-label"><?php echo lang('facebook_link'); ?><br>(Contact Us Page & Footer)</label>
                                                <div class="col-sm-10">
                                                    
                                                        <input type="text"  class="form-control" name="facebook_link" id="facebook_link" value="<?php echo $settings[0]['facebook_link'];?>">
                                                   
                                                   
                                                </div>
                                            </div>
                                            <br/><br/>		
                                             <div class="form-group">
                                                <label class="col-sm-2 control-label"><?php echo lang('twitter_link'); ?><br>(Contact Us Page & Footer)</label>
                                                <div class="col-sm-10">
                                                    
                                                        <input type="text"  class="form-control" name="twitter_link" id="twitter_link" value="<?php echo $settings[0]['twitter_link'];?>">
                                                   
                                                   
                                                </div>
                                            </div>
                                            <br/><br/>		
                                            	
                                             
                                             <div class="form-group">
                                                <label class="col-sm-2 control-label"><?php echo lang('instragram_link'); ?><br>(Contact Us Page & Footer)</label>
                                                <div class="col-sm-10">
                                                    
                                                        <input type="text"  class="form-control" name="instragram_link" id="instragram_link" value="<?php echo $settings[0]['instragram_link'];?>">
                                                   
                                                   
                                                </div>
                                            </div>
                                              <br/><br/>
                                              <div class="form-group">
                                                <label class="col-sm-2 control-label"><?php echo lang('google_link'); ?><br>(Contact Us Page & Footer)</label>
                                                <div class="col-sm-10">
                                                    
                                                        <input type="text"  class="form-control" name="google_link" id="google_link" value="<?php echo $settings[0]['google_link'];?>">
                                                   
                                                   
                                                </div>
                                            </div>
                                          
                                            <br/><br/>
<div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <div class="btn-group">
                                                    <?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-primary btn-flat', 'content' => lang('actions_submit'))); ?>
                                                    <?php echo form_button(array('type' => 'reset', 'class' => 'btn btn-warning btn-flat', 'content' => lang('actions_reset'))); ?>
                                                    <?php echo anchor('admin/cms', lang('actions_cancel'), array('class' => 'btn btn-default btn-flat')); ?>
                                                </div>
                                            </div>
                                        </div>
</form>


                        </div>
                    </div>
                </section>
            </div>
