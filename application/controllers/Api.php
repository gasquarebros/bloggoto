<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS, POST");

/**************************
 Project Name	: Bloggotoweb
Description		: Device Udpate

***************************/
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';
// header('Access-Control-Allow-Origin: *');
class Api extends REST_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->library ( 'form_validation' );
		$this->form_validation->set_error_delimiters ( '<p>', '</p>' );
		$this->table = "customers";
		$this->customer_login_history = "customer_login_history";
		$this->primary_key='customer_id';
		$this->page_table = 'cmspage';
		$this->load->helper('string');
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
						$access_token = random_string('alnum', 16);
						$session_datas = array('bg_user_id' => $check_details['customer_id'],'bg_first_name' => $check_details['customer_first_name'],'bg_last_name' => $check_details['customer_last_name'],'bg_user_group' => ($check_details['customer_type'] == 0)?'writer':'brand','bg_user_type'=>$check_details['customer_type'],'company_name'=>$check_details['company_name'],'customer_username'=>$check_details['customer_username'],'access_token'=>$access_token);
						
						if($check_details['customer_photo'] !='' && file_exists(FCPATH."media/".$this->lang->line('customer_image_folder_name')."/".$check_details['customer_photo'])) {
							$session_datas['bg_user_profile_picture'] = media_url().$this->lang->line('customer_image_folder_name')."/".$check_details['customer_photo'];
						}
						else
						{
							$session_datas['bg_user_profile_picture'] = '';
						}
						
						$this->Mydb->update ( 'customers', array (
							'customer_id' => $check_details['customer_id'] 
						), array (
							'customer_access_token' => $access_token,
							// 'customer_device_id' => $deviceid,
							// 'customer_device_type' => $device_type 
						));
						
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
		
			$this->response ( $response, something_wrong () ); /* error message */
			exit;
			
		} else {

			$response ['status'] = 'error';
			$response ['message'] = validation_errors ();
		
			$this->response ( $response, something_wrong () ); /* error message */
			exit;
		}
		echo "sucess";
		exit;
	}
	function updateinfo_post() {
		$this->form_validation->set_rules ( 'userid', 'lang:rest_customer_id_required', 'trim|required' );
		$this->form_validation->set_rules ( 'pagetype', 'lang:pagetype', 'trim|required' );
		if ($this->form_validation->run () == TRUE) {
			$this->Mydb->update ( 'customers', array (
				'customer_id' => $this->input->post('userid')
			), array (
				'customer_default_page' => $this->input->post('pagetype'), 
			));
			$this->response (array('status'=>'success','message'=>'Updated Successfully'), success_response ());
		} else {
			$response ['status'] = 'error';
			$response ['message'] = validation_errors ();
		
			$this->response ( $response, something_wrong () ); /* error message */
			exit;
		}
	}
	
	function page_get() { 
		$segment = $this->input->get('page');
		if($segment !='')
		{
			$where = "cmspage_slug = '".$segment."'";
			$data = $this->Mydb->get_record ( '*', $this->page_table, $where);
			$this->response ( array('status'=>'success','data'=>$data), success_response () );
		} else {
			$alert = 'acount_login_missmatch';
			$response ['status'] = 'error';
			$response ['message'] = get_label ( $alert );
			$this->response ( $response, something_wrong () ); /* error message */
			exit;
		}
	}
	
	
	
	/* this method used to check login */
	function register_post() {
		
		$this->form_validation->set_rules ( 'customer_first_name', 'lang:customer_first_name', 'required' );
		$this->form_validation->set_rules ( 'customer_password', 'lang:customer_password', 'required|min_length[6]' );
		$this->form_validation->set_rules ( 'customer_cpassword', 'lang:customer_cpassword', 'required|matches[customer_password]|min_length[6]' );
		$this->form_validation->set_rules ( 'customer_email', 'lang:customer_email', 'required|valid_email|valid_email|callback_email_exists' );
		$this->form_validation->set_rules ( 'customer_username', 'lang:customer_username', 'required|callback_username_exists' );
		if($this->input->post('customer_type') == 1)
		{
			$this->form_validation->set_rules('company_name','lang:company_name','required|callback_validate_companyname');
		}				
		if ($this->form_validation->run () == TRUE) {
			
			$password = do_bcrypt($this->input->post('customer_password'));  
			
			/* upload image */
			$customer_photo = "";
			if ($this->input->post('customer_photo') != "") {
				// $customer_photo = $this->common->upload_image ( 'customer_photo', $this->lang->line('customer_image_folder_name') );
				$decode_customer_image = base64_decode($this->input->post('customer_photo'));
				$customer_image_obj = imagecreatefromstring($decode_customer_image);
				$customer_image_name = 'customer_image_'.date('Ymdhis').'.jpg';
				$customer_image_path = FCPATH . 'media/' .$this->lang->line('customer_image_folder_name');
				imagejpeg($customer_image_obj,$customer_image_path.$customer_image_name);
				$customer_photo = $customer_image_name;
			}
			$activation_key = get_guid ( $this->table, 'customer_activation_key' );
			/*generate access token*/
			$access_token = get_guid ( $this->table, 'customer_access_token' );

			$insert_array = array (
					'customer_first_name' => $this->input->post ( 'customer_first_name' ),
					'customer_last_name' => $this->input->post ( 'customer_last_name' ),
					'customer_username'=>$this->input->post ( 'customer_username' ),
					'customer_email'=>$this->input->post ( 'customer_email' ),
					'customer_phone'=>$this->input->post ( 'customer_phone' ),
					'customer_type'=>$this->input->post ( 'customer_type' ),
					'company_name'=>($this->input->post ( 'customer_type' ) == 1)?$this->input->post ( 'company_name' ):'',
					'customer_password' => $password,
					'customer_photo' => $customer_photo,
					'customer_activation_key' => $activation_key,
					'customer_access_token' => $access_token,
					'customer_status' => 'A',
					'customer_created_on' => current_date (),
					'customer_created_ip' => get_ip () 
			);
			
			$insert_id = $this->Mydb->insert ( $this->table, $insert_array );
	
			if($insert_id)
			{
				$activate_link=base_url()."activation/".$activation_key;
				
				$this->load->library('myemail');
				$check_arr = array('[NAME]','[EMAIL]','[ACTIVATELINK]','[PASSWORD]');
				$replace_arr = array($this->input->post('customer_first_name')." ".$this->input->post('customer_last_name'),$this->input->post('customer_email'),$activate_link,$this->input->post('customer_password'));
				$this->myemail->send_admin_mail($this->input->post('customer_email'),get_label('customer_registration_template'),$check_arr,$replace_arr);
				
				$this->response (array('status'=>'success','message'=>'Registered Successfully'), success_response ());
			}
		
		} else {
			$response ['status'] = 'error';
			$response ['message'] = validation_errors ();
		
			$this->response ( $response, something_wrong () ); /* error message */
			exit;
		}
	}
	
	/* this method used check user name or alredy exists or not */
	public function validate_companyname() {
		$email = $this->input->post ( 'company_name' );
		$edit_id = '';
		
		$where = array (
				'company_name' => trim ( $email ),
		);

		
		$result = $this->Mydb->get_record ( 'company_name', $this->table, $where );
		
		if (! empty ( $result ) ) {
			$this->form_validation->set_message ( 'validate_companyname', 'Business Name Already Exist' );
			return false;
		} else {
			return true;
		}
	}
	
	
	/* this method used check email address or alredy exists or not */
	public function email_exists() {
		$email = $this->input->post ( 'customer_email' );
		$edit_id = $this->input->post ( 'edit_id' );
		$user_arr = array();
		$where = array (
				'customer_email' => trim ( $email ),
				'customer_status !='=>'D',
				
		);
		if ($edit_id != "") {
			$where = array_merge ( $where, array (
					"customer_id !=" => $edit_id
			) );
			
		}
		
		$result = $this->Mydb->get_record ( 'customer_id', $this->table, $where );
		
		if (! empty ( $result )) {
			$this->form_validation->set_message ( 'email_exists', get_label ( 'customer_email_exist' ) );
			return false;
		} else {
			return true;
		}
	}
	
	/* this method used check user name or alredy exists or not */
	public function username_exists() {
		$email = $this->input->post ( 'customer_username' );
		
		$where = array (
			'customer_username' => trim ( $email ),
		);
		
		$result = $this->Mydb->get_record ( 'customer_id', $this->table, $where );
		
		if (! empty ( $result ) ) {
			$this->form_validation->set_message ( 'username_exists', get_label ( 'customer_username_exist' ) );
			return false;
		} else {
			return true;
		}
	}
	
	/* this method used to to check validate image file */
	public function validate_image() {
		if (isset ( $_FILES ['customer_photo'] ['name'] ) && $_FILES ['customer_photo'] ['name'] != "") {
			if ($this->common->valid_image ( $_FILES ['customer_photo'] ) == "No") {
				$this->form_validation->set_message ( 'validate_image', get_label ( 'upload_valid_image' ) );
				return false;
			}
		}
		
		return true;
	}
	
	public function countries_get() {
	    $where_array = array('id !='=>'');
		$type = $this->input->get('type');
		$data = array();
		if($type == 'country' || $type == 'all') {
    		$countries_result=$this->Mydb->get_all_records('id,varName','countries',$where_array,'','',array('varName'=>"ASC"));
    		$countries =array(''=>get_label('select_country'));
    		/*if(!empty($countries_result))
    		{
    			foreach($countries_result as $value)
    			{
    				$countries[$value['id']] = stripslashes($value['varName']);
    			}
    		}*/
    		$data['countries'] = $countries_result;
		}
		if($type == 'state' || $type == 'all') {
    		$states_result =$this->Mydb->get_all_records('id,varStateName,intCountryId','states',array('intCountryId'=>99),'','',array('varStateName'=>"ASC"));
    		$states = [];
    		/*if(!empty($states_result))
    		{
    			foreach($states_result as $value)
    			{
    				$states[] = array('id'=>$value['id'], 'name'=>stripslashes($value['varStateName']),'countryid'=>$value['intCountryId']);
    			}
    		}*/
    		$data['states'] = $states_result;
		}
		if($type == 'city' || $type == 'all') {
    		$cities_result =$this->Mydb->get_all_records('city_id, city_name, city_state','cities','','','',array('city_name'=>"ASC"));
    		$cities = [];
    		/*
    		if(!empty($cities_result))
    		{
    			foreach($cities_result as $value)
    			{
    				$cities[] = array('id'=>$value['city_id'], 'name'=>stripslashes($value['city_name']),'stateid'=>$value['city_state']);
    			}
    		}*/
    		$data['cities'] = $cities_result;
		}
		
		$result ['status'] = 'success';
		$result['data'] = $data;
		echo json_encode ( $result );
		exit ();
	}
	
	
} /* end of files */
