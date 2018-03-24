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
							<label for="post_category" class="col-sm-3 control-label"><?php echo get_label('post_category').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php echo form_dropdown('post_category',$post_category,'','class="form-control required" id="post_category"'); ?></div></div>
						</div>
						
						<div class="form-group">
							<label for="post_type" class="col-sm-3 control-label"><?php echo get_label('post_type').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_dropdown('post_type',array('blog'=>'blog','picture'=>'picture','video'=>'video','story'=>'story','book'=>'book','qa'=>'Q&A'),'','class="form-control required" id="post_type"'); ?></div></div>
						</div>
						
						<div class="form-group">
							<label for="post_title" class="col-sm-3 control-label"><?php echo get_label('post_title').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('post_title',set_value('post_title'),' class="form-control required"  ');?></div></div>
						</div>

						<div class="form-group">
							<label for="post_description" class="col-sm-3 control-label"><?php echo get_label('post_description').get_required();?></label>
                            <div class="col-sm-9"><div class="input_box">
							<?php echo $editor; ?>	
							</div></div>
						</div>
						
						<div class="form-group">
							<label for="post_photo" class="col-sm-3 control-label"><?php echo get_label('post_photo').get_required();?></label>
							<div class="col-sm-4"> <div class="input_box"> <div class="custom_browsefile"> 
							<input type="file" name="post_photo"   id="post_photo" class=""  /> <span class="result_browsefile"><span class="brows"></span>+ <?php echo get_label('upload_image');?></span> </div> </div> </div>
						</div>
						
						<div class="form-group upload_video" style="display:none">
							<label for="post_video" class="col-sm-3 control-label"><?php echo get_label('post_video').get_required();?></label>
							<div class="col-sm-4"> <div class="input_box"> <div class="custom_browsefile"> 
							<input type="file" name="post_video"   id="post_video" class=""  /> <span class="result_browsefile"><span class="brows"></span>+ <?php echo get_label('upload_video');?></span> </div> </div> </div>
						</div>
						
						<div class="form-group">
							<label for="status" class="col-sm-3 control-label"><?php echo get_label('status').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_dropdown('status',array ('' => get_label('select_status'),'A' => 'Active','I' => 'Inactive','D'=>'Draft'),'','class="form-control required" id="status" style="width:374px;"');?></div></div>
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
<script>
	$('#post_type').change(function(){
		if($(this).val() == 'video')
		{
			$('.upload_video').show();
		}
		else
		{
			$('.upload_video').hide();
		}
	});
</script>
