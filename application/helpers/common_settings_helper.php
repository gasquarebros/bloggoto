<?php 
/**************************
 Project Name	: POS
Created on		: 18 Feb, 2016
Last Modified 	: 18 Feb, 2016
Description		:  this file contains common setting for admin and client panel..
***************************/

/* get Language label */
if (! function_exists ( 'get_reward_amount' )) {
	function get_reward_amount($label = null) {
		return '1';
	}
}

/* get Language label */
if (! function_exists ( 'get_label' )) {
	function get_label($label = null) {
		$CI = & get_instance ();
		return ucfirst ( $CI->lang->line ( $label ) );
	}
}

/* get current date */
if (! function_exists ( 'current_date' )) {
	function current_date() {
		return date ( "Y-m-d H:i:s" );
	}
}

/* get ip address */
if (! function_exists ( 'get_ip' )) {
	function get_ip() {
		return $_SERVER ['REMOTE_ADDR'];
	}
}

/* Put Start symbol */
if (! function_exists ( 'get_required' )) {
	function get_required() {
		return '<span class="required_star">*</span>';
	}
}

/* get error tag */
if(!function_exists('get_error_tag'))
{
	function get_error_tag($label=null,$alert_class)
	{
		return '<div class="alert fresh-color '.$alert_class.'" role="alert">'.$label.'</div>';
	}
}
/*On or Off form autocomplet value*/
if (! function_exists ( 'form_autocomplte' )) {
	function form_autocomplte() {
		/* If development mode is enabled */
		return 'on';
	}
}


/* form size  */
if (! function_exists ( 'get_form_size' )) {
	function get_form_size() {
		return 4;
	}
}

if (! function_exists ( 'get_form_editor_size' )) {
	function get_form_editor_size() {
		return 9;
	}
}


/* get date format unique format */
if (! function_exists ( "get_date_formart" )) {
	function get_date_formart($date, $format = "") {
		$CI = & get_instance ();
	//	$date_format=$CI->session->userdata('camp_admin_timeformat');
		$format = ($format != "") ? $format : 'd-m-Y';
		if ($date == "0000:00:00 00:00:00" || $date == "0000:00:00" || $date == NULL) {
			return "N/A";
		} else {
			return date ( $format, strtotime ( $date ) );
		}
	}
}
if (! function_exists ( "get_time_formart" )) {
	function get_time_formart($format = "",$time=null) {
		$format = ($format != "") ? $format : "H:i:s";
		if( empty($time)){
			return "";
		}else{
		return date ( $format, strtotime ( $time ) );
	    }
		
	}
}

/* Function used to encode value */
if (! function_exists ( 'encode_value' )) {
	function encode_value($value = '') {
		if ($value != '') {
			return str_replace ( '=', '', base64_encode ( $value ) );
		}
	}
}
/* Function used to decode for encoded value */
if (! function_exists ( 'decode_value' )) {
	function decode_value($value = '') {
		if ($value != '') {
			return base64_decode ( $value );
		}
	}
}

/* Get user key */
if(!function_exists('get_random_key'))
{
	function get_random_key( $length = 20, $table=null, $field_name=null, $value=null, $type='alnum')
	{
		$CI =& get_instance();
		$CI->load->helper('string');

		$randomkey = ($value !="" ? $value : random_string($type,$length));
		$result  = $CI->Mydb->get_record(array($field_name),$table,array($field_name =>trim($randomkey)));
		
		if (!empty($result)) {
		   //	$randomkey = random_string($type,$length);
			return get_random_key( $length, $table, $field_name , "" , $type );
		} else {
			return $randomkey;
		}

	}
}
/*  Ser Default currency value  */
if(!function_exists('get_currency_symbol'))
{
	function get_currency_symbol($val=null)
	{
		return '₹'.$val;
	}
}

/*  Show price */
if(!function_exists('show_price'))
{
	function show_price($price)
	{
		return '₹'.number_format($price,2);
	}
}

/* Check  GUID exists  */
if(!function_exists('get_guid'))
{
	function get_guid( $table=null, $field_name=null,$where = array() )
	{
		$CI =& get_instance();
		$guid = GUID ();
		if(!empty($where))
		{
			$where_arary = array_merge(array($field_name =>trim($guid)),$where);
		}
		else
		{
			$where_arary = array($field_name =>trim($guid));
		}
		
		$result  = $CI->Mydb->get_record(array($field_name),$table,$where_arary);

		if (!empty($result)) {
			return get_guid(  $table, $field_name );
		} else {
			return $guid;
		}

	}
}

/* chek ajax request .. skip to direct access... */
if (! function_exists ( 'check_ajax_request' )) {
	function check_ajax_request() {
		$CI = & get_instance ();
		if ((! $CI->input->is_ajax_request ())) {	
			redirect ( admin_url () );
			return false;
		}
	}
}
/* chek ajax request .. skip to direct access... */
if (! function_exists ( 'check_site_ajax_request' )) {
	function check_site_ajax_request() {
		$CI = & get_instance ();
		if ((! $CI->input->is_ajax_request ())) {	
			redirect ( base_url () );
			return false;
		}
	}
}

/* cretae bcrypt password... */
if (! function_exists ( 'do_bcrypt' )) {
	function do_bcrypt($password = null) {
		$CI = &get_instance ();
		$CI->load->library ( 'bcrypt' );
		return $CI->bcrypt->hash_password ( $password );
	}
}

/* Compare bcrypt password... */
if (! function_exists ( 'check_hash' )) {
	function check_hash($password = null, $stored_hash=null) {
		$CI = &get_instance ();
		$CI->load->library ( 'bcrypt' );
		if ($CI->bcrypt->check_password ( $password, $stored_hash )) {
			return 'Yes';
			// Password does match stored password.
		} else {
			return 'No';
			// Password does not match stored password.
		}
	}
}

/*  function used to get session values */
if (! function_exists ( 'get_session_value' )) {
	function get_session_value($sess_name) {
		$CI = & get_instance ();
		return  $CI->session->userdata($sess_name);
	}
}

/*  this function used to removed  unwanted chars  */
if ( ! function_exists('post_value'))
{
	function post_value($post_data=null,$xss_flag=null)
	{    $CI =& get_instance();

		if ($CI->input->post($post_data)) {

			if($xss_flag == 'false') {

				$data = addslashes(trim($CI->input->post($post_data,false)));

			} else {
				if(!is_array($post_data))
				{
					$data = addslashes(trim($CI->input->post($post_data)));
				}
				else {
					$data = $CI->input->post($post_data);
				}
			}
		} else {

			$data = addslashes(trim($CI->input->get($post_data)));

		}

		return $data;
	
	}
}

/* this function used to generate generate GUID */
function GUID()
{
	if (function_exists('com_create_guid') === true)
	{
		return trim(com_create_guid(), '{}');
	}

	return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}

/* this function used provide clean putput value...*/
if (! function_exists ( 'output_value' )) {
	function output_value($value = null) {
		return ($value == '') ? "N/A" : ucfirst(stripslashes ( $value ));
	}
}





/* this method used to set Session URL */
if (! function_exists ( 'set_sessionurl' )) {
	function set_sessionurl($data) {
		$CI = & get_instance ();
		$protocol = 'http';
		$re = $protocol . '://' . $_SERVER ['HTTP_HOST'] . $_SERVER ['REQUEST_URI'];
		$CI->session->set_userdata ( $data, $re );
	}
}

/*  $this method used to load pagination config..  */
if ( ! function_exists('pagination_config'))
{
	function pagination_config($uri_string,$total_rows,$limit,$uri_segment,$num_links=2)
	{
		$CI = & get_instance ();
		$CI->load->library('pagination');
		$config = array();
		$config['full_tag_open'] = '<nav><ul class="pagination pagination-sm">';
		$config['full_tag_close'] = '</ul></nav>';
		$config['first_tag_open'] = $config['last_tag_open']   = $config['next_tag_open']  = $config['prev_tag_open'] = 	$config['num_tag_open'] =  '<li>';
		$config['first_tag_close'] = $config['last_tag_close'] = $config['next_tag_close']  = $config['prev_tag_close'] =   $config['num_tag_close'] =  '</li>';
		$config['next_link'] = '&gt;';
		$config['prev_link'] = '&lt;';
		$config['cur_tag_open']  = '<li class="active"> <a>';
		$config['cur_tag_close'] = "</li> </a>";
		$config['num_links'] = $num_links; 
		$config['base_url'] = $uri_string;
		$config['uri_segment'] = $uri_segment;
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $limit;
		return $config;
	}
}

/* this method used to show records count */
if ( ! function_exists('show_record_info'))
{
	function show_record_info($total_rows,$start,$end)
	{
		if(($start+$end) > $total_rows) {
			$end = $total_rows;
		} else {
			$end = $start+$end;
		}

		 return ((int)$total_rows== 0 ? " ": 'Showing <b>'.($start+1).'</b> to<b> '.$end.'</b> of <b> '.$total_rows.' </b>entries');
	}
}	

/* this method used to get loading image */
if(!function_exists('loading_image'))
{
	function loading_image($class=null)
	{
		return  '<img src="'.load_lib("theme/images/loading_icon_default.gif").'" alt="loading.."  class="'.$class.'"/>';
	}
}

/* this method used to get loading image */
if(!function_exists('show_image'))
{
	function show_image($foldername=null,$imagename=null,$additional=null)
	{
		$filepath=$foldername;
		if($filepath !='')
		{
			$filepath.="/";
		}
		$filepath.=$imagename;
		if($filepath !='')
		{
			return '<img src="'.media_url().get_company_folder().'/'.$filepath.'" '.$additional.'>';
		}
		else
		{
			return "N/A";
		}
	}
}


/* Get Admin Status dropdown */
if (! function_exists ( 'get_status_dropdown' )) {
	function get_status_dropdown($selected = null, $addStatus=array(),$extra=null) 
	{

		$status	=	array (
				' ' => get_label('select_status'),
				'A' => 'Active',
				'I' => 'Inactive',
		);
		if(!empty($addStatus)){
			$status	=	$status + $addStatus;
		}
		
		$extra = ($extra == "")?  'class="" id="status"' : $extra;
		return form_dropdown ( 'status', $status, $selected, $extra );
	}
}
if (! function_exists ( 'get_unsubcriber_dropdown' )) {
	function get_unsubcriber_dropdown($selected = null, $addStatus=array(),$extra=null) 
	{

		$status	=	array (
				' ' => get_label('select_status'),
				'A' => 'Subscribed',
				'I' => 'Unsubscribed',
		);
		if(!empty($addStatus))
		{
			$status	=	$status + $addStatus;
		}		
		$extra = ($extra == "")?  'class="" id="status"' : $extra;
		return form_dropdown ( 'unsubcriber_status', $status, $selected, $extra );
	}
}
if (! function_exists ( 'get_unsubcriber_dropdown1' )) {
	function get_unsubcriber_dropdown1($selected = null, $addStatus=array(),$extra=null) 
	{

		$status	=	array (
				' ' => get_label('select_status'),
				'I' => 'Unsubscribed',
				'A' => 'Subscribed',
				
		);
		if(!empty($addStatus)){
			$status	=	$status + $addStatus;
		}
		
		$extra = ($extra == "")?  'class="" id="status"' : $extra;
		return form_dropdown ( 'unsubcriber_status', $status, $selected, $extra );
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

/* Make SEO friendly url */
if (! function_exists ( 'make_slug' )) {
	function make_slug($title, $table_name, $field_name, $chk_where = null) {
		$CI = & get_instance ();
		$page_uri = '';
		$code_entities_match = array (
				' ',
				'&quot;',
				'!',
				'@',
				'#',
				'$',
				'%',
				'^',
				'&',
				'*',
				'(',
				')',
				'+',
				'{',
				'}',
				'|',
				':',
				'"',
				'<',
				'>',
				'?',
				'[',
				']',
				'',
				';',
				"'",
				',',
				'.',
				'_',
				'/',
				'~',
				'`',
				'=',
				'---',
				'--',
				'–'
		);

		$code_entities_replace = array (
				'-',
				'-',
				'-',
				'-',
				'-',
				'-',
				'-',
				'-',
				'-',
				'-',
				'-',
				'-',
				'-',
				'-',
				'-',
				'-',
				'-',
				'-',
				'-',
				'-',
				'-',
				'-',
				'-',
				'-',
				'-',
				'-',
				'-',
				'-',
				'-',
				'-',
				'-',
				'-',
				'-',
				'-',
				'-',
				'-'
		);

		$text = str_replace ( $code_entities_match, $code_entities_replace, $title );
		$t = htmlentities ( $text, ENT_QUOTES, 'UTF-8' );
		$page_urii = trim ( strtolower ( $t ), "-" );
		$page_uri_where = array (
				$field_name => $page_urii
		);

		$where = (! empty ( $chk_where )) ? array_merge ( $page_uri_where, $chk_where ) : $page_uri_where;

		$result = $CI->Mydb->get_record ( array (
				$field_name
		), $table_name, $where );
		$CI->load->helper('string');
		//$page_uri = (!empty($result) ) ? $result [$field_name] . "-" . random_string ( 'alnum', 50 ) : $page_urii;
        //echo $CI->db->last_query();
		//echo '<br>';
		//print_r($result);
		//exit;
		//return strtolower ( $page_uri );
		if (!empty($result)) {
			 $re_page = $result [$field_name] . "-" . random_string ( 'alnum', 25 );
			return make_slug($re_page, $table_name, $field_name, $chk_where  );
		} else {
			return $page_urii;
		}
	}
}

/* this method used to  get sequence order */
if(!function_exists('get_sequence'))
{
	function get_sequence($select,$table,$where=array(1=>1))
	{	$CI = & get_instance ();
		$record = $CI->Mydb->get_record($select,$table,$where,array($select => 'DESC'));
		return (!empty($record)? (int)$record[$select] + 1 : 1 );
	}
}


/* this method used to add sort by option */
if (! function_exists ( 'add_sort_by' )) {
	function add_sort_by($filed_name, $module) {
		$CI = & get_instance ();
		
		if ( get_session_value ( $module . "_order_by_field" ) !="" && get_session_value ( $module . "_order_by_field" ) == $filed_name && get_session_value ( $module . "_order_by_value" ) != "") {
			$icon  = (get_session_value ( $module . "_order_by_value" ) == "ASC")? 'desc' : 'asc';
			return '&nbsp;<a  data="' . $filed_name . '" class="sort_'.$icon.'"  title=" ' . get_label ( 'order_by_'.$icon ) . ' "><i class="fa fa-sort-alpha-'.$icon.' t sort_icon"></i></a>';
			
		} else {
			
			return '&nbsp;<a  data="' . $filed_name . '" class="sort_asc"  title=" ' . get_label ( 'order_by_asc' ) . ' "><i class="fa fa-sort sort_icon"></i></a>';
		}

	}
}

/* Get Country list    */
if(!function_exists('get_countries'))
{
	function get_countries($where='',$selected='',$extra='')
	{
		$CI=& get_instance();
		$where_array=($where=='')? array('country_id !='=>'') :  $where ;
		$records=$CI->Mydb->get_all_records('country_id,country_name,timezone','countries',$where_array,'','',array('country_name'=>"ASC"));
		$data=array(''=>get_label('select_country'));
		if(!empty($records))
		{
			foreach($records as $value)
			{
				$data[$value['country_name']."-".$value['timezone']] = stripslashes($value['country_name']);
			}
		}
		$extra=($extra!='')?  $extra : 'class="form-control" id="client_country" ' ;
		 
		return  form_dropdown('client_country',$data,$selected,$extra);
	}
}

/* Get Country list new   */
if(!function_exists('get_countries_one'))
{
	function get_countries_one($where='',$selected='',$extra='')
	{
		$CI=& get_instance();
		$where_array=($where=='')? array('country_id !='=>'') :  $where ;
		$records=$CI->Mydb->get_all_records('country_id,country_name,timezone','countries',$where_array,'','',array('country_name'=>"ASC"));
		$data=array(''=>get_label('select_country'));
		if(!empty($records))
		{
			foreach($records as $value)
			{
				$data[$value['country_id']."-".$value['timezone']] = stripslashes($value['country_name']);
			}
		}
		$extra=($extra!='')?  $extra : 'class="form-control" id="client_country" ' ;
		 
		return  form_dropdown('client_country',$data,$selected,$extra);
	}
}



/* Get Currency name */
if(!function_exists('get_currency_name'))
{
	function get_currency_name($symbol,$all=null)
	{
		$CI = & get_instance();
		$where="";
		$where_array = ($where=='')? array('currency_symbol ='=>$symbol) :  $where ;
		$records = $CI->Mydb->get_all_records('currency_country,currency_name,currency_symbol','currency',$where_array,'','',array('currency_country'=>"ASC"));

		if($all != null) {
			return $records;
		} else {
			return  $records[0]['currency_name'];
		}
	}
}

/* Get Country list    */
if(!function_exists('get_countries_multiple'))
{
	function get_countries_multiple($where='',$selected='',$extra='',$multiple=null)
	{
		$CI=& get_instance();
		$where_array=($where=='')? array('country_id !='=>'') :  $where ;
		$records=$CI->Mydb->get_all_records('country_id,country_name,timezone','countries',$where_array,'','',array('country_name'=>"ASC"));
		
		$data = ($multiple =="" ) ? array(''=>get_label('select_country')) : array();	
		if(!empty($records))
		{
			foreach($records as $value)
			{
				$data[$value['country_id']] = stripslashes($value['country_name']);
			}
		}
		$extra=($extra!='')?  $extra : 'class="form-control" id="client_shipping_country[]" ' ;
		 
		return  form_dropdown('client_shipping_country[]',$data,$selected,$extra.$multiple);
	}
}

/* Get Country list - customers   */
if(!function_exists('get_all_countries'))
{
	function get_all_countries($where='',$selected='',$extra='')
	{
	
		$CI=& get_instance();
		$where_array=($where=='')? array('id !='=>'') :  $where ;
		$records=$CI->Mydb->get_all_records('id,varName','countries',$where_array,'','',array('varName'=>"ASC"));
		$data=array(''=>get_label('select_country'));
		if(!empty($records))
		{
			foreach($records as $value)
			{
				$data[$value['id']] = stripslashes($value['varName']);
			}
		}
		$extra=($extra!='')?  $extra : 'class="form-control" id="customer_country" ' ;
		
		 
		return  form_dropdown('customer_country',$data,$selected,$extra);
	}
}

/* Get Country list    */
if(!function_exists('get_country_name'))
{
	function get_country_name($country_id=null,$all=null)
	{
		$CI=& get_instance();
		if($country_id !='')
		{
		$where="";
		$where_array=($where=='')? array('id ='=>$country_id) :  $where ;
		$records=$CI->Mydb->get_all_records('id,varName','countries',$where_array,'','',array('varName'=>"ASC"));

		if($all != null) {
			return $records;
		} else {
			return  $records[0]['varName'];
		}
		}
		else
		{
			return "N/A";
		}
	}
}


if(!function_exists('get_all_states'))
{
	function get_all_states($where='',$selected='',$extra='')
	{
	
		$CI=& get_instance();
		$where_array=($where=='')? array('id !='=>'') :  $where ;
		$records=$CI->Mydb->get_all_records('id,varStateName','states',$where_array,'','',array('varStateName'=>"ASC"));
		$data=array(''=>get_label('select_state'));
		if(!empty($records))
		{
			foreach($records as $value)
			{
				$data[$value['id']] = stripslashes($value['varStateName']);
			}
		}
		$extra=($extra!='')?  $extra : 'class="form-control" id="customer_state" ' ;
		
		 
		return  form_dropdown('customer_state',$data,$selected,$extra);
	}
}

/* Get Country list    */
if(!function_exists('get_state_name'))
{
	function get_state_name($state_id=null,$all=null)
	{
		$CI=& get_instance();
		if($state_id !='')
		{
			$where="";
			$where_array=($where=='')? array('id ='=>$state_id) :  $where ;
			$records=$CI->Mydb->get_all_records('id,varStateName','states',$where_array,'','',array('varStateName'=>"ASC"));

			if($all != null) {
				return $records;
			} else {
				return  $records[0]['varStateName'];
			}
		}
		else
		{
			return "N/A";
		}
	}
}
if(!function_exists('get_all_cities'))
{
	function get_all_cities($where='',$selected='',$extra='',$name='')
	{
	
		$CI=& get_instance();
		$where_array=($where=='')? array('city_id !='=>'') :  $where ;
		$records=$CI->Mydb->get_all_records('city_id,city_name','cities',$where_array,'','',array('city_name'=>"ASC"));
		$data=array(''=>get_label('select_city'));
		if(!empty($records))
		{
			foreach($records as $value)
			{
				$data[$value['city_id']] = stripslashes($value['city_name']);
			}
		}
		$extra=($extra!='')?  $extra : 'class="form-control" data-placeholder="Select City" id="customer_city" ' ;
		
		$name=($name=='')? 'customer_city' :  $name ;
		return  form_dropdown($name,$data,$selected,$extra);
	}
}


if(!function_exists('get_cities'))
{
	function get_cities($where='')
	{
	
		$CI=& get_instance();
		$where_array=($where=='')? array('city_id !='=>'') :  $where ;
		$records=$CI->Mydb->get_all_records('city_id,city_name','cities',$where_array,'','',array('city_name'=>"ASC"));
		$data=array(''=>get_label('select_city'));
		if(!empty($records))
		{
			foreach($records as $value)
			{
				$data[$value['city_id']] = stripslashes($value['city_name']);
			}
		}
		return $data;
	}
}

/* Get Country list    */
if(!function_exists('get_city_name'))
{
	function get_city_name($city_id=null,$all=null)
	{
		$CI=& get_instance();
		if($city_id !='')
		{
			$where="";
			$where_array=($where=='')? array('city_id ='=>$city_id) :  $where ;
			$records=$CI->Mydb->get_all_records('city_id,city_name','cities',$where_array,'','',array('city_name'=>"ASC"));

			if($all != null) {
				return $records;
			} else {
				return  $records[0]['city_name'];
			}
		}
		else
		{
			return "N/A";
		}
	}
}

/* Get Currency list    */
if(!function_exists('get_currency'))
{
	function get_currency($where='',$selected='',$extra='')
	{
		$CI=& get_instance();
		$where_array=($where=='')? array('currency_symbol !='=>'') :  $where ;
		$records=$CI->Mydb->get_all_records('currency_id,currency_symbol,currency_name','currency',$where_array,'','',array('currency_name'=>"ASC"));
		$data=array(''=>get_label('select_currency'));
		if(!empty($records))
		{
			foreach($records as $value)
			{
				$data[$value['currency_symbol']] = stripslashes($value['currency_name']);
			}
		}
		$extra=($extra!='')?  $extra : 'class="form-control" id="client_currency" ' ;
		 
		return  form_dropdown('client_currency',$data,$selected,$extra);
	}
}
/* Get Currency list    */
if(!function_exists('get_currency1'))
{
	function get_currency1($where='',$selected='',$extra='',$name='')
	{
		$CI=& get_instance();
		$where_array=($where=='')? array('currency_symbol !='=>'') :  $where ;
		$records=$CI->Mydb->get_all_records('currency_id,currency_symbol,currency_name','currency',$where_array,'','',array('currency_name'=>"ASC"));
		$data=array(''=>get_label('select_currency'));
		if(!empty($records))
		{
			foreach($records as $value)
			{
				$data[$value['currency_symbol']] = stripslashes($value['currency_name']);
			}
		}
		$extra=($extra!='')?  $extra : 'class="form-control" id="client_currency" ' ;
		 
		return  form_dropdown($name,$data,$selected,$extra);
	}
}


if (! function_exists ( 'currency_format' )) {
	
	function currency_format($value = null) {
		
	if($value!='')
	{
		$CI=& get_instance();
		$where_array=array('currency_symbol ='=>$value)  ;
		$records=$CI->Mydb->get_record('currency_name','currency',$where_array);
		
		if(!empty($records))
		{
			return stripslashes($records['currency_name']."(".$value.")");
		}
		else
		{
			return stripslashes($value);
		}
		
		
	}
	else
	{
		return "N/A";
	}
}

}

/* Get Language list    */
if(!function_exists('get_language'))
{
	function get_language($where='',$selected='',$extra='')
	{
		$CI=& get_instance();
		$where_array=($where=='')? array('language_id !='=>'') :  $where ;
		$records=$CI->Mydb->get_all_records('language_id,language_name,language_code','languages',$where_array,'','',array('language_name'=>"ASC"));
		$data=array(''=>get_label('select_language'));
		if(!empty($records))
		{
			foreach($records as $value)
			{
				$data[$value['language_code']] = stripslashes($value['language_name']);
			}
		}
		$extra=($extra!='')?  $extra : 'class="form-control" id="client_language" ' ;
		 
		return  form_dropdown('client_language',$data,$selected,$extra);
	}
}


/* Get Language list    */
if(!function_exists('get_dateformat'))
{
	function get_dateformat($selected,$extra)
	{
		$records=array('F j, Y'=>date('F j, Y'),'Y-m-d'=>date('Y-m-d'),'m/d/Y'=>date('m/d/Y'),'m/d/y'=>date('m/d/y'),'d/m/Y'=>date('d/m/Y'),'d-m-Y'=>date('d-m-Y'));
		$data=array(''=>get_label('select_date_format'));
		if(!empty($records))
		{
			foreach($records as $key=>$value)
			{
				$data[$key] = stripslashes($value);
			}
		}
		$extra=($extra!='')?  $extra : 'class="form-control" id="client_date_format" ' ;
		 
		return  form_dropdown('client_date_format',$data,$selected,$extra);
	}
}

/* Get Language list    */
if(!function_exists('get_timeformat'))
{
	function get_timeformat($selected,$extra)
	{
		$records=array('g:i a'=>date('g:i a'),'g:i A'=>date('g:i A'),'H:i'=>date('H:i'));
		$data=array(''=>get_label('select_time_format'));
		if(!empty($records))
		{
			foreach($records as $key=>$value)
			{
				$data[$key] = stripslashes($value);
			}
		}
		$extra=($extra!='')?  $extra : 'class="form-control" id="client_time_format" ' ;
		 
		return  form_dropdown('client_time_format',$data,$selected,$extra);
	}
}

/*  this function used to get uri segment value    */
if(!function_exists('uri_select'))
{
	function uri_select()
	{ 
		$CI=& get_instance();
	   return 	decode_value($CI->uri->segment(4)) ;
	}
}	

/* Add tooltip */
if(!function_exists('add_tooltip'))
{
	function add_tooltip($title=null)
	{
		 return ' <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="right" title="'.get_label($title."_ttip").'" ></i>';
	}
}


/* this method used to output integer vcalue  */
if(!function_exists('output_integer'))
{
	function output_integer($value=null)
	{
		 return ($value == 0)? "" : $value;
	}
}

/* this method used to output integer vcalue  */
if(!function_exists('output_date'))
{
	function output_date($date=null)
	{
		return ($date !="1970-01-01")? $date : "";
	}
}

/* this function used show enabled or disbled status */
if(!function_exists('output_enbled'))
{
	function output_enbled($vlaue=null)
	{
		return  ($vlaue ==1)? "Yes" : "No";
	}
}

/* this function used show unitnumebr  */
if(!function_exists('output_unitno'))
{
	function output_unitno($unitno1=null,$unitno2 =null)
	{
		return   ($unitno1 !="" && $unitno2!="" )? "#".$unitno1."-".$unitno2 : "N/A";
	}
}

/* this function used to show sttaus  */
if(!function_exists('output_status'))
{
	function output_status($status=null)
	{
		return   ($status == "A")? "Active" : "Inactive";
	}
}

/* this function used to  show name  */
if(!function_exists('output_name'))
{
	function output_name($fname=null,$lname=null)
	{
		 return ($fname !="" && $lname !="" ) ? ucwords(stripslashes($fname." ".$lname)) :  ( $fname !="" ? ucwords(stripslashes($fname)) : "N/A"); 
	}
}

/* this method used to get company admin  records per page value */
if (! function_exists ( 'company_records_perpage' )) {
	function company_records_perpage() {
		$CI = & get_instance ();
		return $CI->session->userdata('camp_admin_records_perpage');
	}
}

/* this function used to show footer copyright content */
if (! function_exists ( 'footer_content' )) {
	function footer_content() {
		echo "&copy; 2016 Pvt Ltd";
	}
}


if (! function_exists ( 'get_company_logo' )) {
	function get_company_logo($image_name='',$company_folder='') {
		$CI = & get_instance ();
		$folder=$CI->lang->line('compnay_image_folder_name');
		$src= load_lib()."theme/images/logo.png";
		
		if( ($image_name !='') && ($company_folder!='') )
		{
			if(file_exists(FCPATH."media/".$company_folder."/".$folder."/".$image_name))
			{
				$src=media_url().$company_folder."/".$folder."/".$image_name;
			}
	    }
		
		return $src;
	}
}
if (! function_exists ( 'get_group_checkbox' )) {
	
	function get_group_checkbox() {
		$groupvar='';
      $CI = & get_instance ();
		$sub_group=$CI->Mydb->get_all_records('sgroup_id,sgroup_groupname','pos_newsletter_subscriber_group',array('sgroup_status'=>'A'),null, null, null,'','','','' );
	   //echo $CI->db->last_query();
	  //exit;
	    if(!empty($sub_group))
	    {

			  foreach($sub_group as $avl) 
			  {			  	
         $groupvar='<div class="input_box">';
         $groupvar.='<div class="checkbox3 checkbox-inline checkbox-check checkbox-light">';
         $groupvar.='form_checkbox("subcriber_group_id","yes","","id="groups"")';      
         $groupvar.='<label for="groups" class="chk_box_label"><b></b></label>';
         $groupvar.='</div>';
         $groupvar.='</div>';

			  }
		}

		return $groupvar;
	}
}

/* this is used to get the cart details from the api */
if(!function_exists('cart_modifiers'))
{
	function cart_modifiers($cart_id, $cart_item_id, $type, $field = NULL)
	{
		$CI = & get_instance ();
	    $result = array ();
		$modifiers = $CI->Mydb->get_all_records ( 'cart_modifier_id,cart_modifier_name', 'cart_modifiers', array (
				'cart_modifier_type' => $type,
				'cart_modifier_parent' => '',
				'cart_modifier_cart_id' => $cart_id,
				'cart_modifier_cart_item_id' => $cart_item_id,
				'cart_modifier_menu_component_primary_key' => $field 
		) );
		
		if (! empty ( $modifiers )) {
			
			foreach ( $modifiers as $modvalues ) {
				/* get modifier values */
				$modifier_values = $CI->Mydb->get_all_records ( array (
						'cart_modifier_id',
						'cart_modifier_name',
						'cart_modifier_price',
						'cart_modifier_qty' 
				), 'cart_modifiers', array (
						'cart_modifier_type' => $type,
						'cart_modifier_parent' => $modvalues ['cart_modifier_id'],
						'cart_modifier_cart_id' => $cart_id,
						'cart_modifier_cart_item_id' => $cart_item_id,
						'cart_modifier_menu_component_primary_key' => $field 
				) );

				if (! empty ( $modifier_values )) {
					$modvalues ['modifiers_values'] = $modifier_values;
					$result [] = $modvalues;
				}
			}
		}
		
		return $result;
	}
}
/* this is used to get the cart details from the api */
if(!function_exists('view_cart_details'))
{
	function view_cart_details($app_id=null,$cart_id,$returndata = "")
	{
		$CI = & get_instance ();

		$user_cart_details = array();		

		$where = array ('cart_id' => $cart_id);
		$cart_detail = $CI->Mydb->get_all_records ( 'cart_details.*','cart_details', $where);

		if (! empty ( $cart_detail )) 
		{
			foreach($cart_detail as $cart_details)
			{
				$select = array (
						'cart_item_id',
						'cart_item_product_id',
						'cart_item_product_name',
						'cart_item_product_sku',
						'cart_item_product_image',
						'cart_item_qty',
						'cart_item_unit_price',
						'cart_item_total_price',
						'cart_item_type',					
						'cart_item_added_condiment' 
				);

				$all_items = $CI->Mydb->get_all_records ( $select, 'cart_items', array (
						'cart_item_cart_id' => $cart_details ['cart_id'] 
				) );

				$fianl = array ();
				if (! empty ( $all_items )) 
				{
					foreach ( $all_items as $items ) 
					{
						$modifier_array = array ();
						$modifier_array = cart_modifiers ( $cart_details ['cart_id'], $items ['cart_item_id'], 'Modifier' );
						$items ['modifiers'] = $modifier_array;
						$fianl [] = $items;
					}
					$response ['cart_details'] = $cart_details;
					$response ['cart_items'] = $fianl;	            				
					
				}
		  }

		  $user_cart_details=$response;

		}

		return $user_cart_details;
		
	}
}
/* this is used to get the cart details from the api */
if(!function_exists('groupinsert'))
{
	function groupinsert($id = "",$groupidss="")
	{
		foreach($groupidss as $keys=>$grpvalid)
	{
				 		$insert_group_array = array (
					   'subscriberid' => $id,
					   'groupid' => $grpvalid					   						
				);	
				$insert_id1 = $this->Mydb->insert ( "news_groupingscbscriber", $insert_group_array );
				
	}	
	return $insert_id1;
	
	}
}
/* Get Review Status dropdown */
if (! function_exists ( 'get_review_status_dropdown' )) {
	function get_review_status_dropdown($selected = null, $addStatus=array(),$extra=null) {

		$status	=	array (
				' ' => get_label('select_status'),
				'1' => 'Approve',
				'2' => 'Reject',
		);
		if(!empty($addStatus)){
			$status	=	$status + $addStatus;
		}
		
		$extra = ($extra == "")?  'class="" id="status"' : $extra;
		return form_dropdown ( 'status', $status, $selected, $extra );
	}
}
/* Address Format */
if(!function_exists('show_address'))
{
	function show_address($address,$unitcode,$post_code){
		
		$address_val = (($address!='')? ucfirst(stripslashes($address)):"").((trim($unitcode) !='' && trim($unitcode) !='-')?", #".$unitcode."<br />":"");
		return $address_val; 
	}
}


if(!function_exists('get_lng_lat')){
	function get_lng_lat($address = ''){
		$url = "http://maps.google.com/maps/api/geocode/json?address=".urlencode($address)."&sensor=false";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		$response = curl_exec($ch);
		curl_close($ch);
		$response_a = json_decode($response);

		$lat = $response_a->results[0]->geometry->location->lat;
		$long = $response_a->results[0]->geometry->location->lng;
		return $lat.','.$long;
	}
}
if(!function_exists('getAddress')){
	function getAddress($latitude,$longitude){
		if(!empty($latitude) && !empty($longitude)){
			//Send request and receive json data by address
			$geocodeFromLatLong = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($latitude).','.trim($longitude).'&sensor=false'); 
			$output = json_decode($geocodeFromLatLong);
			$status = $output->status;
			//Get address from json data
			$address = ($status=="OK")?$output->results[1]->formatted_address:'';
			//Return address of the given latitude and longitude
			if(!empty($address)){
				return $address;
			}else{
				return false;
			}
		}else{
			return false;   
		}
	}
}
/* get productname */
if(!function_exists('product_name'))
{
	function product_name($product_name="",$product_alias="")
	{
		  if($product_alias!="")
		  {
			  $p_name=$product_alias;
		  }
		  else
		  {
			   $p_name=$product_name;
		  }     
		return $p_name;
	}
}

/* get productname */
if(!function_exists('get_favi_icon'))
{
	function get_favi_icon()
	{
		$icon = '<link rel="icon" href='.load_lib().'theme/images/favicon-32x32.png type="image/png" sizes="32x32">';   
		return $icon;
	}
}

if(!function_exists('thousandsCurrencyFormat'))
{
	function thousandsCurrencyFormat($num) {
	  $x = round($num);
	  if($x >= 1000) {
		  $x_number_format = number_format($x);
		  $x_array = explode(',', $x_number_format);
		  $x_parts = array('k', 'm', 'b', 't');
		  $x_count_parts = count($x_array) - 1;
		  $x_display = $x;
		  $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
		  $x_display .= $x_parts[$x_count_parts - 1];
	  }
	  else
	  {
		  $x_display = $x;
	  }
	  return $x_display;
	}
}
if(!function_exists('datepostformat'))
{
	function datepostformat($date) {
		$date1 = new DateTime($date);
		$date2 = $date1->diff(new DateTime());
		$result_display = "";
		
		if($date2->y > 1)
		{
			$result_display.= ($date2->y)?$date2->y.' years':'';
		}
		else if($date2->m > 1)
		{
			$result_display.= ($date2->m)?$date2->m.' months':'';
		}
		else if($date2->d > 1)
		{
			$result_display.= ($date2->d)?$date2->d.' days':'';
		}
		else if($date2->h > 1)
		{
			$result_display.= ($date2->h)?$date2->h.' hours':'';
		}
		else if($date2->i > 1)
		{
			if($date2->i >= 1 && $date2->i <= 5)
			{
				$result_display.= 'few minutes';
			}
			else {
				$result_display.= ($date2->i)?$date2->i.' minutes':'';
			}
		}
		else {
			/*$result_display.= ($date2->s)?$date2->s.' seconds':'';*/
			return $result_display.= 'just now';
		}
		return $result_display." ago";
	}
}
if (! function_exists ( 'get_privacy_option_dropdown' )) 
{
	function get_privacy_option_dropdown($name='privacy_option',$selected = null, $addStatus=array(),$extra=null) 
	{

		$status	=	array (
				0 => 'Every One',
				1 => 'Only Me',
				2 => 'Followers',
		);
		if(!empty($addStatus)){
			$status	=	$status + $addStatus;
		}
		$extra = ($extra == "")?  'class="" id="privacy_option"' : $extra;
		return form_dropdown ( $name, $status, $selected, $extra );
	}
}
if (! function_exists ( 'get_blog_category' )) 
{
	function get_blog_category() 
	{	
		$CI = & get_instance ();
		$category = array();
		$post_category = $CI->Mydb->get_all_records('*','blog_category',array('blog_cat_status' => 'A'),'','',array('blog_cat_sequence'=>'ASC'));
		if(!empty($post_category))
		{
			foreach($post_category as $blogcat)
			{
				$category[$blogcat['blog_cat_slug']] = $blogcat['blog_cat_name'];
			}
		}
		return $category;
	}
}
/*Those who have set as only me, this will provide those user ids*/
if (! function_exists ( 'get_private_me' )) 
{
	function get_private_me() 
	{
		$CI = & get_instance ();
		$loggedin_id = $CI->session->userdata('bg_user_id');
		$block_users = array();
		if($loggedin_id)
		{
			$block_records = $CI->Mydb->get_all_records('customer_id','customers',array('customer_private' => '1','customer_id != '.$loggedin_id=>NULL));	
			
			if(!empty($block_records))
			{
				foreach($block_records as $block_record)
				{
					$block_users[] = $block_record['customer_id'];
				}
			}
		}
		return $block_users;
	}
}

/*This function will provide you the list of users who blocked the current logged in user id*/
if (! function_exists ( 'get_follow_block_me' )) 
{
	function get_follow_block_me() 
	{
		$CI = & get_instance ();
		$loggedin_id = $CI->session->userdata('bg_user_id');
		$block_users = array();
		if($loggedin_id)
		{
			$block_records = $CI->Mydb->get_all_records('block_customer_id','customer_blocked_lists',array('block_user_id' => $loggedin_id));	
			
			if(!empty($block_records))
			{
				foreach($block_records as $block_record)
				{
					$block_users[] = $block_record['block_customer_id'];
				}
			}
		}
		return $block_users;
	}
}

/*get user id who have set followers only */
if (! function_exists ( 'get_follow_settings_users' )) 
{
	function get_follow_settings_users() 
	{
		$CI = & get_instance ();
		$loggedin_id = $CI->session->userdata('bg_user_id');
		$set_follow_users = array();
		if($loggedin_id)
		{
			$block_records = $CI->Mydb->get_all_records('customer_id','customers',array('customer_private' => '2','customer_id != '.$loggedin_id=>NULL));	
			$currentuser_followers = get_followers_list($loggedin_id);
			$loggedin_followers = array();
			if(!empty($currentuser_followers)) {
				foreach($currentuser_followers as $followerslist)
				{
					$loggedin_followers[] = $followerslist['customer_id'];
				}
			}

			if(!empty($block_records))
			{
				foreach($block_records as $block_record)
				{
					if(!in_array($block_record['customer_id'],$loggedin_followers)) {
						$set_follow_users[] = $block_record['customer_id'];
					}
				}
			}
		}
		return $set_follow_users;
	}
}

/*This is used to get all the blocked users for the logged uses, which means it will combine above two functions*/
if (! function_exists ( 'get_all_block_users' )) 
{
	function get_all_block_users() 
	{
		$private_array = get_private_me();
		$follow_block_array = get_follow_block_me();
		$follow_only_block_array = get_follow_settings_users();
		$overall_block = array_merge($private_array,$follow_block_array,$follow_only_block_array);
		return array_unique($overall_block);
	}
}




?>