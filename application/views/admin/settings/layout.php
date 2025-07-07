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
<?php echo form_open_multipart('admin/settings/layout/');?>
<div class="box-body">
	
									<div class="form-group">
                                                <label class="col-sm-2 control-label">Title</label>
                                                <div class="col-sm-10">
                                                   <input type="text"  class="form-control" name="name" id="name" value="<?php echo $layout[0]['name'];?>">  
                                                      
                                                   
                                                   
                                                </div>
                                            </div>
												<br/><br/>		
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Description</label>
                                                 <div class="col-sm-10">
                                                    <input type="text"  class="form-control" name="desc" id="desc" value="<?php echo $layout[0]['description'];?>"> 
                                                   
                                                </div>
                                            </div>
                                            </div>
                                            <br/><br/>		
                                             <div class="form-group">
                                                <label class="col-sm-2 control-label">Background Color</label>
                                                 <div class="col-sm-10">
                                                    
                                                        <input type="text"  class="form-control" name="bgcolor" id="bgcolor" value="<?php echo $layout[0]['bgcolor'];?>"> 
                                                   
                                                   
                                                </div>
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
