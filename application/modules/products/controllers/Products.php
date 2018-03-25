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
		$userid = get_user_id();
		check_site_ajax_request();
		if($userid !='')
		{
			$this->form_validation->set_rules ( 'reference_id', 'lang:rest_customer_id_required', 'trim|callback_validate_cutomer' );
			$this->form_validation->set_rules ( 'product_name', 'lang:rest_product_name', 'trim|required' );
			$this->form_validation->set_rules ( 'product_sku', 'lang:rest_product_sku', 'required' );
			$this->form_validation->set_rules ( 'product_qty', 'lang:rest_product_cart_qty', 'trim|required' );
			$this->form_validation->set_rules ( 'product_unit_price', 'lang:rest_product_unit_price', 'trim|required' );
			$this->form_validation->set_rules ( 'product_total_price', 'lang:rest_product_total_price', 'trim|required' );
			if ($this->form_validation->run () == TRUE) {
				
				/* post values */
				$reference_id = $this->post ( 'reference_id' ); /* mobile device id or browser session id */
				$customer_id = $this->post ( 'customer_id' );
				$product_id = $this->post ( 'product_id' );
				$product_price = $this->post ( 'product_total_price' );
				$product_qty = $this->post ( 'product_qty' );
				
				/* validate product */
				$products = $this->validate_product ($product_id);
				$user_where = ($reference_id == "") ? array (
						'cart_customer_id' => $customer_id 
				) : array (
						'cart_session_id' => $reference_id 
				);
				
				$cart_exists = $this->Mydb->get_record ( 'cart_id', 'cart_details', array_merge ( array (
						'cart_app_id' => $app_id,
						'cart_availability_id' => $avilablity_id 
				), $user_where ) );
				
				if (empty ( $cart_exists )) {

					/* Add new cart details */
					//$delivery_charge = $this->get_delivery_charge( $avilablity_id, $delivery_charge ); /* if set delivery charge only delivery products.. */
					$delivery_charge = 0;
					$sub_total = $product_price;
					$grand_total = $sub_total + $delivery_charge;
				
					$cart = array (
						'cart_customer_id' => $customer_id,
						'cart_session_id' => $reference_id,
						'cart_total_items' => $product_qty,
						'cart_delivery_charge' => $delivery_charge,
						'cart_sub_total' => $product_price,
						'cart_grand_total' => $grand_total,
						'cart_created_on' => current_date (),
						'cart_created_ip' => get_ip () 
					);
					
					$insert_id = $this->Mydb->insert ( 'cart_details', $cart );
				}
				
				$cart_unique_id = (! empty ( $cart_exists )) ? $cart_exists ['cart_id'] : $insert_id;
				/* insert cart products.. */
				if ($cart_unique_id != "") {
					
						
					$simple_items = $this->Mydb->get_record ( 'cart_item_id,cart_item_cart_id', 'cart_items', array (
							'cart_item_cart_id' => $cart_unique_id,
							'cart_item_type' => 'Simple',
							'cart_item_product_id' => $product_id,
							'cart_item_special_notes' =>  (trim($this->post ( 'product_remarks' ))=="" ? "" : trim($this->post ( 'product_remarks' ))) 
					) );
					
					if (empty ( $simple_items )  ) {
						$result = $this->insert_cart_items ( $cart_unique_id, $_POST); /* insert cart items */
					} else {
						$result = $this->update_cart_items ( $simple_items ['cart_item_id'], $_POST, $simple_items ['cart_item_cart_id']);
					}
				}
				else {
					$result['status']  = "error";
					$result['message'] = "Something Went Wrong, Try again later";
				}
			} else {
				
				$result['status']  = "error";
				$result['message'] = get_label ( 'rest_form_error' );
				$result['form_error'] = validation_errors ( );
			}	
		}
		else
		{
			$result['status'] = "failed";
			$result['redirect_url'] = base_url();
		}
		echo json_encode($result);
	}
	
	
	/* this method used to insert cart items */
	private function insert_cart_items($cart_unique_id, $post_arary) {
		$_POST = $post_arary;
		$cart_unique_id = $cart_unique_id;
		$reference_id = $this->post ( 'reference_id' ); /* mobile device id or browser session id */
		$customer_id = $this->post ( 'customer_id' );
		$product_id = $this->post ( 'product_id' );
		$product_price = $this->post ( 'product_total_price' );
		$product_qty = $this->post ( 'product_qty' );
		$product_remarks = ($this->post ( 'product_remarks' )!="")?$this->post('product_remarks'):"";
		
		$cart_items = array (
				'cart_item_customer_id' => $customer_id,
				'cart_item_session_id' => $reference_id,
				'cart_item_cart_id' => $cart_unique_id,
				'cart_item_product_id' => $product_id,
				'cart_item_product_name' => addslashes ( $this->post ( 'product_name' ) ),
				'cart_item_product_sku' => addslashes ( $this->post ( 'product_sku' ) ),
				'cart_item_product_image' => addslashes ( $this->post ( 'product_image' ) ),
				'cart_item_qty' => $product_qty,
				'cart_item_unit_price' => $this->post ( 'product_unit_price' ),
				'cart_item_total_price' => $this->post ( 'product_total_price' ),
				'cart_item_created_on' => current_date (),
				'cart_item_special_notes' => $product_remarks,  
		);
		
		$cart_item_id = $this->Mydb->insert ( 'cart_items', $cart_items );
		
		
		
		/* get catr details */
		$contents = $this->contents_get ( $reference_id, $customer_id, 'callback' );
		
		return $return_array = array (
				'status' => "ok",
				'contents' => $contents,
				'cart_item_id' => $cart_item_id,
				'message' => get_label ( 'rest_product_added' ) 
		);
	}

	/* this method used to update cart items */
	private function update_cart_items($eqaul_cart_id, $post_arary, $cart_id, $time) {

		$_POST = $post_arary;
		$reference_id = $this->post ( 'reference_id' ); /* mobile device id or browser session id */
		$customer_id = $this->post ( 'customer_id' );
		$product_qty = $this->post ( 'product_qty' );
		$item_details = $this->Mydb->get_record ( array (
				'cart_item_qty',
				'cart_item_total_price',
				'cart_item_id',
				'cart_item_unit_price' 
		), 'cart_items', array (
				'cart_item_id' => $eqaul_cart_id 
		) );

		
		if (! empty ( $item_details )) {
			$new_qty = $product_qty + $item_details ['cart_item_qty'];
			$new_total_amount = $new_qty * $item_details ['cart_item_unit_price'];
			$this->Mydb->update ( 'cart_items', array (
					'cart_item_id' => $eqaul_cart_id 
			), array (
					'cart_item_qty' => $new_qty,
					'cart_item_total_price' => $new_total_amount 
			) );
			
			
			$contents = $this->contents_get ( $reference_id, $customer_id, 'callback' );
			
			return $return_array = array (
					'status' => "ok",
					'contents' => $contents,
					'cart_item_id' => $eqaul_cart_id,
					'message' => get_label ( 'rest_product_added' ) 
			);
		}
	}
	
	/* this function used to get cart details */
	public function contents_get($reference_id = null, $customer_id = null, $returndata = "") {
		$productlead=array();	
		$maxs=0;

		$reference_id = ($reference_id == "" ? $this->get ( 'reference_id' ) : $reference_id); /* mobile device id or browser session id */

		$customer_id = ($customer_id != "" ? $customer_id : $this->get ( 'customer_id' ));

		/* validate customer id */
		$customer_array = ($reference_id == "" ? array (
				'cart_customer_id' => $customer_id 
		) : array (
				'cart_session_id' => $reference_id 
		));

		$cart_details = $this->Mydb->get_record ( '*', 'cart_details', $customer_array, array (
				'cart_id' => 'DESc' 
		) );

		if (! empty ( $cart_details )) {

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
					'cart_item_added_condiment',
					'cart_item_special_notes', 
			);
			$all_items = $this->Mydb->get_all_records ( $select, 'cart_items', array (
					'cart_item_cart_id' => $cart_details ['cart_id'] 
			) );
			$fianl = array ();
			if (! empty ( $all_items )) {

				$response ['cart_details'] = $cart_details;
				$response ['cart_items'] = $all_items;
				if ($returndata == "callback") {
					return $response;
				} else {
					return array (
						'status' => "ok",
						'result_set' => $response 
					);
				}
			}
		} else {
			return array (
					'status' => "ok",
					'message' => get_label ( 'rest_cart_empty' ) 
			);
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
