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
		$this->authentication->already_login_check();
		$this->module = "home";
		$this->module_label = get_label('home_module_label');
		$this->module_labels = get_label('home_module_label');
		$this->post_module_label = get_label('post_module_label');
		$this->post_module_labels = get_label('post_module_label');		
		$this->folder = "home/";
		$this->table = "posts";
		$this->page_table = "cmspage";
		$this->blog_categorytable = "blog_category";
		$this->customers = "customers";
		$this->customers_followers = "customers_followers";
		$this->post_likes = "post_likes";
		$this->post_favor = "post_favor";
		$this->post_tags = "post_tags";
		$this->post_comments = "post_comments";
		$this->primary_key='post_id';
		$this->load->library('common');
	}
	
	public function wall() {
		//echo "inn"; exit;
		
		$data = $this->load_module_info ();	
		$post_category = $this->Mydb->get_all_records('*',$this->blog_categorytable,array('blog_cat_status' => 'A'),'','',array('blog_cat_sequence'=>'ASC'));
		$category['']='All Category';
		if(!empty($post_category))
		{
			foreach($post_category as $blogcat)
			{
				$category[$blogcat['blog_cat_id']] = $blogcat['blog_cat_name'];
			}
		}
		$data['post_category'] = $category;
		$this->layout->display_site ( $this->folder . $this->module . "-index", $data );
	}
	
	
	public function wall_ajax_pagination(){
		
		check_site_ajax_request();
		
		$like = array ();
	
		$order_by = array (
				$this->primary_key => 'DESC' 
		);
		$where = array('post_status'=>'A','post_by !='=>'admin');
		$groupby = "post_id";
		$blocked_users = get_all_block_users();
		if(!empty($blocked_users))
		{
			$blockedlist = implode(',',$blocked_users);
			$where = array_merge ( $where, array (
				"customer_id NOT IN (".$blockedlist.")" => null,
			));

		}
		if(post_value('section') !=''&& post_value('section') == 'blogs')
		{
			$where = array_merge ( $where, array (
				"post_type !=" => 'picture', 
				"post_type !=" => 'video', 
			));
		}
		if(post_value('section') !=''&& post_value('section') == 'pictures')
		{
			$where = array_merge ( $where, array (
				"(post_type = 'picture' || post_type ='video')" => null,
			));
		}
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
		
		$join = "";
		$join [0] ['select'] = "blog_cat_id,blog_cat_name";
		$join [0] ['table'] = $this->blog_categorytable;
		$join [0] ['condition'] = "post_category = blog_cat_id";
		$join [0] ['type'] = "LEFT";
		
		$join [1] ['select'] = "customer_id,customer_first_name,customer_last_name,customer_email,customer_photo,customer_type,company_name,customer_celebrity_badge";
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
		
		$join [5] ['select'] = "group_concat(',',post_favor_user_id) as favoruser";
		$join [5] ['table'] = $this->post_favor;
		$join [5] ['condition'] = "post_id = post_favor_post_id";
		$join [5] ['type'] = "LEFT";

		$totla_rows = $this->Mydb->get_num_join_rows ( $this->primary_key, $this->table, $where, null, null, null, $like, $groupby, $join  );
	
		$limit = 12;
		$page = post_value ( 'page' )?$post_value ( 'page' ):1;
		$offset = post_value ( 'page' )?((post_value ( 'page' )-1) * $limit):0;
		$offset = post_value ( 'offset' )?post_value ( 'offset' ):$offset;
		$next_offset = $offset+$limit;
		$next_set = ($totla_rows > $next_offset)?($offset+$limit):'';
		
		
		
		$data['offset'] = $offset;
		$data['next_set'] = $next_set;
		// $select_array = array ('pos_posts.*');
		$select_array = array ("pos_posts.*,(SELECT group_concat(post_media_filename) FROM pos_post_media WHERE post_media_post_id=post_id) as post_photo");

		$data ['records'] = $this->Mydb->get_all_records ( $select_array, $this->table, $where, $limit, $offset, $order_by, $like, $groupby, $join );
		$data['page'] = $offset;
// echo "<pre>";
// echo $this->db->last_query();
// exit;
		/*
		if($userid == get_user_id())
		{
			$data['post_enable'] = 'Yes';
		}
		else
		{*/
			$data['post_enable'] = 'Yes';
		//}
		
		
		$post_category = $this->Mydb->get_all_records('*',$this->blog_categorytable,array('blog_cat_status' => 'A'),'','',array('blog_cat_sequence'=>'ASC'));
		$category[''] = "All Category"; 
		if(!empty($post_category))
		{
			foreach($post_category as $blogcat)
			{
				$category[$blogcat['blog_cat_id']] = $blogcat['blog_cat_name'];
			}
		}
		$data['post_category'] = $category;
		$data['show'] = post_value('show');
		$data['section'] = post_value('section');
		$html = get_template ( $this->folder . '/' . $this->module . '-index-ajax-list', $data );
		echo json_encode ( array (
				'status' => 'success',
				'html' => $html,
				'next_set' => $next_set,
		) );
		exit ();
	}
	
	/* this method used to check login */
	public function index() {
		
		//echo "inn"; exit;
		$data = $this->load_module_info ();	
		$post_category = $this->Mydb->get_all_records('*',$this->blog_categorytable,array('blog_cat_status' => 'A'),'','',array('blog_cat_sequence'=>'ASC'));
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
		$blocked_users = get_all_block_users();
		if(!empty($blocked_users))
		{
			$blockedlist = implode(',',$blocked_users);
			$where = array_merge ( $where, array (
				"customer_id NOT IN (".$blockedlist.")" => null,
			));

		}
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
		
		$join [1] ['select'] = "customer_id,customer_first_name,customer_last_name,customer_email,customer_type,company_name,customer_photo";
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
	
	/* this method used to to check validate image file */
	public function validate_video() {
		if (isset ( $_FILES ['post_video'] ['name'] ) && $_FILES ['post_video'] ['name'] != "") {
			if ($this->common->valid_video ( $_FILES ['post_video'] ) == "No") {
				$this->form_validation->set_message ( 'validate_video', get_label ( 'upload_valid_image' ) );
				return false;
			}
		}
		return true;
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
			$this->form_validation->set_rules ( 'post_video', 'lang:post_video', 'trim|callback_validate_video' );
			
			if((post_value('post_type') == 'picture') && (empty($_FILES['post_photo']['name']))) { 
				$this->form_validation->set_rules ( 'post_photo[]', 'lang:post_photo', 'required' );
			}
			
			if ($this->form_validation->run () == TRUE) {
				
				/* upload image */
				// $post_photo = "";
				// if (isset ( $_FILES ['post_photo'] ['name'] ) && $_FILES ['post_photo'] ['name'] != "") {
				// 	$post_photo = $this->common->upload_image ( 'post_photo', $this->lang->line('post_photo_folder_name') );
				// }
				
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
				/* upload pdf */
				$post_pdf = "";
				$res = 0;
				if (isset ( $_FILES ['post_pdf'] ['name'] ) && $_FILES ['post_pdf'] ['name'] != "" && (post_value ( 'post_type' ) == 'book' || post_value('post_type') == 'story' || post_value('post_type') == 'blog' )) {
					$post_pdf = $this->common->upload_pdf ( 'post_pdf',$this->lang->line('post_pdf_folder_name') );
					
					if($post_pdf['status'] == 'success')
					{
						$post_pdf = $post_pdf['message'];
					}
					else
					{
						$res = 1;
						$result ['status'] = 'error';
						$result ['message'] = $post_pdf['message'];
					}
				}			

				if($res == 0)
				{
					$category = array();
					$post_category = $this->Mydb->get_all_records('*',$this->blog_categorytable,array('blog_cat_status' => 'A'),'','',array('blog_cat_sequence'=>'ASC'));
					if(!empty($post_category))
					{
						foreach($post_category as $blogcat)
						{
							$category[$blogcat['blog_cat_slug']] = $blogcat['blog_cat_id'];
						}
					}
// echo "<pre>";
// print_r($category);
// echo "</pre>";
					$embed_video_url='';
					if(post_value('post_embed_video_url') !='')
					{
						$embed_video_url = preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","www.youtube.com/embed/$1",post_value('post_embed_video_url'));
					}
					$insert_array = array (
							'post_category' => $category[post_value ( 'post_category' )],
							'post_type' => post_value ( 'post_type' ),
							'post_title' => post_value ( 'post_title' ),
							'post_description' => json_encode(get_censored_string($this->input->post( 'post_description',FALSE ))),
							'post_video' => $post_video,
							'post_pdf' => $post_pdf,
							'post_embed_video_url' => $embed_video_url,
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
					// 'post_photo' => $post_photo,
					if (isset ( $_FILES ['post_photo'] ['name'] ) && $_FILES ['post_photo'] ['name'] != "") 
					{
							$this->do_multi_upload("post_photo",$this->lang->line('post_photo_folder_name'),$insert_id);
					}					
					if($insert_id)
					{
						$customer_username=get_tag_username(get_user_id());						
						$message=$customer_username.' added new post';
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
							$customer_username=get_tag_username(get_user_id());						
							$post_tag_message=$customer_username." has tagged you on post";						
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
									$record['subject'] = $post_tag_message;
									$record['message'] = $post_tag_message;
									$record['notification_type'] = "post_tag";
									$record['assigned_to'] = decode_value($exploded[0]);
									post_notify($record);#insert post tags user
								}
							}
							if(!empty($batch_insert)) {
								$this->db->insert_batch('post_tags',$batch_insert);
							}
						}
					}
					$this->session->set_flashdata ( 'admin_success', sprintf ( $this->lang->line ( 'success_message_add' ), $this->post_module_label ) );
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
			$this->form_validation->set_rules('post_category','lang:post_category','required');
			$this->form_validation->set_rules('post_type','lang:post_type','required');
			$this->form_validation->set_rules ( 'post_video', 'lang:post_video', 'trim|callback_validate_video' );
			
			if((post_value('post_type') == 'picture') && (empty($_FILES['post_photo']['name']))) { 
				$this->form_validation->set_rules ( 'post_photo[]', 'lang:post_photo', 'required' );
			}
			
			//$this->form_validation->set_rules('post_title','lang:post_title','required|trim|strip_tags');			
		//	$this->form_validation->set_rules('post_description','lang:post_description','required');
			//$this->form_validation->set_rules('post_category','lang:post_category','required');
			//$this->form_validation->set_rules('post_type','lang:post_type','required');
			$this->form_validation->set_rules('record_id','lang:record_id','required');
			
			/*if(post_value('post_type') == 'picture') { 
				$this->form_validation->set_rules ( 'post_photo', 'lang:post_photo', 'required' );
			}*/
			
			if ($this->form_validation->run () == TRUE) {
				
				
				$record_id = decode_value(post_value('record_id'));
				
				$record = $this->Mydb->get_record ( '*', $this->table, array ($this->primary_key => $record_id ) );
				
				
				/* upload image */
				if (isset ( $_FILES ['post_photo'] ['name'] ) && $_FILES ['post_photo'] ['name'] != "") 
				{
					$this->do_multi_upload("post_photo",$this->lang->line('post_photo_folder_name'),$record_id);
				}	
				/*
				$post_photo = $record['post_photo'];

				if (isset ( $_FILES ['post_photo'] ['name'] ) && $_FILES ['post_photo'] ['name'] != "") {
					$post_photo = $this->common->upload_image ( 'post_photo', $this->lang->line('post_photo_folder_name') );
				}*/
				
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
				/* upload pdf */
				$post_pdf = "";
				$res = 0;
				if (isset ( $_FILES ['post_pdf'] ['name'] ) && $_FILES ['post_pdf'] ['name'] != "" && (post_value ( 'post_type' ) == 'book' || post_value ( 'post_type' ) == 'story' )) {
					$post_pdf = $this->common->upload_pdf ( 'post_pdf',$this->lang->line('post_pdf_folder_name') );
					
					if($post_pdf['status'] == 'success')
					{
						$post_pdf = $post_pdf['message'];
					}
					else
					{
						$res = 1;
						$result ['status'] = 'error';
						$result ['message'] = $post_pdf['message'];
					}
				}					

				if($res == 0)
				{
					$category = array();
					$post_category = $this->Mydb->get_all_records('*',$this->blog_categorytable,array('blog_cat_status' => 'A'),'','',array('blog_cat_sequence'=>'ASC'));
					if(!empty($post_category))
					{
						foreach($post_category as $blogcat)
						{
							$category[$blogcat['blog_cat_name']] = $blogcat['blog_cat_id'];
						}
					}
					$embed_video_url='';
					if(post_value('post_embed_video_url') !='')
					{
						$embed_video_url = preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","www.youtube.com/embed/$1",post_value('post_embed_video_url'));
					}

					$update_array = array (
							//'post_category' => $category[post_value ( 'post_category' )],
							//'post_type' => post_value ( 'post_type' ),
							'post_title' => post_value ( 'post_title' ),
							'post_description' => json_encode(get_censored_string($this->input->post ( 'post_description',FALSE ))),
							'post_video' => $post_video,
							'post_pdf' => $post_pdf,
							'post_embed_video_url' => $embed_video_url,
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
			//$where = "post_slug = '".$slug."'";
			$like = array ();
			
			$where = array('post_status'=>'A','post_slug'=>$slug);
			$groupby = "post_id";
			$blocked_users = get_all_block_users();
			if(!empty($blocked_users))
			{
				$blockedlist = implode(',',$blocked_users);
				$where = array_merge ( $where, array (
					"customer_id NOT IN (".$blockedlist.")" => null,
				));

			}
			
			$order_by = array (
					$this->primary_key => 'DESC' 
			);
			$join = array();
			$join [0] ['select'] = "blog_cat_id,blog_cat_name";
			$join [0] ['table'] = $this->blog_categorytable;
			$join [0] ['condition'] = "post_category = blog_cat_id";
			$join [0] ['type'] = "LEFT";
			
			$join [1] ['select'] = "customer_id,customer_first_name,customer_last_name,customer_email,customer_photo,customer_type,company_name,customer_celebrity_badge";
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

			$join [5] ['select'] = "group_concat(',',post_favor_user_id) as favoruser";
			$join [5] ['table'] = $this->post_favor;
			$join [5] ['condition'] = "post_id = post_favor_post_id";
			$join [5] ['type'] = "LEFT";
			
			$groupby = "post_id";

			$select_array = array ("pos_posts.*,(SELECT group_concat(post_media_filename) FROM pos_post_media WHERE post_media_post_id=post_id) as post_photo");
			$records = $this->Mydb->get_all_records ( $select_array, $this->table, $where, '', '', $order_by, $like, $groupby, $join );

			$data ['records'] = $records;
			if(!empty($records))
			{
				$data['meta_title'] = $records[0]['post_title'];
				$data['meta_description'] = $records[0]['post_description'];
				$data['meta_keyword'] = $records[0]['post_title'];
				if(get_user_id()) {	
					$notify_update = array('open_status'=>'Y');
					$this->Mydb->update('post_notification',array('notification_post_id'=>$records[0]['post_id'], 'open_status'=>'N','assigned_to'=>get_user_id()),$notify_update);
				}
			}
			else {
				redirect(base_url());
			}
			$this->layout->display_site ( $this->folder . $this->module . "-view", $data );
		}
		else
		{
			redirect(base_url());
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
		$join = array();
		$join [0] ['select'] = "blog_cat_id,blog_cat_name,blog_cat_slug";
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
		$search_text=$this->input->get ( 'term' );		
		$select_array = array ('pos_posts.*');
		$where=$offset=$limit=$order_by=$order_by_array=$like=$like_array=$groupby=$join=array();
		$join = array();

		$where_array = array('post_status'=>'A');
		$order_by_array = array('post_title'=>'ASC');
		$like_array = array('post_title'=>$search_text);
		$limit = get_label('search_result_limit');
		$post_records = $this->Mydb->get_all_records ( "post_slug topic_label,post_title topic_value,CASE post_status WHEN 'A' THEN 'Post' END  'topic_type'", $this->table, $where_array, $limit, $offset, $order_by, $like_array, $groupby, $join );	
			
		$where = array('customer_status'=>'A', 'customer_private !='=>1,"(customer_first_name like '%$search_text%' OR customer_last_name like '%$search_text%' OR company_name like '%$search_text%' OR customer_username like '%$search_text%')"=>NULL,'customer_username !='=>'');
		$order_by = array('customer_first_name'=>'ASC');
		
		$records = $this->Mydb->get_all_records ( "customer_type,customer_id topic_label,CONCAT(COALESCE(customer_first_name,''),' ',COALESCE(customer_last_name,'')) topic_value,company_name,customer_username,CASE customer_type WHEN 0 THEN 'Person' WHEN 1 THEN 'Business' END  'topic_type'", $this->customers, $where, $limit, $offset, $order_by, $like, $groupby, $join );

		if(!empty($post_records) || !empty($records))
		{
			$i=0;
			
			if(!empty($records))
				$post_records=array_merge($post_records,$records);

			foreach($post_records as $key=>$record)
			{
				if($record['topic_label'] != '')
				{
					$_search_text=str_ireplace($search_text, '<span class="highlight_search_text">'.substr($record['topic_value'],0,strlen($search_text)).'</span>', $record['topic_value']);
					
					if($record['topic_type'] != 'Post') {
						if($record['customer_type'] == 0)
						{
							$_search_text=str_ireplace($search_text, '<span class="highlight_search_text">'.substr($record['topic_value'],0,strlen($search_text)).'</span>', $record['topic_value']);
							$result [$i]['value'] = $record['topic_value'];
						}else{
							$_search_text=str_ireplace($search_text, '<span class="highlight_search_text">'.substr($record['company_name'],0,strlen($search_text)).'</span>', $record['company_name']);
							$result [$i]['value'] = $record['company_name'];
						}						
					}
					
					if($record['topic_type'] == "Post")
					{
						
						$result [$i]['id'] = "home/view/".$record['topic_label'];
						$result [$i]['label'] = $record['topic_type']." : ".$_search_text ;
					}
					else
					{
						$result [$i]['id'] = "myprofile/".urlencode($record['customer_username']);
						$result [$i]['label'] = $record['topic_type']." : ".$_search_text ;
					}
					
					$i++;
				}
			}
		}
		else
		{
			$result = array();
		}
		echo json_encode ( $result );
		exit ();
	}
	public function editpost($slug=null)
	{	
		$this->authentication->user_authentication();		
		$data = $this->load_module_info ();
		if($slug !='')
		{
/*		$select_array=array("post_id,post_slug,post_category,post_type,post_title,post_description,post_video,post_tags,(SELECT group_concat(post_media_filename) FROM pos_post_media WHERE post_media_post_id=post_id) as post_photo");
*/
			$select_array = array ("pos_posts.*,(SELECT group_concat(post_media_filename) FROM pos_post_media WHERE post_media_post_id=post_id) as post_photo");

				$where=array('post_slug'=>$slug,'post_created_by'=>get_user_id());
				$result = $this->Mydb->get_record($select_array,$this->table,$where);
				$post_category = $this->Mydb->get_record('blog_cat_name','blog_category',array('blog_cat_id'=>$result['post_category']));
				$data['postslug']=$slug;
				$data['result']=$result;
				$data['result']['blog_cat_name']=$post_category['blog_cat_name'];
        	$this->layout->display_site($this->folder . '/' . $this->module . '-edit-post', $data);
		}

	}		
	public function updatepost()
	{
		$result=array();
		$this->authentication->user_authentication();		
			//check_site_ajax_request();
		if ($this->input->post ( 'action' ) == "Update") 
		{
			$this->form_validation->set_rules('postslug','lang:post_slug','required|trim');			
			$this->form_validation->set_rules('post_title','lang:post_title','required|trim|strip_tags');			
			$this->form_validation->set_rules('post_description','lang:post_description','required');
			$this->form_validation->set_rules('post_category','lang:post_category','required');
			$this->form_validation->set_rules('post_type','lang:post_type','required');
			
			if ($this->form_validation->run () == TRUE) 
			{
				$editid=decode_value(post_value('editid'));
				/* upload image */
				// $post_photo = "";
/*				if (isset ( $_FILES ['post_photo'] ['name'] ) && $_FILES ['post_photo'] ['name'] != "") 
				{
	 				$post_image_path = FCPATH . 'media/' .  $this->lang->line('post_photo_folder_name'). post_value('existpostphoto');
					if (file_exists ( $post_image_path )) 
					{
						@unlink ( $post_image_path );
					}
					$post_photo = $this->common->upload_image ( 'post_photo', $this->lang->line('post_photo_folder_name') );
				}*/
				if (isset ( $_FILES ['post_photo'] ['name'] ) && $_FILES ['post_photo'] ['name'] != "") 
				{
					if($editid !='')
					{
						$this->Mydb->delete ( 'post_media', array ('post_media_post_id' => $editid ));
					}	
					$existpostphoto=post_value('existpostphoto');
					$existpostphotos=explode(",", $existpostphoto);
					if(!empty($existpostphotos))
					{
						foreach($existpostphotos as $existphoto)
						{
			 				$post_image_path = FCPATH.'media/'.$this->lang->line('post_photo_folder_name').$existphoto;
							if (file_exists ( $post_image_path )) 
							{
								@unlink ( $post_image_path );
							}
						}
					}
					$this->do_multi_upload("post_photo",$this->lang->line('post_photo_folder_name'),$editid);
				}									
				/* upload video */
				$post_video = "";
				$res = 0;
				if (isset ( $_FILES ['post_video'] ['name'] ) && $_FILES ['post_video'] ['name'] != "" && post_value ( 'post_type' ) == 'video') 
				{
    				$post_video_path = FCPATH . 'media/' . $this->lang->line('post_video_folder_name') . post_value('existpostvideo');
					if (file_exists ( $post_video_path )) 
					{
						@unlink ( $post_video_path );
					}

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
				/* upload pdf */
				$post_pdf = "";
				$res = 0;
				if (isset ( $_FILES ['post_pdf'] ['name'] ) && $_FILES ['post_pdf'] ['name'] != "" && (post_value ( 'post_type' ) == 'book' || post_value ( 'post_type' ) == 'story'  || post_value('post_type') == 'blog'  )) {
					$post_pdf = $this->common->upload_pdf ( 'post_pdf',$this->lang->line('post_pdf_folder_name') );
					
					if($post_pdf['status'] == 'success')
					{
						$post_pdf = $post_pdf['message'];
					}
					else
					{
						$res = 1;
						$result ['status'] = 'error';
						$result ['message'] = $post_pdf['message'];
					}
				}									
				if($res == 0)
				{
					$category = array();
					$post_category = $this->Mydb->get_all_records('*',$this->blog_categorytable,array('blog_cat_status' => 'A'),'','',array('blog_cat_sequence'=>'ASC'));
					if(!empty($post_category))
					{
						foreach($post_category as $blogcat)
						{
							$category[$blogcat['blog_cat_name']] = $blogcat['blog_cat_id'];
						}
					}
					
					$embed_video_url='';
					if(post_value('post_embed_video_url') !='')
					{
						$embed_video_url = preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","www.youtube.com/embed/$1",post_value('post_embed_video_url'));
					}

					$update_array = array (
							'post_category' => $category[post_value ( 'post_category' )],
							'post_type' => post_value ( 'post_type' ),
							'post_title' => post_value ( 'post_title' ),
							'post_description' => json_encode(post_value ( 'post_description',FALSE )),
							'post_embed_video_url' => $embed_video_url,
							'post_video' => $post_video,
							'post_pdf' => $post_pdf,
							'post_status' => (post_value('status'))?post_value('status'):'A',
							'post_created_on' => current_date (),
							'post_by' => 'customer',
							'post_created_by' => get_user_id (),
							'post_created_ip' => get_ip () 
					);
					$title=post_value('post_title');
					$update_array['post_slug']=make_slug($title,$this->table,'post_slug');

					$where_array=array('post_id'=>$editid);
					$insert_id = $this->Mydb->update ( $this->table,$where_array, $update_array );

					if($insert_id)
					{
						$this->Mydb->delete('post_tags',array('post_tag_post_id'=>$editid));

						if(!empty($this->input->post('post_tags')))
						{
							$message='Add post';
							#insert post notification
								$record = array(
									'notification_post_id'=>$insert_id,
									'created_type'=>'E',
									'message_type'=>'N',
									'private'=>0,
									'created_by'=>get_user_id(),
									'created_on'=>current_date(),				
									'ip_address'=>get_ip(),
									);
							#insert post notification						
							$post_tags = $this->input->post('post_tags');
							$customer_username=get_tag_username(get_user_id());						
							$post_tag_message=$customer_username." has tagged you on post";		

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
									$record['subject'] = $post_tag_message;
									$record['message'] = $post_tag_message;
									$record['notification_type'] = "post_tag";
									$record['assigned_to'] = decode_value($exploded[0]);
									post_notify($record);#insert post tags user									
								}
							}
							if(!empty($batch_insert)) {
								$this->db->insert_batch('post_tags',$batch_insert);
							}
						}
					}
					$this->session->set_flashdata ( 'admin_success', sprintf ( $this->lang->line ( 'success_message_update' ), $this->post_module_label ) );
					$result ['status'] = 'success';
				}
				
				
			}
			else 
			{
				$result ['status'] = 'error';
				$result ['message'] = validation_errors ();
			}
			
		}
		else
		{
				$result ['status'] = 'error';
				$result ['message'] = 'error';			
		}
			echo json_encode ( $result );
			exit ();
	}
	public function reportpost()
	{
		$result=array();
		check_site_ajax_request();
		$this->authentication->user_authentication();
		$data = $this->load_module_info ();
		if ($this->input->post ( 'action' ) == "Report") 
		{
			$this->form_validation->set_rules('dataid','lang:post_id','required|trim');			
			if ($this->form_validation->run () == TRUE) 
			{
				$postid = decode_value(post_value ( 'dataid' ));
					$insert_array = array (
							'report_post_id' => $postid,
							'report_created_on' => current_date (),
							'report_created_by' => get_user_id (),
							'report_created_ip' => get_ip () 
					);
					$insert_id = $this->Mydb->insert ('post_reports', $insert_array );

				$this->session->set_flashdata ( 'admin_success', sprintf ( $this->lang->line ( 'success_message_report' ), $this->post_module_label ) );

				$result ['status'] = 'ok';
				$result ['message'] = sprintf ( $this->lang->line ( 'success_message_report' ), $this->post_module_label );
			}
			else 
			{
				$result ['status'] = 'error';
				$result ['message'] = validation_errors ();
			}
		}
		else
		{
			$result ['status'] = 'error';
			$result ['message'] = 'error';			
		}
		echo json_encode ( $result );
		exit ();
	}		
	public function deletepost()
	{
		$result=array();
		check_site_ajax_request();
		$this->authentication->user_authentication();
		$data = $this->load_module_info ();
		if ($this->input->post ( 'action' ) == "Delete") 
		{
			$this->form_validation->set_rules('dataid','lang:post_id','required|trim');			
			if ($this->form_validation->run () == TRUE) 
			{
				$postid = decode_value(post_value ( 'dataid' ));
				$delete_query=delete_post($postid);#pass post id to delete the post related 
				$this->session->set_flashdata ( 'admin_success', sprintf ( $this->lang->line ( 'success_message_delete' ), $this->post_module_label ) );
				$result ['status'] = 'ok';
				$result ['message'] = sprintf ( $this->lang->line ( 'success_message_delete' ), $this->post_module_label );

			}
			else 
			{
				$result ['status'] = 'error';
				$result ['message'] = validation_errors ();
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
	
	public function gettagnames() {

		$followers = array(''=>'Select users');
		$search	= $this->input->post('searchword');
		$search=str_replace("@","",$search);
		$search=str_replace(" ","%",$search);

		$followers_lst = array();
		$userid = get_user_id();
		if($userid !='')
		{
			$join = '';
			$order_by = array('customer_first_name'=>'ASC');
			$join [0] ['select'] = "customer_id,customer_first_name,customer_last_name,customer_email,customer_photo,customer_type,company_name,customer_celebrity_badge,customer_username";
			$join [0] ['table'] = 'customers';
			$join [0] ['condition'] = "follow_user_id = customer_id and customer_private != 1";
			$join [0] ['type'] = "INNER";
			$followers_lst = $this->Mydb->get_all_records('customers_followers.*','customers_followers',array('follow_customer_id'=>$userid,'customer_status'=>'A','(((customer_first_name like "%'.$search.'%" OR customer_last_name like "%'.$search.'%" ) AND customer_type =0)OR (company_name like "%'.$search.'%" AND customer_type = 1))'=>null),$limit='', $offset='', $order_by, $like='', $groupby=array(), $join );
		}
		if(!empty($followers_lst)) {
			foreach($followers_lst as $foll_list)
			{
				if($foll_list['customer_type'] == 0)
				{
				?>
					<a class='addname' data-link="<?php echo base_url().$foll_list['customer_username']; ?>" title='<?php echo $foll_list['customer_first_name']." ".$foll_list['customer_last_name']; ?>'><?php echo $foll_list['customer_first_name']." ".$foll_list['customer_last_name']; ?></a><br/>
				<?php			
				}
				else
				{
				?>
					<a class='addname' title='<?php echo $foll_list['company_name']; ?>'><?php echo $foll_list['company_name']; ?></a><br/>
				<?php
				}	
			}
		}
		exit;
	}
	public function likeuser($post_id)
	{
		$result=$result_set=$join=array();
		// check_site_ajax_request();
		// $this->authentication->user_authentication();
		$data = $this->load_module_info ();
			$postid = decode_value($post_id);
		if ($postid != "") 
		{
			$order_by = array('customer_first_name'=>'ASC');
			$join [0] ['select'] = "customer_id,customer_first_name,customer_last_name,customer_email,customer_photo,customer_type,company_name,customer_celebrity_badge,customer_username";
			$join [0] ['table'] = 'customers';
			$join [0] ['condition'] = "customer_id = post_like_created_by and customer_private != 1";
			$join [0] ['type'] = "INNER";
			$result_set = $this->Mydb->get_all_records($this->post_likes.'.*',$this->post_likes,array('post_like_post_id'=>$postid),$limit='', $offset='', $order_by, $like='', $groupby=array(), $join );
			if(!empty($result_set))
			{
				$result ['status'] = 'success';
				$data['results'] = $result_set;
				$data['title'] = "Post Like";
				$data['customer_id'] = get_user_id();
				$result['html'] = get_template ( $this->folder . '/' . $this->module . '-post-like-user-popup', $data );
			}
			else
			{
				$result ['status'] = 'error';
				$result ['message'] = '';				
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
public function do_multi_upload($file_name,$image_path, $insert_id) 
{	
		    $cpt = count($_FILES[$file_name]['name']);
		if (! empty ( $file_name )) 
		{
			$post_image_arary=array();
			$insertid = $insert_id;
		    $files = $_FILES;
			for($i = 0; $i < $cpt; $i ++) 
			{
				$image_data=array();
				$_FILES [$file_name] ['name'] = $files [$file_name] ['name'] [$i];
				$_FILES [$file_name] ['type'] = $files [$file_name] ['type'] [$i];
				$_FILES [$file_name] ['tmp_name'] = $files [$file_name] ['tmp_name'][$i];
				$_FILES [$file_name] ['error'] = $files [$file_name] ['error'] [$i];
				$_FILES [$file_name] ['size'] = $files [$file_name] ['size'] [$i];

				// $config['upload_path']=constant ( 'event_upload_path' );
				// $config['allowed_types']=constant ( 'image_allowed_types' );
				// $config['max_size']     = constant ( 'image_max_size' );					
				$config ['upload_path'] = FCPATH . 'media/' . $image_path;
				if(preg_match("/\.(gif|jpg|jpeg|png)$/", $_FILES [$file_name] ['name']))
				{
					$config ['allowed_types'] = '*';				
				}
				else
				{
					$config ['allowed_types'] = 'gif|jpg|jpeg|png';				
				}				
				$config['encrypt_name']=true;
				$config['remove_spaces']=true;					
				$this->load->library('upload',$config);	
				if(!$this->upload->do_upload($file_name))
				{
			    	$img_log_array=json_encode($_FILES [$file_name] ['type']);
			        $img_file_name='image_log.txt';
			        $img_log_file =APPPATH.'/logs/'.$img_file_name;
			        file_put_contents($img_log_file,$img_log_array);

					$error=$this->upload->display_errors();						
					$response = array("status"=>"error","message"=>$error);
					echo json_encode($response); 
					exit;												
			    }
			    else
			    {
	                $image_data = $this->upload->data();//store the file info
					$filename = $image_data ['full_path']; /*ADD YOUR FILENAME WITH PATH*/
					$exif = exif_read_data($filename);

					$ort = (!empty($exif['Orientation']))?$exif['Orientation']:null; /*STORES ORIENTATION FROM IMAGE */
					$ort1 = $ort;
					$exif = exif_read_data($filename, 0, true);
					if (!empty($ort1))
					{
						$image = imagecreatefromjpeg($filename);
						$ort = $ort1;
						switch ($ort) {
							case 3:
								$image = imagerotate($image, 180, 0);
								break;
							case 6:
								$image = imagerotate($image, -90, 0);
								break;

							case 8:
								$image = imagerotate($image, 90, 0);
								break;
						}
						imagejpeg($image,$filename, 90);
					}
				// // return $data['file_name'];
					$post_image_arary[] = array ( 'post_media_post_id' => $insertid,
										'post_media_type'=>'image',
										'post_media_filename' => $image_data['file_name'],
										);

				}
			}
			if(!empty($post_image_arary))
			{
					$this->Mydb->insert_batch('post_media', $post_image_arary );
			}
		}
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
