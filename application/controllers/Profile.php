<?php
/**************************
 Project Name	: Bloggotoweb
Description		: Device Udpate

***************************/
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';
class Profile extends REST_Controller {
   
	function __construct() {
		parent::__construct ();
		$this->load->library ( 'form_validation' );
		$this->form_validation->set_error_delimiters ( '<p>', '</p>' );
        $this->table = "posts";
		$this->customer_followers = "customers_followers";
		$this->blog_categorytable = "blog_category";
		$this->customers = "customers";
		$this->customers_followers = "customers_followers";
		$this->products = "products";
		$this->post_likes = "post_likes";
		$this->post_favor = "post_favor";
		$this->post_tags = "post_tags";
		$this->post_comments = "post_comments";
		$this->professions = "professions";
		$this->primary_key='post_id';
		$this->product_primary_key = "product_primary_id";
		$this->load->library('common');
		$this->load->library(array('mcurl','curl'));
		$this->load->helper('security');
		$this->load->helper('products');
	}
	
	
	function getDetails_get() {
		$result ['status'] = 'error';
		$userid = $this->input->get('userid');
		$customer_id = $this->input->get('customerid');
		if($userid != '') {
			$info = $this->Mydb->get_record('*',$this->customers,array('customer_username'=>$userid));
			
			if(!empty($info)) {
				$post_infos = $this->Mydb->get_all_records('COUNT(post_id) as postcount, post_type',$this->table,array('post_created_by'=>$info['customer_id'],'post_status'=>'A'),$limit = '', $offset = '', $order = '', $like = '', $groupby = array('post_type'));
			
			
				$follow_records = get_followers_list($customer_id);
				$follow_list = array();
				if(!empty($follow_records))
				{
					foreach($follow_records as $follows) {
						$follow_list[] = $follows['follow_user_id'];
					}
				} 
				
				$follow_records = get_followers_list($info['customer_id']);
				$following_records = get_following_list($info['customer_id']);
			
				
				$following_count = count($follow_records);
				$follow_count = count($following_records);
				if($info['customer_photo'] != '') {
					$info['customer_photo'] = media_url(). $this->lang->line('customer_image_folder_name'). $info['customer_photo'];
				}
				if($info['customer_prof_profession'] != '') {
					$prof = explode(',',$info['customer_prof_profession']);
					$info['customer_prof_profession'] = $prof;
				} else {
					$info['customer_prof_profession'] = [];
				}
				$data['info'] = $info;
				$data['post_infos'] = $post_infos;
				$data['follow_count'] = thousandsCurrencyFormat($follow_count);
				$data['follow_list'] = $follow_list;
				$data['following_count'] = thousandsCurrencyFormat($following_count);
				$result ['status'] = 'success';
				$result['data'] = $data;
			} else {
				$result ['message'] = 'invalid user';
			}
		} else {
			$result ['message'] = 'invalid user';
		}
		echo json_encode ( $result );
		exit ();
	}
	
	function getUserDetails_get() {
		$result ['status'] = 'error';
		$userid = $this->input->get('userid');
		if($userid !='') {
			$info = $this->Mydb->get_record('*',$this->customers,array('customer_id'=>$userid));
			
			if($info['customer_photo'] != '') {
				$info['customer_photo'] = media_url(). $this->lang->line('customer_image_folder_name'). $info['customer_photo'];
			}
			if($info['customer_prof_profession'] != '') {
				$prof = explode(',',$info['customer_prof_profession']);
				$info['customer_prof_profession'] = $prof;
			} else {
				$info['customer_prof_profession'] = [];
			}
			
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

			$where_array = array('id !='=>'');
			$countries_result=$this->Mydb->get_all_records('id,varName','countries',$where_array,'','',array('varName'=>"ASC"));
			$countries =array(''=>get_label('select_country'));
			if(!empty($countries_result))
			{
				foreach($countries_result as $value)
				{
					$countries[$value['id']] = stripslashes($value['varName']);
				}
			}
			$data['countries'] = $countries;
			
			$states_result =$this->Mydb->get_all_records('id,varStateName,intCountryId','states','','','',array('varStateName'=>"ASC"));
			$states = [];
			if(!empty($states_result))
			{
				foreach($states_result as $value)
				{
					$states[] = array('id'=>$value['id'], 'name'=>stripslashes($value['varStateName']),'countryid'=>$value['intCountryId']);
				}
			}
			$data['states'] = $states;
			
			$cities_result =$this->Mydb->get_all_records('city_id, city_name, city_state','cities','','','',array('city_name'=>"ASC"));
			$cities = [];
			if(!empty($cities_result))
			{
				foreach($cities_result as $value)
				{
					$cities[] = array('id'=>$value['city_id'], 'name'=>stripslashes($value['city_name']),'stateid'=>$value['city_state']);
				}
			}
			$data['cities'] = $cities;
			
			$result ['status'] = 'success';
			$result['data'] = $data;
		} else {
			$result ['msg'] = 'invalid user';
		}
		echo json_encode ( $result );
		exit ();
	}
	
	public function viewblogs_post()
	{
		$userid = ($this->input->post('userid'))?post_value('userid'): null;
		if($userid == null)
		{
			echo json_encode(array('status'=>'error','msg'=>'Invalid user'));
			exit();
		}
		else {
			$like = array ();
			$order_by = array (
				$this->primary_key => 'DESC' 
			);
			$where = array('post_status'=>'A','posts.post_created_by'=>$userid,'post_by !='=>'admin');
			$groupby = "post_id";
			
			$type = $this->input->post ( 'type' );
			if($type !='' && $type == 'blogs')
			{
				$where = array_merge ( $where, array (
					"post_type !=" => 'picture', 
					"post_type !=" => 'video', 
				));
			}
			else if($type !='' && $type == 'pictures')
			{
				$where = array_merge ( $where, array (
					"(post_type = 'picture')" => null,
				));
			}
			else if($type !=''&& $type == 'video')
			{
				$where = array_merge ( $where, array (
					"(post_type = 'video')" => null,
				));
			} 
			else {
				if ($type != "") {
					$where = array_merge ( $where, array (
							"post_type" => $type 
					));
				}
			}
			if ($this->input->post( 'paging' ) == "") {
				$search_field = $this->input->post ( 'search_field' );
				$order_field = $this->input->post ( 'order_field' );
			}
			
		
			if ($search_field != "") {
				$where = array_merge ( $where, array (
						"post_category" => $search_field 
				));
			}
			
			
			
			/* add sort bu option */
			if ($order_field != "") {
				if($order_field == 'followers' && $userid !='')
				{
					$cwhere = array("follow_customer_id"=>$userid);
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
			
			$join [1] ['select'] = "customer_id,customer_first_name,customer_last_name,customer_email,customer_photo,customer_type,company_name,customer_celebrity_badge,customer_username";
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
			$page = $this->input->post ( 'page' )?$this->input->post ( 'page' ):1;
			$offset = $this->input->post ( 'page' )?(($this->input->post ( 'page' )-1) * $limit):0;
			$offset = $this->input->post ( 'offset' )?$this->input->post ( 'offset' ):$offset;
			$next_offset = $offset+$limit;
			$next_set = ($totla_rows > $next_offset)?($offset+$limit):'';
			
			
			
			$data['offset'] = $offset;
			$data['next_set'] = $next_set;
			$select_array = array ("pos_posts.*,(SELECT group_concat(post_media_filename) FROM pos_post_media WHERE post_media_post_id=post_id) as post_photo");
			$records = $this->Mydb->get_all_records ( $select_array, $this->table, $where, $limit, $offset, $order_by, $like, $groupby, $join );
			$data ['records'] = $records;
			if(!empty($records)) {
				$i = 0;
				foreach($records as $record) {
					$data ['records'][$i] = $record;
					if($record['customer_photo'] !='')
					{ 
						$photo=media_url().$this->lang->line('customer_image_folder_name').$record['customer_photo']; 
					} 
					else 
					{ 
						$photo=media_url().$this->lang->line('customer_image_folder_name')."default.png"; 
					} 
					$data['records'][$i]['customer_photo'] = $photo;
					
					if($record['favoruser'] != '') {
						$favoruser = explode(', ',$record['favoruser']);
					} else {
						$favoruser = array();
					}
					$data['records'][$i]['favoruser'] = array_values(array_unique(array_filter($favoruser, create_function('$value', 'if($value !== "") { return trim($value); }' ))));
					
					if($record['lkesuser'] != '') {
						$lkesuser = explode(', ',$record['lkesuser']);
					} else {
						$lkesuser = array();
					}
					$data['records'][$i]['lkesuser'] = array_values(array_unique(array_filter($lkesuser, create_function('$value', 'if($value !== "") { return trim($value); }' ))));
					
					$image_url = array();
					if($record['post_photo'] !='') {
						$postimages=explode(",", $record['post_photo']);
						if(!empty($postimages))
						{
							
							foreach ($postimages as $key => $postimage) 
							{
								$image_url[] = media_url().$this->lang->line('post_photo_folder_name').$postimage; 
							}
						}
					}
					$data['records'][$i]['post_photo'] = $image_url;
					$tags_post = array();
					if(!empty($record['post_tag_names'])) { 
						$tags = array_unique(explode(',',$record['post_tag_names'])); 
						$tag_user_id = array_unique(explode(',',$record['post_tag_ids'])); 
						foreach($tags as $tkey=>$tag)
						{
							$username = get_tag_username($tag_user_id[$tkey]);
							if($username) {
								$tags_post[] = array( 'username' => $username, 'tag' => $tag );
							}
						}
					}
					$data['records'][$i]['post_tag_names'] = $tags_post;
					
					$video = '';
					if($record['post_type'] == 'video' && $record['post_video'] !='') {
						$video = media_url().$this->lang->line('post_video_folder_name').$record['post_video'];
					}
					$data['records'][$i]['post_video'] = $video;
					$youtube_url = '';
					if($record['post_embed_video_url'] !='') {
						$youtube_url = addhttp($record['post_embed_video_url']);
					}
					$data['records'][$i]['post_embed_video_url'] = $youtube_url;
					$data['records'][$i]['post_description'] = substr_close_tags(json_decode($record['post_description']));
					$i++;
					
				}
			}
			
			$data['page'] = $offset;
		
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
			echo json_encode ( array (
				'status' => 'success',
				'data' => $data,
				'next_set' => $next_set,
			) );
			exit ();
		}
	}
	
	public function viewProducts_get() {
		$userid = $this->input->get('userid');
		if($userid) {
			$where = array('product_status'=>'A','product_is_display'=>1,'product_customer_id'=>$userid);
			$like = $order_by = array();

			$join = "";
			
			$join [0] ['select'] = "customer_id,customer_first_name,customer_last_name,customer_username,customer_email";
			$join [0] ['table'] = "pos_customers";
			$join [0] ['condition'] = "product_customer_id = customer_id";
			$join [0] ['type'] = "INNER";
			/* not in product availability id condition  */
			$join [1] ['select'] = "pro_cate_primary_id,pro_cate_id,pro_cate_name";
			$join [1] ['table'] = "pos_product_categories";
			$join [1] ['condition'] = "product_category_id = pro_cate_primary_id";
			$join [1] ['type'] = "LEFT";	
			$groupby = "product_primary_id";

			$totla_rows = $this->Mydb->get_num_join_rows ( $this->product_primary_key, $this->products, $where, null, null, null, $like, $groupby, $join );


			$limit = 12;
			$page = post_value ( 'page' )?post_value ( 'page' ):1;
			$offset = post_value ( 'page' )?((post_value ( 'page' )-1) * $limit):0;
			$offset = post_value ( 'offset' )?post_value ( 'offset' ):$offset;
			$next_offset = $offset+$limit;
			$next_set = ($totla_rows > $next_offset)?($offset+$limit):'';

			$data['offset'] = $offset;

			
			/* pagination part end */
			
			$select_array = array ($this->products.'.*');
			$data ['records'] = $this->Mydb->get_all_records ( $select_array, $this->products, $where, $limit, $offset, $order_by, $like,$groupby, $join );
			
			$current_records = (($page-1)*$limit)+count($data ['records']);
			$data['current_records'] = $current_records;
			$data['total_rows'] = $totla_rows;
			$data['page'] = $page;
			$data['next_set'] = $next_set;

			$page_relod = ($totla_rows > 0 && $offset > 0 && empty ( $data ['records'] )) ? 'Yes' : 'No';
			echo json_encode ( array (
					'status' => 'success',
					'offset' => $offset,
					'data' => $data 
			) );
			exit ();
		} else {
			echo json_encode(array('status'=>'error','msg'=>'Invalid user'));
			exit();
		}
	}
	
	public function viewServices_get() {
		$userid = $this->input->get('userid');
		if($userid) {
			$where = array('ser_status'=>'A','ser_customer_id'=>$userid);
			//$where = array('product_customer_id'=>$userid);

			$like = $order_by = array();

			$join = "";
			
			$join [0] ['select'] = "customer_id,customer_first_name,customer_last_name,customer_username,customer_email";
			$join [0] ['table'] = "pos_customers";
			$join [0] ['condition'] = "ser_customer_id = customer_id";
			$join [0] ['type'] = "INNER";
			/* not in product availability id condition  */
			$join [1] ['select'] = "ser_cate_primary_id,ser_cate_id,ser_cate_name";
			$join [1] ['table'] = "service_categories";
			$join [1] ['condition'] = "ser_category = ser_cate_primary_id";
			$join [1] ['type'] = "LEFT";	

			$join [2] ['select'] = "group_concat(ser_gallery_image,'~') as galleryimages";
			$join [2] ['table'] = 'service_gallery';
			$join [2] ['condition'] = "service_gallery.ser_gallery_ser_primary_id = ser_primary_id";
			$join [2] ['type'] = "LEFT";

			$groupby = "ser_primary_id";

			$totla_rows = $this->Mydb->get_num_join_rows ( 'ser_primary_id', 'services', $where, null, null, null, $like, $groupby, $join );


			$limit = 12;
			$page = post_value ( 'page' )?post_value ( 'page' ):1;
			$offset = post_value ( 'page' )?((post_value ( 'page' )-1) * $limit):0;
			$offset = post_value ( 'offset' )?post_value ( 'offset' ):$offset;
			$next_offset = $offset+$limit;
			$next_set = ($totla_rows > $next_offset)?($offset+$limit):'';

			$data['offset'] = $offset;

			
			/* pagination part end */
			
			$select_array = array ('services.*');
			$records = $this->Mydb->get_all_records ( $select_array, 'services', $where, $limit, $offset, $order_by, $like,$groupby, $join );
			$data ['records'] = $records;
			$current_records = (($page-1)*$limit)+count($data ['records']);
			$data['current_records'] = $current_records;
			$data['total_rows'] = $totla_rows;
			$data['page'] = $page;
			
			
			if(!empty($records)) {
				$i = 0;
				foreach($records as $record) {
					$data ['records'][$i] = $record;	
					$image_url = array();
					if($record['galleryimages'] !='') {
						$gallery = explode('~',$record['galleryimages']); 
						if(!empty($gallery))
						{
							foreach ($gallery as $key => $postimage) 
							{
								$image_url[] = media_url(). $this->lang->line('service_gallery_image_folder_name')."/".$postimage;
							}
						}
					} else {
						$image_url[] = media_url().$this->lang->line('post_photo_folder_name')."default.png";
					}
					$data['records'][$i]['galleryimages'] = $image_url;
					$discount = find_discount($record['ser_price'],$record['ser_discount_price'],$record['ser_discount_start_date'],$record['ser_discount_end_date']); 
					$data['records'][$i]['discount'] = $discount;
					$data['records'][$i]['ser_description'] = substr_close_tags(json_decode($record['ser_description']));
					$i++;
				}
			}
			
			echo json_encode ( array (
				'status' => 'success',
				'offset' => $offset,
				'data' => $data,
			) );
			exit ();
		} else {
			echo json_encode(array('status'=>'error','msg'=>'Invalid user'));
			exit();
		}	
	}
	
	function userFollow_post() {
		$userid = $this->input->post('userid');
		$customer_id = $this->input->post('customerid');
		if($userid && $customer_id) {
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
				if($insert_id>0)
				{
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
				$this->Mydb->delete ( 'post_notification',array('created_by'=>$customer_id,'assigned_to' => $userid));
				
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
			echo json_encode ( $result);
			exit ();
		} else {
			echo json_encode(array('status'=>'error','msg'=>'Invalid user'));
			exit();
		}
	}
	
	function favorList_get() {
		$customer_id = $this->input->get('userid');
		$offset = $this->input->post('offset');
		if($customer_id) {
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
			$select_array = array ("pos_posts.*,(SELECT group_concat(post_media_filename) FROM pos_post_media WHERE post_media_post_id=post_id) as post_photo");
			$records = $this->Mydb->get_all_records ( $select_array, $this->table, $where, $limit, $offset, $order_by, $like, $groupby, $join );
			$data ['records'] = [];
			if(!empty($records)) {
				$i = 0;
				foreach($records as $record) {
					$data ['records'][$i] = $record;
					if($record['customer_photo'] !='')
					{ 
						$photo=media_url().$this->lang->line('customer_image_folder_name').$record['customer_photo']; 
					} 
					else 
					{ 
						$photo=media_url().$this->lang->line('customer_image_folder_name')."default.png"; 
					} 
					$data['records'][$i]['customer_photo'] = $photo;
					
					if($record['favoruser'] != '') {
						$favoruser = explode(', ',$record['favoruser']);
					} else {
						$favoruser = array();
					}
					$data['records'][$i]['favoruser'] = array_values(array_unique(array_filter($favoruser, create_function('$value', 'if($value !== "") { return trim($value); }' ))));
					
					if($record['lkesuser'] != '') {
						$lkesuser = explode(', ',$record['lkesuser']);
					} else {
						$lkesuser = array();
					}
					$data['records'][$i]['lkesuser'] = array_values(array_unique(array_filter($lkesuser, create_function('$value', 'if($value !== "") { return trim($value); }' ))));
					
					$image_url = array();
					if($record['post_photo'] !='') {
						$postimages=explode(",", $record['post_photo']);
						if(!empty($postimages))
						{
							
							foreach ($postimages as $key => $postimage) 
							{
								$image_url[] = media_url().$this->lang->line('post_photo_folder_name').$postimage; 
							}
						}
					}
					$data['records'][$i]['post_photo'] = $image_url;
					$tags_post = array();
					if(!empty($record['post_tag_names'])) { 
						$tags = array_unique(explode(',',$record['post_tag_names'])); 
						$tag_user_id = array_unique(explode(',',$record['post_tag_ids'])); 
						foreach($tags as $tkey=>$tag)
						{
							$username = get_tag_username($tag_user_id[$tkey]);
							if($username) {
								$tags_post[] = array( 'username' => $username, 'tag' => $tag );
							}
						}
					}
					$data['records'][$i]['post_tag_names'] = $tags_post;
					
					$video = '';
					if($record['post_type'] == 'video' && $record['post_video'] !='') {
						$video = media_url().$this->lang->line('post_video_folder_name').$record['post_video'];
					}
					$data['records'][$i]['post_video'] = $video;
					$youtube_url = '';
					if($record['post_embed_video_url'] !='') {
						$youtube_url = addhttp($record['post_embed_video_url']);
					}
					$data['records'][$i]['post_embed_video_url'] = $youtube_url;
					$data['records'][$i]['post_description'] = substr_close_tags(json_decode($record['post_description']));
					$i++;
					
				}
			}
			
			
			$data['page'] = $offset;
			$data['section'] = post_value('section');
			$data['status'] = 'success';
			$data['next_set'] = $next_set;
			echo json_encode(array($data));
			exit;
		} else {
			echo json_encode(array('status'=>'error','msg'=>'Invalid user'));
			exit();
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
	
	function updateInfo_post() {
		$this->form_validation->set_rules ( 'customer_country', 'lang:customer_country', 'required' );
		$this->form_validation->set_rules ( 'customer_first_name', 'lang:customer_first_name', 'required' );
		$this->form_validation->set_rules ( 'customer_phone', 'lang:customer_phone', 'trim|max_length[' . get_label ( 'phone_max_length' ) . ']' );
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
				'customer_first_name' => $this->input->post ( 'customer_first_name' ),
				'customer_last_name' => $this->input->post ( 'customer_last_name' ),
				'customer_phone'=>$this->input->post ( 'customer_phone' ),
				'customer_birthdate'=>($this->input->post('customer_birthdate') !='' && $this->input->post('customer_birthdate') !='0000-00-00' && $this->input->post('customer_birthdate') != '1970-01-01')?date('Y-m-d',strtotime($this->input->post ( 'customer_birthdate' ))):'',
				'customer_gender'=>$this->input->post ( 'customer_gender' ),
				'customer_city'=>$this->input->post ( 'customer_city' ),
				'customer_state'=>$this->input->post ( 'customer_state' ),
				'customer_country'=>$this->input->post ( 'customer_country' ),
				'customer_postal_code'=>$this->input->post ( 'customer_postal_code' ),
				'customer_notes'=>$this->input->post ( 'customer_notes' ),
				'customer_hobbies'=>$this->input->post ( 'customer_hobbies' ),
				'customer_maritial_status'=>$this->input->post ( 'customer_maritial_status' ),
				'customer_facebook_link'=>$this->input->post ( 'customer_facebook_link' ),
				'customer_instagram_link'=>$this->input->post ( 'customer_instagram_link' ),
				'customer_twitter_link'=>$this->input->post ( 'customer_twitter_link' ),
				'customer_youtube_link'=>$this->input->post ( 'customer_youtube_link' ),
				'customer_linkedin_link'=>$this->input->post ( 'customer_linkedin_link' ),
				'customer_fav_color'=>$this->input->post ( 'customer_fav_color' ),
				'customer_fav_brand'=>$this->input->post ( 'customer_fav_brand' ),
				'customer_fav_place'=>$this->input->post ( 'customer_fav_place' ),
				'customer_fav_celebrates'=>$this->input->post ( 'customer_fav_celebrates' ),
				'customer_fav_sports'=>$this->input->post ( 'customer_fav_sports' ),
				'customer_fav_movie'=>$this->input->post ( 'customer_fav_movie' ),
				'customer_fav_food'=>$this->input->post ( 'customer_fav_food' ),
				'customer_fav_music'=>$this->input->post ( 'customer_fav_music' ),
				'customer_fav_book'=>$this->input->post ( 'customer_fav_book' ),
				'customer_fav_author'=>$this->input->post ( 'customer_fav_author' ),
				'customer_fav_drink'=>$this->input->post ( 'customer_fav_drink' ),
				'customer_fav_things'=>$this->input->post ( 'customer_fav_things' ),
				'customer_private'=>$this->input->post ( 'customer_private' ),
				'branches'=>$this->input->post ( 'branches' ),
				'is_adult_only'=>$this->input->post ( 'is_adult_only' ),
				'business_establishment'=>$this->input->post ( 'business_establishment' ),
				'customer_notes'=>$this->input->post ( 'customer_notes' ),
				'address'=>$this->input->post ( 'address' ),
				'address_line2' => $this->input->post('address_line2'),
				'fax'=>$this->input->post ( 'fax' ),
				'business_model'=>$this->input->post ( 'business_model' ),
				'customer_prof_profession'=>(!empty($profession))?implode(',',$this->input->post( 'customer_prof_profession' )):'',
				'business_sector'=>(!empty($business_sector))?$business_sector:'',
				'customer_photo'=>$customer_photo,
				'customer_prof_school'=>$this->input->post ( 'customer_prof_school' ),
				'customer_prof_college'=>$this->input->post ( 'customer_prof_college' ),
				'customer_prof_work'=>$this->input->post ( 'customer_prof_work' ),
				'customer_prof_official_website'=>$this->input->post ( 'customer_prof_official_website' ),
				'customer_prof_official_email'=>$this->input->post ( 'customer_prof_official_email' ),
				'customer_prof_official_phone'=>$this->input->post ( 'customer_prof_official_phone' ),
				'customer_prof_specialized'=>$this->input->post ( 'customer_prof_specialized' ),
				'customer_prof_types'=>$this->input->post ( 'customer_prof_types' ),
				'customer_prof_rewards'=>$this->input->post ( 'customer_prof_rewards' ),
				'company_name'=>$this->input->post ( 'company_name' ),
				'customer_business_source'=>$this->input->post ( 'business_source' ),
				'customer_business_website'=>$this->input->post ( 'business_website' ),
				'customer_account_holder_name'=>$this->input->post ( 'customer_account_holder_name' ),
				'customer_account_no'=>$this->input->post ( 'customer_account_no' ),
				'customer_ifsc_code'=>$this->input->post ( 'customer_ifsc_code' ),
				'customer_pan_no'=>$this->input->post ( 'customer_pan_no' ),
				'customer_gst_no'=>$this->input->post ( 'customer_gst_no' ),
				'customer_tin_no'=>$this->input->post ( 'customer_tin_no' ),					
			);
			$post_data = array();
			$headers = array('Content-Type: application/json', "X-Client-Id : ".CASHFREE_CLIENTID,'X-Client-Secret :'.CASHFREE_SECRET);
			$url = "authorize";
			$result_token = $this->cashfree_curl($url,$post_data,$headers);	
			if($info['customer_cashfree_id'] == '') {	
				if($result_token->status == 'SUCCESS') {
					if($result_token->data) {
						$token = $result_token->data->token;
						if($token !='') {
							$add_vendeor_url = "addVendor";
							$add_vendor_headers = array('Authorization: Bearer '.$token);
							$add_vendor_post_data = json_encode(array(
								"vendorId" => "BLOGGOTO".$info['customer_id'],
								"name" => $userid,
								"phone" => $this->input->post ( 'customer_phone' ),
								"email" => $info['customer_email'],
								"bankAccount" => $this->input->post ( 'customer_account_no' ),
								"accountHolder" => $this->input->post ( 'customer_account_holder_name' ),
								"ifsc" => $this->input->post ( 'customer_ifsc_code' ),
								"address1" => $this->input->post ( 'address' ),
								"address2" => $this->input->post('address_line2'),
								"city" => get_city_name($this->input->post ( 'customer_city' )),
								"state" => get_state_name($this->input->post ( 'customer_state' )),
								"pincode" => $this->input->post ( 'customer_postal_code' )
							));
							$add_vendor_result = $this->cashfree_curl($add_vendeor_url,$add_vendor_post_data,$add_vendor_headers);
							if($add_vendor_result->status == 'ERROR') {
								$result ['status'] = 'error';
								// $this->session->set_flashdata('admin_error',$add_vendor_result->message);
								$result ['message'] = $add_vendor_result->message;
								echo json_encode ( $result ); exit;
							}
							if($add_vendor_result->status == 'SUCCESS') {
								$update_array['customer_cashfree_id'] = -"BLOGGOTO".$info['customer_id'];
							}
						}
					}
				}
			} else {
				if($result_token->status == 'SUCCESS') {
					if($result_token->data) {
						$token = $result_token->data->token;
						if($token !='') {
							$edit_vendeor_url = "editVendor/BLOGGOTO".$info['customer_id'];
							$edit_vendor_headers = array('Authorization: Bearer '.$token);
							$edit_vendor_post_data = json_encode(array(
								"name" => $userid,
								"phone" => $this->input->post ( 'customer_phone' ),
								"email" => $info['customer_email'],
								"bankAccount" => $this->input->post ( 'customer_account_no' ),
								"accountHolder" => $this->input->post ( 'customer_account_holder_name' ),
								"ifsc" => $this->input->post ( 'customer_ifsc_code' ),
								"address1" => $this->input->post ( 'address' ),
								"address2" => $this->input->post('address_line2'),
								"city" => get_city_name($this->input->post ( 'customer_city' )),
								"state" => get_state_name($this->input->post ( 'customer_state' )),
								"pincode" => $this->input->post ( 'customer_postal_code' )
							));
							$edit_vendor_result = $this->cashfree_curl($edit_vendeor_url,$edit_vendor_post_data,$edit_vendor_headers);
							if($edit_vendor_result->status == 'ERROR') {
								$result ['status'] = 'error';
								//$this->session->set_flashdata('admin_error',$edit_vendor_result->message);
								$result ['message'] = $edit_vendor_result->message;
								echo json_encode ( $result ); exit;
							}
							
						}
					}
				}
			}

			$res=$this->Mydb->update ( $this->customers, array ('customer_id' => $customer_id ), $update_array );
			$blocked_lists=$this->input->post( 'blocked_lists' );
			$this->Mydb->delete ( 'customer_blocked_lists', array('block_customer_id'=>$customer_id));
			if(!empty($blocked_lists))
			{
				$blocked_insert_array=array();					
				foreach($blocked_lists as $block_user)
				{
					if(!empty($block_user)) 
					{
						$blocked_insert_array[] = array (
													'block_customer_id' => $customer_id,
													'block_user_id' => decode_value($block_user),
													'block_created_on' => current_date (),
													'block_created_by' => $customer_id,
													'block_created_ip' => get_ip () 
												 );
					}
				}
				if(!empty($blocked_insert_array))
				{
					$this->Mydb->insert_batch ( 'customer_blocked_lists', $blocked_insert_array );					
				}
			}
			
			//$this->session->set_userdata(array('bg_user_profile_picture'=>media_url().$this->lang->line('customer_image_folder_name')."/".$customer_photo ,'company_name'=>post_value ( 'company_name' )));
			
			//$this->session->set_flashdata ( 'admin_success', 'Profile updated successfully' );
			
			$result ['status'] = 'success';
			//$redirect = "myprofile";
			echo json_encode ( array('status'=>'success') ); exit;
			
		} else {
			$result ['status'] = 'error';
			$this->session->set_flashdata('admin_error',validation_errors ());
			$result ['message'] = validation_errors ();
			echo json_encode ( $result ); exit;
		}
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

	private function cashfree_curl($url, $post_data,$headers){
		
		$this->curl->create(API_URL . $url);
		$this->curl->post($post_data);
		$this->curl->option(CURLOPT_HTTPHEADER, $headers);
		$curl_result = $this->curl->execute();
		return $result = (json_decode($curl_result));
	}
} /* end of files */
