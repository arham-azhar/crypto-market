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
<?php echo form_open_multipart('admin/settings/customcss');?>
<div class="box-body">
		
                                                          
                                               <div class="form-group">
                                                <label class="col-sm-2 control-label"><?php echo lang('custom_css'); ?></label>
                                                <div class="col-sm-10">
                                                    
                                               <textarea rows="20" cols="115" name="custom_css" id="custom_css" ><?php echo $settings[0]['custom_css'];?></textarea>
                                                   
                                                   
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
</form>


                        </div>
                    </div>
                </section>
            </div>
