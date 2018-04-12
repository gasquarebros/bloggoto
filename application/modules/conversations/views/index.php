<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
$filter = '';
if(!empty($_GET['filter']) && $_GET['filter']=='trash') {
	$filter = 1;
}
?>
<section>
	<div class="container">
		<div class="page_content">
			<div class="col-md-3">
				<?php $this->load->view('left_side'); ?>
			</div>
			<div class="col-md-9">
				<div id="page-title">
					<h1 class="page-header text-overflow">
					<?php
					if(!empty($_GET['filter'])) {
						if($_GET['filter']=='sentbox') echo get_label('c_sent_mail');
						if($_GET['filter']=='trash') echo get_label('c_trash');
					}
				else {
					echo get_label('c_inbox');
				}
					?>
					</h1>
				</div>
				<div class="inbx_right performance_height">
					<div id="page-content">
						<div class="panel panel-default panel-left">
							<div class="panel-body" id="demo-email-list">
								<ul class="mail-list" id="inbox">
									<?php
									if(!empty($notification)) { 
										foreach ($notification as $nkey => $nval) {

											if(!empty($_GET['filter']) && $_GET['filter']=='sentbox') {
												$from_tow = 1;
											}
											else {
												$from_tow = $nval['from_tow'];
											}
											$trashs = '';
											if(!empty($_GET['filter']) && $_GET['filter']=='trash') {
												$trashs = '/1';
											}
											if($from_tow>0) {
											$user_id = $nval['assigned_to'];
											?>
											<li class="mailboxer_conversation" <?php if($nval['open_status']>0){ ?> style="font-weight: bold !important;"<?php } ?>>
												<div class="mail-control"></div>
												<div class="mail-from">
													<?php if($allusers[$user_id]['customer_type'] == 1) { ?>
														<a href="<?=base_url('conversations/view/'.encode_value($nval['notification_id']).$trashs)?>"><?=($nval['message_type']=='N')?'Bloggoto':$allusers[$user_id]['company_name']?></a>
													<?php } else { ?>
														<a href="<?=base_url('conversations/view/'.encode_value($nval['notification_id']).$trashs)?>"><?=($nval['message_type']=='N')?'Bloggoto':$allusers[$user_id]['customer_first_name']?></a>
													<?php } ?>
												</div>
												<div class="mail-time">
													<span><?=date('d F Y',strtotime($nval['created_on']))?></span>
													<?php
													if($filter==1) {
														?>
														<span><a class="trash" data-method="post" href="javascript:"  data-confirm="<?=get_label('trash_conf')?>" data-ids="<?=$nval['notification_id']?>" data-types="3"><span class="margin-left-10 small" ><?=get_label('c_restore_message')?></span></a></span>
														<?php
													}
													else {
														?>
														<span><a class="trash" data-method="post" href="javascript:"  data-confirm="<?=get_label('trash_conf')?>" data-ids="<?=$nval['notification_id']?>" data-types="2"><span class="margin-left-10 small" ><?=get_label('c_send_to_trash')?></span></a></span>
														<?php
													}
													?>
												</div>
												<div class="mail-subject">
													<a href="<?=base_url('conversations/view/'.encode_value($nval['notification_id']).$trashs)?>"><?=$nval['subject']?></a>
												</div>
											</li>
											<?php
										}
										}
									}
									?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>	
<script type="text/javascript" src="<?=skin_url('js/conversations.js?v'.rand())?>"></script>
<div class="clear"></div>