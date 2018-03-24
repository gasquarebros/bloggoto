<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkemail extends CI_Controller {

	
	 function __construct() {
		parent::__construct ();
		
		
	}		/* this function used to product menu component items */


	public function index()
	{
		
		$subject = 'This is a test';
		$message = '<p>This message has been sent for testing purposes.</p>';
		
		// Get full html:
		$body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=' . strtolower(config_item('charset')) . '" />
			<title>' . html_escape($subject) . '</title>
			<style type="text/css">
				body {
					font-family: Arial, Verdana, Helvetica, sans-serif;
					font-size: 16px;
				}
			</style>
		</head>
		<body>
		' . $message . '
		</body>
		</html>';
		
		

		$this->load->library('email');
		
		$from_email = 'rmarktest5@gmail.com';
		$site_title = 'Goodayshop';
		$to_email = 'k2b.vinoi@gmail.com';
		$subject = 'Test';
		$message = $body;
		
                $config['protocol'] 	= 'smtp';		
                $config['smtp_host']	= 'smtp.googlemail.com';
                $config['smtp_port']	= '587';
	        //$config['smtp_user']	= 'ninjaos';
	        //$config['smtp_pass']	= 'htNXGRhr3c';
		$config['smtp_user']	= 'rmarktest4@gmail.com';
		$config['smtp_pass']	= 'Testing44';
                $config['smtp_crypto']  = 'tls';
		$config['charset'] 	= 'iso-8859-1';
 		$config['wordwrap'] 	= TRUE;
 		$config['charset'] 	= "utf-8";
 		$config['mailtype'] 	= "html";
 		$config['newline'] 	= "\r\n";
		$config['mailpath'] 	= '/usr/sbin/sendmail';
		 		
 		
 		$this->email->initialize($config);
 		$this->email->from($from_email,$site_title);
 		$this->email->to($to_email);
 		$this->email->subject($subject);
 		$this->email->message($message);
 		$email_status = $this->email->send();
 	
 		if($email_status)
 		{
 			echo 'success';
 		}
 		else
 		{
			echo 'fail';
			
 			print_r($this->email->print_debugger());
 		}
		

	}
	
	function testmail(){
		$this->load->library('email');

		$subject = 'This is a test';
		$message = '<p>This message has been sent for testing purposes.</p>';

		// Get full html:
		$body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=' . strtolower(config_item('charset')) . '" />
			<title>' . html_escape($subject) . '</title>
			<style type="text/css">
				body {
					font-family: Arial, Verdana, Helvetica, sans-serif;
					font-size: 16px;
				}
			</style>
		</head>
		<body>
		' . $message . '
		</body>
		</html>';
		 

		$result = $this->email
				->from('rmarktest@gmail.com')
				->reply_to('rmarktest@gmail.com')    // Optional, an account where a human being reads.
				->to('k2b.vinoth@gmail.com')
				->subject($subject)
				->message($body)
				->send();

		 echo "welcome";
		echo $this->email->print_debugger();

		exit;
	}

}
