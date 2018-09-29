<?php
/**************************
Project Name	: POS
Created on		: 03 march, 2016
Last Modified 	: 03 march, 2016
Description		: Page contains promotion for discount coupon add edit and delete functions..

***************************/
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Customer extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		$this->authentication->admin_authentication();
		$this->module = "customer";
		$this->module_label = get_label('customer_manage_label');
		$this->module_labels =  get_label('customer_manage_labels');
		$this->folder = "customer/";
		$this->table = "customers";
		$this->promotions = "promotion";
		$this->customer_promotion = "customer_promotions";
		$this->load->library ( 'common' );
		$this->primary_key = 'customer_id';
	}
	
	/* this method used to list all records . */
	public function index() {
		$data = $this->load_module_info ();	
		$this->layout->display_admin ( $this->folder . $this->module . "-list", $data );
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
				" $this->primary_key !=" => ''
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

		$join = ''; 
        
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
		/* pagination part end */
		$data ['records'] = $this->Mydb->get_all_records ($this->table.'.*,'.$this->table.'.customer_id as cu_cus_id,(SELECT login_time FROM pos_customer_login_history WHERE login_customer_id = cu_cus_id ORDER BY login_time DESC LIMIT 1) AS login_time',$this->table,$where,$limit,$offset,$order_by,$like,$groupby,$join);
		if($having2!='') {
		    $this->db->where('orders.order_primary_id IN (SELECT item_order_primary_id FROM pos_order_items WHERE item_product_id ="'.$having2.'")');
		}

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
			//$this->form_validation->set_rules ( 'customer_postal_code', 'lang:customer_postal_code', 'required|max_length[' . get_label ( 'postal_code_max_length' ) . ']' );
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
						'customer_email'=>post_value ( 'customer_email' ),
						'customer_phone'=>post_value ( 'customer_phone' ),
						'customer_password' => do_bcrypt ( $this->input->post ( 'customer_password' ) ),
						'customer_birthdate'=> $customer_dateofbirth,
						/*'customer_address_name'=>post_value ( 'customer_address_name' ),
						'customer_address_name2'=>post_value ( 'customer_address_name2' ),
						'customer_address_line1'=>post_value ( 'customer_address_line1' ),
						'customer_address_line2'=>post_value ( 'customer_address_line2' ),*/
						'customer_city'=>post_value ( 'customer_city' ),
						'customer_state'=>post_value ( 'customer_state' ),
						'customer_country'=>$this->input->post ( 'customer_country' ),
						'customer_postal_code'=>post_value ( 'customer_postal_code' ),
						/*'customer_company_name'=>post_value ( 'customer_company_name' ),
						'customer_company_address'=>post_value ( 'customer_company_address' ),
						'customer_company_phone'=>post_value ( 'customer_company_phone' ),*/
						'customer_notes'=>post_value ( 'customer_notes' ),
						'customer_hobbies'=>post_value ( 'customer_hobbies' ),
						'customer_maritial_status'=>post_value ( 'customer_maritial_status' ),
						'customer_facebook_link'=>post_value ( 'customer_facebook_link' ),
						'customer_instagram_link'=>post_value ( 'customer_instagram_link' ),
						'customer_twitter_link'=>post_value ( 'customer_twitter_link' ),
						'customer_youtube_link'=>post_value ( 'customer_youtube_link' ),
						'customer_fav_color'=>post_value ( 'customer_fav_color' ),
						'customer_fav_brand'=>post_value ( 'customer_fav_brand' ),
						'customer_fav_place'=>post_value ( 'customer_fav_place' ),
						'customer_fav_celebrates'=>post_value ( 'customer_fav_celebrates' ),
						'customer_fav_sports'=>post_value ( 'customer_fav_sports' ),
						'customer_fav_movie'=>post_value ( 'customer_fav_movie' ),
						'customer_fav_food'=>post_value ( 'customer_fav_food' ),
						'customer_fav_music'=>post_value ( 'customer_fav_music' ),
						'customer_fav_book'=>post_value ( 'customer_fav_book' ),
						'customer_fav_author'=>post_value ( 'customer_fav_author' ),
						'customer_fav_drink'=>post_value ( 'customer_fav_drink' ),
						'customer_fav_things'=>post_value ( 'customer_fav_things' ),
						'customer_prof_school'=>post_value ( 'customer_prof_school' ),
						'customer_prof_college'=>post_value ( 'customer_prof_college' ),
						'customer_prof_work'=>post_value ( 'customer_prof_work' ),
						'customer_prof_profession'=>post_value ( 'customer_prof_profession' ),
						'customer_prof_official_website'=>post_value ( 'customer_prof_official_website' ),
						'customer_prof_official_email'=>post_value ( 'customer_prof_official_email' ),
						'customer_prof_official_phone'=>post_value ( 'customer_prof_official_phone' ),
						'customer_prof_specialized'=>post_value ( 'customer_prof_specialized' ),
						'customer_prof_types'=>post_value ( 'customer_prof_types' ),
						'customer_prof_rewards'=>post_value ( 'customer_prof_rewards' ),
						'customer_type'=>post_value ( 'customer_type' ),
						'customer_photo'=>$customer_photo,
						'customer_status' => ($this->input->post ( 'status' ) == "A" ? 'A' : 'I'),
						'customer_created_on' => current_date (),
						'customer_created_by' => get_admin_id (),
						'customer_created_ip' => get_ip () 
				);
				
				//print_r($insert_array);
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
		$data ['module_action'] = get_label ( 'add' );
		$this->layout->display_admin ( $this->folder . $this->module . '-add', $data );
	}
	
	
	/* this method used to update record info.. */
	public function edit($edit_id = NULL) {


		$data = $this->load_module_info ();
		$id = addslashes ( decode_value ( $edit_id ) );
		$response =$image_arr = array ();
		

		$record = $this->Mydb->get_all_join_records ( '*', $this->table, array (
				$this->primary_key => $id,
		),'','','','','','' );
		(empty ( $record )) ? redirect ( admin_url () . $this->module ) : '';
		
		if ($this->input->post ( 'action' ) == "edit") {
			check_ajax_request (); /* skip direct access */
			$this->form_validation->set_rules ( 'customer_first_name', 'lang:customer_first_name', 'required' );
			if($this->input->post('customer_password') !="") {
				$this->form_validation->set_rules ( 'customer_password', 'lang:customer_password', 'required|min_length[6]' );
			}
			$this->form_validation->set_rules ( 'customer_email', 'lang:customer_email', 'required|callback_customeremail_exists' );
			//$this->form_validation->set_rules ( 'customer_postal_code', 'lang:customer_postal_code', 'required|max_length[' . get_label ( 'postal_code_max_length' ) . ']' );
			$this->form_validation->set_rules ( 'customer_phone', 'lang:customer_phone', 'required|max_length[' . get_label ( 'phone_max_length' ) . ']' );
			$this->form_validation->set_rules ( 'status', 'lang:status', 'required' );
			$this->form_validation->set_rules ( 'customer_photo', 'lang:customer_photo', 'callback_validate_image' );
			if ($this->form_validation->run () == TRUE) {

				$update_array = array (
						'customer_first_name' => post_value ( 'customer_first_name' ),
						'customer_last_name' => post_value ( 'customer_last_name' ),
						'customer_email'=>post_value ( 'customer_email' ),
						'customer_phone'=>post_value ( 'customer_phone' ),
						'customer_birthdate'=>date('Y-m-d',strtotime(post_value ( 'customer_birthdate' ))),
						/*'customer_address_name'=>post_value ( 'customer_address_name' ),
						'customer_address_name2'=>post_value ( 'customer_address_name2' ),
						'customer_address_line1'=>post_value ( 'customer_address_line1' ),
						'customer_address_line2'=>post_value ( 'customer_address_line2' ),*/
						'customer_city'=>post_value ( 'customer_city' ),
						'customer_state'=>post_value ( 'customer_state' ),
						'customer_country'=>post_value ( 'customer_country' ),
						'customer_postal_code'=>post_value ( 'customer_postal_code' ),
						/*'customer_company_name'=>post_value ( 'customer_company_name' ),
						'customer_company_address'=>post_value ( 'customer_company_address' ),
						'customer_company_phone'=>post_value ( 'customer_company_phone' ),*/
						'customer_notes'=>post_value ( 'customer_notes' ),
						'customer_hobbies'=>post_value ( 'customer_hobbies' ),
						'customer_maritial_status'=>post_value ( 'customer_maritial_status' ),
						'customer_facebook_link'=>post_value ( 'customer_facebook_link' ),
						'customer_instagram_link'=>post_value ( 'customer_instagram_link' ),
						'customer_twitter_link'=>post_value ( 'customer_twitter_link' ),
						'customer_youtube_link'=>post_value ( 'customer_youtube_link' ),
						'customer_fav_color'=>post_value ( 'customer_fav_color' ),
						'customer_fav_brand'=>post_value ( 'customer_fav_brand' ),
						'customer_fav_place'=>post_value ( 'customer_fav_place' ),
						'customer_fav_celebrates'=>post_value ( 'customer_fav_celebrates' ),
						'customer_fav_sports'=>post_value ( 'customer_fav_sports' ),
						'customer_fav_movie'=>post_value ( 'customer_fav_movie' ),
						'customer_fav_food'=>post_value ( 'customer_fav_food' ),
						'customer_fav_music'=>post_value ( 'customer_fav_music' ),
						'customer_fav_book'=>post_value ( 'customer_fav_book' ),
						'customer_fav_author'=>post_value ( 'customer_fav_author' ),
						'customer_fav_drink'=>post_value ( 'customer_fav_drink' ),
						'customer_fav_things'=>post_value ( 'customer_fav_things' ),
						'customer_prof_school'=>post_value ( 'customer_prof_school' ),
						'customer_prof_college'=>post_value ( 'customer_prof_college' ),
						'customer_prof_work'=>post_value ( 'customer_prof_work' ),
						'customer_prof_profession'=>post_value ( 'customer_prof_profession' ),
						'customer_prof_official_website'=>post_value ( 'customer_prof_official_website' ),
						'customer_prof_official_email'=>post_value ( 'customer_prof_official_email' ),
						'customer_prof_official_phone'=>post_value ( 'customer_prof_official_phone' ),
						'customer_prof_specialized'=>post_value ( 'customer_prof_specialized' ),
						'customer_prof_types'=>post_value ( 'customer_prof_types' ),
						'customer_prof_rewards'=>post_value ( 'customer_prof_rewards' ),
						'customer_type'=>post_value ( 'customer_type' ),
						'customer_status' => ($this->input->post ( 'status' ) == "A" ? 'A' : 'I'),
						'customer_created_on' => current_date (),
						'customer_created_by' => get_admin_id (),
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

				$this->session->set_flashdata ( 'admin_success', sprintf ( $this->lang->line ( 'success_message_edit' ), $this->module_label ) );
				$response ['status'] = 'success';
			} else {
				$response ['status'] = 'error';
				$response ['message'] = validation_errors ();
			}
			
			echo json_encode ( $response );
			exit ();
		}
		
		$data ['records'] = $record[0];
		
		/* Common labels */
		$data ['breadcrumb'] = $data ['form_heading'] = get_label ( 'edit' ) . ' ' . $this->module_label;
		$data ['module_action'] = 'edit/' . encode_value ( $record[0][$this->primary_key] );
		
		$this->layout->display_admin( $this->folder . $this->module . '-edit', $data );
	}
	
	/*view the customer detail in pop up*/
	public function view($view_id) {
				
		$id=decode_value($view_id);			
		/* customer details Start*/	
		
		$select_values="t1.*,t4.*, (SELECT login_time FROM pos_customer_login_history WHERE login_customer_id = t1.customer_id ORDER BY login_time DESC LIMIT 1) AS login_time";				
		$record = $this->Mydb->custom_query_single ( "SELECT $select_values FROM pos_customers AS t1
		LEFT JOIN pos_countries AS t4 ON t1.customer_country=t4.id
		WHERE t1.$this->primary_key= $id GROUP BY t1.$this->primary_key " );
		
		(empty ( $record )) ? redirect ( admin_url () . $this->module ) : '';
		
		$data['records'] 	= 	$record;
						
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
		//$wherearray=array('customer_company_id' => get_company_id(), 'customer_app_id'=>get_company_app_id());
		$wherearray=array();
		if ($postaction == 'Delete' && ! empty ( $ids )) {
			if (is_array ( $ids )) {
				$this->Mydb->delete_where_in($this->table,'customer_id',$ids,array());
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_delete' ), $this->module_label );
			} else {
				$this->Mydb->delete($this->table,array('customer_id'=>$ids));
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_delete' ), $this->module_label );
			}
			$response ['status'] = 'success';
			$response ['action'] = $postaction;
		}
		$where_array = array ();
		/* Activation */
		if ($postaction == 'Activate' && ! empty ( $ids )) {
			$update_values = array (
					"customer_status" => 'A',
					"customer_updated_on" => current_date (),
					'customer_updated_by' => get_admin_id (),
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
					'customer_updated_by' => get_admin_id (),
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
		/* Add Celebrity badge */
		if ($postaction == 'Add_Celebrity_Badge' && ! empty ( $ids )) {
			$update_values = array (
					"customer_celebrity_badge" => 1,
					"customer_updated_on" => current_date (),
					'customer_updated_by' => get_admin_id (),
					'customer_updated_ip' => get_ip () 
			);
			
			if (is_array ( $ids )) {
				$this->Mydb->update_where_in ( $this->table, $this->primary_key, $ids, $update_values, $where_array );
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_add_celebrity_bage' ), $this->module_labels );
			} else {
				$this->Mydb->update_where_in ( $this->table, $this->primary_key, array (
						$ids 
				), $update_values, $where_array );
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_add_celebrity_bage' ), $this->module_label );
			}
			
			$response ['status'] = 'success';
			$response ['action'] = $postaction;
		}
	
		/* Celebrity badge */
		if ($postaction == 'Remove_Celebrity_Badge' && ! empty ( $ids )) {
			$update_values = array (
					"customer_celebrity_badge" => 0,
					"customer_updated_on" => current_date (),
					'customer_updated_by' => get_admin_id (),
					'customer_updated_ip' => get_ip () 
			);
			
			if (is_array ( $ids )) {
				$this->Mydb->update_where_in ( $this->table, $this->primary_key, $ids, $update_values, $where_array );
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_remove_celebrity_bage' ), $this->module_labels );
			} else {
				$this->Mydb->update_where_in ( $this->table, $this->primary_key, array (
						$ids 
				), $update_values, $where_array );
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_remove_celebrity_bage' ), $this->module_label );
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
