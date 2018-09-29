<?php
/**************************
 Project Name	: Bloggotoweb
Description		: Device Udpate

***************************/
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';
class Api extends REST_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->library ( 'form_validation' );
		$this->form_validation->set_error_delimiters ( '<p>', '</p>' );
		$this->table = "customers";
		$this->customer_login_history = "customer_login_history";
		$this->primary_key='customer_id';
	}

	function insert_post() {

		$this->form_validation->set_rules ( 'reference_id', 'lang:rest_customer_id_required', 'trim|required' );
		$this->form_validation->set_rules ( 'device_id', 'lang:device_id', 'trim|required' );
		$this->form_validation->set_rules ( 'device_type', 'lang:device_type', 'trim|required' );

		if ($this->form_validation->run () == TRUE) {
			
			/* post values */
			$userid = decode_value($this->post ( 'reference_id' )); /* mobile device id or browser session id */
			$deviceid = $this->post ( 'device_id' );
			$device_type = $this->post ( 'device_type' );
			
			$this->Mydb->update ( 'customers', array (
					'customer_id' => $userid 
			), array (
					'customer_device_id' => $deviceid,
					'customer_device_type' => $device_type 
			) );
			
			$return_array = array (
					'status' => "ok",
					'message' => 'Success' 
			);
			$this->set_response ( $return_array, success_response () );
			
	    	$log_array=json_encode(array_merge($return_array,array('userid'=>$userid,'device_type'=>$device_type,'deviceid'=>$deviceid)));
	        $file_name='device_log.txt';
	        $log_file =APPPATH.'/logs/'.$file_name;
	        file_put_contents($log_file,$log_array);			
		} else {
			
			$this->response ( array (
					'status' => 'error',
					'message' => get_label ( 'rest_form_error' ),
					'form_error' => validation_errors () 
			), something_wrong () ); /* error message */
		}
	}
	
	function login_post() {
		
		$alert = '';
		$this->form_validation->set_rules ( 'username', 'Username', 'required|trim' );
		$this->form_validation->set_rules ( 'password', 'Password', 'required|min_length[' . PASSWORD_LENGTH . ']|trim' );
		if ($this->form_validation->run ( $this ) == TRUE) {
			
			$this->mysqli = new mysqli ( $this->db->hostname, $this->db->username, $this->db->password, $this->db->database );
			$password = $this->mysqli->real_escape_string ( trim ( $this->input->post ( 'password' ) ) );
			$username = $this->mysqli->real_escape_string ( trim ( $this->input->post ( 'username' ) ) );

			$check_details = $this->Mydb->get_record ('customer_id,customer_first_name,customer_username,customer_last_name,customer_email,customer_password,customer_status,customer_type,customer_photo,company_name', $this->table, array ('(customer_email = "'.$username.'" OR customer_username ="'.$username.'")'=>NULL,'customer_status !='=>'D') );
			if ($check_details)
			{
				if ($check_details['customer_status'] == 'A'){
						
					$password_verify = check_hash($password,$check_details['customer_password']);
						
					if($password_verify == "Yes")
					{
						$session_datas = array();
						$redirect= "";
						$session_datas = array('bg_user_id' => $check_details['customer_id'],'bg_first_name' => $check_details['customer_first_name'],'bg_last_name' => $check_details['customer_last_name'],'bg_user_group' => ($check_details['customer_type'] == 0)?'writer':'brand','bg_user_type'=>$check_details['customer_type'],'company_name'=>$check_details['company_name'],'customer_username'=>$check_details['customer_username']);

						if($check_details['customer_photo'] !='' && file_exists(FCPATH."media/".$this->lang->line('customer_image_folder_name')."/".$check_details['customer_photo'])) {
							$session_datas['bg_user_profile_picture'] = media_url().$this->lang->line('customer_image_folder_name')."/".$check_details['customer_photo'];
						}
						else
						{
							$session_datas['bg_user_profile_picture'] = '';
						}
						
						$this->Mydb->insert($this->customer_login_history,array('login_time'=>current_date(),'login_ip'=>get_ip(),'login_customer_id'=>$check_details['customer_id']));
						$this->response ( array('status'=>'success','user_data'=>$session_datas), success_response () );
					}	else{
						$alert = 'acount_login_missmatch';
					}
				}
				else{
					$alert = 'account_disabled';
				}
			}
			else
			{
				$alert = 'acount_not_found';
					
			}
			
			$response ['status'] = 'error';
			$response ['message'] = get_label ( $alert );
		echo "response";
		exit;
			$this->response ( $response, something_wrong () ); /* error message */
			exit;
			
		} else {

			$response ['status'] = 'error';
			$response ['message'] = validation_errors ();
		echo "response";
		exit;
			$this->response ( $response, something_wrong () ); /* error message */
			exit;
		}
		echo "sucess";
		exit;
	}
} /* end of files */
