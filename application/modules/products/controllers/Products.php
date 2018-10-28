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
		$this->product_subcategorytable = "product_subcategories";
		$this->primary_key='product_primary_id';
		$this->load->library('common');
		$this->load->helper('products');
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

		$product_subcategory = $this->Mydb->get_all_records('*',$this->product_subcategorytable,array('pro_subcate_status' => 'A'));
		if(!empty($product_subcategory))
		{
			foreach($product_subcategory as $procat)
			{
				$subcategory[$procat['pro_subcate_id']] = $procat['pro_subcate_name'];
			}
		}
		$data['product_subcategory'] = $subcategory;
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
		$where = array('product_status'=>'A','product_is_display'=>1);
		/* Search part start */
		
		if (post_value ( 'paging' ) == "") {
			$search_field = post_value ( 'search_field' );
			$type = post_value ( 'type' );
			$order_field = post_value ( 'order_field' );
		}

		$cat = post_value ( 'type' );
		$subcat = post_value('subcat');
		$price_range_from = post_value ( 'price_from' );
		$price_range_end = post_value('price_end');
		$sortby = post_value('sortby');
		$search = post_value('search');
		/*
		if ($search_field !='') {
			$like = array (
					get_session_value ( $this->module . "_search_field" ) => $search_field 
			);
		}*/
		
		if ($search != "") {
			$like = array (
				'product_name' => $search 
			);
		}
		
		if ($cat != "" && $cat != 'undefined') {
			$where = array_merge ( $where, array (
				"product_category_id" => $cat 
			));
		}

		if ($subcat != "" && $subcat != 'undefined') {
			$where = array_merge ( $where, array (
				"product_subcategory_id" => $subcat 
			));
		}

		if ($price_range_from != "" && $price_range_from != 'undefined') {
			$where = array_merge ( $where, array (
				"product_price >=" => $price_range_from 
			));
		}

		if ($price_range_end != "" && $price_range_end != 'undefined') {
			$where = array_merge ( $where, array (
				"product_price <=" => $price_range_end 
			));
		}

		if($sortby !='' && $sortby == 'price-low')
		{
			$order_by = array (
				'product_price' => 'ASC' 
			);
		} else if($sortby !='' && $sortby == 'price-high')
		{
			$order_by = array (
				'product_price' => 'DESC' 
			);
		} else if($sortby !='' && $sortby == 'asc')
		{
			$order_by = array (
				'product_name' => 'ASC' 
			);
		} else if($sortby !='' && $sortby == 'desc')
		{
			$order_by = array (
				'product_name' => 'DESC' 
			);
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
		
		$join [1] ['select'] = "customer_id,customer_first_name,customer_last_name,customer_username,customer_email";
		$join [1] ['table'] = $this->customers;
		$join [1] ['condition'] = "product_customer_id = customer_id";
		$join [1] ['type'] = "LEFT";
		/*
		$join [2] ['select'] = "group_concat(',',post_tag_user_id) as post_tag_ids,group_concat(',',post_tag_user_name) as post_tag_names";
		$join [2] ['table'] = $this->post_tags;
		$join [2] ['condition'] = "post_tag_post_id = post_id";
		$join [2] ['type'] = "LEFT";*/
		/* not in product availability id condition  */
		$groupby = $this->primary_key;
	    $totla_rows = $this->Mydb->get_num_join_rows ( $this->primary_key, $this->table, $where, null, null, null, $like, $groupby, $join  );
		
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
			
			$join [1] ['select'] = "customer_id,customer_first_name,customer_last_name,customer_email,customer_photo,customer_username";
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

			$data ['gallery_images'] = $this->Mydb->get_all_records ( 'pro_gallery_image,pro_gallery_primary_id', 'product_gallery', array (
				'pro_gallery_product_primary_id' => $records[0] [$this->primary_key] 
			) );
			
			
			/*get shipping methods*/
			$join = "";
			$join [0] ['select'] = "ship_method_name,ship_method_status";
			$join [0] ['table'] = "shipping_methods";
			$join [0] ['condition'] = "ship_method_id = prod_ass_ship_method_shipid";
			$join [0] ['type'] = "INNER";
			$data ['assigned_shipping'] = $this->Mydb->get_all_records ( 'product_assigned_shipping_methods.*', 'product_assigned_shipping_methods', array (
				'prod_ass_ship_method_prodid' => $records[0][$this->primary_key],'ship_method_status'=>'A' 
			) ,'', '', '', '', '',$join);
			
			if($records[0]['product_type'] == 'attribute') {
				
				$join = "";
			
				$join [0] ['select'] = "pro_modifier_primary_id,pro_modifier_id,pro_modifier_name,pro_modifier_display";
				$join [0] ['table'] = "product_modifiers";
				$join [0] ['condition'] = "pro_modifier_id = prod_ass_att_attribute_id";
				$join [0] ['type'] = "INNER";
				/* not in product availability id condition  */
				$join [1] ['select'] = "group_concat(pro_modifier_value_primary_id) as value_primary_id,group_concat(pro_modifier_value_id) as value_id,group_concat(pro_modifier_value_name) as value_name,group_concat(pro_modifier_value_image) as value_images";
				$join [1] ['table'] = "product_modifier_values";
				$join [1] ['condition'] = "pro_modifier_value_modifier_id = prod_ass_att_attribute_id";
				$join [1] ['type'] = "LEFT";	

				
				$groupby = "pro_modifier_value_modifier_primary_id";
				$select_array = array (
					'*',  
				);
				$where = array("assigned_mod_product_id"=>$records[0][$this->primary_key]);
				/*
				$assigned_modifiers = $this->Mydb->get_all_records ( 'assigned_mod_modifier_id,assigned_mod_product_id', 'product_assigned_modifiers', $where, '', '' ,'' ,'',array('assigned_mod_product_id','assigned_mod_modifier_id') );
				
				$selected_modifiers = array();
				if(!empty($assigned_modifiers)) {
					foreach($assigned_modifiers as $selmodifier) {
						$selected_modifiers[] = $selmodifier['assigned_mod_modifier_id'];
					}
				}
				
				$data['assigned_modifiers'] = $selected_modifiers;*/
				
				/*get_assigned_associate_products*/
				$data ['assigned_associate_attributes'] = $this->Mydb->get_all_records ( 'product_assigned_attributes.*', 'product_assigned_attributes', array (
					'prod_ass_att_parent_productid' => $records[0][$this->primary_key] 
				) ,'', '', '', '',array('pro_modifier_id'),$join);
//echo $this->db->last_query();
				/*$data ['assigned_products'] = $this->Mydb->get_all_records ( '*', 'products', array (
					'product_parent_id' => $records[0][$this->primary_key] 
				) );*/
			}
			
			//echo "<pre>"; print_r($data); exit;
			$this->layout->display_site ( $this->folder . $this->module . "-views", $data );
		}
		else
		{
			redirect(base_url().'products');	
		}
	}

	public function getattributecombination() {
		
		check_site_ajax_request();
		$data = $this->load_module_info ();
		$like = array ();
		
		$order_by = array (
				$this->primary_key => 'DESC' 
		);
		$where = array('product_status'=>'A');
		/* Search part start */
		$params = $response = array();
		$status= "failed";
		if($_POST['selectionid'] !='')
		{
			$productid = decode_value($_POST['selectionid']);
			$selected_attributes = $_POST['selected_attribute_values'];
			//print_r($selected_attributes);
			if(!empty($selected_attributes))
			{
				foreach($selected_attributes as $choosedattributes)
				{
					$sel_attribute_id = str_replace('sku-','',$choosedattributes['selectionid']);
					$sel_attribute_value_id = ($choosedattributes['selectionvalue'])?$choosedattributes['selectionvalue']:'';
					
					$atrributes[] =array('attribute_id'=>$sel_attribute_id,'attribute_value'=>$sel_attribute_value_id);
				}
			}
			$params['attributes'] = $atrributes;
			$params['productid'] = $productid;

			$combinations = $this->actionProductcombination($params);

			if(!empty($combinations))
			{
				$status = $combinations['status'];
				$response = $combinations['data'][0];
			}
			echo json_encode ( array (
					'status' => $status,
					'response' => $response,
			) );
			//return json_encode(array('status'=>$status,'response'=>$response));
		}
		else{
			return $this->redirect(['index']);
		}
	}


	public function actionProductcombination($filters)
	{
		//echo "<pre>"; print_r($filters);
		$records = array();
		$records[]= array('message'=>"Invalid Combination");
		$status = "error";
		//$filters = Yii::$app->request->get('filter');
		$get_sub_product ='yes';
		$sel_where = '';
		$attributes = $filters['attributes'];
		$source = (isset($filters['source']))?$filters['source']:'';
		if($source == 'mobile')
		{
			$attributes = json_decode($attributes,true);
		}
		$groupby = array('prod_ass_att_product_id');
		if(!empty($attributes) && $filters['productid'] !='')
		{
			$selected_attributes = array();
			foreach($attributes as $selattribute)
			{
				if($selattribute['attribute_value'] !='')
				{
					$selected_attributes[$selattribute['attribute_id']] = $selattribute['attribute_value'];
					if($sel_where !='')
					{
						$sel_where.=" OR ";
					}
					$sel_where .= "(prod_ass_att_attribute_id = '".$selattribute['attribute_id']."' AND prod_ass_att_attribute_value_id = '".$selattribute['attribute_value']."')";
				}
			}
//echo "selwhere = ".$sel_where;
			if(!empty($selected_attributes))
			{
				if(count($attributes) == count($selected_attributes))
				{
					$where = "prod_ass_att_parent_productid = '".$filters['productid']."'";
					if($sel_where !='')
					{
						$where .= " AND (".$sel_where.")";
					}
					$join = '';
					$join [0] ['select'] = "products.*";
					$join [0] ['table'] = "products";
					$join [0] ['condition'] = "product_primary_id = prod_ass_att_product_id";
					$join [0] ['type'] = "INNER";
					/* not in product availability id condition  */
					/*$join [1] ['select'] = "group_concat(pro_modifier_value_primary_id) as value_primary_id,group_concat(pro_modifier_value_id) as value_id,group_concat(pro_modifier_value_name) as value_name,group_concat(pro_modifier_value_image) as value_images";
					$join [1] ['table'] = "product_modifier_values";
					$join [1] ['condition'] = "pro_modifier_value_id = prod_ass_att_attribute_value_id";
					$join [1] ['type'] = "LEFT";*/	
					$this->db->having('recordcount',count($selected_attributes), false);
					$products = $this->Mydb->get_all_records ( 'count(product_primary_id) as recordcount,product_assigned_attributes.*', 'product_assigned_attributes', $where ,'', '', $order_by='', $like='', $groupby, $join);
				//echo $this->db->last_query();
					/*$query = ProductAttributes::find()->select('count(prod_ass_att_product_id ) as attributecount, product_assigned_attributes.prod_ass_att_product_id,products.*')->joinWith(['prodAssAttProduct','prodAssAttProduct.productsGalleries'])->where(['and', $where])->groupBy($groupby)->having("attributecount = :count", [":count" => count($selected_attributes)]);
					//echo $query->createCommand()->getRawSql();
					$products = $query->all();*/
					if(!empty($products))
					{
						$product = $products[0];
						if(!empty($product))
						{
							$product_image = '';
							$records = array();
							$status ="success";
						
							$product_special_from_date = ($product['product_special_price_from_date'] !='' && $product['product_special_price_from_date'] !='0000-00-00 00:00:00')?date('Y-m-d',strtotime($product['product_special_price_from_date'])):'';
							$product_special_to_date = ($product['product_special_price_to_date'] !='' && $product['product_special_price_to_date'] !='0000-00-00 00:00:00')?date('Y-m-d',strtotime($product['product_special_price_to_date'])):'';
						
							$discount_percent = 0;
							if($product['product_special_price'] !='')
							{
								$discount_percent = find_discount($product['product_price'],$product['product_special_price'],$product_special_from_date,$product_special_to_date);
							}
							/*
							if(!empty($product['productsGalleries']))
							{
								$product_image = Url::base(Yii::$app->params['server_scheme']).Yii::$app->params['thumb_prod_img_350'].$product['productsGalleries'][0]['prod_gallery_image_name'];
							}*/		
							$records[] = array('id'=>$product['product_primary_id'],'name'=>$product['product_name'],'product_slug'=>$product['product_slug'],'product_description'=>$product['product_long_description'],'product_short_description'=>$product['product_short_description'],'product_price'=>$product['product_price'],'product_special_price'=>$product['product_special_price'],'product_special_from_date'=>$product_special_from_date,'product_special_to_date'=>$product_special_to_date,'discount_percent'=>$discount_percent,'product_qty'=>$product['product_quantity'],'product_image'=>$product_image);
						}
					} 		
					// get the sub product entry prices and its info
				}
				else
				{
					$where = "prod_ass_att_parent_productid = ".$filters['productid'];
					if($sel_where !='')
					{
						$where .= " AND (".$sel_where.")";
					}
					$query = ProductAttributes::find()->select('count(prod_ass_att_product_id ) as attributecount, product_assigned_attributes.prod_ass_att_product_id')->where(['and', $where])->groupBy($groupby)->having("attributecount = :count", [":count" => count($selected_attributes)]);
					//echo $query->createCommand()->getRawSql();
					//exit;
					$products = $query->all();
					if(!empty($products))
					{
						foreach($products as $product)
						{
							$associate_product[]= $product['prod_ass_att_product_id'];
						}
						$subwhere = "prod_ass_att_product_id in (".implode(',',$associate_product).")";
						$subproducts_attributes_options = ProductAttributes::find()->joinWith(['prodAssAttAttribute','prodAssAttAttributeValue'])->where($subwhere);
						//echo $subproducts_attributes_options->createCommand()->getRawSql();
						$subproducts_attributes_options = $subproducts_attributes_options->all();
						$options = array();
						if(!empty($subproducts_attributes_options))
						{
							foreach($subproducts_attributes_options as $suboptions)
							{
								$prod_attributes = $suboptions->prodAssAttAttribute;
								if(empty($options[$prod_attributes['attribute_id']]))
								{
									$options[$prod_attributes['attribute_id']] = array('attribute_id'=>$prod_attributes['attribute_id'],'attribute_name'=>$prod_attributes['attribute_name'],'attribute_display'=>$prod_attributes['attribute_display'],'attribute_values'=>array());
								}
								
								$prod_attributes_values = $suboptions->prodAssAttAttributeValue;
								if(isset($options[$prod_attributes_values['value_attribute_id']]) && !empty($options[$prod_attributes_values['value_attribute_id']]))
								{
									$options[$prod_attributes_values['value_attribute_id']]['attribute_values'][$prod_attributes_values['value_id']] = array('value_id'=>$prod_attributes_values['value_id'],'value_name'=>$prod_attributes_values['value_name'],'value_image'=>$prod_attributes_values['value_image']);
								}
							}
							
							$final_available_options = array();
							$i=0;
							foreach($options as $opt)
							{
								$final_available_options[$opt['attribute_name']] = $opt;
								$final_available_options[$opt['attribute_name']]['attribute_values'] = array_values($opt['attribute_values']);
								$i++;
							}
							$status="success";
							//$records = array();
							$records = array('availableoptions'=>$final_available_options);
						}
					}
					
					// get the combination of the attributes for the selected attributes
					
				}
			}
			else{
				// get all attribute for the main product section
			}
		}
		return [
			'status' =>$status,
			'data'=>$records,
		];
	}

	private function validate_product($productid,$subproductid=null){
		$join = '';
		$join [0] ['select'] = "customers.*";
		$join [0] ['table'] = "customers";
		$join [0] ['condition'] = "customer_id = product_customer_id";
		$join [0] ['type'] = "INNER";
		if($subproductid !=''){
			$where = array('product_id'=>$subproductid);
		} else {
			$where = array('product_primary_id'=>decode_value($productid));
		}
		return $this->Mydb->get_join_record ( $this->table.'.*', $this->table, $where,'',$join);
	}
	
	

	public function add_to_cart()
	{
		$userid = get_user_id();
		check_site_ajax_request();
		if($userid !='')
		{
			//$this->form_validation->set_rules ( 'reference_id', 'lang:rest_customer_id_required', 'trim|callback_validate_cutomer' );
			//$this->form_validation->set_rules ( 'product_name', 'lang:rest_product_name', 'trim|required' );
			//$this->form_validation->set_rules ( 'product_sku', 'lang:rest_product_sku', 'required' );
			$this->form_validation->set_rules ( 'product_qty', 'lang:rest_product_cart_qty', 'trim|required' );
			$this->form_validation->set_rules('productid','lang:product_id','required');
			$this->form_validation->set_rules('shipping_method','lang:shipping_method','trim|required');
			//$this->form_validation->set_rules ( 'product_unit_price', 'lang:rest_product_unit_price', 'trim|required' );
			//$this->form_validation->set_rules ( 'product_total_price', 'lang:rest_product_total_price', 'trim|required' );
			if ($this->form_validation->run () == TRUE) {
				
				/* post values */
				$reference_id = $customer_id = $userid; /* mobile device id or browser session id */
				$product_id = $this->input->post ( 'productid' );
				$product_price = $this->input->post ( 'product_total_price' );
				$product_qty = $this->input->post ( 'product_qty' );
				//echo "<pre>"; print_r($_POST); 
				/* validate product */
				
				$products = $this->validate_product($product_id,$this->input->post('subproduct'));

				if(!empty($products)) {
					$shipping_method_assigned = array();
					$shipping = explode('--',$this->input->post('shipping_method'));
					$products['assigned_shipping'] = array();
					$delivery_charge = 0;
					$product_price_info = $this->get_product_price($products);
					$product_price = $product_price_info['product_current_price'];
					if(count($shipping) == 2)
					{
						$shipping_id = decode_value($shipping[0]);
						$shipping_method_assigned = $this->Mydb->get_record ( '*', 'product_assigned_shipping_methods', array('prod_ass_ship_method_shipid'=>$shipping_id,'prod_ass_ship_method_prodid'=>decode_value($product_id)));

						$products['assigned_shipping'] = $shipping_method_assigned;

						if(!empty($shipping_method_assigned)) {
							$shipping_option = array('shipping_id'=>$shipping_id,'shipping_name'=>$shipping[1],'shipping_method_price'=>$shipping_method_assigned['prod_ass_ship_method_price']);
							$delivery_charge = $shipping_method_assigned['prod_ass_ship_method_price'];
						}
					}
					$subproduct_selection_name = '';
					$product_id = $this->input->post ( 'productid' );
					$product_quantity = $this->input->post ( 'product_qty' );
					$user_where = ($reference_id == "") ? array (
						'cart_customer_id' => $customer_id 
					) : array (
						'cart_session_id' => $reference_id 
					);
					
					$cart_exists = $this->Mydb->get_record ( 'cart_id,cart_delivery_charge,cart_sub_total,cart_grand_total', 'cart_details', $user_where );
					
					if (empty ( $cart_exists )) {
						$delivery_charge = $cart_exists['cart_delivery_charge'] + $delivery_charge;
						$sub_total = $product_price;
						$grand_total = $sub_total + $delivery_charge;
						$cart = array (
							'cart_customer_id' => $customer_id,
							'cart_session_id' => $reference_id,
							'cart_total_items' => $product_quantity,
							'cart_delivery_charge' => $delivery_charge,
							'cart_sub_total' => $sub_total,
							'cart_grand_total' => $grand_total,
							'cart_created_on' => current_date (),
							'cart_created_ip' => get_ip () 
						);
						
						$insert_id = $this->Mydb->insert ( 'cart_details', $cart );
						
					} else {
						$delivery_charge = $cart_exists['cart_delivery_charge'] + $delivery_charge;
						$sub_total = $cart_exists['cart_sub_total'] + $product_price;
						$grand_total =  $sub_total + $delivery_charge;
						$up_data = array(
							'cart_delivery_charge' => $delivery_charge,
							'cart_sub_total' => $sub_total,
							'cart_grand_total' => $grand_total,
						);
						$this->Mydb->update('cart_details',array('cart_id'=>$cart_exists['cart_id']),$up_data);
						//echo $this->db->last_query();
						//exit;
					}
					$cart_unique_id = (! empty ( $cart_exists )) ? $cart_exists ['cart_id'] : $insert_id;
					
					if ($cart_unique_id != "") {
						
						if($this->input->post('subproduct') !=''){
							$where = array('cart_item_cart_id'=>$cart_unique_id,'cart_item_subproduct_id'=>$products['product_primary_id']);
						} else {
							$where = array('cart_item_cart_id'=>$cart_unique_id,'cart_item_product_id'=>$products['product_primary_id']);
						}
						$simple_items = $this->Mydb->get_record ( 'cart_item_id,cart_item_cart_id', 'cart_items', $where );
						//echo $this->db->last_query();
							
						if (empty ( $simple_items )  ) {

							$shipping_option['cartid'] = $cart_unique_id;
							$insert_shipping_id = $this->Mydb->insert ( 'cart_item_shipping', $shipping_option );

							$products['assigned_shipping']['insert_shipping_id'] = $insert_shipping_id;

							$result = $this->insert_cart_items( $cart_unique_id, $_POST,$products); 

						} else {

							$result = $this->update_cart_items ( $simple_items ['cart_item_id'], $_POST, $simple_items ['cart_item_cart_id'],$products);

						}
					}
					else {
						$result['status']  = "error";
						$result['message'] = "Something Went Wrong, Try again later";
					}
				} else{
					$result['status']  = "error";
					$result['message'] = "Invalid Product";
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

	/* this function used to insert product modifier information */
	private function _insert_item_modifier($cart_item_id, $modifiers, $cart_id) {

		$join = "";
		$join [0] ['select'] = "product_assigned_attributes.*";
		$join [0] ['table'] = "product_assigned_attributes";
		$join [0] ['condition'] = "prod_ass_att_product_id = product_primary_id";
		$join [0] ['type'] = "INNER";

		$join [1] ['select'] = "product_modifiers.*";
		$join [1] ['table'] = "product_modifiers";
		$join [1] ['condition'] = "pro_modifier_id = product_assigned_attributes.prod_ass_att_attribute_id";
		$join [1] ['type'] = "LEFT";

		$join [2] ['select'] = "product_modifier_values.*";
		$join [2] ['table'] = "product_modifier_values";
		$join [2] ['condition'] = "pro_modifier_value_id = product_assigned_attributes.prod_ass_att_attribute_value_id";
		$join [2] ['type'] = "LEFT";

		$where = array('product_id' => $this->input->post('subproduct'));
		$modifiers_section = $this->Mydb->get_all_records ( $this->table.'.*', $this->table, $where, '', '', '', '','', $join );
		$modifiers_insert = array();
		if(!empty($modifiers_section)){
			foreach($modifiers_section as $modifierselection){
				$modifiers_insert[] = array(
					'cartid' => $cart_id,
					'itemid' => $cart_item_id,
					'attribute_id' => $modifierselection['pro_modifier_id'],
					'attribute_name' => $modifierselection['pro_modifier_name'],
					'attribute_value_id' => $modifierselection['pro_modifier_value_id'],
					'attribute_value_name' => $modifierselection['pro_modifier_value_name'],
					'attribute_value_image' => $modifierselection['pro_modifier_value_image']
				);
			}
		}

		if(!empty($modifiers_insert)){
			$this->db->insert_batch('pos_cart_attributes',$modifiers_insert);
		}
		return true;
	}

	private function get_product_price($products)
	{
		$discount_percent = 0;
		$product_special_from_date = ($products['product_special_price_from_date'] !='' && $products['product_special_price_from_date'] !='0000-00-00 00:00:00')?date('Y-m-d',strtotime($products['product_special_price_from_date'])):'';
		$product_special_to_date = ($products['product_special_price_to_date'] !='' && $products['product_special_price_to_date'] !='0000-00-00 00:00:00')?date('Y-m-d',strtotime($products['product_special_price_to_date'])):'';
		if($products['product_special_price'] !='')
		{
			$discount_percent = find_discount($products['product_price'],$products['product_special_price'],$product_special_from_date,$product_special_to_date);
		}
		if($discount_percent > 0){
			$product_current_price = $products['product_special_price'];
		} else { 
			$product_current_price = $products['product_price']; 
		}
		return array('product_current_price'=>$product_current_price,'discount_percent'=>$discount_percent);
	}
	
	
	/* this method used to insert cart items */
	private function insert_cart_items($cart_unique_id, $post_arary,$products) {
		$_POST = $post_arary;
		$cart_unique_id = $cart_unique_id;
		$reference_id = $this->input->post ( 'reference_id' ); /* mobile device id or browser session id */
		$customer_id = get_user_id();
		$product_id = $this->input->post ( 'productid' );
		//$product_price = $this->post ( 'product_total_price' );
		$product_qty = $this->input->post ( 'product_qty' );
		$product_remarks = ($this->input->post ( 'product_remarks' )!="")?$this->input->post('product_remarks'):"";
		
		$product_current_price_info = $this->get_product_price($products);
		$product_current_price = $product_current_price_info['product_current_price'];
		$discount_percent = $product_current_price_info['discount_percent'];

		$cart_items = array (
			'cart_item_customer_id' => $customer_id,
			'cart_item_session_id' => $reference_id,
			'cart_item_cart_id' => $cart_unique_id,
			'cart_item_product_id' => decode_value($product_id),
			'cart_item_product_name' => addslashes ( urldecode($this->input->post ( 'product_name' ) )),
			'cart_item_product_sku' => addslashes ( $this->input->post ( 'product_sku' ) ),
			'cart_item_product_image' => addslashes ( $products['product_thumbnail'] ),
			'cart_item_qty' => $product_qty,
			'cart_item_unit_price' => $product_current_price,
			'cart_item_product_orginal_price' => $products['product_price'],
			'cart_item_total_price' => $product_current_price * $product_qty,
			'cart_item_created_on' => current_date (),
			//'cart_item_special_notes' => $product_remarks,
			'cart_item_product_type'  => ($products['product_parent_id'] !='')?'attribute':$products['product_type'],
			'cart_item_product_discount' => $discount_percent,
			'cart_item_subproduct_id' 	=> $products['product_primary_id'],
			'cart_item_subproduct_name' 	=> $products['product_name'],
			'cart_item_merchant_id' 	=> $products['product_customer_id'],
			'cart_item_merchant_name' 	=> $products['customer_username'],
			'cart_item_shiiping_id' => (!empty($products['assigned_shipping']))?$products['assigned_shipping']['insert_shipping_id']:'',
			'cart_item_shipping_product_price' => (!empty($products['assigned_shipping']))?$products['assigned_shipping']['prod_ass_ship_method_price']:'',
		);
		
		$cart_item_id = $this->Mydb->insert('cart_items', $cart_items);
		
		if($cart_item_id !='' && !empty($post_arary['selected_attribute_values']))
		{
			$this->_insert_item_modifier($cart_item_id,$post_arary['selected_attribute_values'],$cart_unique_id);
		}
		/* update cart total items */
		$this->update_cart_total_items($cart_unique_id);

		/* get cart details */
		$contents = $this->contents_get ( $reference_id, $customer_id, 'callback' );
		
		return $return_array = array (
				'status' => "ok",
				'contents' => $contents,
				'cart_item_id' => $cart_item_id,
				'message' => get_label('product_added')
		);
	}

	private function update_cart_total_items($cart_unique_id) {
		$record = $this->Mydb->get_record('sum(cart_item_qty) as totalcount','cart_items',array('cart_item_cart_id'=>$cart_unique_id));
		$this->Mydb->update ( 'cart_details', array ('cart_id' => $cart_unique_id ), array ('cart_total_items' => $record['totalcount']) );
	}

	/* this method used to update cart items */
	private function update_cart_items($eqaul_cart_id, $post_arary, $cart_id, $time) {

		$_POST = $post_arary;
		$reference_id = $this->input->post ( 'reference_id' ); /* mobile device id or browser session id */
		$customer_id = get_user_id();
		$product_qty = $this->input->post ( 'product_qty' );
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
			
			$this->update_cart_total_items($cart_id);

			$contents = $this->contents_get ( $reference_id, $customer_id, 'callback' );
			
			return $return_array = array (
					'status' => "ok",
					'contents' => $contents,
					'cart_item_id' => $eqaul_cart_id,
					'message' => get_label('product_added')
			);
		}
	}
	
	/* this function used to get cart details */
	public function contents_get($reference_id = null, $customer_id = null, $returndata = "") {
		$productlead=array();	
		$maxs=0;

		$reference_id = ($reference_id == "" ? '' : $reference_id); /* mobile device id or browser session id */

		$customer_id = ($customer_id != "" ? $customer_id : '');

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
					'cart_item_product_orginal_price',
					'cart_item_total_price',
					'cart_item_product_type',
					'cart_item_product_discount',
					'cart_item_subproduct_id',
					'cart_item_subproduct_name',
					'cart_item_merchant_id',
					'cart_item_merchant_name',
					'cart_item_shipping_product_price',
					'cart_item_shiiping_id' 
			);

			$join = "";
			$join [0] ['select'] = "shipping_name,shipping_method_price,ship_track_url";
			$join [0] ['table'] = "cart_item_shipping";
			$join [0] ['condition'] = "id = cart_item_shiiping_id";
			$join [0] ['type'] = "LEFT";

			//$join [1] ['select'] = "group_concat('~',attribute_name) as attributename, group_concat('~',attribute_value_name)";
			$join [1] ['select'] = "group_concat(attribute_name) as attributename,group_concat(attribute_value_name) as attributevaluename,group_concat(attribute_value_image) as value_images, group_concat(attribute_id) as attributeid, group_concat(attribute_value_id) as attributevalueid";
			$join [1] ['table'] = "cart_attributes";
			$join [1] ['condition'] = "itemid = cart_item_id";
			$join [1] ['type'] = "LEFT";
/*
			$join [2] ['select'] = "product_modifier_values.*";
			$join [2] ['table'] = "product_modifier_values";
			$join [2] ['condition'] = "pro_modifier_value_id = product_assigned_attributes.prod_ass_att_attribute_value_id";
			$join [2] ['type'] = "LEFT";*/

			$where = array (
				'cart_item_cart_id' => $cart_details ['cart_id'] 
			);
			$all_items = $this->Mydb->get_all_records ( $select,'cart_items', $where, '', '', '', '',array('cart_item_id'), $join );
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
	/* this function used to get cart details */
	public function get_cart_contents($reference_id = null, $customer_id = null, $returndata = "") {
		$result=array();	
		$cart_item_count=0;

		$reference_id="";
		$customer_id=get_user_id ();
		$reference_id = ($reference_id == "" ? $this->input->get ( 'reference_id' ) : $reference_id); /* mobile device id or browser session id */
		$customer_id = ($customer_id != "" ? $customer_id : $this->input->get ( 'customer_id' ));

		/* validate customer id */
		$customer_array = ($reference_id == "" ? array ('cart_customer_id' => $customer_id) : 
												 array ('cart_session_id' => $reference_id ));


		$result = $this->contents_get ( $reference_id, $customer_id, 'callback' );						
		if(!empty($result) && !empty($result['cart_details']))
		{

			$response ['status'] = "success";
			if ($returndata == "callback") 
			{
				$cart_details_html =get_template($this->folder . $this->module . "-cart-details", $result);  
				$response ['cart'] = $cart_details_html;
			}
			else
			{
				$response['result_set']=  $result;
			} 
			return $response;
		} else {
			return array ('status' => "success",'message' => get_label ( 'rest_cart_empty'));
		}				 
		/*
		$cart_details = $this->Mydb->get_record ( '*', 'cart_details', $customer_array, array ('cart_id' => 'DESC') );

		if (! empty ( $cart_details )) 
		{
			$select = array ('cart_item_cart_id',
					'cart_item_id',
					'cart_item_product_id',
					'cart_item_product_name',
					'cart_item_product_sku',
					'cart_item_product_image',
					'cart_item_qty',
					'cart_item_unit_price',
					'cart_item_total_price',
					'cart_item_product_type',
					'cart_item_shipping_product_price',
					'cart_item_merchant_name'
			);
			$cart_items = $this->Mydb->get_all_records ( $select, 'cart_items',array('cart_item_cart_id' => 
				$cart_details ['cart_id']) );
			if (! empty ( $cart_items )) 
			{
				$result ['cart_details'] = $cart_details;
				$result ['cart_items'] = $cart_items;
				echo "<pre>";
				print_r($result);
				exit;
				$response ['status'] = "success";
				if ($returndata == "callback") 
				{
					$cart_details_html =get_template($this->folder . $this->module . "-cart-details", $result);  
					$response ['cart'] = $cart_details_html;
				}
				else
				{
					$response['result_set']=  $result;
				} 
				return $response;
			}
		} else {
			return array ('status' => "success",'message' => get_label ( 'rest_cart_empty'));
		}*/
	}
	public function cart()
	{
		$data = $this->load_module_info ();	
		$product=array();	
		$maxs=0;
		$reference_id="";
		$customer_id=get_user_id ();
		$reference_id = ($reference_id == "" ? $this->input->get ( 'reference_id' ) : $reference_id); 
		$customer_id = ($customer_id != "" ? $customer_id : get_user_id());
		$cart_array = $this->get_cart_contents ( $reference_id, $customer_id, 'callback' );
		if(!empty($cart_array))
		{
			$data ['cart'] = (!empty($cart_array['cart']))?$cart_array['cart']:'';
		}

		$this->layout->display_site ( $this->folder . $this->module . "-cart", $data);
	}
	public function updatecartitem($item_id)
	{
		$result=$response_array=array();
		check_site_ajax_request();
		// $data = $this->load_module_info ();
		if (($this->input->post ( 'action' ) == "Updateqty") && ($item_id != "")) 
		{
			$customer_id=get_user_id ();
			$reference_id="";
			$reference_id = ($reference_id == "" ? $this->input->post ( 'reference_id' ) : $reference_id); 
			$customer_id = ($customer_id != "" ? $customer_id : $this->input->post ( 'customer_id' ));
			$_POST['item_id'] = $itemId =  decode_value($item_id);
			$product_qty=$this->input->post('product_qty');
			$select_array=array ('cart_item_cart_id',
					'cart_item_qty',
					'cart_item_total_price',
					'cart_item_id',
					'cart_item_unit_price','cart_item_shipping_product_price', 
			);
			$item_details = $this->Mydb->get_record ($select_array , 'cart_items', array ('cart_item_id' => $itemId ) );
			if (! empty ( $item_details )) 
			{
				$update_qty = $product_qty;
				$update_total_amount = $update_qty * $item_details ['cart_item_unit_price'];
				$this->Mydb->update ( 'cart_items', array ('cart_item_id' => $itemId ), 
													array ('cart_item_qty' => $update_qty,
														   'cart_item_total_price' => $update_total_amount) 
									);

/*				$cart_items = $this->Mydb->get_all_records ( $select_array, 'cart_items',array('cart_item_cart_id' => 
				$item_details ['cart_item_cart_id']) );	
				$total_items=$sub_total=$shipping_fees=0;
				if(!empty($cart_items))
				{
					foreach($cart_items as $key=>$cartItem)
					{
						$total_items+=$cartItem['cart_item_qty'];
						$sub_total+=$cartItem['cart_item_total_price'];
						$shipping_fees+=$cartItem['cart_item_shipping_product_price'];
					}
					$grand_total=($sub_total+$shipping_fees);
					$this->Mydb->update ( 'cart_details', array ('cart_id' => $item_details ['cart_item_cart_id'] ), 
														array ('cart_total_items' => $total_items,
															   'cart_delivery_charge' => $shipping_fees,
															   'cart_sub_total' => $sub_total,
															   'cart_grand_total' => $grand_total,
															) 
										);					
				}*/	
				$response_array=update_cart_details($item_details ['cart_item_cart_id']);
				$cart_item_count = (!empty($response_array))?$response_array['total_items']:0;
				$contents = $this->get_cart_contents ( $reference_id, $customer_id, 'callback' );
				$result = array ('status' => "success",
									    'response' => $contents,
										'cart_count' => $cart_item_count,
										'message' => get_label('product_added')
								      );
			}
			else 
			{
				$result ['status'] = 'error';
				$result ['message'] = "";
			}			

		}
		else
		{
			$result ['status'] = 'error';
			$result ['message'] = '';			
		}
		echo json_encode ( $result );
		exit ();

	}	
	public function removecartitem($item_id)
	{
		$result=$response_array=array();
		check_site_ajax_request();
		$data = $this->load_module_info ();
		if (($this->input->post ( 'action' ) == "Removeitem") && ($item_id != "")) 
		{
			$customer_id=get_user_id ();
			$reference_id="";
			$reference_id = ($reference_id == "" ? $this->input->post ( 'reference_id' ) : $reference_id); 
			$customer_id = ($customer_id != "" ? $customer_id : $this->input->post ( 'customer_id' ));

			$_POST['item_id'] = $itemId =  decode_value($item_id);
			$this->form_validation->set_rules('item_id','lang:item_id','required|trim');			
			if ($this->form_validation->run () == TRUE) 
			{

				$where_array=array('cart_item_id'=>$itemId);
				$item_details = $this->Mydb->get_record ('*' , 'cart_items', $where_array );
				$this->Mydb->delete ( 'cart_items',$where_array );

/*				$cart_items = $this->Mydb->get_all_records ( '*', 'cart_items',array('cart_item_cart_id' => 
				$item_details ['cart_item_cart_id']) );	
				$total_items=$sub_total=$shipping_fees=0;
				if(!empty($cart_items))
				{
					foreach($cart_items as $key=>$cartItem)
					{
						$total_items+=$cartItem['cart_item_qty'];
						$sub_total+=$cartItem['cart_item_total_price'];
						$shipping_fees+=$cartItem['cart_item_shipping_product_price'];
					}
					$grand_total=($sub_total+$shipping_fees);
					$this->Mydb->update ( 'cart_details', array ('cart_id' => $item_details ['cart_item_cart_id'] ), 
														array ('cart_total_items' => $total_items,
															   'cart_delivery_charge' => $shipping_fees,
															   'cart_sub_total' => $sub_total,
															   'cart_grand_total' => $grand_total,
															) 
										);					
				}*/			
				$response_array=update_cart_details($item_details ['cart_item_cart_id']);
				$cart_item_count = (!empty($response_array))?$response_array['total_items']:0;
				$contents = $this->get_cart_contents ( $reference_id, $customer_id, 'callback' );
				$result = array ('status' => "success",
									    'response' => $contents,
										'cart_count' => $cart_item_count,
										'message' => get_label('product_added') 
								      );
			}
			else 
			{
				$result ['status'] = 'error';
				$result ['message'] = "";
			}
		}
		else
		{
			$result ['status'] = 'error';
			$result ['message'] = '';			
		}
		echo json_encode ( $result );
		exit ();

	}	
	public function removecart($cart_id)
	{
		$result=array();
		check_site_ajax_request();
		$this->authentication->user_authentication();
		$data = $this->load_module_info ();
		if (($this->input->post ( 'action' ) == "Removecart") && ($cart_id != "")) 
		{
			$customer_id=get_user_id ();
			$reference_id="";
			$reference_id = ($reference_id == "" ? $this->input->post ( 'reference_id' ) : $reference_id); 
			$customer_id = ($customer_id != "" ? $customer_id : $this->input->post ( 'customer_id' ));

			$_POST['cart_id'] = $cartId =  decode_value($cart_id);
			$this->form_validation->set_rules('cart_id','lang:cart_id','required|trim');			
			if ($this->form_validation->run () == TRUE) 
			{
				$insert_id = $this->Mydb->delete ( 'cart_details',array('cart_id'=>$cartId) );
				$insert_id = $this->Mydb->delete ( 'cart_items',array('cart_item_cart_id'=>$cartId));
				$this->session->set_flashdata ( 'admin_success', sprintf ( $this->lang->line ( 'success_message_delete' ), $this->module_label ) );

				$response_array=update_cart_details($cartId);
				$cart_item_count = (!empty($response_array))?$response_array['total_items']:0;
				$contents = $this->get_cart_contents ( $reference_id, $customer_id, 'callback' );
				$result = array ('status' => "success",
									    'response' => $contents,
										'cart_count' => $cart_item_count,
										'message' => get_label('product_added') 
								      );
			}
			else 
			{
				$result ['status'] = 'error';
				$result ['message'] = validation_errors ();
			}
		}
		else
		{
			$result ['status'] = 'error';
			$result ['message'] = '';			
		}
		echo json_encode ( $result );
		exit ();
	}	

	public function checkout()
	{
		$data = $this->load_module_info();
		$this->layout->display_site ( $this->folder . $this->module . "-checkout", $data );
	}

	public function add_shipping()
	{
		check_site_ajax_request();
		$data = $this->load_module_info ();
		$like = array ();
		print_r($_POST);
	}

	private function placeorder($orderPost)
	{
		$guid = get_guid('orders','order_id');
		$ip = get_ip ();
		$status ="error";
		$errorMsg = array();

		if($orderPost['order_source'] == 'mobile')
		{
			$orderPost['OrderItems'] = json_decode($orderPost['OrderItems'],true);
		}
		$online_amount = 0;
		$shipping_amount = 0;
		$payment_type ='online';
		$online_amount = $orderPost['order_total'];

		if(empty($errorMsg) && !empty($orderPost['OrderItems'])) {

			$order_local_no = date('dmyHis').'F'.rand(0, 999);
			$order = array(
				'order_id' => $guid,
				'order_local_no' => $order_local_no,
				'order_customer_id' => get_user_id(),
				'order_delivery_charge' => $orderPost['cart_delivery_charge'],
				'order_sub_total' => $orderPost['order_subtotal'],
				'order_total_amount' 	=> $orderPost['order_total'],
				'order_payment_mode'	=> 'online',
				'order_payment_getway_status' => 'Failure',
				'order_date'	=> date('Y-m-d H:i:s'),
				'order_status'	=> 2,
				'order_source'	=> 'Web',
				'order_contact_number'	=> $orderPost['order_contact_number'],
				'order_created_on' => date('Y-m-d H:i:s'),
				'order_created_by'	=> get_user_id(),
				'order_created_ip'	=> get_ip(),
				'order_remarks'		=> $orderPost['order_remarks']
			);
			$order_ID = $this->Mydb->insert ( 'orders', $order );
			
			if(!empty($order_ID)){
				$status = 'success';

				$orderItemId = $this->_insert_order_items($order_ID, $guid, $orderPost['OrderItems'],$orderPost['customer_id']);
				$orderCustomerId = $this->_insert_order_customer($order_ID, $guid, $orderPost);	
				
				/*if(isset($orderPost['order_status']) && $orderPost['order_status'] == '1')
				{
					$orders = Orders::find()->joinWith(['ordercustomer','ordercustomer.orderUser','orderItems','orderItems.orderItemModifiers'])->where("order_id='".$order_ID."'")->one();
					if(!empty($orders['ordercustomer']))
					{
						$user = $orders['ordercustomer']['orderUser'];
						$this->_send_notification_order_email($orders,$user);
					}
				}*/
			}
			
		}
		else {
			$status = 'fail';
			$guid = '';
			$order_local_no = '';
			$order_ID = '';
		}

		return array(
			'status' =>$status,
			'message'=>$errorMsg,
			'order_id'=>$guid,
			'order_primary_id'=>$order_ID,
			'order_number'=>$order_local_no
		);
	}

	//Order Customer
	private function _insert_order_customer($order_ID, $guid, $orderPost) {
	
		$address_id = '';
		$order_customer = array(
			'order_customer_order_primary_id' => $order_ID,
			'order_customer_order_id'	=> $guid,
			'order_customer_address_id'	=> $address_id,
			'order_customer_id'	=> $address_id,
			'order_customer_fname'	=> $address_id,
			'order_customer_lname'	=> $address_id,
			'order_customer_email'	=> $address_id,
			'order_customer_mobile_no'	=> $address_id,
			'order_customer_unit_no1'	=> $address_id,
			'order_customer_unit_no2'	=> $address_id,
			'order_customer_address_line1'	=> $address_id,
			'order_customer_address_line2'	=> $address_id,
			'order_customer_city'	=> $address_id,
			'order_customer_state'	=> $address_id,
			'order_customer_country'	=> $address_id,
			'order_customer_postal_code'	=> $address_id,
			'order_customer_created_on'	=> date('Y-m-d H:i:s')
		);
		return $order_customer__ID = $this->Mydb->insert ( 'orders_customer_details', $order_customer );
	}

	//Order Item
	private function _insert_order_items($order_ID, $guid, $orderItemPost, $customerID) {

		if(!empty($orderItemPost)) {
			foreach ($orderItemPost as $key => $val) {   
				// insert order item shipping
				$itemshipping = array(
					'shipping_orderid'	=> $guid,
					'shipping_order_primary_id' => $order_ID,
					'shipping_id' => $val['cart_item_shiiping_id'],
					'shipping_name'	=> $val['shipping_name'],
					'shipping_method_price'	=> $val['shipping_method_price'],
				);
				$orderItemShippingId = $this->Mydb->insert ( 'order_item_shipping', $itemshipping );

				$orderitems = array(
					'item_order_primary_id'	=> $order_ID,
					'item_order_id'	=> $guid,
					'item_product_id'	=> $val['cart_item_product_id'],
					'item_order_primary_id'	=> $val['cart_item_subproduct_id'],
					'item_subproduct_name'	=> $val['cart_item_subproduct_name'],
					'item_name'	=> $val['cart_item_product_name'],
					'item_image'	=> $val['cart_item_product_image'],
					'item_sku'	=> $val['cart_item_product_sku'],
					'item_slug'	=> '',
					'item_specification'	=> '',
					'item_qty'	=> $val['cart_item_qty'],
					'item_unit_price'	=> $val['cart_item_unit_price'],
					'item_total_amount'	=> $val['cart_item_total_price'],
					'shiiping_id'	=> $orderItemShippingId,
					'item_order_status'	=> 1,
					'item_created_on'=>date('Y-m-d H:i:s'),
					'item_placed_on'	=> date('Y-m-d H:i:s'),
					'item_remarks'	=> '',
					'item_merchant_id'	=> $val['cart_item_merchant_id'],
					'item_merchant_name'	=> $val['cart_item_merchant_name'],
				);      
				$orderItemId = $this->Mydb->insert ( 'orders', $order );
				if(!empty($val['attributename'])) {
					$orderOutletId = $this->_insert_order_attributes($order_ID, $guid, $orderItemId, $val); 
				}				
				 //Multi Based On Order Item
			}
			return true;
		} 

	}

	//Order Attributes
	private function _insert_order_attributes($order_ID, $guid, $orderItemId, $postData) { 

		if(!empty($postData)) {
			$attributes = explode(',',$postData['attributename']);
			$attributes_values = explode(',',$postData['attributevaluename']);
			$attributeids = explode(',',$postData['attributeid']);
			$attributevalueids = explode(',',$postData['attributevalueid']);
			if(!empty($attributeids)){

				$attribute_primary_ids = $this->Mydb->get_all_records('pro_modifier_primary_id,pro_modifier_id','product_modifiers',array('pro_modifier_id IN '.implode(',',$attributeids)));
				$att_orginal_primary_id = array();
				if(!empty($attribute_primary_ids)){
					foreach($attribute_primary_ids as $attval) {
						$att_orginal_primary_id[$attval['pro_modifier_id']] = $attval['pro_modifier_primary_id'];
					}
				}

				$attribute_primary_value_ids = $this->Mydb->get_all_records('pro_modifier_value_primary_id,pro_modifier_value_id','product_modifier_values',array('pro_modifier_value_id IN '.implode(',',$attributevalueids)));

				$att_value_orginal_primary_id = array();
				if(!empty($attribute_primary_value_ids)){
					foreach($attribute_primary_value_ids as $attvalues) {
						$att_value_orginal_primary_id[$attvalues['pro_modifier_value_id']] = $attvalues['pro_modifier_value_primary_id'];
					}
				}

				foreach($attributeids as $key=>$values){

					$orderitem_modifiers = array(
						'order_modifier_itemid'	=> $orderItemId,
						'order_modifier_orderid'	=> $guid,
						'order_modifier_order_primary_id'	=> $order_ID,
						'order_modifier_id'	=> $att_orginal_primary_id[$attvalues],
						'order_modifier_name'	=> $attributes[$key],
						'order_modifier_value_id'	=> $att_value_orginal_primary_id[$attributevalueids[$key]],
						'order_modifier_value_name'	=> $attributes_values[$key],
					);      
					$modifier_ids = $this->Mydb->insert ( 'order_item_modifiers', $orderitem_modifiers );
				}
			}
		}
		return true;   
	}

	private function validateorder($orderPost){
		$errorMsg = array();
		if(empty($orderPost['order_total'])) {
			$errorMsg[] = 'Required Order Total';
		}
		if(empty($orderPost['order_subtotal'])) {
			$errorMsg[] = 'Required Order Sub Total';
		}
		if(empty($orderPost['order_contact_number'])) {
			$errorMsg[] = 'Required Contact Number';
		}
		if(empty($orderPost['OrderItems'])) {
			$errorMsg[] = 'Please buy atleast one product'; 
		}
		$payment_type ='online';
		$status = 'fails';
		if(empty($errorMsg)) 
		{
			$orderItem = (!empty($orderPost['source']) && $orderPost['source'] == 'mobile')?json_decode($orderPost['OrderItems'],true):$orderPost['OrderItems'];
			//echo "<pre>"; print_r($orderItem); exit;
			if(!empty($orderItem))
			{
				$product_qty_info = array();
				foreach ($orderItem as $key => $val) {
					$product_id = $val['cart_item_product_id'];
					$subproduct_id = $val['cart_item_subproduct_id'];
					$products = $this->validate_product($product_id,$subproduct_id);

					$product_qty_info[$products['product_primary_id']] = $products['product_quantity'];

					if($val['cart_item_qty'] > $products['product_quantity']) {
						$errorMsg[] = $products['product_name'].' - Invalid quantity';
					}

					$product_special_to_date = $product_special_from_date = '';
					
					if($products['product_special_price_from_date'] !='0000-00-00 00:00:00') $product_special_from_date = $products['product_special_price_from_date'];

					if($products['product_special_price_to_date'] !='0000-00-00 00:00:00') $product_special_to_date = $products['product_special_price_to_date'];

					$discount = 0;
					if($products['product_special_price'] !='')
					{
						$discount = find_discount($products['product_price'],$products['product_special_price'],$product_special_from_date,$product_special_to_date);
					}
					if($discount>0) {
						$product_price = $products['product_special_price'];
					}
					else {
						$product_price = $products['product_price'];       
					}

					if($val['cart_item_unit_price'] != $product_price) {
						$errorMsg[] = $products['product_name'].' - Invalid price'; 
					}
				}

				if(empty($errorMsg)) {
					foreach ($orderItem as $key => $val) {
						$product_id = $val['cart_item_product_id'];
						$subproduct_id = $val['cart_item_subproduct_id'];
						$update_product_id = ($subproduct_id)?$subproduct_id:$product_id;
						if($product_qty_info[$update_product_id])
						{
							$new_qty = $product_qty_info[$update_product_id] - $val['cart_item_qty'];
							$this->Mydb->update ( 'products', array ('product_primary_id' => $update_product_id ), array ('product_quantity' => $new_qty) );
						}	
					}
					$status = 'success';
					$errorMsg[] = 'Continue to proceed';
				}
			}
			else{
				$errorMsg[] = "Invalid Order Items";
			}
			
		}

		return [
		'status' =>$status,
		'message'=>$errorMsg,
		];	
	}

	public function ordervalidate()
	{
		//check_site_ajax_request();
		$params = $response = array();
		$status= "failed";
		$form_error = array();
		$records = '';

		$api_data['reference_id'] = get_user_id();
		$api_data['customer_id'] = get_user_id();
			
		$cart = $this->contents_get ( $api_data['reference_id'],$api_data['customer_id'], 'callback' );		
		echo "<pre>"; print_r($cart); exit;
		if(!empty($cart))
		{
			$order_data = array('order_total'=>$cart['cart_details']['grandtotal'],'order_subtotal'=>$cart['cart_details']['subtotal'],'order_contact_number'=>$this->session->userdata('order_contact_number'),'order_remarks'=>$this->session->userdata('order_additional_info'),'is_default'=>$this->session->userdata('order_is_default'));
			$orderitems = $cart['cart_items'];
			$order_data['cart_delivery_charge'] = (!empty($cart['cart_delivery_charge']))?$cart['cart_delivery_charge']:0;
			$order_data['OrderItems'] = $orderitems;
			$order_data['cart_quantity'] = $cart['cart_details']['total_items'];
		}

		$order_data['customer_id'] = get_user_id();
		$order_data['customer_first_name'] = $this->session->userdata('bg_first_name');
		$order_data['customer_last_name'] = $this->session->userdata('bg_last_name');
		$order_data['customer_address_line1'] = $this->session->userdata('order_address_line1');
		$order_data['customer_address_line2'] = $this->session->userdata('order_address_line2');
		$order_data['customer_postal_code'] = $this->session->userdata('order_address_postalcode');

		$validate_order = $this->validateorder($order_data,'YES');
		if(!empty($validate_order) && $validate_order['status'] == 'success')
		{
			$payment_method = "online";

			/*place order service */
			$order_data['order_payment_mode'] = $payment_method;
			$order_data['order_source'] = 'Web';
			$order_data['order_remarks'] = '';
			$order_data['OrderItems'] = json_encode($orderitems);
			$place_order = $this->placeorder($order_data, 'YES');
			if(!empty($place_order) && $place_order['status'] == 'success')
			{
				$this->session->set_userdata('order_reference',$place_order['order_id']);
				$status = 'success';
				$records = "razorpay";
			}
			else if(!empty($place_order))
			{
				$form_error = $place_order['message'];
				/*error in processing the order*/
			}
			else{
				$records = $form_error = "Something Wrong";
			}
		}
		elseif(!empty($validate_order)) {
			$form_error = $validate_order['message'];
		}
		else
		{
			$records = $form_error = "Something Wrong";
		}
		return array(
			'status' =>$status,
			'data'=>$records,
			'form_error'=>$form_error,
		);
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
