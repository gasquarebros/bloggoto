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
							<label for="banner_name" class="col-sm-2 control-label"><?php echo get_label('banner_name').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('banner_name',stripslashes($records['banner_name']),' class="form-control "   ');?></div></div>
						</div>
						
							<div class="form-group">
							<label for="banner_image" class="col-sm-2 control-label"><?php echo get_label('banner_image').get_required();?></label>
							<div class="col-sm-4"> <div class="input_box"> <div class="custom_browsefile"> <?php echo form_upload('banner_image');?> <span class="result_browsefile"><span class="brows"></span>+ Upload Image</span> </div> </div> </div>
                            							
						</div>
                        <div class="form-group">
							
                             <?php if($records['banner_image']){ ?>
                              <div class="col-sm-offset-2 col-xs-10 col-md-10 show_image_box">
							<a class="thumbnail"    href="javascript:;" title="<?php echo get_label('remove_image_title');?>">
							<img class="img-responsive common_delete_image" style="width: 250px; height:250px;"  src="<?php echo media_url().get_company_folder()."/". $this->lang->line('banner_image_folder_name')."/".$records['banner_image'];?>">
							</a>
							</div><?php } ?>
                        </div>
						
						   <div class="form-group">
							<label for="banner_description" class="col-sm-2 control-label"><?php echo get_label('banner_description');?></label>
							<div class="col-sm-8"><div class="input_box"><?php  echo form_textarea('banner_description',stripslashes($records['banner_description']),' class="form-control"  ');?></div></div>
						</div>
						
						   <div class="form-group">
							<label for="banner_description_mobile" class="col-sm-2 control-label"><?php echo get_label('banner_description_mobile');?></label>
							<div class="col-sm-8"><div class="input_box"><?php  echo form_textarea('banner_description_mobile',stripslashes($records['banner_description_mobile']),' class="form-control"   ');?></div></div>
						</div>
						
					
						
						<div class="form-group">
							<label for="banner_sequence" class="col-sm-2 control-label"><?php echo get_label('banner_sequence');?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('banner_sequence',stripslashes($records['banner_sequence']),' class="form-control "   ');?></div></div>
						</div>
						
						<div class="form-group">
							<label for="status" class="col-sm-2 control-label"><?php echo get_label('status').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo get_status_dropdown($records['banner_status'],'','class="required" style="width:374px;" ');;?></div></div>
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
					echo form_hidden('edit_id',$records['banner_id']);
					echo form_hidden ( 'action', 'edit' );
					echo form_close ();
					?>
			
				</div>
			</div>
		</div>
	</div>
</div>
