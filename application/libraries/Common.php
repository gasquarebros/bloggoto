<?php
/**************************
 Project Name	: Pos
Created on		: 22 Feb, 2016
Last Modified 	: 22 Feb, 2016
Description		: Page contains common validation and upload libraie
***************************/
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Common {
	protected $ci;
	public function __construct() {
		$this->ci = & get_instance ();
	}
	
	/* this function used to validate image */
	function valid_image($files = null) {
		if (isset ( $files ) && ! empty ( $files )) {
			$allowedExts = array (
					"gif",
					"jpeg",
					"jpg",
					"png",
					"GIF",
					"JPEG",
					"JPG",
					"PNG" 
			);
			$temp = explode ( ".", $files ['name'] );
			$extension = end ( $temp );
			
			if (! in_array ( $extension, $allowedExts )) {
				return 'No';
			}
		}
		return "Yes";
	}
	/* this function used to validate image */
	function valid_file($files = null) {
		if (isset ( $files ) && ! empty ( $files )) {
			$allowedExts = array (
					"csv",				
			);
			$temp = explode ( ".", $files ['name'] );
			$extension = end ( $temp );
			
			if (! in_array ( $extension, $allowedExts )) {
				return 'No';
			}
		}
		return "Yes";
	}
	
	/* this function used to validate video */
	function valid_video($files = null) {
		if (isset ( $files ) && ! empty ( $files )) {
			$allowedExts = array (
					"mp4",				
					"flv",				
					"wmv",				
					"3gp",				
			);
			$temp = explode ( ".", $files ['name'] );
			$extension = end ( $temp );
			
			if (! in_array ( $extension, $allowedExts )) {
				return 'No';
			}
		}
		return "Yes";
	}
	
	/* this function used to upload video files */
	function upload_video($files = null, $image_path = null) {
		if (isset ( $files ) && ! empty ( $files ) && $image_path != "") {
			$this->ci->load->helper ( 'string' );
			$file_name = $files;
			$config ['upload_path'] = FCPATH . 'media/' . $image_path;
			$config ['allowed_types'] = 'webm|mp4|mp3|ogg|ogv';
			$config ['max_size'] = '102400';
			//$config ['file_name'] = random_string ( 'alnum', 50 );
			$config['encrypt_name']=true;
			$config['remove_spaces']=true;
			$this->ci->load->library ( 'upload', $config );
			$this->ci->upload->initialize ( $config );
			if (! $this->ci->upload->do_upload ( $file_name )) {
				return array('status'=>'error','message'=>$this->ci->upload->display_errors());
			} else {
				$data = $this->ci->upload->data ();
				return array('status'=>'success','message'=>$data ['file_name']);
			}
		}
	}
	
	/* this function used to upload image */
	function upload_image($files = null, $image_path = null) {
		if (isset ( $files ) && ! empty ( $files ) && $image_path != "") {
			$this->ci->load->helper ( 'string' );
			$file_name = $files;
			$config ['upload_path'] = FCPATH . 'media/' . $image_path;
			$config ['allowed_types'] = 'gif|jpg|jpeg|png|pdf';
			//$config ['file_name'] = random_string ( 'alnum', 50 );
			$config['encrypt_name']=true;
			$config['remove_spaces']=true;
			$this->ci->load->library ( 'upload', $config );
			$this->ci->upload->initialize ( $config );
			if (! $this->ci->upload->do_upload ( $file_name )) {
				return '';
			} else {
				$data = $this->ci->upload->data ();
				return $data ['file_name'];
			}
		}
	}
	
	/* this function used to unlink images */
	function unlink_image($image_name, $user_folder, $module_image_path) {
		if ($image_name != "" && $user_folder != "" && $module_image_path != "") {
			$image_path = FCPATH . "media/" . $user_folder . "/" . $module_image_path . "/" . $image_name;
			
			if (file_exists ( $image_path )) {
				@unlink ( $image_path );
			}
		}
	}
	
	/* this function used to unlink images in delete action */
	function delete_unlink_image($folder_name, $field, $where_in_key, $table, $ids) /*  folder name, select field, wherein key  table , id's*/
	{
		$records = $this->ci->Mydb->get_all_records_where_in ( $field, $table, $where_in_key, $ids );
		
		if (! empty ( $records )) {
			foreach ( $records as $image_name ) {
				
				if ($image_name[$field] != "") {
					$user_folder = get_company_folder ();
				  $image_path = FCPATH . "media/" . $user_folder . "/" . $folder_name . "/" . $image_name[$field];				
					if (file_exists ( $image_path )) {
						@unlink ( $image_path );
					}
				}
			}
		}
		
		return true;
	}
}
/* End of file Common_validation.php */
/* Location: ./application/libraries/Common_validation.php */
