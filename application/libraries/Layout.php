<?php

/**************************
 Project Name	: Pos
Created on		: 22  Feb, 2016
Last Modified 	: 17  march, 2016
Description		: load all layout
***************************/
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Layout {
	protected $ci;
	public function __construct() {
		$this->ci = & get_instance ();
	}
	
	/* display for Master adminpanel */
	function display_admin($file_path, $data = null) {
		$admin_path = "ncadminpanel/";
		$data ['admin_body'] = $this->ci->load->view ( $file_path, $data, true );
		$this->ci->load->view ( $admin_path . 'layout/layout', $data );
	}
	
	/* display for Master adminpanel */
	function display_company_admin($file_path, $data = null) {
		$admin_path = "camppanel/";
		$data ['admin_body'] = $this->ci->load->view ( $file_path, $data, true );
		$this->ci->load->view ( $admin_path . 'layout/layout', $data );
	}
	
	/* display for Site layout */
	function display_site($file_path, $data = null) {
		$data ['admin_body'] = $this->ci->load->view ( $file_path, $data, true );
		$this->ci->load->view ('layout/layout', $data );
	}
}

/* End of file layout.php */
/* Location: ./system/application/libraries/layout.php */
