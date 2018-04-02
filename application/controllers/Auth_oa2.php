<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_oa2 extends CI_Controller
{
	
	public function __construct() {
		parent::__construct ();
		$this->module = "registration";
		$this->module_label = get_label('registration_module_label');
		$this->module_labels = get_label('registration_module_label');
		$this->folder = "registration/";
		$this->table = "customers";
		$this->customer_login_history = "customer_login_history";
		$this->primary_key='customer_id';
		

	}
	
    public function session($provider_name)
    {
        $this->load->library('session');
        $this->load->helper('url_helper');

        $this->load->library('oauth2/OAuth2');
				//$this->load->library('tank_auth');
				//$this->load->model('tank_auth/users');
				$this->load->config('oauth2', TRUE);

        $provider = $this->oauth2->provider($provider_name, array(
            'id' => $this->config->item($provider_name.'_id', 'oauth2'),
            'secret' => $this->config->item($provider_name.'_secret', 'oauth2'),
        ));


        if ( ! $this->input->get('code'))
        {
            // By sending no options it'll come back here
			/*if($provider_name == 'facebook')
			{
				$redirect_uri =base_url().'index.php/auth_oa2/session/facebook';
				$provider->authorize(array('redirect_uri'=>$redirect_uri)); 
			}
			else {*/
				$provider->authorize();
			//}
        }
        else
        {
            // Howzit?
            try
            {
                //$token = $provider->access($_GET['code']);
                $token = $provider->access($this->input->get('code'));
                $user = $provider->get_user_info($token);
				if(!empty($user))
				{
					$uid = $user['uid'];
					$email = $user['email'];
					$first_name = ($user['first_name'])?$user['first_name']:(($user['name'])?$user['name']:$user['nickname']);
					$last_name = $user['last_name'];
					
					$where = array (
						'customer_email' => trim ( $email ),
						'customer_status !='=>'D',	
					);
					
					if($provider_name == 'google')
					{
						$social_where = array (
							'customer_google_id' => trim ( $uid ),
							'customer_status !='=>'D',	
						);
						$check_details_social = $this->Mydb->get_record ( 'customer_id,customer_first_name,customer_last_name,customer_email,customer_password,customer_status,customer_type,customer_photo', $this->table, $where );
					}
					
					$check_details = $this->Mydb->get_record ( 'customer_id,customer_first_name,customer_last_name,customer_email,customer_password,customer_status,customer_type,customer_photo', $this->table, $where );
					if (! empty ( $check_details )) {
						$session_datas = array('bg_user_id' => $check_details['customer_id'],'bg_first_name' => $check_details['customer_first_name'],'bg_last_name' => $check_details['customer_last_name'],'bg_user_group' => ($check_details['customer_type'] == 0)?'writer':'brand','bg_user_type'=>$check_details['customer_type'],'bg_user_profile_picture'=>media_url().$this->lang->line('customer_image_folder_name')."/".$check_details['customer_photo'] );
							
						if(!empty($session_datas))
						{
							$this->session->set_userdata($session_datas);
							/* store last login details...*/
							$this->Mydb->insert($this->customer_login_history,array('login_time'=>current_date(),'login_ip'=>get_ip(),'login_customer_id'=>$check_details['customer_id']));
							
							redirect('');
						}
						// User Alredy Exist;
					}
					else if(!empty($check_details_social)) {
						// User Alredy Exist with Google Account
						$check_details = $check_details_social;
						$session_datas = array('bg_user_id' => $check_details['customer_id'],'bg_first_name' => $check_details['customer_first_name'],'bg_last_name' => $check_details['customer_last_name'],'bg_user_group' => ($check_details['customer_type'] == 0)?'writer':'brand','bg_user_type'=>$check_details['customer_type'],'bg_user_profile_picture'=>media_url().$this->lang->line('customer_image_folder_name')."/".$check_details['customer_photo'] );
							
						if(!empty($session_datas))
						{
							$this->session->set_userdata($session_datas);
							/* store last login details...*/
							$this->Mydb->insert($this->customer_login_history,array('login_time'=>current_date(),'login_ip'=>get_ip(),'login_customer_id'=>$check_details['customer_id']));
							redirect('');
						}
					}
					else
					{
						
						$photo ='';
						if($user['image'])
						{
							$ch = curl_init($user['image']);
							$fp = fopen($this->lang->line('customer_image_folder_name').$user['uid'].".jpg", 'wb');
							curl_setopt($ch, CURLOPT_FILE, $fp);
							curl_setopt($ch, CURLOPT_HEADER, 0);
							curl_exec($ch);
							curl_close($ch);
							fclose($fp);
							$photo = $user['uid'].".jpg";
						}
						
						// New User
						$insert_array = array (
							'customer_first_name' => $first_name,
							'customer_last_name' => $last_name,
							'customer_email'=>$email,
							'customer_phone'=>'',
							'customer_type'=>0,
							'customer_photo' => $photo,
							'customer_status' => 'A',
							'customer_created_on' => current_date (),
							'customer_created_ip' => get_ip () 
						);
						if($provider_name == 'google')
						{
							$insert_array['customer_google_id'] = $user['uid'];
						}
						
						$insert_id = $this->Mydb->insert ( $this->table, $insert_array );
						
						$session_datas = array('bg_user_id' => $insert_id,'bg_first_name' => $first_name,'bg_last_name' => $last_name,'bg_user_group' => 'writer','bg_user_type'=>0,'bg_user_profile_picture'=>media_url().$this->lang->line('customer_image_folder_name')."/".$photo );
						
						$this->session->set_userdata($session_datas);
							/* store last login details...*/
						$this->Mydb->insert($this->customer_login_history,array('login_time'=>current_date(),'login_ip'=>get_ip(),'login_customer_id'=>$insert_id));
						redirect('');
					}
				}				
            }

            catch (OAuth2_Exception $e)
            {
                show_error('That didnt work: '.$e);
            }

        }
    }


	/**
	 * Send email message of given type (activate, forgot_password, etc.)
	 *
	 * @param	string
	 * @param	string
	 * @param	array
	 * @return	void
	 */
	function _send_email($type, $email, &$data)
	{
		$this->load->library('email');
		$this->email->from($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
		$this->email->reply_to($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
		$this->email->to($email);
		$this->email->subject(sprintf($this->lang->line('auth_subject_'.$type), $this->config->item('website_name', 'tank_auth')));
		$this->email->message($this->load->view('email/'.$type.'-html', $data, TRUE));
		$this->email->set_alt_message($this->load->view('email/'.$type.'-txt', $data, TRUE));
		$this->email->send();
	}

}

/* End of file auth_oa2.php */
/* Location: ./application/controllers/auth_oa2.php */