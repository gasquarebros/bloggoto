  

<?php
/**************************
Project Name	: POS
Created on		: 3  March, 2016
Last Modified 	: 30 June, 2016
Description		: Page contains manage product categories

***************************/
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Manageorders extends CI_Controller 
{

	public function __construct() 
	{

		parent::__construct ();
		$this->module = "manageorders";
		$this->authentication->user_authentication();
		$this->module_label = get_label ( 'order_label' );
		$this->module_labels = get_label ( 'order_labels' );
		$this->folder = "manageorders/";
		$this->table = "orders";
		$this->primary_key = 'order_primary_id';
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
			'item_merchant_id' => get_user_id()
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
					'order_status' => get_session_value ( $this->module . "_search_status" ) 
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
		$join = "";
		
		$join [0] ['select'] = "customer_first_name,customer_last_name";
		$join [0] ['table'] = "customers";
		$join [0] ['condition'] = "order_customer_id = customer_id";
		$join [0] ['type'] = "INNER";
		
		$join [1] ['select'] = "status_name";
		$join [1] ['table'] = "order_status";
		$join [1] ['condition'] = "order_status = status_id";
		$join [1] ['type'] = "INNER";

		$join [2] ['select'] = "item_merchant_id, sum(item_total_amount) as order_items_price";
		$join [2] ['table'] = "order_items";
		$join [2] ['condition'] = "item_order_primary_id = order_primary_id AND item_merchant_id = ".get_user_id();
		$join [2] ['type'] = "INNER";
		

        $join [3] ['select'] = "sum(shipping_method_price) as order_item_delivery";
		$join [3] ['table'] = "order_item_shipping";
		$join [3] ['condition'] = "shipping_order_primary_id = order_primary_id AND order_item_shipping.id = order_items.shiiping_id";
		$join [3] ['type'] = "INNER";

		$groupby = "order_primary_id";

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
			'pos_orders.*'
		);

		$data ['records'] = $this->Mydb->get_all_records ( $select_array, $this->table, $where, $limit, $offset, $order_by, $like,$groupby, $join );
//echo $this->db->last_query();
//exit;
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
	
	function view($view_id)
	{
		$id=decode_value($view_id);
		if ($this->input->post ( 'action' ) == "Add") {



			//if ($this->form_validation->run () == TRUE) {
				$order_items = $_POST['orderitems'];
				if(!empty($order_items)) {
					$item_statuses = $order_items['item_status'];
					$item_shipping = $order_items['shiiping_id'];
					$item_shipping_bill = $order_items['shiiping_bill'];
					$shipping_items = $order_items['item_shipping'];
					
					$all_item_update = 1;
					if(!empty($item_statuses)){
						$error = 0;
						foreach($item_statuses as $item_key=>$item_status) {
							if($item_status == 5 && ($item_shipping[$item_key] == '' || $item_shipping_bill[$item_key]  == '' )){
								$error = 1;
							}
						}
						if($error == 0) {
							foreach($item_statuses as $item_key=>$item_status)
							{
								$update_array = array(
									'item_order_status' => $item_status
								);
								$this->Mydb->update ( 'pos_order_items', array ('item_id' => $item_key ), $update_array );
								$i_shipping = $shipping_items[$item_key];
								
								$shipping_update = array(
									'shipping_track_code' => $item_shipping[$item_key],
									'shipping_track_airway_bill'	=> $item_shipping_bill[$item_key]
								);
								$this->Mydb->update ( 'order_item_shipping', array ('id' => $i_shipping ), $shipping_update );

								if($item_status != 2){
									$all_item_update = 0;
								}
							}
						} else {
							$status = "error";
							$errorMsg = array('Shipping Tracking URL and Airway Bill No. is Required');
							$response = array (
								'status' => $status,
								'message' => $errorMsg 
							);
							echo json_encode ( $response );
							exit ();
						}
					}
				}
				if($all_item_update == 1){

					$total_record = $this->Mydb->get_num_rows('*','order_items',array('item_order_primary_id'=>$id));
					if($total_record == 0){
						$this->Mydb->update ( 'orders', array ('order_primary_id' => $id ), array('order_status'=>5) );
					} else {
						$this->Mydb->update ( 'orders', array ('order_primary_id' => $id ), array('order_status'=>1) );
					}
				} else {
					$this->Mydb->update ( 'orders', array ('order_primary_id' => $id ), array('order_status'=>1) );
				}

				$this->session->set_flashdata ( 'admin_success', sprintf ( $this->lang->line ( 'success_message_edit' ), $this->module_label ) );
				$response ['status'] = 'success';
			/*} else {
				$result ['status'] = 'error';
				$result ['message'] = validation_errors ();
			}*/
			
			echo json_encode ( $response );
			exit ();
		}
		$data = $this->load_module_info ();
		$like = array ();
		$where = array (
			" $this->primary_key" => $id,
			'item_merchant_id'	=> get_user_id()
		);
		$order_by = array (
			$this->primary_key => 'DESC' 
		);
		
		
		$join = "";
		
		$join [0] ['select'] = "customer_first_name,customer_last_name,customer_username,customer_phone,customer_email";
		$join [0] ['table'] = "pos_customers";
		$join [0] ['condition'] = "order_customer_id = customer_id";
		$join [0] ['type'] = "LEFT";
		
		$join [1] ['select'] = "status_name";
		$join [1] ['table'] = "pos_order_status";
		$join [1] ['condition'] = "order_status = status_id";
		$join [1] ['type'] = "LEFT";
		
		$join [2] ['select'] = "item_id,item_order_primary_id,item_product_id,item_subproductid,item_subproduct_name,item_name,item_image,item_sku,item_slug,item_specification,item_qty,item_unit_price,item_total_amount,item_merchant_name,item_merchant_id, item_order_status,shiiping_id";
		$join [2] ['table'] = "pos_order_items";
		$join [2] ['condition'] = "item_order_primary_id = ".$this->primary_key." AND item_merchant_id = ".get_user_id();
		$join [2] ['type'] = "LEFT";
		
		
		$join [3] ['select'] = "pos_order_shipping_address.*";
		$join [3] ['table'] = "pos_order_shipping_address";
		$join [3] ['condition'] = "order_shipping_order_primary_id = ".$this->primary_key;
		$join [3] ['type'] = "LEFT";

		$join [4] ['select'] = "pos_order_item_shipping.*";
		$join [4] ['table'] = "pos_order_item_shipping";
		$join [4] ['condition'] = "id= shiiping_id";
		$join [4] ['type'] = "LEFT";
		
		$groupby = "";
		$select_array = array (
			'pos_orders.*'
		);
		$record = $this->Mydb->get_all_records ( $select_array, $this->table, $where, '','', $order_by, $like,$groupby, $join );

		(empty ( $record )) ? redirect ( base_url () . $this->module ) : '';
		
		$data['records'] 	= 	$record;
						
		$this->layout->display_site($this->folder."/".$this->module."-view",$data);
	}
	
	function get_modifiers()
	{
		$id=decode_value($view_id);
		$data = $this->load_module_info ();
		$like = array ();
		$where = array (
			" $this->primary_key !=" => '',
		);
		$order_by = array (
			$this->primary_key => 'DESC' 
		);
		
		
		$join = "";
		
		$join [0] ['select'] = "customer_first_name,customer_last_name";
		$join [0] ['table'] = "pos_customers";
		$join [0] ['condition'] = "order_customer_id = customer_id";
		$join [0] ['type'] = "INNER";
		
		$join [1] ['select'] = "status_name";
		$join [1] ['table'] = "pos_order_status";
		$join [1] ['condition'] = "order_status = status_id";
		$join [1] ['type'] = "INNER";
		
		$join [2] ['select'] = "item_order_primary_id,item_product_id,item_subproductid,item_subproduct_name,item_name,item_image,item_sku,item_slug,item_specification,item_qty,item_unit_price,item_total_amount,item_merchant_name,item_merchant_id";
		$join [2] ['table'] = "pos_order_items";
		$join [2] ['condition'] = "item_order_primary_id = ".$this->primary_key;
		$join [2] ['type'] = "LEFT";
		
		
		$groupby = "order_primary_id";
		$select_array = array (
			'pos_orders.*'
		);
		$record = $this->Mydb->get_all_records ( $select_array, $this->table, $where, '','', $order_by, $like,$groupby, $join );
		
		echo "<pre>";
		print_r($record);
		exit;
		
		(empty ( $record )) ? redirect ( base_url () . $this->module ) : '';
		
		$data['records'] 	= 	$record;
		
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

	public function generate_pdf() {
		if(isset($_GET['local_order']) && $_GET['local_order'] != '') {
			$order_local_no = $_GET['local_order'];
			$pdf = generate_invoice_product($order_local_no,'merchant','');
		} else {
			redirect ( base_url () . $this->module );
		}
		
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

