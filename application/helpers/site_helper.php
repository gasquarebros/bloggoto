<?php 
/**************************
 Project Name	: BlogGotoWeb
Created on		: 27 Nov, 2017
Last Modified 	: 27 Nov, 2017
Description		:  this file contains common setting for Frontend panel..
***************************/

/* get frontend session  label */
if (! function_exists ( 'get_user_id' )) {
	function get_user_id() {
		$CI = & get_instance ();
		return  $CI->session->userdata('bg_user_id');
	}
}

/* get current user type */
if (! function_exists ( 'get_user_type' )) {
	function get_user_type() {
		$CI = & get_instance ();
		return  $CI->session->userdata('bg_user_type');
	}
}

/* get current user type */
if (! function_exists ( 'get_user_name' )) {
	function get_user_name() {
		$CI = & get_instance ();
		if($CI->session->userdata('bg_user_type') == 1) {
			return  ucwords($CI->session->userdata('company_name'));
		}else {
			return  ucwords($CI->session->userdata('bg_first_name')." ".$CI->session->userdata('bg_last_name'));
		}
	}
}

/* get current user type */
if (! function_exists ( 'get_user_username' )) {
	function get_user_username() {
		$CI = & get_instance ();
		return  $CI->session->userdata('customer_username');
	}
}


/* Check  GUID exists  */
if(!function_exists('get_guid'))
{
	function get_guid( $table=null, $field_name=null,$where = array() )
	{
		$CI =& get_instance();
		$guid = GUID ();
		$where_arary = array_merge(array($field_name =>trim($guid)),$where);
		$result  = $CI->Mydb->get_record(array($field_name),$table,$where_arary);

		if (!empty($result)) {
			return get_guid(  $table, $field_name );
		} else {
			return $guid;
		}

	}
}

/* Create order local number */
if(!function_exists('get_local_ordeno'))
{
	function get_local_ordeno()
	{
		$CI = &get_instance();
		$loc_parent = date("ymd");
		$loc_query = "SELECT order_local_no FROM avvanz_orders WHERE order_local_no like '%$loc_parent%'  ORDER BY order_primary_id DESC LIMIT 1";
 
		$loc_result = $CI->Mydb->custom_query_single($loc_query);
		if(!empty($loc_result)){
			$old_lno= substr($loc_result['order_local_no'],-4) + 1;
		}
		else {
			$old_lno= 1001;
		}
	
		$loc_order_no = $loc_parent.".".$old_lno;
		return $loc_order_no;
	}
}
/* Create order local number */
if(!function_exists('generateStrongPassword')) {
	function generateStrongPassword($length = 9, $add_dashes = false, $available_sets = 'luds')
	{
		$sets = array();
		if(strpos($available_sets, 'l') !== false)
			$sets[] = 'abcdefghjkmnpqrstuvwxyz';
		if(strpos($available_sets, 'u') !== false)
			$sets[] = 'ABCDEFGHJKMNPQRSTUVWXYZ';
		if(strpos($available_sets, 'd') !== false)
			$sets[] = '23456789';
		if(strpos($available_sets, 's') !== false)
			$sets[] = '!@#$%&*?';
		$all = '';
		$password = '';
		foreach($sets as $set)
		{
			$password .= $set[array_rand(str_split($set))];
			$all .= $set;
		}
		$all = str_split($all);
		for($i = 0; $i < $length - count($sets); $i++)
			$password .= $all[array_rand($all)];
		$password = str_shuffle($password);
		if(!$add_dashes)
			return $password;
		$dash_len = floor(sqrt($length));
		$dash_str = '';
		while(strlen($password) > $dash_len)
		{
			$dash_str .= substr($password, 0, $dash_len) . '-';
			$password = substr($password, $dash_len);
		}
		$dash_str .= $password;
		return $dash_str;
	}
}


/* get site title */
if (! function_exists ( 'get_site_title' )) {
	function get_site_title($title = null) {
		if ($title != "") {
			return $title;
		} else {
			return get_label ( 'site_title' );
		}
	}
}

/* get get_followers_list */
if (! function_exists ( 'get_followers_list' )) {
	function get_followers_list($userid='') {
		$CI = &get_instance();
		$follow_records = array();
		$userid = ($userid)?$userid:get_user_id();
		if($userid !='')
		{
			$join = '';
			$order_by = array('customer_first_name'=>'ASC');
			$join [0] ['select'] = "customer_id,customer_first_name,customer_last_name,customer_email,customer_photo,customer_type,company_name,customer_celebrity_badge";
			$join [0] ['table'] = 'customers';
			$join [0] ['condition'] = "follow_user_id = customer_id";
			$join [0] ['type'] = "INNER";
			$follow_records = $CI->Mydb->get_all_records('customers_followers.*','customers_followers',array('follow_customer_id'=>$userid,'customer_status'=>'A'),$limit='', $offset='', $order_by, $like='', $groupby=array(), $join );
		}

		return $follow_records;
	}
}
/* get get_followers_list */
if (! function_exists ( 'get_following_list' )) {
	function get_following_list($userid='') {
		$CI = &get_instance();
		$following_records = array();
		$userid = ($userid)?$userid:get_user_id();
		if($userid !='')
		{
			$join = '';
			$order_by = array('customer_first_name'=>'ASC');
			$join [0] ['select'] = "customer_id,customer_first_name,customer_last_name,customer_email,customer_photo,customer_type,company_name,customer_celebrity_badge";
			$join [0] ['table'] = 'customers';
			$join [0] ['condition'] = "follow_customer_id = customer_id";
			$join [0] ['type'] = "INNER";
			$following_records = $CI->Mydb->get_all_records('customers_followers.*','customers_followers',array('follow_user_id'=>$userid,'customer_status'=>'A'),$limit='', $offset='', $order_by, $like='', $groupby=array(), $join );

		}

		return $following_records;
	}
}

if(!function_exists('substr_close_tags'))
{
	function substr_close_tags($code, $limit = 300)
	{
		if ( strlen($code) <= $limit )
		{
			return $code;
		}

		$html = substr($code, 0, $limit);
		preg_match_all ( "#<([a-zA-Z]+)#", $html, $result );

		foreach($result[1] AS $key => $value)
		{
			if ( strtolower($value) == 'br' )
			{
				unset($result[1][$key]);
			}
		}
		$openedtags = $result[1];

		preg_match_all ( "#</([a-zA-Z]+)>#iU", $html, $result );
		$closedtags = $result[1];

		foreach($closedtags AS $key => $value)
		{
			if ( ($k = array_search($value, $openedtags)) === FALSE )
			{
				continue;
			}
			else
			{
			unset($openedtags[$k]);
			}
		}

		if ( empty($openedtags) )
		{
			if ( strpos($code, ' ', $limit) == $limit )
			{
				return $html."...";
			}
			else
			{
				return substr($code, 0, strpos($code, ' ', $limit))."...";
			}
		}

		$position = 0;
		$close_tag = '';
		foreach($openedtags AS $key => $value)
		{	
			$p = strpos($code, ('</'.$value.'>'), $limit);

			if ( $p === FALSE )
			{
				$code .= ('</'.$value.'>');
			}
			else if ( $p > $position )
			{
				$close_tag = '</'.$value.'>';
				$position = $p;
			}
		}

		if ( $position == 0 )
		{
			return $code;
		}

		return substr($code, 0, $position).$close_tag;
	}
}
//Not Open Message
if (! function_exists ( 'post_notify_count' )){
	function post_notify_count() {
		$CI=& get_instance();
		$customer_id = ($CI->session->userdata('bg_user_id'))?$CI->session->userdata('bg_user_id'):'';

			$notification = $CI->Mydb->get_num_rows('post_notification_id','post_notification',array('assigned_to'=>$customer_id,'message_type'=>'N','open_status'=>'N','assigned_to !='=>''));	

			if($notification>0)
			{
				$notification_counting=$notification;
			}
			else
			{
				$notification_counting=0;
			}

		return $notification_counting;		
	}
}
//Not Open Message
if (! function_exists ( 'message_notify_count' )){
	function message_notify_count() {
		$CI=& get_instance();
		$customer_id = ($CI->session->userdata('bg_user_id'))?$CI->session->userdata('bg_user_id'):'';
		$where=array();

			$where =array("( (`assigned_to`='".$customer_id."'  AND `open_status`='N' AND `to_delete`='N'))"=>NULL);
			$msg_notification = $CI->Mydb->get_num_rows('notification_id','notification_message',$where);	

			if($msg_notification>0)
			{
				$msg_notification_counting=$msg_notification;
			}
			else
			{
				$msg_notification_counting=0;
			}

		return $msg_notification_counting;		
	}
}

if (! function_exists ( 'delete_post' )){
	function delete_post($postid) {
		$CI=& get_instance();
				$post_info = $CI->Mydb->get_record('post_photo,post_video','posts',array('post_id'=>$postid,'post_created_by'=>get_user_id()));
				$post_image_path = FCPATH . 'media/' .  $CI->lang->line('post_photo_folder_name'). $post_info['post_photo'];
				$post_video_path = FCPATH . 'media/' .  $CI->lang->line('post_video_folder_name') . $post_info['post_video'];
				
				if (file_exists ( $post_image_path )) {
					@unlink ( $post_image_path );
				}
				if (file_exists ( $post_video_path )) {
					@unlink ( $post_video_path );
				}								
				$CI->Mydb->delete_where_in('posts','post_id',$postid,array('post_created_by'=>get_user_id()));
				$CI->Mydb->delete_where_in('post_comments','post_comment_post_id',$postid,array());
				$CI->Mydb->delete_where_in('post_likes','post_like_post_id',$postid,array());
				$CI->Mydb->delete_where_in('post_notification','notification_post_id',$postid,array());
				$CI->Mydb->delete_where_in('post_tags','post_tag_post_id',$postid,array());
			return $CI->db->affected_rows();
	}
}

if (! function_exists ( 'addhttp' )){
	function addhttp($url) {
		if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
			$url = "http://" . $url;
		}
		return $url;
	}
}


if (! function_exists ( 'get_tag_username' )){
	function get_tag_username($userid) {
		$username= '';
		$CI=& get_instance();
		$user_info = $CI->Mydb->get_record('customer_username','customers',array('customer_id'=>$userid,'customer_username !='=>'','customer_status'=>'A'));
		if(!empty($user_info))
		{
			$username = $user_info['customer_username'];
		}
		
		return $username;
	}
}
if (! function_exists ( 'get_censored_string' )){
	function get_censored_string($string) 
	{
		$CI=& get_instance();
		$CI->load->helper ( 'text' );

		#List of bad words to censor
		$disallowed = array('darn', 
							'shucks', 
							'golly',
							'phooey');

		$post_description='';
		if($string !=  '')
		{
			$description = word_censor($string, $disallowed, '***');//each word with space replace
			$description = str_ireplace($disallowed, "***", $string);//find the all occur word replace
		}
		return ($description != '') ? $description: '';
	}
}