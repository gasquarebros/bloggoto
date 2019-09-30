<?php
/**************************
 Project Name	: Bloggotoweb
Description		: Device Udpate

***************************/
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';
class Productsapi extends REST_Controller {
    public function __construct() {
		parent::__construct ();
		//$this->authentication->user_authentication();
		$this->module = "products";
		$this->module_label = get_label('products_module_label');
		$this->module_labels = get_label('products_module_label');
		$this->folder = "products/";
		$this->table = "products";
		$this->product_gallery = "product_gallery";
		$this->customers = "customers";
		$this->product_categorytable = "product_categories";
		$this->product_subcategorytable = "product_subcategories";
		$this->primary_key='product_primary_id';
		$this->load->library('common');
		$this->load->helper('products');
    }

    private function in_array_field($needle, $needle_field, $haystack, $strict = false) { 
        if ($strict) { 
            foreach ($haystack as $item)
            { 
                if (isset($item->$needle_field) && $item->$needle_field === $needle) 
                {
                    return true;
                }
            }
        } 
        else { 
            foreach ($haystack as $item) 
            {
                if (isset($item->$needle_field) && $item->$needle_field == $needle)  {
                    return true; 
                }
            }
        } 
        return false; 
    } 

    public function categories_get()
	{ 
        $data['product_category'] = [];
		$app_id = $this->get ( 'app_id' );
		if($app_id =='') {
			echo json_encode(array('status'=>'error','msg'=>'Invalid user'));
			exit(); 
		} else {
            $join = "";
            $join [0] ['select'] = "pro_subcate_primary_id,pro_subcate_id,pro_subcate_name,pro_subcate_image,pro_subcate_slug";
            $join [0] ['table'] = $this->product_subcategorytable;
            $join [0] ['condition'] = "pro_subcate_category_primary_id = pro_cate_primary_id";
            $join [0] ['type'] = "LEFT";
            $product_category = $this->Mydb->get_all_records($this->product_categorytable.'.*',$this->product_categorytable,array('pro_cate_status' => 'A'),'','','','','',$join);
            
            $category = array();
            if(!empty($product_category)) {
                foreach($product_category as $prodcats) {
                    $exist = array_key_exists($prodcats['pro_cate_id'],$category);                    
                    //echo "---".$prodcats['pro_cate_id'];
                    //print_r($category);
                    //echo "<br>";
                    if(!empty($category) && ($exist) ) {
                        $category[$prodcats['pro_cate_id']]['subcategory'][] = array('pro_subcate_primary_id' => $prodcats['pro_subcate_primary_id'], 'pro_subcate_id' => $prodcats['pro_subcate_id'], 'pro_subcate_name'=>stripslashes($prodcats['pro_subcate_name']),'pro_subcate_image'=>$prodcats['pro_subcate_image'],'pro_subcate_slug'=>$prodcats['pro_subcate_slug'], 'pro_subcate_category_primary_id' => $prodcats['pro_cate_id']);
                    } else {
                        //echo $i;
                        //echo "<br>";
                        $category[$prodcats['pro_cate_id']] = array('pro_cate_id'=>$prodcats['pro_cate_id'], 'pro_cate_primary_id'=>$prodcats['pro_cate_primary_id'], 'pro_cate_name'=>stripslashes($prodcats['pro_cate_name']),'pro_cate_image'=>$prodcats['pro_cate_image']);
                        if($prodcats['pro_subcate_primary_id'] != '') {
                            $category[$prodcats['pro_cate_id']]['subcategory'][] = array('pro_subcate_primary_id' => $prodcats['pro_subcate_primary_id'], 'pro_subcate_id' => $prodcats['pro_subcate_id'], 'pro_subcate_name'=>stripslashes($prodcats['pro_subcate_name']),'pro_subcate_image'=>$prodcats['pro_subcate_image'],'pro_subcate_slug'=>$prodcats['pro_subcate_slug'], 'pro_subcate_category_primary_id' => $prodcats['pro_cate_id']);
                        } else {
                            $category[$prodcats['pro_cate_id']]['subcategory'] = array();
                        }
                    }
                    $exist = false;
                }
            }
            $data['product_category'] = array_values($category);
		}
		echo json_encode ( array (
			'status' => 'success',
			'html' => $data,
		) );
		exit ();		
    }

    public function productslist_get() {
        $app_id = $this->get ( 'app_id' );
		if($app_id =='') {
			echo json_encode(array('status'=>'error','msg'=>'Invalid user'));
			exit(); 
		} else {
            $like = array ();
            
            $order_by = array (
                    $this->primary_key => 'DESC' 
            );
            $where = array('product_status'=>'A','product_is_display'=>1);
            /* Search part start */
            
            if (post_value ( 'paging' ) == "") {
                $search_field = post_value ( 'search_field' );
                $type = post_value ( 'type' );
                $order_field = post_value ( 'order_field' );
            }

            $cat = $this->input->get( 'cat' );
            $subcat = $this->input->get('subcat');
            $price_range_from = $this->input->get( 'price_from' );
            $price_range_end = $this->input->get('price_end');
            $sortby = $this->input->get('sortby');
            $search = $this->input->get('search');
            
            if ($search != "") {
                $like = array (
                    'product_name' => $search 
                );
            }
            
            if ($cat != "" && $cat != 'undefined') {
                $where = array_merge ( $where, array (
                    "product_category_id" => $cat 
                ));
            }

            if ($subcat != "" && $subcat != 'undefined') {
                $where = array_merge ( $where, array (
                    "product_subcategory_id" => $subcat 
                ));
            }

            if ($price_range_from != "" && $price_range_from != 'undefined') {
                $where = array_merge ( $where, array (
                    "product_price >=" => $price_range_from 
                ));
            }

            if ($price_range_end != "" && $price_range_end != 'undefined') {
                $where = array_merge ( $where, array (
                    "product_price <=" => $price_range_end 
                ));
            }

            if($sortby !='' && $sortby == 'price-low')
            {
                $order_by = array (
                    'product_price' => 'ASC' 
                );
            } else if($sortby !='' && $sortby == 'price-high')
            {
                $order_by = array (
                    'product_price' => 'DESC' 
                );
            } else if($sortby !='' && $sortby == 'asc')
            {
                $order_by = array (
                    'product_name' => 'ASC' 
                );
            } else if($sortby !='' && $sortby == 'desc')
            {
                $order_by = array (
                    'product_name' => 'DESC' 
                );
            }
            
            $join = "";
            $join [0] ['select'] = "pro_cate_primary_id,pro_cate_id,pro_cate_name";
            $join [0] ['table'] = $this->product_categorytable;
            $join [0] ['condition'] = "pro_cate_id = product_category_id";
            $join [0] ['type'] = "LEFT";
            
            $join [1] ['select'] = "customer_id,customer_first_name,customer_last_name,customer_username,customer_email,customer_gst_no";
            $join [1] ['table'] = $this->customers;
            $join [1] ['condition'] = "product_customer_id = customer_id";
            $join [1] ['type'] = "LEFT";

            $groupby = $this->primary_key;
            $totla_rows = $this->Mydb->get_num_join_rows ( $this->primary_key, $this->table, $where, null, null, null, $like, $groupby, $join  );

            $limit = 12;
            $page = $this->input->get( 'page' )?$this->input->get( 'page' ):1;
            $offset = $this->input->get( 'page' )?(($this->input->get( 'page' )-1) * $limit):0;
            $offset = $this->input->get( 'offset' )?$this->input->get( 'offset' ):$offset;
            $next_offset = $offset+$limit;
            $next_set = ($totla_rows > $next_offset)?($offset+$limit):'';

            $data['offset'] = $offset;
            $select_array = array ($this->table.'.*');
            $records = $this->Mydb->get_all_records ( $select_array, $this->table, $where, $limit, $offset, $order_by, $like, $groupby, $join );
            $current_records = (($page-1)*$limit)+count($records);
            $data['current_records'] = $current_records;
            $data['total_rows'] = $totla_rows;
            $data['page'] = $page;
            $data ['records'] = $records;
            // echo $this->db->last_query();
            // exit;
            if(!empty($records)) {
                $i = 0;
                foreach($records as $record) {
                    $data ['records'][$i] = $record;	

                    if($record['product_thumbnail'] !='') {
                        $data['records'][$i]['product_thumbnail'] = media_url().$this->lang->line ( 'product_main_image_folder_name' )."/".$record['product_thumbnail'];
                    } else {
                        $data['records'][$i]['product_thumbnail'] = media_url().$this->lang->line('post_photo_folder_name')."default.png";
                    }
                    
                    $discount = find_discount($record['product_price'],$record['product_special_price'],$record['product_special_price_from_date'],$record['product_special_price_to_date']); 
                    $data['records'][$i]['discount'] = $discount;
                    
                    $data['records'][$i]['product_short_description'] = substr_close_tags(json_decode($record['product_short_description']));
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
	
	public function productview_get() {
		$app_id = $this->get ( 'app_id' );
		$slug = $this->get('slug');
		if($app_id =='') {
			echo json_encode(array('status'=>'error','msg'=>'Invalid user'));
			exit(); 
		} else if($slug !='') {
			
			$where = "product_slug = '".$slug."'";
			$like = array ();
			
			$order_by = array (
					$this->primary_key => 'DESC' 
			);
			$join = "";
			$join [0] ['select'] = "pro_cate_primary_id,pro_cate_id,pro_cate_name";
			$join [0] ['table'] = $this->product_categorytable;
			$join [0] ['condition'] = "pro_cate_id = product_category_id";
			$join [0] ['type'] = "LEFT";
			
			$join [1] ['select'] = "customer_id,customer_first_name,customer_last_name,customer_email,customer_photo,customer_username,customer_gst_no";
			$join [1] ['table'] = $this->customers;
			$join [1] ['condition'] = "product_customer_id = customer_id";
			$join [1] ['type'] = "LEFT";
			
			$join [2] ['select'] = "group_concat(',',pro_gallery_image) as product_images";
			$join [2] ['table'] = $this->product_gallery;
			$join [2] ['condition'] = "pro_gallery_product_primary_id = ".$this->primary_key;
			$join [2] ['type'] = "LEFT";

			$groupby = $this->primary_key;

			$select_array = array ($this->table.'.*');
			$records = $this->Mydb->get_all_records ( $select_array, $this->table, $where, '', '', $order_by, $like, $groupby, $join );
			
			if($records[0]['product_thumbnail'] !='') {
				$records[0]['product_thumbnail'] = media_url(). $this->lang->line('product_main_image_folder_name')."/".$records[0]['product_thumbnail'];
			} else {
				$records[0]['product_thumbnail'] = '';
			}
			$data ['records'] = $records;

			$gallery_images = $this->Mydb->get_all_records ( 'pro_gallery_image,pro_gallery_primary_id', 'product_gallery', array (
				'pro_gallery_product_primary_id' => $records[0] [$this->primary_key] 
			) );
			if(!empty($gallery_images)) {
				foreach($gallery_images as $gallery) {
					if($gallery['pro_gallery_image'] !='') {
						$data['gallery_images'][] = media_url(). $this->lang->line('product_gallery_image_folder_name')."/".$gallery['pro_gallery_image'];
					}
				}
 			} else {
				$data['gallery_images'] = array();
			}
			
			/*get shipping methods*/
			$join = "";
			$join [0] ['select'] = "ship_method_name,ship_method_status";
			$join [0] ['table'] = "shipping_methods";
			$join [0] ['condition'] = "ship_method_id = prod_ass_ship_method_shipid";
			$join [0] ['type'] = "INNER";
			$data ['assigned_shipping'] = $this->Mydb->get_all_records ( 'product_assigned_shipping_methods.*', 'product_assigned_shipping_methods', array (
				'prod_ass_ship_method_prodid' => $records[0][$this->primary_key],'ship_method_status'=>'A' 
			) ,'', '', '', '', '',$join);			
			if($records[0]['product_type'] == 'attribute') {	
				$join = "";
				$join [0] ['select'] = "pro_modifier_primary_id,pro_modifier_id,pro_modifier_name,pro_modifier_display";
				$join [0] ['table'] = "product_modifiers";
				$join [0] ['condition'] = "pro_modifier_id = prod_ass_att_attribute_id";
				$join [0] ['type'] = "INNER";
				/* not in product availability id condition  */
				$join [1] ['select'] = "group_concat(distinct(pro_modifier_value_primary_id)) as value_primary_id,group_concat(distinct(pro_modifier_value_id)) as value_id,group_concat(distinct(pro_modifier_value_name)) as value_name,group_concat(distinct(pro_modifier_value_image)) as value_images";
				$join [1] ['table'] = "product_modifier_values";
				$join [1] ['condition'] = "pro_modifier_value_modifier_id = prod_ass_att_attribute_id";
				$join [1] ['type'] = "LEFT";	

				$groupby = "pro_modifier_value_modifier_primary_id";
				$select_array = array (
					'*',  
				);
				$where = array("assigned_mod_product_id"=>$records[0][$this->primary_key]);
				/*get_assigned_associate_products*/
				$assigned_associate_attributes = $this->Mydb->get_all_records ( 'product_assigned_attributes.*', 'product_assigned_attributes', array (
					'prod_ass_att_parent_productid' => $records[0][$this->primary_key] 
				) ,'', '', '', '',array('pro_modifier_id'),$join);
				$assattribute = array();
				if(!empty($assigned_associate_attributes)) {
					foreach($assigned_associate_attributes as $associateprod) {
						$values_ids = explode(',',$associateprod['value_id']);
						$value_names = explode(',',$associateprod['value_name']);
						$valu_pids = explode(',', $associateprod['value_primary_id']);
						$value_images = explode(',', $associateprod['value_images']);
						$values = array('primary_ids'=>$valu_pids, 'valueid'=>$values_ids, 'names'=>$value_names,'value_images'=>$value_images);
						$assattribute[] = array('pro_modifier_primary_id' => $associateprod['pro_modifier_primary_id'], 'pro_modifier_id' => $associateprod['pro_modifier_id'], 'pro_modifier_name' => $associateprod['pro_modifier_name'],'pro_modifier_display'=>$associateprod['pro_modifier_display'],'values' => $values);
					}
				}
				$data ['assigned_associate_attributes'] = $assattribute;
			}
			echo json_encode(array('status'=>'success','data'=>$data));
			exit(); 
		} else {
			echo json_encode(array('status'=>'error','msg'=>'Invalid Product'));
			exit();
		}
	}
} /* end of files */