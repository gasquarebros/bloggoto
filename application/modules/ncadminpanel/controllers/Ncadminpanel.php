<?php
/**************************
Project Name	: POS
Created on		: 18 Feb, 2016
Last Modified 	: 07 March, 2016
Description		: Page contains admin panel login and forgot password functions.

***************************/
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Ncadminpanel extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		$this->module = "ncadminpanel";
		$this->module_label = "Ncadminpanel";
		$this->module_labels = "Ncadminpanels";
		$this->folder = "login/";
		$this->table = "mater_admin";
		$this->login_history_table = "master_admin_login_history";
		$this->primary_key='admin_id';
		

	}
	
	/* this method used to check login */
	public function index() {
		$data = array ();
		if(get_admin_id() !=""){
				
			redirect(admin_url()."dashboard");
		}
		
		if ($this->input->post ( 'submit' ) == 'Login') 		
		{
			check_ajax_request (); /* skip direct access */
			$response = array ();
			$alert = "";
			$this->form_validation->set_rules ( 'username', 'Username', 'required|trim' );
			$this->form_validation->set_rules ( 'password', 'Password', 'required|min_length[' . PASSWORD_LENGTH . ']|trim' );
			if ($this->form_validation->run ( $this ) == TRUE) {
				
				$this->mysqli = new mysqli ( $this->db->hostname, $this->db->username, $this->db->password, $this->db->database );
				$password = $this->mysqli->real_escape_string ( trim ( $this->input->post ( 'password' ) ) );
				$username = $this->mysqli->real_escape_string ( trim ( $this->input->post ( 'username' ) ) );

				$check_details = $this->Mydb->get_record ('admin_id,admin_username,admin_password,admin_status', $this->table, array ('admin_username' => $username) );
				
				if ($check_details)
				{
					if ($check_details['admin_status'] == 'A'){
							
						$password_verify = check_hash($password,$check_details['admin_password']);
							
						if($password_verify == "Yes")
						{
							$session_datas = array('nc_admin_id' => $check_details['admin_id'],'nc_admin_name' => 'Admin' );
		
							$this->session->set_userdata($session_datas);
							
							/* store last login details...*/
							$this->Mydb->insert($this->login_history_table,array('login_time'=>current_date(),'login_ip'=>get_ip(),'login_admin_id'=>$check_details['admin_id']));
				
							echo json_encode ( array('status'=>'success') ); exit;
				
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
				
				
				
			} else {
				$response ['status'] = 'error';
				$response ['message'] = validation_errors ();
			}
			echo json_encode ( $response ); exit;
		}
		
		
		if ($this->input->post ( 'submit' ) == 'Forgot Password') 		// if ajax submit
		{
			
			$response = array ();
			$alert = "";
			$this->form_validation->set_rules ( 'admin_email_address', 'Email Address', 'required|trim|valid_email' );
			if ($this->form_validation->run ( $this ) == TRUE) {
				
				$this->mysqli = new mysqli ( $this->db->hostname, $this->db->username, $this->db->password, $this->db->database );
				
				$check_details = $this->Mydb->get_record ('admin_id,admin_username,admin_email_address,admin_status,admin_password', $this->table, array ('admin_email_address' => post_value('admin_email_address')) );

				if ($check_details)
				{
					
					if ($check_details['admin_status'] == 'A'){
						$password_key=get_random_key('30',$this->table,'admin_pass_key');
						if($password_key)
						{
							$res=$this->Mydb->update ( $this->table, array ($this->primary_key => $check_details['admin_id'] ), array('admin_pass_key'=>$password_key) );
							if($res)
							{
								$reset_link=admin_url()."reset_password/".encode_value($check_details['admin_id'])."-".$password_key;
								$site_url =  admin_url();
								$this->load->library('myemail');
								$check_arr = array('[NAME]','[RESETLINK]','[SITEURL]');
								$replace_arr = array($check_details['admin_username'],$reset_link,$site_url);
								$this->myemail->send_admin_mail($check_details['admin_email_address'],get_label('company_forgot_password_template'),$check_arr,$replace_arr);
							}
							$this->session->set_flashdata ( 'admin_success', sprintf ( $this->lang->line ( 'reset_password_link' ) ) );
							echo json_encode ( array('status'=>'success') ); exit;
				
						} else{
							$alert = 'forgot_error';
						}
					}
					else{
						$alert = 'account_disabled';
					}
				}
				else
				{
					$alert = 'forgot_error';
				}
				
				$response ['status'] = 'error';
				$response ['message'] = get_label ( $alert );
			} else {
				$response ['status'] = 'error';
				$response ['message'] = validation_errors ();
			}
			echo json_encode ( $response ); exit;
		}
		
		
		$this->load->view ( $this->folder . '/login' );
	}
	
	public function reset_password()
	{
		if ($this->input->post ( 'submit' ) == 'Reset') 	
		{
			$alert = "";
			$this->form_validation->set_rules ( 'client_password', 'lang:client_password', 'required|min_length[' . get_label ( 'client_password_minlength' ) . ']' );
			$this->form_validation->set_rules ( 'client_cpassword', 'lang:client_cpassword', 'required|matches[client_password]|min_length[' . get_label ( 'client_password_minlength' ) . ']' );
			if ($this->form_validation->run ( $this ) == TRUE) {
				$check_details = $this->Mydb->get_record ('admin_id,admin_username,admin_email_address,admin_status,admin_password', $this->table, array ('admin_id'=>post_value('user_id'),'admin_status'=>'A') );
				if ($check_details)
				{
					$password = do_bcrypt($this->input->post('client_cpassword'));  
					$userid=post_value('user_id');
					$res=$this->Mydb->update ( $this->table, array ($this->primary_key => $userid ), array('admin_password'=>$password,'admin_pass_key'=>''));
					$this->session->set_flashdata ( 'admin_success', sprintf ( $this->lang->line ( 'password_changed' ) ) );
					echo json_encode ( array('status'=>'success') ); exit;
				}
				else
				{
					$alert = 'acount_not_found';
				}
				$response ['status'] = 'error';
				$response ['message'] = get_label ( $alert );
			}
			else {
				$response ['status'] = 'error';
				$response ['message'] = validation_errors ();
			}
			echo json_encode ( $response ); exit;
		}
		
		$password_key=($this->uri->segment(3))?$this->uri->segment(3):'';
		if($password_key !='')
		{
			$pass_key=explode('-',$password_key);
			if(count($pass_key) > 1)
			{
				$user_id=decode_value($pass_key[0]);
				$passwordkey=$pass_key[1];
				
				$check_details = $this->Mydb->get_record ('admin_id,admin_username,admin_email_address,admin_status,admin_password', $this->table, array ('admin_id' => $user_id,'admin_pass_key'=>$passwordkey,'admin_status'=>'A') );
				if ($check_details)
				{
					$data['user']=$check_details;
					$this->load->view ( $this->folder . '/resetpassword',$data );
				}
				else
				{
					$this->session->set_flashdata ( 'admin_success', sprintf ( $this->lang->line ( 'flash_invaliddetails' ) ) );
					redirect(admin_url());
				}
			}
			else
			{
				$this->session->set_flashdata ( 'admin_success', sprintf ( $this->lang->line ( 'flash_invaliddetails' ) ) );
				redirect(admin_url());
			}
		}
		else
			redirect(admin_url());
		
	}
	
	
	public function changepassword()
	{
		$ninja_admin = $this->session->userdata ( "nc_admin_id" );
		($ninja_admin == "") ? redirect ( admin_url () ) : '';
		$data=array();
		$data = array ();
		$data ['module_label'] = $this->module_label;
		$data ['module_labels'] = $this->module_labels;
		$data ['module'] = 'ncadminpanel/changepassword';
		$data ['module_action'] =  'changepassword';
		if ($this->input->post ( 'action' ) == 'changepassword') 	
		{
			$alert = "";
			$this->form_validation->set_rules ( 'client_old_password', 'lang:client_old_password', 'required|min_length[' . get_label ( 'client_password_minlength' ) . ']' );
			$this->form_validation->set_rules ( 'client_password', 'lang:client_password', 'required|min_length[' . get_label ( 'client_password_minlength' ) . ']' );
			$this->form_validation->set_rules ( 'client_cpassword', 'lang:client_cpassword', 'required|matches[client_password]|min_length[' . get_label ( 'client_password_minlength' ) . ']' );
			if ($this->form_validation->run ( $this ) == TRUE) {
				
				$check_details = $this->Mydb->get_record ('admin_id,admin_username,admin_email_address,admin_status,admin_password', $this->table, array ('admin_id'=>$ninja_admin,'admin_status'=>'A') );
				if ($check_details)
				{
					$oldpassword=post_value('client_old_password');
					$password_verify = check_hash($oldpassword,$check_details['admin_password']);
					if($password_verify == "Yes")
					{
						$password = do_bcrypt($this->input->post('client_cpassword')); 
						$res=$this->Mydb->update ( $this->table, array ($this->primary_key => $ninja_admin ), array('admin_password'=>$password,'admin_pass_key'=>''));
						$this->session->set_flashdata ( 'admin_success', $this->lang->line ( 'changed_password' ) );
						echo json_encode ( array('status'=>'success') ); exit;
					}
					else
					{
						$alert="invalid_old_password";
					}
				}
				else
				{
					$alert = 'acount_not_found';
				}
				$response ['status'] = 'error';
				$response ['message'] = get_label ( $alert );

			}
			else {
				$response ['status'] = 'error';
				$response ['message'] = validation_errors ();
			}
			echo json_encode ( $response ); exit;
		}
		$this->layout->display_admin ( $this->folder . "/changepassword", $data );
	}
	
	/* this function used to destroy all admin session values */
	public function admin_logout() {
		
		$this->session->sess_destroy();
		
		redirect(admin_url());
	
	}
}
