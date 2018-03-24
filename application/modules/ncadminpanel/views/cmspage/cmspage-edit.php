<script type="text/javascript" src="<?php echo base_url();?>lib/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>lib/ckeditor/_samples/sample.js"></script>
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
						<?php echo form_open_multipart(admin_url().$module.'/edit/'.$result['cmspage_id'],' class="form-horizontal" id="common_form" autocomplete="'.form_autocomplte(). '"' );?>	
							<div class="form-group">
								<label for="cms_title" class="col-sm-2 control-label"><?php echo get_label('cms_title').get_required();?></label>
								<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('cms_title',stripslashes($result['cmspage_title']),' class="form-control required"  ');?></div></div>
								<?php echo form_error('cms_title'); ?>
							</div>
							
							<div class="form-group">
								<label for="cms_title" class="col-sm-2 control-label"><?php echo get_label('cms_slug').get_required();?></label>
								<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('cms_slug',stripslashes($result['cmspage_slug']),' class="form-control required"  ');?></div></div>
								<?php echo form_error('cms_slug'); ?>
							</div>
							
							
							<div class="form-group">
								<label for="cms_description" class="col-sm-2 control-label"><?php echo get_label('cms_description');?></label>
								<div class="col-sm-<?php echo get_form_editor_size();?>"><div class="input_box"><?php echo form_textarea('cms_description',stripslashes($result['cmspage_description']),' id="cms_description" rows="5" cols="200"'); ?></div></div>
							</div>     
							                       	
							<div class="form-group">
								<label for="cms_description_mobile" class="col-sm-2 control-label"><?php echo get_label('cms_description_mobile');?></label>
								<div class="col-sm-<?php echo get_form_editor_size();?>"><div class="input_box"><?php echo form_textarea('cms_description_mobile',stripslashes($result['cmspage_description_mobile']),' id="cms_description_mobile" rows="5" cols="200"'); ?></div></div>
							</div>                            	
								
							<div class="form-group">
								<label for="cms_meta_title" class="col-sm-2 control-label"><?php echo get_label('cms_meta_title');?></label>
								<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('cms_meta_title',stripslashes($result['cmspage_meta_title']),' class="form-control"  ');?></div></div>
							</div>
							
							 <div class="form-group">
								<label for="cms_meta_keyword" class="col-sm-2 control-label"><?php echo get_label('cms_meta_keyword');?></label>
								<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('cms_meta_keyword',stripslashes($result['cmspage_meta_keyword']),' class="form-control"  ');?></div></div>
							</div>
							
							 <div class="form-group">
								<label for="cms_meta_description" class="col-sm-2 control-label"><?php echo get_label('cms_meta_description');?></label>
								<div class="col-sm-<?php echo get_form_editor_size();?>"><div class="input_box"><?php echo form_textarea('cms_meta_description',stripslashes($result['cmspage_meta_description']),'class="form-control" id="cmspage_meta_description" '); ?></div></div>
							</div>
							
							
							<div class="form-group">
								<label for="status" class="col-sm-2 control-label"><?php echo get_label('status').get_required();?></label>
								<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo get_status_dropdown($result['cmspage_status'],'','class="required" style="width:374px;" ');?></div></div>
							</div>
							
							
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-<?php echo get_form_size();?>  btn_submit_div">
									<button type="submit" class="btn btn-primary " name="submit"
										value="Submit"><?php echo get_label('submit');?></button>
									<a class="btn btn-info" href="<?php echo camp_url().$module;?>"><?php echo get_label('cancel');?></a>
								</div>
							</div>
						<?php
						echo form_hidden('edit_id',$result['cmspage_id']);
						echo form_hidden ( 'action', 'edit' );
						echo form_close ();
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
CKEDITOR.replace( 'cms_description',
	{
		
		uiColor: '#DAF2FE',
		forcePasteAsPlainText:	true,
		toolbar :
        [
            ['Source','-','-'],
			['PasteFromWord','-', 'SpellChecker'],
			['SelectAll','RemoveFormat'],
			['ImageButton'],
			['Bold','Italic','Underline','-','Subscript','Superscript'],
			['NumberedList','BulletedList','-','Blockquote'],
			['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
			['Link','Unlink','Anchor'],
			['Image','Flash','Table','HorizontalRule','SpecialChar','PageBreak','Format','Font','FontSize','TextColor','BGColor']
        ],
		
		filebrowserBrowseUrl : '<?php echo $this->config->item('load_lib');?>ckfinder/ckfinder.html',
		filebrowserImageBrowseUrl : '<?php echo $this->config->item('load_lib');?>ckfinder/ckfinder.html?Type=Images',
		filebrowserFlashBrowseUrl : '<?php echo $this->config->item('load_lib');?>ckfinder/ckfinder.html?Type=Flash',
		filebrowserUploadUrl : '<?php echo $this->config->item('load_lib');?>ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
		filebrowserImageUploadUrl : '<?php echo $this->config->item('load_lib');?>ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
		filebrowserFlashUploadUrl : '<?php echo $this->config->item('load_lib');?>ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
		skin : 'kama'
	});
CKEDITOR.replace( 'cms_description_mobile',
	{
		
		uiColor: '#DAF2FE',
		forcePasteAsPlainText:	true,
		toolbar :
        [
            ['Source','-','-'],
			['PasteFromWord','-', 'SpellChecker'],
			['SelectAll','RemoveFormat'],
			['ImageButton'],
			['Bold','Italic','Underline','-','Subscript','Superscript'],
			['NumberedList','BulletedList','-','Blockquote'],
			['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
			['Link','Unlink','Anchor'],
			['Image','Flash','Table','HorizontalRule','SpecialChar','PageBreak','Format','Font','FontSize','TextColor','BGColor']
        ],
		
		filebrowserBrowseUrl : '<?php echo $this->config->item('load_lib');?>ckfinder/ckfinder.html',
		filebrowserImageBrowseUrl : '<?php echo $this->config->item('load_lib');?>ckfinder/ckfinder.html?Type=Images',
		filebrowserFlashBrowseUrl : '<?php echo $this->config->item('load_lib');?>ckfinder/ckfinder.html?Type=Flash',
		filebrowserUploadUrl : '<?php echo $this->config->item('load_lib');?>ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
		filebrowserImageUploadUrl : '<?php echo $this->config->item('load_lib');?>ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
		filebrowserFlashUploadUrl : '<?php echo $this->config->item('load_lib');?>ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
		skin : 'kama'
	});
	
</script>
