<?php
/**************************
Project Name	: POS
Created on		: 3  March, 2016
Last Modified 	: 3 March, 2016
Description		: Page contains manage product modifiers

***************************/
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Modifiers extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		$this->module = "modifiers";
		$this->authentication->admin_authentication ();
		$this->module_label = get_label ( 'pro_modifier_label' );
		$this->module_labels = get_label ( 'pro_modifier_labels' );
		$this->folder = "product-modifiers/";
		$this->table = "product_modifiers";
		$this->primary_key = 'pro_modifier_primary_id';
		$this->load->helper ( 'products' );
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
		}
		
		if (get_session_value ( $this->module . "_search_field" ) != "" && get_session_value ( $this->module . "_search_value" ) != "") {
			$like = array (
					get_session_value ( $this->module . "_search_field" ) => get_session_value ( $this->module . "_search_value" ) 
			);
		}
		
		if (get_session_value ( $this->module . "_search_status" ) != "") {
			$where = array_merge ( $where, array (
					'pro_modifier_status' => get_session_value ( $this->module . "_search_status" ) 
			) );
		}
		
		/* apply sort by */
		if (get_session_value ( $this->module . "_order_by_field" ) != "" && get_session_value ( $this->module . "_order_by_value" ) != "") {
			
			$order_by = array (
					get_session_value ( $this->module . "_order_by_field" ) => (get_session_value ( $this->module . "_order_by_value" ) == "ASC") ? "ASC" : "DESC" 
			);
		}
		
		$totla_rows = $this->Mydb->get_num_rows ( $this->primary_key, $this->table, $where, null, null, null, $like );
		
		/* pagination part start */
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
		
		$select_array = array (
				'pro_modifier_primary_id ',
				'pro_modifier_name',
				'pro_modifier_status',
				'pro_modifier_sequence' 
		);
		$data ['records'] = $this->Mydb->get_all_records ( $select_array, $this->table, $where, $limit, $offset, $order_by, $like );
		$page_relod = ($totla_rows > 0 && $offset > 0 && empty ( $data ['records'] )) ? 'Yes' : 'No';
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
	public function add() {
		$data = $this->load_module_info ();
		
		/* form submit */
		if ($this->input->post ( 'action' ) == "Add") {
			check_ajax_request (); /* skip direct access */
			
			$this->form_validation->set_rules ( 'pro_modifier_name', 'lang:pro_modifier_name', 'required|callback_modifier_exists' );
			$this->form_validation->set_rules ( 'pro_modifier_min_select', 'lang:pro_modifier_min_select', 'required|numeric' );
			$this->form_validation->set_rules ( 'pro_modifier_max_select', 'lang:pro_modifier_max_select', 'required|numeric' );
			$this->form_validation->set_rules ( 'status', 'lang:status', 'required' );
			$this->form_validation->set_rules ( 'product_category', 'lang:product_category', 'required' );
			
			if ($this->form_validation->run () == TRUE) {
				
				$pro_modifier_id = get_guid ( $this->table, 'pro_modifier_id' );
				$pro_modifier_sequence = (( int ) $this->input->post ( 'pro_modifier_sequence' ) == 0) ? get_sequence ( 'pro_modifier_sequence', $this->table ) : $this->input->post ( 'pro_modifier_sequence' );
				
				$insert_array = array (
						'pro_modifier_name' => post_value ( 'pro_modifier_name' ),
						'pro_modifier_category_id' => post_value ( 'product_category' ),
						'pro_modifier_id' => $pro_modifier_id,
						'pro_modifier_status' => (post_value ( 'status' ) == "A" ? 'A' : 'I'),
						'pro_modifier_sequence' => $pro_modifier_sequence,
						'pro_modifier_min_select' => ((int)post_value('pro_modifier_min_select') == 0 ? 1 : post_value('pro_modifier_min_select')),
						'pro_modifier_max_select' => ((int)post_value('pro_modifier_max_select') == 0 ? 1 : post_value('pro_modifier_max_select')),
						'pro_modifier_created_on' => current_date (),
						'pro_modifier_created_by' => get_admin_id (),
						'pro_modifier_created_ip' => get_ip () 
				);
				
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
		$data ['module_action'] = 'add';
		$this->layout->display_admin ( $this->folder . $this->module . '-add', $data );
	}
	
	/* this method used to update record info.. */
	public function edit($edit_id = NULL) {
		$data = $this->load_module_info ();
		$id = addslashes ( decode_value ( $edit_id ) );
		$response = $image_arr = array ();
		$record = $this->Mydb->get_record ( '*', $this->table, array (
				$this->primary_key => $id
		) );
		

		
		if (empty ( $record )) {
			echo json_encode ( array (
					'status' => 'error',
					'msg' => get_label ( 'something_wrong' ) 
			) );
			exit ();
		}
		
		if ($this->input->post ( 'action' ) == "edit") {
			check_ajax_request (); /* skip direct access */
			
			$this->form_validation->set_rules ( 'pro_modifier_name', 'lang:pro_modifier_name', 'required|callback_modifier_exists' );
			$this->form_validation->set_rules ( 'pro_modifier_min_select', 'lang:pro_modifier_min_select', 'required|numeric' );
			$this->form_validation->set_rules ( 'pro_modifier_max_select', 'lang:pro_modifier_max_select', 'required|numeric' );
			$this->form_validation->set_rules ( 'status', 'lang:status', 'required' );
			$this->form_validation->set_rules ( 'product_category', 'lang:product_category', 'required' );

			if ($this->form_validation->run () == TRUE) {
				
				$pro_modifier_sequence = (( int ) $this->input->post ( 'pro_modifier_sequence' ) == 0) ? get_sequence ( 'pro_modifier_sequence', $this->table ) : $this->input->post ( 'pro_modifier_sequence' );
				
				$update_array = array (
						'pro_modifier_name' => post_value ( 'pro_modifier_name' ),
						'pro_modifier_category_id' => post_value ( 'product_category' ),
						'pro_modifier_status' => (post_value ( 'status' ) == "A" ? 'A' : 'I'),
						'pro_modifier_sequence' => $pro_modifier_sequence,
						'pro_modifier_min_select' => ((int)post_value('pro_modifier_min_select') == 0 ? 1 : post_value('pro_modifier_min_select')),
						'pro_modifier_max_select' => ((int)post_value('pro_modifier_max_select') == 0 ? 1 : post_value('pro_modifier_max_select')),
						'pro_modifier_updated_on' => current_date (),
						'pro_modifier_updated_by' => get_admin_id (),
						'pro_modifier_updated_ip' => get_ip () 
				);
				
				$this->Mydb->update ( $this->table, array (
						$this->primary_key => $record [$this->primary_key] 
				), $update_array );

				
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
		$data ['module_action'] = 'edit/' . encode_value ( $record [$this->primary_key] );
		$this->layout->display_admin ( $this->folder . $this->module . '-edit', $data );
	}
	/*On page edit function*/
	public function onpage()
	{
		$modifier_list=array();
		$update_exist=array();
		$new_exist=array();
		$modifier_update_exist=array();
		$new_modifier_exist=array();
		$exist=false;
		$retun_page="current";
		
		
		/* update modifier*/
		$pro_modifier_name=$this->input->post('pro_modifier_name');
		$pro_modifier_sequence=$this->input->post('sequence');
		
		/*check exist for the update modifier list*/
		if( isset($pro_modifier_name) && !empty($pro_modifier_name) )
		{
			foreach($pro_modifier_name as $key=>$v)
			{
					if(trim($v)!='')
					{
						 $modifier_name= addslashes(trim($v));
						 $modifier_primary_id=$key;
						 
						 $check_exist=$this->Mydb->get_record(array('pro_modifier_primary_id','pro_modifier_name'), $this->table, array("pro_modifier_company_id"=>get_company_id(),"pro_modifier_primary_id !=" => $modifier_primary_id,'pro_modifier_name' => trim ( $modifier_name )));	
						 if(!empty($check_exist))
						 {
                                                     
							if( isset($pro_modifier_name[$check_exist['pro_modifier_primary_id']]) && strtolower($pro_modifier_name[$check_exist['pro_modifier_primary_id']]) == strtolower($check_exist['pro_modifier_name']) )
							 {
								 $exist=true;
								 $modifier_update_exist[]=array('update_main_id' => $modifier_primary_id);
							 }
                                                        
						}
						
					}
			}
			
			if($exist == false)
			{
			  
			  /*in modifier update post value has been duplicate value means find the key*/ 	
			  $duplicates=array_unique( array_diff_assoc( array_map('strtolower', $pro_modifier_name), array_unique( array_map('strtolower', $pro_modifier_name) ) ) );
			  
			  if(!empty($duplicates))
			  {
				  $exist=true;
				  foreach($duplicates as $dk=>$dv)
				  {
					  $modifier_update_exist[]=array('update_main_id' => $dk);
				  }
				  
			  }
			  
			}
			
		 }
		/*update modfier false means allow*/
		if($exist == false)
		{
			
			/*modifier values*/
			$pro_modifier_value_name=$this->input->post('pro_modifier_value_name');
			$pro_modifier_value_price=$this->input->post('pro_modifier_value_price');
			$pro_modifier_value_sequence=$this->input->post('pro_modifier_value_sequence');
			$pro_modifier_value_status=$this->input->post('pro_modifier_value_status');
			
			
			/*check exist for the update modifier value list*/
			if(isset($pro_modifier_value_name) && !empty($pro_modifier_value_name) )
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
								 $update_exist[]=array('update_sub_id' => $k,'update_main_id' => $modifier_id);
							 }
							 
						 }
					}
				}
				
			}
		    }
			
			
			if($exist == false)
			{
				if(isset($pro_modifier_value_name) && !empty($pro_modifier_value_name) )
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
								 $update_exist[]=array('update_sub_id' => $k,'update_main_id' => $modifier_id);
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
			
			
			if(isset($new_pro_modifier_value_name) && !empty($new_pro_modifier_value_name) )
			{
				/*check exist for the new insert modifier list*/
				foreach($new_pro_modifier_value_name as $new_key=>$new_v)
				{
					$modifier_id=$new_key;
					$i=0;
					foreach($new_pro_modifier_value_name[$new_key] as $nk=>$nv)
					{
						if($nv!='')
						{
							 $modifier_value_name= addslashes($nv);
							 $check_exist=$this->Mydb->get_record(array('pro_modifier_value_primary_id','pro_modifier_value_name'), 'pos_product_modifier_values', array('pro_modifier_value_modifier_primary_id'=>$modifier_id,'pro_modifier_value_name' => trim ( $modifier_value_name )));	
							 if(!empty($check_exist))
							 {
								
								if( isset($pro_modifier_value_name[$modifier_id][$check_exist['pro_modifier_value_primary_id']]) && strtolower( $pro_modifier_value_name[$modifier_id][$check_exist['pro_modifier_value_primary_id']] )  == strtolower( stripslashes($check_exist['pro_modifier_value_name']) ) )
								{
									$exist=true;
									$new_exist[]=array('new_sub_id' => $nk,'new_main_id' => $modifier_id);
									
								}
								
							 }
							 $i++;
						}

					 }
				}
				
			}
			 
			if($exist == false)
			{
					
				$new_modifier_name=$this->input->post('new_modifier_name');
				$new_modifier_sequence=$this->input->post('new_sequence');
				$new_modifier_status=$this->input->post('new_modifier_status');
				
				if( isset($new_modifier_name)  && !empty($new_modifier_name) )
				{
					/*check exist for the new insert modifier list*/
					foreach($new_modifier_name as $mod_key=>$mod_v)
					{
						if($mod_v!='')
						{   
						   if( in_array( strtolower($mod_v), array_map('strtolower', $pro_modifier_name) ) )
							{
									$exist=true;
									$new_modifier_exist[]=array('new_main_id' => $mod_key);
							}
							 
						}
					}
					
				}
				
			    if($exist == false)
			    {
				
				/*Update the modifier start*/
				if(isset($pro_modifier_name) && !empty($pro_modifier_name) )
				{
					foreach($pro_modifier_name as $key=>$v)
					{
						if(trim($v)!='')
						{
							 $modifier_name= addslashes(trim($v));
							 $modifier_sequence= $pro_modifier_sequence[$key];
							 $modifier_primary_id=$key;
							 $modifier_array=array('pro_modifier_name'=> $modifier_name,'pro_modifier_sequence'=>$modifier_sequence,'pro_modifier_updated_on'=>current_date(),'pro_modifier_updated_by'=>get_company_admin_id (),'pro_modifier_updated_ip'=>get_ip());
							 $this->Mydb->update($this->table,array('pro_modifier_primary_id'=>$modifier_primary_id),$modifier_array);
						}
					}
				}
				/*Update the modifier end*/
				
				/*Insert the modifier start*/
				if(isset($new_modifier_name) && !empty($new_modifier_name) )
				{
					$new_modifier_name = array_unique( array_map('strtolower', $new_modifier_name) );
					foreach($new_modifier_name as $key=>$v)
					{
						if(trim($v)!='')
						{
							 $new_insert_modifier_name= addslashes(trim($v));
						     $new_insert_modifier_status= ( isset($new_modifier_status[$key]) && !empty($new_modifier_status[$key]) )?"A":"I";
							 $company_array = array('pro_modifier_company_id' => get_company_id(),'pro_modifier_app_id' => get_company_app_id());
							 $pro_modifier_id = get_guid($this->table,'pro_modifier_id',$company_array);
							 $new_modifier_array = array (
							    'pro_modifier_id'=>$pro_modifier_id,
								'pro_modifier_company_id'=>get_company_id(),
								'pro_modifier_app_id'=>get_company_app_id(),
								'pro_modifier_name' => $new_insert_modifier_name,
								'pro_modifier_sequence' => ((int)$new_modifier_sequence[$key] == 0)?  get_sequence('pro_modifier_sequence',$this->table,$company_array) : $new_modifier_sequence[$key],
								'pro_modifier_status' => $new_insert_modifier_status,
								'pro_modifier_max_select' => 1,
								'pro_modifier_min_select' => 1,
								'pro_modifier_created_on' => current_date (),
								'pro_modifier_created_by' => get_company_admin_id (),
								'pro_modifier_created_ip' => get_ip () 
							  );
							 $nm=$this->Mydb->insert($this->table,$new_modifier_array);
							 if($nm)
							 {
								 $retun_page="first";
							 }
						}
					}
				}
				/*Insert the modifier end*/
				
				/*Update the modifier value start*/
				if(isset($pro_modifier_value_name) && !empty($pro_modifier_value_name) )
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
				
				/*Insert the new modifier value start*/
				
				if(isset($new_pro_modifier_value_name) && !empty($new_pro_modifier_value_name) )
				{
				foreach($new_pro_modifier_value_name as $new_key=>$new_v)
				{
					$modifier_id=$new_key;
					$i=0;
					/*remove the duplicate values*/
					$new_pro_mod_val = array_unique( array_map('strtolower', $new_pro_modifier_value_name[$new_key]) );
					
					foreach($new_pro_mod_val as $nk=>$nv)
					{
						$modifier_value_list=array();
						if($nv!='')
						{
							  $company_array = array('pro_modifier_value_company_id' => get_company_id(),'pro_modifier_value_app_id' => get_company_app_id());
							  $pro_modifier_value_id = get_guid('pos_product_modifier_values','pro_modifier_value_id',$company_array);
							  $modifier_value_name= addslashes($nv);
							  $modifier_value_price= addslashes($new_pro_modifier_value_price[$new_key][$nk]);
							  $modifier_value_sequence= ((int)$new_pro_modifier_value_sequence[$new_key][$nk] == 0)?  get_sequence('pro_modifier_value_sequence','pos_product_modifier_values',array_merge($company_array,array('pro_modifier_value_modifier_primary_id' => $modifier_id))) : $new_pro_modifier_value_sequence[$new_key][$nk]; 
							  $modifier_value_status= ( isset($new_pro_modifier_value_status[$new_key][$nk]) && !empty($new_pro_modifier_value_status[$new_key][$nk]) )?"A":"I";
							
							  $insert_array = array (
								'pro_modifier_value_id' => $pro_modifier_value_id, 
								'pro_modifier_value_company_id'=>get_company_id(),
								'pro_modifier_value_app_id'=>get_company_app_id(),
								'pro_modifier_value_modifier_primary_id'=> $modifier_id ,
								'pro_modifier_value_modifier_id' => get_value('pos_product_modifiers','pro_modifier_id',array('pro_modifier_primary_id'=>$modifier_id) ),
								'pro_modifier_value_name' => $modifier_value_name,
								'pro_modifier_value_price' => $modifier_value_price,
								'pro_modifier_value_sequence' => $modifier_value_sequence,
								'pro_modifier_value_status' => $modifier_value_status,
								'pro_modifier_value_created_on' => current_date (),
								'pro_modifier_value_created_by' => get_company_admin_id (),
								'pro_modifier_value_created_ip' => get_ip () 
							  );
							  $insert_id=$this->Mydb->insert('pos_product_modifier_values',$insert_array );
						 }
						 $i++;
					}

				}
				}
				/*Insert the new modifier value end*/
				
				}
				
				}
			
			}
	    
	    }
	        
		$result=array('status'=>'ok','msg'=>sprintf ( $this->lang->line ( 'success_message_update' ), $this->module_labels ),'exist'=>$exist,'sub_update_exist'=>$update_exist,'sub_new_exist'=>$new_exist,'main_update_exist'=>$modifier_update_exist,'main_new_exist'=>$new_modifier_exist ,'return_page'=>$retun_page,'error_main_lang'=>$this->lang->line('modifier_exist'),'error_sub_lang'=>$this->lang->line('modifier_value_exist'));
		echo json_encode($result);
		
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
		if ($postaction == 'Delete' && ! empty ( $ids )) {
			
			$ids = (is_array ( $ids )) ? $ids : array (
					$ids 
			);
			/* check parent table entrys */
			$parent = $this->Mydb->find_parent_record ( 'pro_modifier_value_modifier_primary_id', 'product_modifier_values', '', 'pro_modifier_value_modifier_primary_id', $ids );
			//print_r($parent);
			//exit;
			if (! empty ( $parent )) {
				$response ['status'] = 'success';
				$parent_sts = (isset ( $parent ['parent'] )) ? $parent ['parent'] : '';
				$where_in = (isset ( $parent ['where_in'] )) ? $parent ['where_in'] : '';
				if ($parent_sts == "No" && ! empty ( $ids )) {
					$this->Mydb->delete_where_in ( $this->table, $this->primary_key, $ids,'' );
					$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_delete' ), $this->module_label );
				} elseif ($parent_sts == "Yes" && ! empty ( $where_in )) {
					$this->Mydb->delete_where_in ( $this->table, $this->primary_key, $where_in, $company_array );
					$response ['status'] = 'success';
					$response ['delete_warnig'] = 'Yes';
					$response ['msg'] = sprintf ( $this->lang->line ( 'error_delete_warning' ), get_label ( 'a_users_labels' ) );
				}
			} else {
				$response ['status'] = 'success';
				$response ['delete_warnig'] = 'Yes';
				$response ['msg'] = sprintf ( $this->lang->line ( 'error_delete_warning' ), get_label ( 'a_users_labels' ) );
			}
			
			$response ['action'] = $postaction;
		}
		
		/* Activation */
		if ($postaction == 'Activate' && ! empty ( $ids )) {
			$update_values = array (
					"pro_modifier_status" => 'A',
					"pro_modifier_updated_on" => current_date (),
					'pro_modifier_updated_by' => get_admin_id (),
					'pro_modifier_updated_ip' => get_ip () 
			);
			
			if (is_array ( $ids )) {
				$this->Mydb->update_where_in ( $this->table, $this->primary_key, $ids, $update_values,'' );
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_activate' ), $this->module_labels );
			} else {
				
				$this->Mydb->update_where_in ( $this->table, $this->primary_key, array (
						$ids 
				), $update_values,'' );
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_activate' ), $this->module_label );
			}
			
			$response ['status'] = 'success';
			$response ['action'] = $postaction;
		}
		
		/* Deactivation */
		if ($postaction == 'Deactivate' && ! empty ( $ids )) {
			$update_values = array (
					"pro_modifier_status" => 'I',
					"pro_modifier_updated_on" => current_date (),
					'pro_modifier_updated_by' => get_admin_id (),
					'pro_modifier_updated_ip' => get_ip () 
			);
			
			if (is_array ( $ids )) {
				$this->Mydb->update_where_in ( $this->table, $this->primary_key, $ids, $update_values, '' );
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_deactivate' ), $this->module_labels );
			} else {
				$this->Mydb->update_where_in ( $this->table, $this->primary_key, array (
						$ids 
				), $update_values, '' );
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_deactivate' ), $this->module_label );
			}
			
			$response ['status'] = 'success';
			$response ['action'] = $postaction;
		}
		
		/* Sequence */
		if ($postaction == 'Sequence' && ! empty ( $ids )) {
			
			if (! empty ( $ids )) {
				foreach ( $ids as $primary_id ) {
					
					$post_sequence = $this->input->post ( 'sequence' );
					$sequnce_value = (isset ( $post_sequence [$primary_id] )) ? ( int ) $post_sequence [$primary_id] : 0;
					if (( int ) $sequnce_value != 0) {
						$update_values = array (
								"pro_modifier_sequence" => $sequnce_value,
								"pro_modifier_updated_on" => current_date (),
								'pro_modifier_updated_by' => get_admin_id (),
								'pro_modifier_updated_ip' => get_ip () 
						);
						$this->Mydb->update_where_in ( $this->table, $this->primary_key, array (
								$primary_id 
						), $update_values, '' );
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
	
	/* this method used check modifier or alredy exists or not */
	public function modifier_exists() {
		$name = $this->input->post ( 'pro_modifier_name' );
		$pro_modifier_category_id = $this->input->post ( 'product_category' );
		$edit_id = $this->input->post ( 'edit_id' );
		
		$where = array (
				'pro_modifier_name' => trim ( $name ),
				'pro_modifier_category_id' => $pro_modifier_category_id
		);
		if ($edit_id != "") {
			$where = array_merge ( $where, array (
					"pro_modifier_primary_id !=" => $edit_id
			) );
		}
		$result = $this->Mydb->get_record ( 'pro_modifier_primary_id', $this->table, $where );
		if (! empty ( $result )) {
			$this->form_validation->set_message ( 'modifier_exists', get_label ( 'modifier_exist' ) );
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
		$this->session->unset_userdata ( $this->module . "_order_by_value" );
		$this->session->unset_userdata ( $this->module . "_order_by_value" );
		redirect ( admin_url () . $this->module );
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
