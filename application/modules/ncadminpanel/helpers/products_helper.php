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
		$product_id = ($product_id == "")?  'pro_cate_primary_id' : $product_id;
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
