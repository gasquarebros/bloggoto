<?php
/**************************
 Project Name	: Bloggotoweb
Description		: Device Udpate

***************************/
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';
class Api extends REST_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->library ( 'form_validation' );
		$this->form_validation->set_error_delimiters ( '<p>', '</p>' );
	}

	function insert_post() {

		$this->form_validation->set_rules ( 'reference_id', 'lang:rest_customer_id_required', 'trim|required' );
		$this->form_validation->set_rules ( 'device_id', 'lang:device_id', 'trim|required' );
		$this->form_validation->set_rules ( 'device_type', 'lang:device_type', 'trim|required' );

		if ($this->form_validation->run () == TRUE) {
			
			/* post values */
			$userid = decode_value($this->post ( 'reference_id' )); /* mobile device id or browser session id */
			$deviceid = $this->post ( 'device_id' );
			$device_type = $this->post ( 'device_type' );
			
			$this->Mydb->update ( 'customers', array (
					'customer_id' => $userid 
			), array (
					'customer_device_id' => $deviceid,
					'customer_device_type' => $device_type 
			) );
			
			$return_array = array (
					'status' => "ok",
					'message' => 'Success' 
			);
			$this->set_response ( $return_array, success_response () );
			
	    	$log_array=json_encode(array_merge($return_array,array('userid'=>$userid,'device_type'=>$device_type,'deviceid'=>$deviceid)));
	        $file_name='device_log.txt';
	        $log_file =APPPATH.'/logs/'.$file_name;
	        file_put_contents($log_file,$log_array);			
		} else {
			
			$this->response ( array (
					'status' => 'error',
					'message' => get_label ( 'rest_form_error' ),
					'form_error' => validation_errors () 
			), something_wrong () ); /* error message */
		}
	}
} /* end of files */
