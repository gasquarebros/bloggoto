<?php
/**************************
 Project Name	: Bloggotoweb
Description		: Device Udpate

***************************/
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';
class Restservices extends REST_Controller {
   
	function __construct() {
		parent::__construct ();
		$this->load->library ( 'form_validation' );
		$this->form_validation->set_error_delimiters ( '<p>', '</p>' );
		$this->table = "services";
		$this->order_table = "order_service";
		$this->service_gallery = "service_gallery";
		$this->customers = "customers";
		$this->service_categorytable = "service_categories";
		$this->service_subcategorytable = "service_subcategories";
		$this->service_cities = "service_cities";
		$this->primary_key='ser_primary_id';
		$this->load->library('common');
		$this->load->helper('products');
	}
	
	public function categories_get()
	{ 
		$app_id = $this->get ( 'app_id' );
		if($app_id =='') {
			echo json_encode(array('status'=>'error','msg'=>'Invalid user'));
			exit(); 
		} else {
			$data = $this->Mydb->get_all_records('*',$this->service_categorytable,array('ser_cate_status' => 'A'));
			
		}
		echo json_encode ( array (
			'status' => 'success',
			'html' => $data,
		) );
		exit ();		
	}
	
	public function subcategories_get() {
	    $app_id = $this->get ( 'app_id' );
		if($app_id =='') {
			echo json_encode(array('status'=>'error','msg'=>'Invalid user'));
			exit(); 
		} else {
			$data = $this->Mydb->get_all_records('*',$this->service_subcategorytable,array('pro_subcate_status' => 'A'));
			
		}
		echo json_encode ( array (
			'status' => 'success',
			'html' => $data,
		) );
		exit ();
	}
	
	public function servicelist_get()
	{ 
		$app_id = $this->get ( 'app_id' );
		if($app_id =='') {
			echo json_encode(array('status'=>'error','msg'=>'Invalid user'));
			exit(); 
		} else {
    		$like = array ();
    		
    		$order_by = array (
    				$this->primary_key => 'DESC' 
    		);
    		$where = array('ser_status'=>'A');
    		/* Search part start */
    		
    		if ($this->input->get ( 'paging' ) == "") {
    			$search_field = $this->input->get ( 'search_field' );
    			$type = $this->input->get ( 'type' );
    			$order_field = $this->input->get ( 'order_field' );
    		}
    
    		$cat = $this->input->get ( 'category' );
    		$subcat = $this->input->get('subcategory');
    		$sortby = $this->input->get('sortby');
    		$city = $this->input->get('customer_city');
    		$slug = $this->input->get('slug');
    		$search_field = $this->input->get('search_field');
    		
    		$availability = ($this->input->get('availability'))?explode(',', $this->input->get('availability')) : '';
     // echo"<pre>"; print_r($availability); exit;
    		if ($availability != "" && $availability != 'undefined') {
    			$avail = '';
    			foreach($availability as $avails) {
    				if($avail !=''){
    					$avail.=" OR ";
    				}
    				$avail.="ser_available like '%,".$avails.",%'";
    			}
    			if($avail !=''){
    				$where = array_merge ( $where, array (
    					"(".$avail.")" => null 
    				));
    			}
    		}
    
    		if($search_field !='' && $search_field != 'undefined') {
    			$like = array_merge ( $like, array (
    				"ser_title" => $search_field 
    			));
    		}
    		
    
    		if ($cat != "" && $cat != 'undefined') {
    			$where = array_merge ( $where, array (
    				"ser_category" => $cat 
    			));
    		}
    
    		if ($subcat != "" && $subcat != 'undefined') {
    			$where = array_merge ( $where, array (
    				"ser_subcategory" => $subcat 
    			));
    		}
            
            if($slug !='' && $slug != 'undefined') {
                $where = array_merge ( $where, array (
    				"ser_slug" => $slug 
    			));
            }
            
    		if($sortby !='' && $sortby == 'price-low')
    		{
    			$order_by = array (
    				'ser_price' => 'ASC' 
    			);
    		} else if($sortby !='' && $sortby == 'price-high')
    		{
    			$order_by = array (
    				'ser_price' => 'DESC' 
    			);
    		} else if($sortby !='' && $sortby == 'asc')
    		{
    			$order_by = array (
    				'ser_title' => 'ASC' 
    			);
    		} else if($sortby !='' && $sortby == 'desc')
    		{
    			$order_by = array (
    				'ser_title' => 'DESC' 
    			);
    		}
    		
    		
    		$join = "";
    		$join [0] ['select'] = "ser_cate_primary_id,ser_cate_id,ser_cate_name";
    		$join [0] ['table'] = $this->service_categorytable;
    		$join [0] ['condition'] = "ser_cate_primary_id = ser_category";
    		$join [0] ['type'] = "LEFT";
    		
    		$join [1] ['select'] = "customer_id,customer_first_name,customer_last_name,customer_username,customer_email,customer_photo,customer_gst_no";
    		$join [1] ['table'] = $this->customers;
    		$join [1] ['condition'] = "ser_customer_id = customer_id";
    		$join [1] ['type'] = "LEFT";
    
    		$join [2] ['select'] = "pro_subcate_primary_id,pro_subcate_id,pro_subcate_name";
    		$join [2] ['table'] = $this->service_subcategorytable;
    		$join [2] ['condition'] = "pro_subcate_primary_id = ser_subcategory";
    		$join [2] ['type'] = "LEFT";
    
    		$join [3] ['select'] = "group_concat(',',ser_city_id,',') as cities";
    		$join [3] ['table'] = $this->service_cities;
    		$join [3] ['condition'] = $this->service_cities.".ser_service_id = ser_primary_id";
    		$join [3] ['type'] = "LEFT";
    
    		$join [4] ['select'] = "group_concat(ser_gallery_image,'~') as galleryimages";
    		$join [4] ['table'] = 'service_gallery';
    		$join [4] ['condition'] = "service_gallery.ser_gallery_ser_primary_id = ser_primary_id";
    		$join [4] ['type'] = "LEFT";
    		$groupby = $this->primary_key;
    
    		if ($city != "" && $city != 'undefined') {
    			$this->db->having('cities like "%, '.$city.',%"');
    		}
    		$totla_rows = $this->Mydb->get_num_join_rows ( $this->primary_key, $this->table, $where, null, null, null, $like, $groupby, $join  );
    		
    		if ($city != "" && $city != 'undefined') {
    			$this->db->having('cities like "%, '.$city.',%"');
    		}
    		$limit = 12;
    		$page = $this->input->get ( 'page' )?$this->input->get ( 'page' ):1;
    		$offset = $this->input->get ( 'page' )?(($this->input->get ( 'page' )-1) * $limit):0;
    		$offset = $this->input->get ( 'offset' )?$this->input->get ( 'offset' ):$offset;
    		$next_offset = $offset+$limit;
    		$next_set = ($totla_rows > $next_offset)?($offset+$limit):'';
    
    		
    		
    		$data['offset'] = $offset;
    		$select_array = array ($this->table.'.*');
    		$records = $this->Mydb->get_all_records ( $select_array, $this->table, $where, $limit, $offset, $order_by, $like, $groupby, $join );
    		//echo $this->db->last_query();
    		//exit;

    		$current_records = (($page-1)*$limit)+count($records);
    		$data['current_records'] = $current_records;
    		$data['total_rows'] = $totla_rows;
    		$data['page'] = $page;
    		$data['records'] = [];
    		if(!empty($records)) {
    		    $i =0;
    		    foreach($records as $record) {
    		        $data['records'][$i] = $record;
    		        $image_url = array();
					if($record['galleryimages'] !='') {
						$gallery = explode('~',$record['galleryimages']); 
						if(!empty($gallery))
						{
							foreach ($gallery as $key => $postimage) 
							{
							    if($postimage) {
								    $image_url[] = media_url(). $this->lang->line('service_gallery_image_folder_name')."/".$postimage;
							    }
							}
						}
					} else {
						$image_url[] = media_url().$this->lang->line('post_photo_folder_name')."default.png";
					}
					$data['records'][$i]['galleryimages'] = $image_url;
					$discount = find_discount($record['ser_price'],$record['ser_discount_price'],$record['ser_discount_start_date'],$record['ser_discount_end_date']); 
					$data['records'][$i]['discount'] = $discount;
					$data['records'][$i]['ser_description'] = substr_close_tags(json_decode($record['ser_description']));
    		        if($record['customer_photo'] !='') { 
    		            $data['records'][$i]['customer_image'] =  media_url(). $this->lang->line('customer_image_folder_name').$record['customer_photo'];
    		        } else {
    		            $data['records'][$i]['customer_image'] =  skin_url()."images/profile.jpg";
    		        }
    		        if($record['cities'])  {
    		            $cties = explode(',',$record['cities']);
    		            $filtercities = [];
    		            foreach($cties as $ctys) {
    		                if($ctys !='' && trim($ctys) !='') {
    		                    $filtercities[] = trim($ctys);
    		                }
    		            }
    		            $data['records'][$i]['cities'] = $filtercities;
    		        }
    		        $i++;
    		    }
    		}
    		echo json_encode ( array (
    				'status' => 'ok',
    				'offset' => $offset,
    				'next_set' => $next_set,
    				'data' => $data,
    		) );
    		exit ();
			
		}
	}
} /* end of files */
