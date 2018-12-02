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
		
		$join [1] ['select'] = "customer_id,customer_first_name,customer_last_name,customer_username,customer_email";
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
		$limit = 1;
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
			
			$join [1] ['select'] = "customer_id,customer_first_name,customer_last_name,customer_username,customer_email,customer_phone,customer_city,customer_state,customer_facebook_link,customer_instagram_link,customer_twitter_link,customer_youtube_link,customer_linkedin_link,customer_photo";
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
			$data ['gallery_images'] = $this->Mydb->get_record ( 'ser_gallery_id,ser_gallery_image,ser_gallery_ser_primary_id', 'service_gallery', array (
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
		if ($this->input->post ( 'action' ) == "Add") {
			$this->form_validation->set_rules ( 'start_date', 'lang:start_date', 'required' );
			$this->form_validation->set_rules ( 'end_date', 'lang:end_date', 'required' );
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
					if(empty($diff) && $error == 0){
						$order_service_guid = get_guid ( $this->order_table, 'order_service_guid' );
						$order_service_image = post_value('cover_photo');
						$end_date = date('Y-m-d',strtotime(post_value('end_date')));
						$start_date = date('Y-m-d',strtotime(post_value('start_date')));
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
							'order_service_title' => $service['ser_title'],
							'order_service_provider_id' => $service['ser_title'],
							'order_service_slug' => $service['ser_title'],
							'order_service_price' => $price,
							'order_service_start_date' => $start_date,
							'order_service_end_date' => $end_date,
							'order_service_image' => $order_service_image,
							'order_service_is_paid' => 0,
							'order_service_address_line1' => post_value ( 'address_line1' ),
							'order_service_address_line2' => post_value ( 'address_line2' ),
							'order_service_city' => post_value ( 'customer_city' ),
							'order_service_state' => post_value ( 'customer_state' ),
							'order_service_zipcode' => post_value ( 'zipcode' ),
							'order_service_landmark' => post_value ( 'landmark' ),
							'order_service_customer_id' => get_user_id(),
							'order_service_created_on' => current_date (),
							'order_service_created_ip' => get_ip ()
						);
						
						$insert_id = $this->Mydb->insert ( $this->order_table, $insert_array );
						if($insert_id) {
							//send mail and notification with success message
							$result ['status'] = 'success';
							$this->session->set_flashdata ( 'admin_success', sprintf ( $this->lang->line ( 'success_message_ordered' ), $this->module_label ) );
						}
					} else {
						$result ['status'] = 'error';
						$result ['message'] = "The Service is unavailable for certain days or cities";
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
	/* this method used to common module labels */
	private function load_module_info() {
		$data = array ();
		$data ['module_label'] = $this->module_label;
		$data ['module_labels'] = $this->module_labels;
		$data ['module'] = $this->module;
		return $data;
	}
}
