<?php
/**************************
Project Name	: POS
Created on		: 19 Feb, 2016
Last Modified 	: 19 Feb, 2016
Description		: Page contains dashboard related functions.

***************************/
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Dashboard extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		
		$this->authentication->admin_authentication();
		$this->module = "dashboard";
		$this->module_label = "Dashboard";
		$this->module_labels = "Dashboard";
		$this->folder = "dashboard/";
		$this->order_table="orders";
		$this->client_table="clients";
		$this->cart="cart_details";
		$this->customer_table="customers";
		$this->product = "products";
	
	}
	/* this method used to list all records . */
	public function index() {
		
		$data = array();
		
		$data['module_label'] = $this->module_label;
		$data['module_labels'] = $this->module_label;
		$data['module'] = $this->module;
			
			$total_revenue = $this->Mydb->get_all_records('sum(order_total_amount) as total_amount','orders',array('order_status !=' => 5));

			$total_customers = $this->Mydb->get_all_records('count(customer_id) as total_customers',$this->customer_table,array('customer_status'=>'A')); 
			
			$new_signups = $this->Mydb->get_all_records('count(customer_id) as new_signups',$this->customer_table,array('customer_status'=>'P'));
			
			$cart_details = $this->Mydb->get_all_records('count(cart_id) as total_cart','cart_details',array());
			
			$cancel_orders = $this->Mydb->get_all_records('count(order_id) as cancel_orders',$this->order_table,array('order_status =' => 2)); 
	  
		$data['total_revenue'] = number_format($total_revenue[0]['total_amount'],2);
		$data['total_customers'] = number_format($total_customers[0]['total_customers']);
		$data['total_signups'] = number_format($new_signups[0]['new_signups']);
		$data['total_cart'] = number_format($cart_details[0]['total_cart']);
		$data['total_cancel_orders'] = number_format($cancel_orders[0]['cancel_orders']);

		$this->layout->display_admin($this->folder.$this->module ,$data);
		
	}
	
	/* Chart Random Color generation */
	function randColor( $numColors ) {
		$chars = "ABCDEF0123456789";    
		$size = strlen( $chars ); 
		$str = array();
			for( $i = 0; $i < $numColors; $i++ ) {
				for( $j = 0; $j < 6; $j++ ) {  
					$str[$i] .= $chars[ rand( 0, $size - 1 ) ];
				}
			
				foreach($str as $col) {
					$color[$i] = "#".$col;
				}
			}
		return $color;
	}
	
	public function graph() {
		
		$cur_date = date('Y-m-d');
		$last_date = date('Y-m-d', strtotime('-7 days'));
		$now = new DateTime( "7 days ago");  
		$interval = new DateInterval( 'P1D'); // 1 Day interval
		$period = new DatePeriod( $now, $interval, 7); // 7 Days

		$i=0;
		
		foreach( $period as $day) {
				
			$date = $day->format( 'Y-m-d'); 
			$cur_date = date('Y-m-d');

			/* Total Revenue */
			$data['daily_order_dinein'][] = $this->Mydb->get_record('sum(order_total_amount) as daily_order_dinein',$this->order_table,array('DATE(order_created_on) =' => $date,'order_availability_id' => get_availability_id('Dine In'),'order_status !='=> 5));
			
			$data['daily_order_takeaway'][] = $this->Mydb->get_record('sum(order_total_amount) as daily_order_takeaway',$this->order_table,array('DATE(order_created_on) =' => $date,'order_availability_id' => get_availability_id('Pickup'),'order_status !='=> 5));
			
			$data['daily_order_delivery'][] = $this->Mydb->get_record('sum(order_total_amount) as daily_order_delivery',$this->order_table,array('DATE(order_created_on) =' => $date,'order_availability_id' => get_availability_id('Delivery'),'order_status !='=> 5));
					
			$data['daily_order_catering'][] = $this->Mydb->get_record('sum(order_total_amount) as daily_order_catering',$this->order_table,array('DATE(order_created_on) =' => $date,'order_availability_id' => get_availability_id('Catering'),'order_status !='=> 5));
					
			$data['daily_order_reservations'][] = $this->Mydb->get_record('sum(order_total_amount) as daily_order_reservations',$this->order_table,array('DATE(order_created_on) =' => $date,'order_availability_id' => get_availability_id('Reservations'),'order_status !='=> 5));
			
			/* Dine In */
			$data['daily_dinein'][] = $this->Mydb->get_record('sum(order_total_amount) as daily_dinein',$this->order_table,array('DATE(order_created_on) =' => $date,'order_availability_id' => get_availability_id('Dine In'),'order_status !='=> 5));

			/* Delivery */
			$data['daily_delivery'][] = $this->Mydb->get_record('sum(order_total_amount) as daily_delivery',$this->order_table,array('DATE(order_created_on) =' => $date,'order_availability_id' => get_availability_id('Delivery'),'order_status !='=> 5));
			
			/* Takeaway */
			$data['daily_takeaway'][] = $this->Mydb->get_record('sum(order_total_amount) as daily_takeaway',$this->order_table,array('DATE(order_created_on) =' => $date,'order_availability_id' => get_availability_id('Pickup'),'order_status !='=> 5));
			
			/* Catering */
			$data['daily_catering'][] = $this->Mydb->get_record('sum(order_total_amount) as daily_catering',$this->order_table,array('DATE(order_created_on) =' => $date,'order_availability_id' => get_availability_id('Catering'),'order_status !='=> 5));
			
			/* Reservations */
			$data['daily_reservations'][] = $this->Mydb->get_record('sum(order_total_amount) as daily_reservations',$this->order_table,array('DATE(order_created_on) =' => $date,'order_availability_id' => get_availability_id('Reservations'),'order_status !='=> 5));
			
			/* E Commerce, Mobile App, Call Center */
			$data['daily_web'][] = $this->Mydb->get_record('sum(order_total_amount) as daily_web',$this->order_table,array('DATE(order_created_on) =' => $date,'order_source' => 'Web','order_status !='=> 5));
			
			$data['daily_mobile'][] = $this->Mydb->get_record('sum(order_total_amount) as daily_mobile',$this->order_table,array('DATE(order_created_on) =' => $date,'order_source' => 'Mobile','order_status !='=> 5));
			
			$data['daily_callcenter'][] = $this->Mydb->get_record('sum(order_total_amount) as daily_callcenter',$this->order_table,array('DATE(order_created_on) =' => $date,'order_source' => 'CallCenter','order_status !='=> 5));
			
			/* Customer Growth */
			$data['daily_customer_growth'][] = $this->Mydb->get_record('count(customer_id) as daily_customer_growth',$this->customer_table,array('DATE(customer_created_on) =' => $date,'customer_status' => 'A'));

			$key=$day->format( 'd-m-Y');

				$data1['multiple_orders'][] = array('date' => $key,'dinein' => (isset($data['daily_order_dinein'][$i]['daily_order_dinein']) && !empty($data['daily_order_dinein'][$i]['daily_order_dinein'])?number_format($data['daily_order_dinein'][$i]['daily_order_dinein'],2):0),'takeaway' => (isset($data['daily_order_takeaway'][$i]['daily_order_takeaway']) && !empty($data['daily_order_takeaway'][$i]['daily_order_takeaway'])?number_format($data['daily_order_takeaway'][$i]['daily_order_takeaway'],2):0),'delivery' => (isset($data['daily_order_delivery'][$i]['daily_order_delivery']) && !empty($data['daily_order_delivery'][$i]['daily_order_delivery'])?number_format($data['daily_order_delivery'][$i]['daily_order_delivery'],2):0),'catering' => (isset($data['daily_order_catering'][$i]['daily_order_catering']) && !empty($data['daily_order_catering'][$i]['daily_order_catering'])?number_format($data['daily_order_catering'][$i]['daily_order_catering'],2):0),'reservations' => (isset($data['daily_order_reservations'][$i]['daily_order_reservations']) && !empty($data['daily_order_reservations'][$i]['daily_order_reservations'])?number_format($data['daily_order_reservations'][$i]['daily_order_reservations'],2):0));
				
				$data1['multiple_type'][] = array('date' => $key,'web' => (isset($data['daily_web'][$i]['daily_web']) && !empty($data['daily_web'][$i]['daily_web'])?number_format($data['daily_web'][$i]['daily_web'],2):0),'mobile' => (isset($data['daily_mobile'][$i]['daily_mobile']) && !empty($data['daily_mobile'][$i]['daily_mobile'])?number_format($data['daily_mobile'][$i]['daily_mobile'],2):0),'callcenter' => (isset($data['daily_callcenter'][$i]['daily_callcenter']) && !empty($data['daily_callcenter'][$i]['daily_callcenter'])?number_format($data['daily_callcenter'][$i]['daily_callcenter'],2):0));
				
				/* Total Revenue */
				$data1['daily_order_dinein'][][$key]= $data['daily_order_dinein'][$i]['daily_order_dinein'];
				$data1['daily_order_takeaway'][][$key]= $data['daily_order_takeaway'][$i]['daily_order_takeaway'];
				$data1['daily_order_delivery'][][$key]= $data['daily_order_delivery'][$i]['daily_order_delivery'];
				$data1['daily_order_catering'][][$key]= $data['daily_order_catering'][$i]['daily_order_catering'];
				$data1['daily_order_reservations'][][$key]= $data['daily_order_reservations'][$i]['daily_order_reservations'];

				/* Dine In */
				$data1['daily_dinein'][][$key]= (isset($data['daily_dinein'][$i]['daily_dinein']) && !empty($data['daily_dinein'][$i]['daily_dinein'])?$data['daily_dinein'][$i]['daily_dinein']:0);
				
				/* Delivery */
				$data1['daily_delivery'][][$key]= (isset($data['daily_delivery'][$i]['daily_delivery']) && !empty($data['daily_delivery'][$i]['daily_delivery'])?$data['daily_delivery'][$i]['daily_delivery']:0);
				
				/* Takeaway */
				$data1['daily_takeaway'][][$key]= (isset($data['daily_takeaway'][$i]['daily_takeaway']) && !empty($data['daily_takeaway'][$i]['daily_takeaway'])?$data['daily_takeaway'][$i]['daily_takeaway']:0);
				
				/* Catering */
				$data1['daily_catering'][][$key]= (isset($data['daily_catering'][$i]['daily_catering']) && !empty($data['daily_catering'][$i]['daily_catering'])?$data['daily_catering'][$i]['daily_catering']:0);
				
				/* Reservations */
				$data1['daily_reservations'][][$key]= (isset($data['daily_reservations'][$i]['daily_reservations']) && !empty($data['daily_reservations'][$i]['daily_reservations'])?$data['daily_reservations'][$i]['daily_reservations']:0);
				
				/* E Commerce, Mobile App, Call Center */
				$data1['daily_web'][][$key]= $data['daily_web'][$i]['daily_web'];
				$data1['daily_mobile'][][$key]= $data['daily_mobile'][$i]['daily_mobile'];
				$data1['daily_callcenter'][][$key]= $data['daily_callcenter'][$i]['daily_callcenter'];
				
				/* Customer Growth */
				$data1['daily_customer_growth'][][$key]= $data['daily_customer_growth'][$i]['daily_customer_growth'];
			$i++;
		
		}
		
		
		echo json_encode($data1);
			exit;
	}	
	
	public function current_year() {
		$from_year = date("Y"); 
		$year_fday=$from_year.'-01-01';   
		$year_lday=$from_year.'-12-31'; 
			
			$yesterday1=date('Y-m-d', strtotime('-1 day', strtotime(date("d-m-Y"))));  
			$year_day1=date('Y-m-d', strtotime('first day of January this year')); 

			$start    = (new DateTime(!empty($from_year)?$year_fday:$year_day1))->modify('first day of this month');
			$end      = (new DateTime(!empty($from_year)?$year_lday:$yesterday1))->modify('last day of this month'); 
			$interval = DateInterval::createFromDateString('1 month'); 
			$period   = new DatePeriod($start, $interval, $end);

			$i=0;
		
			foreach ($period as $dt) {   
				$months_fday = $dt->format("Y-m-d"); 
				$months_lday =date('Y-m-t',strtotime($dt->format("Y-m-d"))); 

				/* Total Revenue */
				$data['year_order_dinein'][] = $this->Mydb->get_record('sum(order_total_amount) as year_order_dinein',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_availability_id' => get_availability_id('Dine In'),'order_status !='=> 5));
				
				$data['year_order_takeaway'][] = $this->Mydb->get_record('sum(order_total_amount) as year_order_takeaway',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_availability_id' => get_availability_id('Pickup'),'order_status !='=> 5));
				
				$data['year_order_delivery'][] = $this->Mydb->get_record('sum(order_total_amount) as year_order_delivery',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_availability_id' => get_availability_id('Delivery'),'order_status !='=> 5));
				
				$data['year_order_catering'][] = $this->Mydb->get_record('sum(order_total_amount) as year_order_catering',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_availability_id' => get_availability_id('Catering'),'order_status !='=> 5));
				
				$data['year_order_reservations'][] = $this->Mydb->get_record('sum(order_total_amount) as year_order_reservations',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_availability_id' => get_availability_id('Reservations'),'order_status !='=> 5));
				
				/* Dine In */
				$data['year_dinein'][] = $this->Mydb->get_record('sum(order_total_amount) as year_dinein',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_availability_id' => get_availability_id('Dine In'),'order_status !='=> 5));

				/* Delivery */
				$data['year_delivery'][] = $this->Mydb->get_record('sum(order_total_amount) as year_delivery',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_availability_id' => get_availability_id('Delivery'),'order_status !='=> 5));
				
				/* Takeaway */
				$data['year_takeaway'][] = $this->Mydb->get_record('sum(order_total_amount) as year_takeaway',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_availability_id' => get_availability_id('Pickup'),'order_status !='=> 5));
				
				/* Catering */
				$data['year_catering'][] = $this->Mydb->get_record('sum(order_total_amount) as year_catering',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_availability_id' => get_availability_id('Catering'),'order_status !='=> 5));
				
				/* Reservations */
				$data['year_reservations'][] = $this->Mydb->get_record('sum(order_total_amount) as year_reservations',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_availability_id' => get_availability_id('Reservations'),'order_status !='=> 5));
				
				/* E Commerce, Mobile App, Call Center */
				$data['year_web'][] = $this->Mydb->get_record('sum(order_total_amount) as year_web',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_source' => 'Web','order_status !='=> 5));
		
				$data['year_mobile'][] = $this->Mydb->get_record('sum(order_total_amount) as year_mobile',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_source' => 'Mobile','order_status !='=> 5));
		
				$data['year_callcenter'][] = $this->Mydb->get_record('sum(order_total_amount) as year_callcenter',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_source' => 'CallCenter','order_status !='=> 5));
 		
				/* Customer Growth */
				$data['year_customer_growth'][] = $this->Mydb->get_record('count(customer_id) as year_customer_growth',$this->customer_table,array('DATE(customer_created_on) >=' => $months_fday,'DATE(customer_created_on) <=' => $months_lday,'customer_status' => 'A'));

 				$key=$dt->format("M-Y");
 				
 				$data1['multiple_orders'][] = array('date' => $key,'dinein' => (isset($data['year_order_dinein'][$i]['year_order_dinein']) && !empty($data['year_order_dinein'][$i]['year_order_dinein'])?number_format($data['year_order_dinein'][$i]['year_order_dinein'],2):0),'takeaway' => (isset($data['year_order_takeaway'][$i]['year_order_takeaway']) && !empty($data['year_order_takeaway'][$i]['year_order_takeaway'])?number_format($data['year_order_takeaway'][$i]['year_order_takeaway'],2):0),'delivery' => (isset($data['year_order_delivery'][$i]['year_order_delivery']) && !empty($data['year_order_delivery'][$i]['year_order_delivery'])?number_format($data['year_order_delivery'][$i]['year_order_delivery'],2):0),'catering' => (isset($data['year_order_catering'][$i]['year_order_catering']) && !empty($data['year_order_catering'][$i]['year_order_catering'])?number_format($data['year_order_catering'][$i]['year_order_catering'],2):0),'reservations' => (isset($data['year_order_reservations'][$i]['year_order_reservations']) && !empty($data['year_order_reservations'][$i]['year_order_reservations'])?number_format($data['year_order_reservations'][$i]['year_order_reservations'],2):0));
				
				$data1['multiple_type'][] = array('date' => $key,'web' => (isset($data['year_web'][$i]['year_web']) && !empty($data['year_web'][$i]['year_web'])?number_format($data['year_web'][$i]['year_web'],2):0),'mobile' => (isset($data['year_mobile'][$i]['year_mobile']) && !empty($data['year_mobile'][$i]['year_mobile'])?number_format($data['year_mobile'][$i]['year_mobile'],2):0),'callcenter' => (isset($data['year_callcenter'][$i]['year_callcenter']) && !empty($data['year_callcenter'][$i]['year_callcenter'])?number_format($data['year_callcenter'][$i]['year_callcenter'],2):0));
			
				
				/* Total Revenue */
				$data1['year_order_dinein'][][$key]= $data['year_order_dinein'][$i]['year_order_dinein'];
				$data1['year_order_takeaway'][][$key]= $data['year_order_takeaway'][$i]['year_order_takeaway'];
				$data1['year_order_delivery'][][$key]= $data['year_order_delivery'][$i]['year_order_delivery'];
				$data1['year_order_catering'][][$key]= $data['year_order_catering'][$i]['year_order_catering'];
				$data1['year_order_reservations'][][$key]= $data['year_order_reservations'][$i]['year_order_reservations'];
				
				/* Dine In */
				$data1['year_dinein'][][$key]= (isset($data['year_dinein'][$i]['year_dinein']) && !empty($data['year_dinein'][$i]['year_dinein'])?$data['year_dinein'][$i]['year_dinein']:0);
				
				/* Delivery */
				$data1['year_delivery'][][$key]= (isset($data['year_delivery'][$i]['year_delivery']) && !empty($data['year_delivery'][$i]['year_delivery'])?$data['year_delivery'][$i]['year_delivery']:0);
				
				/* Takeaway */
				$data1['year_takeaway'][][$key]= (isset($data['year_takeaway'][$i]['year_takeaway']) && !empty($data['year_takeaway'][$i]['year_takeaway'])?$data['year_takeaway'][$i]['year_takeaway']:0);
				
				/* Catering */
				$data1['year_catering'][][$key]= (isset($data['year_catering'][$i]['year_catering']) && !empty($data['year_catering'][$i]['year_catering'])?$data['year_catering'][$i]['year_catering']:0);
				
				/* Reservations */
				$data1['year_reservations'][][$key]= (isset($data['year_reservations'][$i]['year_reservations']) && !empty($data['year_reservations'][$i]['year_reservations'])?$data['year_reservations'][$i]['year_reservations']:0);
				
				/* E Commerce, Mobile App, Call Center */
				$data1['year_web'][][$key]= $data['year_web'][$i]['year_web'];
				$data1['year_mobile'][][$key]= $data['year_mobile'][$i]['year_mobile'];
				$data1['year_callcenter'][][$key]= $data['year_callcenter'][$i]['year_callcenter'];
			
				/* Customer Growth */
				$data1['year_customer_growth'][][$key] = $data['year_customer_growth'][$i]['year_customer_growth'];
				
				$i=$i+1;

			}
			
		echo json_encode($data1);
			exit;
	}
	
	public function three_months() {
		
		$from_year = date("Y");   
		$year_fday = date("Y-m-d",strtotime("-2 Months"));
		$year_lday = date("Y-m-d"); 

			$yesterday1=date('Y-m-d', strtotime('-1 day', strtotime(date("d-m-Y"))));  
			$year_day1=date('Y-m-d', strtotime('first day of January this year')); 
			
			$start    = (new DateTime(!empty($from_year)?$year_fday:$year_day1))->modify('first day of this month');
			$end      = (new DateTime(!empty($from_year)?$year_lday:$yesterday1))->modify('last day of this month'); 
			$interval = DateInterval::createFromDateString('1 month'); 
			$period   = new DatePeriod($start, $interval, $end);

			$i=0;
			
			foreach ($period as $dt) { 
				$months_fday = $dt->format("Y-m-d"); 
				$months_lday =date('Y-m-t',strtotime($dt->format("Y-m-d"))); 

				/* Total Revenue */
				$data['three_month_order_dinein'][] = $this->Mydb->get_record('sum(order_total_amount) as three_month_order_dinein',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_availability_id' => get_availability_id('Dine In'),'order_status !='=> 5));

				$data['three_month_order_takeaway'][] = $this->Mydb->get_record('sum(order_total_amount) as three_month_order_takeaway',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_availability_id' => get_availability_id('Pickup'),'order_status !='=> 5));
				
				$data['three_month_order_delivery'][] = $this->Mydb->get_record('sum(order_total_amount) as three_month_order_delivery',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_availability_id' => get_availability_id('Delivery'),'order_status !='=> 5));

				$data['three_month_order_catering'][] = $this->Mydb->get_record('sum(order_total_amount) as three_month_order_catering',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_availability_id' => get_availability_id('Catering'),'order_status !='=> 5));
				
				$data['three_month_order_reservations'][] = $this->Mydb->get_record('sum(order_total_amount) as three_month_order_reservations',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_availability_id' => get_availability_id('Reservations'),'order_status !='=> 5));
				
				/* Dine In */
				$data['three_month_dinein'][] = $this->Mydb->get_record('sum(order_total_amount) as three_month_dinein',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_availability_id' => get_availability_id('Dine In'),'order_status !='=> 5));
				
				/* Delivery */
				$data['three_month_delivery'][] = $this->Mydb->get_record('sum(order_total_amount) as three_month_delivery',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_availability_id' => get_availability_id('Delivery'),'order_status !='=> 5));
				
				/* Takeaway */
				$data['three_month_takeaway'][] = $this->Mydb->get_record('sum(order_total_amount) as three_month_takeaway',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_availability_id' => get_availability_id('Pickup'),'order_status !='=> 5));
				
				/* Catering */
				$data['three_month_catering'][] = $this->Mydb->get_record('sum(order_total_amount) as three_month_catering',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_availability_id' => get_availability_id('Catering'),'order_status !='=> 5));
				
				/* Reservations */
				$data['three_month_reservations'][] = $this->Mydb->get_record('sum(order_total_amount) as three_month_reservations',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_availability_id' => get_availability_id('Reservations'),'order_status !='=> 5));
			
				/* E Commerce, Mobile App, Call Center */
				$data['three_month_web'][] = $this->Mydb->get_record('sum(order_total_amount) as three_month_web',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_source' => 'Web','order_status !='=> 5));
			
				$data['three_month_mobile'][] = $this->Mydb->get_record('sum(order_total_amount) as three_month_mobile',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_source' => 'Mobile','order_status !='=> 5));
		
				$data['three_month_callcenter'][] = $this->Mydb->get_record('sum(order_total_amount) as three_month_callcenter',$this->order_table,array('order_created_on >=' => $months_fday,'order_created_on <=' => $months_lday,'order_source' => 'CallCenter','order_status !='=> 5));
 		
				/* Customer Growth */
				$data['three_month_customer_growth'][] = $this->Mydb->get_record('count(customer_id) as three_month_customer_growth',$this->customer_table,array('DATE(customer_created_on) >=' => $months_fday,'DATE(customer_created_on) <=' => $months_lday,'customer_status' => 'A'));

 				$key=$dt->format("M-Y");
 				
 				$data1['multiple_orders'][] = array('date' => $key,'dinein' => (isset($data['three_month_order_dinein'][$i]['three_month_order_dinein']) && !empty($data['three_month_order_dinein'][$i]['three_month_order_dinein'])?number_format($data['three_month_order_dinein'][$i]['three_month_order_dinein'],2):0),'takeaway' => (isset($data['three_month_order_takeaway'][$i]['three_month_order_takeaway']) && !empty($data['three_month_order_takeaway'][$i]['three_month_order_takeaway'])?number_format($data['three_month_order_takeaway'][$i]['three_month_order_takeaway'],2):0),'delivery' => (isset($data['three_month_order_delivery'][$i]['three_month_order_delivery']) && !empty($data['three_month_order_delivery'][$i]['three_month_order_delivery'])?number_format($data['three_month_order_delivery'][$i]['three_month_order_delivery'],2):0),'catering' => (isset($data['three_month_order_catering'][$i]['three_month_order_catering']) && !empty($data['three_month_order_catering'][$i]['three_month_order_catering'])?number_format($data['three_month_order_catering'][$i]['three_month_order_catering'],2):0),'reservations' => (isset($data['three_month_order_reservations'][$i]['three_month_order_reservations']) && !empty($data['three_month_order_reservations'][$i]['three_month_order_reservations'])?number_format($data['three_month_order_reservations'][$i]['three_month_order_reservations'],2):0));
				
				$data1['multiple_type'][] = array('date' => $key,'web' => (isset($data['three_month_web'][$i]['three_month_web']) && !empty($data['three_month_web'][$i]['three_month_web'])?number_format($data['three_month_web'][$i]['three_month_web'],2):0),'mobile' => (isset($data['three_month_mobile'][$i]['three_month_mobile']) && !empty($data['three_month_mobile'][$i]['three_month_mobile'])?number_format($data['three_month_mobile'][$i]['three_month_mobile'],2):0),'callcenter' => (isset($data['three_month_callcenter'][$i]['three_month_callcenter']) && !empty($data['three_month_callcenter'][$i]['three_month_callcenter'])?number_format($data['three_month_callcenter'][$i]['three_month_callcenter'],2):0));
				
				/* Total Revenue */
				$data1['three_month_order_dinein'][][$key]= $data['three_month_order_dinein'][$i]['three_month_order_dinein'];
				$data1['three_month_order_takeaway'][][$key]= $data['three_month_order_takeaway'][$i]['three_month_order_takeaway'];
				$data1['three_month_order_delivery'][][$key]= $data['three_month_order_delivery'][$i]['three_month_order_delivery'];
				$data1['three_month_order_catering'][][$key]= $data['three_month_order_catering'][$i]['three_month_order_catering'];
				$data1['three_month_order_reservations'][][$key]= $data['three_month_order_reservations'][$i]['three_month_order_reservations'];
				
				/* Dine In */
				$data1['three_month_dinein'][][$key]= (isset($data['three_month_dinein'][$i]['three_month_dinein']) && !empty($data['three_month_dinein'][$i]['three_month_dinein'])?$data['three_month_dinein'][$i]['three_month_dinein']:0);
				
				/* Delivery */
				$data1['three_month_delivery'][][$key]= (isset($data['three_month_delivery'][$i]['three_month_delivery']) && !empty($data['three_month_delivery'][$i]['three_month_delivery'])?$data['three_month_delivery'][$i]['three_month_delivery']:0);
				
				/* Takeaway */
				$data1['three_month_takeaway'][][$key]= (isset($data['three_month_takeaway'][$i]['three_month_takeaway']) && !empty($data['three_month_takeaway'][$i]['three_month_takeaway'])?$data['three_month_takeaway'][$i]['three_month_takeaway']:0);
				
				/* Catering */
				$data1['three_month_catering'][][$key]= (isset($data['three_month_catering'][$i]['three_month_catering']) && !empty($data['three_month_catering'][$i]['three_month_catering'])?$data['three_month_catering'][$i]['three_month_catering']:0);
				
				/* Reservations */
				$data1['three_month_reservations'][][$key]= (isset($data['three_month_reservations'][$i]['three_month_reservations']) && !empty($data['three_month_reservations'][$i]['three_month_reservations'])?$data['three_month_reservations'][$i]['three_month_reservations']:0);
				
				/* E Commerce, Mobile App, Call Center */
				$data1['three_month_web'][][$key]= $data['three_month_web'][$i]['three_month_web'];
				$data1['three_month_mobile'][][$key]= $data['three_month_mobile'][$i]['three_month_mobile'];
				$data1['three_month_callcenter'][][$key]= $data['three_month_callcenter'][$i]['three_month_callcenter'];
				
				/* Customer Growth */
				$data1['three_month_customer_growth'][][$key] = $data['three_month_customer_growth'][$i]['three_month_customer_growth'];
			
				$i=$i+1;
			}
		echo json_encode($data1);
			exit;
	}
	
	public function six_months() {
		
		$from_year = date("Y");   
		$year_fday = date("Y-m-d",strtotime("-5 Months"));
		$year_lday = date("Y-m-d"); 

			$yesterday1=date('Y-m-d', strtotime('-1 day', strtotime(date("d-m-Y"))));  
			$year_day1=date('Y-m-d', strtotime('first day of January this year')); 
			
			$start    = (new DateTime(!empty($from_year)?$year_fday:$year_day1))->modify('first day of this month');
			$end      = (new DateTime(!empty($from_year)?$year_lday:$yesterday1))->modify('last day of this month'); 
			$interval = DateInterval::createFromDateString('1 month'); 
			$period   = new DatePeriod($start, $interval, $end);

			$i=0;
			
			foreach ($period as $dt) { 
				$months_fday = $dt->format("Y-m-d"); 
				$months_lday =date('Y-m-t',strtotime($dt->format("Y-m-d"))); 

				/* Total Revenue */
				$data['six_month_order_dinein'][] = $this->Mydb->get_record('sum(order_total_amount) as six_month_order_dinein',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_availability_id' => get_availability_id('Dine In'),'order_status !='=> 5));

				$data['six_month_order_takeaway'][] = $this->Mydb->get_record('sum(order_total_amount) as six_month_order_takeaway',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_availability_id' => get_availability_id('Pickup'),'order_status !='=> 5));
				
				$data['six_month_order_delivery'][] = $this->Mydb->get_record('sum(order_total_amount) as six_month_order_delivery',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_availability_id' => get_availability_id('Delivery'),'order_status !='=> 5));
				
				$data['six_month_order_catering'][] = $this->Mydb->get_record('sum(order_total_amount) as six_month_order_catering',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_availability_id' => get_availability_id('Catering'),'order_status !='=> 5));
				
				$data['six_month_order_reservations'][] = $this->Mydb->get_record('sum(order_total_amount) as six_month_order_reservations',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_availability_id' => get_availability_id('Reservations'),'order_status !='=> 5));
				
				/* Dine In */
				$data['six_month_dinein'][] = $this->Mydb->get_record('sum(order_total_amount) as six_month_dinein',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_availability_id' => get_availability_id('Dine In'),'order_status !='=> 5));
				
				/* Delivery */
				$data['six_month_delivery'][] = $this->Mydb->get_record('sum(order_total_amount) as six_month_delivery',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_availability_id' => get_availability_id('Delivery'),'order_status !='=> 5));
				
				/* Takeaway */
				$data['six_month_takeaway'][] = $this->Mydb->get_record('sum(order_total_amount) as six_month_takeaway',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_availability_id' => get_availability_id('Pickup'),'order_status !='=> 5));
				
				/* Catering */
				$data['six_month_catering'][] = $this->Mydb->get_record('sum(order_total_amount) as six_month_catering',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_availability_id' => get_availability_id('Catering'),'order_status !='=> 5));
				
				/* Reservations */
				$data['six_month_reservations'][] = $this->Mydb->get_record('sum(order_total_amount) as six_month_reservations',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_availability_id' => get_availability_id('Reservations'),'order_status !='=> 5));
				
				/* E Commerce, Mobile App, Call Center */
				$data['six_month_web'][] = $this->Mydb->get_record('sum(order_total_amount) as six_month_web',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_source' => 'Web','order_status !='=> 5));
				
				$data['six_month_mobile'][] = $this->Mydb->get_record('sum(order_total_amount) as six_month_mobile',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_source' => 'Mobile','order_status !='=> 5));
				
				$data['six_month_callcenter'][] = $this->Mydb->get_record('sum(order_total_amount) as six_month_callcenter',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_source' => 'CallCenter','order_status !='=> 5));
				
				/* Customer Growth */
				$data['six_month_customer_growth'][] = $this->Mydb->get_record('count(customer_id) as six_month_customer_growth',$this->customer_table,array('DATE(customer_created_on) >=' => $months_fday,'DATE(customer_created_on) <=' => $months_lday,'customer_status' => 'A'));

 				$key=$dt->format("M-Y");
 				
 				$data1['multiple_orders'][] = array('date' => $key,'dinein' => (isset($data['six_month_order_dinein'][$i]['six_month_order_dinein']) && !empty($data['six_month_order_dinein'][$i]['six_month_order_dinein'])?number_format($data['six_month_order_dinein'][$i]['six_month_order_dinein'],2):0),'takeaway' => (isset($data['six_month_order_takeaway'][$i]['six_month_order_takeaway']) && !empty($data['six_month_order_takeaway'][$i]['six_month_order_takeaway'])?number_format($data['six_month_order_takeaway'][$i]['six_month_order_takeaway'],2):0),'delivery' => (isset($data['six_month_order_delivery'][$i]['six_month_order_delivery']) && !empty($data['six_month_order_delivery'][$i]['six_month_order_delivery'])?number_format($data['six_month_order_delivery'][$i]['six_month_order_delivery'],2):0),'catering' => (isset($data['six_month_order_catering'][$i]['six_month_order_catering']) && !empty($data['six_month_order_catering'][$i]['six_month_order_catering'])?number_format($data['six_month_order_catering'][$i]['six_month_order_catering'],2):0),'reservations' => (isset($data['six_month_order_reservations'][$i]['six_month_order_reservations']) && !empty($data['six_month_order_reservations'][$i]['six_month_order_reservations'])?number_format($data['six_month_order_reservations'][$i]['six_month_order_reservations'],2):0));
				
				$data1['multiple_type'][] = array('date' => $key,'web' => (isset($data['six_month_web'][$i]['six_month_web']) && !empty($data['six_month_web'][$i]['six_month_web'])?number_format($data['six_month_web'][$i]['six_month_web'],2):0),'mobile' => (isset($data['six_month_mobile'][$i]['six_month_mobile']) && !empty($data['six_month_mobile'][$i]['six_month_mobile'])?number_format($data['six_month_mobile'][$i]['six_month_mobile'],2):0),'callcenter' => (isset($data['six_month_callcenter'][$i]['six_month_callcenter']) && !empty($data['six_month_callcenter'][$i]['six_month_callcenter'])?number_format($data['six_month_callcenter'][$i]['six_month_callcenter'],2):0));
				
				/* Total Revenue */
				$data1['six_month_order_dinein'][][$key]= $data['six_month_order_dinein'][$i]['six_month_order_dinein'];
				$data1['six_month_order_takeaway'][][$key]= $data['six_month_order_takeaway'][$i]['six_month_order_takeaway'];
				$data1['six_month_order_delivery'][][$key]= $data['six_month_order_delivery'][$i]['six_month_order_delivery'];
				$data1['six_month_order_catering'][][$key]= $data['six_month_order_catering'][$i]['six_month_order_catering'];
				$data1['six_month_order_reservations'][][$key]= $data['six_month_order_reservations'][$i]['six_month_order_reservations'];
				
				/* Dine In */
				$data1['six_month_dinein'][][$key]= (isset($data['six_month_dinein'][$i]['six_month_dinein']) && !empty($data['six_month_dinein'][$i]['six_month_dinein'])?$data['six_month_dinein'][$i]['six_month_dinein']:0);
				
				/* Delivery */
				$data1['six_month_delivery'][][$key]= (isset($data['six_month_delivery'][$i]['six_month_delivery']) && !empty($data['six_month_delivery'][$i]['six_month_delivery'])?$data['six_month_delivery'][$i]['six_month_delivery']:0);
				
				/* Takeaway */
				$data1['six_month_takeaway'][][$key]= (isset($data['six_month_takeaway'][$i]['six_month_takeaway']) && !empty($data['six_month_takeaway'][$i]['six_month_takeaway'])?$data['six_month_takeaway'][$i]['six_month_takeaway']:0);
				
				/* Catering */
				$data1['six_month_catering'][][$key]= (isset($data['six_month_catering'][$i]['six_month_catering']) && !empty($data['six_month_catering'][$i]['six_month_catering'])?$data['six_month_catering'][$i]['six_month_catering']:0);
				
				/* Reservations */
				$data1['six_month_reservations'][][$key]= (isset($data['six_month_reservations'][$i]['six_month_reservations']) && !empty($data['six_month_reservations'][$i]['six_month_reservations'])?$data['six_month_reservations'][$i]['six_month_reservations']:0);
				
				/* E Commerce, Mobile App, Call Center */
				$data1['six_month_web'][][$key]= $data['six_month_web'][$i]['six_month_web'];
				$data1['six_month_mobile'][][$key]= $data['six_month_mobile'][$i]['six_month_mobile'];
				$data1['six_month_callcenter'][][$key]= $data['six_month_callcenter'][$i]['six_month_callcenter'];
				
				/* Customer Growth */
				$data1['six_month_customer_growth'][][$key] = $data['six_month_customer_growth'][$i]['six_month_customer_growth'];
				
				$i=$i+1;
			}
		echo json_encode($data1);
			exit;
	}
	
	public function multi_graph() {

		$selected_val = $this->input->post('selected_id'); 
		$select_year = $this->input->post('selected_year');
		$selected_from_year = $this->input->post('selected_from_year');
		$selected_to_year = $this->input->post('selected_to_year');
		$selected_from_date = $this->input->post('selected_from_date');
		$selected_to_date = $this->input->post('selected_to_date');
 
		//$color_array = $this->randColor(count($company_details)); 

 		if($selected_val == 1 || $selected_val == '') { 
			$from_year = date("Y");
			$year_fday=$from_year.'-01-01'; 
			$year_lday=$from_year.'-12-31';
			
			$yesterday1=date('Y-m-d', strtotime('-1 day', strtotime(date("d-m-Y"))));  
			$year_day1=date('Y-m-d', strtotime('first day of January this year')); 
			
			$start    = (new DateTime(!empty($from_year)?$year_fday:$year_day1))->modify('first day of this month');
			$end      = (new DateTime(!empty($from_year)?$year_lday:$yesterday1))->modify('last day of this month'); 
			$interval = DateInterval::createFromDateString('1 month'); 
			$period   = new DatePeriod($start, $interval, $end);
			
			$i=0;
			
			foreach ($period as $dt) { 
				$months_fday = $dt->format("Y-m-d");
				$months_lday =date('Y-m-t',strtotime($dt->format("Y-m-d")));
				
				/* Total Revenue */
				$data['dinein'][] = $this->Mydb->get_record('sum(order_total_amount) as dinein',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_availability_id' => get_availability_id('Dine In'),'order_status !='=> 5));
				
				$data['takeaway'][] = $this->Mydb->get_record('sum(order_total_amount) as takeaway',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_availability_id' => get_availability_id('Pickup'),'order_status !='=> 5));
				
				$data['delivery'][] = $this->Mydb->get_record('sum(order_total_amount) as delivery',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_availability_id' => get_availability_id('Delivery'),'order_status !='=> 5));
				
				$data['catering'][] = $this->Mydb->get_record('sum(order_total_amount) as catering',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_availability_id' => get_availability_id('Catering'),'order_status !='=> 5));
				
				$data['reservations'][] = $this->Mydb->get_record('sum(order_total_amount) as reservations',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_availability_id' => get_availability_id('Reservations'),'order_status !='=> 5));
				
				/* Dine In */
				$data['date_dinein'][] = $this->Mydb->get_record('sum(order_total_amount) as date_dinein',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_availability_id' => get_availability_id('Dine In'),'order_status !='=> 5));
				
				/* Delivery */
				$data['date_delivery'][] = $this->Mydb->get_record('sum(order_total_amount) as date_delivery',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_availability_id' => get_availability_id('Delivery'),'order_status !='=> 5));
			
				/* Takeaway */
				$data['date_takeaway'][] = $this->Mydb->get_record('sum(order_total_amount) as date_takeaway',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_availability_id' => get_availability_id('Pickup'),'order_status !='=> 5));
				
				/* Catering */
				$data['date_catering'][] = $this->Mydb->get_record('sum(order_total_amount) as date_catering',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_availability_id' => get_availability_id('Catering'),'order_status !='=> 5));
				
				/* Reservations */
				$data['date_reservations'][] = $this->Mydb->get_record('sum(order_total_amount) as date_reservations',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_availability_id' => get_availability_id('Reservations'),'order_status !='=> 5));
				
				/* E Commerce, Mobile App, Call Center */
				$data['date_web'][] = $this->Mydb->get_record('sum(order_total_amount) as date_web',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_source' => 'Web','order_status !='=> 5));
				
				$data['date_mobile'][] = $this->Mydb->get_record('sum(order_total_amount) as date_mobile',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_source' => 'Mobile','order_status !='=> 5));
				
				$data['date_callcenter'][] = $this->Mydb->get_record('sum(order_total_amount) as date_callcenter',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_source' => 'CallCenter','order_status !='=> 5));
				
				/* Customer Growth */
				$data['date_customer_growth'][] = $this->Mydb->get_record('count(customer_id) as date_customer_growth',$this->customer_table,array('DATE(customer_created_on) >=' => $months_fday,'DATE(customer_created_on) <=' => $months_lday,'customer_status' => 'A'));
				
 				$key=$dt->format("M-Y");
 				
 				$data1['multiple_orders'][] = array('date' => $key,'dinein' => (isset($data['dinein'][$i]['dinein']) && !empty($data['dinein'][$i]['dinein'])?number_format($data['dinein'][$i]['dinein'],2):0),'takeaway' => (isset($data['takeaway'][$i]['takeaway']) && !empty($data['takeaway'][$i]['takeaway'])?number_format($data['takeaway'][$i]['takeaway'],2):0),'delivery' => (isset($data['delivery'][$i]['delivery']) && !empty($data['delivery'][$i]['delivery'])?number_format($data['delivery'][$i]['delivery'],2):0),'catering' => (isset($data['catering'][$i]['catering']) && !empty($data['catering'][$i]['catering'])?number_format($data['catering'][$i]['catering'],2):0),'reservations' => (isset($data['reservations'][$i]['reservations']) && !empty($data['reservations'][$i]['reservations'])?number_format($data['reservations'][$i]['reservations'],2):0));
				
				$data1['multiple_type'][] = array('date' => $key,'web' => (isset($data['date_web'][$i]['date_web']) && !empty($data['date_web'][$i]['date_web'])?number_format($data['date_web'][$i]['date_web'],2):0),'mobile' => (isset($data['date_mobile'][$i]['date_mobile']) && !empty($data['date_mobile'][$i]['date_mobile'])?number_format($data['date_mobile'][$i]['date_mobile'],2):0),'callcenter' => (isset($data['date_callcenter'][$i]['date_callcenter']) && !empty($data['date_callcenter'][$i]['date_callcenter'])?number_format($data['date_callcenter'][$i]['date_callcenter'],2):0));
				
				/* Total Revenue */
				$data1['dinein'][][$key]= $data['dinein'][$i]['dinein'];
				$data1['takeaway'][][$key]= $data['takeaway'][$i]['takeaway'];
				$data1['delivery'][][$key]= $data['delivery'][$i]['delivery'];
				$data1['catering'][][$key]= $data['catering'][$i]['catering'];
				$data1['reservations'][][$key]= $data['reservations'][$i]['reservations'];
				
				/* Dine In */
				$data1['date_dinein'][][$key]= (isset($data['date_dinein'][$i]['date_dinein']) && !empty($data['date_dinein'][$i]['date_dinein'])?$data['date_dinein'][$i]['date_dinein']:0);
				
				/* Delivery */
				$data1['date_delivery'][][$key]= (isset($data['date_delivery'][$i]['date_delivery']) && !empty($data['date_delivery'][$i]['date_delivery'])?$data['date_delivery'][$i]['date_delivery']:0);
				
				/* Takeaway */
				$data1['date_takeaway'][][$key]= (isset($data['date_takeaway'][$i]['date_takeaway']) && !empty($data['date_takeaway'][$i]['date_takeaway'])?$data['date_takeaway'][$i]['date_takeaway']:0);
				
				/* Catering */
				$data1['date_catering'][][$key]= (isset($data['date_catering'][$i]['date_catering']) && !empty($data['date_catering'][$i]['date_catering'])?$data['date_catering'][$i]['date_catering']:0);
				
				/* Reservations */
				$data1['date_reservations'][][$key]= (isset($data['date_reservations'][$i]['date_reservations']) && !empty($data['date_reservations'][$i]['date_reservations'])?$data['date_reservations'][$i]['date_reservations']:0);
				
				/* E Commerce, Mobile App, Call Center */
				$data1['date_web'][][$key]= $data['date_web'][$i]['date_web'];
				$data1['date_mobile'][][$key]= $data['date_mobile'][$i]['date_mobile'];
				$data1['date_callcenter'][][$key]= $data['date_callcenter'][$i]['date_callcenter'];
				
				/* Customer Growth */
				$data1['date_customer_growth'][][$key]= $data['date_customer_growth'][$i]['date_customer_growth'];
				
				$i=$i+1;
			}
			
			echo json_encode($data1);
			exit;

		}


		if($selected_val == 3) { 

			$pre_year = date("Y") - 1;
			
			$startdate = (isset($selected_from_year) && !empty($selected_from_year)?$selected_from_year:$pre_year); 
			
			$enddate = (isset($selected_to_year) && !empty($selected_to_year)?$selected_to_year:date("Y"));
			
			if($startdate == 'From Year' || $enddate == 'To Year') {
				$startdate = date("Y");
				$enddate = date("Y") - 1;
			}

			if($selected_from_year == date("Y")) { 
					$years = range ($enddate,$startdate);
				} else {  
					$years = range ($startdate,$enddate);
				}
			
			$i=0;
			foreach($years as $year){ 
				$year_fday=$year.'-01-01'; 
				$year_lday =$year.'-12-31';
				
				/* Total Revenue */
				$data['dinein'][] = $this->Mydb->get_record('sum(order_total_amount) as dinein',$this->order_table,array('DATE(order_created_on) >=' => $year_fday,'DATE(order_created_on) <=' => $year_lday,'order_availability_id' => get_availability_id('Dine In'),'order_status !='=> 5));
				
				$data['takeaway'][] = $this->Mydb->get_record('sum(order_total_amount) as takeaway',$this->order_table,array('DATE(order_created_on) >=' => $year_fday,'DATE(order_created_on) <=' => $year_lday,'order_availability_id' => get_availability_id('Pickup'),'order_status !='=> 5));
				
				$data['delivery'][] = $this->Mydb->get_record('sum(order_total_amount) as delivery',$this->order_table,array('DATE(order_created_on) >=' => $year_fday,'DATE(order_created_on) <=' => $year_lday,'order_availability_id' => get_availability_id('Delivery'),'order_status !='=> 5));
				
				$data['catering'][] = $this->Mydb->get_record('sum(order_total_amount) as catering',$this->order_table,array('DATE(order_created_on) >=' => $year_fday,'DATE(order_created_on) <=' => $year_lday,'order_availability_id' => get_availability_id('Catering'),'order_status !='=> 5));
				
				$data['reservations'][] = $this->Mydb->get_record('sum(order_total_amount) as reservations',$this->order_table,array('DATE(order_created_on) >=' => $year_fday,'DATE(order_created_on) <=' => $year_lday,'order_availability_id' => get_availability_id('Reservations'),'order_status !='=> 5));
				
				/* Dine In */
				$data['date_dinein'][] = $this->Mydb->get_record('sum(order_total_amount) as date_dinein',$this->order_table,array('DATE(order_created_on) >=' => $year_fday,'DATE(order_created_on) <=' => $year_lday,'order_availability_id' => get_availability_id('Dine In'),'order_status !='=> 5));
				
				/* Delivery */
				$data['date_delivery'][] = $this->Mydb->get_record('sum(order_total_amount) as date_delivery',$this->order_table,array('DATE(order_created_on) >=' => $year_fday,'DATE(order_created_on) <=' => $year_lday,'order_availability_id' => get_availability_id('Delivery'),'order_status !='=> 5));
				
				/* Takeaway */
				$data['date_takeaway'][] = $this->Mydb->get_record('sum(order_total_amount) as date_takeaway',$this->order_table,array('DATE(order_created_on) >=' => $year_fday,'DATE(order_created_on) <=' => $year_lday,'order_availability_id' => get_availability_id('Pickup'),'order_status !='=> 5));
				
				/* Catering */
				$data['date_catering'][] = $this->Mydb->get_record('sum(order_total_amount) as date_catering',$this->order_table,array('DATE(order_created_on) >=' => $year_fday,'DATE(order_created_on) <=' => $year_lday,'order_availability_id' => get_availability_id('Catering'),'order_status !='=> 5));
				
				/* Reservations */
				$data['date_reservations'][] = $this->Mydb->get_record('sum(order_total_amount) as date_reservations',$this->order_table,array('DATE(order_created_on) >=' => $year_fday,'DATE(order_created_on) <=' => $year_lday,'order_availability_id' => get_availability_id('Reservations'),'order_status !='=> 5));
				
				/* E Commerce, Mobile App, Call Center */
				$data['date_web'][] = $this->Mydb->get_record('sum(order_total_amount) as date_web',$this->order_table,array('DATE(order_created_on) >=' => $year_fday,'DATE(order_created_on) <=' => $year_lday,'order_source' => 'Web','order_status !='=> 5));
				
				$data['date_mobile'][] = $this->Mydb->get_record('sum(order_total_amount) as date_mobile',$this->order_table,array('DATE(order_created_on) >=' => $year_fday,'DATE(order_created_on) <=' => $year_lday,'order_source' => 'Mobile','order_status !='=> 5));
				
				$data['date_callcenter'][] = $this->Mydb->get_record('sum(order_total_amount) as date_callcenter',$this->order_table,array('DATE(order_created_on) >=' => $year_fday,'DATE(order_created_on) <=' => $year_lday,'order_source' => 'CallCenter','order_status !='=> 5));
				
				/* Customer Growth */
				$data['date_customer_growth'][] = $this->Mydb->get_record('count(customer_id) as date_customer_growth',$this->customer_table,array('DATE(customer_created_on) >=' => $year_fday,'DATE(customer_created_on) <=' => $year_lday,'customer_status' => 'A'));

				$key=$year;
				
				$data1['multiple_orders'][] = array('date' => $key,'dinein' => (isset($data['dinein'][$i]['dinein']) && !empty($data['dinein'][$i]['dinein'])?number_format($data['dinein'][$i]['dinein'],2):0),'takeaway' => (isset($data['takeaway'][$i]['takeaway']) && !empty($data['takeaway'][$i]['takeaway'])?number_format($data['takeaway'][$i]['takeaway'],2):0),'delivery' => (isset($data['delivery'][$i]['delivery']) && !empty($data['delivery'][$i]['delivery'])?number_format($data['delivery'][$i]['delivery'],2):0),'catering' => (isset($data['catering'][$i]['catering']) && !empty($data['catering'][$i]['catering'])?number_format($data['catering'][$i]['catering'],2):0),'reservations' => (isset($data['reservations'][$i]['reservations']) && !empty($data['reservations'][$i]['reservations'])?number_format($data['reservations'][$i]['reservations'],2):0));
				
				$data1['multiple_type'][] = array('date' => $key,'web' => (isset($data['date_web'][$i]['date_web']) && !empty($data['date_web'][$i]['date_web'])?number_format($data['date_web'][$i]['date_web'],2):0),'mobile' => (isset($data['date_mobile'][$i]['date_mobile']) && !empty($data['date_mobile'][$i]['date_mobile'])?number_format($data['date_mobile'][$i]['date_mobile'],2):0),'callcenter' => (isset($data['date_callcenter'][$i]['date_callcenter']) && !empty($data['date_callcenter'][$i]['date_callcenter'])?number_format($data['date_callcenter'][$i]['date_callcenter'],2):0));
				
				$data1['dinein'][][$key]= $data['dinein'][$i]['dinein'];
				$data1['takeaway'][][$key]= $data['takeaway'][$i]['takeaway'];
				$data1['delivery'][][$key]= $data['delivery'][$i]['delivery'];
				$data1['catering'][][$key]= $data['catering'][$i]['catering'];
				$data1['reservations'][][$key]= $data['reservations'][$i]['reservations'];
				
				/* Dine In */
				$data1['date_dinein'][][$key]= (isset($data['date_dinein'][$i]['date_dinein']) && !empty($data['date_dinein'][$i]['date_dinein'])?$data['date_dinein'][$i]['date_dinein']:0);
				
				/* Delivery */
				$data1['date_delivery'][][$key]= (isset($data['date_delivery'][$i]['date_delivery']) && !empty($data['date_delivery'][$i]['date_delivery'])?$data['date_delivery'][$i]['date_delivery']:0);
				
				/* Takeaway */
				$data1['date_takeaway'][][$key]= (isset($data['date_takeaway'][$i]['date_takeaway']) && !empty($data['date_takeaway'][$i]['date_takeaway'])?$data['date_takeaway'][$i]['date_takeaway']:0);
				
				/* Catering */
				$data1['date_catering'][][$key]= (isset($data['date_catering'][$i]['date_catering']) && !empty($data['date_catering'][$i]['date_catering'])?$data['date_catering'][$i]['date_catering']:0);
				
				/* Reservations */
				$data1['date_reservations'][][$key]= (isset($data['date_reservations'][$i]['date_reservations']) && !empty($data['date_reservations'][$i]['date_reservations'])?$data['date_reservations'][$i]['date_reservations']:0);
				
				/* E Commerce, Mobile App, Call Center */
				$data1['date_web'][][$key]= $data['date_web'][$i]['date_web'];
				$data1['date_mobile'][][$key]= $data['date_mobile'][$i]['date_mobile'];
				$data1['date_callcenter'][][$key]= $data['date_callcenter'][$i]['date_callcenter'];
				
				/* Customer Growth */
				$data1['date_customer_growth'][][$key]= $data['date_customer_growth'][$i]['date_customer_growth'];
				
				$i++;
				
			}
			
			echo json_encode($data1);
						exit;
			
		}
		
	
		if($selected_val == 2)
		{
			$from_year = $this->input->post('selected_year'); 
			$selected_from_year = (isset($from_year) && !empty($from_year)?$from_year:date("Y")); 
			if($selected_from_year == 'Select Year') {
				$selected_from_year = date("Y");
			}
			$year_fday=$selected_from_year.'-01-01'; 
			$year_lday=$selected_from_year.'-12-31';

			$yesterday1=date('Y-m-d', strtotime('-1 day', strtotime(date("d-m-Y")))); 
			$year_day1=date('Y-m-d', strtotime('first day of January this year')); 

			$start    = (new DateTime(!empty($selected_from_year)?$year_fday:$year_day1))->modify('first day of this month');
			$end      = (new DateTime(!empty($selected_from_year)?$year_lday:$yesterday1))->modify('last day of this month'); 
			$interval = DateInterval::createFromDateString('1 month'); 
			$period   = new DatePeriod($start, $interval, $end);
			
			$i=0;	
			
			foreach ($period as $dt) { 
				$months_fday = $dt->format("Y-m-d");
				$months_lday =date('Y-m-t',strtotime($dt->format("Y-m-d"))); 
				
				/* Total Revenue */
				$data['dinein'][] = $this->Mydb->get_record('sum(order_total_amount) as dinein',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_availability_id' => get_availability_id('Dine In'),'order_status !='=> 5));
				
				$data['takeaway'][] = $this->Mydb->get_record('sum(order_total_amount) as takeaway',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_availability_id' => get_availability_id('Pickup'),'order_status !='=> 5));
				
				$data['delivery'][] = $this->Mydb->get_record('sum(order_total_amount) as delivery',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_availability_id' => get_availability_id('Delivery'),'order_status !='=> 5));
				
				$data['catering'][] = $this->Mydb->get_record('sum(order_total_amount) as catering',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_availability_id' => get_availability_id('Catering'),'order_status !='=> 5));
				
				$data['reservations'][] = $this->Mydb->get_record('sum(order_total_amount) as reservations',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_availability_id' => get_availability_id('Reservations'),'order_status !='=> 5));
				
				/* Dine In */
				$data['date_dinein'][] = $this->Mydb->get_record('sum(order_total_amount) as date_dinein',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_availability_id' => get_availability_id('Dine In'),'order_status !='=> 5));
				
				/* Delivery */
				$data['date_delivery'][] = $this->Mydb->get_record('sum(order_total_amount) as date_delivery',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_availability_id' => get_availability_id('Delivery'),'order_status !='=> 5));
				
				/* Takeaway */
				$data['date_takeaway'][] = $this->Mydb->get_record('sum(order_total_amount) as date_takeaway',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_availability_id' => get_availability_id('Pickup'),'order_status !='=> 5));
				
				/* Catering */
				$data['date_catering'][] = $this->Mydb->get_record('sum(order_total_amount) as date_catering',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_availability_id' => get_availability_id('Catering'),'order_status !='=> 5));
				
				/* Reservations */
				$data['date_reservations'][] = $this->Mydb->get_record('sum(order_total_amount) as date_reservations',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_availability_id' => get_availability_id('Reservations'),'order_status !='=> 5));
				
				/* E Commerce, Mobile App, Call Center */
				$data['date_web'][] = $this->Mydb->get_record('sum(order_total_amount) as date_web',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_source' => 'Web','order_status !='=> 5));
				
				$data['date_mobile'][] = $this->Mydb->get_record('sum(order_total_amount) as date_mobile',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_source' => 'Mobile','order_status !='=> 5));
				
				$data['date_callcenter'][] = $this->Mydb->get_record('sum(order_total_amount) as date_callcenter',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_source' => 'CallCenter','order_status !='=> 5));
				
				/* Customer Growth */
				$data['date_customer_growth'][] = $this->Mydb->get_record('count(customer_id) as date_customer_growth',$this->customer_table,array('DATE(customer_created_on) >=' => $months_fday,'DATE(customer_created_on) <=' => $months_lday,'customer_status' => 'A'));
			
				$key=$dt->format("M-Y");
				
				$data1['multiple_orders'][] = array('date' => $key,'dinein' => (isset($data['dinein'][$i]['dinein']) && !empty($data['dinein'][$i]['dinein'])?number_format($data['dinein'][$i]['dinein'],2):0),'takeaway' => (isset($data['takeaway'][$i]['takeaway']) && !empty($data['takeaway'][$i]['takeaway'])?number_format($data['takeaway'][$i]['takeaway'],2):0),'delivery' => (isset($data['delivery'][$i]['delivery']) && !empty($data['delivery'][$i]['delivery'])?number_format($data['delivery'][$i]['delivery'],2):0),'catering' => (isset($data['catering'][$i]['catering']) && !empty($data['catering'][$i]['catering'])?number_format($data['catering'][$i]['catering'],2):0),'reservations' => (isset($data['reservations'][$i]['reservations']) && !empty($data['reservations'][$i]['reservations'])?number_format($data['reservations'][$i]['reservations'],2):0));
				
				$data1['multiple_type'][] = array('date' => $key,'web' => (isset($data['date_web'][$i]['date_web']) && !empty($data['date_web'][$i]['date_web'])?number_format($data['date_web'][$i]['date_web'],2):0),'mobile' => (isset($data['date_mobile'][$i]['date_mobile']) && !empty($data['date_mobile'][$i]['date_mobile'])?number_format($data['date_mobile'][$i]['date_mobile'],2):0),'callcenter' => (isset($data['date_callcenter'][$i]['date_callcenter']) && !empty($data['date_callcenter'][$i]['date_callcenter'])?number_format($data['date_callcenter'][$i]['date_callcenter'],2):0));
			
				$data1['dinein'][][$key]= $data['dinein'][$i]['dinein'];
				$data1['takeaway'][][$key]= $data['takeaway'][$i]['takeaway'];
				$data1['delivery'][][$key]= $data['delivery'][$i]['delivery'];
				$data1['catering'][][$key]= $data['catering'][$i]['catering'];
				$data1['reservations'][][$key]= $data['reservations'][$i]['reservations'];
				
				/* Dine In */
				$data1['date_dinein'][][$key]= (isset($data['date_dinein'][$i]['date_dinein']) && !empty($data['date_dinein'][$i]['date_dinein'])?$data['date_dinein'][$i]['date_dinein']:0);
				
				/* Delivery */
				$data1['date_delivery'][][$key]= (isset($data['date_delivery'][$i]['date_delivery']) && !empty($data['date_delivery'][$i]['date_delivery'])?$data['date_delivery'][$i]['date_delivery']:0);
				
				/* Takeaway */
				$data1['date_takeaway'][][$key]= (isset($data['date_takeaway'][$i]['date_takeaway']) && !empty($data['date_takeaway'][$i]['date_takeaway'])?$data['date_takeaway'][$i]['date_takeaway']:0);
				
				/* Catering */
				$data1['date_catering'][][$key]= (isset($data['date_catering'][$i]['date_catering']) && !empty($data['date_catering'][$i]['date_catering'])?$data['date_catering'][$i]['date_catering']:0);
				
				/* Reservations */
				$data1['date_reservations'][][$key]= (isset($data['date_reservations'][$i]['date_reservations']) && !empty($data['date_reservations'][$i]['date_reservations'])?$data['date_reservations'][$i]['date_reservations']:0);
				
				/* E Commerce, Mobile App, Call Center */
				$data1['date_web'][][$key]= $data['date_web'][$i]['date_web'];
				$data1['date_mobile'][][$key]= $data['date_mobile'][$i]['date_mobile'];
				$data1['date_callcenter'][][$key]= $data['date_callcenter'][$i]['date_callcenter'];
				
				/* Customer Growth */
				$data1['date_customer_growth'][][$key]= $data['date_customer_growth'][$i]['date_customer_growth'];
		
			$i=$i+1;
			}

				echo json_encode($data1);
						exit;
		}
		
		if($selected_val == 4)
		{
			$from_date = get_date_formart($this->input->post('selected_from_date'),'Y-m-d'); 
			$to_date = get_date_formart($this->input->post('selected_to_date'),'Y-m-d'); 
			$selected_from_date = (isset($from_date) && !empty($from_date)?$from_date:''); 
			$selected_to_date = (isset($to_date) && !empty($to_date)?$to_date:''); 
			if($selected_from_date == 'From Date') {
				$selected_from_year = '';
			}
			if($selected_to_date == 'To Date') {
				$selected_to_year = '';
			}
			$year_fday=$selected_from_date; 
			$year_lday=$selected_to_date;

			$begin = new DateTime( $year_fday );
			$end = new DateTime( $year_lday );

			$interval = DateInterval::createFromDateString('1 day');
			$period = new DatePeriod($begin, $interval, $end); 

			$i=0;	
			
			if($year_fday == $year_lday) {
				/* Total Revenue */
				$data['dinein'][] = $this->Mydb->get_record('sum(order_total_amount) as dinein',$this->order_table,array('DATE(order_created_on) >=' => $year_fday,'DATE(order_created_on) <=' => $year_lday,'order_availability_id' => get_availability_id('Dine In'),'order_status !='=> 5));

				$data['takeaway'][] = $this->Mydb->get_record('sum(order_total_amount) as takeaway',$this->order_table,array('DATE(order_created_on) >=' => $year_fday,'DATE(order_created_on) <=' => $year_lday,'order_availability_id' => get_availability_id('Pickup'),'order_status !='=> 5));
				
				$data['delivery'][] = $this->Mydb->get_record('sum(order_total_amount) as delivery',$this->order_table,array('DATE(order_created_on) >=' => $year_fday,'DATE(order_created_on) <=' => $year_lday,'order_availability_id' => get_availability_id('Delivery'),'order_status !='=> 5));
				
				$data['catering'][] = $this->Mydb->get_record('sum(order_total_amount) as catering',$this->order_table,array('DATE(order_created_on) >=' => $year_fday,'DATE(order_created_on) <=' => $year_lday,'order_availability_id' => get_availability_id('Catering'),'order_status !='=> 5));
				
				$data['reservations'][] = $this->Mydb->get_record('sum(order_total_amount) as reservations',$this->order_table,array('DATE(order_created_on) >=' => $year_fday,'DATE(order_created_on) <=' => $year_lday,'order_availability_id' => get_availability_id('Reservations'),'order_status !='=> 5));
				
				/* Dine In */
				$data['date_dinein'][] = $this->Mydb->get_record('sum(order_total_amount) as date_dinein',$this->order_table,array('DATE(order_created_on) >=' => $year_fday,'DATE(order_created_on) <=' => $year_lday,'order_availability_id' => get_availability_id('Dine In'),'order_status !='=> 5));
				
				/* Delivery */
				$data['date_delivery'][] = $this->Mydb->get_record('sum(order_total_amount) as date_delivery',$this->order_table,array('DATE(order_created_on) >=' => $year_fday,'DATE(order_created_on) <=' => $year_lday,'order_availability_id' => get_availability_id('Delivery'),'order_status !='=> 5));
				
				/* Takeaway */
				$data['date_takeaway'][] = $this->Mydb->get_record('sum(order_total_amount) as date_takeaway',$this->order_table,array('DATE(order_created_on) >=' => $year_fday,'DATE(order_created_on) <=' => $year_lday,'order_availability_id' => get_availability_id('Pickup'),'order_status !='=> 5));
				
				/* Catering */
				$data['date_catering'][] = $this->Mydb->get_record('sum(order_total_amount) as date_catering',$this->order_table,array('DATE(order_created_on) >=' => $year_fday,'DATE(order_created_on) <=' => $year_lday,'order_availability_id' => get_availability_id('Catering'),'order_status !='=> 5));
				
				/* Reservations */
				$data['date_reservations'][] = $this->Mydb->get_record('sum(order_total_amount) as date_reservations',$this->order_table,array('DATE(order_created_on) >=' => $year_fday,'DATE(order_created_on) <=' => $year_lday,'order_availability_id' => get_availability_id('Reservations'),'order_status !='=> 5));
				
				/* E Commerce, Mobile App, Call Center */
				$data['date_web'][] = $this->Mydb->get_record('sum(order_total_amount) as date_web',$this->order_table,array('DATE(order_created_on) >=' => $year_fday,'DATE(order_created_on) <=' => $year_lday,'order_source' => 'Web','order_status !='=> 5));
				
				$data['date_mobile'][] = $this->Mydb->get_record('sum(order_total_amount) as date_mobile',$this->order_table,array('DATE(order_created_on) >=' => $year_fday,'DATE(order_created_on) <=' => $year_lday,'order_source' => 'Mobile','order_status !='=> 5));
				
				$data['date_callcenter'][] = $this->Mydb->get_record('sum(order_total_amount) as date_callcenter',$this->order_table,array('DATE(order_created_on) >=' => $year_fday,'DATE(order_created_on) <=' => $year_lday,'order_source' => 'CallCenter','order_status !='=> 5));

				/* Customer Growth */
				$data['date_customer_growth'][] = $this->Mydb->get_record('count(customer_id) as date_customer_growth',$this->customer_table,array('DATE(customer_created_on) >=' => $year_fday,'DATE(customer_created_on) <=' => $year_lday,'customer_status' => 'A'));
				
				$key=$year_fday;

				$data1['multiple_orders'][] = array('date' => $key,'dinein' => (isset($data['dinein'][$i]['dinein']) && !empty($data['dinein'][$i]['dinein'])?number_format($data['dinein'][$i]['dinein'],2):0),'takeaway' => (isset($data['takeaway'][$i]['takeaway']) && !empty($data['takeaway'][$i]['takeaway'])?number_format($data['takeaway'][$i]['takeaway'],2):0),'delivery' => (isset($data['delivery'][$i]['delivery']) && !empty($data['delivery'][$i]['delivery'])?number_format($data['delivery'][$i]['delivery'],2):0),'catering' => (isset($data['catering'][$i]['catering']) && !empty($data['catering'][$i]['catering'])?number_format($data['catering'][$i]['catering'],2):0),'reservations' => (isset($data['reservations'][$i]['reservations']) && !empty($data['reservations'][$i]['reservations'])?number_format($data['reservations'][$i]['reservations'],2):0));
				
				$data1['multiple_type'][] = array('date' => $key,'web' => (isset($data['date_web'][$i]['date_web']) && !empty($data['date_web'][$i]['date_web'])?number_format($data['date_web'][$i]['date_web'],2):0),'mobile' => (isset($data['date_mobile'][$i]['date_mobile']) && !empty($data['date_mobile'][$i]['date_mobile'])?number_format($data['date_mobile'][$i]['date_mobile'],2):0),'callcenter' => (isset($data['date_callcenter'][$i]['date_callcenter']) && !empty($data['date_callcenter'][$i]['date_callcenter'])?number_format($data['date_callcenter'][$i]['date_callcenter'],2):0));
				
				/* Dine In */
				$data1['date_dinein'][][$key]= (isset($data['date_dinein'][$i]['date_dinein']) && !empty($data['date_dinein'][$i]['date_dinein'])?$data['date_dinein'][$i]['date_dinein']:0);
				
				/* Delivery */
				$data1['date_delivery'][][$key]= (isset($data['date_delivery'][$i]['date_delivery']) && !empty($data['date_delivery'][$i]['date_delivery'])?$data['date_delivery'][$i]['date_delivery']:0);
				
				/* Takeaway */
				$data1['date_takeaway'][][$key]= (isset($data['date_takeaway'][$i]['date_takeaway']) && !empty($data['date_takeaway'][$i]['date_takeaway'])?$data['date_takeaway'][$i]['date_takeaway']:0);
				
				/* Catering */
				$data1['date_catering'][][$key]= (isset($data['date_catering'][$i]['date_catering']) && !empty($data['date_catering'][$i]['date_catering'])?$data['date_catering'][$i]['date_catering']:0);
				
				/* Reservations */
				$data1['date_reservations'][][$key]= (isset($data['date_reservations'][$i]['date_reservations']) && !empty($data['date_reservations'][$i]['date_reservations'])?$data['date_reservations'][$i]['date_reservations']:0);
				
				/* E Commerce, Mobile App, Call Center */
				$data1['date_web'][][$key]= $data['date_web'][$i]['date_web'];
				$data1['date_mobile'][][$key]= $data['date_mobile'][$i]['date_mobile'];
				$data1['date_callcenter'][][$key]= $data['date_callcenter'][$i]['date_callcenter'];
				
				/* Customer Growth */
				$data1['date_customer_growth'][][$key]= $data['date_customer_growth'][$i]['date_customer_growth'];
		
			$i=$i+1;
			}
			
			foreach ($period as $dt) { 
				$months_fday = $dt->format("Y-m-d");
				//$months_lday =date('Y-m-t',strtotime($dt->format("Y-m-d"))); 
				$months_lday = get_date_formart($year_lday,'Y-m-d');

				/* Total Revenue */
				$data['dinein'][] = $this->Mydb->get_record('sum(order_total_amount) as dinein',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_availability_id' => get_availability_id('Dine In'),'order_status !='=> 5));

				$data['takeaway'][] = $this->Mydb->get_record('sum(order_total_amount) as takeaway',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_availability_id' => get_availability_id('Pickup'),'order_status !='=> 5));
				
				$data['delivery'][] = $this->Mydb->get_record('sum(order_total_amount) as delivery',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_availability_id' => get_availability_id('Delivery'),'order_status !='=> 5));
				
				$data['catering'][] = $this->Mydb->get_record('sum(order_total_amount) as catering',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_availability_id' => get_availability_id('Catering'),'order_status !='=> 5));
				
				$data['reservations'][] = $this->Mydb->get_record('sum(order_total_amount) as reservations',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_availability_id' => get_availability_id('Reservations'),'order_status !='=> 5));
				
				/* Dine In */
				$data['date_dinein'][] = $this->Mydb->get_record('sum(order_total_amount) as date_dinein',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_availability_id' => get_availability_id('Dine In'),'order_status !='=> 5));
				
				/* Delivery */
				$data['date_delivery'][] = $this->Mydb->get_record('sum(order_total_amount) as date_delivery',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_availability_id' => get_availability_id('Delivery'),'order_status !='=> 5));
				
				/* Takeaway */
				$data['date_takeaway'][] = $this->Mydb->get_record('sum(order_total_amount) as date_takeaway',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_availability_id' => get_availability_id('Pickup'),'order_status !='=> 5));
				
				/* Catering */
				$data['date_catering'][] = $this->Mydb->get_record('sum(order_total_amount) as date_catering',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_availability_id' => get_availability_id('Catering'),'order_status !='=> 5));
				
				/* Reservations */
				$data['date_reservations'][] = $this->Mydb->get_record('sum(order_total_amount) as date_reservations',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_availability_id' => get_availability_id('Reservations'),'order_status !='=> 5));
				
				/* E Commerce, Mobile App, Call Center */
				$data['date_web'][] = $this->Mydb->get_record('sum(order_total_amount) as date_web',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_source' => 'Web','order_status !='=> 5));
				
				$data['date_mobile'][] = $this->Mydb->get_record('sum(order_total_amount) as date_mobile',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_source' => 'Mobile','order_status !='=> 5));
				
				$data['date_callcenter'][] = $this->Mydb->get_record('sum(order_total_amount) as date_callcenter',$this->order_table,array('DATE(order_created_on) >=' => $months_fday,'DATE(order_created_on) <=' => $months_lday,'order_source' => 'CallCenter','order_status !='=> 5));
				
				/* Customer Growth */
				$data['date_customer_growth'][] = $this->Mydb->get_record('count(customer_id) as date_customer_growth',$this->customer_table,array('DATE(customer_created_on) >=' => $months_fday,'DATE(customer_created_on) <=' => $months_lday,'customer_status' => 'A'));
			
				$key=$dt->format("d-m-Y");
				
				$data1['multiple_orders'][] = array('date' => $key,'dinein' => (isset($data['dinein'][$i]['dinein']) && !empty($data['dinein'][$i]['dinein'])?number_format($data['dinein'][$i]['dinein'],2):0),'takeaway' => (isset($data['takeaway'][$i]['takeaway']) && !empty($data['takeaway'][$i]['takeaway'])?number_format($data['takeaway'][$i]['takeaway'],2):0),'delivery' => (isset($data['delivery'][$i]['delivery']) && !empty($data['delivery'][$i]['delivery'])?number_format($data['delivery'][$i]['delivery'],2):0),'catering' => (isset($data['catering'][$i]['catering']) && !empty($data['catering'][$i]['catering'])?number_format($data['catering'][$i]['catering'],2):0),'reservations' => (isset($data['reservations'][$i]['reservations']) && !empty($data['reservations'][$i]['reservations'])?number_format($data['reservations'][$i]['reservations'],2):0));
				
				$data1['multiple_type'][] = array('date' => $key,'web' => (isset($data['date_web'][$i]['date_web']) && !empty($data['date_web'][$i]['date_web'])?number_format($data['date_web'][$i]['date_web'],2):0),'mobile' => (isset($data['date_mobile'][$i]['date_mobile']) && !empty($data['date_mobile'][$i]['date_mobile'])?number_format($data['date_mobile'][$i]['date_mobile'],2):0),'callcenter' => (isset($data['date_callcenter'][$i]['date_callcenter']) && !empty($data['date_callcenter'][$i]['date_callcenter'])?number_format($data['date_callcenter'][$i]['date_callcenter'],2):0));
			
				$data1['dinein'][][$key]= $data['dinein'][$i]['dinein'];
				$data1['takeaway'][][$key]= $data['takeaway'][$i]['takeaway'];
				$data1['delivery'][][$key]= $data['delivery'][$i]['delivery'];
				$data1['catering'][][$key]= $data['catering'][$i]['catering'];
				$data1['reservations'][][$key]= $data['reservations'][$i]['reservations'];
				
				/* Dine In */
				$data1['date_dinein'][][$key]= (isset($data['date_dinein'][$i]['date_dinein']) && !empty($data['date_dinein'][$i]['date_dinein'])?$data['date_dinein'][$i]['date_dinein']:0);
				
				/* Delivery */
				$data1['date_delivery'][][$key]= (isset($data['date_delivery'][$i]['date_delivery']) && !empty($data['date_delivery'][$i]['date_delivery'])?$data['date_delivery'][$i]['date_delivery']:0);
				
				/* Takeaway */
				$data1['date_takeaway'][][$key]= (isset($data['date_takeaway'][$i]['date_takeaway']) && !empty($data['date_takeaway'][$i]['date_takeaway'])?$data['date_takeaway'][$i]['date_takeaway']:0);
				
				/* Catering */
				$data1['date_catering'][][$key]= (isset($data['date_catering'][$i]['date_catering']) && !empty($data['date_catering'][$i]['date_catering'])?$data['date_catering'][$i]['date_catering']:0);
				
				/* Reservations */
				$data1['date_reservations'][][$key]= (isset($data['date_reservations'][$i]['date_reservations']) && !empty($data['date_reservations'][$i]['date_reservations'])?$data['date_reservations'][$i]['date_reservations']:0);
				
				/* E Commerce, Mobile App, Call Center */
				$data1['date_web'][][$key]= $data['date_web'][$i]['date_web'];
				$data1['date_mobile'][][$key]= $data['date_mobile'][$i]['date_mobile'];
				$data1['date_callcenter'][][$key]= $data['date_callcenter'][$i]['date_callcenter'];
				
				/* Customer Growth */
				$data1['date_customer_growth'][][$key]= $data['date_customer_growth'][$i]['date_customer_growth'];
		
			$i=$i+1;
			}

				echo json_encode($data1);
						exit;
		}
		
	}
	
	
}


