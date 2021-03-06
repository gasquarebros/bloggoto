<?php
/**************************
Project Name	: BlogGotoWeb
Created on		: 27 Nov, 2017
Last Modified 	: 27 Nov, 2017
Description		: Page contains frontend panel login and forgot password functions.

***************************/
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Services extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		//$this->authentication->user_authentication();
		$this->module = "services";
		$this->module_label = get_label('services_module_label');
		$this->module_labels = get_label('services_module_label');
		$this->folder = "services/";
		$this->table = "services";
		$this->order_table = "order_service";
		$this->service_gallery = "service_gallery";
		$this->customers = "customers";
		$this->service_categorytable = "service_categories";
		$this->service_subcategorytable = "service_subcategories";
		$this->service_cities = "service_cities";
		$this->primary_key='ser_primary_id';
		$this->load->library('common');
		$this->load->helper('products');
	}
	
	/* this method used to check login */
	public function index() {
		//echo "inn"; exit;
		$data = $this->load_module_info ();	
		$service_category = $this->Mydb->get_all_records('*',$this->service_categorytable,array('ser_cate_status' => 'A'));
		if(!empty($service_category))
		{
			foreach($service_category as $sercat)
			{
				$category[$sercat['ser_cate_primary_id']] = $sercat['ser_cate_name'];
			}
		}
		$data['service_category'] = $category;

		$service_subcategory = $this->Mydb->get_all_records('*',$this->service_subcategorytable,array('pro_subcate_status' => 'A'));
		if(!empty($service_subcategory))
		{
			foreach($service_subcategory as $procat)
			{
				$subcategory[$procat['pro_subcate_primary_id']] = $procat['pro_subcate_name'];
			}
		}
		$data['service_subcategory'] = $subcategory;
		$this->layout->display_site ( $this->folder . $this->module . "-list", $data );
	}
	
	public function ajax_pagination()
	{
		check_site_ajax_request();
		$data = $this->load_module_info ();
		$like = array ();
		
		$order_by = array (
				$this->primary_key => 'DESC' 
		);
		$where = array('ser_status'=>'A');
		/* Search part start */
		
		if (post_value ( 'paging' ) == "") {
			$search_field = post_value ( 'search_field' );
			$type = post_value ( 'type' );
			$order_field = post_value ( 'order_field' );
		}

		$cat = post_value ( 'category' );
		$subcat = post_value('subcategory');
		$sortby = post_value('sortby');
		$city = post_value('customer_city');
		
		$availability = $this->input->post('availability');

		if ($availability != "" && $availability != 'undefined') {
			$avail = '';
			foreach($availability as $avails) {
				if($avail !=''){
					$avail.=" OR ";
				}
				$avail.="ser_available like '%,".$avails.",%'";
			}
			if($avail !=''){
				$where = array_merge ( $where, array (
					"(".$avail.")" => null 
				));
			}
		}

		if($search_field !='' && $search_field != 'undefined') {
			$like = array_merge ( $like, array (
				"ser_title" => $search_field 
			));
		}
		

		if ($cat != "" && $cat != 'undefined') {
			$where = array_merge ( $where, array (
				"ser_category" => $cat 
			));
		}

		if ($subcat != "" && $subcat != 'undefined') {
			$where = array_merge ( $where, array (
				"ser_subcategory" => $subcat 
			));
		}

		if($sortby !='' && $sortby == 'price-low')
		{
			$order_by = array (
				'ser_price' => 'ASC' 
			);
		} else if($sortby !='' && $sortby == 'price-high')
		{
			$order_by = array (
				'ser_price' => 'DESC' 
			);
		} else if($sortby !='' && $sortby == 'asc')
		{
			$order_by = array (
				'ser_title' => 'ASC' 
			);
		} else if($sortby !='' && $sortby == 'desc')
		{
			$order_by = array (
				'ser_title' => 'DESC' 
			);
		}
		
		
		$join = "";
		$join [0] ['select'] = "ser_cate_primary_id,ser_cate_id,ser_cate_name";
		$join [0] ['table'] = $this->service_categorytable;
		$join [0] ['condition'] = "ser_cate_primary_id = ser_category";
		$join [0] ['type'] = "LEFT";
		
		$join [1] ['select'] = "customer_id,customer_first_name,customer_last_name,customer_username,customer_email,customer_photo,customer_gst_no";
		$join [1] ['table'] = $this->customers;
		$join [1] ['condition'] = "ser_customer_id = customer_id";
		$join [1] ['type'] = "LEFT";

		$join [2] ['select'] = "pro_subcate_primary_id,pro_subcate_id,pro_subcate_name";
		$join [2] ['table'] = $this->service_subcategorytable;
		$join [2] ['condition'] = "pro_subcate_primary_id = ser_subcategory";
		$join [2] ['type'] = "LEFT";

		$join [3] ['select'] = "group_concat(',',ser_city_id,',') as cities";
		$join [3] ['table'] = $this->service_cities;
		$join [3] ['condition'] = $this->service_cities.".ser_service_id = ser_primary_id";
		$join [3] ['type'] = "LEFT";

		$join [4] ['select'] = "group_concat(ser_gallery_image,'~') as galleryimages";
		$join [4] ['table'] = 'service_gallery';
		$join [4] ['condition'] = "service_gallery.ser_gallery_ser_primary_id = ser_primary_id";
		$join [4] ['type'] = "LEFT";
		/*
		$join [2] ['select'] = "group_concat(',',post_tag_user_id) as post_tag_ids,group_concat(',',post_tag_user_name) as post_tag_names";
		$join [2] ['table'] = $this->post_tags;
		$join [2] ['condition'] = "post_tag_post_id = post_id";
		$join [2] ['type'] = "LEFT";*/
		/* not in product availability id condition  */
		$groupby = $this->primary_key;

		if ($city != "" && $city != 'undefined') {
			$this->db->having('cities like "%, '.$city.',%"');
		}
		$totla_rows = $this->Mydb->get_num_join_rows ( $this->primary_key, $this->table, $where, null, null, null, $like, $groupby, $join  );
		
		if ($city != "" && $city != 'undefined') {
			$this->db->having('cities like "%, '.$city.',%"');
		}
		//print_r(post_value('page'));
		//exit;
		$limit = 12;
		$page = post_value ( 'page' )?post_value ( 'page' ):1;
		$offset = post_value ( 'page' )?((post_value ( 'page' )-1) * $limit):0;
		$offset = post_value ( 'offset' )?post_value ( 'offset' ):$offset;
		$next_offset = $offset+$limit;
		$next_set = ($totla_rows > $next_offset)?($offset+$limit):'';

		
		
		$data['offset'] = $offset;
		$select_array = array ($this->table.'.*');
		$data ['records'] = $this->Mydb->get_all_records ( $select_array, $this->table, $where, $limit, $offset, $order_by, $like, $groupby, $join );
		//echo  "<pre>";
		//print_r($data);
		//exit;
		$current_records = (($page-1)*$limit)+count($data ['records']);
		$data['current_records'] = $current_records;
		$data['total_rows'] = $totla_rows;
		$data['page'] = $page;
//echo $this->db->last_query();
//exit;
		$html = get_template ( $this->folder . '/' . $this->module . '-ajax-list', $data );
		echo json_encode ( array (
				'status' => 'ok',
				'offset' => $offset,
				'next_set' => $next_set,
				'html' => $html,
		) );
		exit ();
	}

	public function view($slug=null)
	{
		if($slug !='')
		{
			$data = $this->load_module_info ();
			$where = "ser_slug = '".$slug."'";
			$like = array ();
			
			$order_by = array (
					$this->primary_key => 'DESC' 
			);

			$join = "";
			$join [0] ['select'] = "ser_cate_primary_id,ser_cate_id,ser_cate_name";
			$join [0] ['table'] = $this->service_categorytable;
			$join [0] ['condition'] = "ser_cate_primary_id = ser_category";
			$join [0] ['type'] = "LEFT";
			
			$join [1] ['select'] = "customer_id,customer_first_name,customer_last_name,customer_username,customer_email,customer_phone,customer_city,customer_state,customer_facebook_link,customer_instagram_link,customer_twitter_link,customer_youtube_link,customer_linkedin_link,customer_photo,customer_gst_no";
			$join [1] ['table'] = $this->customers;
			$join [1] ['condition'] = "ser_customer_id = customer_id";
			$join [1] ['type'] = "LEFT";

			$join [2] ['select'] = "pro_subcate_primary_id,pro_subcate_id,pro_subcate_name";
			$join [2] ['table'] = $this->service_subcategorytable;
			$join [2] ['condition'] = "pro_subcate_primary_id = ser_subcategory";
			$join [2] ['type'] = "LEFT";

			$join [3] ['select'] = "group_concat(',',ser_city_id,',') as cities";
			$join [3] ['table'] = $this->service_cities;
			$join [3] ['condition'] = $this->service_cities.".ser_service_id = ser_primary_id";
			$join [3] ['type'] = "LEFT";
			$groupby = $this->primary_key;

			$select_array = array ($this->table.'.*');
			$records = $this->Mydb->get_all_records ( $select_array, $this->table, $where, '', '', $order_by, $like, $groupby, $join );
			if(empty($records)){
				redirect(base_url().'services');
			}
			$data ['records'] = $records[0];
			$data ['gallery_images'] = $this->Mydb->get_all_records ( 'ser_gallery_id,ser_gallery_image,ser_gallery_ser_primary_id', 'service_gallery', array (
					'ser_gallery_ser_primary_id' => $records[0] [$this->primary_key] 
			) );
			$where_city = '';
			if($records[0]['cities']){
				$cities = explode(', ', $records[0]['cities']);
				foreach($cities as $city) {
					if($city !='' && $city !=','){
						$where_city[] = $city;
					}
				}
			}	
			$data['cities'] = get_cities(array('city_id in ('.implode(',',$where_city).')'=>null));
			
			//echo "<pre>"; print_r($data); exit;
			$this->layout->display_site ( $this->folder . $this->module . "-views", $data );
		}
		else
		{
			redirect(base_url().'services');	
		}
	}

	/* this method used to book record . */
	public function booknow() 
	{
		check_site_ajax_request();
		$userid = get_user_id();
		if($userid !='') {
			if ($this->input->post ( 'action' ) == "Add") {
				$this->form_validation->set_rules ( 'start_date', 'lang:start_date', 'required' );
				if(post_value('ser_pricet_type') == 'day' || post_value('ser_pricet_type') == 'hour') {
					$this->form_validation->set_rules ( 'end_date', 'lang:end_date', 'required' );
				}
				$this->form_validation->set_rules ( 'address_line1', 'lang:address_line1', 'required' );
				$this->form_validation->set_rules ( 'customer_city', 'lang:city', 'required' );
				$this->form_validation->set_rules ( 'customer_state', 'lang:state', 'required' );
				$this->form_validation->set_rules ( 'zipcode', 'lang:zipcode', 'required' );
				if ($this->form_validation->run () == TRUE) {
					$service = $this->Mydb->get_record('*',$this->table,array('ser_service_id'=>post_value('service'),'ser_status'=>'A'));
					if(!empty($service)){
						$available = explode(',',$service['ser_available']);
						$start = strtotime(post_value('start_date'));
						$end = strtotime(post_value('end_date'));
						$dates = array();
						while($start <= $end)
						{
							array_push(
								$dates,
								strtolower(date(
									'D',
									$start
								))
							);
							$start += 86400;
						}
						$dates = array_unique($dates);
						$diff = array_diff($dates,$available);
						$available_cities_list = $this->Mydb->get_all_records('*',$this->service_cities,array('ser_service_id'=>$service['ser_primary_id']));
						$error = 1;
						if(!empty($available_cities_list))
						{
							foreach($available_cities_list as $acity){
								if($acity['ser_city_id'] == post_value('customer_city') ){
									$error = 0;
									break;
								}
							}
						}

						if($service['ser_pricet_type'] == 'per session' && $service['max_limit'] !='' && $service['max_limit'] > 0 ) {
							$date_st = date('Y-m-d',strtotime(post_value('start_date')));
							$order_booked_count = $this->Mydb->get_num_rows(array('order_service_id'),'order_service',array('DATE(order_service_start_date)'=>$date_st,'order_service_serviceid'=>$service['ser_primary_id']));
							if($order_booked_count >= $service['max_limit']) {
								$error = 1;
							}
						}
						if(empty($diff) && $error == 0){
							$order_service_guid = get_guid ( $this->order_table, 'order_service_guid' );
							$order_service_image = post_value('cover_photo');
							if(post_value('ser_pricet_type') == 'day' || post_value('ser_pricet_type') == 'hour'){
								$end_date = date('Y-m-d',strtotime(post_value('end_date')));
							} else {
								$end_date = '';
							}
							$start_date = date('Y-m-d',strtotime(post_value('start_date')));
							$start_time = post_value('start_time')?post_value('start_time'):$service['ser_service_start_time'];
							$end_time = post_value('end_time')?post_value('end_time'):$service['ser_service_end_time'];
							$discount = find_discount($service['ser_price'],$service['ser_discount_price'],$service['ser_discount_start_date'],$service['ser_discount_end_date']);
							$price = ""; 
							if($service['ser_discount_price'] !='' && $discount > 0) {
								$price = $service['ser_discount_price'];
							} else {
								$price = $service['ser_price'];
							}
							$order_service_local_no = date('dmyHis').'F'.rand(0, 999);
							$insert_array = array (
								'order_service_guid' => $order_service_guid,
								'order_service_local_no' => $order_service_local_no,
								'order_service_serviceid'=> $service['ser_primary_id'],
								'order_service_title' => $service['ser_title'],
								'order_service_provider_id' => $service['ser_customer_id'],
								'order_service_slug' => $service['ser_title'],
								'order_service_price' => $price,
								'order_service_category_id' => $service['ser_category'],
								'order_service_subcategory_id' => $service['ser_subcategory'],
								'order_service_price_type' => $service['ser_pricet_type'],
								'order_service_start_date' => $start_date,
								'order_service_end_date' => $end_date,
								'order_service_start_time' => $start_time,
								'order_service_end_time' => $end_time,
								'order_service_image' => $order_service_image,
								'order_service_is_paid' => 1,
								'order_service_address_line1' => post_value ( 'address_line1' ),
								'order_service_address_line2' => post_value ( 'address_line2' ),
								'order_service_city' => post_value ( 'customer_city' ),
								'order_service_state' => post_value ( 'customer_state' ),
								'order_service_zipcode' => post_value ( 'zipcode' ),
								'order_service_landmark' => post_value ( 'landmark' ),
								'order_service_message'	=> post_value('order_service_message'),
								'order_service_customer_id' => get_user_id(),
								'order_service_status'	=> 'processing',
								'order_service_created_on' => current_date (),
								'order_service_created_ip' => get_ip ()
							);
							
							$insert_id = $this->Mydb->insert ( $this->order_table, $insert_array );
							if($insert_id) {

								$st_date = $insert_array['order_service_start_date'];
								$ed_date = $insert_array['order_service_end_date'];
								if($service['ser_pricet_type'] == 'hour') {
									$st_time = ($insert_array['order_service_start_time'] !=''  && $insert_array['order_service_start_time'] != '00:00') ?  date( 'h.i A', strtotime($insert_array['order_service_start_time'])):'';
									$ed_time = ($insert_array['order_service_end_time'] !=''  && $insert_array['order_service_end_time'] != '00:00') ?  date( 'h.i A',strtotime( $insert_array['order_service_end_time'])):'';
								} else {
									$st_time = $ed_time = '';
								}
								//send mail and notification with success message
								$date =  $st_date." - ".$ed_date. "<br>".$st_time." - ".$ed_time;

								$name = $this->session->userdata('bg_first_name')." ".$this->session->userdata('bg_last_name');
								$email = $this->session->userdata('bg_user_email');
								$this->load->library('myemail');
								$check_arr = array('[NAME]','[LOCAL_ORDER_NO]','[TITLE]','[DATE]');
								$replace_arr = array( ucfirst(stripslashes($name)),$insert_array['order_service_local_no'],stripslashes($insert_array['order_service_title']),$date);
								$email_template_id = '12';
								if($email_template_id != '') {
									$mail_res = $this->myemail->send_admin_mail($email,$email_template_id,$check_arr,$replace_arr);
								}

								
								$provider = $this->Mydb->get_record('*','customers',array('customer_id'=>$service['ser_customer_id']));
								if(!empty($provider)) {
									$name = $provider['customer_first_name']." ".$provider['customer_last_name'];
									$email = $provider['customer_email'];
									if($name == '' && $provider['customer_username'] !='') {
										$name = $provider['customer_username'];
									} else if($name == '') {
										$name = "Provider";
									}
									$check_arr = array('[NAME]','[LOCAL_ORDER_NO]','[TITLE]');
									$replace_arr = array( ucfirst(stripslashes($name)),$insert_array['order_service_local_no'],stripslashes($insert_array['order_service_title']));
									$email_template_id = '13';
									if($email_template_id != '') {
										$mail_res = $this->myemail->send_admin_mail($email,$email_template_id,$check_arr,$replace_arr);
									}
								}

								$result ['status'] = 'success';
								$this->session->set_flashdata ( 'admin_success', sprintf ( $this->lang->line ( 'success_message_ordered' ), $this->module_label ) );
							}
						} else {
							$result ['status'] = 'error';
							$result ['message'] = "The Service is unavailable for certain days or cities or fullfilled for the day";
						}
						
					} else {
						$result ['status'] = 'error';
						$result ['message'] = "The Service is unavailable";
					}
				} else {
					
					$result ['status'] = 'error';
					$result ['message'] = validation_errors ();
				}
				echo json_encode ( $result );
				exit ();
			}
		}
		else
		{
			$result['status'] = "error";
			$result ['message'] = "You have to do login inorder to book service";
			echo json_encode($result);
		}
		
	}

	public function getsubcategory() {
		check_site_ajax_request();
		$cat = $this->input->post('category');
		$where= array('pro_subcate_status'=>'A');
		if($cat !='')
		{
			$where['pro_subcate_category_primary_id'] = $cat;
		}
		$subcategories = $this->Mydb->get_all_records('*',$this->service_subcategorytable,$where);
		$data = array(''=>'Select Subcategory');
		if(!empty($subcategories))
		{
			foreach($subcategories as $subcategory)
			{
				$data[$subcategory['pro_subcate_primary_id']] = ucfirst(stripslashes($subcategory['pro_subcate_name']));
			}
		}
		$extra = 'class="wide" id="service_subcategory" ' ;
		$html = form_dropdown('subcategory',$data,'',$extra);

		echo json_encode (array(
			'html' =>$html,
		));
	}

	public function thankyou() {
		$data = $this->load_module_info ();	
		$this->layout->display_site ( $this->folder . $this->module . "-thankyou", $data );
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
