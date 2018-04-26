<?php 
/**************************
 Project Name	: POS
Created on		: 19 Feb, 2016
Last Modified 	: 24  Feb, 2016
Description		:  this file contains adminpanel helper function.
***************************/
/* get admin session  label */
if (! function_exists ( 'get_admin_id' )) {
	function get_admin_id() {
		$CI = & get_instance ();
		return  $CI->session->userdata('nc_admin_id');
	}
}

/* this method used to get admin records per page value */
if (! function_exists ( 'admin_records_perpage' )) {
	function admin_records_perpage() {
		$CI = & get_instance ();
		return 5;
	}
}

/* this function used to show output status */
if (!function_exists('show_status')) {
	function show_status($sts=null,$id) {

		return ($sts == "A" ? '<i class="fa fa-unlock status" title=" '.get_label('active').'" id='.encode_value($id).' data="Deactivate"></i>' : ($sts == "I" ? '<i class="fa fa-lock status" title="'.get_label('inactive').'"  id='.encode_value($id).' data="Activate"></i>' : '' )  );
	}
}

/* this method used to create client logo check user folder nameexists**/
if (!function_exists('create_folder')) {
	function create_folder($folder_name) {

		$src = FCPATH.'media/default/*';
		$dst = FCPATH.'media/'.$folder_name.'/';
		$command = exec( "cp -r $src $dst" );
			
	}
}

/* Get client category list    */
if(!function_exists('get_language_name'))
{
	function get_language_name($language_id='')
	{
		$CI=& get_instance();
		$lang = $CI->Mydb->get_record('language_name','languages',array('language_code' => $language_id ));

		return (isset($lang['language_name'])) ? ucwords(stripslashes($lang['language_name'])) : "N/A";
	}
}


if (! function_exists ( 'get_company_folder' )) {
	function get_company_folder() {
		$CI = & get_instance ();
		//return (ENVIRONMENT == "development" )?  'dev_team' :   $CI->session->userdata('camp_company_folder');
		return "";

	}
}

if (! function_exists ( 'get_all_users_list' )) {
	function get_all_users_list() {
		$CI = & get_instance ();
		$records = $CI->Mydb->get_all_records('customer_id,customer_first_name,customer_last_name','customers',array('customer_type'=>1));
		$all_users = array(''=>'Select Customer');
		if(!empty($records))
		{
			foreach($records as $record)
			{
				$all_users[$record['customer_id']] = $record['customer_first_name']." ".$record['customer_last_name'];
			}
		}
		return $all_users;

	}
}