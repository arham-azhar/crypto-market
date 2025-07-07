<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

            <div class="content-wrapper">
                <section class="content-header">
                    <?php echo $pagetitle; ?>
                    <?php echo $breadcrumb; ?>
                </section>

                <section class="content">
					<?php

							if($this->session->flashdata('message')) {
						?>
						<div class="alert alert-success">
				<a href="#" class="close" data-dismiss="alert">&times;</a>
					<?php echo $this->session->flashdata('message'); ?>
				</div>
						<?php } ?>
                    <div class="row">
                        <div class="col-md-12">
                             <div class="box">
                                 <div class="box-header with-border">
                                    <h3 class="box-title">CMS Management</h3>
                                </div>
                                <div class="box-body">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th><?php echo lang('cms_title');?></th>
                                                <th><?php echo lang('cms_navigation');?></th>
                                                <th><?php echo lang('cms_description');?></th>
                                                <th><?php echo lang('cms_status');?></th>
                                                <th><?php echo lang('cms_action');?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
	<?php foreach ($cmsData as $cms):
	if(strlen($cms['description'])<=100)
  $desc=$cms['description'];
  else
  
    $desc=substr($cms['description'],0,100) . '...';
    
	?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($cms['title'], ENT_QUOTES, 'UTF-8'); ?></td>
                                                 <td><?php echo htmlspecialchars($cms['navigation'], ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php echo htmlspecialchars($desc, ENT_QUOTES, 'UTF-8'); ?></td>
                                                 <td><?php echo ($cms['active']) ? anchor('admin/cms/deactivate/'.$cms['id'], '<span class="label label-success">'.lang('cms_active').'</span>') : anchor('admin/cms/activate/'. $cms['id'], '<span class="label label-default">'.lang('cms_inactive').'</span>'); ?></td>
                                                <td>
                                                    <?php echo anchor('admin/cms/edit/'.$cms['id'], lang('actions_edit')); ?>
                                                   
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
