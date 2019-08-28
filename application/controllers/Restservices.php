<?php
/**************************
 Project Name	: Bloggotoweb
Description		: Device Udpate

***************************/
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';
class Restservices extends REST_Controller {
   
	function __construct() {
		parent::__construct ();
		$this->load->library ( 'form_validation' );
		$this->form_validation->set_error_delimiters ( '<p>', '</p>' );
		$this->table = "services";
		$this->order_table = "order_service";
		$this->service_gallery = "service_gallery";
		$this->customers = "customers";
		$this->service_categorytable = "service_categories";
		$this->service_subcategorytable = "service_subcategories";
		$this->service_cities = "service_cities";
		$this->primary_key='ser_primary_id';
		$this->load->library('common');
		$this->load->helper('products');
	}
	
	public function categories_get()
	{ 
		$app_id = $this->get ( 'app_id' );
		if($app_id =='') {
			echo json_encode(array('status'=>'error','msg'=>'Invalid user'));
			exit(); 
		} else {
			$data = $this->Mydb->get_all_records('*',$this->service_categorytable,array('ser_cate_status' => 'A'));
			
		}
		echo json_encode ( array (
			'status' => 'success',
			'html' => $data,
		) );
		exit ();		
	}
} /* end of files */
