<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	 function __construct() {
		parent::__construct ();
		$this->load->library ( 'form_validation' );
		$this->form_validation->set_error_delimiters ( '<p>', '</p>' );
		$this->table = "orders";
		//$this->load->helper('promotion');
		//asashvahs
	}		/* this function used to product menu component items */
	public function product_menu_component_get($order_id="",$item_id="",$type,$field,$response=null) {  
		$result = $output_result = array ();
		$com_set = $this->Mydb->get_all_records(array('menu_menu_component_id','menu_menu_component_name'),'order_menu_set_components',array(  'menu_item_id' => $item_id  ),'','','','','menu_menu_component_id');

		$set_value =array();
		  if(!empty($com_set)){
		  	
		  	   foreach( $com_set as $set ){
		  	   	
		  	   	$set_value['menu_component_id'] = $set['menu_menu_component_id'];
		  	   	$set_value['menu_component_name'] = $set['menu_menu_component_name'];

		  	   	        /* get prodict details */  	   	
		  	         	$menu_items =   $this->Mydb->get_all_records(array('menu_primary_id','menu_product_id','menu_product_name','menu_product_sku'),'order_menu_set_components',array('menu_item_id' => $item_id,'menu_menu_component_id' => $set['menu_menu_component_id']  ));
		  	         	$product_details = array();
		  	         	 if(!empty($menu_items)){
		  	         	 	
		  	         	 	 foreach($menu_items as $items){
		  	         	 	 	$items['modifiers']  =  $this->product_modifiers_get($order_id,$items['menu_primary_id'],'MenuSetComponent',$field,'callback');
		  	         	 	 	 $product_details[] = $items;
		  	         	 	 	 
		  	         	 	 	 
		  	         	 	   }
		  	         	 
		  	         	 	   $set_value['product_details'] = $product_details;
		  	         	 	  // $set_value['product_details']['modifiers'] = $modifiers;
		  	         	 	   $output_result[] = $set_value;
		  	         	 }
		  	        

		  	   }
		  }
		  return $output_result; 
	}
	
public function product_modifiers_get($order_id="",$item_id="",$type,$field,$response=null) {
		
		$result = array();
		$modifiers = $this->Mydb->get_all_records('order_modifier_id,order_modifier_name','order_modifiers',array('order_modifier_type' =>$type, $field => $item_id, 'order_modifier_parent' =>'' ));
		
		 if(!empty($modifiers)){
		 	
		 	 foreach($modifiers as $modvalues)
		 	  {
		 	 	  /* get modifier values */
		 	  	  $modifier_values = $this->Mydb->get_all_records(array('order_modifier_id','order_modifier_name','order_modifier_qty','order_modifier_price'),'order_modifiers',array('order_modifier_type' =>$type, $field => $item_id, 'order_modifier_parent' => $modvalues['order_modifier_id'] ));
		 	  	  
		 	  	  if(!empty($modifier_values)){
		 	  	  	$modvalues['modifiers_values'] = $modifier_values;
		 	  	  	$result[] =  $modvalues;
		 	  	  }
		 	  }
		 }
		 return $result;
	}
	public function index()
	{
		//The file path of the file that we want to move.
//In this case, we have a txt file called sample-file.txt
$currentFilePath = FCPATH.'newfile.txt';

//Where we want to move the file to. In this example, we
//are moving the .txt file from directory_a to directory_b
$newFilePath = FCPATH.'upload_photo/sample-file.txt';

//Move the file using PHP's rename function.
$fileMoved = rename($currentFilePath, $newFilePath);

if($fileMoved){
    echo 'Success!';
}

		 $this->load->view('welcome_message');
	}
	
	
	
	
 private function alterTable()
 {
 //echo 232323; exit;
 
   $result = $this->Mydb->custom_query("show tables");
   
    if(!empty($result)){
    
     //foreach($result as $val) {
     //echo $val['Tables_in_ninjaos']; exit;
       // echo "<pre>";
      //  echo  $val['Tables_in_ninjaos_ninja']; exit;
      
      // $alt_qry = "ALTER TABLE ".$row[$i]." CONVERT TO CHARSET utf8";
       
       // $this->Mydb->custom_query_single($alt_qry);
       //$this->db->query("ALTER TABLE ".$val['Tables_in_ninjaos_ninja']." CONVERT TO CHARSET utf8");
        
       // echo $this->db->last_query(); exit;
    // }
    }
   //  print_r($result); exit;
 
 }
	
	
	function is_in_polygon($points_polygon, $vertices_x, $vertices_y, $longitude_x, $latitude_y)
	{
		$i = $j = $c = 0;
		for ($i = 0, $j = $points_polygon ; $i < $points_polygon; $j = $i++) {
			if ( (($vertices_y[$i]  >  $latitude_y != ($vertices_y[$j] > $latitude_y)) &&
					($longitude_x < ($vertices_x[$j] - $vertices_x[$i]) * ($latitude_y - $vertices_y[$i]) / ($vertices_y[$j] - $vertices_y[$i]) + $vertices_x[$i]) ) )
				$c = !$c;
		}
		return $c;
	}
	
	
	public function order_email()
	{
		$order_primary_id = 1245;

		/*$company = app_validation ( $this->post ( 'app_id' ) ); */
		
		$order_items = array();
		$company = app_validation ( '97440967-AC09-422A-B5C2-BBA4D8C3D989' );
        $app_id =  $company['client_app_id'];
		$company_id = $company['client_id'];
		$order_id = $order_primary_id;

		$where = array ('order_primary_id' => $order_id );
		
		$join[0]['select'] ="order_customer_id,CONCAT(order_customer_fname, ' ', order_customer_lname) AS customer_name,order_customer_email,order_customer_mobile_no,
		order_customer_unit_no1,order_customer_unit_no2,order_customer_address_line1,order_customer_address_line2,order_customer_city,
		order_customer_state,order_customer_country,order_customer_postal_code,order_customer_created_on";
		$join[0]['table'] ="pos_orders_customer_details";
		$join[0]['condition'] ="order_primary_id = order_customer_order_primary_id";
		$join[0]['type']= "LEFT"; 
		
		/* join tables - Status  table  */
		$join[1]['select'] ="status_name";
		$join[1]['table'] ="pos_order_status";
		$join[1]['condition'] ="order_status = status_id AND status_enabled='A' ";
		$join[1]['type']= "LEFT";
		
       /* join tables - admin user  table  */
		$join[2]['select'] ="CONCAT(user_fname, ' ', user_lname) AS order_agent";
		$join[2]['table'] ="pos_company_users";
		$join[2]['condition'] ="user_id = order_callcenter_admin_id";
		$join[2]['type']= "LEFT";
		
		/* join tables - Status  table  */
		$join[3]['select'] ="order_method_name";
		$join[3]['table'] ="pos_order_methods";
		$join[3]['condition'] ="order_payment_mode = order_method_id  ";
		$join[3]['type']= "LEFT";
		
	    /*order table values*/	
		$select_values = array('order_primary_id','order_id','order_outlet_id','order_delivery_charge','order_tax_charge','order_discount_applied',
		'order_discount_amount','order_sub_total','order_total_amount','order_payment_mode','order_date','order_status','order_availability_id',
		'order_availability_name','order_pickup_time','order_pickup_outlet_id','order_source','order_callcenter_admin_id','order_local_no');	
		
		/*order item values*/	
		$select_product_values = array('item_image','item_id','item_product_id','item_name','item_sku','item_qty','item_unit_price','item_total_amount','item_created_on'
		    ,'item_placed_on');	

		$select_modifier_values = array('order_item_id','order_modifier_id','order_modifier_parent','order_modifier_name','order_modifier_price','order_modifier_qty','order_modifier_type');

		/*get order list from query*/
		$order_list=$this->Mydb->get_all_records($select_values, $this->table, $where,  '', '', array ('order_primary_id' => 'DESC' ), '', array('order_primary_id'), $join,'');
		
		
		/*echo $this->db->last_query();
		
		exit;*/

		/*check order empty*/
		if(!empty($order_list))
		{
			
			foreach($order_list as $odlist) {  // print_r($odlist); exit;
			   /* get product details.. */
			 	$order_items = $this->Mydb->get_all_records('*','pos_order_items',array('item_order_primary_id' => $odlist['order_primary_id']));
			 	$fianl = array();
			 	 if(!empty($order_items))
			 	 {  //echo 2;
			 	     $i=0;
			 	 	 foreach($order_items as $items){ 
				 	 	 	/* get modifier values...*/
					      	$modifier_array =array(); /* old code null*/
					      
					      	$modifier_array= $this->product_modifiers_get($odlist['order_primary_id'],$items['item_id'],'Modifier','order_item_id','callback');
					      
					       
					        $order_items[$i]['modifiers']= $modifier_array;
					        
					        /* get menu set component values */
						     $menu_components = array();
						     $menu_components = $this->product_menu_component_get($odlist['order_primary_id'],$items['item_id'],'MenuSetComponent','order_menu_primary_id','callback');
						     $order_items[$i]['set_menu_component'] = $menu_components;
						     $i++;
						     
					 }
			 	 }
			 	  
			 	   
			 }
		    
		}

		$data['order_list'] = $order_list;
		$data['oder_item'] = $order_items;
		$data['company'] = $company;

		$content = $this->load->view("order_email",$data,true);

		$base_url = ($company['client_site_url'] !='')? trim($company['client_site_url'],'/') : base_url();

		$emai_logo = $base_url."/media/email-logo/email-logo.jpg";

		$this->load->library('myemail');

		$check_arr = array('[LOGOURL]','[NAME]','[COMPANY_NAME]','[ORDER_DETAILS]');
		$replace_arr = array( $emai_logo,ucfirst(stripslashes($order_list[0]['customer_name'])),$company['client_name'],$content);
       
	   
		 $email_template_id = get_emailtemplate($app_id, 'order-confirmation');
		
		if($email_template_id != '') {
         //echo $order_list[0]['order_customer_email'];
			$this->myemail->send_client_mail1(stripslashes($order_list[0]['order_customer_email']),$email_template_id['order-confirmation-delivery'],$check_arr,$replace_arr,$company['client_id'],$company['client_app_id']);

		}

	    $check_arr = array('[LOGOURL]','[NAME]','[ORDER_DETAILS]');
		$replace_arr = array($emai_logo, ucfirst(stripslashes($company['client_name'])),$content );
        
	    $email_template_id = get_emailtemplate($app_id, 'order-notification');
	   
		if($email_template_id != '') {
//echo $company['client_from_email'];
			$this->myemail->send_client_mail(stripslashes($company['client_from_email']),$email_template_id,$check_arr,$replace_arr,$company['client_id'],$company['client_app_id']);

		}

	}
	
	
	function mailcheck()
	{
		echo 232323;
		
		//$ci = get_instance();
		$this->load->library('email');
		$config['protocol'] = "smtp";
		$config['smtp_host'] = "ssl://smtp.gmail.com";
		$config['smtp_port'] = "465";
		$config['smtp_user'] = "rmarktest4@gmail.com"; 
		$config['smtp_pass'] = "Testing44";
		$config['charset'] = "utf-8";
		$config['mailtype'] = "html";
		$config['newline'] = "\r\n";
		
		
		$this->email->initialize($config);
		
		$this->email->from('rmarktest4@gmail.com', 'Blabla');
		$list = array('k2b.vinoth@gmail.com');
		$this->email->to($list);
		$this->email->reply_to('my-email@gmail.com', 'Explendid Videos');
		$this->email->subject('This is an email test');
		$this->email->message('It is working. Great!!!!!');
		$this->email->send();

		echo $this->email->print_debugger(); exit;
	}
	

 
	
	
	function sendmail()
	{
		
		
		$config = array();
                $config['useragent']           = "CodeIgniter";
                $config['mailpath']            = "/usr/bin/sendmail"; // or "/usr/sbin/sendmail"
                $config['protocol']            = "smtp";
                $config['smtp_host']           = "ssl://smtp.googlemail.com";
                $config['smtp_port']           = "25";
                $config['mailtype'] = 'html';
                $config['charset']  = 'utf-8';
                $config['newline']  = "\r\n";
                $config['wordwrap'] = TRUE;

                $this->load->library('email');

                $this->email->initialize($config);

                $this->email->from('k2b.vinoth@gmail.com', 'admin');
                $this->email->to('k2b.vinoth@gmail.com');
              //  $this->email->cc('xxx@gmail.com'); 
              //  $this->email->bcc($this->input->post('email')); 
                $this->email->subject('Registration Verification: Continuous Imapression');
                $msg = "Thanks for signing up!
            Your account has been created, 
            you can login with your credentials after you have activated your account by pressing the url below.
            Please click this link to activate your account:<a href=\"".base_url('user/verify')."/{$verification_code}\">Click Here</a>";

            $this->email->message($msg);   
            //$this->email->message($this->load->view('email/'.$type.'-html', $data, TRUE));

            $this->email->send();}
	
	function demo_map()
	{
		
		$region_str = "1.452630680066244,103.76719951629639|1.4321236454296795,103.76883029937744|1.424744500068848,103.77131938934326|1.4215697442038389,103.77157688140869|1.4256883455637785,103.77732753753662|1.4264605824990968,103.78642559051514|1.4229426121412128,103.79457950592041|1.4172795266416178,103.80281925201416|1.4140189559774234,103.80616664886475|1.4057817044480525,103.80908489227295|1.4007192125157024,103.81311893463135|1.396343151352414,103.81449222564697|1.3941980203539588,103.81852626800537|1.3928251354889476,103.8266372680664|1.3957425148700466,103.83989810943604|1.4044088263631063,103.83689403533936|1.405266875260746,103.84255886077881|1.4096429197313765,103.85045528411865|1.4322952531791027,103.86719226837158|1.453660317087389,103.85328769683838|1.4725369122540852,103.82616519927979|1.4715930862755853,103.79724025726318";
		$region_str_explode= explode('|',$region_str);
		$polygon=array();
		foreach($region_str_explode as $reg)
		{
			list($explat,$explng) = explode(',',$reg);
			$polygon[] = array($explat,$explng);
		}
		//echo "<pre>"; print_r($polygon);
		/*$polygon = array(
				array(0,0),
				array(0,5),
				array(4,3),
				array(3,0),
				array(0,0),
		);
		print_r($polygon); */
		//$polygon= array($region_str_explode);
		//print_r($polygon); 
		//exit;
		
		$point1 = array(1.452630680066244,103.76719951629639);
		
		echo $this->contains($point1,$polygon)?'IN':'OUT';
		echo "<br />";
		
		$point2 = array(4,4);
		
		echo $this->contains($point2,$polygon)?'IN':'OUT';
	}
	
	
	function contains($point, $polygon)
	{
		if($polygon[0] != $polygon[count($polygon)-1])
			$polygon[count($polygon)] = $polygon[0];
		$j = 0;
		$oddNodes = false;
		$x = $point[1];
		$y = $point[0];
		$n = count($polygon);
		for ($i = 0; $i < $n; $i++)
		{
		$j++;
			if ($j == $n)
			{
			$j = 0;
		}
		if ((($polygon[$i][0] < $y) && ($polygon[$j][0] >= $y)) || (($polygon[$j][0] < $y) && ($polygon[$i][0] >=
				$y)))
		{
		if ($polygon[$i][1] + ($y - $polygon[$i][0]) / ($polygon[$j][0] - $polygon[$i][0]) * ($polygon[$j][1] -
				$polygon[$i][1]) < $x)
		{
			$oddNodes = !$oddNodes;
			}
			}
			}
			return $oddNodes;
	}
	function test_ios_message() {



$this->load->library ('push');
$countPush = 1;


//$deviceToken = '8fdaf0d12b371dab37457b7740463cf298f8ba00819a1b2ec4daa99e76cbaaa1';

$deviceToken = 'be7c2724 c3c6e76e 44b35b36 a95e0d68 1948351d 71fe80f1 260cddeb ff4d70eb';

//$deviceToken = 'b3a667c380ae821e4cfa9d35f4f7ba083befcf8a2324106ccd19bd68b344c472';

/*	$deviceToken = 'fb11666cdf67a8944ad3cc00d4bcf93c85ad83a30ea8a26a8ac6926f9fe5b09d';*/



$message = 'hai,push notify!-dine';

$msg_data['aps']['alert'] = $message;

$status = $this->push->push_message_ios ( $deviceToken, $msg_data,$countPush );



echo $status;
exit;	

    }
	
	public function testing_push_ios()
	{
		$this->load->library ('push');
		$ios_array = "be7c2724c3c6e76e44b35b36a95e0d681948351d71fe80f1260cddebff4d70eb";
		$message = $data = array ("alert" => "Test from code",'banner_img'=>"",'url'=>"");
		echo $response = $this->push->sendIospush($ios_array,$message);
	}
}
