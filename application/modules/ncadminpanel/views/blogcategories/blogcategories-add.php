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
							<label for="blog_cat_name" class="col-sm-2 control-label"><?php echo get_label('blog_cat_name').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('blog_cat_name',set_value('blog_cat_name'),' class="form-control required"  ');?></div></div>
						</div>

						<div class="form-group">
							<label for="blog_cat_description" class="col-sm-2 control-label"><?php echo get_label('blog_cat_description');?></label>
							<div class="col-sm-8"><div class="input_box"><?php  echo form_textarea('blog_cat_description',set_value('blog_cat_description'),' class="form-control"   ');?></div></div>
						</div>


						<div class="form-group">
							<label for="blog_cat_sequence" class="col-sm-2 control-label"><?php echo get_label('blog_cat_sequence');?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('blog_cat_sequence',set_value('blog_cat_sequence'),' class="form-control "   ');?></div></div>
						</div>
<?php /*
						<div class="form-group custom_ttile" style='display:none;'>
							<label for="custom_title" class="col-sm-2 control-label"><?php echo get_label('menu_custom_title');?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('custom_title','',' class="form-control "   ');?></div></div>
						</div>*/ ?>
						
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('status').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo get_status_dropdown('A','','class="required" style="width:374px;" '); ?></div></div>
						</div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-<?php echo get_form_size();?>  btn_submit_div">
                                <button type="submit" class="btn btn-primary " name="submit"
                                    value="Submit"><?php echo get_label('submit');?></button>
                                <a class="btn btn-info" href="<?php echo admin_url().$module;?>"><?php echo get_label('cancel');?></a>
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
