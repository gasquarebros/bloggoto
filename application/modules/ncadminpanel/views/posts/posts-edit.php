<script type="text/javascript" src="<?php echo load_lib();?>ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo load_lib();?>ckeditor/_samples/sample.js"></script>
<link href="http://vjs.zencdn.net/c/video-js.css" rel="stylesheet">
    <script src="http://vjs.zencdn.net/c/video.js"></script>
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
                <?php echo form_open_multipart(admin_url().$module."/$module_action",' class="form-horizontal" id="common_form" ' );?>
						 <div class="form-group">
							<label for="post_category" class="col-sm-3 control-label"><?php echo get_label('post_category').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php echo form_dropdown('post_category',$post_category,$records['post_category'],'class="form-control required" id="post_category"'); ?></div></div>
						</div>
						
						<div class="form-group">
							<label for="post_type" class="col-sm-3 control-label"><?php echo get_label('post_type').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_dropdown('post_type',array('blog'=>'blog','picture'=>'picture','video'=>'video','story'=>'story','book'=>'book','qa'=>'Q&A'),$records['post_type'],'class="form-control required" id="post_type"'); ?></div></div>
						</div>
						
						<div class="form-group">
							<label for="post_title" class="col-sm-3 control-label"><?php echo get_label('post_title').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('post_title',$records['post_title'],' class="form-control required"  ');?></div></div>
						</div>
						<div class="form-group">
							<label for="post_description" class="col-sm-3 control-label"><?php echo get_label('post_description').get_required();?></label>
                            <div class="col-sm-9"><div class="input_box">
							<?php echo $editor; ?>
							
							</div></div>
						</div>
						
						<div class="form-group">
							
                             <?php if($records['post_photo']){ ?>
                              <div class="col-sm-offset-3 col-xs-9 col-md-9 show_image_box">
							<a class="thumbnail"    href="javascript:;" title="<?php echo get_label('remove_image_title');?>">
							<img class="img-responsive common_delete_image" style="width: 250px; height:250px;"  src="<?php echo media_url().get_company_folder()."/". $this->lang->line('post_photo_folder_name')."/".$records['post_photo'];?>">
							</a>
							</div><?php } ?>
                        </div>
						
						<div class="form-group">
							<label for="post_photo" class="col-sm-3 control-label"><?php echo get_label('post_photo').get_required();?></label>
							<div class="col-sm-4"> <div class="input_box"> <div class="custom_browsefile"> 
							<input type="file" name="post_photo"   id="post_photo" class=""  /> <span class="result_browsefile"><span class="brows"></span>+ <?php echo get_label('upload_image');?></span> </div> </div> </div>
						</div>
						
						<div class="form-group upload_video">
							
                            <?php if($records['post_video']){ ?>
								<div class="col-sm-offset-3 col-xs-9 col-md-9 show_image_box">
									<video width="320" height="240" controls="">
										<source src="<?php echo media_url().get_company_folder()."/". $this->lang->line('post_video_folder_name')."/".$records['post_video'];?>" type="video/wmv">Your browser does not support the video tag.</source>
										<source src="<?php echo media_url().get_company_folder()."/". $this->lang->line('post_video_folder_name')."/".$records['post_video'];?>" type="video/ogg">Your browser does not support the video tag.</source>
										<source src="<?php echo media_url().get_company_folder()."/". $this->lang->line('post_video_folder_name')."/".$records['post_video'];?>" type="video/mp4">Your browser does not support the video tag.</source>
										<source src="<?php echo media_url().get_company_folder()."/". $this->lang->line('post_video_folder_name')."/".$records['post_video'];?>" type="video/mkv">Your browser does not support the video tag.</source>
										<source src="<?php echo media_url().get_company_folder()."/". $this->lang->line('post_video_folder_name')."/".$records['post_video'];?>" type="video/3gp"></source>
										<source src="<?php echo media_url().get_company_folder()."/". $this->lang->line('post_video_folder_name')."/".$records['post_video'];?>" type="video/flv">Your browser does not support the video tag.</source>
										<source src="<?php echo media_url().get_company_folder()."/". $this->lang->line('post_video_folder_name')."/".$records['post_video'];?>" type="video/x-flv">Your browser does not support the video tag.</source>
									</video>
								</div>
							<?php } ?>
                        </div>
						
						<div class="form-group upload_video" <?php if($records['post_type'] != 'video') echo 'style="display:none"'; ?>>
							<label for="post_video" class="col-sm-3 control-label"><?php echo get_label('post_video').get_required();?></label>
							<div class="col-sm-4"> <div class="input_box"> <div class="custom_browsefile"> 
							<input type="file" name="post_video"   id="post_video" class=""  /> <span class="result_browsefile"><span class="brows"></span>+ <?php echo get_label('upload_video');?></span> </div> </div> </div>
						</div>
						
						<div class="form-group">
							<label for="status" class="col-sm-3 control-label"><?php echo get_label('status').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_dropdown('status',array ('' => get_label('select_status'),'A' => 'Active','I' => 'Inactive','D'=>'Draft'),$records['post_status'],'class="form-control required" id="status" style="width:374px;"');?></div></div>
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
					echo form_hidden('post_slug',$records['post_slug']);
					echo form_hidden('edit_id',$records['post_id']);
					echo form_hidden ( 'action', 'edit' );
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
