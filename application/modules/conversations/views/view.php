<script type="text/javascript" src="<?php echo load_lib();?>ckeditor/ckeditor/ckeditor.js"></script>
<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
$notify_logo = skin_url('images/db-logo2.png');
?>
<style>


.margin-top-15 {

    margin-top: 15px;

}
.btn.btn-sm.trash {

    margin-bottom: 5px;

}
.btn.btn-sm.small {

    margin-bottom: 5px;

}
.inbx_left { min-height: auto !important; }
.timeline-entry {

    margin-bottom: 50px;
    margin-top: 5px !important;
    position: relative;
    clear: both;
	width: 100%;
	float: left;

}
.margin-top-10 {
    margin-top: 10px;
}

.margin-top-20 {

    margin-top: 20px;

}
.margin-top-20 {

    margin-top: 20px;

}
.timeline-stat {

    width: 100px;
    float: left;
    text-align: center;

}


.panel {
    border: 0;
}
.timeline-label {
    background-color: #ffffff;
    border-radius: 0;
    padding: 10px;
    position: relative;
    min-height: 50px;
    border: 1px solid #e9e9e9;
    box-shadow: 0 2px 0 rgba(0,0,0,0.05);
}
.timeline-label {
    padding: 0px !important;
}
.timeline-label {
    background-color: #ffffff;
    border: 1px solid #e9e9e9;
}

.timeline-label::before {
    border-color: rgba(233, 233, 233, 0);
        border-right-color: rgba(233, 233, 233, 0);
    border-right-color: #e9e9e9;
    border-width: 11px;
    margin-top: -11px;
}

.timeline-entry .panel-heading {
    position: relative;
    border-bottom: 1px solid rgba(0,0,0,0.1);
    overflow: hidden;
}
.panel .panel-heading, .panel .panel-body, .panel .panel-footer {
    padding-left: 25px;
    padding-right: 25px;
}
.panel .panel-heading {
    position: relative;
}
.panel .panel-heading, .panel .panel-body, .panel .panel-footer {
    padding-left: 25px;
    padding-right: 25px;
}
.panel-heading {
    font-size: 13px;
}
.panel-heading {
    border-bottom: 1px solid #d8cccc;
}
.panel-heading {
    padding: 10px 15px;
        padding-right: 15px;
        padding-left: 15px;
    border-top-left-radius: 3px;
    border-top-right-radius: 3px;
}

.text-info {
    color: #d4d4d4;
}

.panel .panel-heading, .panel .panel-body, .panel .panel-footer {
    padding-left: 25px;
    padding-right: 25px;
}
.panel .panel-body {
    padding-top: 10px;
    padding-bottom: 15px;
    font-size: 20px;
    font-family: 'open_sansregular';
}
.panel .panel-heading, .panel .panel-body, .panel .panel-footer {
    padding-left: 25px;
    padding-right: 25px;
}



.timeline-label::after {

    border-color: rgba(255, 255, 255, 0);
        border-right-color: rgba(255, 255, 255, 0);
    border-right-color: #fff;
    border-width: 10px;
    margin-top: -10px;

}
.timeline-label::after, .timeline-label::before {

    right: 100%;
    top: 19%;
    border: solid transparent;
        border-top-width: medium;
        border-right-width: medium;
        border-bottom-width: medium;
        border-left-width: medium;
        border-top-color: transparent;
        border-right-color: transparent;
        border-bottom-color: transparent;
        border-left-color: transparent;
    content: " ";
    height: 0;
    width: 0;
    position: absolute;
    pointer-events: none;

}

.collapse {
    display: none;
}
.timeline-stat {

    width: 100% !important;
    float: left;
    text-align: center;

}
.timeline-label {

    background-color: #ffffff;
    border: 1px solid #e9e9e9;
    clear: both;
    float: left;
    width: 100%;
}
.timeline-stat small {

    float: left;
    width: 50px;

}
.message-heading {

    width: 80%;
    float: left;
    margin-left: 5px;

}
.timeline-stat .panel-title.panel-title-small {

    float: left;
    width: 100%;
    margin-left: 5px;
    text-align: left;

}
</style>
<section>
	<div class="container">
		<div class="page_content">
			<div class="col-md-3">
				<?php $this->load->view('left_side'); ?>
			</div>
			<div class="col-md-9">
				<div id="page-title" class="fully_covered">
					<h1 class="page-header text-overflow"></h1>
				</div>
				<div class="inbx_right performance_height conversation_view">
					<div id="page-content">
						<div class="panel">
							<div class="panel-heading">
								<div class="panel-control">
									<span class="margin-top-5 margin-left-10">
									<?php
									if($notification[0]['to_delete']=='Y') {
										?>
										<span><a class="trash" data-method="post" href="javascript:"  data-confirm="<?=get_label('trash_conf')?>" data-ids="<?=$notification[0]['notification_id']?>" data-types="3"><span class="margin-left-10 small" ><?=get_label('c_restore_message')?></span></a></span>
										<?php } 
										else {
											?>
										<a class="btn btn-sm trash" data-confirm="<?=get_label('trash_conf')?>" data-ids="<?=$notification[0]['notification_id']?>" data-types="1" href="javascript:" ><span class="small"><i class="fa fa-trash margin-right-5"></i><?=get_label('c_move_to_trash')?></span></a>
										<?php } ?>
									</span>
									<span class="margin-top-5">
										<a class="btn btn-sm small" href="<?=base_url('conversations')?>">
											<span class="small">
												<i class="fa fa-reply margin-right-5"></i>
												<?=get_label('c_back_to_inbox')?>
											</span>
										</a>
									</span>
								</div>
								<h3 class="panel-title panel-title-small"><label>Subject :</label>
									<?=$notification[0]['subject']?>
								</h3>
							</div>
							<?php if($notification[0]['message_type'] != 'N') { ?>
							<div class="panel-body">
								<small class="block text-info text-semibold">
									<?php
									if($allusers[$notification[0]['assigned_to']]['customer_type'] == 1) {
										$name = (!empty($allusers[$notification[0]['assigned_to']]) && $notification[0]['assigned_to']!='' && $notification[0]['message_type'] != 'N')?$allusers[$notification[0]['assigned_to']]['company_name']:'Anonymous';	
									} else {
										$name = (!empty($allusers[$notification[0]['assigned_to']]) && $notification[0]['assigned_to']!='' && $notification[0]['message_type'] != 'N')?$allusers[$notification[0]['assigned_to']]['customer_first_name']:'Anonymous';
									}

									if(!empty($allusers[$notification[0]['assigned_from']]) && $allusers[$notification[0]['assigned_from']]['customer_type'] == 1) {
										$from_name = (!empty($allusers[$notification[0]['assigned_from']]) && $notification[0]['assigned_from']!='')?$allusers[$notification[0]['assigned_from']]['company_name']:'';
									} else {
										$from_name = (!empty($allusers[$notification[0]['assigned_from']]) && $notification[0]['assigned_from']!='')?$allusers[$notification[0]['assigned_from']]['customer_first_name']:'';
									}
									echo '<em>Conversation between </em>'.$name.' , '.$from_name;
									?>
								</small>
								<?php 
								$blocked_users = get_all_block_users();
								if(!in_array($notification[0]['assigned_from'],$blocked_users))
								{
								?>
									<p class="margin-top-10">
										<a class="btn btn-default btn-sm accordion-toggle" data-toggle="collapse" href="#collapse">
											<i class="fa fa-envelope margin-right-5"></i>
											<?=get_label('c_reply')?>
										</a>
									</p>
									<div class="collapse" id="collapse">
										<p class="margin-top-10"></p>
										<form class="simple_form message" id="frm-send_replay">
											<div class="form-group">
												<div class="control-group text required message_body">
													<div class="controls">
														<textarea class="text required form-control input-sm" autocomplete="off" rows="3" required="required" placeholder="<?=get_label('c_your_reply')?>"  id="message_body" data-rule-required="true" data-msg="Please fill reply" ></textarea>
													</div>
												</div>
											</div>
											<div class="text-left">
												<input type="hidden" id="notification_id" value="<?=$notification[0]['notification_id']?>">
												<input name="commit" value="<?=get_label('c_send_reply');?>" class="btn btn-sm" id="post_reply" type="button">
											</div>
										</form>
										<p></p>
									</div>
								<?php } ?>
							</div>
							<?php } ?>
						</div>
					</div>
				</div>
				<div class="clear"></div>
				<div id="load_reply">
					<?php
					$notification_id = $this->uri->segment('4');
					$total_message = 0;
					foreach ($notification as $key => $val) {
						//$delete_status = 'N';
						$new_message = 0;
						if($val['assigned_from']==$this->user_details->bg_user_id) $delete_status = $val['from_delete']; else $delete_status = $val['to_delete'];
						if($notification_id==1) {
							if($delete_status=='Y') {
								$new_message = 1;
							}
						}else {
							if($delete_status=='N') {
								$new_message = 1;
							}
						}

						if($new_message==1) { 
						?>
						<div class="timeline-entry margin-top-15">
							
							<div class="timeline-stat" >
								<?php
							if($notification[0]['message_type'] != 'N') { 

								if($val['message_type']=='N' || $val['msg_type']='R') {
									$notify_logo = skin_url('images/man.png');
									$user_id1 = $val['assigned_from'];

									
									if(!empty($allusers[$user_id1]['customer_photo']) && file_exists(FCPATH.'media/'.$this->lang->line('customer_image_folder_name')."/".$allusers[$user_id1]['customer_photo']))
									{
										$notify_logo = media_url().$this->lang->line('customer_image_folder_name')."/".$allusers[$user_id1]['customer_photo'];
									   
									}
									$username=($allusers[$user_id1]['customer_type']==1)?$allusers[$user_id1]['company_name']:$allusers[$user_id1]['customer_first_name'];
									$href=base_url().get_tag_username($user_id1);
								}
							}
							else
							{
								$username='';
								$notify_logo = skin_url('images/man.png');
								$href="javascript:;";
							}
								?>
								<small ><a href="<?php echo $href; ?>"><img class="circle-md" src="<?=$notify_logo?>" alt="Bloggotoweb"></a></small>
								<div class="message-heading">
									<a href="<?php echo $href; ?>"><h3 class="panel-title panel-title-small"><?php echo ($username)?$username:'Anonymous';?></h3></a>
									<span class="datetime" style="float: left;"><i class="fa fa-clock-o fa-fw margin-right-5"></i><?=date('d F Y',strtotime($val['created_on']));?></span>
								</div>
							</div>
							<div class="panel timeline-label">
								<div class="panel-body">
									<div class="row">
										<div class="table-responsive">
											<?=$val['message']?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php
						$total_message++;
						}
					}
					if($total_message==0) {
						redirect('conversations');
					}
					
					?>
				</div>
			</div>
		</div>
	</div>
</section>	
<script type="text/javascript" src="<?=skin_url('js/conversations.js?v='.rand())?>"></script>
<div class="clear"></div>
<script>
CKEDITOR.replace( 'message_body',{
	uiColor: '#DAF2FE',
	forcePasteAsPlainText:	true,
	toolbar :
	[
		['PasteFromWord','-', 'SpellChecker'],
		['SelectAll','RemoveFormat'],
		['Bold','Italic','Underline','-','Subscript','Superscript'],
		['NumberedList','BulletedList','-','Blockquote'],
		['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
		['Link','Unlink','Anchor'],
		['Image','Table','HorizontalRule','SpecialChar','PageBreak','Format','Font','FontSize','TextColor','BGColor']
	],
	filebrowserBrowseUrl: '<?php echo load_lib();?>ckeditor/ckfinder/ckfinder.html',
	filebrowserUploadUrl: '<?php echo load_lib();?>ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
	filebrowserWindowWidth: '1000',
	filebrowserWindowHeight: '700'

	
});
</script>