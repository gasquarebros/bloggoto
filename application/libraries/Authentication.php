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
		($bg_users == "") ? redirect ( base_url () ) : '';
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
