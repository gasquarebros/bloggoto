<?php

defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class Cron extends CI_Controller {
	public function __construct() 
	{		
		parent::__construct ();
		$this->load->library ('push');
		//$this->load->library ('gcm');
		$this->service_categorytable = "service_categories";
		$this->customers = "customers";
		$this->service_subcategorytable = "service_subcategories";
		$this->city_table = "cities";
		$this->table = "order_service";
		$this->primary_key = 'order_service_id';
	}
	public function index()
	{
		$this->pushnotification();	 
	}
	public function service_validate() {
		$current_time = strtotime(date('Y-m-d H:i:s'));
		$before_two_hours = strtotime('-2 hour', $current_time);
		$before_date = date('Y-m-d H:i:s',$before_two_hours);


		$where = array (
			"order_service_created_on <=" => $before_date,
			'order_service_status'	=> 'processing'
		);
		$join = "";	
		$join [0] ['select'] = "customers.customer_id,customers.customer_first_name,customers.customer_last_name,customers.customer_username,customers.customer_email";
		$join [0] ['table'] = $this->customers;
		$join [0] ['condition'] = "order_service_customer_id = ".$this->customers.".customer_id";
		$join [0] ['type'] = "LEFT";
		$select_array = array (
			$this->table.'.*'
		);
		$groupby = 'order_service_id';
		$record = $this->Mydb->get_all_records ( $select_array, $this->table, $where, '', '', '', '',$groupby, $join );

		if(!empty($record)){
			$value="rejected";
			$email_template_id = '10';
			foreach($record as $rec) {
				
				$where = array (
					"order_service_id" => $rec['order_service_id']
				);
				$this->Mydb->update($this->table,$where,array('order_service_status'=>$value));

				$st_date = $rec['order_service_start_date'];
				$ed_date = $rec['order_service_end_date'];
				if($rec['ser_pricet_type'] == 'hour') {
					$st_time = ($rec['order_service_start_time'] !=''  && $rec['order_service_start_time'] != '00:00') ?  date( 'h.i A', $rec['order_service_start_time']):'';
					$ed_time = ($rec['order_service_end_time'] !=''  && $rec['order_service_end_time'] != '00:00') ?  date( 'h.i A', $rec['order_service_end_time']):'';
				} else {
					$st_time = $ed_time = '';
				}
				//send mail and notification with success message
				$date =  $st_date." - ".$ed_date. "<br>".$st_time." - ".$ed_time;

				$this->load->library('myemail');
				$check_arr = array('[NAME]','[LOCAL_ORDER_NO]','[Title]','[DATE]');
				$replace_arr = array( ucfirst(stripslashes($rec['customer_first_name'].' '.$rec['customer_last_name'])),$rec['order_service_local_no'],stripslashes($rec['order_service_title']),$date);
				if($email_template_id != '') {
					$mail_res = $this->myemail->send_admin_mail($rec['customer_email'],$email_template_id,$check_arr,$replace_arr);
				}
			}
		}

	}
	public function testpush()
	{
						 $device_id = array($use ['user_android_id']);
						 // $device_token = $use ['user_ios_id'];
						 $imagePath = media_url()."customers/default.png";
						 $data = array("message"=>'test push message',"notification_title"=>'test push','notification_image'=>$imagePath);
						 						 
						   /********for ios user*****/
/*						   if(!empty($device_token))
							{	
								$status = $this->push->push_message_ios ( $device_token, $data,$countPush );
								$countPush++;
							}*/
							/****** for android user ******/
						   if(!empty($device_id))
							{								
								$status = $this->push->sendMessage ($device_id, $data);
								
							}
	}
	
	/* this method used to manual notification */
	function pushnotification() {
		$records = $this->get_notification_list();
		if (! empty ( $records )) {
			foreach ( $records as $rec ) {								
				$users = $this->get_all_users ($rec['customer_id'],$rec['notification_app_id']);
				$countPush=1;
				if (! empty ( $users )) {
					foreach ( $users as $use ) {						
						 $device_id = array($use ['user_android_id']);
						 $device_token = $use ['user_ios_id'];
						 $imagePath = media_url().get_company_folder()."/". $this->lang->line('notification_image_folder_name').$rec['notification_picture'];
						 
						 $data = array("message"=>$rec['notification_message'],"notification_title"=>$rec['notification_title'],'notification_image'=>$imagePath);
						 						 
						   /********for ios user*****/
						   if(!empty($device_token))
							{	
								$status = $this->push->push_message_ios ( $device_token, $data,$countPush );
								$countPush++;
							}
							/****** for android user ******/
						   if(!empty($device_id))
							{								
								$status = $this->push->sendMessage ($device_id, $data);
								
							}
					}
				}
				$date = date("Y-m-d H:i:s");
				$this->Mydb->update ( 'pos_notifications', array (
						'notification_id' => $rec ['notification_id'] 
				), array (
						'sending_status' => 'Yes',
						'send_datetime'  => $date
				) );
				/*mamual notification  end*/
			}
		}
		
		/*schduled notification  start*/
				
				$scheduledNotifi = $this->check_scheduled_notification ();
				
				if (! empty ( $scheduledNotifi )) {
					foreach ( $scheduledNotifi as $notify ) {						
						$users = $this->get_all_users ($notify['customer_id']);
						$countPush=1;						
						if (! empty ( $users )) {
							foreach ( $users as $use ) {						
								 $device_id = array($use ['user_android_id']);
								 $device_token = $use ['user_ios_id'];
								 $imagePath = media_url().get_company_folder()."/". $this->lang->line('notification_image_folder_name').$rec['notification_picture'];								 
								 $data = array("message"=>$rec['notification_message'],"notification_title"=>$rec['notification_title'],'notification_image'=>$imagePath);
														 
								   /********for ios user*****/
								   if(!empty($device_token))
									{	
										$status = $this->push->push_message_ios ( $device_token, $data,$countPush );
										$countPush++;
									}
									/****** for android user ******/
								   if(!empty($device_id))
									{								
										$status = $this->push->sendMessage ($device_id, $data);
									}
							}
						}
						$date = date("Y-m-d H:i:s");
						$this->Mydb->update ( 'pos_notifications', array (
								'notification_id' => $rec ['notification_id'] 
						), array (
								'sending_status' => 'Yes',
								'send_datetime'  => $date
						) );
					}
				}
				/*schduled notification  end*/
	}
	
	public function testios()
	{
		$device_token='d69b48fec19957c875fd62e87b461d1ea93471bbcd3cbbacb041fcf890ac526d';
		$message= array('message'=>'text');
		$countPush=1;
		$status = $this->push->push_message_ios( $device_token, $message,$countPush );
	}
	public function testandroid()
	{
		$device_id="fLuyUPAUDOA:APA91bEZzANjxOXFSCR3XOf2YWEJTwzRsVh9B3r7w5dXOaxyZ0a9tD4BRyVe9REQFp7fu6gnM5-hGa0NKe5LZQqwi3fZ5cb2UbaTYFJedQgigNHxshZwg0Xt5QvYJ1vuorM7uQIfKEx6";
		$message = 'test';
		$status = $this->push->sendMessage ( $message,$device_id);
	}
	
	
	function check_scheduled_notification() {
		  $query = "SELECT * FROM `pos_notifications` as n
					left join pos_notification_users as  nuser on nuser.notification_id = n.notification_id
				WHERE n.`schedule_date`<=now() and n.`notification_type` ='2' and n.`status`='A' and n.`sending_status`='No' ";				
		$results = $this->Mydb->custom_query ( $query );
		return $results;		
	}
	
	function get_notification_list()
	{
		$notifi_sql = "SELECT *	FROM `pos_notifications` as n		
						left join pos_notification_users as  nuser on nuser.notification_id = n.notification_id 		
						WHERE n.`status`='A' and n.`notification_type`='1' and n.`sending_status`='No' ";
						
		$result     = $this->Mydb-> custom_query($notifi_sql);
		//print_r($result);
		
		return $result;
	}
	
	function get_all_users ($customerId,$notification_app_id)
	{
		//print_r($customerId);
		if($customerId !='ALL' && $customerId !='')
		{
			$where = " and  pc.customer_id IN ($customerId)";
		}
		$select ="SELECT * FROM `pos_customers` as pc WHERE pc.customer_status !='D' and (user_android_id!='' OR user_ios_id!='') and customer_app_id='$notification_app_id' ";
		
		$query = $select.$where;
				
		$result     = $this->Mydb-> custom_query($query);
		
		//echo $this->db->last_query();exit;
		
		return $result;
	}
	
	
	function sendmail()
	{	
		 return false;
		$this->load->library('email');
		$config['protocol'] = "smtp";
		//$config['smtp_auth'] = TRUE;
		 
		$config['smtp_crypto'] = 'tls';
		$config['smtp_host']	= 'smtp.office365.com';
 		$config['smtp_user']	= 'orders@pastamania.com';
 		$config['smtp_pass']	= 'Pmi@159354';
		$config['smtp_port'] = "587";
		$config['charset'] = "utf-8";
		$config['mailtype'] = "html";
		$config['newline'] = "\r\n";

		$this->email->initialize($config);

		$this->email->from('orders@pastamania.com', 'Blabla');
		$list = array('rmarktest@gmail.com');
		$this->email->to($list);
		//$this->email->reply_to('my-email@gmail.com', 'Explendid Videos');
		$this->email->subject('This is an email test');
		$this->email->message('It is working. Great!');
		$this->email->send();
		echo $this->email->print_debugger();
		 
	}
	
	
	
	/* mail notification to user */
	  function orderMailNotification()
	{
		//echo 23232; exit;
		
		//$insert_id = $this->Mydb->insert('cron_log',array('cron_status'=>'Y','cron_text'=>'test new cron job','cron_created_on'=>current_date()));
		
		  $all_records = $this->Mydb->get_all_records('email_order_id,email_company_id,email_app_id,email_id','email_notification',array('email_status' => 'No','email_payment_status'=>'Yes'));

		   if(!empty($all_records))
		   {
		   	  foreach($all_records as $rec) 
		   	  {
		   	  	
		   	   $url = "http://ezzysales.com/getjuiced/api/ordersv2/order_email?app_id=".$rec['email_app_id']."&order_id=".$rec['email_order_id'];
		 
		   	   $header = array (
		   	   		"Accept: application/json"
		   	   );
		   	   
		   	   $ch = curl_init ();
		       curl_setopt ( $ch, CURLOPT_HTTPHEADER, $header );
		   	   curl_setopt ( $ch, CURLOPT_ENCODING, "gzip" );
		   	   curl_setopt ( $ch, CURLOPT_CUSTOMREQUEST, 'GET' );
		   	   curl_setopt ( $ch, CURLOPT_URL, $url );
		   	   curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
		   	   // curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)');
		   	   
		   	   $retValue = curl_exec ( $ch );
		   	   $result = json_decode ( curl_exec ( $ch ) );
		   	    $httpCode = curl_getinfo ( $ch, CURLINFO_HTTP_CODE );
		   	    curl_close ( $ch );
		   	 // if(isset($result->status) && $result->status == "ok") {
		   	  	$this->Mydb->update('email_notification',array('email_id' => $rec['email_id']),array('email_status'=>'Yes','email_updated_on'=>current_date()));
		   	  //}
		 
		   	  }
		   	
		   }
		    
	}
	
 
	
}
