<?php
/**************************
Project Name	: BlogGotoWeb
Created on		: 27 Nov, 2017
Last Modified 	: 27 Nov, 2017
Description		: Page contains frontend panel login and forgot password functions.

***************************/
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Checkout extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		//$this->authentication->user_authentication();
		$this->module = "checkout";
		$this->module_label = get_label('products_module_label');
		$this->module_labels = get_label('products_module_label');
		$this->folder = "checkout/";
		$this->table = "products";
		$this->product_gallery = "product_gallery";
		$this->customers = "customers";
		$this->product_categorytable = "product_categories";
		$this->product_subcategorytable = "product_subcategories";
		$this->primary_key='product_primary_id';
		$this->load->library('common');
		$this->load->helper('products');
	}
	
	/* this method used to check login */
	public function index() {
		
		//echo "inn"; exit;
		$data = $this->load_module_info ();	
		$product_category = $this->Mydb->get_all_records('*',$this->product_categorytable,array('pro_cate_status' => 'A'));
		if(!empty($product_category))
		{
			foreach($product_category as $procat)
			{
				$category[$procat['pro_cate_id']] = $procat['pro_cate_name'];
			}
		}
		$data['product_category'] = $category;

		$product_subcategory = $this->Mydb->get_all_records('*',$this->product_subcategorytable,array('pro_subcate_status' => 'A'));
		if(!empty($product_subcategory))
		{
			foreach($product_subcategory as $procat)
			{
				$subcategory[$procat['pro_subcate_id']] = $procat['pro_subcate_name'];
			}
		}
		$data['product_subcategory'] = $subcategory;
		$this->layout->display_site ( $this->folder . $this->module . "-list", $data );
	}
	
	public function payment()
	{
		// check_site_ajax_request();
		$data = $this->load_module_info ();
		
			$customer_id=get_user_id ();
			$customer_array = array ('cart_customer_id' => $customer_id);


			$cart_details = $this->Mydb->get_record ( '*', 'cart_details', $customer_array, array ('cart_id' => 'DESC') );
			$data['cart_details']=$cart_details;

		$this->layout->display_site ( $this->folder . $this->module . "-payment", $data );

	}


	public function proceedpayment()
	{
		
		if($this->session->userdata('order_reference'))
		{

			$api_data['reference_id'] = get_user_id();
			$api_data['customer_id'] = get_user_id();
			
			
			$cart = Yii::$app->CommonFunctions->getservicemethod('products/cartcontents',$api_data);

			$data['order_id'] = Yii::$app->session->get('order_reference');
			$order = Yii::$app->CommonFunctions->getservicemethod('order/listorders',$data);

			if(!empty($cart) && !empty($order))
			{
				if($cart['able_proceed_checkout'] == 'true')
				{
					$secret_key = $this->secret_key;
					$merchant = $this->merchant;
					$action ="pay";
					$ref_id = Yii::$app->session->get('order_reference');
					$total_amount=$order[0]['online_amount'];
					$wallet_amount=($order[0]['wallet_amount'] > 0)?$order[0]['wallet_amount']:'0.00';
					$order_discount_amt=($order[0]['order_discount_amt'] > 0)?$order[0]['order_discount_amt']:'0.00';
					$currency = "SGD";
					
					$discount_amount = $wallet_amount + $order_discount_amt;

					$shipping_amount = '0.00';
					$item_where = "cartid = ".$cart['cart_details']['id'];
					//$order_item_shipping = CartItemShipping::find()->select('SUM(shipping_method_price) as shipping_price')->where($item_where)->one();
					$order_item_shipping = array();
					if(!empty($order_item_shipping))
					{
						$shipping_amount = ($order_item_shipping['shipping_price']>0)?$order_item_shipping['shipping_price']:'0.00';
					}
					
					$dataToBeHashed = $secret_key.$merchant.$action.$ref_id.$total_amount.$currency;
					$utfString = mb_convert_encoding($dataToBeHashed, "UTF-8");
					$signature = sha1($utfString, false);
					$item ="";
					$i=1;
					if($total_amount > 0) {
						if(!empty($cart['cart_items']))
						{
							foreach($cart['cart_items'] as $cartitem)
							{
								//foreach($cartitems as $cartitem)
								//{echo "<pre>"; print_r($cartitem); exit;
									
									//foreach($cartitemval as $cartitem)
									//{
										$item.='
											<input type="hidden" name="item_name_'.$i.'" value="'.$cartitem['product_name'].'" />
											<input type="hidden" name="item_description_'.$i.'" value="'.$cartitem['product_sku'].'" />
											<input type="hidden" name="item_quantity_'.$i.'" value="'.$cartitem['product_qty'].'" />
											<input type="hidden" name="item_amount_'.$i.'" value="'.$cartitem['product_price'].'" />
										';
										$i++;
									//}
								//}
							}
						}
						$form = '<form action="'.$this->api_url.'" id="payment_form" method="post">
							<input type="hidden" name="action" value="pay" />
							<input type="hidden" name="currency" value="SGD" />
							<input type="hidden" name="version" value="2.0" />'.$item.'
							<input type="hidden" name="merchant" value="'.$merchant.'" />
							<input type="hidden" name="ref_id" value="'.Yii::$app->session->get('order_reference').'" />
							<input type="hidden" name="delivery_charge" value="'.$shipping_amount.'" />
							<input type="hidden" name="tax_amount" value="0.00" />
							<input type="hidden" name="discount_amount" value="'.$discount_amount.'" />
							<input type="hidden" name="tax_percentage" value="0.00" />
							<input type="hidden" name="total_amount" value="'.$total_amount.'" />
							
							<input type="hidden" name="str_url" value="'.Url::base(Yii::$app->params['server_scheme']).Url::toRoute('checkout/successhandling').'" />
							<input type="hidden" name="success_url" value="'.Url::base(Yii::$app->params['server_scheme']).Url::toRoute('checkout/success').'" />
							<input type="hidden" name="cancel_url" value="'.Url::base(Yii::$app->params['server_scheme']).Url::toRoute('checkout/failure').'" />
							<input type="hidden" name="signature" value="'.$signature.'" />
							<input type="hidden" name="signature_algorithm" value="sha1" />
							<input type="hidden" name="skip_success_page" value="1" />
							<input type="submit" id="submit" name="submit v2" value="Redirect Now" alt="SmoovPay!" />
						</form>';
						return $this->render('proceedpayment', [
							'form' => $form
						]);
					}
					else
					{
						return $this->redirect(['/cart']); 
					}
				}
				else
				{
					return $this->redirect(['/cart']); 
				}
			}
			else
			{
				return $this->redirect(['/cart']); 
			}
		}
		else
		{
			return $this->redirect(['/checkout/payment']); 
		}
	}


	/* this function used to get cart details */
	public function contents_get($reference_id = null, $customer_id = null, $returndata = "") {
		$productlead=array();	
		$maxs=0;

		$reference_id = ($reference_id == "" ? '' : $reference_id); /* mobile device id or browser session id */

		$customer_id = ($customer_id != "" ? $customer_id : '');

		/* validate customer id */
		$customer_array = ($reference_id == "" ? array (
				'cart_customer_id' => $customer_id 
		) : array (
				'cart_session_id' => $reference_id 
		));

		$cart_details = $this->Mydb->get_record ( '*', 'cart_details', $customer_array, array (
				'cart_id' => 'DESc' 
		) );
		
		if (! empty ( $cart_details )) {

			$select = array (
					'cart_item_id',
					'cart_item_product_id',
					'cart_item_product_name',
					'cart_item_product_sku',
					'cart_item_product_image',
					'cart_item_qty',
					'cart_item_unit_price',
					'cart_item_product_orginal_price',
					'cart_item_total_price',
					'cart_item_product_type',
					'cart_item_product_discount',
					'cart_item_subproduct_id',
					'cart_item_subproduct_name',
					'cart_item_merchant_id',
					'cart_item_merchant_name',
					'cart_item_shipping_product_price',
					'cart_item_shiiping_id' 
			);

			$join = "";
			$join [0] ['select'] = "shipping_name,shipping_method_price,ship_track_url";
			$join [0] ['table'] = "cart_item_shipping";
			$join [0] ['condition'] = "id = cart_item_shiiping_id";
			$join [0] ['type'] = "LEFT";

			//$join [1] ['select'] = "group_concat('~',attribute_name) as attributename, group_concat('~',attribute_value_name)";
			$join [1] ['select'] = "group_concat(attribute_name) as attributename,group_concat(attribute_value_name) as attributevaluename,group_concat(attribute_value_image) as value_images, group_concat(attribute_id) as attributeid, group_concat(attribute_value_id) as attributevalueid";
			$join [1] ['table'] = "cart_attributes";
			$join [1] ['condition'] = "itemid = cart_item_id";
			$join [1] ['type'] = "LEFT";
/*
			$join [2] ['select'] = "product_modifier_values.*";
			$join [2] ['table'] = "product_modifier_values";
			$join [2] ['condition'] = "pro_modifier_value_id = product_assigned_attributes.prod_ass_att_attribute_value_id";
			$join [2] ['type'] = "LEFT";*/

			$where = array (
				'cart_item_cart_id' => $cart_details ['cart_id'] 
			);
			$all_items = $this->Mydb->get_all_records ( $select,'cart_items', $where, '', '', '', '',array('cart_item_id'), $join );
			$fianl = array ();
			if (! empty ( $all_items )) {

				$response ['cart_details'] = $cart_details;
				$response ['cart_items'] = $all_items;
				if ($returndata == "callback") {
					return $response;
				} else {
					return array (
						'status' => "ok",
						'result_set' => $response 
					);
				}
			}
		} else {
			return array (
					'status' => "ok",
					'message' => get_label ( 'rest_cart_empty' ) 
			);
		}
	}

	private function  validateorder($orderPost)
	{

		$errorMsg = array();
		if(empty($orderPost['order_total'])) {
			$errorMsg[] = 'Required Order Total';
		}
		if(empty($orderPost['order_subtotal'])) {
			$errorMsg[] = 'Required Order Sub Total';
		}
		if(empty($orderPost['order_contact_number'])) {
			$errorMsg[] = 'Required Contact Number';
		}
		if(empty($orderPost['OrderItems'])) {
			$errorMsg[] = 'Please buy atleast one product'; 
		}
		/*if(empty($orderPost['cart_quantity'])) {
			$errorMsg[] = 'Cart Quantity Field is Required'; 
		}*/
		
		
		$payment_type ='online';
		

		$status = 'fails';
		if(empty($errorMsg)) 
		{
			$orderItem = (!empty($orderPost['source']) && $orderPost['source'] == 'mobile')?json_decode($orderPost['OrderItems'],true):$orderPost['OrderItems'];
			if(!empty($orderItem))
			{
				$overall_products = array();
				foreach ($orderItem as $key => $valus) {
					foreach($valus as $val) {
						$ppid = ($val['cart_item_subproduct_id'] !='' && $val['cart_item_subproduct_id'] >0)?$val['cart_item_subproduct_id']:$val['cart_item_product_id'];
						$products = $this->Mydb->get_record('*','products',array('product_id'=>$ppid));
						$overall_products[$ppid] = $products;       
						if($val['product_qty'] > $products['product_qty']) {
							$errorMsg[] = $products['product_name'].' - Invalid quantity';
						}

						$product_special_to_date = $product_special_from_date = '';
						if($products['product_special_from_date'] !='0000-00-00 00:00:00') $product_special_from_date = $products['product_special_from_date'];
						if($products['product_special_to_date']!='0000-00-00 00:00:00') $product_special_to_date = $products['product_special_to_date'];

						$discount = find_discount($products['product_price'],$products['product_special_price'],$product_special_from_date,$product_special_to_date);
						

						if($discount>0) {
							$product_price = $products['product_special_price'];
						}
						else {
							$product_price = $products['product_price'];         
						}

						if($val['product_price']!=$product_price) {
							$errorMsg[] = $products['product_name'].' - Invalid price'; 
						}
					}
				}

				if(empty($errorMsg)) {
					foreach ($orderItem as $key => $valus) {
						foreach($valus as $val) {
							$products = $overall_products[$val['subproduct_id']];
							$new_qty = $products['product_qty']-$val['product_qty'];
							$this->Mydb->update('products',array('product_primary_id'=>$products['product_primary_id']),array('product_qty'=>$new_qty));
							//Products::updateAll(['product_qty' => $new_qty],$cartitemwhere);
						}
					}
					$status = 'success';
					$errorMsg[] = 'Continue to proceed';
				}
			}
			else{
				$errorMsg[] = "Invalid Order Items";
			}
			
		}

		return [
		'status' =>$status,
		'message'=>$errorMsg,
		];
	}

	private function placeorder($orderPost) {


		$guid = get_guid('orders','order_id');
		$ip = get_ip ();
		$status ="error";
		$errorMsg = array();

		if($orderPost['order_source'] == 'mobile')
		{
			$orderPost['OrderItems'] = json_decode($orderPost['OrderItems'],true);
		}
		$online_amount = 0;
		$shipping_amount = 0;
		$payment_type ='online';
		$online_amount = $orderPost['order_total'];

		if(empty($errorMsg) && !empty($orderPost['OrderItems'])) {

			$order_local_no = date('dmyHis').'F'.rand(0, 999);
			$order = array(
				'order_id' => $guid,
				'order_local_no' => $order_local_no,
				'order_customer_id' => get_user_id(),
				'order_delivery_charge' => $orderPost['cart_delivery_charge'],
				'order_sub_total' => $orderPost['order_subtotal'],
				'order_total_amount' 	=> $orderPost['order_total'],
				'order_payment_mode'	=> 'online',
				'order_payment_getway_status' => 'Failure',
				'order_date'	=> date('Y-m-d H:i:s'),
				'order_status'	=> 2,
				'order_source'	=> 'Web',
				'order_contact_number'	=> $orderPost['order_contact_number'],
				'order_created_on' => date('Y-m-d H:i:s'),
				'order_created_by'	=> get_user_id(),
				'order_created_ip'	=> get_ip(),
				'order_remarks'		=> $orderPost['order_remarks']
			);
			$order_ID = $this->Mydb->insert ( 'orders', $order );
			
			if(!empty($order_ID)){
				$status = 'success';

				$orderItemId = $this->_insert_order_items($order_ID, $guid, $orderPost['OrderItems'],$orderPost['customer_id']);
				$orderCustomerId = $this->_insert_order_customer($order_ID, $guid, $orderPost);	
				$orderShippingId = $this->_insert_order_shipping_address($order_ID, $guid, $orderPost);
				/*if(isset($orderPost['order_status']) && $orderPost['order_status'] == '1')
				{
					$orders = Orders::find()->joinWith(['ordercustomer','ordercustomer.orderUser','orderItems','orderItems.orderItemModifiers'])->where("order_id='".$order_ID."'")->one();
					if(!empty($orders['ordercustomer']))
					{
						$user = $orders['ordercustomer']['orderUser'];
						$this->_send_notification_order_email($orders,$user);
					}
				}*/
			}
			
		}
		else {
			$status = 'fail';
			$guid = '';
			$order_local_no = '';
			$order_ID = '';
		}

		return array(
			'status' =>$status,
			'message'=>$errorMsg,
			'order_id'=>$guid,
			'order_primary_id'=>$order_ID,
			'order_number'=>$order_local_no
		);


		
	}

	//Order Customer
	private function _insert_order_customer($order_ID, $guid, $orderPost) {
		$address = $this->Mydb->get_record('*','shipping_address',array('userid'=>get_user_id(),'is_default'=>1));
		if(!empty($address)) {
			$order_customer = array(
				'order_customer_order_primary_id' => $order_ID,
				'order_customer_order_id'	=> $guid,
				'order_customer_address_id'	=> $address['address_id'],
				'order_customer_id'	=> $address['userid'],
				'order_customer_fname'	=>$address['first_name'],
				'order_customer_lname'	=> $address['last_name'],
				'order_customer_email'	=> $this->session->userdata('bg_user_email'),
				'order_customer_mobile_no'	=> '',
				'order_customer_unit_no1'	=> $address['floor'],
				'order_customer_unit_no2'	=> $address['unit'],
				'order_customer_address_line1'	=> $address['building_name'],
				'order_customer_address_line2'	=> $address['address'],
				'order_customer_city'	=> '',
				'order_customer_state'	=> '',
				'order_customer_country'	=> '',
				'order_customer_postal_code'	=> $address['postal_code'],
				'order_customer_created_on'	=> date('Y-m-d H:i:s')
			);
			return $order_customer__ID = $this->Mydb->insert ( 'orders_customer_details', $order_customer );
		} else {
			return '';
		}
	}

	//Order Shipping address
	private function _insert_order_shipping_address($order_ID, $guid, $orderPost) {
		if($orderPost['is_default'] !='')
		{
			$address = $this->Mydb->get_record('*','shipping_address',array('userid'=>get_user_id(),'is_default'=>1));
			if(!empty($address)) {


				$order_shipping = array(
					'order_shipping_order_primary_id' => $order_ID,
					'order_shipping_order_id'	=> $guid,
					'order_shipping_address_id'	=> $address['address_id'],
					'order_shipping_first_name'	=>$address['first_name'],
					'order_shipping_last_name'	=> $address['last_name'],
					'order_shipping_company_name'	=> $address['company_name'],
					'order_shipping_floor'	=> $address['floor'],
					'order_shipping_unit'	=> $address['unit'],
					'order_shipping_building_name'	=> $address['building_name'],
					'order_shipping_address'	=> $address['address'],
					'order_shipping_special_info'	=> $address['special_info'],
					'order_shipping_postal_code'	=> $address['postal_code']
				);
				return $orderShipID = $this->Mydb->insert ( 'order_shipping_address', $order_shipping );
			}
		}
		return true;
	}

	
	//Order Item
	private function _insert_order_items($order_ID, $guid, $orderItemPost, $customerID) {

		if(!empty($orderItemPost)) {
			foreach ($orderItemPost as $key => $val) {   
				// insert order item shipping
				$itemshipping = array(
					'shipping_orderid'	=> $guid,
					'shipping_order_primary_id' => $order_ID,
					'shipping_id' => $val['cart_item_shiiping_id'],
					'shipping_name'	=> $val['shipping_name'],
					'shipping_method_price'	=> $val['shipping_method_price'],
				);
				$orderItemShippingId = $this->Mydb->insert ( 'order_item_shipping', $itemshipping );

				$orderitems = array(
					'item_order_primary_id'	=> $order_ID,
					'item_order_id'	=> $guid,
					'item_product_id'	=> $val['cart_item_product_id'],
					'item_subproductid'	=> $val['cart_item_subproduct_id'],
					'item_subproduct_name'	=> $val['cart_item_subproduct_name'],
					'item_name'	=> $val['cart_item_product_name'],
					'item_image'	=> $val['cart_item_product_image'],
					'item_sku'	=> $val['cart_item_product_sku'],
					'item_slug'	=> '',
					'item_specification'	=> '',
					'item_qty'	=> $val['cart_item_qty'],
					'item_unit_price'	=> $val['cart_item_unit_price'],
					'item_total_amount'	=> $val['cart_item_total_price'],
					'shiiping_id'	=> $orderItemShippingId,
					'item_order_status'	=> 1,
					'item_created_on'=>date('Y-m-d H:i:s'),
					'item_placed_on'	=> date('Y-m-d H:i:s'),
					'item_remarks'	=> '',
					'item_merchant_id'	=> $val['cart_item_merchant_id'],
					'item_merchant_name'	=> $val['cart_item_merchant_name'],
				);      
				$orderItemId = $this->Mydb->insert ( 'orders', $order );
				if(!empty($val['attributename'])) {
					$orderOutletId = $this->_insert_order_attributes($order_ID, $guid, $orderItemId, $val); 
				}				
				 //Multi Based On Order Item
			}
			return true;
		} 

	}

	//Order Attributes
	private function _insert_order_attributes($order_ID, $guid, $orderItemId, $postData) { 

		if(!empty($postData)) {
			$attributes = explode(',',$postData['attributename']);
			$attributes_values = explode(',',$postData['attributevaluename']);
			$attributeids = explode(',',$postData['attributeid']);
			$attributevalueids = explode(',',$postData['attributevalueid']);
			if(!empty($attributeids)){

				$attribute_primary_ids = $this->Mydb->get_all_records('pro_modifier_primary_id,pro_modifier_id','product_modifiers',array('pro_modifier_id IN '.implode(',',$attributeids)));
				$att_orginal_primary_id = array();
				if(!empty($attribute_primary_ids)){
					foreach($attribute_primary_ids as $attval) {
						$att_orginal_primary_id[$attval['pro_modifier_id']] = $attval['pro_modifier_primary_id'];
					}
				}

				$attribute_primary_value_ids = $this->Mydb->get_all_records('pro_modifier_value_primary_id,pro_modifier_value_id','product_modifier_values',array('pro_modifier_value_id IN '.implode(',',$attributevalueids)));

				$att_value_orginal_primary_id = array();
				if(!empty($attribute_primary_value_ids)){
					foreach($attribute_primary_value_ids as $attvalues) {
						$att_value_orginal_primary_id[$attvalues['pro_modifier_value_id']] = $attvalues['pro_modifier_value_primary_id'];
					}
				}

				foreach($attributeids as $key=>$values){

					$orderitem_modifiers = array(
						'order_modifier_itemid'	=> $orderItemId,
						'order_modifier_orderid'	=> $guid,
						'order_modifier_order_primary_id'	=> $order_ID,
						'order_modifier_id'	=> $att_orginal_primary_id[$attvalues],
						'order_modifier_name'	=> $attributes[$key],
						'order_modifier_value_id'	=> $att_value_orginal_primary_id[$attributevalueids[$key]],
						'order_modifier_value_name'	=> $attributes_values[$key],
					);      
					$modifier_ids = $this->Mydb->insert ( 'order_item_modifiers', $orderitem_modifiers );
				}
			}
		}
		return true;   
	}

	public function actionOrdervalidate()
	{
		check_ajax_request (); /* skip direct access */
		$params = $response = array();
		$status= "failed";
		$form_error = array();
		$records = '';


		$api_data['reference_id'] = get_user_id();
		$api_data['customer_id'] = get_user_id();
		
		$cart = $this->contents_get ( $reference_id, $customer_id, 'callback' );
		
		if(!empty($cart))
		{
			$order_data = array('order_total'=>$cart['cart_details']['grandtotal'],'order_subtotal'=>$cart['cart_details']['subtotal'],'order_contact_number'=>$this->session->userdata('contact_number'));
			$order_data['OrderItems'] = $cart['cart_items'];
			$order_data['cart_quantity'] = $cart['cart_details']['total_items'];
		}

		$order_data['customer_id'] = get_user_id();
		$order_data['customer_first_name'] = $this->session->userdata('bg_first_name');
		$order_data['customer_last_name'] = $this->session->userdata('bg_last_name');
		$order_data['customer_address_line1'] = $this->session->userdata('bg_last_name');
		$order_data['customer_address_line2'] = $this->session->userdata('bg_last_name');
		$order_data['customer_postal_code'] = $this->session->userdata('bg_last_name');
			
		$order_data['order_payment_type'] = 'online';
		
		$validate_order = $this->validateorder($order_data);
		

		if(!empty($validate_order) && $validate_order['status'] == 'success')
		{
			$payment_method = "online";
			/*place order service */
			$order_data['order_payment_method'] = $payment_method;
			$order_data['order_source'] = 'web';
			$order_data['order_remarks'] = '';
			$place_order = $this->placeorder($order_data);
			if(!empty($place_order) && $place_order['status'] == 'success')
			{
				$this->session->set_userdata('order_reference',$place_order['order_id']);
				$status = 'success';
				if($payment_method == 'online')
				{
					$records = "checkout/proceedpayment";
				}
				else
				{
					$records = "checkout/success";
				}
				/*redirect to the payment page*/
			}
			else if(!empty($place_order))
			{
				$form_error = $place_order['message'];
				/*error in processing the order*/
			}
			else{
				$records = $form_error = "Something Wrong";
			}
		}
		elseif(!empty($validate_order)) {
			
			$form_error = $validate_order['message'];
			/*error in processing the order*/
		}
		else
		{
			$records = $form_error = "Something Wrong";
		}

		return [
			'status' =>$status,
			'data'=>$records,
			'form_error'=>$form_error,
		];
	
	}

	private function deleteshipping($data) {
		$status ="error";
		$message = "Invalid Post Params";
		$form_error = array();
		if(!empty($data))
		{
			$userid = $data['userid'];
			$address_id = $data['address_id'];
			if(isset($userid) && $userid !='' && is_numeric($userid) && isset($address_id) && $address_id !='' && is_numeric($address_id))
			{
				$this->db->delete('shipping_address',array('address_id' => $address_id));
				$message = "Shipping Address deleted successfully";
				$status = "success";
			
			}
			else
			{
				$message = "Invalid User";
			}
		}
		
		return [
			'status' =>$status,
			'message'=>$message,
			'form_error'=>$form_error,
		];	
	}

	private function defaultshipping($data) {
		$status ="error";
		$records = array('message'=>'Invalid Post Params');
		$message = "Invalid Post Params";
		$form_error = array();
		if(!empty($data))
		{
			$userid = $data['userid'];
			$address_id = $data['address_id'];
			$records = array();
			if(isset($userid) && $userid !='' && is_numeric($userid) && isset($address_id) && $address_id !='' && is_numeric($address_id))
			{
				$insert_data = array(
					'is_default' => 1
				);
				$this->Mydb->update ( 'shipping_address', array ('address_id' => $address_id ), $insert_data );

				$this->Mydb->update ( 'shipping_address', array ('userid' => $userid, 'address_id !=' => $address_id ), array('is_default'=>0) );
				$message = "Shipping Address set as default";
				$status = "Success";
			}
			else
			{
				$message = "Invalid User";
				$records = array('message'=>'Invalid User');
			}
		}
		
		return [
			'status' =>$status,
			'message'=>$message,
			'form_error'=>$form_error,
		];	
	}

	private function updateshipping($data) {
		$status ="error";
		$records = array('message'=>'Invalid Post Params');
		$message = "Invalid Post Params";
		$form_error = array();
		if(!empty($data))
		{
			$userid = $data['userid'];
			$address_id = $data['address_id'];
			$records = array();
			if(isset($userid) && $userid !='' && is_numeric($userid) && isset($address_id) && $address_id !='' && is_numeric($address_id))
			{
				$insert_data = array(
					'userid'	=> $userid,
					'first_name' => $data['first_name'],
					'last_name' => $data['last_name'],
					'postal_code' => $data['postal_code'],
					'building_name' => $data['building_name'],
					'floor' => $data['floor'],
					'unit' => $data['unit'],
					'company_name' => $data['company_name'],
					'special_info' => $data['special_info'],
					'created_by'	=> $userid,
					'created_on'	=> date('Y-m-d H:i:s'),
					'created_ip'	=> get_ip()
				);
				$this->Mydb->update ( 'shipping_address', array ('address_id' => $address_id ), $insert_data );
				if($address_id)
				{
					$message = "Shipping Address Updated Successfully ";
					$status ="success";
				}
				else
				{
					$status = "error";	
					$errors = array('Error in shipping');
					$form_error = array();
					foreach($errors as $err_key=>$error)
					{
						foreach($error as $error_val)
						{
							$form_error[] = $error_val;
						}
					}
				}
			}
			else
			{
				$message = "Invalid User";
				$records = array('message'=>'Invalid User');
			}
		}
		
		return [
			'status' =>$status,
			'message'=>$message,
			'form_error'=>$form_error,
		];
	}

	private function addshipping($data) {
		$status ="error";
		$records = array('message'=>'Invalid Post Params');
		$message = "Invalid Post Params";
		$form_error = array();
		if(!empty($data))
		{
			$userid = $data['userid'];
			$records = array();
			if(isset($userid) && $userid !='' && is_numeric($userid))
			{
				$insert_data = array(
					'userid'	=> $userid,
					'first_name' => $data['first_name'],
					'last_name' => $data['last_name'],
					'postal_code' => $data['postal_code'],
					'building_name' => $data['building_name'],
					'floor' => $data['floor'],
					'unit' => $data['unit'],
					'is_default'	=> 1,
					'company_name' => $data['company_name'],
					'special_info' => $data['special_info'],
					'created_by'	=> $userid,
					'created_on'	=> date('Y-m-d H:i:s'),
					'created_ip'	=> get_ip()
				);
				$insert_id = $this->Mydb->insert ( 'shipping_address', $insert_data );
				if($insert_id)
				{
					$this->Mydb->update ( 'shipping_address', array ('userid' => $userid, 'address_id !=' => $insert_id ), array('is_default'=>0) );
					$message = "Shipping Address Added Successfully ";
					$status ="success";
				}
				else
				{
					$status = "error";	
					$errors = array('Error in shipping');
					$form_error = array();
					foreach($errors as $err_key=>$error)
					{
						foreach($error as $error_val)
						{
							$form_error[] = $error_val;
						}
					}
				}
				
			}
			else
			{
				$message = "Invalid User";
				$records = array('message'=>'Invalid User');
			}
		}
		
		return [
			'status' =>$status,
			'message'=>$message,
			'form_error'=>$form_error,
		];
	}

	public function shipping()
	{
			$data = $this->load_module_info ();
			$customer_id = $id = get_user_id ();
			$customer_array = array ('userid' => $customer_id);

			if(!empty($_REQUEST['contact_number'])) {
				$this->session->set_userdata('contact_number',$_REQUEST['contact_number']);
				$this->session->set_userdata('additional_info',$_REQUEST['additional_info']);
				$this->session->set_userdata('is_default',$_REQUEST['is_default']);
				return $this->redirect(['checkout/payment']);
				exit;
			}

			if(!empty($this->input->post('address_id'))) {
				if(!empty($_POST['Shippingaddress']['delete']) && $_POST['Shippingaddress']['delete']==1) {
					$user_data = array('address_id'=>$this->input->post('address_id'),'userid'=>$id);
					$form_error = array();
					$error = '';
					if($this->session->userdata('is_default') == $this->input->post('address_id'))
					{
						$this->session->set_userdata('is_default','');
					}
					$user_data = array_merge($user_data, $_POST);
					$response = $this->deleteshipping($user_data);
					if($response['status'] == 'success')
					{
						//Yii::$app->session->setFlash('success', $response['message']);
						echo json_encode ( array('status'=> 'success') );
						exit ();
					}
					else
					{
						if(!empty($response['form_error']))
						{
							$form_error = $response['form_error'];
						}
						else
						{
							$error = $response['message'];
						}
						echo json_encode(array('status'=>$response['status'],'form_error'=>$form_error,'error'=>$error));
					}
				}
				if(!empty($_POST['Shippingaddress']['default']) && $_POST['Shippingaddress']['default']==1){
					$user_data = array('address_id'=>$this->input->post('address_id'),'userid'=>$id);
					$user_data = array_merge($user_data, $_POST);
					$response = $this->defaultshipping($user_data);
					$form_error = array();
					$error = '';
					if($response['status'] == 'Success')
					{
						echo json_encode ( array('status'=> 'success') );
						exit ();
					}
					else
					{
						if(!empty($response['form_error']))
						{
							$form_error = $response['form_error'];
						}
						else
						{
							$error = $response['message'];
						}
						echo json_encode(array('status'=>$response['status'],'form_error'=>$form_error,'error'=>$error));
					}
				} 
			}
			if($this->input->post('action') == 'update')
			{
				$user_data = $this->input->post('Shippingaddress');
				$user_data['userid'] = $id;
				$user_data['address_id'] = $this->input->post('address_id');
				$form_error = array();
				$error = '';
				$user_data = array_merge($user_data, $_POST);
				$response = $this->updateshipping($user_data);
				if($response['status'] == 'success')
				{
					echo json_encode ( array('status'=> 'success') );
					exit();
				}
				else
				{
					if(!empty($response['form_error']))
					{
						$form_error = $response['form_error'];
					}
					else
					{
						$error = $response['message'];
					}
					echo json_encode(array('status'=>$response['status'],'form_error'=>$form_error,'error'=>$error));
					exit();
				}
			}
			if($this->input->post('action') == 'create')
			{
				$user_data =$this->input->post('Shippingaddress');
				$user_data['userid'] = get_user_id();
				$user_data['postal_code'] = $this->input->post('addressSearch');
				$form_error = array();
				$error = '';
				$user_data = array_merge($user_data, $_POST);
				$response = $this->addshipping($user_data);
				if($response['status'] == 'success')
				{
					echo json_encode ( array('status'=> 'success') );
					exit ();
				}
				else
				{
					if(!empty($response['form_error']))
					{
						$form_error = $response['form_error'];
					}
					else
					{
						$error = $response['message'];
					}
					echo json_encode(array('status'=>$response['status'],'form_error'=>$form_error,'error'=>$error));
				}
			}

			
			$shippingaddress = $this->Mydb->get_all_records ( '*', 'shipping_address', $customer_array,'','' );
			
			$records = array();
			if(!empty($shippingaddress))
			{
				$i=0;
				foreach($shippingaddress as $shipaddress)
				{
					foreach($shipaddress as $shipkey=>$shipval)
					{
						$records[$i][$shipkey] = $shipval;
					}
					$i++;
				}
			}
			$data['shippingaddress'] = $records;
			$this->layout->display_site ( $this->folder . $this->module . "-shipping", $data );
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
