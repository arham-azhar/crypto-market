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
<?php echo form_open_multipart('admin/settings/seo');?>
<div class="box-body">
	                       
                                             <div class="form-group clearfix">
                                                <label class="col-sm-2 control-label"><?php echo lang('google_analytic'); ?></label>
                                                <div class="col-sm-10">
                                              <textarea rows="10" cols="114" name="google_analytic" id="google_analytic" ><?php echo $settings[0]['google_analytic'];?></textarea>

                                                </div>
                                            </div>
                                            
                          <div class="form-group clearfix">
                             <label class="col-sm-2 control-label"><?php echo lang('google_verify'); ?></label>
                               <div class="col-sm-10">
                            <textarea rows="3" cols="114" name="google_verify" id="google_verify" ><?php echo $settings[0]['google_verify'];?></textarea>       							
                 
                                 </div>
                                            </div>
                                            
                                             
                     <div class="form-group clearfix">
                            <label class="col-sm-2 control-label"><?php echo lang('bing_verify'); ?></label>
                            <div class="col-sm-10">
                                <textarea rows="3" cols="114" name="bing_verify" id="bing_verify" ><?php echo $settings[0]['bing_verify'];?></textarea>  
	                
                              </div>
                     </div>
                                                                  
<div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <div class="btn-group">
                                                    <?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-primary btn-flat', 'content' => lang('actions_submit'))); ?>
                                                    <?php echo form_button(array('type' => 'reset', 'class' => 'btn btn-warning btn-flat', 'content' => lang('actions_reset'))); ?>
                                                    <?php echo anchor('admin/cms', lang('actions_cancel'), array('class' => 'btn btn-default btn-flat')); ?>
                                                </div>
                                            </div>
                                        </div>
                              

 </div>
 </form>
                        </div>
                    </div>
                </section>
            </div>
