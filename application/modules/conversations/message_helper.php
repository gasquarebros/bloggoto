<?php
//Not Open Notifications
if (! function_exists ( 'notification' )){
	function notification() {
		$CI=& get_instance();
		$employee_id = ($CI->session->userdata('pos_employee_id')?$CI->session->userdata('pos_employee_id'):$employee_id);

		$where = "((nm.`assigned_from`='".$employee_id."' AND nm.`open_status`='N' AND nm.`from_delete`='N') OR (nm.`assigned_to`='".$employee_id."'  AND nm.`open_status`='N' AND nm.`to_delete`='N'))";

		$CI->db->select('n.notification_id, n.subject, nm.assigned_from, nm.created_on')->from('notification AS n')->join('notification_message AS nm', 'n.notification_id=message_id', 'INNER')->where('n.message_type', 'N')->where($where);
		$notification = $CI->db->order_by('nm.created_on DESC')->get()->result_array();

		return $notification;		
	}
}

//Not Open Message
if (! function_exists ( 'message' )){
	function message() {
		$CI=& get_instance();
		$employee_id = ($CI->session->userdata('pos_employee_id')?$CI->session->userdata('pos_employee_id'):$employee_id);
		$where = "((nm.`assigned_from`='".$employee_id."' AND nm.`open_status`='N' AND nm.`from_delete`='N') OR (nm.`assigned_to`='".$employee_id."'  AND nm.`open_status`='N' AND nm.`to_delete`='N'))";

		$CI->db->select('n.notification_id, n.subject, nm.assigned_from, nm.created_on')->from('notification AS n')->join('notification_message AS nm', 'n.notification_id=message_id', 'INNER')->where('n.message_type', 'M')->where($where);;
		$notification = $CI->db->order_by('nm.created_on DESC')->get()->result_array();
		return $notification;		
	}
}

//New Notification
if (! function_exists ( 'new_notify' )){
	function new_notify($notifyData) {
		$CI=& get_instance();
		if(empty($notifyData['message_type'])) $notifyData['message_type'] = 'N';		
		$notification_datas = array(
			'created_type'=>$notifyData['created_type'],
			'message_type'=>$notifyData['message_type'],
			'subject'=>$notifyData['subject'],
			'message'=>$notifyData['message'],
			'created_on'=>$notifyData['created_on'],
			'ip_address'=>$notifyData['ip_address']
		);

		//$CI->db->insert('notification',$notifyData);
		$notification_id = $CI->Mydb->insert('notification',$notification_datas);

		$notify_message = array(
			'message_type'=>'M',
			'message_id'=>$notification_id,
			'message'=>$notifyData['message'],
			'assigned_from'=>$notifyData['created_by'],
			'assigned_to'=>$notifyData['assigned_to'],
			'created_on'=>$notifyData['created_on'],
			'ip_address'=>$notifyData['ip_address']
			);
		$CI->Mydb->insert('notification_message',$notify_message);

		return $notification_id;
	}
}


//New Reply
if (! function_exists ( 'new_reply' )){
	function new_reply($notifyData) {
		$CI=& get_instance();

		$employee_id = ($CI->session->userdata('pos_employee_id')?$CI->session->userdata('pos_employee_id'):$employee_id);

		$notify_message = $CI->Mydb->get_record('notification_id, assigned_from, assigned_to', 'notification_message', array('message_id'=>$notifyData['notification_id'], 'message_type'=>'M'));
		if($notify_message['assigned_from']==$employee_id) {
			$assigned_from = $notify_message['assigned_from'];
			$assigned_to =  $notify_message['assigned_to'];  
		} else {
			$assigned_from = $notify_message['assigned_to'];
			$assigned_to =  $notify_message['assigned_from']; 
		}
		$notify_message = array(
			'message_type'=>'R',
			'reply_parent_id'=>$notify_message['notification_id'],
			'message_id'=>$notifyData['notification_id'],
			'message'=>$notifyData['reply'],
			'assigned_from'=>$assigned_from,
			'assigned_to'=>$assigned_to,
			'created_on'=>$notifyData['created_on'],
			'ip_address'=>$notifyData['ip_address']
			);
		$notification_id = $CI->Mydb->insert('notification_message',$notify_message);

		return $notification_id;
	}
}

//New Notification
if (! function_exists ( 'message_change' )){
	function message_change($message) {
		$CI=& get_instance();

		$result =   $CI->db->select('settings_site_title, settings_email_footer, settings_email_logo')->from('site_settings')->get()->result_array()[0];

		$site_title = ucfirst($result['settings_site_title']);
		$Sitelogo = ucfirst($result['settings_email_logo']);

		$chk_arr1 = array('[LOGOURL]','[BASEURL]','[COPY-CONTENT]','[SITE-TITLE]');
 		$rep_array2 = array(base_url('media/admin/'.$Sitelogo),base_url(),$result['settings_email_footer'], $site_title);
 		return $message1 = str_replace($chk_arr1, $rep_array2, $message);

		///message_change
	}
}