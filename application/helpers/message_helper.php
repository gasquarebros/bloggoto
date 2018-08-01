<?php
if (! function_exists ( 'current_users_details' )){
	function current_users_details()
	{
		$CI=& get_instance();
		$user = $CI->session->all_userdata();
		return $user;
	}
}

if (! function_exists ( 'loadallUser' )){
	function loadallUser()
	{
		$CI=& get_instance();
		$where=array('customer_status'=>'A');
		$user = $CI->Mydb->get_all_records('*','customers',$where,$limit='', $offset='', $order_by='', $like='', $groupby=array(), $join='' );
		
		//$user = $CI->session->all_userdata();
		return $user;
	}
}
if (! function_exists ( 'loadfollowers' )){
	function loadfollowers($where)
	{
		$CI=& get_instance();
		$join[0]['select'] = 'customers.*';
		$join[0]['table'] = 'customers';
		$join[0]['condition'] = "customers_followers.follow_user_id = customers.customer_id and customer_private != 1";
		$join[0]['type'] = 'INNER';
		$user = $CI->Mydb->get_all_records('customers_followers.*','customers_followers',$where,$limit='', $offset='', $order_by='', $like='', $groupby=array(), $join );
		
		//$user = $CI->session->all_userdata();
		return $user;
	}
}


//Not Open Notifications
if (! function_exists ( 'notification' )){
	function notification() {
		
		$notification = array();
		$CI=& get_instance();
		$employee_id = ($CI->session->userdata('bg_user_id'))?$CI->session->userdata('bg_user_id'):'';
		if($employee_id) {
			$where = "((nm.`assigned_from`='".$employee_id."' AND nm.`open_status`='N' AND nm.`from_delete`='N') OR (nm.`assigned_to`='".$employee_id."'  AND nm.`open_status`='N' AND nm.`to_delete`='N'))";

			$CI->db->select('n.notification_id, n.subject, nm.assigned_from, nm.created_on')->from('notification AS n')->join('notification_message AS nm', 'n.notification_id=message_id', 'INNER')->where('n.message_type', 'N')->where($where);
			$notification = $CI->db->order_by('nm.created_on DESC')->get()->result_array();
		}
		return $notification;		
	}
}

//Not Open Message
if (! function_exists ( 'message' )){
	function message() {
		$CI=& get_instance();
		$notification = array();
		$employee_id = ($CI->session->userdata('bg_user_id'))?$CI->session->userdata('bg_user_id'):'';
		if($employee_id) {
			$where = "((nm.`assigned_to`='".$employee_id."'  AND nm.`open_status`='N' AND nm.`to_delete`='N'))";

			$CI->db->select('n.notification_id, n.subject, nm.assigned_from, nm.created_on')->from('notification AS n')->join('notification_message AS nm', 'n.notification_id=message_id', 'INNER')->where('n.message_type', 'M')->where($where);
			$notification = $CI->db->order_by('nm.created_on DESC')->get()->result_array();
			//echo $CI->db->last_query();
			//exit;
		}
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
			'message_type'=>($notifyData['private'] == 1)?'N':$notifyData['message_type'],
			'subject'=>$notifyData['subject'],
			'message'=>$notifyData['message'],
			'private'=>$notifyData['private'],
			'created_on'=>$notifyData['created_on'],
			'ip_address'=>$notifyData['ip_address']
		);

		//$CI->db->insert('notification',$notifyData);
		$notification_id = $CI->Mydb->insert('notification',$notification_datas);

		$push_notify_array=array();
	 		$push_notify_array['notification_type']='message';
	 		$push_notify_array['notification_id']=$notification_id;
	 		$push_notify_array['created_by']=$notifyData['created_by'];
	 		$push_notify_array['assigned_to']=$notifyData['assigned_to'];
	 		$push_notify_array['message']=strip_tags($notifyData['message']);
	 		$push_notify_array['subject']=strip_tags($notifyData['subject']);
			post_push_notify($push_notify_array);

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

		$employee_id = ($CI->session->userdata('bg_user_id')?$CI->session->userdata('bg_user_id'):$employee_id);

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

		$push_notify_array=array();
	 		$push_notify_array['notification_type']='message_reply';
	 		$push_notify_array['notification_id']=$notifyData['notification_id'];
	 		$push_notify_array['created_by']=$assigned_from;
	 		$push_notify_array['assigned_to']=$assigned_to;
	 		$push_notify_array['message']=strip_tags($notifyData['reply']);
	 		$push_notify_array['subject']=strip_tags($notifyData['reply']);
			post_push_notify($push_notify_array);	

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

//New Notification
if (! function_exists ( 'post_notify' )){
	function post_notify($notify_array) {
		$notification_id = '';
		$CI=& get_instance();
		$notify_status=false;
			if($notify_array['notification_type'] == 'post')
			{
					$following_records = get_following_list();
					$follow_list = array();
					if(!empty($following_records))
					{
						foreach($following_records as $following) {
							$notify_array['assigned_to'] = $following['follow_customer_id'];
							$notification_id = $CI->Mydb->insert('post_notification',$notify_array);
							post_email_notify($notify_array);
							post_push_notify($notify_array);
						}
					}
				$notify_status=false;
			}
			else if($notify_array['notification_type'] == 'post_tag')
			{
				$notification_id = $CI->Mydb->insert('post_notification',$notify_array);
				$notify_status=true;
			}			
			else if($notify_array['notification_type'] == 'like')
			{
				$post_records = $CI->Mydb->get_record('post_created_by','pos_posts',array('post_id'=>$notify_array['notification_post_id'],'post_status'=>'A'));
				$notify_array['assigned_to'] = $post_records['post_created_by'];
				$notification_id = $CI->Mydb->insert('post_notification',$notify_array);
				$notify_status=true;				
			}
			else if($notify_array['notification_type'] == 'comment' || $notify_array['notification_type'] == 'reply' )
			{
				$post_record = $CI->Mydb->get_record('post_created_by','pos_posts',array('post_id'=>$notify_array['notification_post_id']));
				$notify_array['assigned_to'] = $post_record['post_created_by'];
				$notification_id = $CI->Mydb->insert('post_notification',$notify_array);
				$notify_status=true;				
			}
			else if($notify_array['notification_type'] == 'follow')
			{
				$notification_id = $CI->Mydb->insert('post_notification',$notify_array);
				$notify_status=true;				
			}
			if((!empty($notify_array)) && ($notify_status))
			{
				post_email_notify($notify_array);
				post_push_notify($notify_array);
			}
		return $notification_id;
	}
}
if (! function_exists ( 'post_email_notify' )){
	 function post_email_notify($notify_array=array())
	 {
		$CI=& get_instance();
	 	if(!empty($notify_array))
	 	{
	 		$notification_type=$notify_array['notification_type'];
	 		$notify_customer_id=$notify_array['assigned_to'];
	 		$notify_created_by=$notify_array['created_by'];
	 		$notify_message=$notify_array['message'];
	 		$email_sent_status=$post_link='';
	 		$email_temp_text='post';
			$site_url= $user_link= $post_link = base_url();
			$CI->load->library('myemail');
			if($notification_type  == 'follow')
			{			
		 		$email_temp_text='profile';
				$notify_created_info = $CI->Mydb->get_record ('customer_id,customer_first_name,customer_last_name,customer_username,customer_email,customer_status,customer_type','customers', array ('customer_id'=>$notify_created_by));	
				if(!empty($notify_created_info))
				{
					$user_link=base_url()."myprofile/".$notify_created_info['customer_username'];
				}
			}
			else
			{
		 		$email_temp_text='post';
		 		$notify_post_id=$notify_array['notification_post_id'];
				$post_details = $CI->Mydb->get_record ('post_id,post_slug','posts',array('post_id'=>$notify_post_id));
				if(!empty($post_details))
				{
					$post_link=base_url()."home/view/".$post_details['post_slug'];
				}
			}
			$check_details = $CI->Mydb->get_record ('customer_id,customer_first_name,customer_last_name,customer_username,customer_email,customer_status,customer_type','customers', array ('customer_id'=>$notify_customer_id));
			if ($check_details)
			{
				// $user_link=base_url()."myprofile/".$check_details['customer_username'];
				$notify_link=($notification_type != 'follow') ? $post_link : $user_link;				
				$check_arr = array('[NAME]','[POSTLINK]','[SITEURL]','[MESSAGE]','[TEMP_TEXT]');
				$replace_arr = array($check_details['customer_first_name']." ".$check_details['customer_last_name'],$notify_link,$site_url,$notify_message,$email_temp_text);
				$email_sent_status=$CI->myemail->send_admin_mail($check_details['customer_email'],get_label('customer_post_email_notify_template'),$check_arr,$replace_arr);
			}
	 	}
	 }
}
if (! function_exists ( 'post_push_notify' )){
	 function post_push_notify($notify_array=array())
	 {
		$site_url= $user_link= $post_link = base_url();
		$CI=& get_instance();
	 	if(!empty($notify_array))
	 	{
			$CI->load->library ('push');
	 		$notification_type=$notify_array['notification_type'];
	 		$notify_created_by=$notify_array['created_by'];
	 		$notify_customer_id=$notify_array['assigned_to'];
	 		$notify_message=$notify_array['message'];
	 		$notification_subject=$notify_array['subject'];
			$push_redirect_link = '';
			if($notification_type  == 'follow')
			{			
				$notify_created_info = $CI->Mydb->get_record ('customer_id,customer_first_name,customer_last_name,customer_username,customer_email,customer_status,customer_type','customers', array ('customer_id'=>$notify_created_by));	
				if(!empty($notify_created_info))
				{
					$push_redirect_link=base_url()."myprofile/".$notify_created_info['customer_username'];
				}
				$notification_title=$notification_subject;
			}	
			else if($notification_type  == 'message' || $notification_type  == 'message_reply')
			{	 		
		 		$notification_id=$notify_array['notification_id'];
				// $post_details = $CI->Mydb->get_record ('post_id,post_slug,post_title','posts',array('post_id'=>$notification_id));
				if($notification_id >0 )
				{
					$push_redirect_link=base_url()."conversations/view/".encode_value($notification_id);
				}
				$notification_title=$notification_subject;
			}			 		
			else
			{	 		
		 		$notify_post_id=$notify_array['notification_post_id'];
				$post_details = $CI->Mydb->get_record ('post_id,post_slug,post_title','posts',array('post_id'=>$notify_post_id));
				$post_image_details = $CI->Mydb->get_record ('post_media_type,post_media_post_id,post_media_filename','post_media',array('post_media_post_id'=>$notify_post_id));
				if(!empty($post_details))
				{
					$push_redirect_link=base_url()."home/view/".$post_details['post_slug'];
				}
				$notification_title=$post_details['post_title'];
			}
			$check_details = $CI->Mydb->get_record ('customer_id,customer_first_name,customer_last_name,customer_device_id,customer_device_type,customer_username,customer_email,customer_photo,customer_status,customer_type','customers', array ('customer_id'=>$notify_customer_id));
			$encode_data = json_encode($check_details);
			if (!empty($check_details))
			{
				$device_id = array($check_details ['customer_device_id']);
				$device_type = $check_details ['customer_device_type'];
				$imagePath = media_url()."customers/default.png";
				if($check_details['customer_photo'])
				{
					$imagePath=media_url()."customers/".$check_details['customer_photo'];
				}				
				if((!empty($post_image_details)) && ($post_image_details['post_media_filename']))
				{
					$imagePath=media_url()."posts/images/".$post_image_details['post_media_filename'];
				}
				// $user_link=base_url()."myprofile/".$check_details['customer_username'];
				// $notify_link=($notification_type != 'follow') ? $post_link : $user_link;				
				// $notify_link=$push_redirect_link;
				$notify_link=($push_redirect_link != '') ? $push_redirect_link : base_url();
				$notification_title=($notification_title != '') ? $notification_title : $notification_subject;				
			  	$data = array("message"=>$notify_message,"notification_title"=>$notification_title,'notification_image'=>$imagePath,'notification_link'=>$notify_link);
/*			  	echo "<pre>";
			  	print_r($check_details);
			  	print_r($data);
			  	echo "</pre>";*/
			   if(!empty($device_id))
				{					
	 				$countPush=1;
					/****** for android user ******/
				   if($device_type == 'android')
				   {
						$status = $CI->push->sendMessage ($device_id, $data);
				   }			
				   /********for ios user*****/
				   if($device_type == 'ios')
				   {
						$status = $CI->push->push_message_ios ( $device_id, $data,$countPush );
						$countPush++;
				   }
				}				
			}
	 	}
	 }
}