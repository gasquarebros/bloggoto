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
			<div class="col-md-1">
			</div>
			<div class="col-md-10">
				<div id="page-title">
					<h1 class="page-header text-overflow">Notifications
					</h1>
				</div>
				<div class="inbx_rights performance_height">
					<div id="page-content">
						<div class="panel panel-default panel-left">
							<div class="panel-body" id="demo-email-list">
								<ul class="mail-list" id="inbox">
									<?php
									if(!empty($notification)) { 
										foreach ($notification as $key => $notify) {

											?>
											<li class="mailboxer_conversation" <?php if($notify['open_status']=='N'){ ?> style="font-weight: bold !important;"<?php } ?>>
												<div class="mail-control"></div>
												<div class="mail-from">
													<?php 
													if($notify['notification_type'] == 'follow')
													{
														if($notify['customer_username'] != '')
														{
															$href_url=base_url('myprofile/'.$notify['customer_username']."/".encode_value($notify['post_notification_id'])."/".encode_value($notify['open_status']));
														}
														else
														{
															$href_url='#';
														}
													}
													else
													{
															$href_url=base_url('home/view/'.$notify['post_slug']."/".encode_value($notify['post_notification_id'])."/".encode_value($notify['open_status']));
													}
													?>
													<a class="notify_class" href="<?=$href_url?>" data-id="<?=encode_value($notify['post_notification_id'])?>" ><?=$notify['post_title']; ?></a>

												</div>
												<div class="mail-time">
													<span><?=date('d F Y',strtotime($notify['created_on']))?></span>
												</div>
												<div class="mail-subject">
													<a  class="notify_class" href="<?=$href_url?>" data-id="<?=encode_value($notify['post_notification_id'])?>" ><?=$notify['message']?></a>
												</div>
											</li>
											<?php
										}
									}
									else
									{
								?>										
											<li class="mailboxer_conversation" >
													<span>No notification found</span>
											</li>										
								<?php	}
									?>
									
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-1">
			</div>
		</div>
	</div>
</section>	
<script type="text/javascript" src="<?=skin_url('js/conversations.js?v'.rand())?>"></script>
<div class="clear"></div>