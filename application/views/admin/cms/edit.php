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
                        <div class="col-md-12">


<?php //echo $error;?>
<?php echo form_open_multipart('admin/cms/edit/'.$cms[0]['id']);?>
<div class="box-body">
	<div class="form-group">
                                                <label class="col-sm-2 control-label">Page Name</label>
                                                <div class="col-sm-10">
                                                    
                                               <input type="text" <?php if($cms[0]['id']==1 || $cms[0]['id']==6) echo 'readonly';?> class="form-control" name="title" id="title" value="<?php echo $cms[0]['title']?>">
                                                   
                                                   
                                                </div>
                                            </div>
<br /><br />

<?php if($cms[0]['id']==1) { ?>
<div class="box-body">
	<div class="form-group">
                                                <label class="col-sm-2 control-label">Title</label>
                                                <div class="col-sm-10">
                                                    
                                               <input type="text" class="form-control" name="home_title" id="home_title" value="<?php echo $cms[0]['home_title']?>">
                                                   
                                                   
                                                </div>
                                            </div>
	<br /><br />
	<?php } ?>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Description</label>
                                                <div class="col-sm-10">
                                                 <textarea rows="30" cols="110" name="desc" id="desc" ><?php echo $cms[0]['description'];?></textarea>    
                                                       
                                                   
                                                </div>
                                            </div>
                                            <br /><br />
                                             <div class="form-group">
                                                <label class="col-sm-2 control-label">Meta Title</label>
                                                <div class="col-sm-10">
                                                    
                                                       <input type="text"  class="form-control" name="meta_title" id="meta_title" value="<?php echo $cms[0]['meta_title']?>">
                                                   
                                                   
                                                </div>
                                               
                                            </div>
                                      <br /><br />      
                                             <div class="form-group clearfix">
                                                <label class="col-sm-2 control-label">Meta Description</label>
                                                <div class="col-sm-10">
                                                    
                                                       <input type="text"  class="form-control" name="meta_desc" id="meta_desc" value="<?php echo $cms[0]['meta_description']?>">
                                                   
                                                   
                                                </div>
                                               
                                            </div>


<br /><br />

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
