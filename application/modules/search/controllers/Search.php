<?php
/**************************
Project Name	: BlogGotoWeb
Created on		: 27 Nov, 2017
Last Modified 	: 27 Nov, 2017
Description		: Page contains frontend panel login and forgot password functions.

***************************/
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Search extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		//$this->authentication->user_authentication();
		$this->module = "search";
		$this->module_label = get_label('search_module_label');
		$this->module_labels = get_label('search_module_label');
		$this->post_module_label = get_label('post_module_label');
		$this->post_module_labels = get_label('post_module_label');		
		$this->folder = "search/";
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
		$data = $this->load_module_info ();

		$search_text=$this->input->get ( 'term' );	
		if($search_text !='')
		{		
			$select_array = array ('pos_posts.*');
			$where=$offset=$limit=$order_by=$order_by_array=$like=$like_array=$groupby=$join=array();
			$offset= $limit= 0;  
			$join = array();
			
			
			$join [0] ['select'] = "blog_cat_id,blog_cat_name";
			$join [0] ['table'] = $this->blog_categorytable;
			$join [0] ['condition'] = "post_category = blog_cat_id";
			$join [0] ['type'] = "LEFT";
			
			$join [1] ['select'] = "customer_id,,CONCAT(COALESCE(customer_first_name,''),' ',COALESCE(customer_last_name,'')) topic_value,customer_email,customer_type,company_name, customer_photo,customer_celebrity_badge";
			$join [1] ['table'] = $this->customers;
			$join [1] ['condition'] = "post_created_by = customer_id and post_by !='admin' ";
			$join [1] ['type'] = "LEFT";
			
			
			$where_array = array('post_status'=>'A','post_by !='=>'admin');
			$order_by_array = array('post_title'=>'ASC');
			$like_array = array('post_title'=>$search_text);
			$limit = get_label('search_result_limit');
			$post_records = $this->Mydb->get_all_records ( "post_slug,post_title,post_photo,post_description,CASE post_status WHEN 'A' THEN 'Post' END  'topic_type'", $this->table, $where_array, '', '', $order_by, $like_array, $groupby, $join );	

			$join = array();		
			$where = array('customer_status'=>'A', 'customer_private !='=>1,"(customer_first_name like '%$search_text%' OR customer_last_name like '%$search_text%' OR company_name like '%$search_text%' OR customer_username like '%$search_text%')"=>NULL,'customer_username !='=>'');
			$order_by = array('customer_first_name'=>'ASC');
			
			$records = $this->Mydb->get_all_records ( "customer_type,customer_notes,customer_photo,customer_id topic_label,CONCAT(COALESCE(customer_first_name,''),' ',COALESCE(customer_last_name,'')) topic_value,company_name,customer_celebrity_badge,customer_username,CASE customer_type WHEN 0 THEN 'Person' WHEN 1 THEN 'Business' END  'topic_type'", $this->customers, $where, '', '', $order_by, $like, $groupby, $join );

			$post_records=array_merge($post_records,$records);
			/*
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
			} */
			$data['offset'] = $offset;
			$data['result'] = $post_records;
			$this->layout->display_site ( $this->folder . $this->module . "-list", $data );
		}
		else
		{
			redirect(base_url());
		}
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
			
		$where = array('customer_status'=>'A',"(customer_first_name like '%$search_text%' OR customer_last_name like '%$search_text%' OR company_name like '%$search_text%' OR customer_username like '%$search_text%')"=>NULL,'customer_username !='=>'');
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
	
	/* this method used to common module labels */
	private function load_module_info() {
		$data = array ();
		$data ['module_label'] = $this->module_label;
		$data ['module_labels'] = $this->module_labels;
		$data ['module'] = $this->module;
		return $data;
	}
}
