<script type="text/javascript" src="<?php echo load_lib();?>ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo load_lib();?>ckeditor/_samples/sample.js"></script>
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
                                <a  href="<?php echo admin_url().$module;?>" class="btn btn-info">Back</a>
                            </div>
                        </div>
                        
                        
					</div>                    
					<div class="card-body">
					<ul class=" alert_msg  alert-danger  alert container_alert" style="display: none;">
					
					</ul>	          
                <?php echo form_open_multipart(admin_url().$module.'/add',' class="form-horizontal" id="common_form" ' );?>
                         
                         <div class="form-group">
							<label for="inputEmail3" class="col-sm-3 control-label"><?php echo get_label('email_title').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('email_title',set_value('email_title'),' class="form-control required"  ');?></div></div>
						</div>

						<div class="form-group">
							<label for="inputEmail3" class="col-sm-3 control-label"><?php echo get_label('email_template').get_required();?></label>
                            <div class="col-sm-9"><div class="input_box">
							<?php  /*echo form_textarea('client_info',set_value('client_info'),'class="form-control" ' )*/ ?>
							<?php echo $editor; ?>
							
							</div></div>
						</div>

						 <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-<?php echo get_form_size();?>  btn_submit_div">
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

