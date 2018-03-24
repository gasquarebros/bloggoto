<?php
/**************************
 Project Name	: POS
Created on		: 30 March, 2016
Last Modified 	: 30 March, 2016
Description		: Page contains common REST settings
***************************/

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

/* this function used validate APP ID */
if(!function_exists('app_validation'))
{
	function app_validation($app_id)
	{
		$CI =& get_instance();
		
		
		$select_array = array (
				'client_id',
				'client_app_id',
				'client_name',
				'client_email_address',
				'client_from_email',
				'client_notify_email',
				'client_site_url',
				'client_defalut_timezone',
				'client_date_format',
				'client_time_format',
				'client_currency',
				'client_folder_name',
				'client_category_modifier_enable',
				'client_promocode_enable',
				'client_tax_enable',
				'client_tax_surcharge',
				'client_delivery_enable',
				'client_delivery_surcharge',
				'client_country',
				'client_loyality_enable',
				'client_voucher_enable',
				'client_gift_enable',
				'client_timer_enable',
				'client_condiment_enable',
				'client_delivery_surcharge',
				'client_timer_enable',
				'client_start_time',
				'client_timeslot_enable',
				'client_holiday_enable',
				'client_end_time',
				'client_reward_point',
				'client_promocode_options',
				'client_promo_code',
				'client_newsletter_default_group',
				'client_promo_code_normal_popup_enable',
				'client_shipping_country',
				'client_country_currency',
				'client_country_currency_difference',
				'client_currency_api',
				'client_chief_recommandation_enable',
				'client_delivery_charges',
				'client_catering_buffet',
				'client_catering_deliverycharge',
				'client_new_product_option_enable',
				'client_highlight_product_option_enable'
				
		);

		$company = $CI->Mydb->get_record($select_array,'clients', array('client_app_id' =>addslashes($app_id),'client_status'=>'A'));
		 if(empty($company)){
		 	echo json_encode(array('status'=>'error','message' => get_label('app_invalid'))); exit;
		 } else {
			 return $company; 
		}
	}
}

/* this function used to  200 response */
if(!function_exists('success_response'))
{
	function success_response()
	{
		return 200;
	}
}

/* this function used to  success response */
if(!function_exists('notfound_response'))
{
	function notfound_response()
	{
		return 200;
	}
}

/* this function used to  success response */
if(!function_exists('something_wrong'))
{
	function something_wrong()
	{
		return 200;
	}
}

/* this function used to chnage timezone */
if(!function_exists('change_time_zone'))
{
	function change_time_zone($time_zone=null)
	{
		$time_zone = ($time_zone == "")? "Asia/Singapore" : $time_zone;
		date_default_timezone_set($time_zone);
	}
}

/* this function used to get delivery global id */
if(!function_exists('get_delivery_id'))
{
	function get_delivery_id($time_zone=null)
	{
		 return '634E6FA8-8DAF-4046-A494-FFC1FCF8BD11';
	}
}	


/* this function used to get delivery global id */
if(!function_exists('get_pickup_id'))
{
	function get_pickup_id()
	{
		return '718B1A92-5EBB-4F25-B24D-3067606F67F0';
	}
}
/* this function used to get availability name */
if(!function_exists('get_availability_name'))
{
	function get_availability_name($availability_id=null)
	{
		$CI = & get_instance();
		 $result = $CI->Mydb->get_record('av_name','availability',array('av_id' => $availability_id));
		 return (!empty($result))? join($result) : "";
	}
}
/* this function used to get product name */
if(!function_exists('get_product_tag'))
{
	function get_product_tag($product_tag_id=null)
	{
		 $CI = & get_instance();
		 //$result = $CI->Mydb->get_record('pro_tag_name','product_sub_tags',array('pro_tag_id' => $product_tag_id));
		// return (!empty($result))? join($result) : "";
		 
		$join[0]['select'] = "";
		$join[0]['table'] = "product_sub_tags";
		$join[0]['condition'] = "pro_sub_tag_id = pro_tag_id";
		$join[0]['type'] = "inner";
		$where = array (
				 'pro_tag_app_id' => $product_tag_id
		);
		$select_array = array ('pro_tag_name ');	
	    $record=$CI->Mydb->get_all_records ( $select_array, 'product_tags', $where, '', '', '', '','',$join );
		 //echo $CI->db->last_query();
		 //exit;
		return $record;
		 
		 
		 
	}
}


if(!function_exists('get_local_ordeno'))
{
	function get_local_ordeno($app_id=null,$order_source)
	{
		$CI = &get_instance();
		$loc_parent = date("ymd");
		$loc_query = "SELECT order_local_no FROM pos_orders WHERE order_company_app_id = ". $CI->db->escape($app_id)." AND order_local_no like   '%$loc_parent%'  ORDER BY order_primary_id DESC LIMIT 1";
 
		$loc_result = $CI->Mydb->custom_query_single($loc_query);
		if(!empty($loc_result)){
			$old_lno= substr($loc_result['order_local_no'],-4) + 1;
		}
		else {
			$old_lno= 1001;
		}
		 
		if($order_source =="CallCenter"){
			$string = "C";
		}elseif($order_source =="Mobile"){
			$string = "M";
		}else{
			$string = "E";
		}
	
		$loc_order_no = $loc_parent.".".$string.$old_lno;
		return $loc_order_no;
	}
}
if(!function_exists('show_price_client'))
{
	function show_price_client($price,$client_currency)
	{
		return $client_currency." ".number_format($price,2);
	}
}


/*check image exists or not check this writing a file */
if (!function_exists('check_image_exists')) {
	function check_image_exists($path, $image, $imageType) {
		$CI =& get_instance();
		$filename = $path.$image.$imageType;
		if (file_exists($filename)) {
			$image = random_string('alnum', 30);
			return check_image_exists( $path, $image, $imageType);
		} else {
			return $image.$imageType;
		}
	}
}
/*check image exists or not check this writing a file */
if (!function_exists('update_addtioncarttotal')) {
	function update_addtioncarttotal($cart_id,$priceupdate) 
	{
		 $newsubtotal=$newgrandtotal=$cart_delivery_charge=$cart_sub_total = $cartupdate="";
		 $update_array=array();
		 $CI =& get_instance();
		 $result = $CI->Mydb->get_record('cart_sub_total,cart_delivery_charge','cart_details',array('cart_id' => $cart_id));
		 $cart_delivery_charge=$result['cart_delivery_charge'];
		 $cart_sub_total=$result['cart_sub_total'];		 
		 $newsubtotal=$cart_sub_total+$priceupdate;
		 $newgrandtotal=$newsubtotal+$cart_delivery_charge;				 
		 $update_array = array('cart_sub_total' => $newsubtotal,'cart_grand_total' => $newgrandtotal);
		 $cartupdate=$CI->Mydb->update( 'cart_details',array('cart_id' => $cart_id), $update_array );		
		 return $cartupdate;
	}
}
if(!function_exists('time_availability'))
{
	function time_availability($availability_time=array())
	{
				if(!empty($availability_time))
				{
					
																	
														if(($availability_time->monday_available==1) && ($availability_time->monday_start_time!="") && ($availability_time->monday_end_time) && (date('D')=='Mon'))
														{
															if(!(date("H:i:s",strtotime($availability_time->monday_start_time))< date("H:i:s")  && date("H:i:s",strtotime($availability_time->monday_end_time))> date("H:i:s")))
															{
																return 1;
															}
															
														}
														if(($availability_time->tuesday_available==1) &&($availability_time->tuesday_start_time !="") && ($availability_time->tuesday_end_time !="") && (date('D')=='Tue'))
														{														
															if(!(date("H:i:s",strtotime($availability_time->tuesday_start_time)) < date("H:i:s")  && date("H:i:s",strtotime($availability_time->tuesday_end_time)) > date("H:i:s")))
															{
																return 1;
															}
															
														}
														
														if(($availability_time->wednesday_available==1) &&($availability_time->wednesday_start_time!="") && ($availability_time->wednesday_end_time) && (date('D')=='Wed'))
														{
															if(!(date("H:i:s",strtotime($availability_time->wednesday_start_time))< date("H:i:s")  && date("H:i:s",strtotime($availability_time->wednesday_end_time))> date("H:i:s")))
															{
																return 1;
															}
															
														}
														if(($availability_time->thursday_available==1) &&($availability_time->thursday_start_time!="") && ($availability_time->thursday_end_time) && (date('D')=='Thu'))
														{
															if(!(date("H:i:s",strtotime($availability_time->thursday_start_time))< date("H:i:s")  && date("H:i:s",strtotime($availability_time->thursday_end_time))> date("H:i:s")))
															{
																return 1;
															}
															
														}
														if(($availability_time->friday_available==1) &&($availability_time->friday_start_time!="") && ($availability_time->friday_end_time) && (date('D')=='Fri'))
														{
															
															if(!(date("H:i:s",strtotime($availability_time->friday_start_time))< date("H:i:s")  && date("H:i:s",strtotime($availability_time->friday_end_time))> date("H:i:s")))
															{
																return 1;
															}
															
														}
														if(($availability_time->saturday_available==1) &&($availability_time->saturday_start_time!="") && ($availability_time->saturday_end_time) && (date('D')=='Sat'))
														{
															if(!(date("H:i:s",strtotime($availability_time->saturday_start_time))< date("H:i:s")  && date("H:i:s",strtotime($availability_time->saturday_end_time))> date("H:i:s")))
															{
																return 1;
															}
															
														}
														if(($availability_time->sunday_available==1) &&($availability_time->sunday_start_time!="") && ($availability_time->sunday_end_time) && (date('D')=='Sun'))
														{
															if(!(date("H:i:s",strtotime($availability_time->sunday_start_time))< date("H:i:s")  && date("H:i:s",strtotime($availability_time->sunday_end_time))> date("H:i:s")))
															{
																return 1;
															}
															
														}		
			
		}
		return 0;
	}	
}
