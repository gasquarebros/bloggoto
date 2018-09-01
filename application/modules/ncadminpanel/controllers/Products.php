<?php
/**************************
Project Name	: POS
Created on		: 3  March, 2016
Last Modified 	: 30 June, 2016
Description		: Page contains manage product categories

***************************/
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Products extends CI_Controller 
{

	public function __construct() 
	{

		parent::__construct ();
		$this->module = "products";
		$this->authentication->admin_authentication ( get_label ( 'products_module' ) );
		$this->module_label = get_label ( 'product_label' );
		$this->module_labels = get_label ( 'product_labels' );
		$this->folder = "products/";
		$this->table = "products";
		$this->primary_key = 'product_primary_id';
		$this->load->library ( 'common' );
		$this->load->helper ( 'products' );
	}

	/* this method used to list all records . */
	public function index() 
	{
		$data = $this->load_module_info ();
		$this->layout->display_admin ( $this->folder . $this->module . "-list", $data );
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
		$admin_records = admin_records_perpage ();
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
			$this->form_validation->set_rules ( 'product_customer_id', 'lang:product_customer_id', 'required' );
		
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
					'product_customer_id' => post_value ( 'product_customer_id' ),
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
					'product_created_by' => get_admin_id (),
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
		
		$get_all_users_list = get_all_users_list();
		$data['all_users'] = $get_all_users_list;
		/* Common labels */
		$data ['breadcrumb'] = $data ['form_heading'] = get_label ( 'add' ) . ' ' . $this->module_label;
		$data ['module_action'] = 'add';
		//print_r($data);exit;
		$this->layout->display_admin ( $this->folder . $this->module . '-add', $data );
	}
	
	private function insert_product_assosiate($parent_product)
	{
		$modelsProductAssociates = $this->input->post('ProductAssociates');
		$associate_keys = array_keys($modelsProductAssociates);
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

				$categories = explode('~',post_value ( 'subcategory' ));

				// insert or update need to perform here
				if($modelsProductAssociates[0]['product_ids'][$subprod_key] !='')
				{
					$product_slug = make_slug ( $model_product_sublevels, $this->table, 'product_slug', array (
						$this->primary_key . "!=" => $modelsProductAssociates[0]['product_ids'][$subprod_key]
					));
					$record = $this->Mydb->get_record ( '*', $this->table, array (
						$this->primary_key => $modelsProductAssociates[0]['product_ids'][$subprod_key]
					) );
					
					$update_array = array (
						'product_type' => 'simple',
						'product_name' => $model_product_sublevels,
						'product_alias' => '',
						'product_sku' => $modelsProductAssociates[0]['product_sku'][$subprod_key],
						'product_parent_id' => $parent_product,
						'product_quantity' => $modelsProductAssociates[0]['product_qty'][$subprod_key],
						'product_slug' => $product_slug,
						'product_customer_id' => post_value ( 'product_customer_id' ),
						'product_category_id' => $categories[0],
						'product_subcategory_id' => $categories[1],
						'product_short_description' => post_value ( 'product_short_description' ),
						'product_long_description' => post_value ( 'product_long_description' ),
						'product_status' => (post_value ( 'status' ) == "A" ? 'A' : 'I'),
						'product_price' => $modelsProductAssociates[0]['product_price'][$subprod_key],
						'product_special_price' => $modelsProductAssociates[0]['product_special_price'][$subprod_key],
						'product_updated_on' => current_date (),
						'product_updated_by' => get_admin_id (),
						'product_updated_ip' => get_ip () 
					);
					
					
					$this->Mydb->update ( $this->table, array (
						$this->primary_key => $modelsProductAssociates[0]['product_ids'][$subprod_key] 
					), $update_array );
					$insert_id = $modelsProductAssociates[0]['product_ids'][$subprod_key];
				}
				else
				{
					$product_slug = make_slug ( $model_product_sublevels, $this->table, 'product_slug' );
					$insert_array = array (
						'product_type' => 'simple',
						'product_name' => $model_product_sublevels,
						'product_alias' => '',
						'product_sku' => $modelsProductAssociates[0]['product_sku'][$subprod_key],
						'product_parent_id' => $parent_product,
						'product_quantity' => $modelsProductAssociates[0]['product_qty'][$subprod_key],
						'product_slug' => $product_slug,
						'product_customer_id' => post_value ( 'product_customer_id' ),
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
						'product_created_by' => get_admin_id (),
						'product_created_ip' => get_ip ()
					);

					
					$insert_id = $this->Mydb->insert ( $this->table, $insert_array );
				}
				echo $this->db->last_query();
				
				
				$attributes_subprod = array();
				foreach($associate_keys as $ass_att_key=>$assocaite_attribute)
				{
					
					if($ass_att_key > 0)
					{
						$attributes_subprod[]= ['prod_ass_att_attribute_id' => $assocaite_attribute,'prod_ass_att_attribute_name'=>'','prod_ass_att_attribute_value_name'=>'','prod_ass_att_attribute_value_id'=>$modelsProductAssociates[$assocaite_attribute][$subprod_key],'prod_ass_att_product_id'=>$insert_id,'prod_ass_att_parent_productid'=>$parent_product];
					}
				}
				$associates_products[]=['prod_ass_product_id' => $parent_product,'prod_ass_sub_product_id'=>$insert_id];
				if(!empty($attributes_subprod))
				{
					$this->db->insert_batch('product_assigned_attributes',$attributes_subprod);
				}
				$subsequence++;
			}
		}
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
		(empty ( $record )) ? redirect ( camp_url () . $this->module ) : '';

		if ($this->input->post ( 'action' ) == "edit") {

			$product_alias = $this->input->post ( 'product_alias' );
			check_ajax_request (); /* skip direct access */
			
			$this->form_validation->set_rules ( 'product_name', 'lang:product_name', 'required|callback_productnameexists' );
			$this->form_validation->set_rules ( 'product_sku', 'lang:product_sku', 'required|callback_validate_sku' );
			$this->form_validation->set_rules ( 'product_price', 'lang:product_price', 'required' );
			$this->form_validation->set_rules ( 'status', 'lang:status', 'required' );
			$this->form_validation->set_rules ( 'product_customer_id', 'lang:product_customer_id', 'required' );
		
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
					'product_customer_id' => post_value ( 'product_customer_id' ),
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
					'product_updated_by' => get_admin_id (),
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
				

				echo $this->db->last_query();

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
			
			$assigned_modifiers = $this->Mydb->get_all_records ( 'assigned_mod_modifier_id,assigned_mod_product_id', 'product_assigned_modifiers', $where );
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
		
		$get_all_users_list = get_all_users_list();
		$data['all_users'] = $get_all_users_list;
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
					'product_updated_by' => get_admin_id (),
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
					'product_updated_by' => get_admin_id (),
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
								'product_updated_by' => get_admin_id (),
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
						'pro_gallery_updated_by' => get_admin_id (),
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
		redirect ( admin_url () . $this->module );
	}
	
	/* this method used to common module labels */
	private function load_module_info() {
		$data = array ();
		$data ['module_label'] = $this->module_label;
		$data ['module_labels'] = $this->module_labels;
		$data ['module'] = $this->module;
		return $data;
	}
	
	public function import() {

		$result=array();
		$settings = $this->get_compnay_settings ();
		$data['apply_product_type'] = $settings['client_producttype_enable_option'];
		$data['condiment_enable'] = $settings['client_condiment_enable'];
		$data['reward_enable'] = $settings['client_loyality_enable'];
		$data['category_modifier_enabled'] = $settings['client_category_modifier_enable'];

		if ($this->input->post ('action' ) == "Add") 
		{
				check_ajax_request ();		    
				$this->form_validation->set_rules ( 'csc_file11', 'lang:import_csv_file', 'callback_validate_file1' );
				if (empty($_FILES['csc_file11']['name']))
				{
				$this->form_validation->set_rules('csc_file11', 'lang:import_csv_file','required');	
				}  
				     
			/*if($this->form_validation->run()==TRUE)
			{ */
			
		
			if(pathinfo($_FILES['csc_file11']['name'], PATHINFO_EXTENSION) == 'csv') 
				{
					if ($_FILES['csc_file11']['name'] != '')
					{
							$error = false;
							$line = false;
							$lname = '';
							$fname = ''; 
							$donotreadfirst = true;     

							ini_set('auto_detect_line_endings', true);
				  
					  $handle = fopen($_FILES["csc_file11"]["tmp_name"], "r");
					  while (($line_of_text = fgetcsv($handle, 2000, ",")) !== FALSE)
					  {

						if($donotreadfirst)
						{
							$donotreadfirst = false;
							continue;
						}
						$product_parent = trim(stripslashes($line_of_text[0]));  
						$product_default_check = trim(stripslashes($line_of_text[1]));
						$product_default = ucfirst(strtolower($product_default_check));
						$mainproductname = trim(stripslashes($line_of_text[2]));
						$brand = trim(stripslashes($line_of_text[3]));
						$pro_cate_name = trim(stripslashes($line_of_text[4]));
						$prosubcate = trim(stripslashes($line_of_text[5]));
						$productsku = trim(stripslashes($line_of_text[6]));
						$tags = trim(stripslashes($line_of_text[14]));
						$tagsarray = explode(',',trim(stripslashes($line_of_text[14])));
						$productcost = trim(stripslashes($line_of_text[7]));
						$productprice = trim(stripslashes($line_of_text[8]));					
						//$modifiername_check = (trim(stripslashes($line_of_text[9])));
						$modifiername = (trim(stripslashes($line_of_text[9])));
						$modifiername_check = (trim(stripslashes($line_of_text[9])) !='')?trim(stripslashes($line_of_text[9])):$modifiername_check;
						$modifierarrayname = explode(',',trim(stripslashes($line_of_text[9])));
						$modifiervalue = trim(stripslashes($line_of_text[10]));
						$modifierarrayvalues = explode(',',trim(stripslashes($line_of_text[10])));
						$productshort = trim(stripslashes($line_of_text[11]));
						$productdesc = trim(stripslashes($line_of_text[12]));
						$proavailvalue = explode(',',trim(stripslashes($line_of_text[13])));
						$thumbilimage = trim(stripslashes($line_of_text[15]));
						$gallery = (trim(stripslashes($line_of_text[16])));
						$galleryimage = explode(',',trim(stripslashes($line_of_text[16])));
						$metatilte = trim(stripslashes($line_of_text[17]));
						$metakeywords = trim(stripslashes($line_of_text[18]));
						$metadescription = trim(stripslashes($line_of_text[19]));
						$productalias = trim(stripslashes($line_of_text[20]));	
						$p_outlet = trim(stripslashes($line_of_text[21]));				
						$product_outlet = explode('~',trim(stripslashes($line_of_text[21])));
						$brandcompanytags = trim(stripslashes($line_of_text[22]));
						$brandcompanytagsarray = explode(',',trim(stripslashes($line_of_text[22])));
                        //print_r($product_outlet);
                        //exit;
						/*product categories table field*/
						$procatetablename = "pos_product_categories";
						$catcompany_array = array('pro_cate_company_id' => get_company_id(),'pro_cate_app_id' => get_company_app_id());
						$procat_cate_id = get_guid($procatetablename,'pro_cate_id',$catcompany_array);
						$procat_cate_slug  = make_slug($pro_cate_name,$procatetablename,'pro_cate_slug',$catcompany_array);
						$procatefiled = array(
						'pro_cate_name' => addslashes($pro_cate_name),
						'pro_cate_id' => $procat_cate_id,
						'pro_cate_slug'=>$procat_cate_slug,
						'pro_cate_company_id'=>get_company_id(),
						'pro_cate_app_id' => get_company_app_id (),
						'pro_cate_status'=>"A",
						'pro_cate_sequence'=>1,
						'pro_cate_app_id'=>get_company_app_id(),
						'pro_cate_created_on' => current_date (),
						'pro_cate_created_by' => get_company_admin_id (),
						'pro_cate_created_ip' => get_ip ()					
						);
						
						$wherepro = array('pro_cate_app_id' => get_company_app_id (),'pro_cate_name'=> addslashes($pro_cate_name));
						$res = $this->Mydb->get_record('*',$procatetablename,$wherepro,'');					
						if(!empty($res)) 
						{
						$product_cate_id = $res['pro_cate_id'];
						$product_primary = $res['pro_cate_primary_id'];
						} else {
							$id = $this->Mydb->insert($procatetablename, $procatefiled);
							$res = $this->Mydb->get_record('*',$procatetablename,array('pro_cate_primary_id'=> $id),'');
							$product_cate_id = $res['pro_cate_id'];
							$product_primary = $res['pro_cate_primary_id'];
							if ($id != "") 
							{
								/* insert modifier availability */
								$product_category_type="Category";
								$this->insert_avalablity_pro ( 'add', $proavailvalue, $product_primary, $product_cate_id,$product_category_type);
							}
						}

						/*MODIFIER TABLE*/
						$modifiertablename = "pos_product_modifiers";
								
						$modifier_ref_ids = array();
						$pro_modifier_id_ar = array();
						if($modifiername != '') {
							$modifier_ref_ids = explode(',',$modifiername);
							if(!empty($modifier_ref_ids)) {
							foreach($modifier_ref_ids as $mod_name) {		
								$modifiercompany_array = array (
								'pro_modifier_company_id' => get_company_id (),
								'pro_modifier_app_id' => get_company_app_id () 
								);
					   $pro_modifier_id = get_guid ( $modifiertablename, 'pro_modifier_id', $modifiercompany_array );					
									
					            /*search product name and parent product same*/	
					
					            /*insert options function*/
					            $main_product_parent_product = '';
								$modifierfiled = array (
								'pro_modifier_name' =>addslashes($mod_name),
								'pro_modifier_id' => $pro_modifier_id,
								'pro_modifier_company_id' => get_company_id (),
								'pro_modifier_status' => 'A',
								'pro_modifier_min_select' => 1,
								'pro_modifier_max_select' => 1,
								'pro_modifier_sequence'=>1,
								'pro_modifier_app_id' => get_company_app_id (),
								'pro_modifier_created_on' => current_date (),
								'pro_modifier_created_by' => get_company_admin_id (),
								'pro_modifier_created_ip' => get_ip () 
								);	
								$res = $this->Mydb->get_record('*',$modifiertablename,array('pro_modifier_app_id' => get_company_app_id (),'pro_modifier_name'=> addslashes($mod_name)),'');					
								if(!empty($res)) 
								{
									
										$modifiername_last_id = encode_value($res['pro_modifier_id']);
										//$modifier_name_value = $res['pro_modifier_value_modifier_id'];
										$pro_modifier_id_ar[] = $res['pro_modifier_id'];
								} else 
								{
									
									$id = $this->Mydb->insert($modifiertablename, $modifierfiled);
									$res = $this->Mydb->get_record('*',$modifiertablename,array('pro_modifier_primary_id'=> $id),'');
									$modifiername_last_id = encode_value($res['pro_modifier_id']);
									//$modifier_name_value = $res['pro_modifier_value_modifier_id'];
									//echo $pro_modifier_id;
									//exit;
									$pro_modifier_id_ar[] = $pro_modifier_id;
								}
							}						
						}
					}
					
					//echo '<pre>';
					//print_r($pro_modifier_id_ar);
					//exit;
					/*MODIFIER VALUES TABLE*/	
						$modifiervaluetablename = "pos_product_modifier_values";
						$modi_values_ids = array();					
						$modifer_selected_option = array();
						$modi_value_ref_id = array();
						if($modifiervalue != '') 
						{
							
							$modi_values_ids = explode(',',$modifiervalue);
							
							if(!empty($modi_values_ids)) {
								$i=0;
			
								foreach($modi_values_ids as $modi_values) {	
									//echo $pro_modifier_id_ar[$i];
									//echo '<br>';								
									$modifier_val = $this->validate_modifiervalue($pro_modifier_id_ar[$i]);
									//echo '<pre>';
									//print_r($modifier_val);
									//echo '<br>';	
									//echo '<pre>';
									//print_r($modifiervalue);
									//exit;							
									$modivalcompany_array = array('pro_modifier_value_company_id' => get_company_id(),'pro_modifier_value_app_id' => get_company_app_id());
									$pro_modifier_value_id = get_guid($modifiervaluetablename,'pro_modifier_value_id',$modivalcompany_array);
									$modifiervaluefiled = array (
											'pro_modifier_value_name' => addslashes($modi_values),
											'pro_modifier_value_modifier_primary_id'=> $modifier_val['pro_modifier_primary_id'],
											'pro_modifier_value_modifier_id' => $modifier_val['pro_modifier_id'],
											'pro_modifier_value_id' => $pro_modifier_value_id,
											'pro_modifier_value_sequence'=>1,
											'pro_modifier_value_company_id'=>get_company_id(),
											'pro_modifier_value_is_default'=>'Yes',
											'pro_modifier_value_status' => 'A',
											'pro_modifier_value_app_id'=>get_company_app_id(),
											'pro_modifier_value_created_on' => current_date(),
											'pro_modifier_value_created_by' => get_company_admin_id(),
											'pro_modifier_value_created_ip' => get_ip() 
									);

									$res = $this->Mydb->get_record('*',$modifiervaluetablename,array('pro_modifier_value_app_id' => get_company_app_id (),'pro_modifier_value_name'=>addslashes($modi_values),'pro_modifier_value_modifier_id'=>$pro_modifier_id_ar[$i]),'');					

									if(!empty($res)) {
										$modi_value_ref_id[] = $res['pro_modifier_value_id'];
						$modifer_selected_option[] = $res['pro_modifier_value_modifier_id'].'~'.$res['pro_modifier_value_id'];

										} else {
											$id = $this->Mydb->insert($modifiervaluetablename, $modifiervaluefiled);
											$res = $this->Mydb->get_record('*',$modifiervaluetablename,array('pro_modifier_value_primary_id'=> $id),'');
											$modi_value_ref_id[] = $res['pro_modifier_value_id'];
											$modifer_selected_option[] = $res['pro_modifier_value_modifier_id'].'~'.$res['pro_modifier_value_id'];
										}	
										$i++;								
								}
							}
						}
						
						/*PRODUCT SUB CATOGARIES TABLE*/			
						$category_val = $this->validate_category($product_cate_id);
						$prosubcatetablename = "pos_product_subcategories";
						if($prosubcate == "")
						{
							$prosubcate = $pro_cate_name;
						}					
						$company_array = array('pro_subcate_company_id' => get_company_id(),'pro_subcate_app_id' => get_company_app_id());
						$pro_subcate_id = get_guid($prosubcatetablename,'pro_subcate_id',$company_array);
						$pro_subcate_slug  = make_slug($prosubcate,$prosubcatetablename,'pro_subcate_slug',$company_array);
						$prosubcatefiled = array(
						'pro_subcate_id'=>$pro_subcate_id,					
						'pro_subcate_company_id'=>get_company_id(),
						'pro_subcate_app_id'=>get_company_app_id(),
						'pro_subcate_category_primary_id '=> $category_val['pro_cate_primary_id'],
						'pro_subcate_category_id' => $category_val['pro_cate_id'],
						'pro_subcate_name'=>addslashes($prosubcate),
						'pro_subcate_status'=>'A',
						'pro_subcate_sequence'=>1,
						'pro_subcate_slug'=>$pro_subcate_slug,
						'pro_subcate_created_on'=>current_date (),
						'pro_subcate_created_by'=>get_company_admin_id (),
						'pro_subcate_created_ip'=>get_ip ()
						);

						$res = $this->Mydb->get_record('*',$prosubcatetablename,array('pro_subcate_app_id' => get_company_app_id (),'pro_subcate_name'=> addslashes($prosubcate)),'');					
						if(!empty($res)) {
								$pro_cate_id = $res['pro_subcate_id'];
								$pro_subcate_category_primary = $res['pro_subcate_category_primary_id'];
						} else {

							$id = $this->Mydb->insert($prosubcatetablename, $prosubcatefiled);
							$res = $this->Mydb->get_record('*',$prosubcatetablename,array('pro_subcate_primary_id'=> $id),'');
							$pro_cate_id = $res['pro_subcate_id'];
							$pro_subcate_category_primary = $res['pro_subcate_category_primary_id'];

						if($id != "")
						{
												
							/* insert modifier availability */
							$product_category_type="Subcategory";
							$this->insert_avalablity_pro ( 'add', $proavailvalue, $id, $pro_cate_id,$product_category_type); 
							
							/* insert product modifiers */
							$this->insert_subcategory_modifiers( 'add', $modifiername_last_id, $pro_subcate_category_primary, $pro_cate_id ); 
							}
						}
					/*PRODUCT BRANDS TABLE*/
					$pro_brand_cate_id = '';
					if($brand != '') {
					$brandtablename = "pos_product_brands";
					$brandscompany_array = array('pro_brand_company_id' => get_company_id(),'pro_brand_app_id' => get_company_app_id());
					$pro_brand_id = get_guid($brandtablename,'pro_brand_id',$brandscompany_array);
					$pro_brand_slug  = make_slug($brand,$brandtablename,'pro_brand_slug',$brandscompany_array);
					$brandfiled = array (
							'pro_brand_name' => addslashes($brand),
							'pro_brand_id' => $pro_brand_id,
							'pro_brand_slug'=>$pro_brand_slug,
							'pro_brand_company_id'=>get_company_id(),
							'pro_brand_status' => 'A',						
							'pro_brand_app_id'=>get_company_app_id(),
							'pro_brand_created_on' => current_date (),
							'pro_brand_created_by' => get_company_admin_id (),
							'pro_brand_created_ip' => get_ip () 
					);
					$res = $this->Mydb->get_record('*',$brandtablename,array('pro_brand_app_id' => get_company_app_id (),'pro_brand_name'=> addslashes($brand)),'');					
					
					if(!empty($res)) {
					$pro_brand_cate_id = $res['pro_brand_id'];
					
					} 
					else {
						$id = $this->Mydb->insert($brandtablename, $brandfiled);
						$res = $this->Mydb->get_record('*',$brandtablename,array('pro_brand_primary_id'=> $id),'');
						$pro_brand_cate_id = $res['pro_brand_id'];
					
					}	
				}		
						/*BRAND TAGS TABLE*/									
						$brandtagstablename = "pos_product_brand_tags";
						$ref_brandcompanytag_ids = array();

						if($brandcompanytags != '') {
							
							$brandcompanytags_arr = explode(',',$brandcompanytags);
							if(!empty($brandcompanytags_arr)) {
										
								foreach($brandcompanytags_arr as $brandcompany_name) {
											
									$brandtagscompany_array = array('pro_brand_tag_company_id' => get_company_id(),'pro_brand_tag_app_id' => get_company_app_id());
									$tagspro_tag_id = get_guid($brandtagstablename,'pro_brand_tag_id',$brandtagscompany_array);
									$brandcompanytagsfiled = array (
									'pro_brand_tag_name' => addslashes($brandcompany_name),
									'pro_brand_tag_id' => $tagspro_tag_id,
									'pro_brand_tag_company_id'=>get_company_id(),
									'pro_brand_tag_status' => 'A',
									'pro_brand_tag_app_id'=>get_company_app_id(),
									'pro_brand_tag_created_on' => current_date (),
									'pro_brand_tag_created_by' => get_company_admin_id (),
									'pro_brand_tag_created_ip' => get_ip () 
									);

									$res = $this->Mydb->get_record('*',$brandtagstablename,array('pro_brand_tag_app_id' => get_company_app_id (),'pro_brand_tag_name'=> addslashes($brandcompany_name)),'');					

									if(!empty($res)) {
										$ref_brandcompanytag_ids[] = $res['pro_brand_tag_id'];
									} else {
										$id = $this->Mydb->insert($brandtagstablename, $brandcompanytagsfiled);
										$res = $this->Mydb->get_record('*',$tagstablename,array('pro_brand_tag_primary_id'=> $id),'');
										$ref_brandcompanytag_ids[] = $res['pro_brand_tag_id'];
									}
								}
							}
						}			
						/*TAGS TABLE*/	
						$tagstablename = "pos_product_tags";
						$ref_tag_ids = array();

						if($tags != '') {
							
							$tags_arr = explode(',',$tags);
							if(!empty($tags_arr)) {
										
								foreach($tags_arr as $tag_name) {
											
									$tagscompany_array = array('pro_tag_company_id' => get_company_id(),'pro_tag_app_id' => get_company_app_id());
									$tagspro_tag_id = get_guid($tagstablename,'pro_tag_id',$tagscompany_array);
									$tagsfiled = array (
									'pro_tag_name' => addslashes($tag_name),
									'pro_tag_id' => $tagspro_tag_id,
									'pro_tag_company_id'=>get_company_id(),
									'pro_tag_status' => 'A',
									'pro_tag_app_id'=>get_company_app_id(),
									'pro_tag_created_on' => current_date (),
									'pro_tag_created_by' => get_company_admin_id (),
									'pro_tag_created_ip' => get_ip () 
									);

									$res = $this->Mydb->get_record('*',$tagstablename,array('pro_tag_app_id' => get_company_app_id (),'pro_tag_name'=> addslashes($tag_name)),'');					

									if(!empty($res)) {
										$ref_tag_ids[] = $res['pro_tag_id'];
									} else {
										$id = $this->Mydb->insert($tagstablename, $tagsfiled);
										$res = $this->Mydb->get_record('*',$tagstablename,array('pro_tag_primary_id'=> $id),'');
										$ref_tag_ids[] = $res['pro_tag_id'];
									}
								}
							}
						}				
					/*PRODUCT TABLE*/
					$producttablename = "pos_products";
					$product_company_array = array (
							'product_company_id' => get_company_id (),
							'product_company_app_id' => get_company_app_id () 
					);
					$product_id = get_guid ( $producttablename, 'product_id', $product_company_array);
					$product_slug = make_slug ( $mainproductname, $producttablename, 'product_slug', $product_company_array);
					if($productsku == "")
					{
						$productsku = $product_slug;
					}

					$is_modifier_default = ($product_default == 'Yes'? 'Yes' : 'No');
					$parent_primary_id = $parent_id =  "";

					/*search product name same*/
					$main_product_name = '';
					/*if($mainproductname != "") 
					{
						$mainproduct_rec = $this->Mydb->get_record ('product_name', $producttablename, array (
								'product_name' => addslashes($mainproductname),'product_company_app_id' => get_company_app_id ()),'' );
						if(!empty($mainproduct_rec))
						{
							$main_product_name = $mainproduct_rec['product_name'];						
						}
					}*/
					if($product_parent != "") 
					{

						/*$parent_rec = $this->Mydb->get_record ( 'product_primary_id,product_id,product_name', $producttablename, array (
								'product_name' => addslashes($product_parent),'product_parent_primary_id'=>'','product_company_app_id' => get_company_app_id ()),'' );*/
								
						$parent_rec = $this->Mydb->get_all_records ('product_primary_id,product_id,product_name,product_price', $producttablename,array (
								'product_name' => addslashes($product_parent),'product_parent_primary_id'=>'','product_company_app_id' => get_company_app_id ()), 1, 0,array('product_primary_id' => 'DESC'), '', '', '' );		
								

						if(!empty($parent_rec))
						{
							$parent_primary_id = $parent_rec[0]['product_primary_id'];
							$parent_id = $parent_rec[0]['product_id'];
						}
					}				
						$modifier_value_check = ($modifiervalue != '')?'-'.$modifiervalue:'';
						/*$cheking_product_name=($main_product_name == $mainproductname) ? addslashes($mainproductname).addslashes($modifier_value_check) : addslashes($mainproductname);*/
						$insert_array = array (
								'product_name' =>addslashes($mainproductname),
								'product_sku' => addslashes($productsku),
								'product_alias' => addslashes($productalias),							
								'product_id' => $product_id,
								'product_type'=>1,
								'product_slug' => $product_slug,
								'product_parent_primary_id' => $parent_primary_id,
								'product_parent_id' => addslashes($parent_id),
								'product_company_id' => get_company_id (),
								'product_company_app_id' => get_company_app_id (),
								'product_category_id' => $product_cate_id,
								'product_subcategory_id' => $pro_cate_id,
								'product_brand_id' => $pro_brand_cate_id,
								'product_short_description' => ucfirst(addslashes($productshort)),
								'product_long_description' => ucfirst(addslashes($productdesc)),
								'product_thumbnail' => $thumbilimage,
								'product_status' => 'A',
								'product_alias_is_default' => $is_modifier_default,
								'product_cost' => $productcost,
								'product_price' => $productprice,
								'product_bagel_min_select' => 1,
								'product_bagel_max_select' => 1,
								'product_sequence'=>1,
								'product_meta_title' => $metatilte,
								'product_meta_keywords' => $metakeywords,
								'product_meta_description' => $metadescription,
								'product_import' => 1,
								'product_created_on' => current_date (),
								'product_created_by' => get_company_admin_id (),
								'product_created_ip' => get_ip () 
						);
						/*$whereproduct = array('product_company_app_id' => get_company_app_id (),'product_name'=> addslashes($mainproductname));
						$res = $this->Mydb->get_record('*',$producttablename,$whereproduct,'');					
						if(!empty($res)) {
							$mainproduct_primary_id = $res['product_primary_id'];
							$mainproduct_id = $res['product_id'];
						}else {*/							
							$where=array('(product_name = "'.addslashes($mainproductname).'" OR product_sku = "'.addslashes($productsku).'")' => NULL, 'product_company_id' => get_company_id (), 'product_company_app_id' => get_company_app_id (), 'product_category_id' => $product_cate_id );
                            $product_exit = $this->Mydb->get_record('*', $producttablename,$where, array('product_company_id' => get_company_id (),
								'product_company_app_id' => get_company_app_id ()));
							//echo $this->db->last_query();
						    //exit;
							//echo '<pre>';
							//print_r($product_exit);
							//exit;	
							if(empty($product_exit))
							{ 
							$id = $this->Mydb->insert($producttablename, $insert_array);
							$res = $this->Mydb->get_record('*',$producttablename,array('product_primary_id'=> $id),'');
							$mainproduct_id = $res['product_primary_id'];						
							if(!empty($product_parent) && $is_modifier_default == "Yes")
							{
							
							      //$get_parent_price = $this->Mydb->get_record('product_price',$producttablename,array('product_parent_primary_id'=> $parent_primary_id));
							      
							      $productprice_fi = (isset($parent_rec[0]['product_price'])? $parent_rec[0]['product_price'] : $productprice );
							      
									  $checkprice = $this->Mydb->update($producttablename,array('product_price'=>'','product_company_id' => get_company_id (),
								'product_company_app_id' => get_company_app_id (),'product_primary_id'=>$id),array('product_price'=>$productprice_fi));  
							}						
							
							//echo $this->db->last_query();

							if ($id != "") {
								//echo '<pre>';
								//print_r($pro_modifier_id_ar);
								//exit;
								/* insert product availability */
								$this->insert_avalablity_product( 'add', $proavailvalue, $mainproduct_id, $product_id );
								/* insert product Outlet */
								if($p_outlet!="")
								{
									if(!empty($product_outlet))
									{
										$this->insert_product_outlet ( 'add', $product_outlet, $mainproduct_id, $product_id );
									}
							    }							
								/* insert product tags availability */
								$this->insert_product_tags('add', $ref_tag_ids, $mainproduct_id, $product_id);
								/* insert product brandcompany tags availability */
								$this->insert_product_brandcompanytags('add', $ref_brandcompanytag_ids, $mainproduct_id, $product_id);
								/* insert alias table*/
								$this->insert_alias ( 'add', $modifer_selected_option, $mainproduct_id, $product_id ,$is_modifier_default,$parent_id);
								/* insert product modifiers .. */
								$this->insert_modifiers_product ( 'add', $pro_modifier_id_ar, $mainproduct_id, $product_id );
								/*  insert category modifier details...  */
									
									if($settings['client_category_modifier_enable'] == 1 ) {						
										if(!empty($pro_modifier_id_ar)){
										$this->insert_options('add', $pro_modifier_id_ar,$mainproduct_id,$product_id);
										}
									}
								    /* insert gallery images */
								   if($gallery!="")
								   { 
								    if (!empty($galleryimage)) 
								    {										
										$this->add_product_gallery_images('add',$galleryimage, $mainproduct_id, $product_id );
									   
									}
								   }
									
								}
							}
					}
						fclose($handle); 
							$result ['status'] = 'success';
					        $result ['message'] = 'Your Product has been added successfully.';								
					 }
					else     
					{
						$result ['status'] = 'error';	
					    $result ['message'] = 'invalid File name';	
					}				 
				}
				else     
				{
					$result ['status'] = 'error';	
					$result ['message'] = 'This is not an allowed file type';	
                }	
			   
				$this->session->set_flashdata ( 'admin_success', sprintf ( $this->lang->line ( 'success_message_add' ), $this->module_label ) );
				echo json_encode ( $result );
				exit ();
			}			
		$data=array();		
		$data ['module_label'] = $this->module_label;
		$data ['module_labels'] = $this->module_labels;
		$data ['module'] = $this->module;
		$this->load->view($this->folder."/".$this->module."-import",$data);		
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

	/* clear imported csv file */
	public function clear_import ()
    {
			if ($this->input->post ('action' ) == "Add")
			{
				$record_product = $this->Mydb->get_all_records ( $select_array, $this->table, array (
				'product_company_id' => get_company_id (),
				'product_company_app_id' => get_company_app_id () ,
				'product_import' => 1 
				));

				foreach($record_product as $product_res) {

					$product_primary_id = $product_res['product_primary_id'];
					$product_id = $product_res['product_id'];

					$this->Mydb->delete('pos_product_alias',array('pa_product_primary_id'=>$pa_product_primary_id));
					$this->Mydb->delete('pos_product_assigned_outlets',array('pao_product_primary_id'=>$pa_product_primary_id));					
					$this->Mydb->delete('pos_product_assigned_alias',array('alias_product_primary_id'=>$pa_product_primary_id));
					$this->Mydb->delete('pos_product_assigned_groups',array('pag_product_primary_id'=>$pa_product_primary_id));
					
					$this->Mydb->delete('pos_product_assigned_modifiers',array('psm_product_primary_id'=>$pa_product_primary_id));

					$this->Mydb->delete('pos_product_assigned_outlets',array('pao_product_primary_id'=>$pa_product_primary_id));

					$this->Mydb->delete('pos_product_assigned_tags',array('tag_product_primary_id'=>$pa_product_primary_id));

					$this->Mydb->delete('pos_product_availability',array('product_availability_product_primary_id'=>$pa_product_primary_id));

					$this->Mydb->delete('pos_product_bagel_modifiers',array('pbm_product_primary_id'=>$pa_product_primary_id));

					$this->Mydb->delete('pos_product_combos',array('combo_product_primary_id'=>$pa_product_primary_id));

					$this->Mydb->delete('pos_product_gallery',array('pro_gallery_product_primary_id'=>$pa_product_primary_id));

					$this->Mydb->delete('pos_product_groups_details',array('group_detail_product_id'=>$product_id));

					$this->Mydb->delete('pos_product_menu_component',array('pro_component_default_product_id'=>$product_id));

					$this->Mydb->delete('pos_product_menu_component_items',array('menu_component_product_id'=>$product_id));

					//pos_product_menu_set_component
					//pos_product_menu_set_component_items

				}

					$recorddeleted = $this->Mydb->delete('pos_products',array('product_company_app_id'=>get_company_app_id(),'product_import' => 1 ));

					if($recorddeleted != "")
					{
						$this->session->set_flashdata ( 'admin_success', 'Imported products deleted successfully' );
						$result ['status'] = 'success';
					}
					else
					{		   
						$result ['status'] = 'error';
						$result ['message'] = 'Failed to delete';				
					}	

					echo json_encode ( $result );
					exit ();
			} 

			$data=array();		
			$data ['module_label'] = $this->module_label;
			$data ['module_labels'] = $this->module_labels;
			$data ['module'] = $this->module;
			$this->load->view($this->folder."/".$this->module."-import",$data);		
                 
	   }

	/* download file */
	public function download ($file_path = "")
    {
		$data=array();
        $this->load->helper('download'); //load helper            
        //$file_path = "product-template.csv";         
        $layout="no_theme"; //if you have layout          
        $data['download_path'] = $file_path;                                 		
		$data ['module_label'] = $this->module_label;
		$data ['module_labels'] = $this->module_labels;
		$data ['module'] = $this->module;
		$this->load->view($this->folder."/".$this->module."-import",$data);	                      
                     
    }

	
}
/* End of file products.php  */
