<?php
/**************************
Project Name	: POS
Created on		: 3  March, 2016
Last Modified 	: 3 March, 2016
Description		: Page contains manage product categories

***************************/
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Banner extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		$this->module = "banner";
		$this->authentication->admin_authentication();
		$this->module_label = get_label ( 'banner_label' );
		$this->module_labels = get_label ( 'banner_labels' );
		$this->folder = "banner/";
		$this->table = "banners";
		$this->primary_key = 'banner_id';
		$this->load->library ( 'common' );
		//$this->load->helper('products');
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
			//$this->session->set_userdata ( $this->module . "_product_avilablity", $this->input->post ( 'product_avilablity' ) );
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
					'banner_status' => get_session_value ( $this->module . "_search_status" )
			) );
		}
		
		/* apply sort by */
		if (get_session_value ( $this->module . "_order_by_field" ) != "" && get_session_value ( $this->module . "_order_by_value" ) != "") {
				
			$order_by = array (
					get_session_value ( $this->module . "_order_by_field" )  => (get_session_value ( $this->module . "_order_by_value" ) == "ASC")? "ASC" : "DESC"
			);
		}
		$totla_rows = $this->Mydb->get_num_rows ( $this->primary_key, $this->table, $where, null, null, null, $like );
		
		/* pagination part start  */
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
		
		$select_array = array ('banner_id ','banner_name','banner_status','banner_sequence','banner_image'	);

		$data ['records'] = $this->Mydb->get_all_records ( $select_array, $this->table, $where, $limit, $offset, $order_by, $like );
	//	echo $this->db->last_query(); exit;
	    $page_relod = ($totla_rows  >  0 && $offset > 0 && empty($data ['records'])  )? 'Yes' : 'No'; 
		$html = get_template ( $this->folder . '/' . $this->module . '-ajax-list', $data );
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
			
			$this->form_validation->set_rules ( 'banner_name', 'lang:banner_name', 'required' );
			$this->form_validation->set_rules ( 'status', 'lang:status', 'required' );
			$this->form_validation->set_rules ( 'banner_image', 'lang:banner_image', 'callback_validate_image' );
			
			if ($this->form_validation->run () == TRUE) {
			 	$banner_sequence = ((int)$this->input->post('banner_sequence') == 0)?  get_sequence('banner_sequence',$this->table) : $this->input->post('banner_sequence'); 
				
				/* upload image */
				$banner_image = "";
				if (isset ( $_FILES ['banner_image'] ['name'] ) && $_FILES ['banner_image'] ['name'] != "") {
					$banner_image = $this->common->upload_image ( 'banner_image', get_company_folder() . "/".$this->lang->line('banner_image_folder_name') );
				}
				
				
				$insert_array = array (
						'banner_name' => post_value ( 'banner_name' ),
						'banner_description' => post_value ( 'banner_description' ),
						'banner_description_mobile' => post_value ( 'banner_description_mobile' ),
						'banner_image' => $banner_image,
						'banner_status' => (post_value('status')=="A" ? 'A' : 'I'),
						'banner_sequence' => $banner_sequence,
						'banner_created_on' => current_date (),
						'banner_created_by' => get_admin_id (),
						'banner_created_ip' => get_ip () 
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
		$response =$image_arr = array ();
		$record = $this->Mydb->get_record ( '*', $this->table, array (
				$this->primary_key => $id
		) );
		(empty ( $record )) ? redirect ( admin_url () . $this->module ) : '';
		
		if ($this->input->post ( 'action' ) == "edit") {

			check_ajax_request (); /* skip direct access */
			
			$this->form_validation->set_rules ( 'banner_name', 'lang:banner_name', 'required' );
			$this->form_validation->set_rules ( 'status', 'lang:status', 'required' );
			$this->form_validation->set_rules ( 'banner_image', 'lang:banner_image', 'callback_validate_image' );
			
			if ($this->form_validation->run () == TRUE) {
				$banner_sequence = ((int)$this->input->post('banner_sequence') == 0)?  get_sequence('banner_sequence',$this->table) : $this->input->post('banner_sequence');
				
				$update_array = array (
						'banner_name' => post_value ( 'banner_name' ),
						'banner_description' => post_value ( 'banner_description' ),
						'banner_description_mobile' => post_value ( 'banner_description_mobile' ),
						'banner_status' => (post_value('status')=="A" ? 'A' : 'I'),
						'banner_sequence' => $banner_sequence,
						'banner_updated_on' => current_date (),
						'banner_updated_by' => get_admin_id (),
						'banner_updated_ip' => get_ip () 
				);
				
				
				/* upload image and unlink ols image */
				$image_arr = array();
				if (isset ( $_FILES ['banner_image'] ['name'] ) && $_FILES ['banner_image'] ['name'] != "") {
					$upload_image = $this->common->upload_image ( 'banner_image', get_company_folder() . "/".$this->lang->line('banner_image_folder_name') );
					$image_arr = array (
							'banner_image' => $upload_image
					);
						
					$this->common->unlink_image($record['banner_image'],get_company_folder(),$this->lang->line('banner_image_folder_name')); /* unlink image..  */
				}
				elseif($this->input->post('remove_image')=="Yes") {
					$image_arr = array (
							'banner_image' => ""
					);
				
					$this->common->unlink_image($record['banner_image'],get_company_folder(),$this->lang->line('banner_image_folder_name'));
				}
				
				$update_array = array_merge ( $update_array, $image_arr );
				$this->Mydb->update ( $this->table, array ($this->primary_key => $record [$this->primary_key] ), $update_array );

				
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
		
			$alert_label = (is_array($ids))?  $this->module_labels : $this->module_label;
			$ids = (is_array($ids))?  $ids : array($ids);
			$this->common->delete_unlink_image($this->lang->line('banner_image_folder_name'), "banner_image",$this->primary_key ,$this->table,$ids);
			$this->Mydb->delete_where_in($this->table,$this->primary_key,$ids);

			
			$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_delete' ),$alert_label );
			$response ['status'] = 'success';
			$response ['action'] = $postaction;
		}
		
		/* Activation */
		if ($postaction == 'Activate' && ! empty ( $ids )) {
			$update_values = array (
					"banner_status" => 'A',
					"banner_updated_on" => current_date (),
					'banner_updated_by' => get_admin_id (),
					'banner_updated_ip' => get_ip ()
			);
				
			if (is_array ( $ids )) {
				$this->Mydb->update_where_in ( $this->table, $this->primary_key, $ids, $update_values );
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_activate' ), $this->module_labels );
			} else {
		
				$this->Mydb->update_where_in ( $this->table, $this->primary_key, array (
						$ids
				), $update_values);
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_activate' ), $this->module_label );
			}
				
			$response ['status'] = 'success';
			$response ['action'] = $postaction;
		}
		
		/* Deactivation */
		if ($postaction == 'Deactivate' && ! empty ( $ids )) {
			$update_values = array (
					"banner_status" => 'I',
					"banner_updated_on" => current_date (),
					'banner_updated_by' => get_admin_id (),
					'banner_updated_ip' => get_ip ()
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
		
		
		/* Sequence  */
		if ($postaction == 'Sequence' && ! empty ( $ids )) {
			
			if(!empty($ids))
			{
				foreach($ids as $primary_id )
				{
					
					$post_sequence   = $this->input->post('sequence');
					$sequnce_value =  ( isset($post_sequence[$primary_id]))?  (int)$post_sequence[$primary_id] : 0; 
					if((int)$sequnce_value != 0 )	
					{
						$update_values = array(
								"banner_sequence" => $sequnce_value,
								"banner_updated_on" => current_date (),
								'banner_updated_by' => get_admin_id (),
								'banner_updated_ip' => get_ip ()	);
						$this->Mydb->update_where_in ( $this->table, $this->primary_key, array ($primary_id), $update_values );
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
		if (isset ( $_FILES ['banner_image'] ['name'] ) && $_FILES ['banner_image'] ['name'] != "") {
			if ($this->common->valid_image ( $_FILES ['banner_image'] ) == "No") {
				$this->form_validation->set_message ( 'validate_image', get_label ( 'upload_valid_image' ) );
				return false;
			}
		}else {

			if($this->input->post('remove_image') == "Yes" || $this->input->post('edit_id')=="") {
			$this->form_validation->set_message ( 'validate_image', sprintf(get_label ( 'product_errors' ), get_label('banner_image')) );
			return false;
			}else {
				return true;
			}
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
		return $data;
	}
}
