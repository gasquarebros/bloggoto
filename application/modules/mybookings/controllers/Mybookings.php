<?php
/**************************
Project Name	: POS
Created on		: 3  March, 2016
Last Modified 	: 30 June, 2016
Description		: Page contains manage product categories

***************************/
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Mybookings extends CI_Controller 
{

	public function __construct() 
	{

		parent::__construct ();
		$this->module = "mybookings";
		$this->authentication->user_authentication();
		$this->module_label = get_label ( 'mybookings_label' );
		$this->module_labels = get_label ( 'mybookings_labels' );
		$this->folder = "mybookings/";
		$this->table = "order_service";
		$this->service_categorytable = "service_categories";
		$this->customers = "customers";
		$this->service_subcategorytable = "service_subcategories";
		$this->primary_key = 'order_service_id';
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
			'order_service_customer_id'	=> get_user_id()
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

		/* apply sort by */
		if (get_session_value ( $this->module . "_order_by_field" ) != "" && get_session_value ( $this->module . "_order_by_value" ) != "") {
			
			$order_by = array (
					get_session_value ( $this->module . "_order_by_field" ) => (get_session_value ( $this->module . "_order_by_value" ) == "ASC") ? "ASC" : "DESC" 
			);
		}

		/* apply category Id */
		if (get_session_value ( $this->module . "_category_id" ) != "") {
			
			$where = array_merge ( $where, array (
					'order_service_category_id' => get_session_value ( $this->module . "_category_id" ) 
			) );
		}
		$join = "";
		
		$join [0] ['select'] = "ser_cate_primary_id,ser_cate_id,ser_cate_name";
		$join [0] ['table'] = $this->service_categorytable;
		$join [0] ['condition'] = "ser_cate_primary_id = order_service_category_id";
		$join [0] ['type'] = "LEFT";
		
		$join [1] ['select'] = "customers.customer_id,customers.customer_first_name,customers.customer_last_name,customers.customer_username,customers.customer_email";
		$join [1] ['table'] = $this->customers;
		$join [1] ['condition'] = "order_service_customer_id = ".$this->customers.".customer_id";
		$join [1] ['type'] = "LEFT";

		$join [2] ['select'] = "pro_subcate_primary_id,pro_subcate_id,pro_subcate_name";
		$join [2] ['table'] = $this->service_subcategorytable;
		$join [2] ['condition'] = "pro_subcate_primary_id = order_service_subcategory_id";
		$join [2] ['type'] = "LEFT";

		$join [3] ['select'] = "providers.customer_id as providerid,providers.customer_first_name as provider_first_name,providers.customer_last_name as provider_last_name,providers.customer_username as provider_username,providers.customer_email as provider_email";
		$join [3] ['table'] = $this->customers.' as providers';
		$join [3] ['condition'] = "order_service_provider_id = providers.customer_id";
		$join [3] ['type'] = "LEFT";
		
		$groupby = "order_service_id";

		$totla_rows = $this->Mydb->get_num_join_rows ( $this->primary_key, $this->table, $where, null, null, null, $like, $groupby, $join );

		/* pagination part start */
		$admin_records =  0;
		$limit = (( int ) $admin_records == 0) ? 25 : $admin_records;
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
			$this->table.'.*'
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
	
}
/* End of file products.php  */
