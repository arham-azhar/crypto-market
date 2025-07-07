<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

            <div class="content-wrapper">
                <section class="content-header">
                    <?php echo $pagetitle; ?>
                    <?php echo $breadcrumb; ?>
                </section>
<?php echo form_open_multipart('admin/donation/edit_heading');?>
<div class="box-body">
						<?php

							if($this->session->flashdata('message')) {
						?>
						<div class="alert alert-success">
				<a href="#" class="close" data-dismiss="alert">&times;</a>
					<?php echo $this->session->flashdata('message'); ?>
				</div>
						<?php } ?>
	
				                                         
                                             <div class="form-group">
                                                <label class="col-sm-2 control-label">Main Title</label>
                                                <div class="col-sm-10">
													 <input type="text"  class="form-control" name="heading" id="heading" value="<?php echo $donations[0]['heading'];?>">
                                             
                                                      
                                                   
                                                   
                                                </div>
                                            </div>
                                            <br/> <br/>
                                          
                                             
                                             <div class="form-group">
                                                <label class="col-sm-2 control-label">Main Description</label>
                                                <div class="col-sm-10">
													
                                                        <input type="text"  class="form-control" name="paragraph" id="paragraph" value="<?php echo $donations[0]['paragraph'];?>">
                                                   
                                                        
                                                   
                                                   
                                                </div>
                                            </div>
                                            
                                           
                                             <br/> <br/>
                                             
                                             
                                              
                                              
                                             
<div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <div class="btn-group">
                                                    <?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-primary btn-flat', 'content' => lang('actions_submit'))); ?>
                                                    <?php echo form_button(array('type' => 'reset', 'class' => 'btn btn-warning btn-flat', 'content' => lang('actions_reset'))); ?>
                                                  
                                                </div>
                                            </div>
                                        </div>
                                         </div>
                                        
</form>
                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                             <div class="box">
                             <!--   <div class="box-header with-border">
                                    <h3 class="box-title"><?php echo anchor('admin/donation/create', '<i class="fa fa-plus"></i> '. lang('donation_create'), array('class' => 'btn btn-block btn-primary btn-flat')); ?></h3>
                                </div> -->
                                <div class="box-body">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th><?php echo lang('donation_title');?></th>
                                                <th><?php echo lang('donation_description');?></th>
                                                <th><?php echo lang('donation_image');?></th>
                                                <!--<th><?php echo lang('donation_status');?></th>-->
                                                <th><?php echo lang('donation_action');?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php foreach ($donations as $donation):?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($donation['title'], ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php echo htmlspecialchars($donation['description'], ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td>  <img src="<?php echo base_url()?>upload/<?php echo $donation['image'];?>" width="20" height="20"></td>
                                               
                                                <!--<td><?php echo ($donation['active']) ? anchor('admin/donation/deactivate/'.$donation['id'], '<span class="label label-success">'.lang('donation_active').'</span>') : anchor('admin/donation/activate/'. $donation['id'], '<span class="label label-default">'.lang('donation_inactive').'</span>'); ?></td>-->
                                                <td>
                                                    <?php echo anchor('admin/donation/edit/'.$donation['id'], lang('actions_edit')); ?>
                                                   
                                                </td>
                                            </tr>
<?php endforeach;?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                         </div>
                    </div>
                </section>
            </div>
