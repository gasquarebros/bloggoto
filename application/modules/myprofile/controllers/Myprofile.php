<?php
/**************************
Project Name	: BlogGotoWeb
Created on		: 27 Nov, 2017
Last Modified 	: 27 Nov, 2017
Description		: Page contains frontend panel login and forgot password functions.

***************************/
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Myprofile extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		//$this->authentication->user_authentication();
		$this->module = "profile";
		$this->module_label = get_label('profile_module_label');
		$this->module_labels = get_label('profile_module_label');
		$this->post_comment_module_label = get_label('post_comment_module_label');
		$this->folder = "myprofile/";
		$this->table = "posts";
		$this->customer_followers = "customers_followers";
		$this->blog_categorytable = "blog_category";
		$this->customers = "customers";
		$this->customers_followers = "customers_followers";
		$this->post_likes = "post_likes";
		$this->post_favor = "post_favor";
		$this->post_tags = "post_tags";
		$this->post_comments = "post_comments";
		$this->professions = "professions";
		$this->primary_key='post_id';
		$this->load->library('common');
		$this->load->helper('security');
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
	
	
	/* this method used check user name or alredy exists or not */
	public function validate_companyname() {
		$email = $this->input->post ( 'company_name' );
		$edit_id = get_user_id();
		
		$where = array (
				'company_name' => trim ( $email ),
		);
		if ($edit_id != "") {
			$where = array_merge ( $where, array (
					"customer_id !=" => $edit_id 
			) );
			
		}
		
		$result = $this->Mydb->get_record ( 'company_name', $this->customers, $where );
		
		if (! empty ( $result ) ) {
			$this->form_validation->set_message ( 'validate_companyname', 'Business Name Already Exist' );
			return false;
		} else {
			return true;
		}
	}
	
	
	/* this method used to check login */
	public function index($userid=null,$notify_id=null,$notify_status=null) 
	{
		if($notify_id != '' && decode_value($notify_status)=='N')
		{
	        $notification_id = decode_value($notify_id);
			$where = array('open_status'=>'Y');
			$this->Mydb->update('post_notification',array('post_notification_id'=>$notification_id, 'open_status'=>'N'),$where);
		}
		if($userid == null)
		{
			//$userid = get_user_id();
			$userid = get_user_username();
		}
		else
		{
			//$userid = decode_value($userid);
			$userid = urldecode($userid);
		}
		if($userid == null)
		{
			$this->authentication->user_authentication();
		}
		//echo "inn"; exit;
		$data = $this->load_module_info ();	
		//$info = $this->Mydb->get_record('customer_type,customer_photo',$this->customers,array('customer_id'=>$userid));
		$info = $this->Mydb->get_record('customer_id,customer_type,customer_photo',$this->customers,array('customer_username'=>$userid));

		if(empty($info)) {
			redirect(base_url());
		}
		$post_infos = $this->Mydb->get_all_records('COUNT(post_id) as postcount, post_type',$this->table,array('post_created_by'=>$info['customer_id'],'post_status'=>'A'),$limit = '', $offset = '', $order = '', $like = '', $groupby = array('post_type'));
		
		
		$follow_records = get_followers_list();
		$follow_list = array();
		if(!empty($follow_records))
		{
			foreach($follow_records as $follows) {
				$follow_list[] = $follows['follow_user_id'];
			}
		} 
		
		$follow_records = get_followers_list($info['customer_id']);
		$following_records = get_following_list($info['customer_id']);
		/*
		$follow_records = $this->Mydb->get_all_records('*',$this->customer_followers,array('follow_customer_id'=>$userid));
		$follow_count = count($follow_records);
		*/
		
		
		$following_count = count($follow_records);
		$follow_count = count($following_records);
		
		if ($this->input->post ( 'action' ) == "edit") {

			//check_site_ajax_request();
			$this->form_validation->set_rules ( 'customer_country', 'lang:customer_country', 'required' );
			$this->form_validation->set_rules ( 'customer_first_name', 'lang:customer_first_name', 'required' );
			//$this->form_validation->set_rules ( 'customer_password', 'lang:customer_password', 'required|min_length[6]' );
			//$this->form_validation->set_rules ( 'customer_email', 'lang:customer_email', 'required|callback_customeremail_exists' );
			//$this->form_validation->set_rules ( 'customer_postal_code', 'lang:customer_postal_code', 'required|max_length[' . get_label ( 'postal_code_max_length' ) . ']' );
			$this->form_validation->set_rules ( 'customer_phone', 'lang:customer_phone', 'trim|max_length[' . get_label ( 'phone_max_length' ) . ']' );
			//$this->form_validation->set_rules ( 'status', 'lang:status', 'required' );
			$this->form_validation->set_rules ( 'customer_photo', 'lang:customer_photo', 'callback_validate_image' );
			if($info['customer_type'] == 1)
			{
				$this->form_validation->set_rules ( 'company_name', 'lang:company_name', 'required|callback_validate_companyname' );
			}

			if ($this->form_validation->run () == TRUE) {
				
				/* upload image */
				$customer_photo = $info['customer_photo'];
				if (isset ( $_FILES ['customer_photo'] ['name'] ) && $_FILES ['customer_photo'] ['name'] != "") 
				{
					$customer_photo = $this->common->upload_image ( 'customer_photo', $this->lang->line('customer_image_folder_name') );
				}
				$profession = $this->input->post( 'customer_prof_profession' );
				$business_sector = $this->input->post( 'business_sector' );
				$update_array = array (
					'customer_first_name' => post_value ( 'customer_first_name' ),
					'customer_last_name' => post_value ( 'customer_last_name' ),
					'customer_phone'=>post_value ( 'customer_phone' ),
					'customer_birthdate'=>(post_value('customer_birthdate') !='' && post_value('customer_birthdate') !='0000-00-00' && post_value('customer_birthdate') != '1970-01-01')?date('Y-m-d',strtotime(post_value ( 'customer_birthdate' ))):'',
					'customer_gender'=>post_value ( 'customer_gender' ),
					'customer_city'=>post_value ( 'customer_city' ),
					'customer_state'=>post_value ( 'customer_state' ),
					'customer_country'=>post_value ( 'customer_country' ),
					'customer_postal_code'=>post_value ( 'customer_postal_code' ),
					'customer_notes'=>post_value ( 'customer_notes' ),
					'customer_hobbies'=>post_value ( 'customer_hobbies' ),
					'customer_maritial_status'=>post_value ( 'customer_maritial_status' ),
					'customer_facebook_link'=>post_value ( 'customer_facebook_link' ),
					'customer_instagram_link'=>post_value ( 'customer_instagram_link' ),
					'customer_twitter_link'=>post_value ( 'customer_twitter_link' ),
					'customer_youtube_link'=>post_value ( 'customer_youtube_link' ),
					'customer_linkedin_link'=>post_value ( 'customer_linkedin_link' ),
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
					'customer_private'=>post_value ( 'customer_private' ),
					'branches'=>post_value ( 'branches' ),
					'is_adult_only'=>post_value ( 'is_adult_only' ),
					'business_establishment'=>post_value ( 'business_establishment' ),
					'customer_notes'=>post_value ( 'customer_notes' ),
					'address'=>post_value ( 'address' ),
					'fax'=>post_value ( 'fax' ),
					'business_model'=>post_value ( 'business_model' ),
					'customer_prof_profession'=>(!empty($profession))?implode(',',$this->input->post( 'customer_prof_profession' )):'',
					'business_sector'=>(!empty($business_sector))?$business_sector:'',
					'customer_photo'=>$customer_photo,
					'customer_prof_school'=>post_value ( 'customer_prof_school' ),
					'customer_prof_college'=>post_value ( 'customer_prof_college' ),
					'customer_prof_work'=>post_value ( 'customer_prof_work' ),
					'customer_prof_official_website'=>post_value ( 'customer_prof_official_website' ),
					'customer_prof_official_email'=>post_value ( 'customer_prof_official_email' ),
					'customer_prof_official_phone'=>post_value ( 'customer_prof_official_phone' ),
					'customer_prof_specialized'=>post_value ( 'customer_prof_specialized' ),
					'customer_prof_types'=>post_value ( 'customer_prof_types' ),
					'customer_prof_rewards'=>post_value ( 'customer_prof_rewards' ),
					'company_name'=>post_value ( 'company_name' ),
					'customer_business_source'=>post_value ( 'business_source' ),
					'customer_business_website'=>post_value ( 'business_website' ),
					'customer_account_holder_name'=>post_value ( 'customer_account_holder_name' ),
					'customer_account_no'=>post_value ( 'customer_account_no' ),
					'customer_ifsc_code'=>post_value ( 'customer_ifsc_code' ),
					'customer_pan_no'=>post_value ( 'customer_pan_no' ),
					'customer_gst_no'=>post_value ( 'customer_gst_no' ),
					'customer_tin_no'=>post_value ( 'customer_tin_no' ),					
					//'customer_type'=>post_value ( 'customer_type' ),
					//'customer_status' => ($this->input->post ( 'status' ) == "A" ? 'A' : 'I'),
					//'customer_created_on' => current_date (),
					//'customer_created_by' => get_admin_id (),
					//'customer_created_ip' => get_ip () 
				);

				$res=$this->Mydb->update ( $this->customers, array ('customer_id' => get_user_id() ), $update_array );
				$blocked_lists=$this->input->post( 'blocked_lists' );
				$this->Mydb->delete ( 'customer_blocked_lists', array('block_customer_id'=>get_user_id ()));
				if(!empty($blocked_lists))
				{
					$blocked_insert_array=array();					
					foreach($blocked_lists as $block_user)
					{
						if(!empty($block_user)) 
						{
							$blocked_insert_array[] = array (
														'block_customer_id' => get_user_id (),
														'block_user_id' => decode_value($block_user),
														'block_created_on' => current_date (),
														'block_created_by' => get_user_id (),
														'block_created_ip' => get_ip () 
													 );
						}
					}
					if(!empty($blocked_insert_array))
					{
						$this->Mydb->insert_batch ( 'customer_blocked_lists', $blocked_insert_array );					
					}
				}
			
				$this->session->set_userdata(array('bg_user_profile_picture'=>media_url().$this->lang->line('customer_image_folder_name')."/".$customer_photo ,'company_name'=>post_value ( 'company_name' )));
				
				$this->session->set_flashdata ( 'admin_success', 'Profile updated successfully' );
				
				$result ['status'] = 'success';
				$redirect = "myprofile";
				echo json_encode ( array('status'=>'success','redirect_url'=>$redirect) ); exit;
				
			} else {
				$result ['status'] = 'error';
				$this->session->set_flashdata('admin_error',validation_errors ());
				$result ['message'] = validation_errors ();
				echo json_encode ( $result ); exit;
			}

		}
		$info = $this->Mydb->get_record('*',$this->customers,array('customer_username'=>$userid));

		$data['info'] = $info;
		$data['post_infos'] = $post_infos;
		$data['follow_count'] = $follow_count;
		$data['follow_list'] = $follow_list;
		$data['following_count'] = $following_count;
		$where = array('customer_id !='=>get_user_id(),'customer_status'=>'A','customer_private'=>0,'customer_username !='=>'');
		if($info['customer_prof_profession'] !='')
		{
			$sel_prof = explode(',',$info['customer_prof_profession']);
			$newwhere = '( 1=1 ';
			foreach($sel_prof as $selprof)
			{
				$newwhere.=" OR customer_prof_profession like '%".$selprof."%'";
			}
			$newwhere.=")";
			//$prof_info = "'".implode("','",$sel_prof)."'";
			$where = array_merge($where,array($newwhere=>null));
		}

		if(!empty($follow_list))
		{
			$where = array_merge($where, array('customer_id NOT IN ('.implode(',',$follow_list).') '=>null));
		}
		$suggestions = array();
		if($info['customer_id'] == get_user_id())
		{
			$suggestions = $this->Mydb->get_all_records('*',$this->customers,$where ,$limit = 4,$offset = '', array('random'));
		}

		$data['suggestions'] = $suggestions;

		$this->layout->display_site ( $this->folder . $this->module . "-index", $data );
	}
	
	public function viewbio($userid = null)
	{
		$this->authentication->user_authentication();
		//$this->authentication->user_authentication();
		check_site_ajax_request();
		//$userid = get_user_id();
		
		if($userid == null)
		{
			$userid = get_user_id();
		}
		else
		{
			$userid = decode_value($userid);
		}

		$info = $this->Mydb->get_record('*',$this->customers,array('customer_id'=>$userid));
		$data['info'] = $info;
		
		$professions = $this->Mydb->get_all_records('*',$this->professions,array('prof_status'=>'A'),$limit = '', $offset = '', array('prof_sequence'=>'ASC'));
		$profession = array(''=>'Select Profession');
		if(!empty($professions))
		{
			foreach($professions as $prof)
			{
				$profession[$prof['prof_title']]= $prof['prof_title'];
			}
		}
		$data['professions'] = $profession;
		
		$html = get_template ( $this->folder . $this->module . '-bio', $data );
		echo json_encode ( array (
				'status' => 'success',
				'html' => $html 
		) );
		exit ();
	}
	
	public function viewblogs($userid =null)
	{
		$this->authentication->user_authentication();
		check_site_ajax_request();
		$userid = (post_value('userid'))?post_value('userid'):$userid;
		if($userid == null)
		{
			echo json_encode(array('status'=>'error','msg'=>'Invalid user'));
			exit();
		}
		else {
			
			$userid = decode_value($userid);
			
			$like = array ();
		
			$order_by = array (
					$this->primary_key => 'DESC' 
			);
			$where = array('post_status'=>'A','posts.post_created_by'=>$userid,'post_by !='=>'admin');
			$groupby = "post_id";
			
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
			
			$totla_rows = $this->Mydb->get_num_join_rows ( $this->primary_key, $this->table, $where, null, null, null, $like, $groupby, $join  );

			
			$limit = 12;
			$page = post_value ( 'page' )?$post_value ( 'page' ):1;
			$offset = post_value ( 'page' )?((post_value ( 'page' )-1) * $limit):0;
			$offset = post_value ( 'offset' )?post_value ( 'offset' ):$offset;
			$next_offset = $offset+$limit;
			$next_set = ($totla_rows > $next_offset)?($offset+$limit):'';
			
			
			
			$data['offset'] = $offset;
			$data['next_set'] = $next_set;
			$select_array = array ('pos_posts.*');
			$data ['records'] = $this->Mydb->get_all_records ( $select_array, $this->table, $where, $limit, $offset, $order_by, $like, $groupby, $join );
			$data['page'] = $offset;
			
			if($userid == get_user_id())
			{
				$data['post_enable'] = 'Yes';
			}
			else
			{
				$data['post_enable'] = 'No';
			}
			
			
			$post_category = $this->Mydb->get_all_records('*',$this->blog_categorytable,array('blog_cat_status' => 'A'),'','',array('blog_cat_sequence'=>'ASC'));
			$category[''] = "Select Category"; 
			if(!empty($post_category))
			{
				foreach($post_category as $blogcat)
				{
					$category[$blogcat['blog_cat_id']] = $blogcat['blog_cat_name'];
				}
			}
			$data['post_category'] = $category;
			$data['userid'] = encode_value($userid);
			$data['show'] = post_value('show');
			$data['section'] = post_value('section');
			$html = get_template ( $this->folder . '/' . $this->module . '-blogs-list', $data );
			echo json_encode ( array (
					'status' => 'success',
					'html' => $html,
					'next_set' => $next_set,
			) );
			exit ();
		}
	}
	
	public function viewtags($userid =null)
	{
		$this->authentication->user_authentication();
		check_site_ajax_request();
		$userid = (post_value('userid'))?post_value('userid'):$userid;
		if($userid == null)
		{
			echo json_encode(array('status'=>'error','msg'=>'Invalid user'));
			exit();
		}
		else {
			
			$userid = decode_value($userid);
			
			$like = array ();
		
			$order_by = array (
					$this->primary_key => 'DESC' 
			);
			$where = array('post_status'=>'A','post_by !='=>'admin');
			$groupby = "post_id";
			
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
			$join [4] ['condition'] = "post_id = post_tag_post_id and post_tag_user_id = ".$userid;
			$join [4] ['type'] = "INNER";
			
			$totla_rows = $this->Mydb->get_num_join_rows ( $this->primary_key, $this->table, $where, null, null, null, $like, $groupby, $join  );

			
			$limit = 12;
			$page = post_value ( 'page' )?$post_value ( 'page' ):1;
			$offset = post_value ( 'page' )?((post_value ( 'page' )-1) * $limit):0;
			$offset = post_value ( 'offset' )?post_value ( 'offset' ):$offset;
			$next_offset = $offset+$limit;
			$next_set = ($totla_rows > $next_offset)?($offset+$limit):'';
			
			
			
			$data['offset'] = $offset;
			$data['next_set'] = $next_set;
			$select_array = array ('pos_posts.*');
			$data ['records'] = $this->Mydb->get_all_records ( $select_array, $this->table, $where, $limit, $offset, $order_by, $like, $groupby, $join );
			$data['page'] = $offset;
			
			if($userid == get_user_id())
			{
				$data['post_enable'] = 'Yes';
			}
			else
			{
				$data['post_enable'] = 'No';
			}
			
			
			$post_category = $this->Mydb->get_all_records('*',$this->blog_categorytable,array('blog_cat_status' => 'A'));
			$category[''] = "Select Category"; 
			if(!empty($post_category))
			{
				foreach($post_category as $blogcat)
				{
					$category[$blogcat['blog_cat_id']] = $blogcat['blog_cat_name'];
				}
			}
			$data['post_category'] = $category;
			$data['userid'] = encode_value($userid);
			$data['show'] = post_value('show');
			$data['section'] = post_value('section');
			$html = get_template ( $this->folder . '/' . $this->module . '-blogs-list', $data );
			echo json_encode ( array (
					'status' => 'success',
					'html' => $html,
					'next_set' => $next_set,
			) );
			exit ();
		}
	}
	
	public function post_likes($postid)
	{
		$this->authentication->user_authentication();
		$customer_id = get_user_id();
		check_site_ajax_request();
		$postid = decode_value(post_value('dataid'));
		if($postid == 'null' || $customer_id == null)
		{
			$result ['status'] = 'success';
			$result ['page_reload'] = 'Yes';
			$result ['message'] = '';
		}
		else {
			$data = $this->load_module_info ();
			if ($this->input->post ( 'action' ) == "likes") {
				
				$like_records = $this->Mydb->get_record('*',$this->post_likes,array('post_like_post_id'=>$postid,'post_like_user_id'=>$customer_id));
				
				if(count($like_records) == 0)
				{
					$insert_array = array (
							'post_like_user_id' => $customer_id,
							'post_like_post_id' => $postid,
							'post_like_created_on' => current_date (),
							'post_like_created_by' => get_user_id (),
							'post_like_created_ip' => get_ip () 
					);
					$insert_id = $this->Mydb->insert ( $this->post_likes, $insert_array );
					$counting = $this->Mydb->get_num_rows('*',$this->post_likes,array('post_like_post_id'=>$postid));
					#insert post notification
					$post_reuslt=$this->Mydb->get_record('post_id,post_created_by','posts',array('post_id'=>$postid));
						if($post_reuslt['post_created_by'] != get_user_id())
						{
							$customer_username=get_tag_username(get_user_id());						
							$message=$customer_username." likes your post";						
							$record = array(
								'notification_post_id'=>$postid,
								'notification_type'=>'like',
								'created_type'=>'E',
								'message_type'=>'N',
								'subject'=>$message,
								'message'=>$message,
								'private'=>0,
								'created_by'=>get_user_id(),
								'created_on'=>current_date(),				
								'ip_address'=>get_ip(),
								);
							$notification_id = post_notify($record);
						}
					#insert post notification
					$result ['status'] = 'success';
					$result ['msg'] = 'Unfollow';
					$result ['html'] = $counting;
				}
				else
				{
					$ids = array($like_records['post_like_id']);
					$search_array = array('post_like_user_id' => $customer_id,'post_like_post_id' => $postid);
					$this->Mydb->delete_where_in ( $this->post_likes, 'post_like_id', $ids, $search_array );
					$this->Mydb->delete ( 'post_notification', array('notification_type'=>'like','notification_post_id'=>$postid,'created_by'=>get_user_id()));
					$counting = $this->Mydb->get_num_rows('*',$this->post_likes,array('post_like_post_id'=>$postid));
					$result ['status'] = 'success';
					$result ['msg'] = 'Follow';
					$result ['html'] = $counting;
				}
				$counting = $this->Mydb->get_num_rows('*',$this->post_likes,array('post_like_post_id'=>$postid));
				
				$update_array = array(
					'post_likes' => thousandsCurrencyFormat($counting)
				);
				$this->Mydb->update ( $this->table, array ($this->primary_key => $postid ), $update_array );
			}
		}
		
		echo json_encode ( $result );
		exit ();
	}
	
	public function add_followers($userid)
	{
		$this->authentication->user_authentication();
		$customer_id = get_user_id();
		check_site_ajax_request();
		if($userid == 'null' || $customer_id == null)
		{
			$result ['status'] = 'success';
			$result ['page_reload'] = 'Yes';
			$result ['message'] = '';
		}
		else {
			$data = $this->load_module_info ();
			if ($this->input->post ( 'action' ) == "follow") {	
				$userid = decode_value($userid);
				$follow_records = $this->Mydb->get_record('*',$this->customer_followers,array('follow_user_id'=>$userid,'follow_customer_id'=>$customer_id));
				
				if(count($follow_records) == 0)
				{
					$insert_array = array (
							'follow_customer_id' => $customer_id,
							'follow_user_id' => $userid,
							'follow_created_on' => current_date (),
							'follow_created_by' => get_user_id (),
							'follow_created_ip' => get_ip () 
					);
					$insert_id = $this->Mydb->insert ( $this->customer_followers, $insert_array );
					//$counting = $this->Mydb->get_num_rows('*',$this->customer_followers,array('follow_customer_id'=>$customer_id));
                   // $counting_profile = $this->Mydb->get_num_rows('*',$this->customer_followers,array('follow_customer_id'=>$userid));
					if($insert_id>0)
					{
/*						 $follow_notify_record=array();
						$select_array=array('customer_first_name as customer_name');
 						$follow_user = $this->Mydb->get_record($select_array, $this->customers, array('customer_id'=>$customer_id) );
						$message = "follow you ".$follow_user['customer_name'];*/
							$customer_username=get_tag_username(get_user_id());						
							$message=$customer_username." started following you";						
							$follow_notify_record = array(
								'assigned_to'=>$userid,
								'notification_type'=>'follow',
								'created_type'=>'E',
								'message_type'=>'N',
								'subject'=>$message,
								'message'=>$message,
								'private'=>0,
								'created_by'=>get_user_id(),
								'created_on'=>current_date(),				
								'ip_address'=>get_ip(),
								); 					
						post_notify($follow_notify_record);#insert follow user						
					}
					$counting = count(get_followers_list($customer_id));
					$counting_following = count(get_following_list($customer_id));
					$counting_profile = count(get_followers_list($userid));
					$counting_profile_following = count(get_following_list($userid));
					
					$result ['status'] = 'success';
					$result ['msg'] = 'Unfollow';
					$result ['html'] = thousandsCurrencyFormat($counting);
					$result ['following_html'] = thousandsCurrencyFormat($counting_following);
                    $result ['profile_html'] = thousandsCurrencyFormat($counting_profile );
                    $result ['profile_following_html'] = thousandsCurrencyFormat($counting_profile_following );
				}
				else
				{
					$ids = array($follow_records['follow_id']);
					$search_array = array('follow_customer_id' => $customer_id,'follow_user_id' => $userid);
					$this->Mydb->delete_where_in ( $this->customer_followers, 'follow_id', $ids, $search_array );
					$this->Mydb->delete ( 'post_notification',array('created_by'=>$customer_id,'assigned_to' => $userid) );
					//$counting = $this->Mydb->get_num_rows('*',$this->customer_followers,array('follow_customer_id'=>$customer_id));
                   // $counting_profile = $this->Mydb->get_num_rows('*',$this->customer_followers,array('follow_customer_id'=>$userid));
					
					$counting = count(get_followers_list($customer_id));
					$counting_following = count(get_following_list($customer_id));
					$counting_profile = count(get_followers_list($userid));
					$counting_profile_following = count(get_following_list($userid));
					
					$result ['status'] = 'success';
					$result ['msg'] = 'Follow';
					$result ['html'] = thousandsCurrencyFormat($counting);
					$result ['following_html'] = thousandsCurrencyFormat($counting_following);
                    $result ['profile_html'] = thousandsCurrencyFormat($counting_profile );
                    $result ['profile_following_html'] = thousandsCurrencyFormat($counting_profile_following );
				}
			}
		}
		
		echo json_encode ( $result );
		exit ();
	}
	
	public function comments($postslug = null)
	{
		$this->authentication->user_authentication();
		//check_site_ajax_request();
		
		if($postslug == null)
		{
			echo json_encode(array('status'=>'error','msg'=>'Invalid user'));
			exit();
		}
		else {
			
 
			$join = "";		
			$join [0] ['select'] = "customer_id,customer_first_name,customer_last_name,customer_email,customer_photo,customer_type,company_name";
			$join [0] ['table'] = $this->customers;
			$join [0] ['condition'] = "post_comment_user_id = customer_id";
			$join [0] ['type'] = "LEFT";
			$join [1] ['select'] = "post_title,post_slug,post_id";
			$join [1] ['table'] = $this->table;
			$join [1] ['condition'] = "post_comment_post_id = post_id";
			$join [1] ['type'] = "INNER";
			
			$order_by = array('post_comment_created_on'=>'DESC');
			$where = array('post_slug'=>$postslug,'(post_comment_parent IS NULL or post_comment_parent = 0)'=>null);
			$groupby = array();
			$like = array();
			
			$totla_rows = $this->Mydb->get_num_join_rows ( 'post_comment_id', $this->post_comments, $where, null, null, null, $like, $groupby, $join  );
			
			
			$limit = 10;
			$page = (post_value ( 'page' )>0)?post_value ( 'page' ):1;
			$offset = (post_value ( 'page' ) >0)?((post_value ( 'page' )-1) * $limit):0;
			$offset = post_value ( 'offset' )?post_value ( 'offset' ):$offset;
			$next_offset = $offset+$limit;
			$next_set = ($totla_rows > $next_offset)?($offset+$limit):'';
			
			
			
			$data['offset'] = $offset;
			$data['next_set'] = $next_set;
			$data ['records'] = $this->Mydb->get_all_records ( $this->post_comments.'.*', $this->post_comments, $where, $limit, $offset, $order_by, $like, $groupby, $join );
			$data['page'] = $offset;


			$data['show'] = post_value('show');
			$html = get_template ( $this->folder . '/' . $this->module . '-blogs-commentlist', $data );

			echo json_encode ( array (
					'status' => 'success',
					'html' => $html,
					'next_set' => $next_set,
			) );
			exit ();
			
		}
	}
	
	public function addcomments()
	{
		$this->authentication->user_authentication();
		$customer_id = get_user_id();
		check_site_ajax_request();
		$postid = decode_value(post_value('post_record'));
		if($postid == 'null' || $customer_id == null)
		{
			$result ['status'] = 'success';
			$result ['page_reload'] = 'Yes';
			$result ['message'] = '';
		}
		else 
		{
			$data = $this->load_module_info ();
			if ($this->input->post ( 'action' ) == "comment") 
			{
				$this->form_validation->set_rules ( 'comments', 'lang:comments', 'required|xss_clean|trim' );
				if ($this->form_validation->run () == TRUE) 
				{
				
					$insert_array = array (
							'post_comment_user_id' => $customer_id,
							'post_comment_post_id' => $postid,
							'post_comment_message' => json_encode(get_censored_string($this->input->post('comments'))),
							'post_comment_parent' => 0,
							'post_comment_created_on' => current_date (),
							'post_comment_created_by' => get_user_id (),
							'post_comment_created_ip' => get_ip () 
					);
					$insert_id = $this->Mydb->insert ( $this->post_comments, $insert_array );
					$post_reuslt=$this->Mydb->get_record('post_id,post_created_by','posts',array('post_id'=>$postid));
						if($post_reuslt['post_created_by'] != get_user_id())
						{					
							$customer_username=get_tag_username(get_user_id());						
							$message=$customer_username." commented on your post";					
							#insert post notification
							$record = array(
								'notification_post_id'=>$postid,
								'notification_type'=>'comment',
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
						}				
					$counting = $this->Mydb->get_num_rows('*',$this->post_comments,array('post_comment_post_id'=>$postid));
					$result ['status'] = 'success';
					$result ['message'] = 'Success';
					$result ['html'] = thousandsCurrencyFormat($counting);
				}
				else 
				{
					$result ['status'] = 'error';
					$result ['message'] = validation_errors ();
				}
			}
			else if ($this->input->post ( 'action' ) == "updatecmt") 
			{
				$commentid = decode_value(post_value('cmt_record'));
				$this->form_validation->set_rules ( 'comment_data', 'lang:comments', 'required|xss_clean|trim' );
				if ($this->form_validation->run () == TRUE) 
				{
					$update_array = array (
						'post_comment_user_id' => $customer_id,
						'post_comment_post_id' => $postid,
						'post_comment_message' => json_encode(get_censored_string($this->input->post('comment_data'))),
						'post_comment_parent' => 0,
					);
					$where_array=array('post_comment_id'=>$commentid);
					$insert_id = $this->Mydb->update ( $this->post_comments,$where_array, $update_array );
/*					print_r($update_array);
					echo $this->db->last_query();
					exit;*/
					$counting =$this->Mydb->get_num_rows('*',$this->post_comments,array('post_comment_post_id'=>$postid));
					$result ['status'] = 'success';
					$result ['message'] = 'Success';
					$result ['html'] = thousandsCurrencyFormat($counting);
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
				$result ['message'] = "Something Wrong try again later";
			}
		}
		
		echo json_encode ( $result );
		exit ();
	}
	
	public function message($userid =null)
	{
		$customer_id = get_user_id();
		check_site_ajax_request();
		$this->load->view();
	}
	public function notification($userid =null)
	{
		$this->authentication->user_authentication();
		$data=$limit=$offset=$like=$groupby=$join=array();
		$data = $this->load_module_info ();

		$customer_id = get_user_id();
		$select_array=array('post_notification.*');
		$where=array('assigned_to'=>$customer_id);
		$order_by=array('created_on'=>'desc','open_status'=>'desc');
		$join [0] ['select'] = "customer_id,customer_first_name,customer_last_name,customer_username,customer_type,company_name";
		$join [0] ['table'] = $this->customers;
		$join [0] ['condition'] = "created_by = customer_id";
		$join [0] ['type'] = "LEFT";		
		$join [1] ['select'] = "p.post_id,p.post_slug,p.post_title";
		$join [1] ['table'] = "posts as  p";
		$join [1] ['condition'] = "p.post_id = notification_post_id";
		$join [1] ['type'] = "LEFT";
		$data ['notification'] = $this->Mydb->get_all_records ( $select_array, 'post_notification', $where, $limit, $offset, $order_by, $like, $groupby, $join );
		//echo $this->db->last_query();
		
		//echo "<pre>";
		//print_r($data);		
        $this->layout->display_site($this->folder . 'index',$data);
	}	
	public function pull_post_log()
	{
		$this->authentication->user_authentication();
		$result=array();

		$customer_id = get_user_id();
		check_site_ajax_request();

			$counting = post_notify_count();
			$msg_counting = message_notify_count();
			if($counting >0 || $msg_counting >0 )
			{
						$result ['status'] = 'success';
						$result ['count'] = ($counting >0) ? $counting : '';
						$result ['msg_count'] = ($msg_counting >0) ? $msg_counting : '';
			}
			else
			{
						$result ['status'] = 'error';
						$result ['count'] =  '';
						$result ['msg_count'] =  '';	
			}
		
		echo json_encode ( $result );
		exit ();
	}
	
	public function getstates()
	{
		$result=array();
		check_site_ajax_request();
		if($this->input->post('country') !='')
		{
			$result['message'] = get_all_states(array('intCountryId'=>$this->input->post('country')),'','class="form-control" id="customer_state" onchange="get_city()"');
		}
		echo json_encode ( $result );
		exit ();
	}
	
	public function getcities()
	{
		$result=array();
		check_site_ajax_request();
		if($this->input->post('state') !='')
		{
			$result['message'] = get_all_cities(array('city_state'=>$this->input->post('state')),'','class="form-control" id="customer_city"');
		}
		echo json_encode ( $result );
		exit ();
	}

	public function notify_mark_read()
	{
		$this->authentication->user_authentication();
		$result=array();
		$customer_id = get_user_id();
		$mark_read_type=$this->input->post('data_type');
		if($mark_read_type == "notification" )
		{
				$record = array('open_status'=>'Y');
				$this->Mydb->update('post_notification',array('assigned_to'=>$customer_id, 'open_status'=>'N'),$record);
				$result ['status'] = 'success';
				$result ['message'] =  '';	
		}
		else if($mark_read_type == "message" )
		{
				$record = array('open_status'=>'Y');
				$this->Mydb->update('notification_message',array('assigned_to'=>$customer_id, 'open_status'=>'N'),$record);			
				$result ['status'] = 'success';
				$result ['message'] =  '';	
		}
		else
		{
					$result ['status'] = 'error';
					$result ['message'] =  '';	
		}
		
		echo json_encode ( $result );
		exit ();
	}
	public function get_followers_profile($userid)
	{
		$this->authentication->user_authentication();
		check_site_ajax_request();
		$action=$this->input->post('action');
		$customer_id=decode_value($userid);
		$following_records = get_following_list($customer_id);
		$data['title'] = "Followers";
		$data['results'] = $following_records;
		$data['customer_id'] = $customer_id;
			$html = get_template ( $this->folder . '/' . $this->module . '-followers-popup', $data );

			echo json_encode ( array (
					'status' => 'success',
					'html' => $html,
					'count' => count($following_records),
			) );
			exit ();
	}	
	public function get_following_profile($userid)
	{
		$this->authentication->user_authentication();
		check_site_ajax_request();
		$action=$this->input->post('action');
		$customer_id=decode_value($userid);
		$follow_records = get_followers_list($customer_id);
		$data['title'] = "Following";
		$data['results'] = $follow_records;
		$data['customer_id'] = $customer_id;
			$html = get_template ( $this->folder . '/' . $this->module . '-following-popup', $data );

			echo json_encode ( array (
					'status' => 'success',
					'html' => $html,
					'count' => count($follow_records),
			) );
			exit ();		
	}
	public function favorlist()
	{
		$this->authentication->user_authentication();
		$data = $this->load_module_info ();	
		$this->layout->display_site ( $this->folder . $this->module . "-favor-list", $data );
	}	
	public function favor_ajax_pagination()
	{
		$this->authentication->user_authentication();
		$data = $this->load_module_info ();	
		$customer_id = get_user_id();
		check_site_ajax_request();

		$like = array ();
	
		$order_by = array ('post_favor.post_favor_id'=>'DESC',
				$this->primary_key => 'DESC' 
		);
		$where = array('post_status'=>'A','post_by !='=>'admin','post_favor.post_favor_user_id'=>$customer_id);
		$groupby = "post_id";
		
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
		$select_array = array ('pos_posts.*');
		$data ['records'] = $this->Mydb->get_all_records ( $select_array, $this->table, $where, $limit, $offset, $order_by, $like, $groupby, $join );
		$data['page'] = $offset;

		$data['show'] = post_value('show');
		$data['section'] = post_value('section');
		$html = get_template ( $this->folder . '/' . $this->module . '-favor-ajax-list', $data );
		echo json_encode ( array (
				'status' => 'success',
				'html' => $html,
				'next_set' => $next_set,
		) );
		exit ();
	}		
	public function post_favor($postid)
	{
		$this->authentication->user_authentication();
		$customer_id = get_user_id();
		check_site_ajax_request();
		$postid = decode_value(post_value('dataid'));
		if($postid == 'null' || $customer_id == null)
		{
			$result ['status'] = 'success';
			$result ['page_reload'] = 'Yes';
			$result ['message'] = '';
		}
		else {
			$data = $this->load_module_info ();
			if ($this->input->post ( 'action' ) == "favor") {
				
				$favor_records = $this->Mydb->get_record('post_favor_id',$this->post_favor,array('post_favor_post_id'=>$postid,'post_favor_user_id'=>$customer_id));
				
				if(count($favor_records) == 0)
				{
					$insert_array = array (
							'post_favor_user_id' => $customer_id,
							'post_favor_post_id' => $postid,
							'post_favor_created_on' => current_date (),
							'post_favor_created_by' => get_user_id (),
							'post_favor_created_ip' => get_ip () 
					);
					$insert_id = $this->Mydb->insert ( $this->post_favor, $insert_array );
					$counting = $this->Mydb->get_num_rows('*',$this->post_favor,array('post_favor_post_id'=>$postid));

					$result ['status'] = 'success';
					$result ['msg'] = 'Favor';
					$result ['html'] = $counting;
				}
				else
				{
					$ids = array($favor_records['post_favor_id']);
					$search_array = array('post_favor_user_id' => $customer_id,'post_favor_post_id' => $postid);
					$this->Mydb->delete_where_in ( $this->post_favor, 'post_favor_id', $ids, $search_array );
					$counting = $this->Mydb->get_num_rows('post_favor_id',$this->post_favor,array('post_favor_id'=>$postid));
					$result ['status'] = 'success';
					$result ['msg'] = 'Unfavor';
					$result ['html'] = $counting;
				}

			}
		}
		
		echo json_encode ( $result );
		exit ();
	}
	public function deletepostcomment($comment_id=null)
	{
		$this->authentication->user_authentication();
		$result=array();
		check_site_ajax_request();
		$this->authentication->user_authentication();
		$data = $this->load_module_info ();
		if ($this->input->post ( 'action' ) == "Delete") 
		{
			$_POST['comment_id']=$comment_id;
			$this->form_validation->set_rules('comment_id','lang:comment_id','required|trim');			
			if ($this->form_validation->run () == TRUE) 
			{
				$postid = decode_value(post_value ( 'dataid' ));
				$commentid = decode_value( $comment_id);
				$this->Mydb->delete_where_in($this->post_comments,'post_comment_parent',$commentid,array());
				$this->Mydb->delete_where_in($this->post_comments,'post_comment_id',$commentid,array());

				// $this->session->set_flashdata ( 'admin_success', sprintf ( $this->lang->line ( 'success_message_delete' ), $this->post_comment_module_label ) );

				$counting = $this->Mydb->get_num_rows('*',$this->post_comments,array('post_comment_post_id'=>$postid));
				$result ['status'] = 'success';
				$result ['html'] = thousandsCurrencyFormat($counting);
				$result ['message'] = sprintf ( $this->lang->line ('success_message_delete'), $this->post_comment_module_label );
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

	/* this method used to common module labels */
	private function load_module_info() {
		$data = array ();
		$data ['module_label'] = $this->module_label;
		$data ['module_labels'] = $this->module_labels;
		$data ['module'] = 'myprofile';
		return $data;
	}
}
?>