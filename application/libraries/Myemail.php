<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**************************
 Project Name	:  Pos
Created on		: Feb 29, 2016
Last Modified 	: Feb 29, 2016
Description		: Common email library
***************************/
class Myemail
{
protected $ci;

public function __construct()
 {
	$this->ci =& get_instance();
 }
	
/* this function used to send e-email in masteradmin panel */
 
 function send_admin_mail($to_email_address,$template_id,$chk_arr,$rep_arr)
 {
    $site_title = 'Bloggoto';
   	$this->ci =  & get_instance();
 	$template_table = "pos_admin_email_templates";
 	$setting_table = "pos_master_admin_settings";
 		
 	$query = "SELECT e.email_subject,e.email_content,s.settings_from_email,s.settings_admin_email,s.settings_site_title,s.settings_mail_from_smtp,s.settings_smtp_host,s.settings_smtp_user,s.settings_smtp_pass,s.settings_smtp_port,s.settings_mailpath,s.settings_email_footer FROM  $template_table as e LEFT JOIN $setting_table as s ON  s.settings_id =1  WHERE  e.email_id = '".$template_id."'  ";
 	
	$result = $this->ci->Mydb->custom_query_single($query);
		
		
 	if(!empty($result))
 	{
 		/* get basic mail config values */
 		$to_email = ($to_email_address == '')? $result['settings_admin_email']  : $to_email_address;
 		$from_email = $result['settings_from_email'];
 		$site_title = ucfirst($result['settings_site_title']);
 		$subject = $result['email_subject'];
 		$email_content = $result['email_content'];
 		 
		 
		
		 
 		/* merge contents */
 		$chk_arr1 = array('[LOGOURL]','[BASEURL]','[COPY-CONTENT]','[ADMIN-EMAIL]','[SITE-TITLE]');
 		$rep_array2 = array(load_lib()."theme/images/email_logo.png",base_url(),$result['settings_email_footer'],$result['settings_admin_email'],$site_title);
 		$final_chk_arr = array_merge($chk_arr,$chk_arr1);
 		$final_rep_arr = array_merge($rep_arr,$rep_array2);
 		$message1 = str_replace($final_chk_arr, $final_rep_arr, $email_content);
 		$datas = array('CONTENT' => $message1 );
 		$this->ci->load->library(array('parser','email'));
 		$message = $this->ci->parser->parse('email_template_head', $datas,true);
 		

		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		// More headers
		$headers .= 'From: <'.$from_email.'>' . "\r\n";

		$email_status = mail($to_email_address,$subject,$message,$headers); 
		
		
		
 	
 		/* mail part */
 		/*
			if($result['settings_mail_from_smtp']==1)
			{
				$config['smtp_host']	= $result['settings_smtp_host'];
				$config['smtp_user']	= $result['settings_smtp_user'];
				$config['smtp_pass']	= $result['settings_smtp_pass'];
				$config['smtp_port']	= $result['settings_smtp_port'];
				$config['mailpath'] 	= $result['settings_mailpath'];
				$config['protocol'] 	= 'smtp';
				$config['smtp_crypto']  = 'tls';
			}
			else
			{
				$config['protocol'] = 'sendmail';
			} 
			$config['protocol'] = 'sendmail';

			
			$config['wordwrap'] 	= TRUE;
			$config['charset'] 		= "utf-8";
			$config['mailtype'] 	= "html";
			$config['newline'] 		= "\r\n";
			$this->ci->email->initialize($config);
			$this->ci->email->from($from_email,$site_title);
			$this->ci->email->to($to_email);
			$this->ci->email->subject($subject);
			$this->ci->email->message($message);
			echo $email_status = $this->ci->email->send();
			echo "<pre>";
			print_r($this->ci->email->print_debugger());
			echo "file inn";
			exit;
		*/
 		if($email_status)
 		{
 			return 1;
 		}
 		else
 		{
 			return 0;
 		}
 
 	}

 }
 function send_client_mail1($to_email_address,$template_id,$chk_arr,$rep_arr,$client_id,$app_id,$pdf_url=null)
 {
	 
 	$this->ci =  & get_instance();

 	$client_template_table = "pos_email_templates";
 	$setting_table = "pos_clients";

 	$query = " SELECT e.email_subject,e.email_content,s.client_from_email,s.client_to_email,s.client_site_name,s.client_sendmail_form_smptp,s.client_logo,s.client_folder_name,s.client_site_url,s.client_smpt_host,s.client_smpt_user,s.client_smpt_password,s.client_smpt_port,s.client_mail_path,s.client_email_footer_content FROM  $client_template_table as e
 	LEFT JOIN $setting_table as s ON  s.client_id ='".$client_id."' AND s.client_app_id='".$app_id."'  WHERE  e.email_id = '".$template_id."'";
   
 	$result = $this->ci->Mydb->custom_query_single($query);
    //echo '<pre>';
   // print_r($result);
    //exit;
 	if(!empty($result))
 	{
 		/* get basic mail config values */
 		$to_email = ($to_email_address == '')? $result['client_to_email']  : $to_email_address;
 		$from_email = $result['client_to_email'];
 		$site_title = ucfirst($result['client_site_name']);
 		$subject = stripcslashes($result['email_subject']);
 		$email_content = stripcslashes($result['email_content']);

 		/* merge contents */
 		$base_url=($result['client_site_url'] !='')? $result['client_site_url']  : base_url();
 		
 		$chk_arr1 = array('[BASEURL]','[COPY-CONTENT]','[ADMIN-EMAIL]','[SITE-TITLE]');
 		$rep_array2 = array($base_url,$result['client_email_footer_content'],$result['client_to_email'],$site_title);

 		$final_chk_arr = array_merge($chk_arr,$chk_arr1);
 		$final_rep_arr = array_merge($rep_arr,$rep_array2);

 		$message1 = str_replace($final_chk_arr, $final_rep_arr, $email_content);
 		$datas = array('CONTENT' => $message1 );
       
 		$this->ci->load->library(array('parser','email'));

 		$message = $this->ci->parser->parse('email_template_head', $datas,true);
       
 		/* mail part */

 		if($result['client_sendmail_form_smptp'] == 1)
 		{
			//echo "1";
			//exit;
 			$config['smtp_host']	= $result['client_smpt_host'];
 			$config['smtp_user']	= $result['client_smpt_user'];
 			$config['smtp_pass']	= $result['client_smpt_password'];
 			$config['smtp_port']	= $result['client_smpt_port'];
 			$config['mailpath'] 	= $result['client_mail_path'];
 			$config['protocol'] 	= 'sendmail';
 			
 		}
 		else
 		{
			//echo "2";
			//exit;
 			$config['protocol'] 	= 'sendmail';
 		}

 		$config['charset'] 		= 'iso-8859-1';
 		$config['wordwrap'] 	= TRUE;
 		$config['charset'] 		= "utf-8";
 		$config['mailtype'] 	= "html";
 		$config['newline'] 		= "\r\n";
 		$this->ci->email->initialize($config);
 		$this->ci->email->from($from_email,$site_title);
 		$this->ci->email->to($to_email);
 		$this->ci->email->subject($subject);
 		$this->ci->email->message($message);
 		if(!empty($pdf_url))
 		{
 		$this->ci->email->attach($pdf_url);
 		}
 		$email_status = $this->ci->email->send();	
 	   
 		
 
		/*$headers = "From: " . $from_email . "\r\n";
		$headers .= "Reply-To: ". $from_email . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	    mail($to_email, $subject, $message, $headers)
	    * */
		

        if ($email_status) 
        {
 	
 	    echo $this->ci->email->print_debugger();
 	    echo '<pre>';
 	    print_r(error_get_last());
 		echo '1';
        exit;
 			return 1;
 		}
 		else
 		{
		 echo $this->ci->email->print_debugger();
		 echo '<pre>';
 	     print_r(error_get_last());
		 echo '2';
         exit;
 			return 0;
 		}
 		 
 		 
 	}
 	
 }
 function send_client_mail($to_email_address,$template_id,$chk_arr,$rep_arr,$client_id,$app_id,$pdf_url=null)
 {
	 //echo $to_email_address;
	 //echo $template_id;
	 //print_r($chk_arr);
	 //print_r($rep_arr);
	 //echo $client_id;
	 //echo $app_id;
	 //exit;
	 
 	$this->ci =  & get_instance();

 	$client_template_table = "pos_email_templates";
 	$setting_table = "pos_clients";

 	$query = " SELECT e.email_subject,e.email_content,s.client_from_email,s.client_to_email,s.client_site_name,s.client_sendmail_form_smptp,s.client_logo,s.client_folder_name,s.client_site_url,s.client_smpt_host,s.client_smpt_user,s.client_smpt_password,s.client_smpt_port,s.client_mail_path,s.client_email_footer_content FROM  $client_template_table as e
 	LEFT JOIN $setting_table as s ON  s.client_id ='".$client_id."' AND s.client_app_id='".$app_id."'  WHERE  e.email_id = '".$template_id."'";

 	$result = $this->ci->Mydb->custom_query_single($query);

 	if(!empty($result))
 	{
 		/* get basic mail config values */
 		$to_email = ($to_email_address == '')? $result['client_to_email']  : $to_email_address;
 		$from_email = $result['client_to_email'];
 		$site_title = ucfirst($result['client_site_name']);
 		$subject = $result['email_subject'];
 		$email_content = stripcslashes($result['email_content']);

 		/* merge contents */
 		$base_url=($result['client_site_url'] !='')? $result['client_site_url']  : base_url();
 		
 		$chk_arr1 = array('[BASEURL]','[COPY-CONTENT]','[ADMIN-EMAIL]','[SITE-TITLE]');
 		$rep_array2 = array($base_url,$result['client_email_footer_content'],$result['client_to_email'],$site_title);

 		$final_chk_arr = array_merge($chk_arr,$chk_arr1);
 		$final_rep_arr = array_merge($rep_arr,$rep_array2);

 		$message1 = str_replace($final_chk_arr, $final_rep_arr, $email_content);
 		$datas = array('CONTENT' => $message1 );
       
 		$this->ci->load->library(array('parser','email'));

 		$message = $this->ci->parser->parse('email_template_head', $datas,true);
       
 		/* mail part */

 		if($result['client_sendmail_form_smptp'] == 1)
 		{
			//echo "1";
			//exit;
 			$config['smtp_host']	= $result['client_smpt_host'];
 			$config['smtp_user']	= $result['client_smpt_user'];
 			$config['smtp_pass']	= $result['client_smpt_password'];
 			$config['smtp_port']	= $result['client_smpt_port'];
 			$config['mailpath'] 	= $result['client_mail_path'];
 			$config['smtp_crypto']  = 'tls';
 			$config['protocol'] 	= 'smtp';
 		}
 		else
 		{
			//echo "2";
			//exit;
 			$config['protocol'] 	= 'sendmail';
 		}

 		$config['charset'] 		= 'iso-8859-1';
 		$config['wordwrap'] 	= TRUE;
 		$config['charset'] 		= "utf-8";
 		$config['mailtype'] 	= "html";
 		$config['newline'] 		= "\r\n";
 		$this->ci->email->initialize($config);
 		$this->ci->email->from($from_email,$site_title);
 		$this->ci->email->to($to_email);
 		$this->ci->email->subject($subject);
 		$this->ci->email->message($message);
 		if(!empty($pdf_url))
 		{
 		$this->ci->email->attach($pdf_url);
 		}
 		$email_status = $this->ci->email->send();	
 	   
 		
 
		/*$headers = "From: " . $from_email . "\r\n";
		$headers .= "Reply-To: ". $from_email . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	    mail($to_email, $subject, $message, $headers)
	    * */
		

        if ($email_status) 
        {
 	
 	    //echo $this->ci->email->print_debugger();
 	    //echo '<pre>';
 	   // print_r(error_get_last());
 		//echo '1';
       // exit;
 			return 1;
 		}
 		else
 		{
		 //echo $this->ci->email->print_debugger();
		 //echo '<pre>';
 	     //print_r(error_get_last());
		 //echo '2';
        // exit;
 			return 0;
 		}
 		 
 		 
 	}
 	
 }
  
     /* this function used to send newsletter  */
	 function send_newsletter_mail($to_email_address,$newletter_ID,$client_id,$app_id)
	 {
			
			$this->ci =  & get_instance();

			$client_template_table = "pos_newsletter";
			$setting_table = "pos_clients";

			$query = " SELECT e.newsletter_subject,e.newsletter_content,e.newsletter_fromEmail,e.newsletter_toEmail,s.client_from_email,s.client_to_email,s.client_site_name,s.client_sendmail_form_smptp,s.client_logo,s.client_folder_name,s.client_site_url,s.client_smpt_host,s.client_smpt_user,s.client_smpt_password,s.client_smpt_port,s.client_mail_path,s.client_email_footer_content FROM  $client_template_table as e
			LEFT JOIN $setting_table as s ON  s.client_id ='".$client_id."' AND s.client_app_id='".$app_id."'  WHERE  e.newsletter_id = '".$newletter_ID."'";
			
            
            
			$result = $this->ci->Mydb->custom_query_single($query);

			if(!empty($result))
			{
				/* get basic mail config values */
				$to_email = ($to_email_address == '')? $result['newsletter_toEmail']  : $to_email_address;
				$from_email = $result['newsletter_fromEmail'];
				$site_title = ucfirst($result['newsletter_subject']);
				$subject = $result['newsletter_subject'];
				$email_content = stripcslashes($result['newsletter_content']);

				/* merge contents */
				$base_url= base_url();
				$datas = array('CONTENT' => $email_content);

				$this->ci->load->library(array('parser','email'));

				$message = $this->ci->parser->parse('email_template_head', $datas,true);

				/* mail part */

				if($result['client_sendmail_form_smptp'] == 1)
				{
					$config['smtp_host']	= $result['client_smpt_host'];
					$config['smtp_user']	= $result['client_smpt_user'];
					$config['smtp_pass']	= $result['client_smpt_password'];
					$config['smtp_port']	= $result['client_smpt_port'];
					$config['mailpath'] 	= $result['client_mail_path'];
					$config['protocol'] 	= 'smtp';
				}
				else
				{
					$config['protocol'] 	= 'sendmail';
				}

				$config['charset'] 		= 'iso-8859-1';
				$config['wordwrap'] 	= TRUE;
				$config['charset'] 		= "utf-8";
				$config['mailtype'] 	= "html";
				$config['newline'] 		= "\r\n";
				$this->ci->email->initialize($config);
				$this->ci->email->from($from_email,$site_title);
				$this->ci->email->to($to_email);
				$this->ci->email->subject($subject);
				$this->ci->email->message($message);
				 $email_status = $this->ci->email->send();
			   
				if($email_status)
				{
					

					return 1;
				}
				else
				{
					
					
					return 0;
				}
				 
				 
			}
	 }
 
 

}