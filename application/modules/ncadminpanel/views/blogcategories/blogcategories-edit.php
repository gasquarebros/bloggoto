<div class="container-fluid">
	<div class="side-body">
		<div class="row">
			<div class="col-xs-12">
				<div class="card">
					<div class="card-header">
						<div class="card-title">
							<div class="title"><?php echo $form_heading;?>   </div>
						</div>
                        <div class="pull-right card-action">
                            <div class="btn-group" role="group" aria-label="...">
                                <a  href="<?php echo admin_url().$module;?>" class="btn btn-info"><?php echo get_label('back');?></a>
                            </div>
                        </div>
                        
                        
					</div>

					<div class="card-body">
					<ul class=" alert_msg  alert-danger  alert container_alert" style="display: none;">
					
					</ul>	          
                <?php echo form_open_multipart(admin_url().$module."/$module_action",' class="form-horizontal" id="common_form" ' );?>
                         <div class="form-group">
							<label for="blog_cat_name" class="col-sm-2 control-label"><?php echo get_label('blog_cat_name').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('blog_cat_name',stripslashes($records['blog_cat_name']),' class="form-control "   ');?></div></div>
						</div>

						
						<div class="form-group">
							<label for="blog_cat_description" class="col-sm-2 control-label"><?php echo get_label('blog_cat_description');?></label>
							<div class="col-sm-8"><div class="input_box"><?php  echo form_textarea('blog_cat_description',stripslashes($records['blog_cat_description']),' class="form-control"   ');?></div></div>
						</div>

						<div class="form-group">
							<label for="blog_cat_sequence" class="col-sm-2 control-label"><?php echo get_label('blog_cat_sequence');?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('blog_cat_sequence',stripslashes($records['blog_cat_sequence']),' class="form-control "   ');?></div></div>
						</div>
						<?php /*						
						
						<div class="form-group">
							<label for="menu_navigation" class="col-sm-2 control-label"><?php echo get_label('enable_menu_navigation');?></label>
							<?php if(!empty($custom_menus)) { $is_menu='Yes'; } else { $is_menu=''; } ?>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><div class="checkbox3 checkbox-inline checkbox-check checkbox-light">  <?php echo form_checkbox('menu_navigation','Yes',$is_menu,'id="menu_navigation"')?> <label for="menu_navigation" class="chk_box_label"><b></b></label> </div> </div></div>
						</div>

						
						<?php if(!empty($custom_menus)) { $custom_title=$custom_menus['menu_custom_title']; } else { $custom_title=''; } ?>
						<div class="form-group custom_ttile" <?php if(!empty($custom_menus)) { echo "style='display:block;'"; } else { echo "style='display:none;'"; } ?>>
							<label for="custom_title" class="col-sm-2 control-label"><?php echo get_label('menu_custom_title');?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('custom_title',stripslashes($custom_title),' class="form-control "   ');?></div></div>
						</div>
						*/ ?>
								
						<div class="form-group">
							<label for="status" class="col-sm-2 control-label"><?php echo get_label('status').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo get_status_dropdown($records['blog_cat_status'],'','class="required" style="width:374px;" ');;?></div></div>
						</div>

						
                        
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-<?php echo get_form_size();?>  btn_submit_div">
                                <button type="submit" class="btn btn-primary " name="submit"
                                    value="Submit"><?php echo get_label('submit');?></button>
                                <a class="btn btn-info" href="<?php echo admin_url().$module;?>"><?php echo get_label('cancel');?></a>
                            </div>
                        </div>
					</div>
					<input type="hidden" value="" name="remove_image" id="remove_image">
					<?php
					echo form_hidden('edit_id',$records['blog_cat_id']);
					echo form_hidden ( 'action', 'edit' );
					echo form_close ();
					?>
			
				</div>
			</div>
		</div>
	</div>
</div>
