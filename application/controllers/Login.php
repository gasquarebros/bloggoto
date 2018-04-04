<?php
/**************************
Project Name	: AVVANZ
Created on		: 31 Aug, 2016
Last Modified 	: 31 Aug, 2016
Description		: Page contains frontend panel login and forgot password functions.

***************************/
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Login extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		$this->module = "login";
		$this->module_label = "Login";
		$this->module_labels = "Login";
		$this->folder = "login/";
		$this->table = "customers";
		$this->customer_login_history = "customer_login_history";
		$this->primary_key='customer_id';
		

	}
	
	/* this method used to common module labels */
	private function load_module_info() {
		$data = array ();
		$data ['module_label'] = $this->module_label;
		$data ['module_labels'] = $this->module_labels;
		$data ['module'] = $this->module;
		return $data;
	}
	
	/* this method used to check login */
	public function index() {
		$data = $this->load_module_info ();	
		if(get_user_id() !=""){
			redirect(base_url()."home");
		}
		if ($this->input->post ( 'submit' ) == 'Login') 		
		{
			check_site_ajax_request (); /* skip direct access */
			$response = array ();
			$alert = "";
			$this->form_validation->set_rules ( 'username', 'Username', 'required|trim' );
			$this->form_validation->set_rules ( 'password', 'Password', 'required|min_length[' . PASSWORD_LENGTH . ']|trim' );
			if ($this->form_validation->run ( $this ) == TRUE) {
				
				$this->mysqli = new mysqli ( $this->db->hostname, $this->db->username, $this->db->password, $this->db->database );
				$password = $this->mysqli->real_escape_string ( trim ( $this->input->post ( 'password' ) ) );
				$username = $this->mysqli->real_escape_string ( trim ( $this->input->post ( 'username' ) ) );

				$check_details = $this->Mydb->get_record ('customer_id,customer_first_name,customer_last_name,customer_email,customer_password,customer_status,customer_type,customer_photo', $this->table, array ('customer_email' => $username,'customer_status !='=>'D') );
				
				if ($check_details)
				{
					if ($check_details['customer_status'] == 'A'){
							
						$password_verify = check_hash($password,$check_details['customer_password']);
							
						if($password_verify == "Yes")
						{
							$session_datas = array();
							$redirect= "";
							/* storing the values in session */
							
							$session_datas = array('bg_user_id' => $check_details['customer_id'],'bg_first_name' => $check_details['customer_first_name'],'bg_last_name' => $check_details['customer_last_name'],'bg_user_group' => ($check_details['customer_type'] == 0)?'writer':'brand','bg_user_type'=>$check_details['customer_type'],'bg_user_profile_picture'=>media_url().$this->lang->line('customer_image_folder_name')."/".$check_details['customer_photo'] );
							
							if(!empty($session_datas))
							{
								$this->session->set_userdata($session_datas);
								/* store last login details...*/
								$this->Mydb->insert($this->customer_login_history,array('login_time'=>current_date(),'login_ip'=>get_ip(),'login_customer_id'=>$check_details['customer_id']));
								
								echo json_encode ( array('status'=>'success','redirect_url'=>$redirect) ); exit;
							}
							else
							{
								$alert = 'account_disabled';
							}
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
		
		
		if ($this->input->post ( 'submit' ) == 'Submit') 		// if ajax submit
		{
			
			$response = array ();
			$alert = "";
			$this->form_validation->set_rules ( 'email_address', 'Email Address', 'required|trim|valid_email' );
			if ($this->form_validation->run ( $this ) == TRUE) {
				
				$check_details = $this->Mydb->get_record ('customer_id,customer_first_name,customer_last_name,customer_email,customer_password,customer_status,customer_type', $this->table, array ('customer_email' => post_value('email_address'),'customer_status !='=>'D') );
				if ($check_details)
				{
					
					if ($check_details['customer_status'] == 'A'){
						
						
						
						$password_key=get_random_key('30',$this->table,'customer_password_key');
						if($password_key)
						{
							$res=$this->Mydb->update ( $this->table, array ('customer_id' => $check_details['customer_id'] ), array('customer_password_key'=>$password_key) );
							if($res)
							{
								$reset_link=base_url()."reset_password/".encode_value($check_details['customer_id'])."-".$password_key;
								$site_url =  base_url();
								$this->load->library('myemail');
								$check_arr = array('[NAME]','[RESETLINK]','[SITEURL]');
								$replace_arr = array($check_details['customer_first_name']." ".$check_details['customer_last_name'],$reset_link,$site_url);
								$this->myemail->send_admin_mail($check_details['customer_email'],get_label('customer_forgot_password_template'),$check_arr,$replace_arr);
							}
							$this->session->set_flashdata ( 'success', sprintf ( $this->lang->line ( 'reset_password_link' ) ) );
							echo json_encode ( array('status'=>'success') ); exit;
				
						} else{
							$alert = 'forgot_error';
						}
						
						
						if($check_details['type'] == 'company')
						{
							$password_key=get_random_key('30',$this->company_table,'company_password_key');
							if($password_key)
							{
								$res=$this->Mydb->update ( $this->company_table, array ('company_id' => $check_details['record_id'] ), array('company_password_key'=>$password_key) );
								if($res)
								{
									$reset_link=base_url()."reset_password/".encode_value($check_details['record_id'])."-".$password_key;
									$site_url =  base_url();
									$this->load->library('myemail');
									$check_arr = array('[NAME]','[RESETLINK]','[SITEURL]');
									$replace_arr = array($check_details['username'],$reset_link,$site_url);
									$this->myemail->send_admin_mail($check_details['email_address'],get_label('company_forgot_password_template'),$check_arr,$replace_arr);
								}
								$this->session->set_flashdata ( 'success', sprintf ( $this->lang->line ( 'reset_password_link' ) ) );
								echo json_encode ( array('status'=>'success') ); exit;
					
							} else{
								$alert = 'forgot_error';
							}
						}
						else
						{
							
							$join='';
							$join [0] ['select'] = "company_name,company_date_format,company_time_format,company_logo,company_folder_name,company_currency,company_payment_online_enable,company_status";
							$join [0] ['table'] = "avvanz_company";
							$join [0] ['condition'] = "user_company_id = company_id";
							$join [0] ['type'] = "INNER";
							
							$company = $this->Mydb->get_all_records('user_profile_picture,user_folder_name,user_type,user_company_id,user_parent',$this->company_user_table,array('user_id'=>$check_details['record_id']),'','','','','',$join);
							if(!empty($company) && $company[0]['company_status'] == 'A')
							{
								$password_key=get_random_key('30',$this->company_user_table,'user_password_key');
								if($password_key)
								{
									$res=$this->Mydb->update ( $this->company_user_table, array ('user_id' => $check_details['record_id'] ), array('user_password_key'=>$password_key) );
									if($res)
									{
										$reset_link=base_url()."reset_password_user/".encode_value($check_details['record_id'])."-".$password_key;
										$site_url =  base_url();
										$this->load->library('myemail');
										$check_arr = array('[NAME]','[RESETLINK]','[SITEURL]');
										$replace_arr = array($check_details['username'],$reset_link,$site_url);
										$this->myemail->send_admin_mail($check_details['email_address'],get_label('company_forgot_password_template'),$check_arr,$replace_arr);
									}
									$this->session->set_flashdata ( 'success', sprintf ( $this->lang->line ( 'reset_password_link' ) ) );
									echo json_encode ( array('status'=>'success') ); exit;
						
								} else{
									$alert = 'forgot_error';
								}
							}
							else
							{
								$alert = 'account_disabled';
							}
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
		//$data['settings'] = $this->Mydb->get_record('*','site_settings');
		$data['meta_title'] = "Login Your Account | BlogGotoweb ";
		$data['meta_keyword'] = "login your account, blogging";
		$data['meta_description'] = "Blogging.";
		$this->load->view ( $this->folder . '/login',$data );
	}
	
	public function reset_password()
	{
		if ($this->input->post ( 'submit' ) == 'Reset') 	
		{
			$alert = "";
			$this->form_validation->set_rules ( 'client_password', 'lang:client_password', 'required|min_length[' . get_label ( 'client_password_minlength' ) . ']' );
			$this->form_validation->set_rules ( 'client_cpassword', 'lang:client_cpassword', 'required|matches[client_password]|min_length[' . get_label ( 'client_password_minlength' ) . ']' );
			if ($this->form_validation->run ( $this ) == TRUE) {
				$check_details = $this->Mydb->get_record ('customer_id', $this->table, array ('customer_id'=>post_value('user_id'),'customer_status'=>'A') );
				if ($check_details)
				{
					$password = do_bcrypt($this->input->post('client_cpassword'));  
					$userid=post_value('user_id');
					$res=$this->Mydb->update ( $this->table, array ('customer_id' => $userid ), array('customer_password'=>$password,'customer_password_key'=>''));
					$this->session->set_flashdata ( 'success', sprintf ( $this->lang->line ( 'password_changed' ) ) );
					redirect(base_url());
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
		
		$password_key=($this->uri->segment(2))?$this->uri->segment(2):'';
		if($password_key !='')
		{
			$pass_key=explode('-',$password_key);
			if(count($pass_key) > 1)
			{
				$user_id=decode_value($pass_key[0]);
				$passwordkey=$pass_key[1];
				$check_details = $this->Mydb->get_record ('customer_id', $this->table, array ('customer_id' => $user_id,'customer_password_key'=>$passwordkey,'customer_status'=>'A') );
				if ($check_details)
				{
					$data['user']=$check_details;
					$this->load->view ( $this->folder . '/resetpassword',$data );
				}
				else
				{
					$this->session->set_flashdata ( 'success', sprintf ( $this->lang->line ( 'flash_invaliddetails' ) ) );
					redirect(base_url());
				}
			}
			else
			{
				$this->session->set_flashdata ( 'success', sprintf ( $this->lang->line ( 'flash_invaliddetails' ) ) );
				redirect(base_url());
			}
		}
		else
		{
			redirect(base_url());
		}
		
	}
	
	public function activation()
	{
		$activation_key=($this->uri->segment(2))?$this->uri->segment(2):'';
		if($activation_key !='')
		{
			$get_customer_data = $this->Mydb->get_record(array('customer_id','customer_status'),$this->table,array('customer_activation_key'=>$activation_key));
			/*check valid key*/
			if(!empty($get_customer_data))
			{
				/*activate the user*/
				$this->Mydb->update($this->table,array('customer_id'=>$get_customer_data['customer_id']),array('customer_status'=>'A','customer_activation_key'=>''));
				$this->session->set_flashdata ( 'success', 'Account Activated Successfully' );
				redirect(base_url());
			}
			else
			{
				/*invalid key message*/
				$this->session->set_flashdata ( 'error', 'Invalid Activation Link' );
				redirect(base_url());
			}
		}
		else
		{
			$this->session->set_flashdata ( 'error', 'Invalid Activation Link' );
			redirect(base_url());
		}
	}

	public function changepassword()
	{
		$blog_user = $this->session->userdata ( "bg_user_id" );
		($blog_user == "") ? redirect ( base_url () ) : '';
		$data=array();
		$data = array ();
		$data ['module_label'] = $this->module_label;
		$data ['module_labels'] = $this->module_labels;
		$data ['module'] = 'login';
		$data ['module_action'] =  'changepassword';
		if ($this->input->post ( 'action' ) == 'changepassword') 	
		{
			$alert = "";
			$this->form_validation->set_rules ( 'client_old_password', 'lang:client_old_password', 'required|min_length[' . get_label ( 'client_password_minlength' ) . ']' );
			$this->form_validation->set_rules ( 'client_password', 'lang:client_password', 'required|min_length[' . get_label ( 'client_password_minlength' ) . ']' );
			$this->form_validation->set_rules ( 'client_cpassword', 'lang:client_cpassword', 'required|matches[client_password]|min_length[' . get_label ( 'client_password_minlength' ) . ']' );
			if ($this->form_validation->run ( $this ) == TRUE) {
				
				$check_details = $this->Mydb->get_record('customer_id,customer_password',$this->table,array('customer_id'=>$blog_user,'customer_status'=>'A'));

				if ($check_details)
				{
					$oldpassword=post_value('client_old_password');
					$password_verify = check_hash($oldpassword,$check_details['customer_password']);
					if($password_verify == "Yes")
					{
						$password = do_bcrypt($this->input->post('client_cpassword')); 
						$res=$this->Mydb->update ( $this->table, array ('customer_id' => $blog_user ), array('customer_password'=>$password,'customer_password_key'=>''));
						$this->session->set_flashdata ( 'success', $this->lang->line ( 'changed_password' ) );
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
		$this->layout->display_site ( $this->folder . "/changepassword", $data );
	}

	
	/* this function used to destroy all admin session values */
	public function logout() {
		
		$this->session->sess_destroy();
		
		redirect(base_url());
	
	}
	
	/* this function used to destroy all admin session values */
	public function keep_alive() {
		check_ajax_request (); /* skip direct access */
		$user_id = get_user_id ();
		$redirect_url = base_url();
		if (isset ( $user_id ) && ! empty ( $user_id )) {
				
			$response = array (
					'status' => 'ok'
			);
		} else {
			//$response = array ('status' => 'error','redirect_url'=>$redirect_url);
		}
		
		echo json_encode ( $response );
		exit ();
	}
	
	public function launch()
	{
		if(isset($_POST) && $_POST['submit'] == 'Launch')
		{
			if($_POST['lanch_password'] == 'admin_launch_kannan')
			{
				rename(FCPATH."/index.html", FCPATH."/index.htmls");
				redirect(base_url());
			}
		}
	}
	
	public function checkmail()
	{
		$this->load->library('myemail');
		$check_arr = $replace_arr = array();
		
		
		$to = 'gasquarebros@gmail.com';
		$subject = "Test Mail";
		$message = "Test message";
		// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <webmaster@example.com>' . "\r\n";
$headers .= 'Cc: myboss@example.com' . "\r\n";

$mail_res = mail($to,$subject,$message,$headers);

print_r($mail_res);
exit;

		
		echo $status = $this->myemail->send_admin_mail('gasquarebros@gmail.com',get_label('customer_registration_template'),$check_arr,$replace_arr);
	}
	
}
