<?php
/**************************
Project Name	: POS
Created on		: 3  March, 2016
Last Modified 	: 30 June, 2016
Description		: Page contains manage product categories

***************************/
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Manageservices extends CI_Controller 
{
	public function __construct() 
	{
		parent::__construct ();
		$this->authentication->user_authentication();
		$this->module = "manageservices";
		$this->module_label = get_label('manageservices_module_label');
		$this->module_labels = get_label('manageservices_module_label');
		$this->folder = "manageservices/";
		$this->table = "services";
		$this->availability_table = "service_availability";
		$this->service_city_table = "service_cities";
		$this->primary_key = 'ser_primary_id';
		$this->load->library ( 'common' );
		$this->load->helper('products');
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
		check_site_ajax_request (); /* skip direct access */
		$data = $this->load_module_info ();
		$like = array ();
		$where = array (
			" $this->primary_key !=" => '',
			'ser_customer_id'	=> get_user_id()
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
					'ser_status' => get_session_value ( $this->module . "_search_status" ) 
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
					'ser_category' => get_session_value ( $this->module . "_category_id" ) 
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
		$join [0] ['condition'] = "ser_customer_id = customer_id";
		$join [0] ['type'] = "INNER";
		/* not in product availability id condition  */
		$join [1] ['select'] = "ser_cate_name";
		$join [1] ['table'] = "pos_service_categories";
		$join [1] ['condition'] = "ser_category = ser_cate_primary_id	";
		$join [1] ['type'] = "LEFT";	
		$groupby = "ser_primary_id";


		$totla_rows = $this->Mydb->get_num_join_rows ( $this->primary_key, $this->table, $where, null, null, null, $like, $groupby, $join );

		/* pagination part start */
		$admin_records = 0;
		$limit = (( int ) $admin_records == 0) ? 5 : $admin_records;
		$offset = (( int ) $page == 0) ? 0 : $page;
		$uri_segment = $this->uri->total_segments ();
		$uri_string = base_url () . $this->module . "/ajax_pagination";

		$config = pagination_config ( $uri_string, $totla_rows, $limit, $uri_segment );
		$this->pagination->initialize ( $config );
		$data ['paging'] = $this->pagination->create_links ();
		$data ['per_page'] = $data ['limit'] = $limit;
		$data ['start'] = $offset;
		$data ['total_rows'] = $totla_rows;
		/* pagination part end */
		
		$select_array = array (
			$this->table.'.*',
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
	
	/* this method used to add record . */
	public function add() 
	{
		$data = $this->load_module_info ();
		$settings = $this->Mydb->get_record('*','settings');
        $data['commission_price'] = $settings['setting_ecommerce_percentage'];
		/* form submit */
		if ($this->input->post ( 'action' ) == "Add") {

			check_site_ajax_request (); /* skip direct access */
		
			$this->form_validation->set_rules ( 'ser_title', 'lang:ser_title', 'required|callback_productnameexists' );
			$this->form_validation->set_rules ( 'ser_price', 'lang:ser_price', 'required' );
			$this->form_validation->set_rules ( 'product_customer_id', 'lang:service_customer', 'required' );
			$this->form_validation->set_rules ( 'product_category', 'lang:ser_category', 'required' );
			$this->form_validation->set_rules ( 'product_subcategory', 'lang:ser_subcategory', 'required' );
			$this->form_validation->set_rules ( 'status', 'lang:status', 'required' );
			$this->form_validation->set_rules ( 'ser_availability', 'lang:ser_availability', 'required' );
			$this->form_validation->set_rules ( 'customer_city[]', 'lang:customer_city', 'required' );

			if (( int ) $this->input->post ( 'ser_discount_price' ) != 0) {
				
				$this->form_validation->set_rules ( 'ser_discount_price', 'lang:ser_discount_price', 'required' );
				$this->form_validation->set_rules ( 'ser_discount_start_date', 'lang:ser_discount_start_date', 'required' );
				$this->form_validation->set_rules ( 'ser_discount_end_date', 'lang:ser_discount_end_date', 'required' );
			}
			
			if ($this->form_validation->run () == TRUE) {
			
				$availability = $this->input->post('ser_availability');
				$product_id = get_guid ( $this->table, 'ser_service_id' );
				$product_slug = make_slug ( $this->input->post ( 'ser_title' ), $this->table, 'ser_slug' );
				$product_sequence = (( int ) $this->input->post ( 'ser_sequence' ) == 0) ? get_sequence ( 'ser_sequence', $this->table, array() )  : $this->input->post ( 'ser_sequence' );

				$insert_array = array (
					'ser_title' => post_value ( 'ser_title' ),
					'ser_service_id' => $product_id,
					'ser_slug' => $product_slug,
					'ser_customer_id' => get_user_id(),
					'ser_category' => post_value('product_category'),
					'ser_subcategory' => post_value('product_subcategory'),
					'ser_description' => post_value ( 'ser_description' ),
					'ser_status' => (post_value ( 'status' ) == "A" ? 'A' : 'I'),
					'ser_sequence' => $product_sequence,
					'ser_price' => post_value ( 'ser_price' ),
					'ser_pricet_type' => post_value ( 'ser_pricet_type' ),
                    'ser_discount_price' => post_value ( 'ser_discount_price' ),
					'ser_discount_start_date' => (post_value ( 'ser_discount_start_date' ))?date ( "Y-m-d", strtotime ( post_value ( 'ser_discount_start_date' ) ) ):'',
					'ser_discount_end_date' => (post_value ( 'ser_discount_end_date' ))?date ( "Y-m-d", strtotime ( post_value ( 'ser_discount_end_date' ) ) ):'',
					'ser_available' => ",".implode(',',$availability).",",
					'ser_created_on' => current_date (),
					'ser_created_by' => get_user_id (),
					'ser_created_ip' => get_ip ()
				);
				
				$insert_id = $this->Mydb->insert ( $this->table, $insert_array );
				
				
				if ($insert_id != "") {
					
					
					$update_avail = array('ser_avail_serviceid'=>$insert_id);
					if(!empty($ser_availability)) {
						foreach($ser_availability as $avail) {
							$update_avail['ser_avail_'.$avail] = 1;
						}
					}
					if(!empty($update_avail)) {
						$avail_id = $this->Mydb->insert ( $this->availability_table, $update_avail );
					}

					$cities = $this->input->post('customer_city');
					
					$update_city = array();
					if(!empty($cities)) {
						foreach($cities as $city) {
							$update_city[] = array('ser_service_id'=>$insert_id,'ser_city_id'=>$city);
						}
					}
					if(!empty($update_city)) {
						$avail_id = $this->Mydb->insert_batch ( $this->service_city_table, $update_city );
					}
					
					/* insert gallery images */
					if (! empty ( $_FILES ['product_gallery'] ['name'] )) {
						//echo "inn";
						$this->add_gallery_images( $_FILES, $_FILES ['product_gallery'] ['name'], $insert_id, $product_id );
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
		/* Common labels */
		$data ['breadcrumb'] = $data ['form_heading'] = get_label ( 'add' ) . ' ' . $this->module_label;
		$data ['module_action'] = 'add';
		$this->layout->display_admin ( $this->folder . $this->module . '-add', $data );
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
			check_site_ajax_request (); /* skip direct access */
			
			$this->form_validation->set_rules ( 'ser_title', 'lang:ser_title', 'required|callback_productnameexists' );
			$this->form_validation->set_rules ( 'ser_price', 'lang:ser_price', 'required' );
			$this->form_validation->set_rules ( 'product_customer_id', 'lang:service_customer', 'required' );
			$this->form_validation->set_rules ( 'product_category', 'lang:ser_category', 'required' );
			$this->form_validation->set_rules ( 'product_subcategory', 'lang:ser_subcategory', 'required' );
			$this->form_validation->set_rules ( 'status', 'lang:status', 'required' );
			$this->form_validation->set_rules ( 'customer_city[]', 'lang:customer_city', 'required' );

			if (( int ) $this->input->post ( 'ser_discount_price' ) != 0) {
				
				$this->form_validation->set_rules ( 'ser_discount_price', 'lang:ser_discount_price', 'required' );
				$this->form_validation->set_rules ( 'ser_discount_start_date', 'lang:ser_discount_start_date', 'required' );
				$this->form_validation->set_rules ( 'ser_discount_end_date', 'lang:ser_discount_end_date', 'required' );
			}

			if ($this->form_validation->run () == TRUE) {
				$product_slug = make_slug ( $this->input->post ( 'ser_title' ), $this->table, 'ser_slug', array (
					$this->primary_key . "!=" => $record [$this->primary_key] 
				));
				$product_sequence = (( int ) $this->input->post ( 'ser_sequence' ) == 0) ? get_sequence ( 'ser_sequence', $this->table) : $this->input->post ( 'ser_sequence' );
				$availability = $this->input->post('ser_availability');
				$update_array = array (
					'ser_title' => post_value ( 'ser_title' ),
					'ser_slug' => $product_slug,
					'ser_customer_id' => get_user_id(),
					'ser_category' => post_value('product_category'),
					'ser_subcategory' => post_value('product_subcategory'),
					'ser_description' => post_value ( 'ser_description' ),
					'ser_status' => (post_value ( 'status' ) == "A" ? 'A' : 'I'),
					'ser_sequence' => $product_sequence,
					'ser_price' => post_value ( 'ser_price' ),
					'ser_pricet_type' => post_value ( 'ser_pricet_type' ),
                    'ser_discount_price' => post_value ( 'ser_discount_price' ),
					'ser_discount_start_date' => (post_value ( 'ser_discount_start_date' ))?date ( "Y-m-d", strtotime ( post_value ( 'ser_discount_start_date' ) ) ):'',
					'ser_discount_end_date' => (post_value ( 'ser_discount_end_date' ))?date ( "Y-m-d", strtotime ( post_value ( 'ser_discount_end_date' ) ) ):'',
					'ser_available' => ",".implode(',',$availability).",",
					'ser_created_on' => current_date (),
					'ser_created_by' => get_user_id (),
					'ser_created_ip' => get_ip ()
				);

				

				$this->Mydb->update ( $this->table, array (
					$this->primary_key => $record [$this->primary_key] 
				), $update_array );

				
				
				$update_avail = array();
				$update_avail['ser_avail_mon'] = $update_avail['ser_avail_tue'] = $update_avail['ser_avail_wed'] = $update_avail['ser_avail_thu'] = $update_avail['ser_avail_fri'] = $update_avail['ser_avail_sat'] = $update_avail['ser_avail_sun'] = 0;
				if(!empty($availability)) {
					foreach($availability as $avail) {
						$update_avail['ser_avail_'.$avail] = 1;
					}
				}
				if(!empty($update_avail)) {
					$avail_id = $this->Mydb->update ( $this->availability_table, array (
						'ser_avail_serviceid' => $record [$this->primary_key] 
					), $update_avail );
				}

				$cities = $this->input->post('customer_city');
				$this->db->delete($this->service_city_table,array('ser_service_id' =>  $record [$this->primary_key] ));	
				$update_city = array();
				if(!empty($cities)) {
					foreach($cities as $city) {
						$update_city[] = array('ser_service_id'=> $record [$this->primary_key] ,'ser_city_id'=>$city);
					}
				}
				//print_r($update_city); exit;
				if(!empty($update_city)) {
					$avail_id = $this->Mydb->insert_batch ( $this->service_city_table, $update_city );
				}
				
				/* insert gallery images */
				if (! empty ( $_FILES ['product_gallery'] ['name'] )) {
					$this->add_gallery_images ( $_FILES, $_FILES ['product_gallery'] ['name'], $id, $record ['ser_service_id'] );
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
		/* Service Availability */
		$avail = $this->Mydb->get_record ( '*', $this->availability_table, array (
			'ser_avail_serviceid' => $record [$this->primary_key] 
		) );
		$service_availability = array();
		if(!empty($avail)){
			if($avail['ser_avail_mon'] == 1){
				$service_availability[] = 'mon';
			}
			if($avail['ser_avail_tue'] == 1){
				$service_availability[] = 'tue';
			}
			if($avail['ser_avail_wed'] == 1){
				$service_availability[] = 'wed';
			}
			if($avail['ser_avail_thu'] == 1){
				$service_availability[] = 'thu';
			}
			if($avail['ser_avail_fri'] == 1){
				$service_availability[] = 'fri';
			}
			if($avail['ser_avail_sat'] == 1){
				$service_availability[] = 'sat';
			} 
			if($avail['ser_avail_sun'] == 1){
				$service_availability[] = 'sun';
			}
		}
		$data['availability'] = $service_availability;

		/* get service city */
		$cities = $this->Mydb->get_all_records ( '*', $this->service_city_table, array (
			'ser_service_id' => $record [$this->primary_key] 
		) );
		$service_city = array();

		if(!empty($cities)) {
			foreach($cities as $city){
				$service_city[] = $city['ser_city_id'];
			}
		}
		$data['service_city'] = $service_city;

		/* get gallery images */
		$data ['gallery_images'] = $this->Mydb->get_all_records ( 'ser_gallery_id,ser_gallery_image,ser_gallery_ser_primary_id', 'service_gallery', array (
				'ser_gallery_ser_primary_id' => $record [$this->primary_key] 
		) );
		/* Common labels */
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
			
			$this->Mydb->delete_where_in ( $this->table, $this->primary_key, $ids );
			
			/* delete and unlink gallery images */
			$this->common->delete_unlink_image ( $this->lang->line ( 'service_gallery_image_folder_name' ), "ser_gallery_image", 'ser_gallery_ser_primary_id', 'service_gallery', $ids );
			$this->Mydb->delete_where_in ( 'service_gallery', 'ser_gallery_ser_primary_id', $ids);
			
			
			$response ['status'] = 'success';
			$response ['action'] = $postaction;
		}
		
		/* Activation */
		if ($postaction == 'Activate' && ! empty ( $ids )) 
		{
			$update_values = array (
					"ser_status" => 'A',
					"ser_updated_on" => current_date (),
					'ser_updated_by' => get_user_id (),
					'ser_updated_ip' => get_ip () 
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
					"ser_status" => 'I',
					"ser_updated_on" => current_date (),
					'ser_updated_by' => get_user_id (),
					'ser_updated_ip' => get_ip () 
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
								"ser_sequence" => $sequnce_value,
								"ser_updated_on" => current_date (),
								'ser_updated_by' => get_user_id (),
								'ser_updated_ip' => get_ip () 
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
			} else {
				return true;
			}
		}
		$this->form_validation->set_message ( 'validate_image', get_label ( 'upload_valid_image' ) );
		return false;
	}
	
	/* this method used check product name or alredy exists or not */
	public function productnameexists() {$name = $this->input->post ( 'ser_title' );
		$edit_id = $this->input->post ( 'edit_id' );
		
		$where = array (
			'ser_title' => trim ( $name ) 
		);
		if ($edit_id != "") {
			$where = array_merge ( $where, array (
				"ser_primary_id !=" => $edit_id 
			) );
		}
		$result = $this->Mydb->get_record ( 'ser_primary_id', $this->table, $where );
		
		if (! empty ( $result )) {
			$this->form_validation->set_message ( 'productnameexists', get_label ( 'service_value_exist' ) );
			return false;
		} else {
			return true;
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
				
				$galery_image = $this->common->upload_image ( 'product_gallery', $this->lang->line ( 'service_gallery_image_folder_name' ) );

				$gallery_arary = array (
						'ser_gallery_image' => $galery_image,
						'ser_gallery_ser_primary_id' => $insert_id,
						'ser_gallery_serviceid' => $product_id,
				);
				
				$this->Mydb->insert ( 'service_gallery', $gallery_arary );
				//echo $this->db->last_query();
			}
		}
	}
	
	/* this method used to delete image and unlink image... */
	function unlink_gallery_image() {
		check_site_ajax_request (); /* skip direct access */
		$response = array (
				'status' => 'error',
				'msg' => get_label ( 'something_wrong' ) 
		);
		
		echo $gallery_id = decode_value ( post_value ( 'gallery_id' ) );
		$company_array = array (
				'ser_gallery_id' => $gallery_id 
		);
		
		$gallery = $this->Mydb->get_record ( 'ser_gallery_image', 'service_gallery', $company_array );
		if (! empty ( $gallery )) {
			$this->common->unlink_image ( $gallery ['ser_gallery_image'], '', $this->lang->line ( 'service_gallery_image_folder_name' ) ); /* unlink image.. */
			$this->Mydb->delete ( 'service_gallery', $company_array );
			
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
}
/* End of file products.php  */
