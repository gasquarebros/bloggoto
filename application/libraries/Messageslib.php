<?php
/**************************
 Project Name	: Pos
Created on		: 22 Feb, 2016
Last Modified 	: 22 Feb, 2016
Description		: Messages related libraries
***************************/
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Messageslib {
	protected $ci;
	public function __construct() {
		$this->ci = & get_instance ();
	}
	
	function current_users_details()
	{
		$user = $this->session->all_userdata();
		return $user;
	}
}
