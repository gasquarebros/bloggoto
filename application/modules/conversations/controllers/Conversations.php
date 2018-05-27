<?php
/**************************
Description		: Page contains clients add edit and delete functions..

***************************/
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Conversations extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		$this->authentication->user_authentication();
	    $this->module = "Conversations";
		$this->module_label = "Conversations";
		$this->module_labels = "Conversations";
		$this->folder = "conversations/";

		$this->notification = 'notification';
		$this->notification_message = 'notification_message';
		$this->reply = 'notification_reply';			
		
		
		$this->load->library ( 'common');
		$this->load->library('upload');
		//$this->load->helper('message');
		
		$users = current_users_details();		
		if(!empty($users)) {
			$this->user_details = (object)$users;
		}
		else {
			redirect('logout');
		}
	}

	public function index()
	{
		$data =$this->load_module_info();
        $data['content'] = '';
		$allusers = loadallUser();
		$users = array();
		if(!empty($allusers))
		{
			foreach($allusers as $alluser) {
				$users[$alluser['customer_id']] = $alluser;
			}
		}
        $data['allusers'] = $users;
      
	    		$send_message = $sub_query ='';
	    	if(!empty($_GET['filter'])) {
	    		if($_GET['filter']=='trash') {
	    			$sub_query = "
	    		(SELECT COUNT(nnm.`notification_id`) FROM pos_notification_message AS nnm WHERE ((nnm.`assigned_from`='".$this->user_details->bg_user_id."'  AND nnm.`from_delete`='Y') OR (nnm.`assigned_to`='".$this->user_details->bg_user_id."'  AND nnm.`to_delete`='Y')) AND nnm.`message_id`=`pos_n`.`notification_id`) AS from_tow, ";
	    		}
	    		if($_GET['filter']=='sentbox') {
	    			$send_message = " AND pos_n.message_type='M'"; 
	    		}
	    	}
	    	else {
	    		$sub_query = "
	    		(SELECT COUNT(nnm.`notification_id`) FROM pos_notification_message AS nnm WHERE ((nnm.`assigned_from`='".$this->user_details->bg_user_id."' AND nnm.`from_delete`='N') OR (nnm.`assigned_to`='".$this->user_details->bg_user_id."'  AND nnm.`to_delete`='N')) AND nnm.`message_id`=`pos_n`.`notification_id`) AS from_tow, ";
	    	}


	    	$query = $this->db->query("SELECT 

	    		(SELECT COUNT(nnm.`notification_id`) FROM pos_notification_message AS nnm WHERE (nnm.`assigned_from`='".$this->user_details->bg_user_id."' OR nnm.`assigned_to`='".$this->user_details->bg_user_id."') AND nnm.`message_id`=`pos_n`.`notification_id` AND nnm.`open_status`='N') AS open_status, ".$sub_query."
	    		`nm`.`message`, `nm`.`assigned_from`, `nm`.`assigned_to`, `nm`.`to_delete`, `nm`.`created_on`, `nm`.`from_delete`, `nm`.`message_type` AS `msg_type`, `nm`.`to_delete`, `pos_n`.`notification_id`, `pos_n`.`created_type`, `pos_n`.`message_type`, `pos_n`.`subject` FROM `pos_notification` AS `pos_n` INNER JOIN `pos_notification_message` AS `nm` ON `pos_n`.`notification_id` = `nm`.`message_id` WHERE (`nm`.`assigned_to` = '".$this->user_details->bg_user_id."' OR `nm`.`assigned_from` = '".$this->user_details->bg_user_id."') ".$send_message." GROUP BY `pos_n`.`notification_id` ORDER BY `nm`.`created_on` DESC");
	    	$data['notification'] =  $query->result_array();
	    	
        $this->layout->display_site($this->folder . 'index',$data);
	}

	public function view()
	{
		$data =$this->load_module_info();
        $data['content'] = '';
        $notification_id = decode_value($this->uri->segment('3'));
        $allusers = loadallUser();
        //$allusers = loadfollowers(array('follow_customer_id'=>$this->user_details->bg_user_id));
		$users = array();
		if(!empty($allusers))
		{
			foreach($allusers as $alluser) {
				$users[$alluser['customer_id']] = $alluser;
			}
		}
        $data['allusers'] = $users;
       
		$join[0]['select'] = 'nm.message, nm.assigned_from, nm.assigned_to, nm.to_delete, nm.created_on, nm.from_delete, nm.message_type AS msg_type, nm.to_delete';
		$join[0]['table'] = $this->notification_message.' AS nm';
		$join[0]['condition'] = "pos_n.notification_id = nm.message_id";
		$join[0]['type'] = 'INNER';
		//'nm.assigned_to'=>$this->user_details->bg_user_id, 
		$where  = array('pos_n.notification_id'=>$notification_id);

    	$notification = $this->Mydb->get_all_records('pos_n.notification_id, pos_n.created_type, pos_n.message_type, pos_n.subject', $this->notification.' AS pos_n',$where,'', '', array('nm.created_on'=>'ASC'), null, null, $join);
    	if(!empty($notification)) {
    		$not_open = $this->Mydb->get_record('', $this->notification_message, array('message_id'=>$notification_id, 'open_status'=>'N'));
    		if(!empty($not_open)) {
    			$record = array(
				'open_status'=>'Y'
				);
				$this->Mydb->update($this->notification_message,array('message_id'=>$notification_id, 'open_status'=>'N','assigned_to'=>get_user_id()),$record);
    		}
    		
    		$data['notification'] = $notification;
        	$this->layout->display_site($this->folder . 'view',$data);
    	}
    	else {
        	redirect(base_url('conversations'));
        }

	}

	public function post_reply()
	{
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		}
		$post_data = $this->input->post();
		$cu_date = current_date();
		$record = array(
				'notification_id'=>$post_data['notification_id'],
				'reply'=>get_censored_string($post_data['message_body']),
				'created_by'=>$this->user_details->bg_user_id,
				'created_on'=>$cu_date,				
				'ip_address'=>get_ip(),
				);
		/*$this->Mydb->insert($this->reply,$record);*/

		new_reply($record);


		$user_id = $this->user_details->bg_user_id;
		$profile_pic = skin_url('images/man.png');
		$name = ucwords($this->user_details->bg_first_name.' '.$this->user_details->bg_last_name);
		
		if(file_exists($this->user_details->bg_user_profile_picture) && !empty($this->user_details->profile_image) && @is_array(getimagesize($this->user_details->profile_image)))
        {
            $profile_pic = $this->user_details->bg_user_profile_picture;
           
        }	
		
		$datas = '<div class="timeline-entry margin-top-15">
				<div class="timeline-stat margin-top-20" >
					<small ><img class="circle-md" src="'.$profile_pic.'"  alt="'.$name.'" data-tooltip="tooltip" data-placement="top" title="" data-original-title="'.$name.'"></small>
				</div>
				<div class="panel timeline-label">
					<div class="panel-heading">
						<h3 class="panel-title panel-title-small">'.$name.'</h3>
					</div>
					<div class="panel-body ">
						<div class="row">
							'.$post_data['message_body'].'
							<br />
							<br />
							<i class="fa fa-clock-o fa-fw margin-right-5"></i>'.date('d F Y',strtotime($cu_date)).'
						</div>
					</div>
				</div>
			</div>';
		echo json_encode(array('status'=>'success', 'message'=>get_label('reply_succ'), 'datas'=>$datas));

	}

	public function trash()
	{
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		}
		$post_data = $this->input->post();
		if($post_data['curent_type']==1 || $post_data['curent_type']==2) { $trash_status = 'Y';  $message = get_label('trash_succ'); }
		if($post_data['curent_type']==3) { $trash_status = 'N'; $message = get_label('restore_succ'); }
		$where = array('message_id'=>$post_data['notification_id'], 'assigned_from'=>$this->user_details->bg_user_id);
		$where1 = array('message_id'=>$post_data['notification_id'], 'assigned_to'=>$this->user_details->bg_user_id);
		
		$record = array(
			'from_delete'=>$trash_status
			);
		$this->Mydb->update($this->notification_message,$where,$record);
		$record = array(
			'to_delete'=>$trash_status
			);
		$this->Mydb->update($this->notification_message,$where1,$record);
		echo json_encode(array('status'=>'success', 'message'=>get_label('trash_succ')));
	}

	public function new_message()
	{
		$data =$this->load_module_info();
        $data['content'] = '';
        $notification_id = $this->uri->segment('3');
        $customer_id = decode_value($this->uri->segment('3'));
		$data['customer_id'] = $customer_id;
        $data['user_data'] = loadallUser();
		// echo "<pre>";
		// print_r($data);
		// exit;
        $data['allusers'] = loadfollowers(array('follow_customer_id'=>$this->user_details->bg_user_id,'customer_status'=>'A'));
       
        $this->layout->display_site($this->folder . 'new',$data);
         
	}
	public function create_message()
	{
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		}
		$post_data = $this->input->post();
		
		$cu_date = current_date();
		//created_type
		/*if($this->user_details->system_role==1) {
			$created_type = 'A';
		}else if($this->user_details->system_role==2) {
			$created_type = 'M';
		}
		else { */
			$created_type = 'E';
		/* } */
		$user_id = $post_data['user_id'];
		foreach ($user_id as $ukey => $uval) {
			$record = array(
				'created_type'=>$created_type,
				'message_type'=>'M',
				'subject'=>get_censored_string($post_data['subject']),
				'message'=>get_censored_string($post_data['message']),
				'private'=>(isset($post_data['private']))?$post_data['private']:0,
				'created_by'=>$this->user_details->bg_user_id,
				'assigned_to'=>$uval,
				'created_on'=>$cu_date,				
				'ip_address'=>get_ip(),
				);
			$notification_id = new_notify($record);

			//$notification_id = $this->Mydb->insert($this->notification,$record);
		}
		if(count($user_id)==1) {
			$redirect = 'conversations/view/'.$notification_id;
		}
		else {
			$redirect = 'conversations?filter=sentbox';
		}
		echo json_encode(array('status'=>'success', 'message'=>get_label('message_succ'), 'redirect'=>$redirect));

		
	}
	

	/* this method used to common module labels */
	private function load_module_info() {
		$data = array ();
		$data ['module_label'] = $this->module_label;
		$data ['module_labels'] = $this->module_labels;
		$data ['module'] = $this->module;
		return $data;
	}
}
