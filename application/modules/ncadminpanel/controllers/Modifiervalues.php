<?php
/**************************
Project Name	: POS
Created on		: 4  March, 2016
Last Modified 	: 09 March, 2016
Description		: Page contains manage product Modifier values

***************************/
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Modifiervalues extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		$this->module = "modifiervalues";
		$this->authentication->admin_authentication();
		$this->module_label = get_label ( 'pro_modifier_value_label' );
		$this->module_labels = get_label ( 'pro_modifier_value_labels' );
		$this->folder = "product-modifier-values/";
		$this->table = "product_modifier_values";
		$this->primary_key = 'pro_modifier_value_primary_id';
		$this->load->library ( 'common' );
		$this->load->helper('products');
		/**/
	}
	
	/* this method used to list all records . */
	public function index($modifier_value=null) {

		$data = $this->load_module_info ();		
		$this->layout->display_admin ( $this->folder . $this->module . "-list", $data );
	}
	
	/* this method used list ajax listing... */
	function ajax_pagination($page = 0) {
		check_ajax_request (); /* skip direct access */
		
		$data = $this->load_module_info ();
		$like = array ();
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
			$this->session->set_userdata ( $this->module . "_search_status", post_value ( 'status' ) );
			$this->session->set_userdata ( $this->module . "_order_by_field", post_value ( 'sort_field' ) );
			$this->session->set_userdata ( $this->module . "_order_by_value", post_value ( 'sort_value' ) );
			$this->session->set_userdata ( $this->module . "_product_modifier", post_value ( 'product_modifier' ) );
		}
		
		/* search by text */
		if (get_session_value ( $this->module . "_search_field" ) != "" && get_session_value ( $this->module . "_search_value" ) != "") {
			$like = array (
					get_session_value ( $this->module . "_search_field" ) => get_session_value ( $this->module . "_search_value" ) 
			);
		}
		
		/* search by status  */
		if (get_session_value ( $this->module . "_search_status" ) != "") {
			$where = array_merge ( $where, array (
					'pro_modifier_value_status' => get_session_value ( $this->module . "_search_status" )
			) );
		}
		
		/* filter by modifier */
		if (get_session_value ( $this->module . "_product_modifier" ) != "") {
			$where = array_merge ( $where, array (
					'pro_modifier_value_modifier_primary_id' => get_session_value ( $this->module . "_product_modifier" )
			) );
		}
		
		
		/* apply sort by */
		if (get_session_value ( $this->module . "_order_by_field" ) != "" && get_session_value ( $this->module . "_order_by_value" ) != "") {
		
			$order_by = array (get_session_value ( $this->module . "_order_by_field" )  => (get_session_value ( $this->module . "_order_by_value" ) == "ASC")? "ASC" : "DESC");
		}
		
		$totla_rows = $this->Mydb->get_num_rows ( $this->primary_key, $this->table, $where, null, null, null, $like );
		
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
		/* pagination part end */
		/* add join */
		$join[0]['select'] = "product_modifiers.pro_modifier_name";
		$join[0]['table'] = "product_modifiers";
		$join[0]['condition'] = "product_modifier_values.pro_modifier_value_modifier_primary_id = product_modifiers.pro_modifier_primary_id";
		$join[0]['type'] = "left";
		
		$select_array = array ('pro_modifier_value_primary_id ','pro_modifier_value_name','pro_modifier_value_status','pro_modifier_value_sequence','pro_modifier_value_price','pro_modifier_value_modifier_primary_id');
		$data ['records'] = $this->Mydb->get_all_records ( $select_array, $this->table, $where, $limit, $offset, $order_by, $like ,'',$join);
		
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
	
	/* this method used to add record . */
	public function add($modifier=null) {
		$data = $this->load_module_info ();

		/* form submit */
		if ($this->input->post ( 'action' ) == "Add") {
			check_ajax_request (); /* skip direct access */
			$modifier_val = $this->validate_modifier(encode_value($this->input->post('product_modifier'))); /* validate modifier*/
			
			$this->form_validation->set_rules ( 'pro_modifier_value_name', 'lang:pro_modifier_value_name', 'required|callback_modifier_value_exists' );
			$this->form_validation->set_rules ( 'status', 'lang:status', 'required' );
			$this->form_validation->set_rules ( 'pro_modifier_value_image', 'pro_modifier_value_image', 'callback_validate_image' );
			
			if ($this->form_validation->run () == TRUE) {
				$company_array = '';
				$pro_modifier_value_id = get_guid($this->table,'pro_modifier_value_id',$company_array);
			 	$pro_modifier_value_sequence = ((int)$this->input->post('pro_modifier_value_sequence') == 0)?  get_sequence('pro_modifier_value_sequence',$this->table,array('pro_modifier_value_modifier_primary_id' => $modifier_val['pro_modifier_primary_id'])) : $this->input->post('pro_modifier_value_sequence'); 
				/* upload image */
				$pro_modifier_value_image = "";
				if (isset ( $_FILES ['pro_modifier_value_image'] ['name'] ) && $_FILES ['pro_modifier_value_image'] ['name'] != "") {
					$pro_modifier_value_image = $this->common->upload_image ( 'pro_modifier_value_image', get_company_folder() . "/".$this->lang->line('product_modifiervalues_image_folder_name') );
				}
				$is_default=$this->input->post('is_default');
				$is_default= ( ( !empty($is_default) ) && ( $is_default='Yes' ) )?"Yes":"No";
				$insert_array = array (
						'pro_modifier_value_name' => post_value ( 'pro_modifier_value_name' ),
						'pro_modifier_value_price' => post_value ( 'pro_modifier_value_price' ),
						'pro_modifier_value_modifier_primary_id'=> $modifier_val['pro_modifier_primary_id'] ,
						'pro_modifier_value_modifier_id' => $modifier_val['pro_modifier_id'],
						'pro_modifier_value_id' => $pro_modifier_value_id,
						'pro_modifier_value_is_default'=>$is_default,
						'pro_modifier_value_image' => $pro_modifier_value_image,
						'pro_modifier_value_status' => (post_value('status')=="A" ? 'A' : 'I'),
						'pro_modifier_value_sequence' => $pro_modifier_value_sequence,
						'pro_modifier_value_created_on' => current_date (),
						'pro_modifier_value_created_by' => get_admin_id (),
						'pro_modifier_value_created_ip' => get_ip () 
				);
				
				$insert_id = $this->Mydb->insert ( $this->table, $insert_array );
				
				
				/*update default modifier value */
				if( $is_default == "Yes" ){
					$this->make_default($insert_id);
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
		
		/* Common labels */
		$data ['breadcrumb'] = $data ['form_heading'] = get_label ( 'add' ) . ' ' . $this->module_label;
		$data['modifier'] = $modifier;
		$data ['module_action'] = 'add/'.$modifier;
		$this->layout->display_admin ( $this->folder . $this->module . '-add', $data );
	}
	
	/* this method used to update record info.. */
	public function edit($edit_id = NULL, $modifier ) {

		$data = $this->load_module_info ();
		$id = addslashes ( decode_value ( $edit_id ) );
		$response =$image_arr = array ();
		$record = $this->Mydb->get_record ( '*', $this->table, array (
				$this->primary_key => $id
		) );
		(empty ( $record )) ? redirect ( camp_url () . $this->module ) : '';
		
		if ($this->input->post ( 'action' ) == "edit") {
			check_ajax_request (); /* skip direct access */
			$modifier_val = $this->validate_modifier(encode_value($this->input->post('product_modifier'))); /* validate modifier*/
			
			$this->form_validation->set_rules ( 'pro_modifier_value_name', 'lang:pro_modifier_value_name', 'required|callback_modifier_value_exists' );
			$this->form_validation->set_rules ( 'status', 'lang:status', 'required' );
			$this->form_validation->set_rules ( 'pro_modifier_value_image', 'lang:pro_modifier_value_image', 'callback_validate_image' );
			
			if ($this->form_validation->run () == TRUE) {
				
				$company_array = '';
				$pro_modifier_value_sequence = ((int)$this->input->post('pro_modifier_value_sequence') == 0)?  get_sequence('pro_modifier_value_sequence',$this->table,array_merge($company_array,array('pro_modifier_value_modifier_primary_id' => $modifier_val['pro_modifier_primary_id']))) : $this->input->post('pro_modifier_value_sequence');
				
				$is_default=$this->input->post('is_default');
				$is_default= ( ( !empty($is_default) ) && ( $is_default='Yes' ) )?"Yes":"No";
				
				$update_array = array (
						'pro_modifier_value_name' => post_value ( 'pro_modifier_value_name' ),
						'pro_modifier_value_price' => post_value ( 'pro_modifier_value_price' ),
						'pro_modifier_value_modifier_primary_id'=> $modifier_val['pro_modifier_primary_id'] ,
						'pro_modifier_value_modifier_id' => $modifier_val['pro_modifier_id'],
						'pro_modifier_value_status' => (post_value('status')=="A" ? 'A' : 'I'),
						'pro_modifier_value_is_default'=>$is_default,
						'pro_modifier_value_sequence' => $pro_modifier_value_sequence,
						'pro_modifier_value_updated_on' => current_date (),
						'pro_modifier_value_updated_by' => get_admin_id (),
						'pro_modifier_value_updated_ip' => get_ip () 
				);
				
				
				/* upload image and unlink ols image */
				$image_arr = array();
				if (isset ( $_FILES ['pro_modifier_value_image'] ['name'] ) && $_FILES ['pro_modifier_value_image'] ['name'] != "") {
					$upload_image = $this->common->upload_image ( 'pro_modifier_value_image', get_company_folder() . "/".$this->lang->line('product_modifiervalues_image_folder_name') );
					$image_arr = array (
							'pro_modifier_value_image' => $upload_image
					);
						
					$this->common->unlink_image($record['pro_modifier_value_image'],get_company_folder(),$this->lang->line('product_modifiervalues_image_folder_name')); /* unlink image..  */
				}
				elseif($this->input->post('remove_image')=="Yes") {
					$image_arr = array (
							'pro_modifier_value_image' => ""
					);
				
					$this->common->unlink_image($record['pro_modifier_value_image'],get_company_folder(),$this->lang->line('product_modifiervalues_image_folder_name'));
				}
				
				$update_array = array_merge ( $update_array, $image_arr );
				$this->Mydb->update ( $this->table, array ($this->primary_key => $record [$this->primary_key] ), $update_array );
				
				/*update default modifier value */
				if( $is_default == "Yes" ){
					$this->make_default($id);
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
		$data ['records'] = $record;
		/* Common labels */
		$data ['breadcrumb'] = $data ['form_heading'] = get_label ( 'edit' ) . ' ' . $this->module_label;
		$data['modifier'] = $modifier;
		$data ['module_action'] = 'edit/' . encode_value ( $record [$this->primary_key] )."/".$modifier;
		$this->layout->display_admin ( $this->folder . $this->module . '-edit', $data );
	}
        
        public function onpage()
	{
		
		$update_exist=array();
		$new_exist=array();
		$modifier_update_exist=array();
		$new_modifier_exist=array();
		$exist=false;
		$retun_page="current";
		
		
		/* update modifier*/
		
                
		
		/*check exist for the update modifier list*/
		
		    $pro_modifier_value_name=$this->input->post('pro_modifier_value_name');
			$pro_modifier_value_price=$this->input->post('pro_modifier_value_price');
			$pro_modifier_value_sequence=$this->input->post('sequence');
			$pro_modifier_value_status=$this->input->post('pro_modifier_value_status');
                        /*$pro_modifier_value_modifier_primary_id=$this->input->post('pro_modifier_value_modifier_primary_id');*/
			
			
			/*check exist for the update modifier value list*/
			if(isset($pro_modifier_value_name) && !empty($pro_modifier_value_name))
			{
			foreach($pro_modifier_value_name as $key=>$v)
			{
				$modifier_id=$key;
				foreach($pro_modifier_value_name[$key] as $k=>$v)
				{
					if(trim($v)!='')
					{
						 $modifier_value_name= addslashes(trim($v));
						 $modifier_value_primary_id=$k;
						 $check_exist=$this->Mydb->get_record(array('pro_modifier_value_primary_id','pro_modifier_value_name'), 'pos_product_modifier_values', array('pro_modifier_value_modifier_primary_id'=>$modifier_id,"pro_modifier_value_primary_id !=" => $modifier_value_primary_id,'pro_modifier_value_name' => trim ( $modifier_value_name )));	
						 if(!empty($check_exist))
						 {
							if( isset($pro_modifier_value_name[$key][$check_exist['pro_modifier_value_primary_id']]) && strtolower($pro_modifier_value_name[$key][$check_exist['pro_modifier_value_primary_id']]) == strtolower($check_exist['pro_modifier_value_name']) )
							 {
								 $exist=true;
								 $update_exist[]=array('update_main_id' => $k);
							 }
							 
						 }
					}
				}
				
			}
		    }
			
			
			if($exist == false)
			{
				if(isset($pro_modifier_value_name) && !empty($pro_modifier_value_name))
				{
				foreach($pro_modifier_value_name as $key=>$v)
				{
					 $modifier_id=$key;
					 /*in modifier vlaue update post value has been duplicate value means find the key for modifier value*/ 	
					  $duplicates=array_unique( array_diff_assoc( array_map('strtolower', $pro_modifier_value_name[$key]), array_unique( array_map('strtolower', $pro_modifier_value_name[$key]) ) ) );
					  
					  if(!empty($duplicates))
					  {
						  $exist=true;
						  foreach($duplicates as $k=>$v)
						  {
							 $update_exist[]=array('update_main_id' => $k);
						  }
					  }
				}
			    }
                                
                                
			}
			
			/*true means allow for the modifer value*/
			
				
			if($exist == false)
			{
					
				
				$new_pro_modifier_value_name=$this->input->post('new_pro_modifier_value_name');
				$new_pro_modifier_value_price=$this->input->post('new_pro_modifier_value_price');
				$new_pro_modifier_value_sequence=$this->input->post('new_pro_modifier_value_sequence');
				$new_pro_modifier_value_status=$this->input->post('new_pro_modifier_value_status');
                                
                if( isset($new_pro_modifier_value_name) && !empty($new_pro_modifier_value_name) )
				{
                    foreach($new_pro_modifier_value_name as $mod_key=>$mod_v)
					{
                        if($mod_v!='')
					    {
							foreach($pro_modifier_value_name as $key=>$v)
							{
									 $modifier_id=$key;
									 /*in modifier vlaue update post value has been duplicate value means find the key for modifier value*/ 	
									  //$duplicates=array_unique( array_diff_assoc( array_map('strtolower', $pro_modifier_value_name[$key]), array_unique( array_map('strtolower', $pro_modifier_value_name[$key]) ) ) );
									  if( in_array( strtolower($mod_v), array_map('strtolower', $pro_modifier_value_name[$modifier_id]) ) )
										{
											$exist=true;
											$new_exist[]=array('new_main_id' => $mod_key);
										}

							}
						}
                    }
				}
				
			    if($exist == false)
			    {
				
				
				/*Update the modifier value start*/
				if( isset($pro_modifier_value_name) && !(empty($pro_modifier_value_name)) )
				{
				foreach($pro_modifier_value_name as $key=>$v)
				{
					$modifier_id=$key;
					foreach($pro_modifier_value_name[$key] as $k=>$v)
					{
						if($v!='')
						{
							
						 $modifier_value_name= addslashes($v);
						 $modifier_value_price= addslashes($pro_modifier_value_price[$key][$k]);
						 $modifier_value_sequence= addslashes($pro_modifier_value_sequence[$key][$k]);
						 $modifier_value_status= ( isset($pro_modifier_value_status[$key][$k]) && !empty($pro_modifier_value_status[$key][$k]) )?"A":"I";
						 $modifier_value_primary_id=$k;
						 $modifier_value_array=array('pro_modifier_value_name'=> $modifier_value_name,'pro_modifier_value_price'=>$modifier_value_price,'pro_modifier_value_sequence'=>$modifier_value_sequence,'pro_modifier_value_status'=>$modifier_value_status,'pro_modifier_value_updated_on'=>current_date(),'pro_modifier_value_updated_by'=>get_company_admin_id (),'pro_modifier_value_updated_ip'=>get_ip());
						 $this->Mydb->update('pos_product_modifier_values',array('pro_modifier_value_primary_id'=>$k,'pro_modifier_value_modifier_primary_id'=>$modifier_id),$modifier_value_array);
						}
					}
				}
			    }
				/*Update the modifier value end*/
                                
                                /*Insert the modifier start*/
				if(isset($new_pro_modifier_value_name) && !(empty($new_pro_modifier_value_name)))
				{
					$new_pro_modifier_value_name = array_unique( array_map('strtolower', $new_pro_modifier_value_name) );
					foreach($new_pro_modifier_value_name as $key=>$v)
					{
						
						if($v!='')
						{
							  $company_array = array('pro_modifier_value_company_id' => get_company_id(),'pro_modifier_value_app_id' => get_company_app_id());
							  $pro_modifier_value_id = get_guid('pos_product_modifier_values','pro_modifier_value_id',$company_array);
							  $modifier_value_name= addslashes($v);
							  $modifier_value_price= addslashes($new_pro_modifier_value_price[$key]);
							  $modifier_value_sequence= ((int)$new_pro_modifier_value_sequence[$key] == 0)?  get_sequence('pro_modifier_value_sequence','pos_product_modifier_values',$company_array) : $new_pro_modifier_value_sequence[$key]; 
							  $modifier_value_status= ( isset($new_pro_modifier_value_status[$key]) && !empty($new_pro_modifier_value_status[$key]) )?"A":"I";
							
							  $insert_array = array (
							  'pro_modifier_value_id' => $pro_modifier_value_id, 
							  'pro_modifier_value_company_id'=>get_company_id(),
							  'pro_modifier_value_app_id'=>get_company_app_id(),
							  'pro_modifier_value_modifier_primary_id'=> 0 ,
							  'pro_modifier_value_modifier_id' => '',
							  'pro_modifier_value_name' => $modifier_value_name,
							  'pro_modifier_value_price' => $modifier_value_price,
							  'pro_modifier_value_sequence' => $modifier_value_sequence,
							  'pro_modifier_value_status' => $modifier_value_status,
							  'pro_modifier_value_created_on' => current_date (),
							  'pro_modifier_value_created_by' => get_company_admin_id (),
							  'pro_modifier_value_created_ip' => get_ip () 
							   );
							  $insert_id=$this->Mydb->insert('pos_product_modifier_values',$insert_array );
                                                          if($insert_id)
							 {
								 $retun_page="first";
							 }
						 }
					}
				}
				/*Insert the modifier end*/
				
			
				}
				
				}
		$result=array('status'=>'ok','msg'=>sprintf ( $this->lang->line ( 'success_message_update' ), $this->module_labels ),'exist'=>$exist,'main_update_exist'=>$update_exist,'main_new_exist'=>$new_exist,'return_page'=>$retun_page,'error_main_lang'=>$this->lang->line('modifier_value_exist'));
		echo json_encode($result);
		
	}
	
	
	
	
	/* this function used to update default value */
	private function make_default($id=null)
	{
		if($id){
			
			$this->Mydb->update($this->table,array('pro_modifier_value_primary_id !=' => $id),array('pro_modifier_value_is_default' => 'No'));
			
		}
		
	}
	
	
	
		/* this method used to validate modifier uri */
	private function validate_modifier($modifier = null, $response = null) { 
		$modifier = decode_value ( $modifier );
		$result = $this->Mydb->get_record ( 'pro_modifier_primary_id,pro_modifier_id,pro_modifier_name', 'product_modifiers', array (
				'pro_modifier_primary_id' => $modifier 
		) );
		
		if (empty ( $result )) {
			/* show error message */
			if ($response == "html") {
				$this->session->set_flashdata ( 'admin_error', get_label ( 'something_wrong' ) );
				redirect ( camp_url () . $this->module );
			} else {
				
				$result ['status'] = 'error';
				$result ['message'] = get_label ( 'something_wrong' );
				echo json_encode ( $result );
				exit ();
			}
		} else {
			return $result;
		}
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
		
		$company_array = '';
		
		/* Delete */
		if ($postaction == 'Delete' && ! empty ( $ids )) {
			
		if (is_array ( $ids )) {
				
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_delete' ), $this->module_label );
			} else {

				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_delete' ), $this->module_label );
			}
		
			$ids = (is_array($ids))?  $ids : array($ids);
			
			/* delete product  modifiers details  tabel */
			/*$modifier_id = $this->Mydb->get_all_records_where_in('pro_modifier_value_id','product_modifier_values','pro_modifier_value_primary_id',$ids);
			if(!empty($modifier_id)){
				$modifier_ids = array_column($modifier_id, 'pro_modifier_value_id');
				$this->Mydb->delete_where_in('product_assigned_modifiers','assigned_mod_modifier_id',$modifier_ids);
			
			} */
			
			/*master table */
			$this->common->delete_unlink_image($this->lang->line('product_modifiervalues_image_folder_name'), "pro_modifier_value_image",$this->primary_key ,$this->table,$ids);
			$this->Mydb->delete_where_in($this->table,$this->primary_key,$ids,$company_array);
			
			
		
			
			
			$response ['status'] = 'success';
			$response ['action'] = $postaction;
		}
		
		/* Activation */
		if ($postaction == 'Activate' && ! empty ( $ids )) {
			$update_values = array (
					"pro_modifier_value_status" => 'A',
					"pro_modifier_value_updated_on" => current_date (),
					'pro_modifier_value_updated_by' => get_admin_id (),
					'pro_modifier_value_updated_ip' => get_ip ()
			);
				
			if (is_array ( $ids )) {
				$this->Mydb->update_where_in ( $this->table, $this->primary_key, $ids, $update_values, $company_array );
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_activate' ), $this->module_labels );
			} else {
		
				$this->Mydb->update_where_in ( $this->table, $this->primary_key, array (
						$ids
				), $update_values, $company_array );
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_activate' ), $this->module_label );
			}
				
			$response ['status'] = 'success';
			$response ['action'] = $postaction;
		}
		
		/* Deactivation */
		if ($postaction == 'Deactivate' && ! empty ( $ids )) {
			$update_values = array (
					"pro_modifier_value_status" => 'I',
					"pro_modifier_value_updated_on" => current_date (),
					'pro_modifier_value_updated_by' => get_admin_id (),
					'pro_modifier_value_updated_ip' => get_ip ()
			);
				
			if (is_array ( $ids )) {
				$this->Mydb->update_where_in ( $this->table, $this->primary_key, $ids, $update_values, $company_array );
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_deactivate' ), $this->module_labels );
			} else {
				$this->Mydb->update_where_in ( $this->table, $this->primary_key, array (
						$ids
				), $update_values, $company_array );
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_deactivate' ), $this->module_label );
			}
				
			$response ['status'] = 'success';
			$response ['action'] = $postaction;
		}
		
		
		/* Sequence  */
		if ($postaction == 'Sequence' && ! empty ( $ids )) {
			
			if(!empty($ids))
			{
				foreach($ids as $primary_id )
				{
					
					$post_sequence   = $this->input->post('sequence');
					$sequnce_value =  ( isset($post_sequence[$primary_id]))?  (int)$post_sequence[$primary_id] : 0; 
					if((int)$sequnce_value != 0 )	
					{
						$update_values = array(
								"pro_modifier_value_sequence" => $sequnce_value,
								"pro_modifier_value_updated_on" => current_date (),
								'pro_modifier_value_updated_by' => get_admin_id (),
								'pro_modifier_value_updated_ip' => get_ip ()	);
						$this->Mydb->update_where_in ( $this->table, $this->primary_key, array ($primary_id), $update_values, $company_array );
						$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_sequence' ), $this->module_labels );
					}
					
				}
			}
			
			$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_sequence' ), $this->module_labels );
		
			$response ['status'] = 'success';
			$response ['action'] = $postaction;
		}
		
	
		echo json_encode ( $response );
		exit ();
	}
	
	/* this method used to to check validate image file */
	public function validate_image() {
		if (isset ( $_FILES ['pro_modifier_value_image']['name'] ) && $_FILES ['pro_modifier_value_image']['name'] != "") {
			if ($this->common->valid_image ( $_FILES ['pro_modifier_value_image'] ) == "No") {
				$this->form_validation->set_message ( 'validate_image', get_label ( 'upload_valid_image' ) );
				return false;
			}
		}
	
		return true;
	}
	
	/* this method used check modifier value  or alredy exists or not */
	public function modifier_value_exists() {
		$name = $this->input->post ( 'pro_modifier_value_name' );
		$modifier = $this->input->post ( 'product_modifier' );
		$edit_id = $this->input->post ( 'edit_id' );
	
		$where = array (
				'pro_modifier_value_name' => trim ( $name )
		);
		if ($edit_id != "") {
			$where = array_merge ( $where, array (
					"pro_modifier_value_primary_id !=" => $edit_id
			) );
	
		}
		$where = array_merge(array('pro_modifier_value_modifier_primary_id' => $modifier),$where);
		$result = $this->Mydb->get_record ( 'pro_modifier_value_primary_id', $this->table, $where );
		if (! empty ( $result ) ) {
			$this->form_validation->set_message ( 'modifier_value_exists', get_label ( 'modifier_value_exist' ) );
			return false;
		} else {
			return true;
		}
	}
	
	
	/* this method used to clear all session values and reset search values */
	function refresh() {
		$this->session->unset_userdata ( $this->module . "_search_field" );
		$this->session->unset_userdata ( $this->module . "_search_value" );
		$this->session->unset_userdata ( $this->module . "_search_status" );
		$this->session->unset_userdata ( $this->module . "_search_category" );
		$this->session->unset_userdata ( $this->module . "_order_by_value" );
		$this->session->unset_userdata ( $this->module . "_order_by_value" );
		$this->session->unset_userdata ( $this->module . "_product_modifier" );
		redirect ( admin_url ().$this->module );
	}
	
	/* this method used to common module labels */
	private function load_module_info() {
		$data = array ();
		$data ['module_label'] = $this->module_label;
		$data ['module_labels'] = $this->module_labels;
		$data ['module'] = $this->module;
        $data ['module_save'] = "onpage";
		return $data;
	}
}
