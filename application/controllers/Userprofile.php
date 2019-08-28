<?php
/**************************
 Project Name	: Bloggotoweb
Description		: Device Udpate

***************************/
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';
class Userprofile extends REST_Controller {
   
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
	
	
	function index() {
		$app_id = $this->get ( 'app_id' );
        $userid = ($this->get('user_id'))?$this->get('user_id'): null;
		if($userid == null)
		{
			echo json_encode(array('status'=>'error','msg'=>'Invalid User'));
			exit();
		} else {
			$post_infos = $this->Mydb->get_all_records('COUNT(post_id) as postcount, post_type',$this->table,array('post_created_by'=>$user_id,'post_status'=>'A'),$limit = '', $offset = '', $order = '', $like = '', $groupby = array('post_type'));

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
			$following_count = count($follow_records);
			$follow_count = count($following_records);
			
			$info = $this->Mydb->get_record('*',$this->customers,array('customer_username'=>$userid));

			$data['info'] = $info;
			$data['post_infos'] = $post_infos;
			$data['follow_count'] = $follow_count;
			$data['follow_list'] = $follow_list;
			$data['following_count'] = $following_count;
			$where = array('customer_id !='=>$userid,'customer_status'=>'A','customer_private'=>0,'customer_username !='=>'');
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
				$suggestions = $this->Mydb->get_all_records('*',$this->customers,$where ,$limit = 3,$offset = '', array('random'));
			}

			$data['suggestions'] = $suggestions;
			$result ['status'] = 'success';
			$result['html'] = $data;
			echo json_encode($result);
			exit;
		}	
	}
	
} /* end of files */
