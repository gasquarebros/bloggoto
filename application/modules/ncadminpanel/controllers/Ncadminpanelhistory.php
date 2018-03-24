<?php
/**************************
Project Name	: POS
Created on		: 05 march, 2016
Last Modified 	: 05 march, 2016
Description		: Page contains availability add edit and delete functions..

***************************/
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Ncadminpanelhistory extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		$this->authentication->admin_authentication ();
		$this->module = "ncadminpanelhistory";
		$this->module_label = get_label ( 'login_history_label' );
		$this->module_labels = get_label ( 'login_history_labels' );
		$this->folder = "ncadminpanelhistory/";
		$this->table = "master_admin_login_history";
		$this->load->library ( 'common' );
		$this->primary_key = 'login_id';
	}
	
	public function index($start=0)
	{		
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
		
		if (post_value ( 'paging' ) == "") {
			$this->session->set_userdata ( $this->module . "_search_field", post_value ( 'search_field' ) );
			$this->session->set_userdata ( $this->module . "_search_value", post_value ( 'search_value' ) );
		}
		
		if (get_session_value ( $this->module . "_search_field" ) != "" && get_session_value ( $this->module . "_search_value" ) != "") {
			$like = array (
					get_session_value ( $this->module . "_search_field" ) => get_session_value ( $this->module . "_search_value" ) 
			);
		}	
		$join [0] ['select'] = "admin_id,admin_username";
		$join [0] ['table'] = "mater_admin";
		$join [0] ['condition'] = "mater_admin.admin_id = master_admin_login_history.login_admin_id";
		$join [0] ['type'] = "LEFT"; 
				
		$totla_rows = $this->Mydb->get_num_join_rows ( $this->primary_key, $this->table, $where, null, null, null, $like,'',$join);
			//echo $qry = $this->db->last_query(); exit;
		/* pagination part start  */
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
		/* pagination part end */		
		$select_array = array ('login_id','login_time','login_ip','login_admin_id');
		$data ['records'] = $this->Mydb->get_all_records ( $select_array, $this->table, $where, $limit, $offset,$order_by, $like,'',$join );
		//echo $qry = $this->db->last_query(); exit;
		$page_relod = ($totla_rows  >  0 && $offset > 0 && empty($data ['records']))  ? 'Yes' : 'No';
		$html = get_template ( $this->folder . '/' . $this->module . '-ajax-list', $data );
		echo json_encode ( array (
				'status' => 'ok',
				'offset' => $offset,
				'page_reload' => $page_relod,
				'html' => $html 
		) );
		exit ();
	}
	function refresh()
   {
		$this->session->unset_userdata ( $this->module . "_search_field" );
		$this->session->unset_userdata ( $this->module . "_search_value" );
		redirect ( admin_url () . $this->module );
	}
	
	/* this method used to common module labels */
	private function load_module_info() 
	{
		$data = array ();
		$data ['module_label'] = $this->module_label;
		$data ['module_labels'] = $this->module_labels;
		$data ['module'] = $this->module;
		return $data;
	}
}
