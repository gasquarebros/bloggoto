<?php
/**************************
Project Name	: BlogGotoWeb
Created on		: 27 Nov, 2017
Last Modified 	: 27 Nov, 2017
Description		: Page contains frontend panel login and forgot password functions.

***************************/
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Products extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		//$this->authentication->user_authentication();
		$this->module = "products";
		$this->module_label = get_label('products_module_label');
		$this->module_labels = get_label('products_module_label');
		$this->folder = "products/";
		$this->table = "products";
		$this->product_gallery = "product_gallery";
		$this->customers = "customers";
		$this->product_categorytable = "product_categories";
		$this->primary_key='product_primary_id';
		$this->load->library('common');
	}
	
	/* this method used to check login */
	public function index() {
		
		//echo "inn"; exit;
		$data = $this->load_module_info ();	
		$product_category = $this->Mydb->get_all_records('*',$this->product_categorytable,array('pro_cate_status' => 'A'));
		if(!empty($product_category))
		{
			foreach($product_category as $procat)
			{
				$category[$procat['pro_cate_id']] = $procat['pro_cate_name'];
			}
		}
		$data['product_category'] = $category;
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
		$where = array('product_status'=>'A');
		/* Search part start */
		
		if (post_value ( 'paging' ) == "") {
			$search_field = post_value ( 'search_field' );
			$type = post_value ( 'type' );
			$order_field = post_value ( 'order_field' );
		}
		
		/*
		if ($search_field !='') {
			$like = array (
					get_session_value ( $this->module . "_search_field" ) => $search_field 
			);
		}*/
		
		if ($search_field != "") {
			$where = array_merge ( $where, array (
					"product_category_id" => $search_field 
			));
		}
		
		if ($type != "") {
			$where = array_merge ( $where, array (
					"product_category_id" => $type 
			));
		}
		
		/* add sort bu option */
		/*if ($order_field != "") {
			$order_by = array (get_session_value ( $this->module . "_order_by_field" )  => (get_session_value ( $this->module . "_order_by_value" ) == "ASC")? "ASC" : "DESC" );
		}*/
		
		$join = "";
		$join [0] ['select'] = "pro_cate_primary_id,pro_cate_id,pro_cate_name";
		$join [0] ['table'] = $this->product_categorytable;
		$join [0] ['condition'] = "pro_cate_id = product_category_id";
		$join [0] ['type'] = "LEFT";
		/*
		$join [1] ['select'] = "customer_id,customer_first_name,customer_last_name,customer_email";
		$join [1] ['table'] = $this->customers;
		$join [1] ['condition'] = "product_customer_id = customer_id";
		$join [1] ['type'] = "LEFT";*/
		/*
		$join [2] ['select'] = "group_concat(',',post_tag_user_id) as post_tag_ids,group_concat(',',post_tag_user_name) as post_tag_names";
		$join [2] ['table'] = $this->post_tags;
		$join [2] ['condition'] = "post_tag_post_id = post_id";
		$join [2] ['type'] = "LEFT";*/
		/* not in product availability id condition  */
		$groupby = $this->primary_key;
	    $totla_rows = $this->Mydb->get_num_join_rows ( $this->primary_key, $this->table, $where, null, null, null, $like, $groupby, $join  );
		
		
		$limit = 12;
		$page = post_value ( 'page' )?$post_value ( 'page' ):1;
		$offset = post_value ( 'page' )?((post_value ( 'page' )-1) * $limit):0;
		$offset = post_value ( 'offset' )?post_value ( 'offset' ):$offset;
		$next_offset = $offset+$limit;
		$next_set = ($totla_rows > $next_offset)?($offset+$limit):'';
		
		
		
		$data['offset'] = $offset;
		$select_array = array ($this->table.'.*');
		$data ['records'] = $this->Mydb->get_all_records ( $select_array, $this->table, $where, $limit, $offset, $order_by, $like, $groupby, $join );
		
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
			$where = "product_slug = '".$slug."'";
			$like = array ();
			
			$order_by = array (
					$this->primary_key => 'DESC' 
			);
			$join = "";
			$join [0] ['select'] = "pro_cate_primary_id,pro_cate_id,pro_cate_name";
			$join [0] ['table'] = $this->product_categorytable;
			$join [0] ['condition'] = "pro_cate_id = product_category_id";
			$join [0] ['type'] = "LEFT";
			
			$join [1] ['select'] = "customer_id,customer_first_name,customer_last_name,customer_email,customer_photo";
			$join [1] ['table'] = $this->customers;
			$join [1] ['condition'] = "product_customer_id = customer_id";
			$join [1] ['type'] = "LEFT";
			
			$join [2] ['select'] = "group_concat(',',pro_gallery_image) as product_images";
			$join [2] ['table'] = $this->product_gallery;
			$join [2] ['condition'] = "pro_gallery_product_primary_id = ".$this->primary_key;
			$join [2] ['type'] = "LEFT";

			$groupby = $this->primary_key;

			$select_array = array ($this->table.'.*');
			$records = $this->Mydb->get_all_records ( $select_array, $this->table, $where, '', '', $order_by, $like, $groupby, $join );
			$data ['records'] = $records;
			$this->layout->display_site ( $this->folder . $this->module . "-view", $data );
		}
		else
		{
			
		}
	}
	

	public function add_to_cart()
	{
		echo json_encode(array('status'=>'ok','cartreplace_html'=>1));
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
