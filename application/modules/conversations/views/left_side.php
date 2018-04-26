<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

$open_count = count(notification())+count(message());
?>
<div class="inbx_left performance_height">
	<h3><?=get_label('c_performance_messenger')?></h3>
	<a class="btn btn-block btn-success" href="<?=base_url('conversations/new_message')?>">
		<?=get_label('c_compose_message')?>
	</a>
	<hr>
	<div class="list-group bg-trans bord-no">
	<a class="list-group-item <?php if(empty($_GET['filter']) && empty($notification['trash_status'])) { echo 'active';} else {
		if(!empty($notification) && !empty($notification['trash_status']) && $notification['trash_status']=='N' && !empty($notification['message_type']) && $notification['message_type']=='N') { echo 'active'; } 
		} ?>" href="<?=base_url('conversations')?>">
			<span class="badge badge-success pull-right"><?=$open_count?></span>
			<i class="fa fa-inbox fa-fw"></i>
			<?=get_label('c_inbox')?>
		</a>
		<a class="list-group-item <?php if(!empty($_GET['filter']) && $_GET['filter']=='sentbox') { echo 'active';} else {  if(!empty($notification) && !empty($notification['message_type']) && $notification['message_type']=='M') { echo 'active'; }   } ?>" href="<?=base_url('conversations?filter=sentbox')?>">
			<i class="fa fa-send fa-fw"></i>
			<?=get_label('c_sent_mail')?>
		</a>
		<a class="list-group-item <?php if(!empty($_GET['filter']) && $_GET['filter']=='trash') { echo 'active';} else { if(!empty($notification)  && !empty($notification['trash_status']) && $notification['trash_status']=='Y') { echo 'active'; } } ?>" href="<?=base_url('conversations?filter=trash')?>">
			<i class="fa fa-trash fa-fw"></i>
			<?=get_label('c_trash')?>
		</a>
	</div>
</div>