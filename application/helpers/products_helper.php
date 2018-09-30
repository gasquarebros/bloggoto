<?php 
/**************************
 Project Name	: POS
Created on		: 4  March, 2016
Last Modified 	: 16  March, 2016
Description		: products module related helper files.
***************************/



/*  this function used to get all category dropdown */
if(!function_exists('get_product_category'))
{
	function get_product_category($where='',$selected='',$extra='',$product_id=null)
	{
		$CI=& get_instance();
		$join=array();
		$groupby="";
		$where_array=($where=='')? array('pro_cate_primary_id !='=>'') :  $where ;
		


		$groupby = "pro_cate_primary_id";
		$records=$CI->Mydb->get_all_records('pro_cate_primary_id,pro_cate_name,pro_cate_id','product_categories',$where_array,'','',array('pro_cate_name'=>"ASC"),'',$groupby,$join='');
		
		$data=array(''=>get_label('category_select'));
		$product_id = ($product_id == "")?  'pro_cate_id' : $product_id;
		if(!empty($records))
		{
			foreach($records as $value)
			{
				$data[$value[$product_id]] = ucfirst(stripslashes($value['pro_cate_name']));
			}
		}
		$extra=($extra!='')?  $extra : 'class="form-control" id="product_category" required ' ;
			
		return  form_dropdown('product_category',$data,$selected,$extra);
	}
}


/*  this function used to get all product tags  list  */
if(!function_exists('get_product_tags'))
{
	function get_product_tags($where='',$selected='',$extra='',$multiple=null)
	{
		$CI=& get_instance();
		$where_array=($where=='')? array('pro_tag_primary_id !='=>'') :  $where ;
		

		$records=$CI->Mydb->get_all_records('pro_tag_id,pro_tag_name','product_tags',$where_array,'','',array('pro_tag_name'=>"ASC"));

		$data = ($multiple =="" ) ? array(''=>get_label('tag_select')) : array();
		if(!empty($records))
		{
			foreach($records as $value)
			{
				$data[$value['pro_tag_id']] = ucfirst(stripslashes($value['pro_tag_name']));
			}
		}
		$extra=($extra!='')?  $extra : 'class="form-control" id="product_tags"  ' ;
		$array_input = ($multiple == "")? "" : "[]";
			
		return  form_dropdown('product_tags'.$array_input,$data,$selected,$extra.$multiple);
	}
}


/*  this function to get products list   */
if(!function_exists('get_products'))
{
	function get_products($where=array(),$select=null)
	{
		$CI=& get_instance();
		return $CI->Mydb->get_all_records('product_primary_id,product_id,product_name','products',$where);
	}
}

/*  this function used to get all modifier dropdown  */
if(!function_exists('get_product_list'))
{
	function get_product_list($where='',$selected='',$extra='',$multiple=null,$filed_name=null,$index=null,$name=null)
	{
		$CI=& get_instance();
		$where_array=($where=='')? array('product_id !='=>'') :  $where ;


		$groupby = "product_primary_id";
		$records=$CI->Mydb->get_all_records('product_primary_id,product_id,product_name','products',$where_array,'','',array('product_name'=>"ASC"),'',$groupby,$join='');
		$data = ($multiple =="" ) ? array(''=>get_label('select_products')) : array();
		$filed_name = ($filed_name == "")?  'product_id' : $filed_name;
		if(!empty($records))
		{
			foreach($records as $value)
			{
				$data[$value[$filed_name]] = ucfirst(stripslashes($value['product_name']));
			}
		}
		$filed_name = ($name !="")? $name : "products_list";
		$extra=($extra!='')?  $extra : 'class="form-control" id="products_list" ' ;
		$array_input = ($multiple == "")? "" :  ($index !="")?  "[$index][]" :  "[]";
		$array_input = ($name !="")? "" : $array_input;
		return  form_dropdown($filed_name.$array_input,$data,$selected,$extra.$multiple);
	}
}

/*  this function used to get all modifier dropdown  */
if(!function_exists('get_product_customer'))
{
	function get_product_customer($where='',$selected='',$extra='',$multiple=null,$filed_name=null,$index=null,$name=null)
	{
		$CI=& get_instance();
		$where_array=($where=='')? array('customer_id !='=>'') :  $where ;


		$groupby = "customer_id";
		$records=$CI->Mydb->get_all_records('customer_id,customer_first_name,customer_last_name,customer_username','customers',$where_array,'','',array('customer_first_name'=>"ASC"),'',$groupby,$join='');
		$data = ($multiple =="" ) ? array(''=>get_label('select_customer')) : array();
		$filed_name = ($filed_name == "")?  'customer_id' : $filed_name;
		if(!empty($records))
		{
			foreach($records as $value)
			{
				$data[$value[$filed_name]] = ucfirst(stripslashes($value['customer_first_name']))." ".$value['customer_last_name'] ;
			}
		}
		$filed_name = ($name !="")? $name : "product_customer_id";
		$extra=($extra!='')?  $extra : 'class="form-control" id="customers_list" ' ;
		return  form_dropdown($filed_name,$data,$selected,$extra.$multiple);
	}
}


/*  this function used to get all modifier dropdown  */
if(!function_exists('get_product_modifier'))
{
	function get_product_modifier($where='',$selected='',$extra='',$multiple=null,$filed_name=null,$name=null)
	{
		//print_r($selected);
		//exit;
		$CI=& get_instance();
		$where_array=($where=='')? array('pro_modifier_primary_id !='=>'') :  $where ;
		$records=$CI->Mydb->get_all_records('pro_modifier_primary_id,pro_modifier_name,pro_modifier_id','product_modifiers',$where_array,'','',array('pro_modifier_name'=>"ASC"));
	//	$data=array(''=>get_label('modifier_select'));
		$data = ($multiple =="" ) ? array(''=>get_label('product_modifier_select')) : array();
		$filed_name = ($filed_name == "")?  'pro_modifier_primary_id' : $filed_name;
		if(!empty($records))
		{
			foreach($records as $value)
			{
				$data[$value[$filed_name]] = ucfirst(stripslashes($value['pro_modifier_name']));
			}
		}
		$extra=($extra!='')?  $extra : 'class="form-control" id="product_modifier" required ' ;
		$array_input = ($multiple == "")? "" : "[]";
		
		$name = ($name == ""? "product_modifier" : $name );
		return  form_dropdown($name.$array_input,$data,$selected,$extra.$multiple);
	}
}


/* this function used to show categoery dropdown values */
if(!function_exists('get_product_category_select_edit'))
{
	function get_product_category_select_edit($where='',$cateselected='',$extra='',$enable_mutible="")
	{		
		$CI=& get_instance();		
		$where_array=($where=='')? array('pro_cate_primary_id !='=>'') :  $where ;
		/* not in catering availability id condition  */
		$join='';

		$groupby = "pro_cate_primary_id";

		$records=$CI->Mydb->get_all_records('pro_cate_primary_id,pro_cate_id,pro_cate_name,pro_cate_slug','product_categories',$where_array,'','',array('pro_cate_name'=>"ASC"),'',$groupby,$join);
		$data=array(' '=>get_label('category_select'));
		$form = ' <select name="subcategory" '.$extra.' data-placeholder="'.get_label('category_select').' " title="'.sprintf(get_label('product_errors'),get_label('product_categorie')).'">
				<option value=" ">'.get_label('category_select').'</option>';				
		if(!empty($records))
		{
			foreach($records as $mod)
			{
				$mod_vals = get_subcategory(array('pro_subcate_status' => 'A','pro_subcate_category_primary_id' => $mod['pro_cate_primary_id']));		 	 
				if(!empty($mod_vals)) {
					
					$form .=' <optgroup label="'.ucwords(stripslashes($mod['pro_cate_name'])).' ">';
					foreach($mod_vals as $modval)
					{ 
						$sel_cate = ($mod['pro_cate_id'].'~'.$modval['pro_subcate_id'] == $cateselected) ? 'selected' : '';	
						$form .='<option value="'.$mod['pro_cate_id'].'~'.$modval['pro_subcate_id'].'" '.$sel_cate.'>'.ucwords(stripslashes($modval['pro_subcate_name'])). '</option>';
					}
					$form .=' </optgroup>';
				}
			}
		}
			
		$form.=' </select>';
		return $form;		
	}
}

/*  this function to get all  subcategories list   */
if(!function_exists('get_subcategory'))
{
	function get_subcategory($where=array(),$select=null)
	{
		$CI=& get_instance();
		return $CI->Mydb->get_all_records('pro_subcate_primary_id,pro_subcate_category_primary_id,pro_subcate_id,pro_subcate_name,pro_subcate_sequence,pro_subcate_status','product_subcategories',$where,'','',array('pro_subcate_sequence' => 'ASC'));
	}
}



/*  this function to get modifier values list   */
if(!function_exists('get_modifier_list'))
{
	function get_modifier_list($where=array(),$select=null)
	{
		$CI=& get_instance();

		return $CI->Mydb->get_all_records('pro_modifier_value_primary_id,pro_modifier_value_modifier_primary_id,pro_modifier_value_id,pro_modifier_value_name,pro_modifier_value_price,pro_modifier_value_sequence,pro_modifier_value_status','product_modifier_values',$where);
	}
}

/*  this function to get modifier values list   */
if(!function_exists('get_shipping_list'))
{
	function get_shipping_list($where=array(),$select=null)
	{
		$CI=& get_instance();

		return $CI->Mydb->get_all_records('*','shipping_methods',$where);
	}
}

/* this function used to show output status */
if (!function_exists('show_status')) {
	function show_status($sts=null,$id) {

		return ($sts == "A" ? '<i class="fa fa-unlock status" title=" '.get_label('active').'" id='.encode_value($id).' data="Deactivate"></i>' : ($sts == "I" ? '<i class="fa fa-lock status" title="'.get_label('inactive').'"  id='.encode_value($id).' data="Activate"></i>' : '' )  );
	}
}

/* this function used to show output status */
if (!function_exists('find_discount')) {
	function find_discount($orginal_price,$special_price=null,$from_date=null,$to_date=null) {
		$valid = true;
		$discount_percent = 0;
	
		if($from_date !='' && strtotime(date('Y-m-d')) < strtotime($from_date))
		{
			$valid = false;
		}
		if($to_date !='' && strtotime(date('Y-m-d')) > strtotime($to_date))
		{
			$valid = false;
		}
		if($valid == true && $special_price !='')
		{
			$discount_price = $orginal_price - $special_price;
			$discount_percent = (($discount_price * 100)/$orginal_price);  
		}
		return ceil($discount_percent);
	}
}




/*  this function used to get all company avilability  list  
if(!function_exists('get_product_availability'))
{
	function get_product_availability($where='',$selected='',$extra='',$multiple=null)
	{
		$CI=& get_instance();
		$where_array=($where=='')? array('company_available_id !='=>'') :  $where ;

		$join ='';
		
		$records=$CI->Mydb->get_all_records('company_available_id','company_availability',$where_array,'','',array('av_name'=>"ASC"),'','',$join);

		$data = ($multiple =="" ) ? array(''=>get_label('select_availability')) : array();
		if(!empty($records))
		{
			foreach($records as $value)
			{
				$data[$value['av_id']] = ucfirst(stripslashes($value['av_name']));
			}
		}
		$extra=($extra!='')?  $extra : 'class="form-control" id="product_avilablity" required ' ;
		$array_input = ($multiple == "")? "" : "[]";

		return  form_dropdown('product_avilablity[]',$data,$selected,$extra.$multiple);
	}
    
}
*/