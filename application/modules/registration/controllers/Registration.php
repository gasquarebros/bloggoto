<?php
/**************************
Project Name	: BlogGotoWeb
Created on		: 27 Nov, 2017
Last Modified 	: 27 Nov, 2017
Description		: Page contains frontend panel login and forgot password functions.

***************************/
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Registration extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		$this->module = "registration";
		$this->module_label = get_label('registration_module_label');
		$this->module_labels = get_label('registration_module_label');
		$this->folder = "registration/";
		$this->table = "customers";
		$this->primary_key='customer_id';
		

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
	
	/* this method used to check login */
	public function index() {
		$data = array ();
		/*if(get_user_id() !=""){
			redirect(base_url()."dashboard");
		}*/
		/* form submit */
		if ($this->input->post ( 'action' ) == "Add") {
			check_ajax_request (); /* skip direct access */
			$this->form_validation->set_rules ( 'customer_first_name', 'lang:customer_first_name', 'required' );
			$this->form_validation->set_rules ( 'customer_password', 'lang:customer_password', 'required|min_length[' . get_label ( 'customer_password_minlength' ) . ']' );
			$this->form_validation->set_rules ( 'customer_cpassword', 'lang:customer_cpassword', 'required|matches[customer_password]|min_length[' . get_label ( 'customer_password_minlength' ) . ']' );
			$this->form_validation->set_rules ( 'customer_email', 'lang:customer_email', 'required|valid_email|valid_email|callback_email_exists' );
			$this->form_validation->set_rules ( 'customer_username', 'lang:customer_username', 'required|callback_username_exists' );
			//$this->form_validation->set_rules ( 'company_logo', 'lang:company_logo', 'callback_validate_image' );
			//$this->form_validation->set_rules('country','lang:company_country','required'); 
			//$this->form_validation->set_rules('company_industry','lang:company_industry','required'); 
			//$this->form_validation->set_rules('currency','lang:company_currency','required'); 
			//$this->form_validation->set_rules('date_format','lang:company_date_format','required'); 
			if($this->input->post('customer_type') == 1)
			{
				$this->form_validation->set_rules('company_name','lang:company_name','required|callback_validate_companyname');
			}				
			if ($this->form_validation->run () == TRUE) {
				
				$password = do_bcrypt($this->input->post('customer_password'));  
				
				/* upload image */
				$customer_photo = "";
				if (isset ( $_FILES ['customer_photo'] ['name'] ) && $_FILES ['customer_photo'] ['name'] != "") {
					$customer_photo = $this->common->upload_image ( 'customer_photo', $this->lang->line('customer_image_folder_name') );
				}
				$activation_key = get_guid ( $this->table, 'customer_activation_key' );
				/*generate access token*/
				$access_token = get_guid ( $this->table, 'customer_access_token' );

				$insert_array = array (
						'customer_first_name' => post_value ( 'customer_first_name' ),
						'customer_last_name' => post_value ( 'customer_last_name' ),
						'customer_username'=>post_value ( 'customer_username' ),
						'customer_email'=>post_value ( 'customer_email' ),
						'customer_phone'=>post_value ( 'customer_phone' ),
						'customer_type'=>post_value ( 'customer_type' ),
						'company_name'=>(post_value ( 'customer_type' ) == 1)?post_value ( 'company_name' ):'',
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
					
					$this->session->set_flashdata ( 'success', sprintf ( $this->lang->line ( 'account_success_created' ) ) );
				 	$result ['status'] = 'success';
				}
				
				
			} else {
				$result ['status'] = 'error';
				$result ['message'] = validation_errors ();
			}
			
			echo json_encode ( $result );
			exit ();
		}
		$data = $this->load_module_info ();
		$data['meta_title'] = "Register Your Account | BlogGotoWeb";
		$data['meta_keyword'] = "register your account, create account, Blogging";
		$data['meta_description'] = "Register with us to share your Blog to all.";
		$this->load->view ( $this->folder . 'registration',$data );
	}
	
	public function thankyou() {
		$data = array();
		$data = $this->load_module_info ();
		$this->layout->display_site ( $this->folder . "thankyou", $data );
		//$this->load->view( $this->folder . 'thankyou',$data );
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
	
	
	/* this method used to common module labels */
	private function load_module_info() {
		$data = array ();
		$data ['module_label'] = $this->module_label;
		$data ['module_labels'] = $this->module_labels;
		$data ['module'] = $this->module;
		return $data;
	}
}
