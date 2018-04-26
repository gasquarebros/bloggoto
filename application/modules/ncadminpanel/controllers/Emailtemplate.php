<?php
/**************************
Project Name	: POS
Created on		: 19 Feb, 2016
Last Modified 	: 25 Feb, 2016
Description		: Page contains company add edit and delete functions..

***************************/
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Emailtemplate extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		$this->authentication->admin_authentication ();
		$this->module = "emailtemplate";
		$this->module_label = get_label ( 'emailtemplate_module_label' );
		$this->module_labels = get_label ( 'emailtemplate_module_labels' );
		$this->folder = "emailtemplate/";
		$this->table = "admin_email_templates";
	    $this->load->library ( 'common' );
		$this->primary_key = 'email_id';
	}
	
	/* this method used to list all company . */
	public function index() {
		$data = $this->load_module_info ();
		
		$this->layout->display_admin ( $this->folder . $this->module . "-list", $data );
	}
	
	/* this method used list ajax listing... */
	function ajax_pagination($page = 0) {
		check_ajax_request (); /* skip direct access */
		$data = $this->load_module_info ();
		$like = array ();
		$order_by = array (
				$this->primary_key => 'DESC' 
		);
		
		/* Search part start */
		
		if (post_value ( 'paging' ) == "") {
			$this->session->set_userdata ( $this->module . "_search_field", post_value ( 'search_field' ) );
			$this->session->set_userdata ( $this->module . "_search_value", post_value ( 'search_value' ) );
			$this->session->set_userdata ( $this->module . "_order_by_field", post_value ( 'sort_field' ) );
			$this->session->set_userdata ( $this->module . "_order_by_value", post_value ( 'sort_value' ) );
		}
		
		if (get_session_value ( $this->module . "_search_field" ) != "" && get_session_value ( $this->module . "_search_value" ) != "") {
			$like = array (
					get_session_value ( $this->module . "_search_field" ) => get_session_value ( $this->module . "_search_value" ) 
			);
		}
		
		/* add sort bu option */
		if (get_session_value ( $this->module . "_order_by_field" ) != "" && get_session_value ( $this->module . "_order_by_value" ) != "") {
						
			$order_by = array (
								get_session_value ( $this->module . "_order_by_field" )  => (get_session_value ( $this->module . "_order_by_value" ) == "ASC")? "ASC" : "DESC" 
						      );
		}
		
	    $totla_rows = $this->Mydb->get_num_rows ( $this->primary_key, $this->table, array(), null, null, null, $like );
		
		/*  pagination part start */
		$admin_records = admin_records_perpage ();
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
		/**
		 * * pagination part end **
		 */
		$select_array = array (
				'email_id ',
				'email_subject',
				'email_content',
				'email_created_on'
		);
		
		$data ['records'] = $this->Mydb->get_all_records ( $select_array, $this->table, array(), $limit, $offset, $order_by, $like );
	 	$page_relod = ($totla_rows  >  0 && $offset > 0 && empty($data ['records'])  )? 'Yes' : 'No'; 
		$html = get_template ( $this->folder . '/' . $this->module . '-ajax-list', $data );
		echo json_encode ( array (
				'status' => 'ok',
				'offset' => $offset,
				'html' => $html,
				'page_reload' => $page_relod 
		) );
		exit ();
	}
	
	/* this method used to view content...*/
	public function view($view_id) {
		
		$data = $this->load_module_info ();
		$data['result'] = $this->Mydb->get_record('*',$this->table,array($this->primary_key => decode_value($view_id)));

		$this->load->view($this->folder."/".$this->module."-view",$data);
		
	}
	
	/* this method used to add company . */
	public function add() { 

		$data = $this->load_module_info ();
		
		/* form submit */
		if ($this->input->post ( 'action' ) == "Add") {
			check_ajax_request (); /* skip direct access */
		

			$this->form_validation->set_rules('email_title','lang:email_title','required|trim|strip_tags');			
			$this->form_validation->set_rules('email_template','lang:email_template','required');
			
			if ($this->form_validation->run () == TRUE) {
				
				$insert_array = array (
						'email_subject' => post_value ( 'email_title' ),
						'email_content' => $this->input->post( 'email_template' ,FALSE),
						'email_created_on' => current_date (),
						'email_creatd_by' => get_admin_id (),
						'email_creatd_ip' => get_ip () 
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
		
		$value =($this->input->post('email_template'))?$this->input->post('email_template'):'';
		$ck['email_template'] = $value;
		$data['editor']=$this->load->view($this->folder."/ckeditor",$ck,true);
		
		
		/* Common labels */
		$data ['breadcrumb'] = $data ['form_heading'] = get_label ( 'add' ) . ' ' . $this->module_label;
		$data ['module_action'] = "add";
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
			
			$this->form_validation->set_rules('email_title','lang:email_title','required|trim|strip_tags');			
			$this->form_validation->set_rules('email_template','lang:email_template','required');
			
			if ($this->form_validation->run () == TRUE) {
				
				
				$update_array = array (
					'email_subject' => post_value ( 'email_title' ),
					'email_content' => $this->input->post( 'email_template',FALSE ),
					'email_updated_on' => current_date (),
					'email_updated_by' => get_admin_id (),
					'email_updated_ip' => get_ip () 
				);
				
				$this->Mydb->update ( $this->table, array ($this->primary_key => $record ['email_id'] ), $update_array );
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
		
		$value =($record['email_content'])?$record['email_content']:'';
		$ck['email_template'] = $value;
		$data['editor']=$this->load->view($this->folder."/ckeditor",$ck,true);
		
		/* Common labels */
		$data ['breadcrumb'] = $data ['form_heading'] = get_label ( 'edit' ) . ' ' . $this->module_label;
		$data ['module_action'] = 'edit/' . encode_value ( $record [$this->primary_key] );
		$this->layout->display_admin ( $this->folder . $this->module . '-edit', $data );
	}
	
	/* this method used update multible actions */
	function action() {
		$ids = ($this->input->post ( 'multiaction' ) == 'Yes' ? $this->input->post ( 'id' ) : decode_value ( $this->input->post ( 'changeId' ) ));
		
		$ids = ($this->input->post ( 'changeId' ) != '') ? decode_value ( $this->input->post ( 'changeId' ) ) : $this->input->post ( 'id' );
		$postaction = $this->input->post ( 'postaction' );
		
		$response = array (
				'status' => 'error',
				'msg' => get_label ( 'something_wrong' ),
				'action' => '',
				'multiaction' => $this->input->post ( 'multiaction' ) 
		);
		
		/* Delete */
		if ($postaction == 'Delete' && ! empty ( $ids )) {
			// $this->Mydb->delete_where_in($this->table,'email_id',$ids,'');
			
			if (is_array ( $ids )) {
			} else {
				$this->Mydb->delete ( $this->table, array ($this->primary_key => $ids ));
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_delete' ), $this->module_label );
				
				// $this->Mydb->delete($this->table,'email_id',$ids,'');
			}
			$response ['status'] = 'success';
			$response ['action'] = $postaction;
		}
		echo json_encode ( $response );
		exit ();
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
