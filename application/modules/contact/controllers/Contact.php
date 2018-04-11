<?php
/**************************
Project Name	: Avvanz
Created on		: 09 May, 2016
Last Modified 	: 09 May, 2016
Description		: Page contains contact us functionalities
***************************/
defined('BASEPATH') or exit('No direct script access allowed');
class Contact extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->folder = 'contact/';
		$this->module = 'contact';
                $this->module_label = "contact"; 
                $this->module_labels = "contact";
		//$this->form_validation->set_error_delimiters('<li>', '</li>');
		$this->lang->load('contact'); /*Load language file*/
	   // $this->load->model('Authorisation_model', 'authdb'); /*Load model file*/
	}

        /* this method used to common module labels */
	private function load_module_info() {
		$data = array ();
		$data ['module_label'] = $this->module_label;
		$data ['module_labels'] = $this->module_labels;
		$data ['module'] = $this->module;
		return $data;
	}

	/* Authorisation details */
	public function index()
	{
		$data = array();
                $data = $this->load_module_info ();	
		$this->load->helper(array('form', 'url','captcha','email'));

		$this->load->library('form_validation');
		if($this->input->post('action') == 'sendcontact')
		{
			$this->form_validation->set_rules('contact_first_name', 'Contact First Name', 'trim|required');
			$this->form_validation->set_rules('contact_phone_number', 'Contact Phone Number', 'trim|required');
			$this->form_validation->set_rules('contact_email', 'Contact Email', 'trim|required|valid_email');
			$this->form_validation->set_rules('contact_message', 'Contact Message', 'trim|required');
			$this->form_validation->set_rules('userCaptcha', 'Captcha', 'required|callback_check_captcha');
			$userCaptcha = $this->input->post('userCaptcha');
			if ($this->form_validation->run() == TRUE){
				$contact_first_name 	=  $this->input->post('contact_first_name');
				$contact_last_name  	=  $this->input->post('contact_last_name');
				$contact_phone_number   =  $this->input->post('contact_phone_number');
				$contact_email		    =  $this->input->post('contact_email');
				$contact_message	    =  $this->input->post('contact_message');
				$datas =  array(
							'contact_first_name' => $contact_first_name,
							'contact_last_name' => $contact_last_name,
							'contact_phone_number' => $contact_phone_number,
							'contact_email' => $contact_email,
							'contact_message' => $contact_message,
						 );
				$insert_id = $this->Mydb->insert('contact_us',$datas);
				$submitted_data  =  "<table><tr><td style='padding:4px 8px;'>First Name:</td><td style='padding:4px 8px;'> ".$contact_first_name."</td></tr>";
				if(!empty($contact_last_name))
					$submitted_data .=  "<tr><td style='padding:4px 8px;'>Last Name:</td><td style='padding:4px 8px;'>".$contact_last_name."</td></tr>";
				$submitted_data .=  "<tr><td style='padding:4px 8px;'>Phone Number:</td><td style='padding:4px 8px;'> ".$contact_phone_number."</td></tr>";
				if(!empty($contact_email))
					$submitted_data .=  "<tr><td style='padding:4px 8px;'>Email:</td><td style='padding:4px 8px;'> ".$contact_email."</td></tr>";
				if(!empty($contact_message))	
					$submitted_data .=  "<tr><td style='padding:4px 8px;'>Message:</td><td style='padding:4px 8px;'> ".$contact_message."</td></tr>";
				$submitted_data .= '</table>';
				$template_id = 5;
                                $this->load->library('myemail');
				$chk_arr = array('[submitted_data]');
				$rep_arr = array($submitted_data);
                                $get_v = $this->myemail->send_admin_mail('',$template_id,$chk_arr,$rep_arr);

				if($insert_id ){
					$this->session->set_flashdata('success','Your message was sent successfully');
					redirect(base_url()."contact");
					$data['form_response_success']="Your message was sent successfully";
					$data['form_response_error']="";
				}
				else
				{
					$data['form_response_error']="Your message was not sent successfully";
					$data['form_response_success']="";
                                        $random_number = substr(number_format(time() * rand(),0,'',''),0,6);
				        $vals = array(
					     'word'=>$random_number,
					     'img_path' => './captcha/',
					     'img_url' => base_url().'captcha/'
				        );

				        $data['captcha'] = create_captcha($vals);
				        $this->session->set_userdata('captchaWord',$data['captcha']['word']);
				}
			} 
			else
			{
                                
				$data['form_response_error'] =   "Please fill all fields";
				$data['form_response_success'] =   "";
				$random_number = substr(number_format(time() * rand(),0,'',''),0,6);
				$vals = array(
					'word'=>$random_number,
					'img_path' => './captcha/',
					'img_url' => base_url().'captcha/'
				);

				$data['captcha'] = create_captcha($vals);
				$this->session->set_userdata('captchaWord',$data['captcha']['word']);
			}
		}  
		else 
		{
			$data['form_response_error'] = '';
			$data['form_response_success'] = '';
			$random_number = substr(number_format(time() * rand(),0,'',''),0,6);
			$vals = array(
				'word'=>$random_number,
				'img_path' => './captcha/',
				'img_url' => base_url().'captcha/'
			);

			$data['captcha'] = create_captcha($vals);
			$this->session->set_userdata('captchaWord',$data['captcha']['word']);
		}
		$data['meta_title']  =  "Bloggoto | Contact";
		$data['metacontent']  =  "Bloggoto ";
		$data['metakeyword']  =  "Bloggoto ";
		
		/*Get all Authorization requests*/
                $this->layout->display_site ( $this->module . "/contact", $data );
	}
	
	public function create_captcha()
	{    
		$this->load->helper(array('captcha'));                            
		$expiration = time()-300; // Two hour limit
		$random_number = substr(number_format(time() * rand(),0,'',''),0,6);
		$vals = array(
			'word'=>$random_number,
			'img_path' => './captcha/',
			'img_url' => base_url().'captcha/'
		);

		$cap = create_captcha($vals);

		$this->session->set_userdata('captchaWord',$cap['word']);

		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') echo $cap['image'];
		else return $cap['image'];
	}
	
	
	public function check_captcha($str){
		$word = $this->session->userdata('captchaWord');
		if(strcmp(strtoupper($str),strtoupper($word)) == 0){
		  return true;
		}
		else{
		  $this->form_validation->set_message('check_captcha', 'Please enter correct words!');
		  return false;
		}
	}
}
