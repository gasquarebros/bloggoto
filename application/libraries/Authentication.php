<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Authentication {
	protected $ci;
	public function __construct() {
		$this->ci = & get_instance ();
	}
	
	/* Master adminpanel authenticaion */
	function admin_authentication() {
		$ninja_admin = $this->ci->session->userdata ( "nc_admin_id" );
		($ninja_admin == "") ? redirect ( admin_url () ) : '';
	}
	
	/* Master adminpanel authenticaion */
	function user_authentication() {

		$bg_users = $this->ci->session->userdata ( "bg_user_id" );
		if($bg_users != '')
		{
			return '';
		}
		else if($this->ci->input->cookie('login_remeber_me') !='') {
			$check_details = $this->ci->Mydb->get_record ('customer_id,customer_first_name,customer_last_name,customer_email,customer_password,customer_status,customer_type,customer_photo,customer_username,company_name', 'customers', array ('customer_id' => $this->ci->input->cookie('login_remeber_me'),'customer_status !='=>'D') );
		
			if(!empty($check_details))
			{
				if ($check_details['customer_status'] == 'A'){
					/* storing the values in session */				
					$session_datas = array('bg_user_id' => $check_details['customer_id'],'bg_first_name' => $check_details['customer_first_name'],'bg_last_name' => $check_details['customer_last_name'],'bg_user_group' => ($check_details['customer_type'] == 0)?'writer':'brand','bg_user_type'=>$check_details['customer_type'],'company_name'=>$check_details['company_name'],'customer_username'=>$check_details['customer_username'],'bg_user_profile_picture'=>($check_details['customer_photo'])?media_url().$this->ci->lang->line('customer_image_folder_name')."/".$check_details['customer_photo']:'' );
					if($check_details['customer_photo'] && file_exists(media_url().$this->ci->lang->line('customer_image_folder_name')."/".$check_details['customer_photo'])) {
						$session_datas['bg_user_profile_picture'] = media_url().$this->ci->lang->line('customer_image_folder_name')."/".$check_details['customer_photo'];
					}
					else
					{
						$session_datas['bg_user_profile_picture'] = '';
					}
					$cookie = array(
						'name'   => 'login_remeber_me',
						'value'  => $session_datas['bg_user_id'],
						'expire' => (300*60*60*24)
					);
					$this->ci->input->set_cookie($cookie); 
					
					$this->ci->session->set_userdata($session_datas);
				}
				else
				{
					redirect ( base_url () );
				}
			}
			else
			{
				redirect ( base_url () );
			}
		}
		else
		{
			redirect ( base_url () );
		}
	
		
		//($bg_users == "") ? redirect ( base_url () ) : '';
	}
	
	function already_login_check()
	{
		$bg_users = $this->ci->session->userdata ( "bg_user_id" );
		if($bg_users != '')
		{
			return '';
		}
		else if($this->ci->input->cookie('login_remeber_me') !='') {
			$check_details = $this->ci->Mydb->get_record ('customer_id,customer_first_name,customer_last_name,customer_email,customer_password,customer_status,customer_type,customer_photo,customer_username,company_name', 'customers', array ('customer_id' => $this->ci->input->cookie('login_remeber_me'),'customer_status !='=>'D') );
		//echo "<pre>"; print_r($check_details); exit;
			if(!empty($check_details))
			{
				if ($check_details['customer_status'] == 'A'){
					/* storing the values in session */				
					$session_datas = array('bg_user_id' => $check_details['customer_id'],'bg_first_name' => $check_details['customer_first_name'],'bg_last_name' => $check_details['customer_last_name'],'bg_user_group' => ($check_details['customer_type'] == 0)?'writer':'brand','bg_user_type'=>$check_details['customer_type'],'company_name'=>$check_details['company_name'],'customer_username'=>$check_details['customer_username'],'bg_user_profile_picture'=>($check_details['customer_photo'])?media_url().$this->ci->lang->line('customer_image_folder_name')."/".$check_details['customer_photo']:'' );
					
					if($check_details['customer_photo'] && file_exists(FCPATH."media/".$this->lang->line('customer_image_folder_name')."/".$check_details['customer_photo'])) {
						$session_datas['bg_user_profile_picture'] = media_url().$this->ci->lang->line('customer_image_folder_name')."/".$check_details['customer_photo'];
					}
					else
					{
						$session_datas['bg_user_profile_picture'] = '';
					}
					$cookie = array(
						'name'   => 'login_remeber_me',
						'value'  => $session_datas['bg_user_id'],
						'expire' => (300*60*60*24)
					);
					$this->ci->input->set_cookie($cookie); 
					
					$cookie = array(
						'name'   => 'login_user_name',
						'value'  => $session_datas['customer_username'],
						'expire' => (300*60*60*24)
					);
					$this->ci->input->set_cookie($cookie);
					
					$this->ci->session->set_userdata($session_datas);
				}
				else
				{
					return '';
				}
			}
			else
			{
				return '';
			}
		}
		else
		{
			return '';
		}
		return '';
	}

	
	/* client adminpanel authenticaion */
	function company_authentication($module_slug = null) {
		/* check module permission */
		$modules = array ();
		$module_slug = strtolower($module_slug);
		$modules = $this->ci->session->userdata ( 'camp_module_permission' );  
		if (isset($modules) && ! in_array ( $module_slug, $modules ) &&  $this->ci->session->userdata('camp_admin_type') == "SubAdmin") {
			echo get_label ( 'access_denied' );
			exit ();
		}
		
		$ninja_admin = $this->ci->session->userdata ( "camp_company_admin_id" );
		($ninja_admin == "") ? redirect ( camp_url () ) : '';
	}
	
}
 
/* End of file authentication.php */
/* Location: ./application/libraries/authentication.php */
