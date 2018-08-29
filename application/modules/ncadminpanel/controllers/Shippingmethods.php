<?php
/**************************
Project Name	: POS
Created on		: 3  March, 2016
Last Modified 	: 3 March, 2016
Description		: Page contains manage product modifiers

***************************/
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Shippingmethods extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		$this->module = "shippingmethods";
		$this->authentication->admin_authentication ();
		$this->module_label = get_label ( 'pro_shipping_label' );
		$this->module_labels = get_label ( 'pro_shipping_labels' );
		$this->folder = "product-shipping/";
		$this->table = "shipping_methods";
		$this->primary_key = 'ship_method_id';
		$this->load->helper ( 'products' );
	}
	
	/* this method used to list all records . */
	public function index() {
		$data = $this->load_module_info ();
		$this->layout->display_admin ( $this->folder . $this->module . "-list", $data );
	}
	
	/* this method used list ajax listing... */
	function ajax_pagination($page = 0) {
		check_ajax_request (); /* skip direct access */
		$data = $this->load_module_info ();
		$like = array ();
		$where = array (
				" $this->primary_key !=" => ''
		);
		$order_by = array (
				$this->primary_key => 'DESC' 
		);
		
		/* Search part start */
		
		if (post_value ( 'paging' ) == "") {
			$this->session->set_userdata ( $this->module . "_search_field", post_value ( 'search_field' ) );
			$this->session->set_userdata ( $this->module . "_search_value", post_value ( 'search_value' ) );
			$this->session->set_userdata ( $this->module . "_search_status", post_value ( 'status' ) );
			$this->session->set_userdata ( $this->module . "_order_by_field", post_value ( 'sort_field' ) );
			$this->session->set_userdata ( $this->module . "_order_by_value", post_value ( 'sort_value' ) );
		}
		
		if (get_session_value ( $this->module . "_search_field" ) != "" && get_session_value ( $this->module . "_search_value" ) != "") {
			$like = array (
					get_session_value ( $this->module . "_search_field" ) => get_session_value ( $this->module . "_search_value" ) 
			);
		}
		
		if (get_session_value ( $this->module . "_search_status" ) != "") {
			$where = array_merge ( $where, array (
					'pro_modifier_status' => get_session_value ( $this->module . "_search_status" ) 
			) );
		}
		
		/* apply sort by */
		if (get_session_value ( $this->module . "_order_by_field" ) != "" && get_session_value ( $this->module . "_order_by_value" ) != "") {
			
			$order_by = array (
					get_session_value ( $this->module . "_order_by_field" ) => (get_session_value ( $this->module . "_order_by_value" ) == "ASC") ? "ASC" : "DESC" 
			);
		}
		
		$totla_rows = $this->Mydb->get_num_rows ( $this->primary_key, $this->table, $where, null, null, null, $like );
		
		/* pagination part start */
		$admin_records = company_records_perpage ();
		$limit = (( int ) $admin_records == 0) ? 25 : $admin_records;
		$offset = (( int ) $page == 0) ? 0 : $page;
		$uri_segment = $this->uri->total_segments ();
		$uri_string = admin_url () . $this->module . "/ajax_pagination";
		$config = pagination_config ( $uri_string, $totla_rows, $limit, $uri_segment );
		$this->pagination->initialize ( $config );
		$data ['paging'] = $this->pagination->create_links ();
		$data ['per_page'] = $data ['limit'] = $limit;
		$data ['start'] = $offset;
		$data ['total_rows'] = $totla_rows;
		/* pagination part end */
		
		$select_array = array (
				'ship_method_id',
				'ship_method_name',
				'ship_method_status'
		);
		$data ['records'] = $this->Mydb->get_all_records ( $select_array, $this->table, $where, $limit, $offset, $order_by, $like );
		$page_relod = ($totla_rows > 0 && $offset > 0 && empty ( $data ['records'] )) ? 'Yes' : 'No';
		$html = get_template ( $this->folder . '/' . $this->module . '-ajax-list', $data );
		//echo $this->db->last_query();
		//exit;
		echo json_encode ( array (
				'status' => 'ok',
				'offset' => $offset,
				'page_reload' => $page_relod,
				'html' => $html 
		) );
		exit ();
	}
	
	/* this method used to add record . */
	public function add() {
		$data = $this->load_module_info ();
		
		/* form submit */
		if ($this->input->post ( 'action' ) == "Add") {
			check_ajax_request (); /* skip direct access */
			
			$this->form_validation->set_rules ( 'ship_method_name', 'lang:ship_method_name', 'required|callback_modifier_exists' );
			$this->form_validation->set_rules ( 'status', 'lang:status', 'required' );
			
			if ($this->form_validation->run () == TRUE) {
				$insert_array = array (
						'ship_method_name' => post_value ( 'ship_method_name' ),
						'ship_method_status' => (post_value ( 'status' ) == "A" ? 'A' : 'I'),
						'ship_method_created_on' => current_date (),
						'ship_method_created_by' => get_admin_id (),
						'ship_method_created_ip' => get_ip () 
				);
				
				$insert_id = $this->Mydb->insert ( $this->table, $insert_array );

				
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
	public function edit($edit_id = NULL) {
		$data = $this->load_module_info ();
		$id = addslashes ( decode_value ( $edit_id ) );
		$response = $image_arr = array ();
		$record = $this->Mydb->get_record ( '*', $this->table, array (
				$this->primary_key => $id
		) );
		

		
		if (empty ( $record )) {
			echo json_encode ( array (
					'status' => 'error',
					'msg' => get_label ( 'something_wrong' ) 
			) );
			exit ();
		}
		
		if ($this->input->post ( 'action' ) == "edit") {
			check_ajax_request (); /* skip direct access */
			
			$this->form_validation->set_rules ( 'ship_method_name', 'lang:ship_method_name', 'required|callback_modifier_exists' );
			$this->form_validation->set_rules ( 'status', 'lang:status', 'required' );

			if ($this->form_validation->run () == TRUE) {
				
				
				
				$update_array = array (
						'ship_method_name' => post_value ( 'ship_method_name' ),
						'ship_method_status' => (post_value ( 'status' ) == "A" ? 'A' : 'I'),
						'ship_method_updated_on' => current_date (),
						'ship_method_updated_by' => get_admin_id (),
						'ship_method_updated_ip' => get_ip () 
				);
				
				$this->Mydb->update ( $this->table, array (
						$this->primary_key => $record [$this->primary_key] 
				), $update_array );

				
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
		/* Common labels */
		$data ['breadcrumb'] = $data ['form_heading'] = get_label ( 'edit' ) . ' ' . $this->module_label;
		$data ['module_action'] = 'edit/' . encode_value ( $record [$this->primary_key] );
		$this->layout->display_admin ( $this->folder . $this->module . '-edit', $data );
	}
	
	/* this method used update multible actions */
	function action() {
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
			
			$ids = (is_array ( $ids )) ? $ids : array (
					$ids 
			);

				$response ['status'] = 'success';
				$parent_sts = (isset ( $parent ['parent'] )) ? $parent ['parent'] : '';
				$where_in = (isset ( $parent ['where_in'] )) ? $parent ['where_in'] : '';
				if (! empty ( $ids )) {
					$this->Mydb->delete_where_in ( $this->table, $this->primary_key, $ids,'' );
					$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_delete' ), $this->module_label );
				} else {
					$response ['status'] = 'success';
					$response ['delete_warnig'] = 'Yes';
					$response ['msg'] = sprintf ( $this->lang->line ( 'error_delete_warning' ), get_label ( 'a_users_labels' ) );
				}
			
			$response ['action'] = $postaction;
		}
		
		/* Activation */
		if ($postaction == 'Activate' && ! empty ( $ids )) {
			$update_values = array (
					"ship_method_status" => 'A',
					"ship_method_updated_on" => current_date (),
					'ship_method_updated_by' => get_admin_id (),
					'ship_method_updated_ip' => get_ip () 
			);
			
			if (is_array ( $ids )) {
				$this->Mydb->update_where_in ( $this->table, $this->primary_key, $ids, $update_values,'' );
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_activate' ), $this->module_labels );
			} else {
				
				$this->Mydb->update_where_in ( $this->table, $this->primary_key, array (
						$ids 
				), $update_values,'' );
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_activate' ), $this->module_label );
			}
			
			$response ['status'] = 'success';
			$response ['action'] = $postaction;
		}
		
		/* Deactivation */
		if ($postaction == 'Deactivate' && ! empty ( $ids )) {
			$update_values = array (
					"ship_method_status" => 'I',
					"ship_method_updated_on" => current_date (),
					'ship_method_updated_by' => get_admin_id (),
					'ship_method_updated_ip' => get_ip () 
			);
			
			if (is_array ( $ids )) {
				$this->Mydb->update_where_in ( $this->table, $this->primary_key, $ids, $update_values, '' );
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_deactivate' ), $this->module_labels );
			} else {
				$this->Mydb->update_where_in ( $this->table, $this->primary_key, array (
						$ids 
				), $update_values, '' );
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_deactivate' ), $this->module_label );
			}
			
			$response ['status'] = 'success';
			$response ['action'] = $postaction;
		}
		
		echo json_encode ( $response );
		exit ();
	}
	
	/* this method used check modifier or alredy exists or not */
	public function modifier_exists() {
		$name = $this->input->post ( 'ship_method_name' );
		$edit_id = $this->input->post ( 'edit_id' );
		
		$where = array (
				'ship_method_name' => trim ( $name ),
		);
		if ($edit_id != "") {
			$where = array_merge ( $where, array (
					"ship_method_id !=" => $edit_id
			) );
		}
		$result = $this->Mydb->get_record ( 'ship_method_id', $this->table, $where );
		if (! empty ( $result )) {
			$this->form_validation->set_message ( 'modifier_exists', get_label ( 'shipping_method_exist' ) );
			return false;
		} else {
			return true;
		}
	}

	/* this method used to clear all session values and reset search values */
	function refresh() {
		$this->session->unset_userdata ( $this->module . "_search_field" );
		$this->session->unset_userdata ( $this->module . "_search_value" );
		$this->session->unset_userdata ( $this->module . "_search_status" );
		$this->session->unset_userdata ( $this->module . "_order_by_value" );
		$this->session->unset_userdata ( $this->module . "_order_by_value" );
		redirect ( admin_url () . $this->module );
	}
	
	/* this method used to common module labels */
	private function load_module_info() {
		$data = array ();
		$data ['module_label'] = $this->module_label;
		$data ['module_labels'] = $this->module_labels;
		$data ['module'] = $this->module;
		$data ['module_save'] = "onpage";
		return $data;
	}
}
