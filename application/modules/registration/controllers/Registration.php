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
			//$this->form_validation->set_rules ( 'company_logo', 'lang:company_logo', 'callback_validate_image' );
			//$this->form_validation->set_rules('country','lang:company_country','required'); 
			//$this->form_validation->set_rules('company_industry','lang:company_industry','required'); 
			//$this->form_validation->set_rules('currency','lang:company_currency','required'); 
			//$this->form_validation->set_rules('date_format','lang:company_date_format','required'); 
			//$this->form_validation->set_rules('time_format','lang:company_time_format','required');  
			if ($this->form_validation->run () == TRUE) {
				
				$password = do_bcrypt($this->input->post('customer_password'));  
				
				/* upload image */
				$customer_photo = "";
				if (isset ( $_FILES ['customer_photo'] ['name'] ) && $_FILES ['customer_photo'] ['name'] != "") {
					$customer_photo = $this->common->upload_image ( 'customer_photo', $this->lang->line('customer_image_folder_name') );
				}

				$insert_array = array (
						'customer_first_name' => post_value ( 'customer_first_name' ),
						'customer_last_name' => post_value ( 'customer_last_name' ),
						'customer_email'=>post_value ( 'customer_email' ),
						'customer_phone'=>post_value ( 'customer_phone' ),
						'customer_type'=>post_value ( 'customer_type' ),
						'customer_password' => $password,
						'customer_photo' => $customer_photo,
						'customer_status' => 'I',
						'customer_created_on' => current_date (),
						'customer_created_ip' => get_ip () 
				);
				
				$insert_id = $this->Mydb->insert ( $this->table, $insert_array );
				
				
				if($insert_id)
				{
				 	$this->load->library('myemail');
				 	$check_arr = array('[NAME]','[EMAIL]','[PASSWORD]');
				 	$replace_arr = array($this->input->post('customer_first_name')." ".$this->input->post('customer_last_name'),$this->input->post('customer_email'),$this->input->post('customer_password'));
				 	//$this->myemail->send_admin_mail($this->input->post('customer_email'),get_label('customer_registration_template'),$check_arr,$replace_arr);

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
		$email = $this->input->post ( 'company_username' );
		$edit_id = $this->input->post ( 'edit_id' );
		/*
		$where = array (
				'company_username' => trim ( $email ),
				'company_status !='=>'D'
		);
		if ($edit_id != "") {
			$where = array_merge ( $where, array (
					"company_id !=" => $edit_id 
			) );
			
		}
		
		$result = $this->Mydb->get_record ( 'company_id', $this->table, $where );
		
		
		if ($edit_id != "") {
			$where = array_merge ( $where, array (
					"company_id !=" => $edit_id
			) );
			
		} 
		
		$result = $this->Mydb->get_record ( 'company_id', $this->table, $where ); */
		
		if (! empty ( $result ) ) {
			$this->form_validation->set_message ( 'username_exists', get_label ( 'company_username_exist' ) );
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
