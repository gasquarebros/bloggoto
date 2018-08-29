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
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('pro_modifier_label').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo get_product_modifier(array('pro_modifier_status' => 'A'),$records['pro_modifier_value_modifier_primary_id'],' class="search_select required" ');?></div></div>
						</div>
						
                         <div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('pro_modifier_value_name').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('pro_modifier_value_name',stripslashes($records['pro_modifier_value_name']),' class="form-control "   ');?></div></div>
						</div>
						
							   <div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('pro_modifier_value_price');?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box">
							<input  type="number" name="pro_modifier_value_price" id="pro_modifier_value_name" value="<?php echo output_integer($records['pro_modifier_value_price']); ?>" class="form-control"   >
							</div></div>
						</div>
						
						   
						
								<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('pro_modifier_value_image');?></label>
							<div class="col-sm-4"> <div class="input_box"> <div class="custom_browsefile"> <?php echo form_upload('pro_modifier_value_image');?> <span class="result_browsefile"><span class="brows"></span>+ <?php echo get_label('upload_image');?></span> </div> </div> </div>
                            							
						</div>
						      <?php if($records['pro_modifier_value_image']){ ?>
						     <div class="form-group show_image_box">
                       
                              <div class="col-sm-offset-2 col-xs-10 col-md-10 ">
							<a class="thumbnail"    href="javascript:;" title="<?php echo get_label('remove_image_title');?>">
							<img class="img-responsive common_delete_image" style="width: 250px; height:250px;"  src="<?php echo media_url().get_company_folder()."/". $this->lang->line('product_modifiervalues_image_folder_name')."/".$records['pro_modifier_value_image'];?>">
							</a>
							</div>
                        </div>
						<?php } ?>
	
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('pro_modifier_value_sequence');?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('pro_modifier_value_sequence',stripslashes($records['pro_modifier_value_sequence']),' class="form-control "   ');?></div></div>
						</div>
						
						<div class="form-group">
																<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('makeit_default');?><?php echo add_tooltip('makeit_default');?></label> 
																<div class="col-sm-8"><div class="input_box"><div class="checkbox3 checkbox-inline checkbox-check checkbox-light">  <?php echo form_checkbox('is_default','Yes',($records['pro_modifier_value_is_default']=="Yes" ? "Yes" : ""),' id="is_default" ')?> <label for="is_default" class="chk_box_label"><b></b></label> </div> </div></div>
															</div>
															
							<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('status').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo get_status_dropdown($records['pro_modifier_value_status'],'','class="required" style="width:374px;" ');;?></div></div>
						</div>

						
                        
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-<?php echo get_form_size();?>  btn_submit_div">
                                <button type="submit" class="btn btn-primary " name="submit"
                                    value="Submit"><?php echo get_label('submit');?></button>
                                <a class="btn btn-info" href="<?php echo camp_url().$module;?>"><?php echo get_label('cancel');?></a>
                            </div>
                        </div>
					</div>
        <input type="hidden" value="" name="remove_image" id="remove_image">
					<?php
					echo form_hidden('modifier',encode_value($records['pro_modifier_value_modifier_primary_id']));
					echo form_hidden('edit_id',$records['pro_modifier_value_primary_id']);
					echo form_hidden ( 'action', 'edit' );
					echo form_close ();
					?>
			
				</div>
			</div>
		</div>
	</div>
</div>
