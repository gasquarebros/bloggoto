<?php
/**************************
Project Name	: POS
Created on		: 3  March, 2016
Last Modified 	: 30 June, 2016
Description		: Page contains manage product categories

***************************/
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Manageproducts extends CI_Controller 
{
	public function __construct() 
	{
		parent::__construct ();
		$this->authentication->user_authentication();
		$this->module = "manageproducts";
		$this->module_label = get_label('manageproducts_module_label');
		$this->module_labels = get_label('manageproducts_module_label');
		$this->folder = "manageproducts/";
		$this->table = "products";
		$this->primary_key = 'product_primary_id';
		$this->load->library ( 'common' );
		$this->load->helper ( 'products' );
	}

	/* this method used to list all records . */
	public function index() 
	{
		$data = $this->load_module_info ();
		$this->layout->display_site ( $this->folder . $this->module . "-list", $data );
	}

	/* this method used list ajax listing... */
	function ajax_pagination($page = 0) 
	{
		check_ajax_request (); /* skip direct access */
		$data = $this->load_module_info ();
		$like = array ();
		$where = array (
			" $this->primary_key !=" => '',
		);
		$order_by = array (
				$this->primary_key => 'DESC' 
		);
		
		/* Search part start */
		
		if (post_value ( 'paging' ) == "") 
		{
			$this->session->set_userdata ( $this->module . "_search_field", post_value ( 'search_field' ) );
			$this->session->set_userdata ( $this->module . "_search_value", post_value ( 'search_value' ) );
			$this->session->set_userdata ( $this->module . "_search_status", post_value ( 'status' ) );
			$this->session->set_userdata ( $this->module . "_category_id", post_value ( 'product_category' ) );
			//$this->session->set_userdata ( $this->module . "_subcategory_id", post_value ( 'product_subcategory' ) );
			$this->session->set_userdata ( $this->module . "_order_by_field", post_value ( 'sort_field' ) );
			$this->session->set_userdata ( $this->module . "_order_by_value", post_value ( 'sort_value' ) );
		}
		
		/* common post values... */
		
		if (get_session_value ( $this->module . "_search_field" ) != "" && get_session_value ( $this->module . "_search_value" ) != "") {
			$like = array (
					get_session_value ( $this->module . "_search_field" ) => get_session_value ( $this->module . "_search_value" ) 
			);
		}

		if (get_session_value ( $this->module . "_search_status" ) != "") {
			$where = array_merge ( $where, array (
					'product_status' => get_session_value ( $this->module . "_search_status" ) 
			) );
		}

		/* apply sort by */
		if (get_session_value ( $this->module . "_order_by_field" ) != "" && get_session_value ( $this->module . "_order_by_value" ) != "") {
			
			$order_by = array (
					get_session_value ( $this->module . "_order_by_field" ) => (get_session_value ( $this->module . "_order_by_value" ) == "ASC") ? "ASC" : "DESC" 
			);
		}

		/* apply category Id */
		if (get_session_value ( $this->module . "_category_id" ) != "") {
			
			$where = array_merge ( $where, array (
					'product_category_id' => get_session_value ( $this->module . "_category_id" ) 
			) );
		}

		/* apply subcategory Id 
		if (get_session_value ( $this->module . "_subcategory_id" ) != "") 
		{
			
			$where = array_merge ( $where, array (
					' 	product_subcategory_id' => get_session_value ( $this->module . "_subcategory_id" ) 
			) );
		}*/
		$join = "";
		
		$join [0] ['select'] = "customer_first_name,customer_last_name";
		$join [0] ['table'] = "pos_customers";
		$join [0] ['condition'] = "product_customer_id = customer_id";
		$join [0] ['type'] = "INNER";
		/* not in product availability id condition  */
		$join [1] ['select'] = "pro_cate_name";
		$join [1] ['table'] = "pos_product_categories";
		$join [1] ['condition'] = "product_category_id = pro_cate_primary_id	";
		$join [1] ['type'] = "LEFT";	
		$groupby = "product_primary_id";

		$totla_rows = $this->Mydb->get_num_join_rows ( $this->primary_key, $this->table, $where, null, null, null, $like, $groupby, $join );

		/* pagination part start */
		$admin_records = 0;
		$limit = (( int ) $admin_records == 0) ? 25 : $admin_records;
		$offset = (( int ) $page == 0) ? 0 : $page;
		$uri_segment = $this->uri->total_segments ();
		$uri_string = camp_url () . $this->module . "/ajax_pagination";

		$config = pagination_config ( $uri_string, $totla_rows, $limit, $uri_segment );
		$this->pagination->initialize ( $config );
		$data ['paging'] = $this->pagination->create_links ();
		$data ['per_page'] = $data ['limit'] = $limit;
		$data ['start'] = $offset;
		$data ['total_rows'] = $totla_rows;
		/* pagination part end */
		
		$select_array = array (
				'product_primary_id',
				'product_id',
				'product_name',
				'product_alias',
				'product_sequence',
				'product_status',
				'product_sku',
				'product_category_id',
				'product_cost',
				'product_price',
				'product_condition',
				'product_quantity',  
				'product_type'
		);

		$data ['records'] = $this->Mydb->get_all_records ( $select_array, $this->table, $where, $limit, $offset, $order_by, $like,$groupby, $join );

		$page_relod = ($totla_rows > 0 && $offset > 0 && empty ( $data ['records'] )) ? 'Yes' : 'No';
		$html = get_template ( $this->folder . $this->module . '-ajax-list', $data );
		echo json_encode ( array (
				'status' => 'ok',
				'offset' => $offset,
				'page_reload' => $page_relod,
				'html' => $html 
		) );
		exit ();
	}
	
	public function get_product_modifiers()
	{
		check_ajax_request (); /* skip direct access */
		$html = '';
		$associate = '';
		$data = '';
		$product_category = $this->input->post('product_category');
		$product_modifiers = $this->input->post('product_modifiers');
		if($product_category !='') {
			$prod_cat = explode('~',$product_category);
			$where_array = array('pro_modifier_status' => 'A','pro_modifier_category_id'=>$prod_cat[0]);
			$html = get_product_modifier($where_array,$product_modifiers,'class="form-control search_select " id="product_modifier" ',' multiple="multiple" onchange="get_attribute_enabled()" data-placeholder="'.get_label('product_modifier_select').'"','pro_modifier_id');

			//$data[''] = $this->Mydb->get_all_records('pro_modifier_primary_id,pro_modifier_name,pro_modifier_id','product_modifiers',$where_array,'','',array('pro_modifier_name'=>"ASC"));
			$data['selected_modifiers'] = $product_modifiers;
			$associate = get_template ( $this->folder . $this->module . '-associate-list', $data );
		}
		echo json_encode ( array (
				'status' => 'ok',
				'html' => $html,
				'associate' => $associate
		) );
		exit ();
	}
	
	/* this method used to add record . */
	public function add() 
	{
		$data = $this->load_module_info ();
		/* form submit */
		if ($this->input->post ( 'action' ) == "Add") {

			$product_tags = $this->input->post ( 'product_tags' );
			check_ajax_request (); /* skip direct access */

		
			$this->form_validation->set_rules ( 'product_name', 'lang:product_name', 'required|callback_productnameexists' );
			$this->form_validation->set_rules ( 'product_sku', 'lang:product_sku', 'required|callback_validate_sku' );
			$this->form_validation->set_rules ( 'product_price', 'lang:product_price', 'required' );
			$this->form_validation->set_rules ( 'status', 'lang:status', 'required' );
			//$this->form_validation->set_rules ( 'product_customer_id', 'lang:product_customer_id', 'required' );
		
			/*$this->form_validation->set_rules ( 'product_category', 'lang:product_categorie', 'required|callback_validate_category' );
			
			$this->form_validation->set_rules ( 'product_thumbnail', 'lang:product_thumbnail', 'trim|callback_validate_image' );
	
			   if special price enabled. */
			if (( int ) $this->input->post ( 'product_spl_price' ) != 0) {
				
				$this->form_validation->set_rules ( 'product_spl_price', 'lang:product_spl_price', 'required' );
				$this->form_validation->set_rules ( 'product_spl_price_from', 'lang:product_spl_price_from', 'required' );
				$this->form_validation->set_rules ( 'product_spl_price_to', 'lang:product_spl_price_to', 'required' );
			}
			
			if ($this->form_validation->run () == TRUE) {
			

				$product_id = get_guid ( $this->table, 'product_id' );
				$product_slug = make_slug ( $this->input->post ( 'product_name' ), $this->table, 'product_slug' );
				$product_sequence = (( int ) $this->input->post ( 'product_sequence' ) == 0) ? get_sequence ( 'product_sequence', $this->table, array (
						'product_category_id' => post_value ( 'product_category' )
				) )  : $this->input->post ( 'product_sequence' );
				
				$product_image = "";
				if (isset ( $_FILES ['product_thumbnail'] ['name'] ) && $_FILES ['product_thumbnail'] ['name'] != "") {
					$product_image = $this->common->upload_image ( 'product_thumbnail', $this->lang->line ( 'product_main_image_folder_name' ) );
				}
				
				$categories = explode('~',post_value ( 'subcategory' ));

			
				$insert_array = array (
					'product_type' => post_value ( 'product_settings' ),
					'product_name' => post_value ( 'product_name' ),
					'product_alias' => post_value ( 'product_alias_text' ),
					'product_sku' => post_value ( 'product_sku' ),
					'product_id' => $product_id,
					'product_slug' => $product_slug,
					'product_customer_id' => get_user_id(),
					'product_category_id' => $categories[0],
					'product_subcategory_id' => $categories[1],
					'product_short_description' => post_value ( 'product_short_description' ),
					'product_long_description' => post_value ( 'product_long_description' ),
					'product_thumbnail' => $product_image,
					'product_status' => (post_value ( 'status' ) == "A" ? 'A' : 'I'),
					'product_sequence' => $product_sequence,
					'product_cost' => post_value ( 'product_cost' ),
					'product_price' => post_value ( 'product_price' ),
					'product_alt_price' => post_value ( 'product_alt_price' ),
					'product_quantity' => post_value ( 'product_quantity' ),
					'product_special_price' => post_value ( 'product_spl_price' ),
					'product_special_price_from_date' => (post_value ( 'product_spl_price_from' ))?date ( "Y-m-d", strtotime ( post_value ( 'product_spl_price_from' ) ) ):'',
					'product_special_price_to_date' => (post_value ( 'product_spl_price_to' ))?date ( "Y-m-d", strtotime ( post_value ( 'product_spl_price_to' ) ) ):'',
					'product_meta_title' => post_value ( 'product_meta_title' ),
					'product_meta_keywords' => post_value ( 'product_meta_keywords' ),
					'product_meta_description' => post_value ( 'product_meta_description' ),
					'product_created_on' => current_date (),
					'product_created_by' => get_user_id (),
					'product_created_ip' => get_ip ()
				);
				
				$insert_id = $this->Mydb->insert ( $this->table, $insert_array );
				
				
				if ($insert_id != "") {

					/* insert product tags .. */
					//$this->insert_tags ( 'add', $product_tags, $insert_id, $product_id );
					if(post_value ( 'product_settings' ) == 'attribute') {
						$this->insert_product_assosiate($insert_id);
					}
					
					$this->insert_product_shipping($insert_id);
					
					/* insert gallery images */
					if (! empty ( $_FILES ['product_gallery'] ['name'] )) {
						$this->add_gallery_images ( $_FILES, $_FILES ['product_gallery'] ['name'], $insert_id, $product_id );
					}
					
				}
				
				$this->session->set_flashdata ( 'admin_success', sprintf ( $this->lang->line ( 'success_message_add' ), $this->module_label ) );
				$result ['status'] = 'success';
			} else {
				
				$result ['status'] = 'error';
				$result ['message'] = validation_errors ();
			}

			echo json_encode ( $result );
			exit ();
		}	
		
		/*$get_all_users_list = get_all_users_list();
		$data['all_users'] = $get_all_users_list;*/
		/* Common labels */
		$data ['breadcrumb'] = $data ['form_heading'] = get_label ( 'add' ) . ' ' . $this->module_label;
		$data ['module_action'] = 'add';
		//print_r($data);exit;
		$this->layout->display_admin ( $this->folder . $this->module . '-add', $data );
	}
	
	private function insert_product_assosiate($parent_product)
	{
		$modelsProductAssociates = $this->input->post('ProductAssociates');
		

		// delete the associates products assigned table entries
		//ProductAssociates::deleteAll(['prod_ass_product_id' => $model->product_id]);
		//ProductAttributes::deleteAll(['prod_ass_att_parent_productid' => $model->product_id]);
		$this->db->delete('product_associate_products',array('prod_ass_product_id' => $parent_product));
		$this->db->delete('product_assigned_attributes',array('prod_ass_att_parent_productid' => $parent_product));
		if(!empty($modelsProductAssociates))
		{
			$subsequence = 1;
			$associates_products = array();
			foreach($modelsProductAssociates[0]['product_name'] as $subprod_key=>$model_product_sublevels)
			{			
				$associate_keys = array_keys($modelsProductAssociates[0]['attributes']);
				
				$categories = explode('~',post_value ( 'subcategory' ));

				// insert or update need to perform here
				if($modelsProductAssociates[0]['product_ids'][$subprod_key] !='')
				{
					$product_slug = make_slug ( $model_product_sublevels, $this->table, 'product_slug', array (
						$this->primary_key . "!=" => $modelsProductAssociates[0]['product_ids'][$subprod_key]
					));
					if($modelsProductAssociates[0]['product_ids'][$subprod_key] != '') {
						$record = $this->Mydb->get_record ( '*', $this->table, array (
							$this->primary_key => $modelsProductAssociates[0]['product_ids'][$subprod_key]
						) );
						if($record['product_id'] !='') {
							$subproduct_id = $record['product_id'];
						} else {
							$subproduct_id = get_guid ( $this->table, 'product_id' );
						}
					} else { 
						$subproduct_id = get_guid ( $this->table, 'product_id' );
					}
					
					$update_array = array (
						'product_type' => 'simple',
						'product_id' => $subproduct_id,
						'product_name' => $model_product_sublevels,
						'product_alias' => '',
						'product_sku' => $modelsProductAssociates[0]['product_sku'][$subprod_key],
						'product_parent_id' => $parent_product,
						'product_quantity' => $modelsProductAssociates[0]['product_qty'][$subprod_key],
						'product_slug' => $product_slug,
						'product_customer_id' => get_user_id(),
						'product_category_id' => $categories[0],
						'product_subcategory_id' => $categories[1],
						'product_short_description' => post_value ( 'product_short_description' ),
						'product_long_description' => post_value ( 'product_long_description' ),
						'product_status' => (post_value ( 'status' ) == "A" ? 'A' : 'I'),
						'product_price' => $modelsProductAssociates[0]['product_price'][$subprod_key],
						'product_special_price' => $modelsProductAssociates[0]['product_special_price'][$subprod_key],
						'product_updated_on' => current_date (),
						'product_updated_by' => get_user_id (),
						'product_updated_ip' => get_ip () 
					);
					
					
					$this->Mydb->update ( $this->table, array (
						$this->primary_key => $modelsProductAssociates[0]['product_ids'][$subprod_key] 
					), $update_array );
					$insert_id = $modelsProductAssociates[0]['product_ids'][$subprod_key];
				}
				else
				{
					$subproduct_id = get_guid ( $this->table, 'product_id' );
					$product_slug = make_slug ( $model_product_sublevels, $this->table, 'product_slug' );
					$insert_array = array (
						'product_type' => 'simple',
						'product_id' => $subproduct_id,
						'product_name' => $model_product_sublevels,
						'product_alias' => '',
						'product_sku' => $modelsProductAssociates[0]['product_sku'][$subprod_key],
						'product_parent_id' => $parent_product,
						'product_quantity' => $modelsProductAssociates[0]['product_qty'][$subprod_key],
						'product_slug' => $product_slug,
						'product_customer_id' => get_user_id(),
						'product_category_id' => $categories[0],
						'product_subcategory_id' => $categories[1],
						'product_short_description' => post_value ( 'product_short_description' ),
						'product_long_description' => post_value ( 'product_long_description' ),
						'product_status' => (post_value ( 'status' ) == "A" ? 'A' : 'I'),
						'product_price' => $modelsProductAssociates[0]['product_price'][$subprod_key],
						'product_special_price' => $modelsProductAssociates[0]['product_special_price'][$subprod_key],
						//'product_special_price_from_date' => date ( "Y-m-d", strtotime ( post_value ( 'product_spl_price_from' ) ) ),
						//'product_special_price_to_date' => date ( "Y-m-d", strtotime ( post_value ( 'product_spl_price_to' ) ) ),
						//'product_meta_title' => post_value ( 'product_meta_title' ),
						//'product_meta_keywords' => post_value ( 'product_meta_keywords' ),
						//'product_meta_description' => post_value ( 'product_meta_description' ),
						'product_created_on' => current_date (),
						'product_created_by' => get_user_id (),
						'product_created_ip' => get_ip ()
					);

					
					$insert_id = $this->Mydb->insert ( $this->table, $insert_array );
				}
				//echo $this->db->last_query();
				
				
				$attributes_subprod = array();

				foreach($associate_keys as $ass_att_key=>$assocaite_attribute)
				{

						$attributes_subprod[]= ['prod_ass_att_attribute_id' => $assocaite_attribute,'prod_ass_att_attribute_name'=>'','prod_ass_att_attribute_value_name'=>'','prod_ass_att_attribute_value_id'=>$modelsProductAssociates[0]['attributes'][$assocaite_attribute][$subprod_key],'prod_ass_att_product_id'=>$insert_id,'prod_ass_att_parent_productid'=>$parent_product];
				}
				$associates_products[]=array('prod_ass_product_id' => $parent_product,'prod_ass_sub_product_id'=>$insert_id);
				if(!empty($attributes_subprod))
				{
					$this->db->insert_batch('product_assigned_attributes',$attributes_subprod);
				}
				//echo "<pre>";
				//print_r($attributes_subprod);
				//echo $this->db->last_query();
				
				$subsequence++;
			}
		}
		//exit;
		if(!empty($associates_products))
		{
			$this->db->insert_batch('product_associate_products',$associates_products);
			
			
			$product_modifier = $this->input->post('product_modifier');
			$associates_products_modifiers = array();
			if(!empty($product_modifier)) { 
				foreach($product_modifier as $ass_mod) {
					$associates_products_modifiers[] = array('assigned_mod_product_id'=>$parent_product,'assigned_mod_modifier_id'=>$ass_mod);
				}
				$this->db->insert_batch('product_assigned_modifiers',$associates_products_modifiers);
			}
		}
	}
	
	private function insert_product_shipping($insertid)
	{
		$modelsProductShippings = $this->input->post('ProductShipping');
		$this->db->delete('product_assigned_shipping_methods',array('prod_ass_ship_method_prodid' => $insertid));
		$attributes_subprod = array();
		if(!empty($modelsProductShippings))
		{
			$subsequence = 1;
			$associates_products = array();
			foreach($modelsProductShippings['prod_ass_ship_method_shipid'] as $shipkey=>$shipping)
			{			
				$price = $modelsProductShippings['prod_ass_ship_method_price'][$shipkey];
				$is_combined = (!empty($modelsProductShippings['prod_ass_ship_method_is_combined'][$shipkey]))?$modelsProductShippings['prod_ass_ship_method_is_combined'][$shipkey]:0;
				$attributes_subprod[]= ['prod_ass_ship_method_shipid' => $shipping,'prod_ass_ship_method_prodid'=>$insertid,'prod_ass_ship_method_price'=>$price,'prod_ass_ship_method_is_combined'=>$is_combined];
			}
			
			if(!empty($attributes_subprod))
			{
				$this->db->insert_batch('product_assigned_shipping_methods',$attributes_subprod);
			}	
		}
	}
	
	
	/* this method used to update record info.. */
	public function edit($edit_id = NULL) 
	{
		$data = $this->load_module_info ();

		$id = addslashes ( decode_value ( $edit_id ) );
		$response = $image_arr = array ();
		$record = $this->Mydb->get_record ( '*', $this->table, array (
				$this->primary_key => $id
		) );
		(empty ( $record )) ? redirect ( base_url () . $this->module ) : '';

		if ($this->input->post ( 'action' ) == "edit") {

			$product_alias = $this->input->post ( 'product_alias' );
			check_ajax_request (); /* skip direct access */
			
			$this->form_validation->set_rules ( 'product_name', 'lang:product_name', 'required|callback_productnameexists' );
			$this->form_validation->set_rules ( 'product_sku', 'lang:product_sku', 'required|callback_validate_sku' );
			$this->form_validation->set_rules ( 'product_price', 'lang:product_price', 'required' );
			$this->form_validation->set_rules ( 'status', 'lang:status', 'required' );
			//$this->form_validation->set_rules ( 'product_customer_id', 'lang:product_customer_id', 'required' );
		
			/*$this->form_validation->set_rules ( 'product_category', 'lang:product_categorie', 'required|callback_validate_category' );
			
			$this->form_validation->set_rules ( 'product_thumbnail', 'lang:product_thumbnail', 'trim|callback_validate_image' );
	
			   if special price enabled. */
			if (( int ) $this->input->post ( 'product_spl_price' ) != 0) {
				
				$this->form_validation->set_rules ( 'product_spl_price', 'lang:product_spl_price', 'required' );
				$this->form_validation->set_rules ( 'product_spl_price_from', 'lang:product_spl_price_from', 'required' );
				$this->form_validation->set_rules ( 'product_spl_price_to', 'lang:product_spl_price_to', 'required' );
			}
			if ($this->form_validation->run () == TRUE) {
				
									
				$product_slug = make_slug ( $this->input->post ( 'product_name' ), $this->table, 'product_slug', array (
					$this->primary_key . "!=" => $record [$this->primary_key] 
				));
				$product_sequence = (( int ) $this->input->post ( 'product_sequence' ) == 0) ? get_sequence ( 'product_sequence', $this->table) : $this->input->post ( 'product_sequence' );
				
				$categories = explode('~',post_value ( 'subcategory' ));
				//print_r($categories);
				//exit;
				$update_array = array (
				
					'product_type' => post_value ( 'product_settings' ),
					'product_name' => post_value ( 'product_name' ),
					'product_alias' => post_value ( 'product_alias_text' ),
					'product_sku' => post_value ( 'product_sku' ),
					'product_slug' => $product_slug,
					'product_customer_id' => get_user_id(),
					'product_category_id' => $categories[0],
					'product_subcategory_id' => $categories[1],
					'product_short_description' => post_value ( 'product_short_description' ),
					'product_long_description' => post_value ( 'product_long_description' ),
					//'product_thumbnail' => $product_image,
					'product_status' => (post_value ( 'status' ) == "A" ? 'A' : 'I'),
					'product_sequence' => $product_sequence,
					'product_price' => post_value ( 'product_price' ),
					'product_special_price' => post_value ( 'product_spl_price' ),
					'product_special_price_from_date' => (post_value ( 'product_spl_price_from' ))?date ( "Y-m-d", strtotime ( post_value ( 'product_spl_price_from' ) ) ):'',
					'product_special_price_to_date' => (post_value ( 'product_spl_price_to' ))?date ( "Y-m-d", strtotime ( post_value ( 'product_spl_price_to' ) ) ):'',
					'product_quantity' => post_value ( 'product_quantity' ),
					'product_meta_title' => post_value ( 'product_meta_title' ),
					'product_meta_keywords' => post_value ( 'product_meta_keywords' ),
					'product_meta_description' => post_value ( 'product_meta_description' ),
					'product_updated_on' => current_date (),
					'product_updated_by' => get_user_id (),
					'product_updated_ip' => get_ip () 
				);
				/* upload image and unlink old image */
				$image_arr = array ();
				if (isset ( $_FILES ['product_thumbnail'] ['name'] ) && $_FILES ['product_thumbnail'] ['name'] != "") {
					$upload_image = $this->common->upload_image ( 'product_thumbnail', get_company_folder () . "/" . $this->lang->line ( 'product_main_image_folder_name' ) );
					$image_arr = array (
							'product_thumbnail' => $upload_image 
					);
					
					$this->common->unlink_image ( $record ['product_thumbnail'], get_company_folder (), $this->lang->line ( 'product_main_image_folder_name' ) ); /* unlink image.. */
				} elseif ($this->input->post ( 'remove_image' ) == "Yes") {
					$image_arr = array (
							'product_thumbnail' => "" 
					);
					
					$this->common->unlink_image ( $record ['product_thumbnail'], get_company_folder (), $this->lang->line ( 'product_main_image_folder_name' ) );
				}
				
				$update_array = array_merge ( $update_array, $image_arr );

				$this->Mydb->update ( $this->table, array (
					$this->primary_key => $record [$this->primary_key] 
				), $update_array );
				

				//echo $this->db->last_query();

				/* insert gallery images */
				if (! empty ( $_FILES ['product_gallery'] ['name'] )) {
					$this->add_gallery_images ( $_FILES, $_FILES ['product_gallery'] ['name'], $id, $record ['product_id'] );
				}
				
				$this->insert_product_shipping($record[$this->primary_key]);
				
				if(post_value ( 'product_settings' ) == 'attribute') {
					$this->insert_product_assosiate($record[$this->primary_key]);
				}
				
				$this->session->set_flashdata ( 'admin_success', sprintf ( $this->lang->line ( 'success_message_edit' ), $this->module_label ) );
				$response ['status'] = 'success';
			} else {
				$response ['status'] = 'error';
				$response ['message'] = validation_errors ();
			}
			
			echo json_encode ( $response );
			exit ();
		}
		$data ['records'] = $record;
		/* get gallery images */
		$data ['gallery_images'] = $this->Mydb->get_all_records ( 'pro_gallery_image,pro_gallery_primary_id', 'product_gallery', array (
				'pro_gallery_product_primary_id' => $record [$this->primary_key] 
		) );
		
		/*get shipping methods*/
		$data ['assigned_shipping'] = $this->Mydb->get_all_records ( '*', 'product_assigned_shipping_methods', array (
			'prod_ass_ship_method_prodid' => $record[$this->primary_key] 
		) );
		
		if($record['product_type'] == 'attribute') {
			
			$join = "";
		
			$join [0] ['select'] = "pro_modifier_primary_id,pro_modifier_id,pro_modifier_name";
			$join [0] ['table'] = "product_modifiers";
			$join [0] ['condition'] = "pro_modifier_primary_id = assigned_mod_modifier_id";
			$join [0] ['type'] = "INNER";
			/* not in product availability id condition  */
			$join [1] ['select'] = "group_concat(pro_modifier_value_primary_id) as value_primary_id,group_concat(pro_modifier_value_id) as value_id,group_concat(pro_modifier_value_name) as value_name";
			$join [1] ['table'] = "product_modifier_values";
			$join [1] ['condition'] = "pro_modifier_value_modifier_primary_id = product_modifiers.pro_modifier_primary_id";
			$join [1] ['type'] = "LEFT";	
			
			$groupby = "pro_modifier_value_modifier_primary_id";
			$select_array = array (
				'*',  
			);
			$where = array("assigned_mod_product_id"=>$record[$this->primary_key]);
			
			$assigned_modifiers = $this->Mydb->get_all_records ( 'assigned_mod_modifier_id,assigned_mod_product_id', 'product_assigned_modifiers', $where, '', '' ,'' ,'',array('assigned_mod_product_id','assigned_mod_modifier_id') );
			
			$selected_modifiers = array();
			if(!empty($assigned_modifiers)) {
				foreach($assigned_modifiers as $selmodifier) {
					$selected_modifiers[] = $selmodifier['assigned_mod_modifier_id'];
				}
			}
			
			$data['assigned_modifiers'] = $selected_modifiers;
			
			/*get_assigned_associate_products*/
			$data ['assigned_associate_attributes'] = $this->Mydb->get_all_records ( '*', 'product_assigned_attributes', array (
				'prod_ass_att_parent_productid' => $record[$this->primary_key] 
			) );


			$data ['assigned_products'] = $this->Mydb->get_all_records ( '*', 'products', array (
				'product_parent_id' => $record[$this->primary_key] 
			) );
			// echo "<pre>";
			// print_r($data);
			// exit;
		}
		/* Common labels */
		
		//$get_all_users_list = get_all_users_list();
		//$data['all_users'] = $get_all_users_list;
		$data ['breadcrumb'] = $data ['form_heading'] = get_label ( 'edit' ) . ' ' . $this->module_label;
		//$data['condiment_products'] = $this->get_condiment_products();
		$data ['module_action'] = 'edit/' . encode_value ( $record [$this->primary_key] );
		$this->layout->display_admin ( $this->folder . $this->module . '-edit', $data );
	}
	
	
	
	/* this method used update multible actions */
	function action() 
	{
		$ids = ($this->input->post ( 'multiaction' ) == 'Yes' ? $this->input->post ( 'id' ) : decode_value ( $this->input->post ( 'changeId' ) ));
		$postaction = $this->input->post ( 'postaction' );
		
		$response = array (
				'status' => 'error',
				'msg' => get_label ( 'something_wrong' ),
				'action' => '',
				'multiaction' => $this->input->post ( 'multiaction' ) 
		);
		/*
		$company_array = array (
				'product_company_id' => get_company_id (),
				'product_company_app_id' => get_company_app_id () 
		);*/
		
		/* Delete */
		if ($postaction == 'Delete' && ! empty ( $ids )) {
			
			if (is_array ( $ids )) {
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_delete' ), $this->module_labels );
			} else {
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_delete' ), $this->module_label );
				;
			}
			
			$ids = (is_array ( $ids )) ? $ids : array (
					$ids 
			);
			
			/* delete master product table */
			$this->common->delete_unlink_image ( $this->lang->line ( 'product_main_image_folder_name' ), "product_thumbnail", $this->primary_key, $this->table, $ids );
			
			$this->Mydb->delete_where_in ( $this->table, $this->primary_key, $ids );
			
			/* delete and unlink gallery images */
			$this->common->delete_unlink_image ( $this->lang->line ( 'product_gallery_image_folder_name' ), "pro_gallery_image", 'pro_gallery_product_primary_id', 'product_gallery', $ids );
			$this->Mydb->delete_where_in ( 'product_gallery', 'pro_gallery_product_primary_id', $ids);
			
			
			$response ['status'] = 'success';
			$response ['action'] = $postaction;
		}
		
		/* Activation */
		if ($postaction == 'Activate' && ! empty ( $ids )) 
		{
			$update_values = array (
					"product_status" => 'A',
					"product_updated_on" => current_date (),
					'product_updated_by' => get_user_id (),
					'product_updated_ip' => get_ip () 
			);
			
			if (is_array ( $ids )) {
				$this->Mydb->update_where_in ( $this->table, $this->primary_key, $ids, $update_values);
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_activate' ), $this->module_labels );
			} else {
				
				$this->Mydb->update_where_in ( $this->table, $this->primary_key, array (
						$ids 
				), $update_values );
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_activate' ), $this->module_label );
			}
			
			$response ['status'] = 'success';
			$response ['action'] = $postaction;
		}
		
		/* Deactivation */
		if ($postaction == 'Deactivate' && ! empty ( $ids )) 
		{
			$update_values = array (
					"product_status" => 'I',
					"product_updated_on" => current_date (),
					'product_updated_by' => get_user_id (),
					'product_updated_ip' => get_ip () 
			);
			
			if (is_array ( $ids )) {
				$this->Mydb->update_where_in ( $this->table, $this->primary_key, $ids, $update_values );
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_deactivate' ), $this->module_labels );
			} else {
				$this->Mydb->update_where_in ( $this->table, $this->primary_key, array (
						$ids 
				), $update_values );
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_deactivate' ), $this->module_label );
			}
			
			$response ['status'] = 'success';
			$response ['action'] = $postaction;
		}
		
		/* Sequence */
		if ($postaction == 'Sequence' && ! empty ( $ids )) {
			
			if (! empty ( $ids )) {
				foreach ( $ids as $primary_id ) {
					
					$post_sequence = $this->input->post ( 'sequence' );
					$sequnce_value = (isset ( $post_sequence [$primary_id] )) ? ( int ) $post_sequence [$primary_id] : 0;
					if (( int ) $sequnce_value != 0) {
						$update_values = array (
								"product_sequence" => $sequnce_value,
								"product_updated_on" => current_date (),
								'product_updated_by' => get_user_id (),
								'product_updated_ip' => get_ip () 
						);
						$this->Mydb->update_where_in ( $this->table, $this->primary_key, array (
								$primary_id 
						), $update_values);
						$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_sequence' ), $this->module_labels );
					}
				}
			}
			
			$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_sequence' ), $this->module_labels );
			
			$response ['status'] = 'success';
			$response ['action'] = $postaction;
		}
		
		echo json_encode ( $response );
		exit ();
	}
	
	/* this method used to to check validate image file */
	public function validate_image() {
		if (isset ( $_FILES ['product_thumbnail'] ['name'] ) && $_FILES ['product_thumbnail'] ['name'] != "") {
			if ($this->common->valid_image ( $_FILES ['product_thumbnail'] ) == "No") {
				$this->form_validation->set_message ( 'validate_image', get_label ( 'upload_valid_image' ) );
				return false;
			}
		}
		
		return true;
	}
	
	/* this method used check product name or alredy exists or not */
	public function productnameexists() {
		$name = $this->input->post ( 'product_name' );
		$edit_id = $this->input->post ( 'edit_id' );
		$category = post_value ( 'category' );
		$where = array (
				'product_name' => trim ( $name ) 
		);
		if ($edit_id != "") {
			$where = array_merge ( $where, array (
					"product_primary_id !=" => $edit_id 
			) );
		}
		
		$where = array_merge ( array (
				'product_category_id' => $category,
		), $where );
		$result = $this->Mydb->get_record ( 'product_primary_id', $this->table, $where );
		
		if (! empty ( $result )) {
			$this->form_validation->set_message ( 'productnameexists', get_label ( 'product_value_exist' ) );
			return false;
		} else {
			return true;
		}
	}
	
	/* this method used check product sku or alredy exists or not */
	public function validate_sku() {
		$sku = $this->input->post ( 'product_sku' );
		$edit_id = $this->input->post ( 'edit_id' );
		$where = array (
				'product_sku' => trim ( $sku ) 
		);
		if ($edit_id != "") {
			$where = array_merge ( $where, array (
					"product_primary_id !=" => $edit_id 
			) );
		}

		$result = $this->Mydb->get_record ( 'product_primary_id', $this->table, $where );
		
		if (! empty ( $result )) {
			$this->form_validation->set_message ( 'validate_sku', get_label ( 'product_sku_exist' ) );
			return false;
		} else {
			return true;
		}
	}
	/* this method used to validate posted category and subcategory */
	function validate_subcategory() {
		/* validate category id */
		$category = explode ( '~', post_value ( 'subcategory' ) );
		
		if (count ( $category ) == 2) {
			
			$category_val = $this->Mydb->get_record ( 'pro_subcate_id', 'product_subcategories', array (
					'pro_subcate_category_id' => $category [0],
					'pro_subcate_id' => $category [1] 
			) );
			
			if (empty ( $category_val )) {
				$this->form_validation->set_message ( 'validate_subcategory', get_label ( 'category_invalid' ) );
				return false;
			} else {
				return true;
			}
		} else {
			return false;
		}
	}
	
function numcheck($in)
 {
	if (intval($in) > 49) 
	{
		return TRUE;
	} 
	else 
	{
		$this->form_validation->set_message('numcheck', 'Larger than / Equal 50');
		return FALSE;		
	}

}	
	/* this method used to validate posted modifier and modifier values */
	function validate_modifier() {
		$modifiers = $this->input->post ( 'modifier_value' );
		if (! empty ( $modifiers )) {
			foreach ( $modifiers as $key ) {
				
				$modifier_values = $key;
				if ($modifier_values != "") {
					
					$category_val = $this->Mydb->get_record ( 'pro_modifier_id', 'product_modifiers', array (
							'pro_modifier_app_id' => get_company_app_id (),
							'pro_modifier_company_id' => get_company_id (),
							'pro_modifier_id' => $key 
					) );
					
					if (empty ( $category_val )) {
						$this->form_validation->set_message ( 'validate_modifier', get_label ( 'modifier_invalid' ) );
						return false;
					} else {
						return true;
					}
				} else {
					return false;
				}
			}
		}
	}
	
	/* get subcategory dropdown values */
	public function get_subcategory_listing() {
		check_ajax_request (); /* skip direct access */
		$category_id = post_value ( 'category_id' );
		
		if ($category_id != "") {
			$dropdown = get_product_subcategory ( array (
					
					'pro_subcate_category_id' => $category_id 
			), '', 'class="search_select required" ' );
			
			// echo $this->db->last_query(); exit;
			
			echo json_encode ( array (
					'html' => $dropdown 
			) );
		}
	}
	
	/* this method used validate availablity */
	public function availability_count() {
		$result = $this->input->post ( 'product_avilablity' );
		if (empty ( $result )) {
			$this->form_validation->set_message ( 'availability_count', get_label ( 'availability_required' ) );
			return false;
		} else {
			return true;
		}
	}
	
	/* this method used to insert_product_outlet */
	private function insert_product_outlet($action, $product_outlet, $insert_id,$product_id) {
		// echo $action; exit;
		if ($action == "update") {
			$this->Mydb->delete ( 'product_assigned_outlets', array (
					'pao_company_id' => get_company_id (),
					'pao_company_app_id' => get_company_app_id (),
					'pao_product_primary_id' => $insert_id,
					'pao_product_id' => $product_id 
			) );
		}
		if (! empty ( $product_outlet )) 
		{
			
			foreach ( $product_outlet as $outlet ) 
			{
				$insert_array = array (
						'pao_outlet_id' => $outlet,
						'pao_product_primary_id' => $insert_id,
						'pao_product_id' => $product_id,
						'pao_company_id' => get_company_id (),
						'pao_company_app_id' => get_company_app_id (),
						'pao_company_app_id' => get_company_app_id (),
						'pao_updated_on' => current_date (),
						'pao_updated_by' => get_company_admin_id (),
						'pao_updated_ip' => get_ip () 
				);
				
				$insert_ids = $this->Mydb->insert ( 'product_assigned_outlets', $insert_array );
			}
			//exit;
			
			// true return
		}
	}
	
	/* this method used to insetr availablity */
	private function insert_avalablity($action, $product_avilablity, $insert_id, $pro_modifier_id) {
		$modifier_primary_id = $insert_id;
		$modifier_id = $pro_modifier_id;
		// echo $action; exit;
		if ($action == "update") {
			$this->Mydb->delete ( 'product_availability', array (
					'product_availability_company_id' => get_company_id (),
					'product_availability_company_app_id' => get_company_app_id (),
					'product_availability_product_primary_id' => $modifier_primary_id,
					'product_availability_product_id' => $modifier_id 
			) );
		}
		if (! empty ( $product_avilablity )) {
			foreach ( $product_avilablity as $avail ) {
				$insert_array = array (
						'product_availability_id' => $avail,
						'product_availability_product_primary_id' => $modifier_primary_id,
						'product_availability_product_id' => $modifier_id,
						'product_availability_company_id' => get_company_id (),
						'product_availability_company_app_id' => get_company_app_id (),
						'product_availability_updated_on' => current_date (),
						'product_availability_updated_by' => get_company_admin_id (),
						'product_availability_updated_ip' => get_ip () 
				);
				
				$insert_id = $this->Mydb->insert ( 'product_availability', $insert_array );
			}
			// true return
		}
	}
	/* this method used to insetr availablity */	
	private function insert_import_combo_products($combo_name=null,$combo_product=array(),$combo_group=array(),$combo_default_product=null,$mainproduct_id,$product_id) 
	{
		                        $producttablename = "pos_products";
		                        $groupname = "pos_product_groups";
		                        if ( ($combo_name !="") && (! empty ( $combo_product ) || ! empty ( $combo_group ))) 
								 {
			
									if($combo_name) 
									{
										$combo_name = addslashes ( $combo_name );
										$qty_val = 1;
										$saving = "Yes";
										$pro_arr = (isset($combo_product))? $combo_product : array();
										$grp_arr = (isset($combo_group))? $combo_group : array();		
										$min_select_qty = 1;
										$max_select_qty = 1;
						 
										$combo_id = $this->Mydb->insert ( 'product_combos', array (
												'combo_name' => $combo_name,
												'combo_qty' => $qty_val,
												'combo_is_saving' => ($saving == "Yes" ? 'Yes' : 'No'),
												'combo_product_primary_id' => $mainproduct_id,
												'combo_product_id' => $product_id,
												'combo_max_select'=>  $max_select_qty,
												'combo_min_select' => $min_select_qty
												
										) );
										
										/* insert combo products */
										if ($combo_id != "" && ! empty ( $pro_arr )) 
										{
											
											foreach ( $pro_arr as $pro ) 
											{
												
												$product_details = $this->Mydb->get_record('*',$producttablename,array('product_name'=> $pro),'');
							                    $comboproduct_id = $product_details['product_id'];
												$is_default = ($pro == $combo_default_product)? "Yes" : "No";
												$this->Mydb->insert ( 'combo_products', array (
														'pro_combo_id' => $combo_id,
														'pro_product_id' => $comboproduct_id,
														'pro_is_default' => $is_default 
												) );
											}
										}
										/* insert combo groups */
										if ($combo_id != "" && ! empty ( $grp_arr )) 
										{
											
											foreach ( $grp_arr as $grp ) 
											{
												$group_details = $this->Mydb->get_record('*',$groupname,array('pro_group_name'=> addslashes($grp)),'');
							                    $combogroup_id = $group_details['pro_group_id'];
												$this->Mydb->insert ( 'combo_products', array (
														'pro_combo_id' => $combo_id,
														'pro_group_id' => $combogroup_id 
												) );
											}
										}
													
									}
								}
	}
	/* this method used to insert tags */
	private function insert_tags($action, $product_tags, $insert_id, $product_id) {
		$product_primary_id = $insert_id;
		$product_id = $product_id;
		if ($action == "update") {
			$this->Mydb->delete ( 'product_assigned_tags', array (
					'tag_product_primary_id' => $product_primary_id,
					'tag_product_id' => $product_id 
			) );
		}
		if (! empty ( $product_tags )) {
			foreach ( $product_tags as $groupid ) {
				$insert_array = array (
						'tag_id' => $groupid,
						'tag_product_primary_id' => $product_primary_id,
						'tag_product_id' => $product_id,
						'tag_updated_on' => current_date (),
						'tag_updated_by' => get_admin_id (),
						'tag_updated_ip' => get_ip () 
				);
				
				$insert_id = $this->Mydb->insert ( 'product_assigned_tags', $insert_array );
			}
		}
	}
	
	/* this method used to add gallery images */
	private function add_gallery_images($files, $image_name, $insert_id, $product_id) {
		if (! empty ( $image_name )) {
			$files = $files;
			$total_image = count ( $image_name );
			$insert_id = $insert_id;
			$product_id = $product_id;
			for($i = 0; $i < $total_image; $i ++) {
				
				$_FILES ['product_gallery'] ['name'] = $files ['product_gallery'] ['name'] [$i];
				$_FILES ['product_gallery'] ['type'] = $files ['product_gallery'] ['type'] [$i];
				$_FILES ['product_gallery'] ['tmp_name'] = $files ['product_gallery'] ['tmp_name'] [$i];
				$_FILES ['product_gallery'] ['error'] = $files ['product_gallery'] ['error'] [$i];
				$_FILES ['product_gallery'] ['size'] = $files ['product_gallery'] ['size'] [$i];
				
				$galery_image = $this->common->upload_image ( 'product_gallery', $this->lang->line ( 'product_gallery_image_folder_name' ) );

				$gallery_arary = array (
						'pro_gallery_image' => $galery_image,
						'pro_gallery_product_primary_id' => $insert_id,
						'pro_gallery_product_id' => $product_id,
						'pro_gallery_updated_on' => current_date (),
						'pro_gallery_updated_by' => get_user_id (),
						'pro_gallery_updated_ip' => get_ip () 
				);
				
				$this->Mydb->insert ( 'product_gallery', $gallery_arary );
			}
		}
	}
	
	/* this method used to delete image and unlink image... */
	function unlink_gallery_image() {
		check_ajax_request (); /* skip direct access */
		$response = array (
				'status' => 'error',
				'msg' => get_label ( 'something_wrong' ) 
		);
		
		$gallery_id = decode_value ( post_value ( 'gallery_id' ) );
		$company_array = array (
				'pro_gallery_primary_id' => $gallery_id 
		);
		
		$gallery = $this->Mydb->get_record ( 'pro_gallery_image', 'product_gallery', $company_array );
		if (! empty ( $gallery )) {
			$this->common->unlink_image ( $gallery ['pro_gallery_image'], '', $this->lang->line ( 'product_gallery_image_folder_name' ) ); /* unlink image.. */
			$this->Mydb->delete ( 'product_gallery', $company_array );
			
			$response = array (
					'status' => 'success',
					'msg' => 'success' 
			);
		}
		
		echo json_encode ( $response );
	}
	
	/* this method used to clear all session values and reset search values */
	function refresh() {
		$this->session->unset_userdata ( $this->module . "_search_field" );
		$this->session->unset_userdata ( $this->module . "_search_value" );
		$this->session->unset_userdata ( $this->module . "_search_status" );
		$this->session->unset_userdata ( $this->module . "_order_by_value" );
		$this->session->unset_userdata ( $this->module . "_order_by_value" );
		$this->session->unset_userdata ( $this->module . "_category_id" );
		redirect ( base_url () . $this->module );
	}
	
	/* this method used to common module labels */
	private function load_module_info() {
		$data = array ();
		$data ['module_label'] = $this->module_label;
		$data ['module_labels'] = $this->module_labels;
		$data ['module'] = $this->module;
		return $data;
	}

	/* this method used to validate posted category */
	public function validate_category()
	{
		$category_id = post_value('product_category');
			/* validate category id */
			$category_val = $this->Mydb->get_record('pro_cate_primary_id,pro_cate_id','pos_product_categories',
					array(
							'pro_cate_id' => $category_id)
						);
			if(empty($category_val)){
				/* show error message */
				$result ['status'] = 'error';
				$result ['message'] = get_label ( 'something_wrong' );
				echo json_encode($result); exit;
			}else {
				 return $category_val;
			}
	}
	/* this method used to insetr product catogaries availablity */

	/* this method used to insert tags */
	private function insert_product_tags($action, $product_tags, $insert_id, $product_id) {
		$product_primary_id = $insert_id;
		$product_tags = $product_tags;
		if (! empty ( $product_tags )) {
			foreach ( $product_tags as $key=>$groupid ) {
				$insert_array = array (
						'tag_id' => $groupid,
						'tag_product_primary_id' => $product_primary_id,
						'tag_product_id' => $product_id,
						'tag_updated_on' => current_date (),
						'tag_updated_by' => get_admin_id (),
						'tag_updated_ip' => get_ip () 
				);
				$insert_id = $this->Mydb->insert ( 'pos_product_assigned_tags', $insert_array );
			}
		}
	}	
	

	/* this method used to insert gallery images */
	private function add_product_gallery_images($action,$image_name, $insert_id, $product_id) {
			$product_avilablity = $image_name;
			$prinsert_id = $insert_id;
			$product_idimg = $product_id;
		if ($action == "update") {
			$this->Mydb->delete ( 'pos_product_gallery', array (
					'pro_gallery_product_primary_id' => $prinsert_id,
					'pro_gallery_product_id' => $product_idimg 
			));
		}
			if (! empty ( $product_avilablity )) {
			foreach ( $product_avilablity as $avail ) {
				
				$gallery_arary = array (
						'pro_gallery_image' => $avail,
						'pro_gallery_product_primary_id' => $prinsert_id,
						'pro_gallery_product_id' => $product_idimg,
						'pro_gallery_updated_on' => current_date (),
						'pro_gallery_updated_by' => get_admin_id (),
						'pro_gallery_updated_ip' => get_ip () 
				);
				
				$this->Mydb->insert ( 'pos_product_gallery', $gallery_arary );
			}
		}
	}

	
}
/* End of file products.php  */
