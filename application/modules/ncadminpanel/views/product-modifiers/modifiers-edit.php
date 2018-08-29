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
					          
                <?php echo form_open_multipart(admin_url().$module."/$module_action",' class="form-horizontal" id="common_form" ' );?>
						<ul class=" alert_msg  alert-danger  alert container_alert" style="display: none;">
						</ul>	
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('pro_cate_name').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo get_product_category('',$records['pro_modifier_category_id']);?></div></div>
						</div>
						
                         <div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('pro_modifier_name').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('pro_modifier_name',stripslashes($records['pro_modifier_name']),' class="form-control "   ');?></div></div>
						</div>
						
						    
		<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('pro_modifier_min_select').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><input type="number" class="form-control required" value="<?php echo $records['pro_modifier_min_select']; ?>" name="pro_modifier_min_select"></div></div>
						</div>
						
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('pro_modifier_max_select').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><input type="number" class="form-control required" value="<?php echo $records['pro_modifier_max_select']; ?>" name="pro_modifier_max_select"></div></div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('pro_modifier_sequence');?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box">
							<input type="number" class="form-control" value="<?php echo stripslashes($records['pro_modifier_sequence']); ?>" name="pro_modifier_sequence">
							</div></div>
						</div>
						
							<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('status').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo get_status_dropdown($records['pro_modifier_status'],'','class="required" style="width:374px;" ');;?></div></div>
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
					echo form_hidden('edit_id',$records['pro_modifier_primary_id']);
					echo form_hidden ( 'action', 'edit' );
					echo form_close ();
					?>
			
				</div>
			</div>
		</div>
	</div>
</div>
