<?php
/**************************
Project Name	: BlogGotoWeb
Created on		: 27 Nov, 2017
Last Modified 	: 27 Nov, 2017
Description		: Page contains frontend panel login and forgot password functions.

***************************/
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Home extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		//$this->authentication->user_authentication();
		$this->module = "home";
		$this->module_label = get_label('home_module_label');
		$this->module_labels = get_label('home_module_label');
		$this->folder = "home/";
		$this->table = "posts";
		$this->page_table = "cmspage";
		$this->blog_categorytable = "blog_category";
		$this->customers = "customers";
		$this->customers_followers = "customers_followers";
		$this->post_likes = "post_likes";
		$this->post_tags = "post_tags";
		$this->post_comments = "post_comments";
		$this->primary_key='post_id';
		$this->load->library('common');
	}
	
	/* this method used to check login */
	public function index() {
		
		//echo "inn"; exit;
		$data = $this->load_module_info ();	
		$post_category = $this->Mydb->get_all_records('*',$this->blog_categorytable,array('blog_cat_status' => 'A'));
		if(!empty($post_category))
		{
			foreach($post_category as $blogcat)
			{
				$category[$blogcat['blog_cat_id']] = $blogcat['blog_cat_name'];
			}
		}
		$data['post_category'] = $category;
		$this->layout->display_site ( $this->folder . $this->module . "-list", $data );
	}
	
	public function ajax_pagination()
	{
		check_site_ajax_request();
		$data = $this->load_module_info ();
		$like = array ();
		
		$order_by = array (
				$this->primary_key => 'DESC' 
		);
		$where = array('post_status'=>'A');
		/* Search part start */
		
		if (post_value ( 'paging' ) == "") {
			$search_field = post_value ( 'search_field' );
			$type = post_value ( 'type' );
			$order_field = post_value ( 'order_field' );
		}
		
		/*
		if ($search_field !='') {
			$like = array (
					get_session_value ( $this->module . "_search_field" ) => $search_field 
			);
		}*/
		
		if ($search_field != "") {
			$where = array_merge ( $where, array (
					"post_category" => $search_field 
			));
		}
		
		if ($type != "") {
			$where = array_merge ( $where, array (
					"post_type" => $type 
			));
		}
		
		/* add sort bu option */
		if ($order_field != "") {
			if($order_field == 'followers' && get_user_id () !='')
			{
				$cwhere = array("follow_customer_id"=>get_user_id ());
				$followers_customer_ids = $this->Mydb->get_all_records ( 'follow_user_id', $this->customers_followers, $cwhere);
				
				$followers = array();
				if(!empty($followers_customer_ids))
				{
					foreach($followers_customer_ids as $followers_customer_id)
					{
						$followers[] = $followers_customer_id['follow_user_id'];
					}
				}
				if(!empty($followers)) {
					$where = array_merge ( $where, array (
						"pos_posts.post_created_by in (".implode(',',$followers).") and pos_posts.post_by = 'customer'" => NULL 
					));
				}
			}
			else{
				$order_by = array (
					'post_likes' => 'DESC' 
				);
			}
			
			
			
		}
		
		$join = array();
		$join [0] ['select'] = "blog_cat_id,blog_cat_name";
		$join [0] ['table'] = $this->blog_categorytable;
		$join [0] ['condition'] = "post_category = blog_cat_id";
		$join [0] ['type'] = "LEFT";
		
		$join [1] ['select'] = "customer_id,customer_first_name,customer_last_name,customer_email";
		$join [1] ['table'] = $this->customers;
		$join [1] ['condition'] = "post_created_by = customer_id and post_by !='admin'";
		$join [1] ['type'] = "LEFT";
		
		$join [2] ['select'] = "group_concat(',',post_tag_user_id) as post_tag_ids,group_concat(',',post_tag_user_name) as post_tag_names";
		$join [2] ['table'] = $this->post_tags;
		$join [2] ['condition'] = "post_tag_post_id = post_id";
		$join [2] ['type'] = "LEFT";
		/* not in product availability id condition  */
		$groupby = "post_id";
	    $totla_rows = $this->Mydb->get_num_join_rows ( $this->primary_key, $this->table, $where, null, null, null, $like, $groupby, $join  );
		
		
		$limit = 12;
		$page = post_value ( 'page' )?$post_value ( 'page' ):1;
		$offset = post_value ( 'page' )?((post_value ( 'page' )-1) * $limit):0;
		$offset = post_value ( 'offset' )?post_value ( 'offset' ):$offset;
		$next_offset = $offset+$limit;
		$next_set = ($totla_rows > $next_offset)?($offset+$limit):'';
		
		
		
		$data['offset'] = $offset;
		$select_array = array ('pos_posts.*');
		$data ['records'] = $this->Mydb->get_all_records ( $select_array, $this->table, $where, $limit, $offset, $order_by, $like, $groupby, $join );
		//echo $this->db->last_query();
		//exit;
		$html = get_template ( $this->folder . '/' . $this->module . '-ajax-list', $data );
		echo json_encode ( array (
				'status' => 'ok',
				'offset' => $offset,
				'next_set' => $next_set,
				'html' => $html,
		) );
		exit ();
	}
	
	public function addpost()
	{
		check_site_ajax_request();
		$this->authentication->user_authentication();
		$data = $this->load_module_info ();
		if ($this->input->post ( 'action' ) == "Add") {
			$this->form_validation->set_rules('post_title','lang:post_title','required|trim|strip_tags');			
			$this->form_validation->set_rules('post_description','lang:post_description','required');
			$this->form_validation->set_rules('post_category','lang:post_category','required');
			$this->form_validation->set_rules('post_type','lang:post_type','required');
			
			if ($this->form_validation->run () == TRUE) {
				
				/* upload image */
				$post_photo = "";
				if (isset ( $_FILES ['post_photo'] ['name'] ) && $_FILES ['post_photo'] ['name'] != "") {
					$post_photo = $this->common->upload_image ( 'post_photo', $this->lang->line('post_photo_folder_name') );
				}
				
				/* upload video */
				$post_video = "";
				$res = 0;
				if (isset ( $_FILES ['post_video'] ['name'] ) && $_FILES ['post_video'] ['name'] != "" && post_value ( 'post_type' ) == 'video') {
					$post_video = $this->common->upload_video ( 'post_video',$this->lang->line('post_video_folder_name') );
					
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
					$category = array();
					$post_category = $this->Mydb->get_all_records('*',$this->blog_categorytable,array('blog_cat_status' => 'A'));
					if(!empty($post_category))
					{
						foreach($post_category as $blogcat)
						{
							$category[$blogcat['blog_cat_name']] = $blogcat['blog_cat_id'];
						}
					}

					$insert_array = array (
							'post_category' => $category[post_value ( 'post_category' )],
							'post_type' => post_value ( 'post_type' ),
							'post_title' => post_value ( 'post_title' ),
							'post_description' => post_value ( 'post_description' ),
							'post_photo' => $post_photo,
							'post_video' => $post_video,
							//'post_tags' => post_value ( 'post_tags' ),
							'post_status' => (post_value('status'))?post_value('status'):'A',
							'post_created_on' => current_date (),
							'post_by' => 'customer',
							'post_created_by' => get_user_id (),
							'post_created_ip' => get_ip () 
					);
					$title=post_value('post_title');
					$insert_array['post_slug']=make_slug($title,$this->table,'post_slug');
					
					$insert_id = $this->Mydb->insert ( $this->table, $insert_array );
					if($insert_id)
					{
						$message='Add post';
						#insert post notification
							$record = array(
								'notification_post_id'=>$insert_id,
								'notification_type'=>'post',
								'created_type'=>'E',
								'message_type'=>'N',
								'subject'=>$message,
								'message'=>$message,
								'private'=>0,
								'created_by'=>get_user_id(),
								'created_on'=>current_date(),				
								'ip_address'=>get_ip(),
								);
							post_notify($record);
						#insert post notification						
						if(!empty($this->input->post('post_tags')))
						{
							$post_tags = $this->input->post('post_tags');

							$batch_insert = array();
							foreach($post_tags as $post_tag)
							{
								if(!empty($post_tag)) {
									$exploded = explode('__',$post_tag);
									$batch_insert[] = array(
										'post_tag_post_id'=>$insert_id,
										'post_tag_user_id'=>decode_value($exploded[0]),
										'post_tag_user_name'=>$exploded[1],
										'post_tag_created_on'=>current_date (),
										'post_created_by'=>get_user_id ()
									);
								}
							}
							if(!empty($batch_insert)) {
								$this->db->insert_batch('post_tags',$batch_insert);
							}
						}
					}
					$this->session->set_flashdata ( 'admin_success', sprintf ( $this->lang->line ( 'success_message_add' ), $this->module_label ) );
					$result ['status'] = 'success';
				}
				
				
			}
			else {
				$result ['status'] = 'error';
				$result ['message'] = validation_errors ();
			}
			
			echo json_encode ( $result );
			exit ();
		}
	}
	
	
	public function savedraftpost()
	{
		check_site_ajax_request();
		$this->authentication->user_authentication();
		$data = $this->load_module_info ();
		if ($this->input->post ( 'action' ) == "Add") {
			$this->form_validation->set_rules('post_title','lang:post_title','required|trim|strip_tags');			
			$this->form_validation->set_rules('post_description','lang:post_description','required');
			//$this->form_validation->set_rules('post_category','lang:post_category','required');
			//$this->form_validation->set_rules('post_type','lang:post_type','required');
			$this->form_validation->set_rules('record_id','lang:record_id','required');
			
			if ($this->form_validation->run () == TRUE) {
				
				
				$record_id = decode_value(post_value('record_id'));
				
				$record = $this->Mydb->get_record ( '*', $this->table, array ($this->primary_key => $record_id ) );
				
				
				/* upload image */

				$post_photo = $record['post_photo'];

				if (isset ( $_FILES ['post_photo'] ['name'] ) && $_FILES ['post_photo'] ['name'] != "") {
					$post_photo = $this->common->upload_image ( 'post_photo', $this->lang->line('post_photo_folder_name') );
				}
				
				/* upload video */
				$post_video = $record['post_video'];
				$post_type = $record['post_type'];
				$res = 0;
				if (isset ( $_FILES ['post_video'] ['name'] ) && $_FILES ['post_video'] ['name'] != "" && $post_type == 'video') {
					$post_video = $this->common->upload_video ( 'post_video',$this->lang->line('post_video_folder_name') );
					
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
					$category = array();
					$post_category = $this->Mydb->get_all_records('*',$this->blog_categorytable,array('blog_cat_status' => 'A'));
					if(!empty($post_category))
					{
						foreach($post_category as $blogcat)
						{
							$category[$blogcat['blog_cat_name']] = $blogcat['blog_cat_id'];
						}
					}

					$update_array = array (
							//'post_category' => $category[post_value ( 'post_category' )],
							//'post_type' => post_value ( 'post_type' ),
							'post_title' => post_value ( 'post_title' ),
							'post_description' => post_value ( 'post_description' ),
							'post_photo' => $post_photo,
							'post_video' => $post_video,
							//'post_tags' => post_value ( 'post_tags' ),
							'post_status' => (post_value('status'))?post_value('status'):'A',
							'post_created_on' => current_date (),
							'post_by' => 'customer',
							'post_created_by' => get_user_id (),
							'post_created_ip' => get_ip () 
					);
					
					$title=post_value('post_title');
					$update_array['post_slug']= make_slug($title,$this->table,'post_slug',array('post_id !=' => $record_id));
					
					$this->Mydb->update ( $this->table, array ($this->primary_key =>  $record_id), $update_array );
					
					if($record_id)
					{
						$this->Mydb->delete ( 'post_tags', array ('post_tag_post_id' => $record_id ));
						if(!empty($this->input->post('post_tags')))
						{
							$post_tags = $this->input->post('post_tags');

							$batch_insert = array();
							foreach($post_tags as $post_tag)
							{
								if(!empty($post_tag)) {
									$exploded = explode('__',$post_tag);
									$batch_insert[] = array(
										'post_tag_post_id'=>$insert_id,
										'post_tag_user_id'=>decode_value($exploded[0]),
										'post_tag_user_name'=>$exploded[1],
										'post_tag_created_on'=>current_date (),
										'post_created_by'=>get_user_id ()
									);
								}
							}
							if(!empty($batch_insert)) {
								$this->db->insert_batch('post_tags',$batch_insert);
							}
						}
					}
					$this->session->set_flashdata ( 'admin_success', sprintf ( $this->lang->line ( 'success_message_add' ), $this->module_label ) );
					$result ['status'] = 'success';
				}
			}
			else {
				$result ['status'] = 'error';
				$result ['message'] = validation_errors ();
			}
			
			echo json_encode ( $result );
			exit ();
		}
	}
	
	
	public function view($slug=null,$notify_id=null,$notify_status=null)
	{
		if($notify_id != '' && decode_value($notify_status)=='N')
		{
		        $notification_id = decode_value($notify_id);
    			$record = array('open_status'=>'Y');
				$this->Mydb->update('post_notification',array('post_notification_id'=>$notification_id, 'open_status'=>'N'),$record);
		}
		if($slug !='')
		{
			$data = $this->load_module_info ();
			$where = "post_slug = '".$slug."'";
			$like = array ();
			
			$order_by = array (
					$this->primary_key => 'DESC' 
			);
			$join = "";
			$join [0] ['select'] = "blog_cat_id,blog_cat_name";
			$join [0] ['table'] = $this->blog_categorytable;
			$join [0] ['condition'] = "post_category = blog_cat_id";
			$join [0] ['type'] = "LEFT";
			
			$join [1] ['select'] = "customer_id,customer_first_name,customer_last_name,customer_email,customer_photo";
			$join [1] ['table'] = $this->customers;
			$join [1] ['condition'] = "post_created_by = customer_id and post_by !='admin'";
			$join [1] ['type'] = "LEFT";
			
			$join [2] ['select'] = "(select count(post_like_id) as postcount from pos_".$this->post_likes." pplikes where pplikes.post_like_post_id = pos_".$this->table.".post_id) as postcount,group_concat(',',post_like_user_id) as lkesuser";
			$join [2] ['table'] = $this->post_likes;
			$join [2] ['condition'] = "post_id = post_like_post_id";
			$join [2] ['type'] = "LEFT";
			
			$join [3] ['select'] = "(select count(post_comment_id) as commentcount from pos_".$this->post_comments." ppcomments where ppcomments.post_comment_post_id = pos_".$this->table.".post_id) as commentcount";
			$join [3] ['table'] = $this->post_comments;
			$join [3] ['condition'] = "post_id = post_comment_post_id";
			$join [3] ['type'] = "LEFT";
			
			$join [4] ['select'] = "group_concat(',',post_tag_user_name) as post_tag_names, group_concat(',',post_tag_user_id) as post_tag_ids";
			$join [4] ['table'] = $this->post_tags;
			$join [4] ['condition'] = "post_id = post_tag_post_id";
			$join [4] ['type'] = "LEFT";
			
			$groupby = "post_id";

			$select_array = array ('pos_posts.*');
			$records = $this->Mydb->get_all_records ( $select_array, $this->table, $where, '', '', $order_by, $like, $groupby, $join );
			$data ['records'] = $records;
			$this->layout->display_site ( $this->folder . $this->module . "-view", $data );
		}
		else
		{
			
		}
	}
	
	public function draftpost()
	{
		$this->authentication->user_authentication();
		$data = $this->load_module_info ();
		$where = "post_by = 'customer' AND pos_posts.post_created_by = ".get_user_id()." AND post_status = 'D'";
		$like = array ();
		
		$order_by = array (
				$this->primary_key => 'DESC' 
		);
		$join = "";
		$join [0] ['select'] = "blog_cat_id,blog_cat_name";
		$join [0] ['table'] = $this->blog_categorytable;
		$join [0] ['condition'] = "post_category = blog_cat_id";
		$join [0] ['type'] = "LEFT";
		
		$join [1] ['select'] = "customer_id,customer_first_name,customer_last_name,customer_email";
		$join [1] ['table'] = $this->customers;
		$join [1] ['condition'] = "post_created_by = customer_id and post_by !='admin'";
		$join [1] ['type'] = "LEFT";
		
		$join [2] ['select'] = "group_concat(',',post_tag_user_id) as post_tag_ids,group_concat(',',post_tag_user_name) as post_tag_names";
		$join [2] ['table'] = $this->post_tags;
		$join [2] ['condition'] = "post_tag_post_id = post_id";
		$join [2] ['type'] = "LEFT";
		
		$groupby = "post_id";

		$select_array = array ('pos_posts.*');
		$data ['records'] = $this->Mydb->get_all_records ( $select_array, $this->table, $where, '', '', $order_by, $like, $groupby, $join );

		$this->layout->display_site ( $this->folder . $this->module . "-draft", $data );
	}
	
	public function page($segment='',$page = 0)
	{
		$data = $this->load_module_info ();
		if($segment !='')
		{
			$where = "cmspage_slug = '".$segment."'";
			$data ['records'] = $this->Mydb->get_record ( '*', $this->page_table, $where);
			if(!empty($data ['records']))
			{
				$this->layout->display_site ( $this->folder . $this->module . "-page", $data );
			}
			else
			{
				$this->layout->display_site ( $this->folder . $this->module . "-404", $data );
			}
		}
		else
		{
			$this->layout->display_site ( $this->folder . $this->module . "-404", $data );
		}
	}
	public function ajax_autocomplete()
	{
		$select_array = array ('pos_posts.*');
		$where=$offset=$limit=$order_by=$like=$groupby=$join=array();
		$records = $this->Mydb->get_all_records ( '*', $this->table, $where, $limit, $offset, $order_by, $like, $groupby, $join );
		if(!empty($records))
		{
			foreach($records as $key=>$record)
			{
				$result ['redirecturl'] = $record['post_slug'];
				$result ['label'] = $record['post_slug'];//post_slug
				$result ['value'] = $record['post_title'];
				$result ['status'] = 'success';
				$result ['message'] = 'success';				
			}
		}
		else
		{
			$result ['status'] = 'error';
			$result ['message'] = '';
		}
		
		echo json_encode ( $result );
		exit ();
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
