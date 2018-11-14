<?php
/**************************
Project Name	: POS
Created on		: 3  March, 2016
Last Modified 	: 12 Aug, 2016
Description		: Page contains manage product categories

***************************/
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Blogcategories extends CI_Controller {
	public function __construct() {
		
		parent::__construct ();
		$this->module = "blogcategories";
		
		$this->authentication->admin_authentication();
		$this->module_label = get_label ( 'pro_cate_label' );
		$this->module_labels = get_label ( 'pro_cate_labels' );
		$this->folder = "blogcategories/";
		$this->table = "blog_category";
		$this->menu_table = "menu_navigation";
		$this->primary_key = 'blog_cat_id';
		$this->load->library ( 'common' );
		//$this->load->helper ( 'products' );
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
		$table = $this->table;
		$where = array (
				"$this->primary_key !=" => '',
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
					'pro_cate_status' => get_session_value ( $this->module . "_search_status" )
			) );
		}
		
		/* apply sort by */
		if (get_session_value ( $this->module . "_order_by_field" ) != "" && get_session_value ( $this->module . "_order_by_value" ) != "") {
				
			$order_by = array (
					get_session_value ( $this->module . "_order_by_field" )  => (get_session_value ( $this->module . "_order_by_value" ) == "ASC")? "ASC" : "DESC"
			);
		}
		$join = "";
		
		
		$groupby = "blog_cat_id";	
		$select_array = array ('blog_cat_id ','blog_cat_name','blog_cat_status','blog_cat_sequence');				
		$totla_rows = $this->Mydb->get_num_join_rows( $this->primary_key, $table, $where, null, null, null, $like,$groupby,$join);
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
		
		
		$data ['records'] = $this->Mydb->get_all_records ( $select_array, $this->table, $where, $limit, $offset, $order_by, $like,$groupby, $join);
		//echo $this->db->last_query();
		//exit;
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
	public function add() {
		$data = $this->load_module_info ();
		/* form submit */
		if ($this->input->post ( 'action' ) == "Add") {
			check_ajax_request (); /* skip direct access */
			
			$this->form_validation->set_rules ( 'blog_cat_name', 'lang:blog_cat_name', 'required|callback_category_exists' );
			$this->form_validation->set_rules ( 'status', 'lang:status', 'required' );
			//$this->form_validation->set_rules ( 'pro_cate_image', 'lang:pro_cate_image', 'callback_validate_image' );

			if ($this->form_validation->run () == TRUE) {
				//$pro_cate_id = get_guid($this->table,'blog_cate_id');
				$pro_cate_slug  = make_slug($this->input->post('blog_cat_name'),$this->table,'blog_cat_slug');
			 	$pro_cate_sequence = ((int)$this->input->post('blog_cat_sequence') == 0)?  get_sequence('blog_cat_sequence',$this->table) : $this->input->post('blog_cat_sequence'); 
				
				/* upload image */
				
				
				$insert_array = array (
						'blog_cat_name' => post_value ( 'blog_cat_name' ),
						'blog_cat_slug'=>$pro_cate_slug,
						//'pro_cate_short_description' => post_value ( 'pro_cate_short_desc' ),
						'blog_cat_description' => post_value ( 'blog_cat_description' ),
						//'pro_cate_image' => $pro_cate_image,
						'blog_cat_status' => (post_value('status')=="A" ? 'A' : 'I'),
						'blog_cat_sequence' => $pro_cate_sequence,
						'blog_cat_created_on' => current_date (),
						'blog_cat_created_by' => get_admin_id (),
						'blog_cat_created_ip' => get_ip () 
				);
				
				$insert_id = $this->Mydb->insert ( $this->table, $insert_array );
				
				if ($insert_id != "") {
					/* custom menu adding */
					/*if($this->input->post('menu_navigation') == 'Yes' && post_value('custom_title') !='')
					{
						$com_array = array('menu_company_id' => get_company_id(),'menu_app_id' => get_company_app_id());
						$pro_cate_sequence = ((int)$this->input->post('pro_cate_sequence') == 0)?  get_sequence('menu_order',$this->menu_table,$com_array) : $this->input->post('pro_cate_sequence'); 
						$insert_menu=array('menu_app_id'=>get_company_app_id(),'menu_company_id'=>get_company_id(),'menu_type'=>'main','menu_category_id'=>$pro_cate_id,'menu_order'=>$pro_cate_sequence,'menu_custom_title'=>post_value('custom_title'),'menu_created_on'=>current_date (),'menu_created_by'=>get_company_admin_id(),'menu_created_ip'=>get_ip());
						$menu_id = $this->Mydb->insert ( $this->menu_table, $insert_menu );
					}*/
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
		$data ['module_action'] = 'add';
		$this->layout->display_admin ( $this->folder . $this->module . '-add', $data );
	}
	
	/* this method used to update record info.. */
	public function edit($edit_id = NULL) {
		$data = $this->load_module_info ();
		$id = addslashes ( decode_value ( $edit_id ) );
		
		$response =$image_arr = array ();
		$record = $this->Mydb->get_record ( '*', $this->table, array (
				$this->primary_key => $id 
		) );
		(empty ( $record )) ? redirect ( admin_url () . $this->module ) : '';
		
		/* check modifier enabled or not*/
		if ($this->input->post ( 'action' ) == "edit") {
			check_ajax_request (); /* skip direct access */
			$this->form_validation->set_rules ( 'blog_cat_name', 'lang:blog_cat_name', 'required|callback_category_exists' );
			$this->form_validation->set_rules ( 'status', 'lang:status', 'required' );
			//$this->form_validation->set_rules ( 'pro_cate_image', 'lang:pro_cate_image', 'callback_validate_image' );
			//$this->form_validation->set_rules ( 'custom_title', 'lang:menu_custom_title', 'trim' );

			
			if ($this->form_validation->run () == TRUE) {

				$pro_cate_slug  = make_slug($this->input->post('blog_cat_name'),$this->table,'blog_cat_slug',array($this->primary_key."!=" =>$record [$this->primary_key]));
				$pro_cate_sequence = ((int)$this->input->post('blog_cat_sequence') == 0)?  get_sequence('blog_cat_sequence',$this->table) : $this->input->post('blog_cat_sequence');
				
				$update_array = array (
						'blog_cat_name' => post_value ( 'blog_cat_name' ),
						//'pro_cate_slug'=>$pro_cate_slug,
						//'pro_cate_short_description' => post_value ( 'pro_cate_short_desc' ),
						'blog_cat_description' => post_value ( 'blog_cat_description' ),
						'blog_cat_status' => (post_value('status')=="A" ? 'A' : 'I'),
						'blog_cat_sequence' => $pro_cate_sequence,
						'blog_cat_updated_on' => current_date (),
						'blog_cat_updated_by' => get_admin_id (),
						'blog_cat_updated_ip' => get_ip () 
				);
				
				
				/* upload image and unlink old image */
				$image_arr = array();
				/*if (isset ( $_FILES ['pro_cate_image'] ['name'] ) && $_FILES ['pro_cate_image'] ['name'] != "") {
					$upload_image = $this->common->upload_image ( 'pro_cate_image', get_company_folder() . "/".$this->lang->line('product_category_image_folder_name') );
					$image_arr = array (
							'pro_cate_image' => $upload_image
					);
						
					$this->common->unlink_image($record['pro_cate_image'],get_company_folder(),$this->lang->line('product_category_image_folder_name')); 
				}
				elseif($this->input->post('remove_image')=="Yes") {
					$image_arr = array (
							'pro_cate_image' => ""
					);
				
					$this->common->unlink_image($record['pro_cate_image'],get_company_folder(),$this->lang->line('product_category_image_folder_name'));
				} */
				
				/* upload image and unlink old image */
				$image_icon_arr = array();
				/*if (isset ( $_FILES ['pro_cate_active_image'] ['name'] ) && $_FILES ['pro_cate_active_image'] ['name'] != "") {
						$upload_active_image = $this->common->upload_image ( 'pro_cate_active_image', get_company_folder() . "/".$this->lang->line('product_category_image_folder_name') );
						$image_icon_arr['pro_cate_active_image'] = $upload_active_image;

					$this->common->unlink_image($record['pro_cate_active_image'],get_company_folder(),$this->lang->line('product_category_image_folder_name')); 
				}
				elseif($this->input->post('remove_active_image')=="Yes") {
					$image_icon_arr['pro_cate_active_image'] = "";
					$this->common->unlink_image($record['pro_cate_active_image'],get_company_folder(),$this->lang->line('product_category_image_folder_name'));
				}
				
				if (isset ( $_FILES ['pro_cate_default_image'] ['name'] ) && $_FILES ['pro_cate_default_image'] ['name'] != "") {
						$upload_default_image = $this->common->upload_image ( 'pro_cate_default_image', get_company_folder() . "/".$this->lang->line('product_category_image_folder_name') );
						$image_icon_arr['pro_cate_default_image'] = $upload_default_image;

					$this->common->unlink_image($record['pro_cate_default_image'],get_company_folder(),$this->lang->line('product_category_image_folder_name')); 
				}
				elseif($this->input->post('remove_default_image')=="Yes") {
					$image_icon_arr['pro_cate_default_image'] = "";
					$this->common->unlink_image($record['pro_cate_default_image'],get_company_folder(),$this->lang->line('product_category_image_folder_name'));
				}*/
				$image_arr = array_merge($image_arr,$image_icon_arr);
				
				//$update_array = array_merge ( $update_array, $image_arr );
				$this->Mydb->update ( $this->table, array ($this->primary_key => $record [$this->primary_key] ), $update_array );
				
				/* saving the custom title in the menu navigation */
				/*if($this->input->post('menu_navigation') != 'Yes')
				{
					$this->Mydb->delete_where_in($this->menu_table,'menu_category_id',$record['pro_cate_id'],array('menu_company_id' => get_company_id(), 'menu_app_id' => get_company_app_id()));
			    }
			     else
			    {
					$check_array = array ('menu_custom_title');	
					$res_check = $this->Mydb->get_all_records ( $check_array, $this->menu_table,array('menu_app_id'=>get_company_app_id(),'menu_company_id'=>get_company_id(),'menu_type'=>'main','menu_category_id'=>$record['pro_cate_id']));
					
					if(empty($res_check))
					{
						$com_array = array('menu_company_id' => get_company_id(),'menu_app_id' => get_company_app_id());
						$pro_cate_sequence = ((int)$this->input->post('pro_cate_sequence') == 0)?  get_sequence('menu_order',$this->menu_table,$com_array) : $this->input->post('pro_cate_sequence');
						$insert_menu=array('menu_app_id'=>get_company_app_id(),'menu_company_id'=>get_company_id(),'menu_type'=>'main','menu_category_id'=>$record['pro_cate_id'],'menu_custom_title'=>post_value('custom_title'),'menu_order'=>$pro_cate_sequence,'menu_created_on'=>current_date (),'menu_created_by'=>get_company_admin_id(),'menu_created_ip'=>get_ip());
						$menu_id = $this->Mydb->insert ( $this->menu_table, $insert_menu );
					}
				}
			    if(post_value('custom_title') !='')
			    {
					$custom_array = array (
						'menu_custom_title' => post_value ( 'custom_title' ),						 
					);
					$this->Mydb->update ( $this->menu_table, array('menu_app_id'=>get_company_app_id(),'menu_company_id'=>get_company_id(),'menu_type'=>'main','menu_category_id'=>$record['pro_cate_id']), $custom_array );	
				}
				*/
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
		
		/* getting the menu custom title values */
		/*$custom_menus=$this->Mydb->get_record('*',$this->menu_table,array('menu_category_id'=>$record['pro_cate_id'],'menu_company_id' => get_company_id(), 'menu_app_id' => get_company_app_id()));
		$data['custom_menus']=$custom_menus;
		*/
		
		/* Common labels */
		$data ['breadcrumb'] = $data ['form_heading'] = get_label ( 'edit' ) . ' ' . $this->module_label;
		$data ['module_action'] = 'edit/' . encode_value ( $record [$this->primary_key] );
		$this->layout->display_admin ( $this->folder . $this->module . '-edit', $data );
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
		
			$ids = (is_array($ids))?  $ids : array($ids);
			/* check parent table entrys */
			/* $parent = $this->Mydb->find_parent_record('pro_subcate_category_primary_id','product_subcategories',array('pro_subcate_company_id'=>get_company_id(),'pro_subcate_app_id'=>get_company_app_id()),'pro_subcate_category_primary_id',$ids);

			if(!empty($parent))
			{ */
			 	 $response ['status'] = 'success';
			 	//$parent_sts = (isset($parent['parent'])) ? $parent['parent'] : '';
			 	//$where_in = (isset($parent['where_in'])) ? $parent['where_in'] : '';
			if(!empty($ids) )
			{
				/*  unlink  images */
				//$this->common->delete_unlink_image($this->lang->line('product_category_image_folder_name'), "pro_cate_image",$this->primary_key ,$this->table,$ids);
				$this->Mydb->delete_where_in($this->table,$this->primary_key,$ids);
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_delete' ), $this->module_label );
				 
			}
			 	  
			/*	 
			}else {
			 	$response ['status'] = 'success';
			 	$response ['delete_warnig'] = 'Yes';
			 	$response ['msg'] = sprintf ( $this->lang->line ( 'error_delete_warning' ), get_label('a_users_labels') );
			}
			 */
		
			$response ['action'] = $postaction;
		}
		
		/* Activation */
		if ($postaction == 'Activate' && ! empty ( $ids )) {
			$update_values = array (
					"blog_cat_status" => 'A',
					"blog_cat_updated_on" => current_date (),
					'blog_cat_updated_by' => get_admin_id (),
					'blog_cat_updated_ip' => get_ip ()
			);
				
			if (is_array ( $ids )) {
				$this->Mydb->update_where_in ( $this->table, $this->primary_key, $ids, $update_values);
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_activate' ), $this->module_labels );
			} else {
		
				$this->Mydb->update_where_in ( $this->table, $this->primary_key, array (
						$ids
				), $update_values);
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_activate' ), $this->module_label );
			}
				
			$response ['status'] = 'success';
			$response ['action'] = $postaction;
		}
		
		/* Deactivation */
		if ($postaction == 'Deactivate' && ! empty ( $ids )) {
			$update_values = array (
					"blog_cat_status" => 'I',
					"blog_cat_updated_on" => current_date (),
					'blog_cat_updated_by' => get_admin_id (),
					'blog_cat_updated_ip' => get_ip ()
			);
				
			if (is_array ( $ids )) {
				$this->Mydb->update_where_in ( $this->table, $this->primary_key, $ids, $update_values );
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_deactivate' ), $this->module_labels );
			} else {
				$this->Mydb->update_where_in ( $this->table, $this->primary_key, array (
						$ids
				), $update_values);
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
								"blog_cat_sequence" => $sequnce_value,
								"blog_cat_updated_on" => current_date (),
								'blog_cat_updated_by' => get_admin_id (),
								'blog_cat_updated_ip' => get_ip ()	);
						$this->Mydb->update_where_in ( $this->table, $this->primary_key, array ($primary_id), $update_values );
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
		if (isset ( $_FILES ['pro_cate_image'] ['name'] ) && $_FILES ['pro_cate_image'] ['name'] != "") {
			if ($this->common->valid_image ( $_FILES ['pro_cate_image'] ) == "No") {
				$this->form_validation->set_message ( 'validate_image', get_label ( 'upload_valid_image' ) );
				return false;
			}
		}
	
		return true;
	}
	
	/* this method used check category or alredy exists or not */
	public function category_exists() {
		$name = $this->input->post ( 'blog_cat_name' );
		$edit_id = $this->input->post ( 'edit_id' );
	
		$where = array (
				'blog_cat_name' => trim ( $name )
		);
		if ($edit_id != "") {
			$where = array_merge ( $where, array (
					"blog_cat_id !=" => $edit_id
			) );
				
		}
		$result = $this->Mydb->get_record ( 'blog_cat_id', $this->table, $where );
		if (! empty ( $result ) ) {
			$this->form_validation->set_message ( 'category_exists', get_label ( 'category_exist' ) );
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
		return $data;
	}
	
	
	
}
