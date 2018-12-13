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
						<ul class=" alert_msg  alert-danger  alert container_alert" style="display: none;">
						</ul>	
						<div class="form-group">
							<label for="pro_cate_name" class="col-sm-2 control-label"><?php echo get_label('pro_cate_name').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box">
								<?php echo get_service_category('',$records['pro_subcate_category_id']); ?>
							</div></div>
						</div>
						
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('pro_subcate_name').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('pro_subcate_name',stripslashes($records['pro_subcate_name']),' class="form-control "   ');?></div></div>
						</div>
				
						
						   <div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('pro_subcate_short_desc');?></label>
							<div class="col-sm-8"><div class="input_box"><?php  echo form_textarea('pro_subcate_short_desc',stripslashes($records['pro_subcate_short_description']),' class="form-control"  ');?></div></div>
						</div>
						
						   <div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('pro_subcate_desc');?></label>
							<div class="col-sm-8"><div class="input_box"><?php  echo form_textarea('pro_subcate_desc',stripslashes($records['pro_subcate_description']),' class="form-control"   ');?></div></div>
						</div>
						
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('pro_subcate_image');?></label>
							<div class="col-sm-4"> <div class="input_box"> <div class="custom_browsefile"> <?php echo form_upload('pro_subcate_image');?> <span class="result_browsefile"><span class="brows"></span>+ <?php echo get_label('upload_image');?></span> </div> </div> </div>
                            							
						</div>
                        <div class="form-group">
                             <?php if($records['pro_subcate_image']){ ?>
                              <div class="col-sm-offset-2 col-xs-10 col-md-10 show_image_box">
							<a class="thumbnail"    href="javascript:;" title="<?php echo get_label('remove_image_title');?>">
							<img data-id="remove_image" class="img-responsive common_delete_other_image" style="width: 250px; height:250px;"  src="<?php echo media_url().get_company_folder()."/". $this->lang->line('service_subcategory_image_folder_name')."/".$records['pro_subcate_image'];?>">
							</a>
							</div><?php } ?>
                        </div>
                        
						
						
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('pro_subcate_sequence');?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('pro_subcate_sequence',stripslashes($records['pro_subcate_sequence']),' class="form-control "   ');?></div></div>
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
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('status').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo get_status_dropdown($records['pro_subcate_status'],'','class="required" style="width:374px;" ');;?></div></div>
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
					echo form_hidden('edit_id',$records['pro_subcate_primary_id']);
					echo form_hidden ( 'action', 'edit' );
					echo form_close ();
					?>
			
				</div>
			</div>
		</div>
	</div>
</div>
