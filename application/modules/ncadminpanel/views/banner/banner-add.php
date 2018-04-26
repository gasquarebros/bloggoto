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
                <?php echo form_open_multipart(admin_url().$module.'/add',' class="form-horizontal" id="common_form" autocomplete="'.form_autocomplte().'" ' );?>
                      
                         
                         <div class="form-group">
							<label for="banner_name" class="col-sm-2 control-label"><?php echo get_label('banner_name').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('banner_name',set_value('banner_name'),' class="form-control required"  ');?></div></div>
						</div>
						
						<div class="form-group">
							<label for="banner_image" class="col-sm-2 control-label"><?php echo get_label('banner_image').get_required();?></label>
							<div class="col-sm-4"> <div class="input_box"> <div class="custom_browsefile"> 
							<input type="file" name="banner_image"   id="banner_image" class="required"  />
							<?php // echo form_upload('banner_image');?> <span class="result_browsefile"><span class="brows"></span>+ <?php echo get_label('upload_image');?></span> </div> </div> </div>
						</div>
						
						   <div class="form-group">
							<label for="banner_description" class="col-sm-2 control-label"><?php echo get_label('banner_description');?></label>
							<div class="col-sm-8"><div class="input_box"><?php  echo form_textarea('banner_description',set_value('banner_description'),' class="form-control"  ');?></div></div>
						</div>
						
						   <div class="form-group">
							<label for="banner_description_mobile" class="col-sm-2 control-label"><?php echo get_label('banner_description_mobile');?></label>
							<div class="col-sm-8"><div class="input_box"><?php  echo form_textarea('banner_description_mobile',set_value('banner_description_mobile'),' class="form-control"   ');?></div></div>
						</div>
						
						
						
						<div class="form-group">
							<label for="banner_sequence" class="col-sm-2 control-label"><?php echo get_label('banner_sequence');?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('banner_sequence',set_value('banner_sequence'),' class="form-control "   ');?></div></div>
						</div>
						
						<div class="form-group">
							<label for="status" class="col-sm-2 control-label"><?php echo get_label('status').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo get_status_dropdown('A','','class="required" style="width:374px;" ');;?></div></div>
						</div>
					
				

						
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-<?php echo get_form_size();?>  btn_submit_div">
                                <button type="submit" class="btn btn-primary " name="submit"
                                    value="Submit"><?php echo get_label('submit');?></button>
                                <a class="btn btn-info" href="<?php echo camp_url().$module;?>"><?php echo get_label('cancel');?></a>
                            </div>
                        </div>
					</div>

					<?php
					echo form_hidden ( 'action', 'Add' );
					echo form_close ();
					?>
			
				</div>
			</div>
		</div>
	</div>
</div>
