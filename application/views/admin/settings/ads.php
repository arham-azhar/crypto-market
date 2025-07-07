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
<?php echo form_open_multipart('admin/settings/ads/');?>
<div class="box-body">
	
									<div class="form-group">
                                                <label class="col-sm-2 control-label"><?php echo lang('header_ads'); ?></label>
                                                <div class="col-sm-10">
                                                    
                                                        <textarea rows="8" cols="80" name="header_ads" id="header_ads"><?php echo $ads[0]['header_ads'];?></textarea> 
                                                   
                                                   
                                                </div>
                                            </div>
												<br/><br/>		
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label"><?php echo lang('footer_ads'); ?></label>
                                                 <div class="col-sm-10">
                                                    
                                                        <textarea rows="8" cols="80" name="footer_ads" id="footer_ads"><?php echo $ads[0]['footer_ads'];?></textarea> 
                                                   
                                                   
                                                </div>
                                            </div>
                                            </div>
                                            <br/><br/>		
                                             <div class="form-group">
                                                <label class="col-sm-2 control-label"><?php echo lang('pref'); ?></label>
                                                <div class="col-sm-10">
                                                <input type="radio" name="pref" id="pref" <?php if($ads[0]['pref']==0) echo 'checked'?> value="0"> Header &nbsp;&nbsp;&nbsp;&nbsp;
                                                <input type="radio" name="pref" id="pref" <?php if($ads[0]['pref']==1) echo 'checked'?> value="1"> Footer &nbsp;&nbsp;&nbsp;&nbsp;
                                                 <input type="radio" name="pref" id="pref" <?php if($ads[0]['pref']=='2') echo 'checked'?> value="2"> Both &nbsp;&nbsp;&nbsp;&nbsp;
                                                  <input type="radio" name="pref" id="pref" <?php if($ads[0]['pref']==3) echo 'checked'?> value="3"> None &nbsp;&nbsp;&nbsp;&nbsp;
                                                    
                                                     
                                                   
                                                   
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
