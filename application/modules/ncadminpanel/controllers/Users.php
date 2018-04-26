<?php
/**************************
Project Name	: POS
Created on		: 03 march, 2016
Last Modified 	: 03 march, 2016
Description		: Page contains promotion for discount coupon add edit and delete functions..

***************************/
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Users extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		$this->authentication->admin_authentication();
		$this->module = "users";
		$this->module_label = get_label('users_manage_label');
		$this->module_labels =  get_label('users_manage_labels');
		$this->folder = "users/";
		$this->table = "customers";
		$this->load->library ( 'common' );
		$this->primary_key = 'customer_id';
	}
	
	/* this method used to list all records . */
	public function index() {
		
		$data = $this->load_module_info ();	
		
		/* In active records */	
		$where = array (
				'customer_company_id' => get_company_id(), 'customer_app_id'=>get_company_app_id(),
				
		);	
		$maxlogin_date = date('Y-m-d H:i:s',strtotime("-60 days"));		
		$order_by = array('login_time'=>'DESC');		
		$groupby = array('customer_id');
		$having1 = "login_time <= '$maxlogin_date'";
		if($having1!='') {
           $this->db->having($having1);
         }
		$inactive_count=$this->Mydb->get_all_records ($this->table.'.*,'.$this->table.'.customer_id as cu_cus_id,(SELECT login_time FROM pos_customer_login_history WHERE login_customer_id = cu_cus_id ORDER BY login_time DESC LIMIT 1) AS login_time',$this->table,$where,'','','','',$groupby,'');
		
		/* Total records */	
		$where1 = array (
				'customer_company_id' => get_company_id(), 'customer_app_id'=>get_company_app_id()
		);		
		$total_users_count = $this->Mydb->get_all_records ('customer_id',$this->table,$where1,'','','','','','');
		
		/* active records */	
		$where2 = array (
				'customer_company_id' => get_company_id(), 'customer_app_id'=>get_company_app_id(),
				 'customer_status'=>'A'
		);		
		$active_count = $this->Mydb->get_all_records ('customer_id',$this->table,$where2,'','','','','','');
		if(empty($total_users_count))
		{
			$data['total_users_count'] =0;
		}
		else
		{
		$data['total_users_count']  = count($total_users_count);
     	}
     	if(empty($active_count))
		{
			$data['active_count'] =0;
		}
		else
		{
		$data['active_count']  = count($active_count);
     	}
     	if(empty($inactive_count))
		{
			$data['inact_count'] =0;
		}
		else
		{
		$data['inact_count']  = count($inactive_count);
     	}
		$this->layout->display_company_admin ( $this->folder . $this->module . "-list", $data );
	}
	public function import() {
		$result=array();
	   if ($this->input->post ('action' ) == "Add") 
       {
		    check_ajax_request ();		    		     
		    $this->form_validation->set_rules ( 'csc_file11', 'lang:import_file', 'callback_validate_file1' );
		    if (empty($_FILES['csc_file11']['name']))
            {
            $this->form_validation->set_rules('csc_file11', 'lang:import_file','required');	
            }  
		    //echo $_FILES ['csc_file11'] ['name'];
		    //exit;	     
			if($this->form_validation->run()==TRUE)
			{ 
			 if (pathinfo($_FILES['csc_file11']['name'], PATHINFO_EXTENSION) == 'csv') 
			{
				  if ($_FILES['csc_file11']['name'] != '')
				  {
                    $error = false;
                    $line = false;
                    $lname = '';
                    $fname = '';  
                    $donotreadfirst = true;     
					ini_set('auto_detect_line_endings', true);              
                    $handle = fopen($_FILES["csc_file11"]["tmp_name"], "r");                  
				    while (($line_of_text = fgetcsv($handle, 2000, ",")) !== FALSE)
				    {
					if($donotreadfirst)
					{
						$donotreadfirst = false;
						continue;
					}
					$num = count($data);                         
					$customer_firstname = trim(stripslashes($line_of_text[0]));  
					$customer_lastname = trim(stripslashes($line_of_text[1]));
					$customer_email = trim(stripslashes($line_of_text[2]));
					$customer_phone = trim(stripslashes($line_of_text[3]));
					$customer_password = trim(stripslashes($line_of_text[4]));
					$customer_birthdate = trim(stripslashes($line_of_text[5]));
					$customer_address_name = trim(stripslashes($line_of_text[6]));			
					$customer_address_name2 = trim(stripslashes($line_of_text[7]));
					$customer_address_line1 = trim(stripslashes($line_of_text[8]));
					$customer_address_line2 = trim(stripslashes($line_of_text[9]));
					$customer_city = trim(stripslashes($line_of_text[10]));
					$customer_state = trim(stripslashes($line_of_text[11]));					
					$customer_postal_code = trim(stripslashes($line_of_text[12]));
					$customer_notes = trim(stripslashes($line_of_text[13]));
					$customer_photo = trim(stripslashes($line_of_text[14]));
					
					$res = $this->Mydb->get_record('*',$this->table,array('customer_app_id' => get_company_app_id (),'customer_email'=> addslashes($customer_email)),'');	
					if(empty($res)) {
						
							if($customer_phone!="")
							{
								$customer_phone=$customer_phone;
							}
							else
							{
								$customer_phone=rand();
							}											
							$insert_array = array (
								'customer_first_name' => $customer_firstname,
								'customer_last_name' => $customer_lastname,
								'customer_company_id'=>get_company_id(),
								'customer_app_id'=>get_company_app_id(),
								'customer_email'=>$customer_email,
								'customer_phone'=>$customer_phone,
								'customer_password' => do_bcrypt ($customer_password),
								'customer_birthdate'=> $customer_birthdate,
								'customer_address_name'=>$customer_address_name,
								'customer_address_name2'=>$customer_address_name2,
								'customer_address_line1'=>$customer_address_line1,
								'customer_address_line2'=>$customer_address_line2,
								'customer_city'=>$customer_city,
								'customer_state'=>$customer_state,					
								'customer_postal_code'=>$customer_postal_code,					
								'customer_notes'=>$customer_notes,
								'customer_photo'=>$customer_photo,
								'customer_status' =>  "A" ,
								'customer_created_on' => current_date (),
								'customer_created_by' => get_company_admin_id (),
								'customer_created_ip' => get_ip () 
						);
						$this->Mydb->insert($this->table, $insert_array);
						}	
				   }
				 }
			 }    	    			
			  $this->session->set_flashdata ( 'admin_success', sprintf ( $this->lang->line ( 'success_message_add' ), $this->module_label ) );
				$result ['status'] = 'success';
			} 
			else
			 {			   
				$result ['status'] = 'error';
				$result ['message'] = validation_errors ();
			 }		
			echo json_encode ( $result );
			exit ();

}
		$data=array();		
		$data ['module_label'] = $this->module_label;
		$data ['module_labels'] = $this->module_labels;
		$data ['module'] = $this->module;
		$this->load->view($this->folder."/".$this->module."-import",$data);		
	}
	function export()
	{	 
		    $this->load->helper ('export');
		    $this->session->userdata('query_customer_export'); 
		    //echo $this->session->userdata('query_customer_export');
		    //exit; 
		    $data=$this->Mydb->custom_query($this->session->userdata('query_customer_export'));
		    $exportarray =  array();
			$like = array ();
		    $or_where = array ();
		    /*$where = array (
				" $this->primary_key !=" => '', 'customer_company_id' => get_company_id(), 'customer_app_id'=>get_company_app_id(),'customer_status' => "A" 
		);
		    $order_by = array (
				$this->primary_key => 'DESC' 
		);
			$data = $this->Mydb->get_all_records( '*', $this->table, $where,null,null, $order_by, null,$groupby,$join,$where_in);	   */
		   if (! empty ( $data )) {
			$exportarray [] = array (
						get_label ( 'customer_first_name' ),
						get_label ( 'customer_last_name' ),
						get_label ( 'customer_email' ),
						get_label ( 'customer_phone' ),	
						get_label ( 'customer_address_line1' ),
						get_label ( 'customer_address_line2' ),	
						get_label ( 'customer_city' ),	
						get_label ( 'customer_state' ),	
						get_label ( 'customer_country' ),	
						get_label ( 'customer_postal_code' ),				
				);
				foreach ( $data as $export ) {
				$exportarray [] = array (
							output_value ( $export ['customer_first_name'] ),
							output_value ( $export ['customer_last_name'] ),
							output_value ( $export ['customer_email'] ),
							output_value ( $export ['customer_phone'] ),
							output_value ( $export ['customer_address_line1'] ),
							output_value ( $export ['customer_address_line2'] ),
							output_value ( $export ['customer_city'] ),
							output_value ( $export ['customer_state'] ),
							output_value ( get_country($export ['customer_country'] )),
							output_value ( $export ['customer_postal_code'] ),					
																
					);
				}
				
			}			
				array_to_xls ( $exportarray, 'Customers-' . date ( "m-d-Y-h-i-A" ) . '.xls' );		
	}
	public function validate_file1() {
		if (isset ( $_FILES ['csc_file11'] ['name'] ) && $_FILES ['csc_file11'] ['name'] != "") {
			if ($this->common->valid_file ( $_FILES ['csc_file11'] ) == "No") {
				$this->form_validation->set_message ( 'validate_file1', get_label ( 'upload_valid_file' ) );
				return false;
			}
		}
		
		return true;
	}
	public function download ($file_path = "")
    { 
		$data=array();
        $this->load->helper('download'); //load helper            
        $file_path = "customer-sample.csv";         
        $layout="no_theme"; //if you have layout          
        $data['download_path'] = $file_path;                                 		
		$data ['module_label'] = $this->module_label;
		$data ['module_labels'] = $this->module_labels;
		$data ['module'] = $this->module;
		$this->load->view($this->folder."/".$this->module."-import",$data);	                      
                     
    }
	/* this method used list ajax listing... */
	function ajax_pagination($page = 0) 
	{
		check_ajax_request(); /* skip direct access */
		$this->session->set_userdata('query_customer_export', ''); 
		$data = $this->load_module_info ();
		$like = array ();
		$having ="";
		$having1="";
		$having2="";	
		$queryvar="";	
		$where_in = "";
		$or_where = array ();
		$where = array (
				" $this->primary_key !=" => '', 'customer_company_id' => get_company_id(), 'customer_app_id'=>get_company_app_id()
		);
		$order_by = array (
				$this->primary_key => 'DESC' 
		);
		
		/* Search part start */
		
		if (post_value ( 'paging' ) == "") {
			$this->session->set_userdata ( $this->module . "_search_field", post_value ( 'search_field' ) );
			$this->session->set_userdata ( $this->module . "_search_value", post_value ( 'search_value' ) );
			$this->session->set_userdata ( $this->module . "_order_by_field", post_value ( 'sort_field' ) );
			$this->session->set_userdata ( $this->module . "_order_by_value", post_value ( 'sort_value' ) );
			$this->session->set_userdata ( $this->module . "_search_status", post_value ( 'status' ) );
			$this->session->set_userdata ( $this->module . "_search_customer_bought", post_value ( 'customer_bought' ) );
			$this->session->set_userdata ( $this->module . "_search_customer_bought_dt1", post_value ( 'customer_bought_dt1' ) );
			$this->session->set_userdata ( $this->module . "_search_customer_bought_dt2", post_value ( 'customer_bought_dt2' ) );
			$this->session->set_userdata ( $this->module . "_search_customer_spent_from", post_value ( 'customer_spent_from' ) );
			$this->session->set_userdata ( $this->module . "_search_customer_spent_to", post_value ( 'customer_spent_to' ) );
			$this->session->set_userdata ( $this->module . "_search_customer_spent_dt1", post_value ( 'customer_spent_dt1' ) );
			$this->session->set_userdata ( $this->module . "_search_customer_spent_dt2", post_value ( 'customer_spent_dt2' ) );
			$this->session->unset_userdata ( $this->module . "_search_customer_total_active" );
		    $this->session->unset_userdata ( $this->module . "_search_customer_total_lastactive" );
			
		}
		if (get_session_value ( $this->module . "_search_customer_total_active" ) != "") {
			
			$where = array_merge ( $where, array (
					'customer_status' => 'A',
			) );
		}
		if (get_session_value ( $this->module . "_search_customer_total_lastactive" ) != "") {
			
			$maxlogin_date = date('Y-m-d H:i:s',strtotime("-60 days"));	
			$having1 = "login_time <= '$maxlogin_date'";
			
		}
		
		/* filter by customer bought */
		if (get_session_value ( $this->module . "_search_customer_bought" ) != "" && get_session_value ( $this->module . "_search_customer_bought_dt1" ) != "" && get_session_value ( $this->module . "_search_customer_bought_dt2" ) != "") {
			$customer_bought=get_session_value ( $this->module . "_search_customer_bought" );
			$start_date = date('Y-m-d',strtotime(get_session_value ( $this->module . "_search_customer_bought_dt1" )));			
			$end_date = date('Y-m-d',strtotime(get_session_value ( $this->module . "_search_customer_bought_dt2" )));
			$where = array_merge ( $where, array (
					'date(order_date) >='=>$start_date,
				    'date(order_date) <='=>$end_date,
			) );
			$having2 = $customer_bought;
		}
		/* filter by customer spent */
		if (get_session_value ( $this->module . "_search_customer_spent_from" ) != "" && get_session_value ( $this->module . "_search_customer_spent_to" ) != "" && get_session_value ( $this->module . "_search_customer_spent_dt1" ) != "" && get_session_value ( $this->module . "_search_customer_spent_dt2" ) != "") {

			$start_date1 = date('Y-m-d',strtotime(get_session_value ( $this->module . "_search_customer_spent_dt1" )));			
			$end_date1 = date('Y-m-d',strtotime(get_session_value ( $this->module . "_search_customer_spent_dt2" )));
			$s_from=get_session_value ($this->module . "_search_customer_spent_from");
			$s_to=get_session_value ($this->module . "_search_customer_spent_to");
			$where = array_merge ( $where, array (
					'date(order_date) >='=>$start_date1,
				    'date(order_date) <='=>$end_date1,
			) );
			$having = "order_total_sum_amount >= $s_from AND order_total_sum_amount <= $s_to";
		}
		
		
		if (get_session_value ( $this->module . "_search_field" ) != "" && get_session_value ( $this->module . "_search_value" ) != "") {
			$like = array (
					get_session_value ( $this->module . "_search_field" ) => get_session_value ( $this->module . "_search_value" ) 
			);
			
		}
		/* filter by status */
		if (get_session_value ( $this->module . "_search_status" ) != "") {
			$where = array_merge ( $where, array (
					'customer_status' => get_session_value ( $this->module . "_search_status" )
			) );
		//	print_r($where); exit;
		}
		
		 /* add sort bu option */
		if (get_session_value ( $this->module . "_order_by_field" ) != "" && get_session_value ( $this->module . "_order_by_value" ) != "") 
		{	
			$order_by = array ( get_session_value ( $this->module . "_order_by_field" )  => (get_session_value ( $this->module . "_order_by_value" ) == "ASC")? "ASC" : "DESC" );
		}
		
		if($having!='') {
           $this->db->having($having);
         }
         if($having1!='') {
           $this->db->having($having1);
         }
         /*if($having2!='') {
           $this->db->having("FIND_IN_SET('$having2',item_p_ids) !=", 0);         
           $queryvar="AND item_product_id ='$having2'";
         }*/
         
		$join [0] ['select'] = " 	order_customer_primary_key,order_customer_order_primary_id,order_customer_order_id,group_concat( order_customer_order_primary_id ) AS order_ids";
		$join [0] ['table'] = "orders_customer_details";
		$join [0] ['condition'] = "orders_customer_details.order_customer_id = $this->primary_key";
		$join [0] ['type'] = "LEFT"; 
		$join [1] ['select'] = "order_primary_id,order_total_amount,group_concat( order_total_amount ) AS total_amount,sum(order_total_amount) as order_total_sum_amount,order_date,COUNT(DISTINCT order_primary_id) AS order_count";
		$join [1] ['table'] = "orders";
		$join [1] ['condition'] = "orders.order_primary_id = orders_customer_details.order_customer_order_primary_id AND orders.order_status != '5'";
		$join [1] ['type'] = "LEFT"; 
		/*$join[2]['select'] = 'item_order_id,item_product_id,group_concat( item_product_id ) AS item_p_ids';
		$join[2]['table'] = 'pos_order_items';
		$join[2]['condition'] = 'item_order_primary_id = orders_customer_details.order_customer_order_primary_id '.$queryvar;
		$join[2]['type'] = 'LEFT';*/
		$groupby = $this->primary_key;	
		
		$totla_rows = $this->Mydb->get_num_join_rows($this->table.'.*,'.$this->table.'.customer_id as cu_cus_id,(SELECT login_time FROM pos_customer_login_history WHERE login_customer_id = cu_cus_id ORDER BY login_time DESC LIMIT 1) AS login_time', $this->table, $where,$or_where, null, null, $like,$groupby,$join);
		if($having2!='') {
		    $this->db->where('orders.order_primary_id IN (SELECT item_order_primary_id FROM pos_order_items WHERE item_product_id ="'.$having2.'")');
		}
		$this->session->set_userdata('query_customer_export',$this->db->last_query()); 
		/* pagination part start  */
		$admin_records = company_records_perpage ();
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
		if($having!='') {
           $this->db->having($having);
         }
         if($having1!='') {
           $this->db->having($having1);
         }
         /*if($having2!='') {
           $this->db->having("FIND_IN_SET('$having2',item_p_ids) !=", 0);
           $queryvar="AND item_product_id ='$having2'";
         }*/
		/* pagination part end */
		$data ['records'] = $this->Mydb->get_all_records ($this->table.'.*,'.$this->table.'.customer_id as cu_cus_id,(SELECT login_time FROM pos_customer_login_history WHERE login_customer_id = cu_cus_id ORDER BY login_time DESC LIMIT 1) AS login_time',$this->table,$where,$limit,$offset,$order_by,$like,$groupby,$join);
		if($having2!='') {
		    $this->db->where('orders.order_primary_id IN (SELECT item_order_primary_id FROM pos_order_items WHERE item_product_id ="'.$having2.'")');
		}
		/*if($_SERVER['REMOTE_ADDR']=='123.201.139.85') { 
			echo $this->db->last_query();exit;
		}*/
		//echo $this->db->last_query();
		//exit;
		
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
	
	/* this method used check email alredy exists or not */
	public function customeremail_exists() {
		$customer_email = $this->input->post ( 'customer_email' );
		$edit_id = $this->input->post ( 'edit_id' );
		$user_arr = array();
		$where = array (
				'customer_email' => trim ( $customer_email ),
				'customer_app_id'=>get_company_app_id(), 
				'customer_company_id'=>get_company_id() 
		);
		if ($edit_id != "") {
			$where = array_merge ( $where, array (
					"customer_id !=" => $edit_id,
			) );
		}
		$result = $this->Mydb->get_record ( 'customer_id', $this->table, $where );
		if (! empty ( $result )) {
			$this->form_validation->set_message ( 'customeremail_exists', get_label ( 'customeremail_exists' ) );
			return false;
		} else {
			return true;
		}
	}
	
	/* this method used to to check validate image file */
	public function validate_image() {
		if (isset ( $_FILES ['customer_photo'] ['name'] ) && $_FILES ['customer_photo'] ['name'] != "") {
			if ($this->common->valid_image ( $_FILES ['customer_photo'] ) == "No") {
				$this->form_validation->set_message ( 'validate_image', get_label ( 'upload_valid_image' ) );
				return false;
			}
		}
	
		return true;
	}
	
	/* this method used to add record . */
	public function add() {
		$data = $this->load_module_info ();
		/* form submit */
		if ($this->input->post ( 'action' ) == "Add") {
			check_ajax_request (); 
			
			$this->form_validation->set_rules ( 'customer_first_name', 'lang:customer_first_name', 'required' );
			$this->form_validation->set_rules ( 'customer_password', 'lang:customer_password', 'required|min_length[6]' );
			$this->form_validation->set_rules ( 'customer_email', 'lang:customer_email', 'required|callback_customeremail_exists' );
			$this->form_validation->set_rules ( 'customer_postal_code', 'lang:customer_postal_code', 'required|max_length[' . get_label ( 'postal_code_max_length' ) . ']' );
			$this->form_validation->set_rules ( 'customer_phone', 'lang:customer_phone', 'required|max_length[' . get_label ( 'phone_max_length' ) . ']' );
			$this->form_validation->set_rules ( 'status', 'lang:status', 'required' );
			$this->form_validation->set_rules ( 'customer_photo', 'lang:customer_photo', 'callback_validate_image' );
			
			if ($this->form_validation->run () == TRUE) {
				/* upload image */
					$customer_photo = "";
				if (isset ( $_FILES ['customer_photo'] ['name'] ) && $_FILES ['customer_photo'] ['name'] != "") 
				{
					$customer_photo = $this->common->upload_image ( 'customer_photo', get_company_folder() . "/".$this->lang->line('customer_image_folder_name') );
				}
				
				$customer_dateofbirth="";
				$birth_date= post_value ( 'customer_birthdate' );
				if(!empty($birth_date)){
					//$customer_dateofbirth= date('d-m-Y',strtotime($birth_date));
					$customer_dateofbirth= date('Y-m-d',strtotime($birth_date));
				}
				
			
				$insert_array = array (
						'customer_first_name' => post_value ( 'customer_first_name' ),
						'customer_last_name' => post_value ( 'customer_last_name' ),
						'customer_company_id'=>get_company_id(),
						'customer_app_id'=>get_company_app_id(),
						'customer_email'=>post_value ( 'customer_email' ),
						'customer_phone'=>post_value ( 'customer_phone' ),
						'customer_password' => do_bcrypt ( $this->input->post ( 'customer_password' ) ),
						'customer_birthdate'=> $customer_dateofbirth,
						'customer_address_name'=>post_value ( 'customer_address_name' ),
						'customer_address_name2'=>post_value ( 'customer_address_name2' ),
						'customer_address_line1'=>post_value ( 'customer_address_line1' ),
						'customer_address_line2'=>post_value ( 'customer_address_line2' ),
						'customer_city'=>post_value ( 'customer_city' ),
						'customer_state'=>post_value ( 'customer_state' ),
						'customer_country'=>$this->input->post ( 'customer_country' ),
						'customer_postal_code'=>post_value ( 'customer_postal_code' ),
						'customer_company_name'=>post_value ( 'customer_company_name' ),
						'customer_company_address'=>post_value ( 'customer_company_address' ),
						'customer_company_phone'=>post_value ( 'customer_company_phone' ),
						'customer_notes'=>post_value ( 'customer_notes' ),
						'customer_photo'=>$customer_photo,
						'customer_status' => ($this->input->post ( 'status' ) == "A" ? 'A' : 'I'),
						'customer_created_on' => current_date (),
						'customer_created_by' => get_company_admin_id (),
						'customer_created_ip' => get_ip () 
				);
				
				//print_r($insert_array);
				$insert_id = $this->Mydb->insert ( $this->table, $insert_array );
				
				if($insert_id) {
					$promotions_save_array=array();
					if($this->input->post('customer_promotions') !='')
					{
						if(is_array($this->input->post('customer_promotions'))) {	
							foreach($this->input->post('customer_promotions') as $cpromo) {
								$promotions_save_array[] = array(
									'cp_company_id'=>get_company_id(),
									'cp_app_id'=>get_company_app_id(),
									'cp_customer_id'=>$insert_id,
									'cp_promotion_id'=>$cpromo,
									'cp_promotion_type'=>'promotion',
									'cp_created_on' => current_date (),
									'cp_created_by' => get_company_admin_id (),
									'cp_created_ip' => get_ip ()
								);
							}
						}
						else
						{
							$promotions_save_array[] = array(
								'cp_company_id'=>get_company_id(),
								'cp_app_id'=>get_company_app_id(),
								'cp_customer_id'=>$insert_id,
								'cp_promotion_id'=>$this->input->post('customer_promotions'),
								'cp_promotion_type'=>'promotion',
								'cp_created_on' => current_date (),
								'cp_created_by' => get_company_admin_id (),
								'cp_created_ip' => get_ip ()
							);
						}
						$this->db->insert_batch($this->customer_promotion,$promotions_save_array);
					}
				}
				$this->session->set_flashdata ( 'admin_success', sprintf ( $this->lang->line ( 'success_message_add' ), $this->module_label ) );
				$result ['status'] = 'success';
			} else {
				$result ['status'] = 'error';
				$result ['message'] = validation_errors ();
			}
			
			echo json_encode ( $result );
			exit ();
		}
		$perusecoupons=array();
		$perustomercoupons=array();
		$promotions=array();
		$promo=array(); //array(''=>$this->lang->line('select_promo'));
		
		$promotions=$this->Mydb->custom_query("SELECT * FROM pos_promotion WHERE promotion_id NOT IN (SELECT cp_promotion_id FROM pos_customer_promotions left join pos_promotion on pos_customer_promotions.cp_promotion_id = pos_promotion.promotion_id where pos_promotion.promotion_coupon_type ='per_use' AND pos_promotion.promotion_company_id = ".get_company_id()." AND pos_promotion.promotion_app_id='".get_company_app_id()."') AND pos_promotion.promotion_company_id = ".get_company_id()." AND pos_promotion.promotion_app_id='".get_company_app_id()."'");


		if($promotions !='') {
			foreach($promotions as $promotion)
			{
				$promo[$promotion['promotion_id']]= stripslashes(ucwords($promotion['promotion_name']));
			}
		}
		$data['promotions']=$promo;

		/* Common labels */
		$data ['breadcrumb'] = $data ['form_heading'] = get_label ( 'add' ) . ' ' . $this->module_label;
		$data ['module_action'] = get_label ( 'add' );
		$this->layout->display_company_admin ( $this->folder . $this->module . '-add', $data );
	}
	
	
	/* this method used to update record info.. */
	public function edit($edit_id = NULL) {


		$data = $this->load_module_info ();
		$id = addslashes ( decode_value ( $edit_id ) );
		$response =$image_arr = array ();
		

		$record = $this->Mydb->get_all_join_records ( '*', $this->table, array (
				$this->primary_key => $id,
				'customer_company_id' => get_company_id (),
				'customer_app_id' => get_company_app_id()
		),'','','','','',$join=array('table'=>$this->customer_promotion,'on'=>$this->table.'.customer_id='.$this->customer_promotion.'.cp_customer_id','opt'=>'left') );
		(empty ( $record )) ? redirect ( camp_url () . $this->module ) : '';
		if ($this->input->post ( 'action' ) == "edit") {
			check_ajax_request (); /* skip direct access */
			$this->form_validation->set_rules ( 'customer_first_name', 'lang:customer_first_name', 'required' );
			if($this->input->post('customer_password') !="") {
				$this->form_validation->set_rules ( 'customer_password', 'lang:customer_password', 'required|min_length[6]' );
			}
			$this->form_validation->set_rules ( 'customer_email', 'lang:customer_email', 'required|callback_customeremail_exists' );
			$this->form_validation->set_rules ( 'customer_postal_code', 'lang:customer_postal_code', 'required|max_length[' . get_label ( 'postal_code_max_length' ) . ']' );
			$this->form_validation->set_rules ( 'customer_phone', 'lang:customer_phone', 'required|max_length[' . get_label ( 'phone_max_length' ) . ']' );
			$this->form_validation->set_rules ( 'status', 'lang:status', 'required' );
			$this->form_validation->set_rules ( 'customer_photo', 'lang:customer_photo', 'callback_validate_image' );
			if ($this->form_validation->run () == TRUE) {

				$update_array = array (
						'customer_first_name' => post_value ( 'customer_first_name' ),
						'customer_last_name' => post_value ( 'customer_last_name' ),
						'customer_company_id'=>get_company_id(),
						'customer_app_id'=>get_company_app_id(),
						'customer_email'=>post_value ( 'customer_email' ),
						'customer_phone'=>post_value ( 'customer_phone' ),
						'customer_birthdate'=>date('Y-m-d',strtotime(post_value ( 'customer_birthdate' ))),
						'customer_address_name'=>post_value ( 'customer_address_name' ),
						'customer_address_name2'=>post_value ( 'customer_address_name2' ),
						'customer_address_line1'=>post_value ( 'customer_address_line1' ),
						'customer_address_line2'=>post_value ( 'customer_address_line2' ),
						'customer_city'=>post_value ( 'customer_city' ),
						'customer_state'=>post_value ( 'customer_state' ),
						'customer_country'=>post_value ( 'customer_country' ),
						'customer_postal_code'=>post_value ( 'customer_postal_code' ),
						'customer_company_name'=>post_value ( 'customer_company_name' ),
						'customer_company_address'=>post_value ( 'customer_company_address' ),
						'customer_company_phone'=>post_value ( 'customer_company_phone' ),
						'customer_notes'=>post_value ( 'customer_notes' ),
						'customer_status' => ($this->input->post ( 'status' ) == "A" ? 'A' : 'I'),
						'customer_created_on' => current_date (),
						'customer_created_by' => get_company_admin_id (),
						'customer_created_ip' => get_ip () 
				);
				
				//print_r($update_array); exit;
				/* upload image and unlink ols image */
				$image_arr = array();
				
				if (isset ( $_FILES ['customer_photo'] ['name'] ) && $_FILES ['customer_photo'] ['name'] != "") {
					$upload_image = $this->common->upload_image ( 'customer_photo', get_company_folder() . "/".$this->lang->line('customer_image_folder_name') );
					//echo $upload_image;
					//exit;
					$image_arr = array (
							'customer_photo' => $upload_image
					);

					$this->common->unlink_image($record[0]['customer_photo'],get_company_folder(),$this->lang->line('customer_image_folder_name')); /* unlink image..  */
				}
				elseif($this->input->post('remove_image')=="Yes") {
					$image_arr = array (
							'customer_photo' => ""
					);
				
					$this->common->unlink_image($record[0]['customer_photo'],get_company_folder(),$this->lang->line('customer_image_folder_name'));
				}
				
				$update_array = array_merge ( $update_array, $image_arr );
				
				/* if password updated */
				if( $this->input->post ( 'customer_password' ) !=""){
					$password_array = array('customer_password' => do_bcrypt ( $this->input->post ( 'customer_password' ) ));
					$update_array = array_merge($update_array,$password_array);
				}
				
				

				$res=$this->Mydb->update ( $this->table, array ($this->primary_key => $record[0][$this->primary_key] ), $update_array );

				//echo $this->db->last_query(); exit;

				if($res) 
				{ 
					$this->Mydb->delete($this->customer_promotion,array('cp_customer_id'=>$id,'cp_company_id' => get_company_id(), 'cp_app_id'=>get_company_app_id()));
					$promotions_save_array=array();
					if($this->input->post('customer_promotions') !='')
					{
						if(is_array($this->input->post('customer_promotions'))) {	
							foreach($this->input->post('customer_promotions') as $cpromo) {
								$promotions_save_array[] = array(
									'cp_company_id'=>get_company_id(),
									'cp_app_id'=>get_company_app_id(),
									'cp_customer_id'=>$id,
									'cp_promotion_id'=>$cpromo,
									'cp_promotion_type'=>'promotion',
									'cp_created_on' => current_date (),
									'cp_created_by' => get_company_admin_id (),
									'cp_created_ip' => get_ip ()
								);
							}
						}
						else
						{
							$promotions_save_array[] = array(
								'cp_company_id'=>get_company_id(),
								'cp_app_id'=>get_company_app_id(),
								'cp_customer_id'=>$id,
								'cp_promotion_id'=>$this->input->post('customer_promotions'),
								'cp_promotion_type'=>'promotion',
								'cp_created_on' => current_date (),
								'cp_created_by' => get_company_admin_id (),
								'cp_created_ip' => get_ip ()
							);
						}
						$this->db->insert_batch($this->customer_promotion,$promotions_save_array);
					}
				}
				$this->session->set_flashdata ( 'admin_success', sprintf ( $this->lang->line ( 'success_message_edit' ), $this->module_label ) );
				$response ['status'] = 'success';
			} else {
				$response ['status'] = 'error';
				$response ['message'] = validation_errors ();
			}
			
			echo json_encode ( $response );
			exit ();
		}
		$sel_prmotions=array();
		foreach($record as $all_record)
		{
			$sel_prmotions[]=$all_record['cp_promotion_id'];
		}
		$data ['records'] = $record[0];
		$data ['sel_prmotions'] = $sel_prmotions;
		
		
		$perusecoupons=array();
		$perustomercoupons=array();
		$promotions=array();
		$promo=array(); //array(''=>$this->lang->line('select_promo'));

		$promotions=$this->Mydb->custom_query("SELECT * FROM pos_promotion WHERE promotion_id NOT IN (SELECT cp_promotion_id FROM pos_customer_promotions left join pos_promotion on pos_customer_promotions.cp_promotion_id = pos_promotion.promotion_id where pos_promotion.promotion_coupon_type ='per_use' AND pos_promotion.promotion_company_id = ".get_company_id()." AND pos_promotion.promotion_app_id='".get_company_app_id()."' AND cp_customer_id !=".$id.") AND pos_promotion.promotion_company_id = ".get_company_id()." AND pos_promotion.promotion_app_id='".get_company_app_id()."'");
		if($promotions !='') {
			foreach($promotions as $promotion)
			{
				$promo[$promotion['promotion_id']]= stripslashes(ucwords($promotion['promotion_name']));
			}
		}
		$data['promotions']=$promo;
		
		
		/* Common labels */
		$data ['breadcrumb'] = $data ['form_heading'] = get_label ( 'edit' ) . ' ' . $this->module_label;
		$data ['module_action'] = 'edit/' . encode_value ( $record[0][$this->primary_key] );
		
		$this->layout->display_company_admin ( $this->folder . $this->module . '-edit', $data );
	}
	
	/*view the customer detail in pop up*/
	public function view($view_id) {
				
		$id=decode_value($view_id);			
		/* customer details Start*/	
		
		$select_values="t1.*,t4.*, GROUP_CONCAT(t3.promotion_name) as promotion_name, (SELECT login_time FROM pos_customer_login_history WHERE login_customer_id = t1.customer_id ORDER BY login_time DESC LIMIT 1) AS login_time";				
		$record = $this->Mydb->custom_query_single ( "SELECT $select_values FROM pos_customers AS t1
		LEFT JOIN pos_customer_promotions AS t2 ON t1.customer_id=t2.cp_customer_id
		LEFT JOIN pos_promotion AS t3 ON t2.cp_promotion_id=t3.promotion_id AND t3.promotion_status='A'
		LEFT JOIN pos_countries AS t4 ON t1.customer_country=t4.country_id
		WHERE t1.$this->primary_key= $id GROUP BY t1.$this->primary_key " );
		
		(empty ( $record )) ? redirect ( camp_url () . $this->module ) : '';
		$selected_available=array();
		$data['records'] 	= 	$record;
		$r_where = array (
				'order_customer_id'=>$id
		);
		/* customer details End*/	
		
		/* customer redeem point Start*/
		
		$joins [0] ['select'] = 'lh_id,SUM(lh_redeem_point) as redeem_point,lh_redeem_amount';
		$joins [0] ['table'] = "pos_loyality_history";
		$joins [0] ['condition'] = "lh_order_id = order_customer_order_id";
		$joins [0] ['type'] = "LEFT";
		$joins [1]['select'] = 'SUM(lup_customer_points) as earned_point';
		$joins [1] ['table'] = "pos_loyality_userpoints";
		$joins [1] ['condition'] = "lup_order_id = order_customer_order_id";
		$joins [1] ['type'] = "LEFT"; 	 
		$reward = $this->Mydb->get_all_records ('order_customer_order_id','pos_orders_customer_details',$r_where,'','','','','',$joins);
		$data['reward'] = $reward;
		
		/* customer redeem point End*/
		
		/* Promocode used Start*/
		
		/*$p_where = array (
				'order_customer_id'=>$id,
				'order_discount_applied'=>'Yes'
		);
		$joi [0] ['select'] = 'order_id,count(order_discount_applied) as discount_count,order_discount_applied';
		$joi [0] ['table'] = "pos_orders";
		$joi [0] ['condition'] = "order_id = order_customer_order_id";
		$joi [0] ['type'] = "LEFT"; 
		$promocode = $this->Mydb->get_all_records ('order_customer_order_id','pos_orders_customer_details',$p_where,'','','','','',$joi);
		$data['promocode'] = $promocode;*/
		
		$p_where = array (
				'promotion_history_customer_id'=>$id,
		);
		$promocode = $this->Mydb->get_all_records ('sum(promotion_history_applied_amt) as promotion_amount,count(promotion_history_id) as promotion_count','pos_promotion_history',$p_where,'','','','','','');
		if(empty($promocode))
		{
			$data['promocode_used'] =0;
			$data['promocode_amount'] =0;
		}
		else
		{
			$data['promocode_used'] =$promocode[0]['promotion_count'];
			$data['promocode_amount'] =$promocode[0]['promotion_amount'];
     	}
		
		/* Promocode used End*/
		
		/* Items Bought - Start*/
		
		$items_where = array (
				'order_customer_id'=>$id,'order_status!='=>'5'
		);
		$select_array = array(
			'order_customer_order_id'
		);
		
		/*$join[0]['select'] = 'item_order_id,item_name,SUM(item_qty) as count,item_unit_price,SUM(item_total_amount) as item_total_amount';
		$join[0]['table'] = 'pos_order_items';
		$join[0]['condition'] = 'item_order_id = order_customer_order_id';
		$join[0]['type'] = 'left';	*/
		$join[0]['select'] = 'item_order_id,item_name,SUM(item_qty) as count,item_unit_price,SUM(item_total_amount) as item_total_amount,(SELECT SUM(t1.order_total_amount) FROM pos_orders t1 join `pos_orders_customer_details` t2 on t1.order_primary_id = t2
.order_customer_order_primary_id WHERE t2.order_customer_id
 = pos_orders_customer_details.order_customer_id group by t2.`order_customer_id`
) AS total_amount,(SELECT  COUNT( DISTINCT t2.order_customer_order_primary_id
 ) FROM pos_orders t1 join `pos_orders_customer_details` t2 on t1.order_primary_id = t2
.order_customer_order_primary_id WHERE t2.order_customer_id
 = pos_orders_customer_details.order_customer_id group by t2.`order_customer_id`
) AS order_count ';		
		$join[0]['table'] = 'pos_order_items';
		$join[0]['condition'] = 'item_order_id = order_customer_order_id';
		$join[0]['type'] = 'left';	
		$join[1]['select'] = 'order_date';
		$join[1]['table'] = 'pos_orders';
		$join[1]['condition'] = 'order_id = order_customer_order_id';
		$join[1]['type'] = 'left';				
		//$groupby = array('item_order_id');						
		$groupby = array('item_product_id');						
		$orders = $this->Mydb->get_all_records ($select_array,'pos_orders_customer_details',$items_where,$limit,$offset,$order_by,$like,$groupby,$join);
		if($_SERVER['REMOTE_ADDR']=='122.164.116.84') {
			//echo $this->db->last_query();
		
		   //exit;
		}
		$data['orders'] = $orders;
		/* Items Bought - End*/
		
		
		/* Other Addresses - Start*/
		$address_where = array (
				'customer_id'=>$id,'customer_company_id' => get_company_id(), 'customer_app_id'=>get_company_app_id(),
				'address!='=>''
		);
		$secondary_addr = $this->Mydb->get_all_records ('*','pos_customer_secondary_addresses',$address_where);
		
		$data['other_addresses'] = $secondary_addr;
		$data['view_id'] = $view_id;
		/* Other Addresses - End */
						
		$this->load->view($this->folder."/".$this->module."-view",$data);
		
	}
	 /***  server side validtion - Valid email **/
    function isValidEmail($email)
    {
        $lower_email = strtolower($email);
        $valid_email = str_replace(' ', '', $lower_email);
        
        if (filter_var($valid_email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }
     /***  server side validtion - Number only **/
    function isValidName($str)
    {
        return preg_match("/^[A-Za-z_ ]+$/", $str);
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
		$wherearray=array('customer_company_id' => get_company_id(), 'customer_app_id'=>get_company_app_id());
		if ($postaction == 'Delete' && ! empty ( $ids )) {
			if (is_array ( $ids )) {
				$this->Mydb->delete_where_in($this->table,'customer_id',$ids,$wherearray);
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_delete' ), $this->module_label );
			} else {
				$this->Mydb->delete($this->table,array('customer_id'=>$ids,'customer_company_id' => get_company_id(), 'customer_app_id'=>get_company_app_id()));
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_delete' ), $this->module_label );
			}
			$response ['status'] = 'success';
			$response ['action'] = $postaction;
		}
		$where_array = array ( 'customer_company_id' => get_company_id (), 'customer_app_id'=>get_company_app_id());
		/* Activation */
		if ($postaction == 'Activate' && ! empty ( $ids )) {
			$update_values = array (
					"customer_status" => 'A',
					"customer_updated_on" => current_date (),
					'customer_updated_by' => get_company_admin_id (),
					'customer_updated_ip' => get_ip () 
			);
			
			if (is_array ( $ids )) {
				$this->Mydb->update_where_in ( $this->table, $this->primary_key, $ids, $update_values, $where_array );
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_activate' ), $this->module_labels );
			} else {
				
				$this->Mydb->update_where_in ( $this->table, $this->primary_key, array (
						$ids 
				), $update_values, $where_array );
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_activate' ), $this->module_label );
			}
			
			$response ['status'] = 'success';
			$response ['action'] = $postaction;
		}
		
		/* Deactivation */
		if ($postaction == 'Deactivate' && ! empty ( $ids )) {
			$update_values = array (
					"customer_status" => 'I',
					"customer_updated_on" => current_date (),
					'customer_updated_by' => get_company_admin_id (),
					'customer_updated_ip' => get_ip () 
			);
			
			if (is_array ( $ids )) {
				$this->Mydb->update_where_in ( $this->table, $this->primary_key, $ids, $update_values, $where_array );
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_deactivate' ), $this->module_labels );
			} else {
				$this->Mydb->update_where_in ( $this->table, $this->primary_key, array (
						$ids 
				), $update_values, $where_array );
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_deactivate' ), $this->module_label );
			}
			
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
		$this->session->unset_userdata ( $this->module . "_search_customer_bought" );
		$this->session->unset_userdata ( $this->module . "_search_customer_bought_dt1" );
		$this->session->unset_userdata ( $this->module . "_search_customer_bought_dt2" );
		$this->session->unset_userdata ( $this->module . "_search_customer_spent_from" );
		$this->session->unset_userdata ( $this->module . "_search_customer_spent_to" );
		$this->session->unset_userdata ( $this->module . "_search_customer_spent_dt1" );
		$this->session->unset_userdata ( $this->module . "_search_customer_spent_dt2" );
		$this->session->unset_userdata ( $this->module . "_search_customer_total_active" );
		$this->session->unset_userdata ( $this->module . "_search_customer_total_lastactive" );
		redirect ( camp_url () . $this->module );
	}
	function total_active() {
		
		$this->session->set_flashdata('admin_success',"Active customers filtered successfully");
		$this->session->set_userdata ( $this->module ."_search_customer_total_active", "1" );		
		$this->session->unset_userdata ( $this->module . "_search_field" );
		$this->session->unset_userdata ( $this->module . "_search_value" );
		$this->session->unset_userdata ( $this->module . "_order_by_value" );
		$this->session->unset_userdata ( $this->module . "_order_by_value" );
		$this->session->unset_userdata ( $this->module . "_search_status" );
		$this->session->unset_userdata ( $this->module . "_search_customer_bought" );
		$this->session->unset_userdata ( $this->module . "_search_customer_bought_dt1" );
		$this->session->unset_userdata ( $this->module . "_search_customer_bought_dt2" );
		$this->session->unset_userdata ( $this->module . "_search_customer_spent_from" );
		$this->session->unset_userdata ( $this->module . "_search_customer_spent_to" );
		$this->session->unset_userdata ( $this->module . "_search_customer_spent_dt1" );
		$this->session->unset_userdata ( $this->module . "_search_customer_spent_dt2" );
		$this->session->unset_userdata ( $this->module . "_search_customer_total_lastactive" );		
		redirect ( camp_url () . $this->module );
		
	}
	function total_lastactive() {
		$this->session->set_flashdata('admin_success',"Inactive last 60 days customers filtered successfully");
		$this->session->set_userdata ( $this->module . "_search_customer_total_lastactive", "1" );
		
		$this->session->unset_userdata ( $this->module . "_search_field" );
		$this->session->unset_userdata ( $this->module . "_search_value" );
		$this->session->unset_userdata ( $this->module . "_order_by_value" );
		$this->session->unset_userdata ( $this->module . "_order_by_value" );
		$this->session->unset_userdata ( $this->module . "_search_status" );
		$this->session->unset_userdata ( $this->module . "_search_customer_bought" );
		$this->session->unset_userdata ( $this->module . "_search_customer_bought_dt1" );
		$this->session->unset_userdata ( $this->module . "_search_customer_bought_dt2" );
		$this->session->unset_userdata ( $this->module . "_search_customer_spent_from" );
		$this->session->unset_userdata ( $this->module . "_search_customer_spent_to" );
		$this->session->unset_userdata ( $this->module . "_search_customer_spent_dt1" );
		$this->session->unset_userdata ( $this->module . "_search_customer_spent_dt2" );	
		$this->session->unset_userdata ( $this->module . "_search_customer_total_active" );			
		redirect ( camp_url () . $this->module );
		
	}

	/* this method used to common module labels */
	private function load_module_info() {
		$data = array ();
		$data ['module_label'] = $this->module_label;
		$data ['module_labels'] = $this->module_labels;
		$data ['module'] = $this->module;
		return $data;
	}
	
	
	
	function bought_items(){
		
		$id = $this->input->post('view_id');
		$start_date = str_replace('/','-',$this->input->post('start_date'));;
		$end_date = str_replace('/','-',$this->input->post('end_date'));
		$item_filter = $this->input->post('item_filter');
		$customer_id = decode_value($id);
		
		/* Items Bought - Start*/
		$items_where = array (
				'order_customer_id'=>$customer_id,'order_status!='=>'5'
		);
		
		if($item_filter == 'from'){
			$start_date = date('Y-m-d H:i:s',strtotime($start_date));			
			$end_date = date('Y-m-d H:i:s',strtotime($end_date));
			$items_where = array_merge($items_where,array('order_date >='=>$start_date, 'order_date <='=>$end_date));
			
		}
		
		$select_array = array(
			'order_customer_order_id'
		);
		
		$join[0]['select'] = 'item_order_id,item_name,SUM(item_qty) as count,SUM(item_qty) as count,item_unit_price,SUM(item_total_amount) as item_total_amount';
		$join[0]['table'] = 'pos_order_items';
		$join[0]['condition'] = 'item_order_id = order_customer_order_id';
		$join[0]['type'] = 'left';
		
		$join[1]['select'] = 'order_date,SUM(order_total_amount) as total_amount';
		$join[1]['table'] = 'pos_orders';
		$join[1]['condition'] = 'order_id = order_customer_order_id';
		$join[1]['type'] = 'left';		
		
		$groupby = array('item_product_id');
		
		$orders = $this->Mydb->get_all_records ($select_array,'pos_orders_customer_details',$items_where,$limit,$offset,$order_by,$like,$groupby,$join);
		
		$data['orders'] = $orders;
		$total = array_column($orders, 'item_total_amount');                     
		$total = show_price(array_sum($total));
		
		//echo $this->db->last_query();
		//echo '<pre>';
		//print_r($data['orders']);
		/* Items Bought - End*/
		
		$html = get_template ( $this->folder . '/' . $this->module . '-orders', $data );
		echo json_encode ( array (
				'status' => 'ok',
				'html' => $html,
				'total' => $total, 
		) );
		exit ();
		
		
	}
	
}
