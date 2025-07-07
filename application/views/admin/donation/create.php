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
                        <div class="col-md-12">


<?php //echo $error;?>

<?php echo form_open_multipart('admin/donation/do_upload');?>
<div class="box-body">
	<div class="form-group">
                                                <label class="col-sm-2 control-label">Title</label>
                                                <div class="col-sm-10">
                                                    
                                               <input type="text"  class="form-control" name="title" id="title" value="">
                                                   
                                                   
                                                </div>
                                            </div>
<br /><br />
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Description</label>
                                                <div class="col-sm-10">
                                                    
                                                        <input type="text"  class="form-control" name="desc" id="desc" value="">
                                                   
                                                   
                                                </div>
                                            </div>
                                            <br /><br />
                                             <div class="form-group">
                                                <label class="col-sm-2 control-label">Image</label>
                                                <div class="col-sm-10">
                                                    
                                                       <input type="file" name="userfile" size="20" />
                                                   
                                                   
                                                </div>
                                            </div>


<br /><br />

<div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <div class="btn-group">
                                                    <?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-primary btn-flat', 'content' => lang('actions_submit'))); ?>
                                                    <?php echo form_button(array('type' => 'reset', 'class' => 'btn btn-warning btn-flat', 'content' => lang('actions_reset'))); ?>
                                                    <?php echo anchor('admin/donation', lang('actions_cancel'), array('class' => 'btn btn-default btn-flat')); ?>
                                                </div>
                                            </div>
                                        </div>
</form>


                        </div>
                    </div>
                </section>
            </div>
