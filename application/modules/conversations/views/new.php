<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
$notify_logo = skin_url('images/db-logo2.png');
$send_email = '';
if(!empty($_GET['email'])) {
	$send_email = $_GET['email'];
}
?>
<section>
	<div class="container">
		<div class="page_content">
			<div class="col-md-3">
				<?php $this->load->view('left_side'); ?>
			</div>
			<div class="col-md-9">
				<div class="inbx_right performance_height">
					<div id="page-content">
						<div class="panel">
							<div class="panel-heading">
								<h3 class="panel-title panel-title-small">
									<?=get_label('c_new_conversation')?>
								</h3>
							</div>
							<form class="simple_form conversation" id="frm-conversations" action="<?=base_url('conversations/create_message')?>" accept-charset="UTF-8" method="post">
								<div class="panel-body">
								
									<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash();?>" />			
									<div class="form-horizontal form-border">
										<div class="clearfix">
											<div class="col-md-2">
												<div class="light-weight"><?=get_label('c_select_recipients')?></div>
											</div>
											<div class="col-md-10">
											<?php
											$userslist = array();
											if(!empty($allusers)) {
												foreach ($allusers as $ukey => $uval) {
													$userslist[] = $uval['customer_id'];
												}
											}
											if(!empty($send_email)) {
												 if(!empty($allusers)) {
														foreach ($allusers as $ukey => $uval) {
															if($send_email==$uval['customer_email']) {
															?>
																You are starting a new conversation with <?=$uval['customer_first_name']?>
																<input type="hidden" name="user_id[]" value="<?=$uval['customer_id']?>">
												<?php
															}
														}
												}
											}
											else if($customer_id !='' &&!in_array($customer_id,$userslist))
											{
												echo '<label>'.$user_data[0]['customer_first_name'].' '.$user_data[0]['customer_first_name'].'</label>';
											}
											else {
											?>

												<select class="selectpicker" name="user_id[]" id="user_id" data-live-search="true" multiple="">
												 <option value="">None</option>
													<?php
													if(!empty($allusers)) {
														foreach ($allusers as $ukey => $uval) { 
															if($uval['customer_id'] !=$this->user_details->bg_user_id) {
																?>
																<option value="<?=$uval['customer_id']; ?>" <?php if($customer_id==$uval['customer_id']) echo 'selected'; ?>>
																<?php echo ($uval['customer_type']==0)?$uval['customer_first_name']." ".$uval['customer_last_name']:$uval['company_name'];?>
																</option>
																<?php
															}
														}
													}
													?>
												</select>

												<label id="subject_error" style="color:red;" ></label>
												<?php } ?>
											</div>
										</div>
										<div class="col-md-2 margin-top-20">
											<div class="light-weight"><?=get_label('c_subject')?></div>
										</div>
										<div class="col-md-10 margin-top-20">
											<div class="control-group string required conversation_subject">
												<div class="controls">
													<input class="string required form-control input-sm blacktip" type="text" name="subject" data-rule-required="true" data-msg="Please fill <?=get_label('c_subject')?>" placeholder="<?=get_label('c_subject')?>">
												</div>
											</div>
										</div>
										<div class="col-md-2 margin-top-20">
											<div class="light-weight"><?=get_label('c_message')?></div>
										</div>
										<div class="col-md-10 margin-top-20">
											<div class="control-group text required conversation_body">
												<div class="controls">
													<textarea class="text required form-control input-sm" autocomplete="off" rows="8" required="required" aria-required="true" placeholder="<?=get_label('c_message')?>" name="message" id="message" data-rule-required="true" data-msg="Please fill <?=get_label('c_message')?>"></textarea>
												</div>
											</div>
										</div>
										<div class="col-md-2">
										</div>
										<div class="col-md-10 margin-top-20">
											<div class="control-group string conversation_subject">
												<div class="controls">
													<input class="string form-control input-sm blacktip" type="checkbox" value="1" name="private" id="private"  data-msg="Check this to send as private message" ><label for="private" >Send as Private</label>
												</div>
											</div>
										</div>
									</div>
							
							
								</div>
								<div class="panel-footer panel-footer-gray">
									<div class="text-left">
										<input name="commit" id="create_message" value="<?=get_label('c_start_conversation')?>" class="btn btn btn-md btn-default" type="button">
									</div>
								</div>
						
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>	
<script type="text/javascript" src="<?=skin_url('js/conversations.js?v='.rand())?>"></script>
<div class="clear"></div>
<script>
	var positiontop = $('#frm-conversations').offset().top;
	$('body,html').animate({scrollTop:positiontop}, 800);
</script>