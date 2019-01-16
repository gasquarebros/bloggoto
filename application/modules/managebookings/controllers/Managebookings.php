  

<?php
/**************************
Project Name	: POS
Created on		: 3  March, 2016
Last Modified 	: 30 June, 2016
Description		: Page contains manage product categories

***************************/
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

require_once (FCPATH.'razorpay/Razorpay.php');
use Razorpay\Api\Api as RazorpayApi;
class Managebookings extends CI_Controller 
{

	public function __construct() 
	{

		parent::__construct ();
		$this->module = "managebookings";
		$this->authentication->user_authentication();
		$this->module_label = get_label ( 'managebookings_label' );
		$this->module_labels = get_label ( 'managebookings_labels' );
		$this->folder = "managebookings/";
		$this->service_categorytable = "service_categories";
		$this->customers = "customers";
		$this->service_subcategorytable = "service_subcategories";
		$this->city_table = "cities";
		$this->table = "order_service";
		$this->primary_key = 'order_service_id';
		$this->load->library ( 'common' );
		$this->load->helper('products');
		//$this->keyId = "rzp_test_Q6q1V4sCVacNNX";
		//$this->keySecret = "5voqCW6B3hgFxjwsVOSykbF7";
		$this->keyId = "rzp_live_WTq2SXYhBlP4s3";
		$this->keySecret = "V12VthMj0xuIH7tGxIi3Ph96";
		$this->displayCurrency = "INR";
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
			'order_service_provider_id' => get_user_id()
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
			$this->session->set_userdata ( $this->module . "_subcategory_id", post_value ( 'product_subcategory' ) );
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

		/* apply category Id */
		if (get_session_value ( $this->module . "_subcategory_id" ) != "") {
			
			$where = array_merge ( $where, array (
					'order_service_subcategory_id' => get_session_value ( $this->module . "_subcategory_id" ) 
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

		$join [3] ['select'] = "city_id,city_name";
		$join [3] ['table'] = $this->city_table;
		$join [3] ['condition'] = "city_id = order_service_city";
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

	function pay($order_service_id) {
		$id = decode_value($order_service_id);
		$where = array (
			"$this->primary_key" => $id,
			'order_service_provider_id' => get_user_id(),
			'order_service_is_paid'	=> '0'
		);
		$record = $this->Mydb->get_record ( '*', $this->table, $where);
		
		if(!empty($record)) { 
			
			$customer = $this->Mydb->get_record('*','customers',array('customer_id'=>$record['order_service_provider_id'])); 
			
			$start = $record['order_service_start_date'];
			$end = $record['order_service_end_date'];

			$start = $record['order_service_start_time'];
			$end = $record['order_service_end_time'];

			$datetime1 = date_create($start); 
			$datetime2 = date_create($end); 
			// calculates the difference between DateTime objects 
			$interval = date_diff($datetime1, $datetime2); 
			// printing result in days format 
			$diff =  $interval->format('%a'); 
			$service_type = $record['order_service_price_type'];
			if($diff > 0) {
				if($service_type == 'day'){
					$service_amount = $record['order_service_price'] * $diff;
				} else {
					$start_time = strtotime($record['order_service_start_time']);
					$end_time = strtotime($record['order_service_end_time']);
					$difference = round(abs($end_time - $start_time) / 3600,2);
					$service_amount = $record['order_service_price'] * $diff * $difference;
				}
			} else {
				if($service_type == 'day'){
					$service_amount = $record['order_service_price'] * 1;
				} else {
					$start_time = strtotime($record['order_service_start_time']);
					$end_time = strtotime($record['order_service_end_time']);
					$difference = round(abs($end_time - $start_time) / 3600,2);
					$service_amount = $record['order_service_price'] * 1 * $difference;
				}
			}
			$this->session->set_userdata('order_service_reference',$record['order_service_guid']);
			$total_amount = ($service_amount * 7)/100;
			$api = new RazorpayApi($this->keyId, $this->keySecret);
			$orderData = [
				'receipt'         => $record['order_service_guid'],
				'amount'          => $total_amount * 100, // 2000 rupees in paise
				'currency'        => 'INR',
				'payment_capture' => 1 // auto capture
			];
			$razorpayOrder = $api->order->create($orderData);
			$razorpayOrderId = $razorpayOrder['id'];
			$this->session->set_userdata('razorpay_order_service_id',$razorpayOrderId);

			$displayAmount = $amount = $orderData['amount'];
			if ($this->displayCurrency !== 'INR')
			{
				$url = "https://api.fixer.io/latest?symbols=$this->displayCurrency&base=INR";
				$exchange = json_decode(file_get_contents($url), true);
				$displayAmount = $exchange['rates'][$this->displayCurrency] * $amount / 100;
			}
			$checkout = 'automatic';
			
			$data = [
				"key"               => $this->keyId,
				"amount"            => $amount,
				"name"              => "Bloggoto",
				"description"       => "",
				"image"             => base_url().'/images/logo-1.png',
				"prefill"           => [
					"name"          => $customer['customer_first_name']." ".$customer['customer_last_name'],
					"email"         => $customer['customer_email'],
					"contact"       => $customer['customer_phone'],
				],
				"notes"             => [
					"address"           => "",
					"merchant_order_id" => "",
				],
				"theme"             => [
					"color"             => "#F37254"
				],
				"order_id"          => $razorpayOrderId,
			];

			if ($this->displayCurrency !== 'INR')
			{
				$data['display_currency']  = $this->displayCurrency;
				$data['display_amount']    = $displayAmount;
			}

			$json = json_encode($data);
			
			$data = $this->load_module_info ();	
			$data['json'] = $json; 
			$this->layout->display_site ( $this->folder . $this->module . "-razorpay", $data );
		} else {
			redirect(base_url().'managebookings');
		}
	}

	function updateorder() {
		$service_id = post_value('service_id');
		$value = post_value('value'); 
		if($value != '') {
			
			$where = array (
				"order_service_guid" => $service_id,
				'order_service_provider_id'	=> get_user_id()
			);
			$this->Mydb->update($this->table,$where,array('order_service_status'=>$value,'order_service_updated_on'=>date('Y-m-d H:i:s'),'order_service_updated_ip'=>get_ip()));
			
			$join = "";	
			$join [0] ['select'] = "customers.customer_id,customers.customer_first_name,customers.customer_last_name,customers.customer_username,customers.customer_email";
			$join [0] ['table'] = $this->customers;
			$join [0] ['condition'] = "order_service_customer_id = ".$this->customers.".customer_id";
			$join [0] ['type'] = "LEFT";
			$select_array = array (
				$this->table.'.*'
			);
			$groupby = 'order_service_id';
			$record = $this->Mydb->get_all_records ( $select_array, $this->table, $where, '', '', '', '',$groupby, $join );

			$data['records'] = $record;
			
			$st_date = $record[0]['order_service_start_date'];
			$ed_date = $record[0]['order_service_end_date'];
			if($record[0]['order_service_price_type'] == 'hour') {
				$st_time = ($record[0]['order_service_start_time'] !=''  && $record[0]['order_service_start_time'] != '00:00') ?  date( 'h.i A', strtotime($record[0]['order_service_start_time'])):'';
				$ed_time = ($record[0]['order_service_end_time'] !=''  && $record[0]['order_service_end_time'] != '00:00') ?  date( 'h.i A',strtotime( $record[0]['order_service_end_time'])):'';
			} else {
				$st_time = $ed_time = '';
			}
			//send mail and notification with success message
			$date =  $st_date." - ".$ed_date. "<br>".$st_time." - ".$ed_time;
			

			$this->load->library('myemail');
			$check_arr = array('[NAME]','[LOCAL_ORDER_NO]','[TITLE]','[DATE]');
			$replace_arr = array( ucfirst(stripslashes($record[0]['customer_first_name'].' '.$record[0]['customer_last_name'])),$record[0]['order_service_local_no'],stripslashes($record[0]['order_service_title']),$date);
			
			
			if($value == 'accepted') {
				$email_template_id = '11';
			} else {
				$email_template_id = '10';
			}

			if($email_template_id != '') {
				$mail_res = $this->myemail->send_admin_mail($record[0]['customer_email'],$email_template_id,$check_arr,$replace_arr);
			}
			echo json_encode ( array (
				'status' => 'success',
				'data' => 'managebookings',
			) );
			exit ();
		} 
		exit;
	}

	function success() {
		if($this->session->userdata('order_service_reference') !='' && $_REQUEST['razorpay_payment_id'] !='' && $_REQUEST['razorpay_signature'] !='') {
			$data = $this->load_module_info();
			$order_ref = $this->session->userdata('order_service_reference');
			$data['order_id'] = $order_ref;

			$like = array ();
			$where = array (
				"order_service_guid" => $order_ref,
				'order_service_provider_id'	=> get_user_id()
			);
			$order_by = array ();

			/* update the order payment keys */
			$this->Mydb->update($this->table,$where,array('payment_signature'=>$_REQUEST['razorpay_signature'],'payment_refer_id'=>$_REQUEST['razorpay_payment_id'],'order_service_paid_on'=>date('Y-m-d H:i:s'),'order_service_is_paid'=>1));
			$this->session->set_flashdata ( 'admin_success', sprintf ( $this->lang->line ( 'success_message_edit' ), $this->module_label ) );
			$this->session->set_userdata('order_service_reference','');
		}
		redirect(base_url().'managebookings');
	}
	
	function view($view_id)
	{
		$id = decode_value($view_id);
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
			"$this->primary_key" => $id,
			'order_service_provider_id' => get_user_id(),
			'order_service_is_paid'	=> '1'
		);
		$order_by = array (
			$this->primary_key => 'DESC' 
		);
		
		
		$join = "";
		$join [0] ['select'] = "ser_cate_primary_id,ser_cate_id,ser_cate_name";
		$join [0] ['table'] = $this->service_categorytable;
		$join [0] ['condition'] = "ser_cate_primary_id = order_service_category_id";
		$join [0] ['type'] = "LEFT";
		
		$join [1] ['select'] = "customers.customer_id,customers.customer_first_name,customers.customer_last_name,customers.customer_username,customers.customer_email,customer_phone";
		$join [1] ['table'] = $this->customers;
		$join [1] ['condition'] = "order_service_customer_id = ".$this->customers.".customer_id";
		$join [1] ['type'] = "LEFT";

		$join [2] ['select'] = "pro_subcate_primary_id,pro_subcate_id,pro_subcate_name";
		$join [2] ['table'] = $this->service_subcategorytable;
		$join [2] ['condition'] = "pro_subcate_primary_id = order_service_subcategory_id";
		$join [2] ['type'] = "LEFT";

		$join [3] ['select'] = "city_id,city_name";
		$join [3] ['table'] = $this->city_table;
		$join [3] ['condition'] = "city_id = order_service_city";
		$join [3] ['type'] = "LEFT";
		
		$groupby = "order_service_id";
		$select_array = array (
			$this->table.'.*'
		);
		$record = $this->Mydb->get_all_records ( $select_array, $this->table, $where, '','', $order_by, $like,$groupby, $join );

		(empty ( $record )) ? redirect ( base_url () . $this->module ) : '';
		
		$data['records'] 	= 	$record;
						
		$this->layout->display_site($this->folder."/".$this->module."-view",$data);
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

