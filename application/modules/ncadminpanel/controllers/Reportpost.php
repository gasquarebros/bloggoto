<?php
/**************************
Project Name	: POS
Created on		: 03 march, 2016
Last Modified 	: 03 march, 2016
Description		: Page contains promotion for discount coupon add edit and delete functions..

***************************/
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Reportpost extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		$this->authentication->admin_authentication();
		$this->module = "reportpost";
		$this->module_label = get_label('report_manage_label');
		$this->module_labels =  get_label('report_manage_labels');
		$this->folder = "reportpost/";
		$this->table = "post_reports";
		$this->customers = "customers";
		$this->posts = "posts";
		$this->load->library ( 'common' );
		$this->primary_key = 'report_id';
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
			$this->session->set_userdata ( $this->module . "_order_by_field", post_value ( 'sort_field' ) );
			$this->session->set_userdata ( $this->module . "_order_by_value", post_value ( 'sort_value' ) );
		}
		
		/* common post values... */
		if (get_session_value ( $this->module . "_search_field" ) != "" && get_session_value ( $this->module . "_search_value" ) != "") {
			$like = array (
					get_session_value ( $this->module . "_search_field" ) => get_session_value ( $this->module . "_search_value" ) 
			);
		}
		
	/* apply sort by */
		if (get_session_value ( $this->module . "_order_by_field" ) != "" && get_session_value ( $this->module . "_order_by_value" ) != "") {
				
			$order_by = array (
					get_session_value ( $this->module . "_order_by_field" )  => (get_session_value ( $this->module . "_order_by_value" ) == "ASC")? "ASC" : "DESC"
			);
		}

		$join = array();
		$join [0] ['select'] = "post_title,post_created_by";
		$join [0] ['table'] = $this->posts;
		$join [0] ['condition'] = "post_id = report_post_id";
		$join [0] ['type'] = "LEFT";
		
		$join [1] ['select'] = "concat(rc.customer_first_name,' ',rc.customer_last_name) as report_customer_name ";
		$join [1] ['table'] = $this->customers ." as rc";
		$join [1] ['condition'] = "rc.customer_id = report_created_by";
		$join [1] ['type'] = "LEFT";

		$join [2] ['select'] = "concat(pc.customer_first_name,' ',pc.customer_last_name) as post_customer_name ";
		$join [2] ['table'] = $this->customers." as pc";
		$join [2] ['condition'] = "pc.customer_id = post_created_by";
		$join [2] ['type'] = "LEFT";

		$totla_rows = $this->Mydb->get_num_join_rows ( $this->primary_key, $this->table, $where, null, null, null, $like, null, $join, null );
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
		
		$select_array = array ("$this->table.*");

		$data ['records'] = $this->Mydb->get_all_records ( $select_array, $this->table, $where, $limit, $offset, $order_by, $like, null, $join );
		// echo $this->db->last_query(); exit;
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
	 
	/* this method used update multible actions */
	function action() {
		$ids = ($this->input->post ( 'multiaction' ) == 'Yes' ? $this->input->post ( 'id' ) : decode_value ( $this->input->post ( 'changeId' ) ));
		$ids = (is_array($ids))?  $ids : array($ids);
		
		$postaction = $this->input->post ( 'postaction' );
		$response = array (
				'status' => 'error',
				'msg' => get_label ( 'something_wrong' ),
				'action' => '',
				'multiaction' => $this->input->post ( 'multiaction' ) 
		);
		/* Delete */
		$wherearray=array();
		if ($postaction == 'Delete' && ! empty ( $ids )) 
		{
			// get_all_records_where_in($select, $table , $field, $where_in, $order = '')
				$report_info = $this->Mydb->get_all_records_where_in('report_post_id','post_reports','report_id',$ids,null);
				if(!empty($report_info))
				{
					foreach($report_info as $report)
					{
						$delete_query=delete_post($report['report_post_id']);#pass post id to delete the post related 
					}
				}
				$this->Mydb->delete_where_in($this->table,$this->primary_key,$ids);
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_delete' ), $this->module_label );
			$response ['status'] = 'success';
			$response ['action'] = $postaction;
		}
	
		echo json_encode ( $response );
		exit ();
	}
	
	function refresh() {
		$this->session->unset_userdata ( $this->module . "_search_field" );
		$this->session->unset_userdata ( $this->module . "_search_value" );
		$this->session->unset_userdata ( $this->module . "_order_by_value" );
		$this->session->unset_userdata ( $this->module . "_order_by_value" );
		$this->session->unset_userdata ( $this->module . "_search_status" );
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
