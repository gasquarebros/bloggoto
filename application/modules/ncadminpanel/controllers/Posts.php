<?php
/**************************
Project Name	: POS
Created on		: 19 Feb, 2016
Last Modified 	: 25 Feb, 2016
Description		: Page contains company add edit and delete functions..

***************************/
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Posts extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		$this->authentication->admin_authentication ();
		$this->module = "posts";
		$this->module_label = get_label ( 'posts_module_label' );
		$this->module_labels = get_label ( 'posts_module_labels' );
		$this->folder = "posts/";
		$this->table = "posts";
		$this->blog_categorytable = "blog_category";
	    $this->load->library ( 'common' );
		$this->primary_key = 'post_id';
	}
	
	/* this method used to list all company . */
	public function index() {
		$data = $this->load_module_info ();
		$category = array(''=>'Select Category');
		$post_category = $this->Mydb->get_all_records('*',$this->blog_categorytable,array('blog_cat_status' => 'A'));
		if(!empty($post_category))
		{
			foreach($post_category as $blogcat)
			{
				$category[$blogcat['blog_cat_id']] = $blogcat['blog_cat_name'];
			}
		}
		$data['post_category'] = $category;
		$this->layout->display_admin ( $this->folder . $this->module . "-list", $data );
	}
	
	/* this method used list ajax listing... */
	function ajax_pagination($page = 0) {
		check_ajax_request (); /* skip direct access */
		$data = $this->load_module_info ();
		$like = array ();
		$order_by = array (
				$this->primary_key => 'DESC' 
		);
		$where = array();
		/* Search part start */
		
		if (post_value ( 'paging' ) == "") {
			$this->session->set_userdata ( $this->module . "_search_field", post_value ( 'search_field' ) );
			$this->session->set_userdata ( $this->module . "_search_category", post_value ( 'search_category' ) );
			$this->session->set_userdata ( $this->module . "_search_value", post_value ( 'search_value' ) );
			$this->session->set_userdata ( $this->module . "_order_by_field", post_value ( 'sort_field' ) );
			$this->session->set_userdata ( $this->module . "_order_by_value", post_value ( 'sort_value' ) );
		}
		
		if (get_session_value ( $this->module . "_search_field" ) != "" && get_session_value ( $this->module . "_search_value" ) != "") {
			$like = array (
					get_session_value ( $this->module . "_search_field" ) => get_session_value ( $this->module . "_search_value" ) 
			);
		}
		
		if (get_session_value ( $this->module . "_search_category" ) != "") {
			$where = array_merge ( $where, array (
					"post_category" => get_session_value ( $this->module . "_search_category" ) 
			));
		}
		
		/* add sort bu option */
		if (get_session_value ( $this->module . "_order_by_field" ) != "" && get_session_value ( $this->module . "_order_by_value" ) != "") {
						
			$order_by = array (
								get_session_value ( $this->module . "_order_by_field" )  => (get_session_value ( $this->module . "_order_by_value" ) == "ASC")? "ASC" : "DESC" 
						      );
		}
		
		$join = "";
		$join [0] ['select'] = "blog_cat_id,blog_cat_name";
		$join [0] ['table'] = $this->blog_categorytable;
		$join [0] ['condition'] = "post_category = blog_cat_id";
		$join [0] ['type'] = "LEFT";
		/* not in product availability id condition  */
		$groupby = "post_id";
	    $totla_rows = $this->Mydb->get_num_join_rows ( $this->primary_key, $this->table, $where, null, null, null, $like, $groupby, $join  );
		
		/*  pagination part start */
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
		/**
		 * * pagination part end **
		 */
		$select_array = array ('pos_posts.*');
		$data ['records'] = $this->Mydb->get_all_records ( $select_array, $this->table, $where, $limit, $offset, $order_by, $like, $groupby, $join );
	 	$page_relod = ($totla_rows  >  0 && $offset > 0 && empty($data ['records'])  )? 'Yes' : 'No'; 
		$html = get_template ( $this->folder . '/' . $this->module . '-ajax-list', $data );
		echo json_encode ( array (
				'status' => 'ok',
				'offset' => $offset,
				'html' => $html,
				'page_reload' => $page_relod 
		) );
		exit ();
	}
	
	/* this method used to view content...*/
	public function view($view_id) {
		
		$data = $this->load_module_info ();
		$data['result'] = $this->Mydb->get_record('*',$this->table,array($this->primary_key => decode_value($view_id)));

		$this->load->view($this->folder."/".$this->module."-view",$data);
		
	}
	
	/* this method used to add company . */
	public function add() { 

		$data = $this->load_module_info ();
		
		/* form submit */
		if ($this->input->post ( 'action' ) == "Add") {
			check_ajax_request (); /* skip direct access */
		

			$this->form_validation->set_rules('post_title','lang:post_title','required|trim|strip_tags');			
			$this->form_validation->set_rules('post_description','lang:post_description','required');
			$this->form_validation->set_rules('post_category','lang:post_category','required');
			$this->form_validation->set_rules('post_type','lang:post_type','required');
			
			if ($this->form_validation->run () == TRUE) {
				
				
				/* upload image */
				$post_photo = "";
				if (isset ( $_FILES ['post_photo'] ['name'] ) && $_FILES ['post_photo'] ['name'] != "") {
					$post_photo = $this->common->upload_image ( 'post_photo', get_company_folder() . "/".$this->lang->line('post_photo_folder_name') );
				}
				
				/* upload video */
				$post_video = "";
				$res = 0;
				if (isset ( $_FILES ['post_video'] ['name'] ) && $_FILES ['post_video'] ['name'] != "" && post_value ( 'post_type' ) == 'video') {
					$post_video = $this->common->upload_video ( 'post_video', get_company_folder() . "/".$this->lang->line('post_video_folder_name') );
					
					if($post_video['status'] == 'success')
					{
						$post_video = $post_video['message'];
					}
					else
					{
						$res = 1;
						$result ['status'] = 'error';
						$result ['message'] = $post_video['message'];
					}
				}
				
				if($res == 0)
				{
					$insert_array = array (
							'post_category' => post_value ( 'post_category' ),
							'post_type' => post_value ( 'post_type' ),
							'post_title' => post_value ( 'post_title' ),
							'post_description' => post_value ( 'post_description' ),
							'post_photo' => $post_photo,
							'post_video' => $post_video,
							'post_tags' => post_value ( 'post_tags' ),
							'post_status' => post_value ( 'status' ),
							'post_created_on' => current_date (),
							'post_by' => 'admin',
							'post_created_by' => get_admin_id (),
							'post_created_ip' => get_ip () 
					);
					$title=post_value('post_title');
					$insert_array['post_slug']=make_slug($title,$this->table,'post_slug');
					
					$insert_id = $this->Mydb->insert ( $this->table, $insert_array );
					$this->session->set_flashdata ( 'admin_success', sprintf ( $this->lang->line ( 'success_message_add' ), $this->module_label ) );
					$result ['status'] = 'success';
				}
				
			} else {
				$result ['status'] = 'error';
				$result ['message'] = validation_errors ();
			}
			
			echo json_encode ( $result );
			exit ();
		}
		
		$value =($this->input->post('post_description'))?$this->input->post('post_description'):'';
		$ck['post_description'] = $value;
		$data['editor']=$this->load->view($this->folder."/ckeditor",$ck,true);
		
		$category = array();
		$post_category = $this->Mydb->get_all_records('*',$this->blog_categorytable,array('blog_cat_status' => 'A'));
		if(!empty($post_category))
		{
			foreach($post_category as $blogcat)
			{
				$category[$blogcat['blog_cat_id']] = $blogcat['blog_cat_name'];
			}
		}
		$data['post_category'] = $category;
		/* Common labels */
		$data ['breadcrumb'] = $data ['form_heading'] = get_label ( 'add' ) . ' ' . $this->module_label;
		$data ['module_action'] = "add";
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
		
		if ($this->input->post ( 'action' ) == "edit") {
			check_ajax_request (); /* skip direct access */
			
			$this->form_validation->set_rules('post_title','lang:post_title','required|trim|strip_tags');			
			$this->form_validation->set_rules('post_description','lang:post_description','required');
			$this->form_validation->set_rules('post_category','lang:post_category','required');
			$this->form_validation->set_rules('post_type','lang:post_type','required');
			
			if ($this->form_validation->run () == TRUE) {
				$update_array = array (
					'post_category' => post_value ( 'post_category' ),
					'post_type' => post_value ( 'post_type' ),
					'post_slug' => make_slug(post_value('post_slug'),$this->table,'post_slug',array('post_id !=' => $id)),
					'post_title' => post_value ( 'post_title' ),
					'post_description' => post_value ( 'post_description' ),
					'post_tags' => post_value ( 'post_tags' ),
					'post_status' => post_value ( 'status' ),
					"post_updated_on" => current_date (),
					'post_updated_by' => get_admin_id (),
					'post_updated_ip' => get_ip () 
				);
				
				/* upload image and unlink ols image */
				$image_arr = array();
				if (isset ( $_FILES ['post_photo'] ['name'] ) && $_FILES ['post_photo'] ['name'] != "") {
					$upload_image = $this->common->upload_image ( 'post_photo', get_company_folder() . "/".$this->lang->line('post_photo_folder_name') );
					$image_arr = array (
							'post_photo' => $upload_image
					);
						
					$this->common->unlink_image($record['post_photo'],get_company_folder(),$this->lang->line('post_photo_folder_name')); /* unlink image..  */
				}
				elseif($this->input->post('remove_image')=="Yes") {
					$image_arr = array (
							'post_photo' => ""
					);
				
					$this->common->unlink_image($record['post_photo'],get_company_folder(),$this->lang->line('post_photo_folder_name'));
				}
				
				/* upload image and unlink ols image */
				$video_arr = array();
				if (isset ( $_FILES ['post_video'] ['name'] ) && $_FILES ['post_video'] ['name'] != "" && post_value ( 'post_type' ) == 'video') {

					$upload_video = $this->common->upload_video ( 'post_video', get_company_folder() . "/".$this->lang->line('post_video_folder_name') );
					if($upload_video == 'success')
					{
						$video_arr = array (
							'post_video' => $upload_video['message']
						);
					}

					$this->common->unlink_image($record['post_video'],get_company_folder(),$this->lang->line('post_video_folder_name')); /* unlink image..  */
				}
				elseif($this->input->post('remove_video')=="Yes") {
					$video_arr = array (
							'post_video' => ""
					);
					$this->common->unlink_image($record['post_video'],get_company_folder(),$this->lang->line('post_video_folder_name'));
				}
				

				$image_arr = array_merge ( $image_arr, $video_arr );
				
				
				$update_array = array_merge ( $update_array, $image_arr );
				
				$this->Mydb->update ( $this->table, array ($this->primary_key => $record ['post_id'] ), $update_array );
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
		
		$value =($record['post_description'])?$record['post_description']:'';
		$ck['post_description'] = $value;
		$data['editor']=$this->load->view($this->folder."/ckeditor",$ck,true);
		
		
		$category = array();
		$post_category = $this->Mydb->get_all_records('*',$this->blog_categorytable,array('blog_cat_status' => 'A'));
		if(!empty($post_category))
		{
			foreach($post_category as $blogcat)
			{
				$category[$blogcat['blog_cat_id']] = $blogcat['blog_cat_name'];
			}
		}
		$data['post_category'] = $category;
		/* Common labels */
		$data ['breadcrumb'] = $data ['form_heading'] = get_label ( 'edit' ) . ' ' . $this->module_label;
		$data ['module_action'] = 'edit/' . encode_value ( $record [$this->primary_key] );
		$this->layout->display_admin ( $this->folder . $this->module . '-edit', $data );
	}
	
	/* this method used update multible actions */
	function action() {
		$ids = ($this->input->post ( 'multiaction' ) == 'Yes' ? $this->input->post ( 'id' ) : decode_value ( $this->input->post ( 'changeId' ) ));
		
		$ids = ($this->input->post ( 'changeId' ) != '') ? decode_value ( $this->input->post ( 'changeId' ) ) : $this->input->post ( 'id' );
		$postaction = $this->input->post ( 'postaction' );
		
		$response = array (
				'status' => 'error',
				'msg' => get_label ( 'something_wrong' ),
				'action' => '',
				'multiaction' => $this->input->post ( 'multiaction' ) 
		);
		
		/* Delete */
		if ($postaction == 'Delete' && ! empty ( $ids )) {
			// $this->Mydb->delete_where_in($this->table,'email_id',$ids,'');
			
			if (is_array ( $ids )) {
			} else {
				$this->Mydb->delete ( $this->table, array ($this->primary_key => $ids ));
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_delete' ), $this->module_label );
				
				// $this->Mydb->delete($this->table,'email_id',$ids,'');
			}
			$response ['status'] = 'success';
			$response ['action'] = $postaction;
		}
		
		
		/* Activation */
		if ($postaction == 'Activate' && ! empty ( $ids )) 
		{
			$update_values = array (
					"post_status" => 'A',
					"post_updated_on" => current_date (),
					'post_updated_by' => get_admin_id (),
					'post_updated_ip' => get_ip () 
			);
			
			if (is_array ( $ids )) {
				$this->Mydb->update_where_in ( $this->table, $this->primary_key, $ids, $update_values );
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_activate' ), $this->module_labels );
			} else {
				
				$this->Mydb->update_where_in ( $this->table, $this->primary_key, array (
						$ids 
				), $update_values );
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_activate' ), $this->module_label );
			}
			
			$response ['status'] = 'success';
			$response ['action'] = $postaction;
		}
		
		/* Deactivation */
		if ($postaction == 'Deactivate' && ! empty ( $ids )) 
		{
			$update_values = array (
					"post_status" => 'I',
					"post_updated_on" => current_date (),
					'post_updated_by' => get_admin_id (),
					'post_updated_ip' => get_ip () 
			);
			
			if (is_array ( $ids )) {
				$this->Mydb->update_where_in ( $this->table, $this->primary_key, $ids, $update_values);
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_deactivate' ), $this->module_labels );
			} else {
				$this->Mydb->update_where_in ( $this->table, $this->primary_key, array (
						$ids 
				), $update_values );
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_deactivate' ), $this->module_label );
			}
			
			$response ['status'] = 'success';
			$response ['action'] = $postaction;
		}
		
		
		/* Draft */
		if ($postaction == 'Draft' && ! empty ( $ids )) 
		{
			$update_values = array (
					"post_status" => 'D',
					"post_updated_on" => current_date (),
					'post_updated_by' => get_admin_id (),
					'post_updated_ip' => get_ip () 
			);
			
			if (is_array ( $ids )) {
				$this->Mydb->update_where_in ( $this->table, $this->primary_key, $ids, $update_values);
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_draft' ), $this->module_labels );
			} else {
				$this->Mydb->update_where_in ( $this->table, $this->primary_key, array (
						$ids 
				), $update_values );
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_deactivate' ), $this->module_label );
			}
			
			$response ['status'] = 'success';
			$response ['action'] = $postaction;
		}
		echo json_encode ( $response );
		exit ();
	}
	
	
	
   /* this method used to clear all session values and reset search values */
	function refresh() {
		$this->session->unset_userdata ( $this->module . "_search_field" );
		$this->session->unset_userdata ( $this->module . "_search_value" );
		$this->session->unset_userdata ( $this->module . "_search_status" );
		$this->session->unset_userdata ( $this->module . "_order_by_value" );
		$this->session->unset_userdata ( $this->module . "_search_category" );
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
