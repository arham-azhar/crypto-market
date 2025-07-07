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
                        <div class="col-md-12">
                             <div class="box">
                                 <div class="box-header with-border">
                                    <h3 class="box-title">CMS Management</h3>
                                </div>
                                <div class="box-body">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
												<th>#</th>
                                                <th><?php echo lang('contact_name');?></th>
                                                <th><?php echo lang('contact_email');?></th>
                                                <th><?php echo lang('contact_phone');?></th>
                                                <th><?php echo lang('contact_message');?></th>
                                                <th><?php echo lang('contact_date');?></th>
												<th><?php echo lang('contact_action');?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
	<?php $i=1;if(count($contacts) > 0) { foreach ($contacts as $contact):
  $desc=$contact['message'];
	?>
                                            <tr>
												<td><?php echo $i++;?></td>
                                                <td><?php echo htmlspecialchars($contact['name'], ENT_QUOTES, 'UTF-8'); ?></td>
                                                 <td><?php echo htmlspecialchars($contact['email'], ENT_QUOTES, 'UTF-8'); ?></td>
                                                 <td><?php echo htmlspecialchars($contact['phone'], ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php echo htmlspecialchars($desc, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php echo htmlspecialchars($contact['created_date'], ENT_QUOTES, 'UTF-8'); ?></td>
                                                  <td><?php echo anchor('admin/contact/erase/'.$contact['id'], lang('contact_delete')); ?></td>
                                               
                                               
                                            </tr>
<?php endforeach; } else {?>
	  <tr ><td colspan="5">No records found</td></tr>
	<?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                         </div>
                    </div>
                </section>
            </div>
