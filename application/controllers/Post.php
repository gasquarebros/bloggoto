<?php
/**************************
 Project Name	: Bloggotoweb
Description		: Device Udpate

***************************/
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';
class Post extends REST_Controller {
   
	function __construct() {
		parent::__construct ();
		$this->load->library ( 'form_validation' );
		$this->form_validation->set_error_delimiters ( '<p>', '</p>' );
        $this->table = "posts";
		$this->page_table = "cmspage";
		$this->blog_categorytable = "blog_category";
		$this->customers = "customers";
		$this->customers_followers = "customers_followers";
		$this->post_likes = "post_likes";
		$this->post_favor = "post_favor";
		$this->post_tags = "post_tags";
		$this->post_comments = "post_comments";
		$this->primary_key='post_id';
		$this->load->library('common');
		$this->load->helper('security');
		$this->load->helper('products');
	}
	
	/* this method used to to check validate image file */
	public function validate_video() {
		if (isset ( $_FILES ['post_video'] ['name'] ) && $_FILES ['post_video'] ['name'] != "") {
			if ($this->common->valid_video ( $_FILES ['post_video'] ) == "No") {
				$this->form_validation->set_message ( 'validate_video', get_label ( 'upload_valid_image' ) );
				return false;
			}
		}
		return true;
	}
	
	function testupload_post() {
		$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
		fwrite($myfile, json_encode($_FILES)." ". json_encode($_POST));
		fclose($myfile);		
	}
	
	function uploadphoto_post() {
		$this->form_validation->set_rules ( 'userid', 'lang:rest_customer_id_required', 'trim|required' );
		$this->form_validation->set_rules ( 'base64', 'lang:base64', 'trim|required' );
		$this->form_validation->set_rules('type', 'type', 'trim|required');
		if ($this->form_validation->run () == TRUE) {
			$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
			fwrite($myfile, json_encode($_FILES)." ". json_encode($_POST));
			fclose($myfile);
		
			$base_code_img = $_POST['base64'];
			$image_file_name = $this->do_image_upload($base_code_img); 
			if($image_file_name) {
				$result ['status'] = 'success';
				$result ['img'] = $image_file_name;
			} else {
				$result ['status'] = 'error';
				$result ['message'] = 'something went wrong';
			}
		}
		else {
			$result ['status'] = 'error';
			$result ['message'] = validation_errors ();
		}
		
		echo json_encode ( $result );
		exit ();
	}
	
	function random_string($type = 'alnum', $len = 8)
	{
		switch ($type)
		{
			case 'basic':
				return mt_rand();
			case 'alnum':
			case 'numeric':
			case 'nozero':
			case 'alpha':
				switch ($type)
				{
					case 'alpha':
						$pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
						break;
					case 'alnum':
						$pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
						break;
					case 'numeric':
						$pool = '0123456789';
						break;
					case 'nozero':
						$pool = '123456789';
						break;
				}
				return substr(str_shuffle(str_repeat($pool, ceil($len / strlen($pool)))), 0, $len);
			case 'unique': // todo: remove in 3.1+
			case 'md5':
				return md5(uniqid(mt_rand()));
			case 'encrypt': // todo: remove in 3.1+
			case 'sha1':
				return sha1(uniqid(mt_rand(), TRUE));
		}
	}
	
	function check_image_exists($path, $image, $imageType) {
		$CI =& get_instance();
		$filename = $path.$image.$imageType;
		if (file_exists($filename)) {
			$image = $this->random_string('alnum', 30);
			return check_image_exists( $path, $image, $imageType);
		} else {
			return $image.$imageType;
		}
	}
	
	public function do_image_upload($image_basecode) {
		$image_upload_path = "upload_photo/";
		$image_name = $this->check_image_exists ( FCPATH . $image_upload_path, $this->random_string ( 'alnum', 30 ), '.jpg' );
		$decode_profile_image = base64_decode ( $image_basecode );
		$image_obj = imagecreatefromstring ( $decode_profile_image );
		$image_path = FCPATH . $image_upload_path;
		imagejpeg ( $image_obj, $image_path . $image_name, 70 );
		return (base_url() . $image_upload_path.$image_name);
	}
	
	public function do_multi_upload($file_name,$image_path, $insert_id) 
	{	
		$cpt = count($_FILES[$file_name]['name']);
		if (! empty ( $file_name )) 
		{
			$post_image_arary=array();
			$insertid = $insert_id;
		    $files = $_FILES;
			for($i = 0; $i < $cpt; $i ++) 
			{
				$image_data=array();
				$_FILES [$file_name] ['name'] = $files [$file_name] ['name'] [$i];
				$_FILES [$file_name] ['type'] = $files [$file_name] ['type'] [$i];
				$_FILES [$file_name] ['tmp_name'] = $files [$file_name] ['tmp_name'][$i];
				$_FILES [$file_name] ['error'] = $files [$file_name] ['error'] [$i];
				$_FILES [$file_name] ['size'] = $files [$file_name] ['size'] [$i];				
				$config ['upload_path'] = FCPATH . 'media/' . $image_path;
				if(preg_match("/\.(gif|jpg|jpeg|png)$/", $_FILES [$file_name] ['name']))
				{
					$config ['allowed_types'] = '*';				
				}
				else
				{
					$config ['allowed_types'] = 'gif|jpg|jpeg|png';				
				}				
				$config['encrypt_name']=true;
				$config['remove_spaces']=true;					
				$this->load->library('upload',$config);	
				if(!$this->upload->do_upload($file_name))
				{
			    	$img_log_array=json_encode($_FILES [$file_name] ['type']);
			        $img_file_name='image_log.txt';
			        $img_log_file =APPPATH.'/logs/'.$img_file_name;
			        file_put_contents($img_log_file,$img_log_array);

					$error=$this->upload->display_errors();						
					$response = array("status"=>"error","message"=>$error);
					echo json_encode($response); 
					exit;												
			    }
			    else
			    {
	                $image_data = $this->upload->data();//store the file info
					$filename = $image_data ['full_path']; /*ADD YOUR FILENAME WITH PATH*/
					$exif = exif_read_data($filename);
					
					$ort = (!empty($exif['Orientation']))?$exif['Orientation']:null; /*STORES ORIENTATION FROM IMAGE */
					$ort1 = $ort;
					$exif = exif_read_data($filename, 0, true);
					if (!empty($ort1))
					{
						$image = imagecreatefromjpeg($filename);
						$ort = $ort1;
						switch ($ort) {
							case 3:
								$image = imagerotate($image, 180, 0);
								break;
							case 6:
								$image = imagerotate($image, -90, 0);
								break;

							case 8:
								$image = imagerotate($image, 90, 0);
								break;
						}
						imagejpeg($image,$filename, 90);
					}
				// // return $data['file_name'];
					$post_image_arary[] = array ( 'post_media_post_id' => $insertid,
						'post_media_type'=>'image',
						'post_media_filename' => $image_data['file_name'],
					);

				}
			}
			if(!empty($post_image_arary))
			{
				$this->Mydb->insert_batch('post_media', $post_image_arary );
			}
		}
	}
	
	function insert_image_entry($photos, $image_path, $insertid) {
		if(!empty($photos)) {
			foreach($photos as $photo) {
				$exp_photo = explode('/',$photo);
				$filename = $exp_photo[count($exp_photo)];
				$filepath = FCPATH . 'media/' . $image_path;
				$newFilePath = $filepath.$filename;
				$fileMoved = rename($photo, $newFilePath);
				if($fileMoved) {
					$post_image_arary[] = array ( 'post_media_post_id' => $insertid,
						'post_media_type'=>'image',
						'post_media_filename' => $filename,
					);
				}
			}
		}
		if(!empty($post_image_arary))
		{
			$this->Mydb->insert_batch('post_media', $post_image_arary );
		}
	}
	
	function post_add_post() {
		$this->form_validation->set_rules('post_title','lang:post_title','required|trim|strip_tags');			
		$this->form_validation->set_rules('post_description','lang:post_description','required');
		$this->form_validation->set_rules('user_id','lang:user_id','required');
		$this->form_validation->set_rules('post_category','lang:post_category','required');
		$this->form_validation->set_rules('post_type','lang:post_type','required');
		$this->form_validation->set_rules ( 'post_video', 'lang:post_video', 'trim|callback_validate_video' );
		
		if(($this->input->post('post_type') == 'picture') && (empty($_FILES['post_photo']['name']))) { 
			$this->form_validation->set_rules ( 'post_photo[]', 'lang:post_photo', 'required' );
		}
		
		if ($this->form_validation->run () == TRUE) {
			$post_video = "";
			$res = 0;
			if (isset ( $_FILES ['post_video'] ['name'] ) && $_FILES ['post_video'] ['name'] != "" && $this->input->post ( 'post_type' ) == 'video') {
				$post_video = $this->common->upload_video ( 'post_video',$this->lang->line('post_video_folder_name') );
				if($post_video['status'] == 'success')
				{
					$post_video = $post_video['message'];
				}
				else
				{
					$res = 1;
					$result ['status'] = 'error';
					$result ['message'] = $post_video['message'];
				}
			}
			/* upload pdf */
			$post_pdf = "";
			$res = 0;
			if (isset ( $_FILES ['post_pdf'] ['name'] ) && $_FILES ['post_pdf'] ['name'] != "" && ($this->input->post ( 'post_type' ) == 'book' || $this->input->post('post_type') == 'story' || $this->input->post('post_type') == 'blog' )) {
				$post_pdf = $this->common->upload_pdf ( 'post_pdf',$this->lang->line('post_pdf_folder_name') );
				
				if($post_pdf['status'] == 'success')
				{
					$post_pdf = $post_pdf['message'];
				}
				else
				{
					$res = 1;
					$result ['status'] = 'error';
					$result ['message'] = $post_pdf['message'];
				}
			}			

			if($res == 0)
			{
				$category = array();
				$post_category = $this->Mydb->get_all_records('*',$this->blog_categorytable,array('blog_cat_status' => 'A'),'','',array('blog_cat_sequence'=>'ASC'));
				if(!empty($post_category))
				{
					foreach($post_category as $blogcat)
					{
						$category[$blogcat['blog_cat_slug']] = $blogcat['blog_cat_id'];
					}
				}
				$embed_video_url='';
				if($this->input->post('post_embed_video_url') !='' && $this->input->post('post_embed_video_url') != 'null')
				{
					$embed_video_url = preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","www.youtube.com/embed/$1",$this->input->post('post_embed_video_url'));
				}
				$insert_array = array (
					'post_category' => $category[$this->input->post ( 'post_category' )],
					'post_type' => $this->input->post ( 'post_type' ),
					'post_title' => $this->input->post ( 'post_title' ),
					'post_description' => json_encode(get_censored_string($this->input->post( 'post_description',FALSE ))),
					'post_video' => $post_video,
					'post_pdf' => $post_pdf,
					'post_embed_video_url' => $embed_video_url,
					'post_status' => ($this->input->post('status'))?$this->input->post('status'):'A',
					'post_created_on' => current_date (),
					'post_by' => 'customer',
					'post_created_by' => $this->input->post ('user_id'),
					'post_created_ip' => get_ip () 
				);
				$title=post_value('post_title');
				$insert_array['post_slug']=make_slug($title,$this->table,'post_slug');
				
				$insert_id = $this->Mydb->insert ( $this->table, $insert_array );
				// 'post_photo' => $post_photo,
				if($this->input->post('post_photo')) {
					$this->insert_image_entry($this->input->post('post_photo'),$this->lang->line('post_photo_folder_name'),$insert_id);
				}
				if (isset ( $_FILES ['post_photo'] ['name'] ) && $_FILES ['post_photo'] ['name'] != "") 
				{
					$this->do_multi_upload("post_photo",$this->lang->line('post_photo_folder_name'),$insert_id);
				}					
				if($insert_id)
				{
					$customer_username=get_tag_username($this->input->post('user_id'));						
					$message=$customer_username.' added new post';
					#insert post notification
					$record = array(
						'notification_post_id'=>$insert_id,
						'notification_type'=>'post',
						'created_type'=>'E',
						'message_type'=>'N',
						'subject'=>$message,
						'message'=>$message,
						'private'=>0,
						'created_by'=>$this->input->post('user_id'),
						'created_on'=>current_date(),				
						'ip_address'=>get_ip(),
					);
					post_notify($record);
					#insert post notification						
					if(!empty($this->input->post('post_tags')))
					{
						$post_tags = $this->input->post('post_tags');
						$customer_username=get_tag_username($this->input->post('user_id'));						
						$post_tag_message=$customer_username." has tagged you on post";						
						$batch_insert = array();
						foreach($post_tags as $post_tag)
						{
							if(!empty($post_tag)) {
								$exploded = explode('__',$post_tag);
								$batch_insert[] = array(
									'post_tag_post_id'=>$insert_id,
									'post_tag_user_id'=>$exploded[0],
									'post_tag_user_name'=>$exploded[1],
									'post_tag_created_on'=>current_date (),
									'post_created_by'=>$this->input->post ('user_id')
								);
								$record['subject'] = $post_tag_message;
								$record['message'] = $post_tag_message;
								$record['notification_type'] = "post_tag";
								$record['assigned_to'] = $exploded[0];
								post_notify($record);#insert post tags user
							}
						}
						if(!empty($batch_insert)) {
							$this->db->insert_batch('post_tags',$batch_insert);
						}
					}
				}
				$result ['status'] = 'success';
			}
			
			
		}
		else {
			$result ['status'] = 'error';
			$result ['message'] = validation_errors ();
		}
		
		echo json_encode ( $result );
		exit ();
	}
	
	function post_update_post() {
		$this->form_validation->set_rules('post_title','lang:post_title','required|trim|strip_tags');			
		$this->form_validation->set_rules('post_description','lang:post_description','required');
		$this->form_validation->set_rules('user_id','lang:user_id','required');
		$this->form_validation->set_rules('post_category','lang:post_category','required');
		$this->form_validation->set_rules('post_type','lang:post_type','required');
		$this->form_validation->set_rules ( 'post_video', 'lang:post_video', 'trim|callback_validate_video' );
		
		if(($this->input->post('post_type') == 'picture') && (empty($_FILES['post_photo']['name']))) { 
			$this->form_validation->set_rules ( 'post_photo[]', 'lang:post_photo', 'required' );
		}
		
		if ($this->form_validation->run () == TRUE) {
			$editid=$this->input->post('post_id');
			if (isset ( $_FILES ['post_photo'] ['name'] ) && $_FILES ['post_photo'] ['name'] != "") 
			{
				if($editid !='')
				{
					$this->Mydb->delete ( 'post_media', array ('post_media_post_id' => $editid ));
				}	
				$existpostphoto=post_value('existpostphoto');
				$existpostphotos=explode(",", $existpostphoto);
				if(!empty($existpostphotos))
				{
					foreach($existpostphotos as $existphoto)
					{
						$post_image_path = FCPATH.'media/'.$this->lang->line('post_photo_folder_name').$existphoto;
						if (file_exists ( $post_image_path )) 
						{
							@unlink ( $post_image_path );
						}
					}
				}
				$this->do_multi_upload("post_photo",$this->lang->line('post_photo_folder_name'),$editid);
			}									
			/* upload video */
			$post_video = "";
			$res = 0;
			if (isset ( $_FILES ['post_video'] ['name'] ) && $_FILES ['post_video'] ['name'] != "" && post_value ( 'post_type' ) == 'video') 
			{
				$post_video_path = FCPATH . 'media/' . $this->lang->line('post_video_folder_name') . post_value('existpostvideo');
				if (file_exists ( $post_video_path )) 
				{
					@unlink ( $post_video_path );
				}

				$post_video = $this->common->upload_video ( 'post_video',$this->lang->line('post_video_folder_name') );
				
				if($post_video['status'] == 'success')
				{
					$post_video = $post_video['message'];
				}
				else
				{
					$res = 1;
					$result ['status'] = 'error';
					$result ['message'] = $post_video['message'];
				}
			}
			/* upload pdf */
			$post_pdf = "";
			$res = 0;
			if (isset ( $_FILES ['post_pdf'] ['name'] ) && $_FILES ['post_pdf'] ['name'] != "" && (post_value ( 'post_type' ) == 'book' || post_value ( 'post_type' ) == 'story'  || post_value('post_type') == 'blog'  )) {
				$post_pdf = $this->common->upload_pdf ( 'post_pdf',$this->lang->line('post_pdf_folder_name') );
				
				if($post_pdf['status'] == 'success')
				{
					$post_pdf = $post_pdf['message'];
				}
				else
				{
					$res = 1;
					$result ['status'] = 'error';
					$result ['message'] = $post_pdf['message'];
				}
			}									
			if($res == 0)
			{
				$category = array();
				$post_category = $this->Mydb->get_all_records('*',$this->blog_categorytable,array('blog_cat_status' => 'A'),'','',array('blog_cat_sequence'=>'ASC'));
				if(!empty($post_category))
				{
					foreach($post_category as $blogcat)
					{
						$category[$blogcat['blog_cat_name']] = $blogcat['blog_cat_id'];
					}
				}
				
				$embed_video_url='';
				if(post_value('post_embed_video_url') !='' && post_value('post_embed_video_url') !='null')
				{
					$embed_video_url = preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","www.youtube.com/embed/$1",post_value('post_embed_video_url'));
				}

				$update_array = array (
						'post_category' => $category[post_value ( 'post_category' )],
						'post_type' => post_value ( 'post_type' ),
						'post_title' => post_value ( 'post_title' ),
						'post_description' => json_encode(post_value ( 'post_description',FALSE )),
						'post_embed_video_url' => $embed_video_url,
						'post_video' => $post_video,
						'post_pdf' => $post_pdf,
						'post_status' => (post_value('status'))?post_value('status'):'A',
						'post_created_on' => current_date (),
						'post_by' => 'customer',
						'post_created_by' => $this->input->post('user_id'),
						'post_created_ip' => get_ip () 
				);
				$title=post_value('post_title');
				$update_array['post_slug']=make_slug($title,$this->table,'post_slug');

				$where_array=array('post_id'=>$editid);
				$insert_id = $this->Mydb->update ( $this->table,$where_array, $update_array );

				if($insert_id)
				{
					$this->Mydb->delete('post_tags',array('post_tag_post_id'=>$editid));

					if(!empty($this->input->post('post_tags')))
					{
						$message='Add post';
						#insert post notification
							$record = array(
								'notification_post_id'=>$insert_id,
								'created_type'=>'E',
								'message_type'=>'N',
								'private'=>0,
								'created_by'=>$this->input->post('user_id'),
								'created_on'=>current_date(),				
								'ip_address'=>get_ip(),
								);
						#insert post notification						
						$post_tags = $this->input->post('post_tags');
						$customer_username=get_tag_username(get_user_id());						
						$post_tag_message=$customer_username." has tagged you on post";		

						$batch_insert = array();
						foreach($post_tags as $post_tag)
						{
							if(!empty($post_tag)) {
								$exploded = explode('__',$post_tag);
								$batch_insert[] = array(
									'post_tag_post_id'=>$insert_id,
									'post_tag_user_id'=>$exploded[0],
									'post_tag_user_name'=>$exploded[1],
									'post_tag_created_on'=>current_date (),
									'post_created_by'=>$this->input->post('user_id')
								);
								$record['subject'] = $post_tag_message;
								$record['message'] = $post_tag_message;
								$record['notification_type'] = "post_tag";
								$record['assigned_to'] = $exploded[0];
								post_notify($record);#insert post tags user									
							}
						}
						if(!empty($batch_insert)) {
							$this->db->insert_batch('post_tags',$batch_insert);
						}
					}
				}
				$this->session->set_flashdata ( 'admin_success', sprintf ( $this->lang->line ( 'success_message_update' ), $this->post_module_label ) );
				$result ['status'] = 'success';
			}
		}
		else {
			$result ['status'] = 'error';
			$result ['message'] = validation_errors ();
		}
		
		echo json_encode ( $result );
		exit ();
	}
	
	function post_addcomments_post() {
		$this->form_validation->set_rules('post_record','lang:post_record','required');
		$this->form_validation->set_rules('user_id','lang:user_id','required');
		$this->form_validation->set_rules('action','lang:action','required');
		$this->form_validation->set_rules ( 'comments', 'lang:comments', 'required|xss_clean|trim' );
		
		if ($this->form_validation->run () == TRUE) {
			$customer_id = $this->input->post('user_id');
			$postid = $this->input->post('post_record');
			$comment_message = json_encode(get_censored_string($this->input->post('comments')));
			if ($this->input->post ( 'action' ) == "comment") 
			{
				
				$insert_array = array (
					'post_comment_user_id' => $customer_id,
					'post_comment_post_id' => $postid,
					'post_comment_message' => $comment_message,
					'post_comment_parent' => 0,
					'post_comment_created_on' => current_date (),
					'post_comment_created_by' => $this->input->post('user_id'),
					'post_comment_created_ip' => get_ip () 
				);
				$insert_id = $this->Mydb->insert ( $this->post_comments, $insert_array );
				$post_reuslt=$this->Mydb->get_record('post_id,post_created_by','posts',array('post_id'=>$postid));
				if($post_reuslt['post_created_by'] != $customer_id)
				{					
					$customer_username=get_tag_username($customer_id);						
					$message=$customer_username." commented on your post";					
					#insert post notification
					$record = array(
						'notification_post_id'=>$postid,
						'notification_type'=>'comment',
						'created_type'=>'E',
						'message_type'=>'N',
						'subject'=>$message,
						'message'=>$message,
						'private'=>0,
						'created_by'=> $customer_id,
						'created_on'=>current_date(),				
						'ip_address'=>get_ip(),
					);
					post_notify($record);
					#insert post notification	
				}				
				$counting = $this->Mydb->get_num_rows('*',$this->post_comments,array('post_comment_post_id'=>$postid));
				$result ['status'] = 'success';
				$result ['message'] = 'Success';
				$result ['html'] = thousandsCurrencyFormat($counting);
			}
			else if ($this->input->post ( 'action' ) == "updatecmt") 
			{
				$this->form_validation->set_rules ( 'cmt_record', 'lang:cmt_record', 'required|xss_clean|trim' );
				if ($this->form_validation->run () == TRUE) 
				{
					$commentid = decode_value($this->input->post('cmt_record'));
					$update_array = array (
						'post_comment_user_id' => $customer_id,
						'post_comment_post_id' => $postid,
						'post_comment_message' => $comment_message,
						'post_comment_parent' => 0,
					);
					$where_array=array('post_comment_id'=>$commentid);
					$insert_id = $this->Mydb->update ( $this->post_comments,$where_array, $update_array );
					$counting =$this->Mydb->get_num_rows('*',$this->post_comments,array('post_comment_post_id'=>$postid));
					$result ['status'] = 'success';
					$result ['message'] = 'Success';
					$result ['html'] = thousandsCurrencyFormat($counting);
				}
				else
				{
					$result ['status'] = 'error';
					$result ['message'] = validation_errors ();
				}
			}
			else
			{
				$result ['status'] = 'error';
				$result ['message'] = "Something Wrong try again later";
			}
		} else {
			$result ['status'] = 'error';
			$result ['message'] = validation_errors ();
		}
		echo json_encode ( $result );
		exit ();
	}
		
	public function deletecomment_post()
	{
		$this->form_validation->set_rules('comment_id','lang:comment_id','required|trim');			
		$this->form_validation->set_rules('post_id','lang:post_id','required|trim');			
		if ($this->form_validation->run () == TRUE) 
		{
			$postid = $this->input->post('post_id' );
			$commentid = $this->input->post('comment_id');
			$this->Mydb->delete_where_in($this->post_comments,'post_comment_parent',$commentid,array());
			$this->Mydb->delete_where_in($this->post_comments,'post_comment_id',$commentid,array());
			$counting = $this->Mydb->get_num_rows('*',$this->post_comments,array('post_comment_post_id'=>$postid));
			$result ['status'] = 'success';
			$result ['html'] = thousandsCurrencyFormat($counting);
			$result ['message'] = 'Deleted Successfully';
		}
		else 
		{
			$result ['status'] = 'error';
			$result ['message'] = validation_errors ();
		}
		
		echo json_encode ( $result );
		exit ();
	}
	
	public function comments_get()
	{ 
		$app_id = $this->get ( 'app_id' );
        $postslug = ($this->get('post_slug'))?$this->get('post_slug'): null;
		if($postslug == null)
		{
			echo json_encode(array('status'=>'error','msg'=>'Invalid Post'));
			exit();
		} else {		
			$join = "";		
			$join [0] ['select'] = "customer_id,customer_first_name,customer_last_name,customer_email,customer_photo,customer_type,company_name";
			$join [0] ['table'] = $this->customers;
			$join [0] ['condition'] = "post_comment_user_id = customer_id";
			$join [0] ['type'] = "LEFT";
			$join [1] ['select'] = "post_title,post_slug,post_id";
			$join [1] ['table'] = $this->table;
			$join [1] ['condition'] = "post_comment_post_id = post_id";
			$join [1] ['type'] = "INNER";
			
			$order_by = array('post_comment_created_on'=>'DESC');
			$where = array('post_slug'=>$postslug,'(post_comment_parent IS NULL or post_comment_parent = 0)'=>null);
			$groupby = array();
			$like = array();
			$totla_rows = $this->Mydb->get_num_join_rows ( 'post_comment_id', $this->post_comments, $where, null, null, null, $like, $groupby, $join  );
			$limit = 10;
			$page = ($this->get( 'page' )>0)?$this->get ( 'page' ):1;
			$offset = ($this->get ( 'page' ) >0)?(($this->get ( 'page' )-1) * $limit):0;
			$offset = $this->get ( 'offset' )?$this->get ( 'offset' ):$offset;
			$next_offset = $offset+$limit;
			$next_set = ($totla_rows > $next_offset)?($offset+$limit):'';			
			$data['offset'] = $offset;
			$data['next_set'] = $next_set;
			$records = $this->Mydb->get_all_records ( $this->post_comments.'.*', $this->post_comments, $where, $limit, $offset, $order_by, $like, $groupby, $join );
			
			if(!empty($records)) {
				$i = 0;
				foreach($records as $record) {
					$data ['records'][$i] = $record;
					if($record['customer_photo'] !='')
					{ 
						$photo=media_url().$this->lang->line('customer_image_folder_name').$record['customer_photo']; 
					} 
					else 
					{ 
						$photo=media_url().$this->lang->line('customer_image_folder_name')."default.png"; 
					} 
					$data['records'][$i]['customer_photo'] = $photo;
					$i++;
				}
			}
			$data['page'] = $offset;
			$data['show'] = $this->get('show');
			echo json_encode ( array (
				'status' => 'success',
				'html' => $data,
			) );
			exit ();
		}
	}
	
	public function post_likes_post()
	{
		$this->form_validation->set_rules('user_id','lang:user_id','required|trim');			
		$this->form_validation->set_rules('post_id','lang:post_id','required|trim');			
		if ($this->form_validation->run () == TRUE) 
		{
			$customer_id = $this->input->post('user_id');
			$postid = $this->input->post('post_id');
			
				
			$like_records = $this->Mydb->get_record('*',$this->post_likes,array('post_like_post_id'=>$postid,'post_like_user_id'=>$customer_id));
			
			if(count($like_records) == 0)
			{
				$insert_array = array (
					'post_like_user_id' => $customer_id,
					'post_like_post_id' => $postid,
					'post_like_created_on' => current_date (),
					'post_like_created_by' => $customer_id,
					'post_like_created_ip' => get_ip () 
				);
				$insert_id = $this->Mydb->insert ( $this->post_likes, $insert_array );
				#insert post notification
				$post_reuslt=$this->Mydb->get_record('post_id,post_created_by','posts',array('post_id'=>$postid));
				if($post_reuslt['post_created_by'] != get_user_id())
				{
					$customer_username=get_tag_username(get_user_id());						
					$message=$customer_username." likes your post";						
					$record = array(
						'notification_post_id'=>$postid,
						'notification_type'=>'like',
						'created_type'=>'E',
						'message_type'=>'N',
						'subject'=>$message,
						'message'=>$message,
						'private'=>0,
						'created_by'=>$customer_id,
						'created_on'=>current_date(),				
						'ip_address'=>get_ip(),
						);
					$notification_id = post_notify($record);
				}
				#insert post notification
				$result ['status'] = 'success';
				$result ['message'] = 'Unfollow';
			}
			else
			{
				$ids = array($like_records['post_like_id']);
				$search_array = array('post_like_user_id' => $customer_id,'post_like_post_id' => $postid);
				$this->Mydb->delete_where_in ( $this->post_likes, 'post_like_id', $ids, $search_array );
				$this->Mydb->delete ( 'post_notification', array('notification_type'=>'like','notification_post_id'=>$postid,'created_by'=>get_user_id()));
				$result ['status'] = 'success';
				$result ['message'] = 'Follow';
				
			}
			$counting = $this->Mydb->get_num_rows('*',$this->post_likes,array('post_like_post_id'=>$postid));
			$result ['html'] = $counting;
			$update_array = array(
				'post_likes' => thousandsCurrencyFormat($counting)
			);
			$this->Mydb->update ( $this->table, array ($this->primary_key => $postid ), $update_array );
		} else {
			$result ['status'] = 'error';
			$result ['message'] = validation_errors ();
		}
		echo json_encode ( $result );
		exit ();
	}
	
	public function post_favor_post()
	{
		$this->form_validation->set_rules('user_id','lang:user_id','required|trim');			
		$this->form_validation->set_rules('post_id','lang:post_id','required|trim');			
		if ($this->form_validation->run () == TRUE) 
		{
			$customer_id = $this->input->post('user_id');
			$postid = $this->input->post('post_id');
			if($postid == null || $customer_id == null)
			{
				$result ['status'] = 'success';
				$result ['message'] = '';
			}
			else {				
				$favor_records = $this->Mydb->get_record('post_favor_id',$this->post_favor,array('post_favor_post_id'=>$postid,'post_favor_user_id'=>$customer_id));
				
				if(count($favor_records) == 0)
				{
					$insert_array = array (
						'post_favor_user_id' => $customer_id,
						'post_favor_post_id' => $postid,
						'post_favor_created_on' => current_date (),
						'post_favor_created_by' => $customer_id,
						'post_favor_created_ip' => get_ip () 
					);
					$insert_id = $this->Mydb->insert ( $this->post_favor, $insert_array );
					$result ['status'] = 'success';
					$result ['message'] = 'Favor';
				}
				else
				{
					$ids = array($favor_records['post_favor_id']);
					$search_array = array('post_favor_user_id' => $customer_id,'post_favor_post_id' => $postid);
					$this->Mydb->delete_where_in ( $this->post_favor, 'post_favor_id', $ids, $search_array );
					$result ['status'] = 'success';
					$result ['message'] = 'Unfavor';
				}
				$counting = $this->Mydb->get_num_rows('*',$this->post_favor,array('post_favor_post_id'=>$postid));
				$result ['html'] = $counting;
			}
		} else {
			$result ['status'] = 'error';
			$result ['message'] = validation_errors ();
		}
		echo json_encode ( $result );
		exit ();
	}
	
	function pdfupload_post() {
		//$this->form_validation->set_rules('file','lang:file','required|trim');			
		//$this->form_validation->set_rules('post_id','lang:post_id','required|trim');			
		if (!empty($_FILES)) 
		{		
	
			$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
		fwrite($myfile, json_encode($_FILES)." ". json_encode($_POST));
		fclose($myfile);
			if($_FILES['file']['type'] == 'application/octet-stream' || $_FILES['file']['type'] == 'PDF' || $_FILES['file']['type'] == 'pdf' || $_FILES['file']['type'] == 'application/pdf') {
				$post_pdf = $this->common->upload_app_pdf ( 'file', $this->lang->line('post_pdf_folder_name') );
				if($post_pdf['status'] == 'success')
				{
					$result ['status'] = 'success';
					$result ['message'] = media_url().$this->lang->line('post_pdf_folder_name').$post_pdf['message'];
				}
				else
				{
					$res = 1;
					$result ['status'] = 'error';
					$result ['message'] = $post_pdf['message'];
				}
			} else {
				$result ['status'] = 'error';
				$result ['message'] = 'Invalid file type';
			}
		} else {
			$result ['status'] = 'error';
			$result ['message'] = 'upload file is Required';
		}
		echo json_encode ( $result );
		exit ();
	}
	
	function blog_category_get() {
		$category = array();
		$post_category = $this->Mydb->get_all_records('*','blog_category',array('blog_cat_status' => 'A'),'','',array('blog_cat_sequence'=>'ASC'));
		if(!empty($post_category))
		{
			foreach($post_category as $blogcat)
			{
				$category[] = array('key'=>$blogcat['blog_cat_slug'], 'value'=>$blogcat['blog_cat_name']);
			}
		}
		$result ['category'] = $category;
		$posttypes = array(array('key'=>'blog', 'value' =>'Blog'),array('key'=>'picture', 'value'=>'Pictures'),array('key'=>'video', 'value'=>'Video'),array('key'=>'story', 'value'=>'Story'),array('key'=>'book','value'=>'Books'),array('key'=>'qa', 'value'=>'Review'));
		$result['post_types'] = $posttypes;
		echo json_encode ( $result );
		exit ();
	}
	
	function followers_list_post() {
		$userid = $this->input->post('user_id');
		$followers_lst = get_followers_list($userid);
		$followers = array();
		if(!empty($followers_lst)) {
			foreach($followers_lst as $foll_list)
			{
				if($foll_list['customer_type'] == 0)
				{
					$followers[] = array('key'=> $foll_list['follow_user_id']."__".$foll_list['customer_first_name']." ".$foll_list['customer_last_name'], 'value' => $foll_list['customer_first_name']." ".$foll_list['customer_last_name']); 	
				}
				else
				{
					$followers[] = array('key' => $foll_list['follow_user_id']."__".$foll_list['company_name'], 'value' =>$foll_list['company_name']); 
				}
			}
		}
		$result['followers'] = $followers;
		echo json_encode ( $result );
		exit ();
	}
	
	function post_list_get() {
		
        $app_id = $this->get ( 'app_id' );
        //app_validation($app_id);
        $like = array ();
		$order_by = array (
			$this->primary_key => 'DESC' 
		);
		$where = array('post_status'=>'A','post_by !='=>'admin');
		$groupby = "post_id";
		$blocked_users = get_all_block_users();
		if(!empty($blocked_users))
		{
			$blockedlist = implode(',',$blocked_users);
			$where = array_merge ( $where, array (
				"customer_id NOT IN (".$blockedlist.")" => null,
			));
		}
		if($this->get('section') !=''&& $this->get('section') == 'blogs')
		{
			$where = array_merge ( $where, array (
				"post_type !=" => 'picture', 
				"post_type !=" => 'video', 
			));
		}
		if($this->get('section') !=''&& $this->get('section') == 'pictures')
		{
			$where = array_merge ( $where, array (
				"(post_type = 'picture' || post_type ='video')" => null,
			));
		}
		if ($this->get ( 'paging' ) == "") {
			$search_field = $this->get ( 'search_field' );
			
			$order_field = $this->get ( 'order_field' );
		}
		if ($search_field != "") {
			$where = array_merge ( $where, array (
				"post_category" => $search_field 
			));
		}
		$type = $this->get ( 'type' );
		if($type !='' && $type == 'blogs')
		{
			$where = array_merge ( $where, array (
				"post_type !=" => 'picture', 
				"post_type !=" => 'video', 
			));
		}
		else if($type !='' && $type == 'pictures')
		{
			$where = array_merge ( $where, array (
				"(post_type = 'picture')" => null,
			));
		}
		else if($type !=''&& $type == 'video')
		{
			$where = array_merge ( $where, array (
				"(post_type = 'video')" => null,
			));
		} 
		else {
			if ($type != "") {
				$where = array_merge ( $where, array (
						"post_type" => $type 
				));
			}
		}
		/* add sort bu option */
		if ($order_field != "") {
			if($order_field == 'followers' && $this->get('user_id') !='')
			{
				$cwhere = array("follow_customer_id"=>$this->get('user_id'));
				$followers_customer_ids = $this->Mydb->get_all_records ( 'follow_user_id', $this->customers_followers, $cwhere);
				
				$followers = array();
				if(!empty($followers_customer_ids))
				{
					foreach($followers_customer_ids as $followers_customer_id)
					{
						$followers[] = $followers_customer_id['follow_user_id'];
					}
				}
				if(!empty($followers)) {
					$where = array_merge ( $where, array (
						"pos_posts.post_created_by in (".implode(',',$followers).") and pos_posts.post_by = 'customer'" => NULL 
					));
				}
			}
			else{
				$order_by = array (
					'post_likes' => 'DESC' 
				);
			}
		}
		
		$join = "";
		$join [0] ['select'] = "blog_cat_id,blog_cat_name";
		$join [0] ['table'] = $this->blog_categorytable;
		$join [0] ['condition'] = "post_category = blog_cat_id";
		$join [0] ['type'] = "LEFT";
		
		$join [1] ['select'] = "customer_id,customer_first_name,customer_last_name,customer_email,customer_photo,customer_type,company_name,customer_celebrity_badge,customer_username";
		$join [1] ['table'] = $this->customers;
		$join [1] ['condition'] = "post_created_by = customer_id and post_by !='admin'";
		$join [1] ['type'] = "LEFT";
	
		$join [2] ['select'] = "(select count(post_like_id) as postcount from pos_".$this->post_likes." pplikes where pplikes.post_like_post_id = pos_".$this->table.".post_id) as postcount,group_concat(',',post_like_user_id) as lkesuser";
		$join [2] ['table'] = $this->post_likes;
		$join [2] ['condition'] = "post_id = post_like_post_id";
		$join [2] ['type'] = "LEFT";
		
		$join [3] ['select'] = "(select count(post_comment_id) as commentcount from pos_".$this->post_comments." ppcomments where ppcomments.post_comment_post_id = pos_".$this->table.".post_id) as commentcount";
		$join [3] ['table'] = $this->post_comments;
		$join [3] ['condition'] = "post_id = post_comment_post_id";
		$join [3] ['type'] = "LEFT";
		
		$join [4] ['select'] = "group_concat(',',post_tag_user_name) as post_tag_names, group_concat(',',post_tag_user_id) as post_tag_ids";
		$join [4] ['table'] = $this->post_tags;
		$join [4] ['condition'] = "post_id = post_tag_post_id";
		$join [4] ['type'] = "LEFT";
		
		$join [5] ['select'] = "group_concat(',',post_favor_user_id) as favoruser";
		$join [5] ['table'] = $this->post_favor;
		$join [5] ['condition'] = "post_id = post_favor_post_id";
		$join [5] ['type'] = "LEFT";

		$totla_rows = $this->Mydb->get_num_join_rows ( $this->primary_key, $this->table, $where, null, null, null, $like, $groupby, $join  );
	
		$limit = 12;
		$page = $this->get('page') ? $this->get ('page'):1;
		$offset = $this->get( 'page' )?(($this->get( 'page' )-1) * $limit):0;
		$offset = $this->get ( 'offset' )?$this->get( 'offset' ):$offset;
		$next_offset = $offset+$limit;
		$next_set = ($totla_rows > $next_offset)?($offset+$limit):'';
		
		
		
		$data['offset'] = $offset;
		$data['next_set'] = $next_set;
		// $select_array = array ('pos_posts.*');
		$select_array = array ("pos_posts.*,(SELECT group_concat(post_media_filename) FROM pos_post_media WHERE post_media_post_id=post_id) as post_photo");

		$records = $this->Mydb->get_all_records ( $select_array, $this->table, $where, $limit, $offset, $order_by, $like, $groupby, $join );
		//echo $this->db->last_query();
		//exit;
		if(!empty($records)) {
			$i = 0;
			foreach($records as $record) {
				$data ['records'][$i] = $record;
				if($record['customer_photo'] !='')
				{ 
					$photo=media_url().$this->lang->line('customer_image_folder_name').$record['customer_photo']; 
				} 
				else 
				{ 
					$photo=media_url().$this->lang->line('customer_image_folder_name')."default.png"; 
				} 
				$data['records'][$i]['customer_photo'] = $photo;
				
				if($record['favoruser'] != '') {
					$favoruser = explode(', ',$record['favoruser']);
				} else {
					$favoruser = array();
				}
				$data['records'][$i]['favoruser'] = array_values(array_unique(array_filter($favoruser, create_function('$value', 'if($value !== "") { return trim($value); }' ))));
				
				if($record['lkesuser'] != '') {
					$lkesuser = explode(', ',$record['lkesuser']);
				} else {
					$lkesuser = array();
				}
				$data['records'][$i]['lkesuser'] = array_values(array_unique(array_filter($lkesuser, create_function('$value', 'if($value !== "") { return trim($value); }' ))));
				
				$image_url = array();
				if($record['post_photo'] !='') {
					$postimages=explode(",", $record['post_photo']);
					if(!empty($postimages))
					{
						
						foreach ($postimages as $key => $postimage) 
						{
							$image_url[] = media_url().$this->lang->line('post_photo_folder_name').$postimage; 
						}
					}
				}
				$data['records'][$i]['post_photo'] = $image_url;
				$tags_post = array();
				$tags_post_ids = array();
				if(!empty($record['post_tag_names'])) { 
					$tags = array_unique(explode(',',$record['post_tag_names'])); 
					$tag_user_id = array_unique(explode(', ',$record['post_tag_ids'])); 
					foreach($tags as $tkey=>$tag)
					{
						$username = get_tag_username($tag_user_id[$tkey]);
						if($username) {
							$tags_post[] = array( 'username' => $username, 'tag' => $tag, 'selection' => $tag_user_id[$tkey].'__'.$username );
							$tags_post_ids[] = $tag_user_id[$tkey];
						}
					}
				}
				$data['records'][$i]['post_tag_names'] = $tags_post;
				$data['records'][$i]['post_tag_ids'] = $tags_post_ids;
				
				$video = '';
				if($record['post_type'] == 'video' && $record['post_video'] !='') {
					$video = media_url().$this->lang->line('post_video_folder_name').$record['post_video'];
				}
				$data['records'][$i]['post_video'] = $video;
				$youtube_url = '';
				if($record['post_embed_video_url'] !='') {
					$youtube_url = addhttp($record['post_embed_video_url']);
				}
				$data['records'][$i]['post_embed_video_url'] = $youtube_url;
				$data['records'][$i]['post_description'] = substr_close_tags(json_decode($record['post_description']));
				$data['records'][$i]['post_full_description'] = json_decode($record['post_description']);
				$i++;
				
			}
		}
		$data['page'] = $page;
        $this->set_response ( $data, success_response () );
	}
	
	function postDelete_post() {
		$this->form_validation->set_rules('post_id','lang:post_id','required|trim');			
		if ($this->form_validation->run () == TRUE) 
		{
			$postid = $this->input->post( 'post_id' );
			$delete_query=delete_post($postid);#pass post id to delete the post related 
			$result ['status'] = 'success';
			$result ['message'] = sprintf ( $this->lang->line ( 'success_message_delete' ), 'Post' );

		}
		else 
		{
			$result ['status'] = 'error';
			$result ['message'] = validation_errors ();
		}
		echo json_encode ( $result );
		exit ();
	}
	
	function postReport_post() {
		$this->form_validation->set_rules('post_id','lang:post_id','required|trim');			
		if ($this->form_validation->run () == TRUE) 
		{
			$postid = $this->input->post( 'post_id' );
			$insert_array = array (
					'report_post_id' => $postid,
					'report_created_on' => current_date (),
					'report_created_by' => $this->input->post('user_id'),
					'report_created_ip' => get_ip () 
			);
			$insert_id = $this->Mydb->insert ('post_reports', $insert_array );
			$result ['status'] = 'success';
			$result ['message'] = sprintf ( $this->lang->line ( 'success_message_report' ), 'Post' );
		}
		else 
		{
			$result ['status'] = 'error';
			$result ['message'] = validation_errors ();
		}
		echo json_encode ( $result );
		exit ();
	}
	
	function drafts_list_get() {
		$userid = $this->get ( 'userid' );
		if($userid) {
			$where = "post_by = 'customer' AND pos_posts.post_created_by = ".$userid." AND post_status = 'D'";
			$like = array ();
			
			$order_by = array (
					$this->primary_key => 'DESC' 
			);
			$join = array();
			$join [0] ['select'] = "blog_cat_id,blog_cat_name,blog_cat_slug";
			$join [0] ['table'] = $this->blog_categorytable;
			$join [0] ['condition'] = "post_category = blog_cat_id";
			$join [0] ['type'] = "LEFT";
			
			$join [1] ['select'] = "customer_id,customer_first_name,customer_last_name,customer_email";
			$join [1] ['table'] = $this->customers;
			$join [1] ['condition'] = "post_created_by = customer_id and post_by !='admin'";
			$join [1] ['type'] = "LEFT";
			
			$join [2] ['select'] = "group_concat(',',post_tag_user_id) as post_tag_ids,group_concat(',',post_tag_user_name) as post_tag_names";
			$join [2] ['table'] = $this->post_tags;
			$join [2] ['condition'] = "post_tag_post_id = post_id";
			$join [2] ['type'] = "LEFT";
			
			$groupby = "post_id";

			$select_array = array ('pos_posts.*');
			$records = $this->Mydb->get_all_records ( $select_array, $this->table, $where, '', '', $order_by, $like, $groupby, $join );
			$data['records'] = [];
			if(!empty($records)) {
				$i = 0;
				foreach($records as $record) {
					$data ['records'][$i] = $record;
					if($record['customer_photo'] !='')
					{ 
						$photo=media_url().$this->lang->line('customer_image_folder_name').$record['customer_photo']; 
					} 
					else 
					{ 
						$photo=media_url().$this->lang->line('customer_image_folder_name')."default.png"; 
					} 
					$data['records'][$i]['customer_photo'] = $photo;
					
					if($record['favoruser'] != '') {
						$favoruser = explode(', ',$record['favoruser']);
					} else {
						$favoruser = array();
					}
					$data['records'][$i]['favoruser'] = array_values(array_unique(array_filter($favoruser, create_function('$value', 'if($value !== "") { return trim($value); }' ))));
					
					if($record['lkesuser'] != '') {
						$lkesuser = explode(', ',$record['lkesuser']);
					} else {
						$lkesuser = array();
					}
					$data['records'][$i]['lkesuser'] = array_values(array_unique(array_filter($lkesuser, create_function('$value', 'if($value !== "") { return trim($value); }' ))));
					
					$image_url = array();
					if($record['post_photo'] !='') {
						$postimages=explode(",", $record['post_photo']);
						if(!empty($postimages))
						{
							
							foreach ($postimages as $key => $postimage) 
							{
								$image_url[] = media_url().$this->lang->line('post_photo_folder_name').$postimage; 
							}
						}
					}
					$data['records'][$i]['post_photo'] = $image_url;
					$tags_post = array();
					if(!empty($record['post_tag_names'])) { 
						$tags = array_unique(explode(',',$record['post_tag_names'])); 
						$tag_user_id = array_unique(explode(',',$record['post_tag_ids'])); 
						foreach($tags as $tkey=>$tag)
						{
							$username = get_tag_username($tag_user_id[$tkey]);
							if($username) {
								$tags_post[] = array( 'username' => $username, 'tag' => $tag );
							}
						}
					}
					$data['records'][$i]['post_tag_names'] = $tags_post;
					
					$video = '';
					if($record['post_type'] == 'video' && $record['post_video'] !='') {
						$video = media_url().$this->lang->line('post_video_folder_name').$record['post_video'];
					}
					$data['records'][$i]['post_video'] = $video;
					$youtube_url = '';
					if($record['post_embed_video_url'] !='') {
						$youtube_url = addhttp($record['post_embed_video_url']);
					}
					$data['records'][$i]['post_embed_video_url'] = $youtube_url;
					$data['records'][$i]['post_description'] = substr_close_tags(json_decode($record['post_description']));
					$i++;
					
				}
			}
			$data['status'] = 'success';
			echo json_encode(array($data));
			exit;
		} else {
			echo json_encode(array('status'=>'error','msg'=>'Invalid user'));
			exit();
		}
	}
} /* end of files */
