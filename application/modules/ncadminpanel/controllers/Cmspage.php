<?php 
/**************************
 Project Name	: Bastamania
Created on		: Aug 13, 2015
Last Modified 	: Aug 13, 2015
Description		: Page contains Dashborad class files
***************************/
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cmspage extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();		
		$this->authentication->admin_authentication();
		$this->module = 'cmspage';
		$this->module_label = get_label('cmspage_manage_label');
		$this->module_labels =  get_label('cmspage_manage_labels');
		$this->folder = "cmspage/";
		$this->table = "cmspage";
		$this->load->library ( 'common' );
		$this->primary_key = 'cmspage_id';

	}
	

	public function index($start=0)
	{		
		$data = $this->load_module_info ();
		
		$this->layout->display_admin ( $this->folder . $this->module . "-list", $data );
	}
	
	/* this method used list ajax listing... */
	function ajax_pagination($page = 0) {
		check_ajax_request (); /* skip direct access */
		$data = $this->load_module_info ();
		$like = array ();
		$where = array (
				" $this->primary_key !=" => ''
		);
		$order_by = array (
				$this->primary_key => 'DESC' 
		);
		
		/* Search part start */
		
		if (post_value ( 'paging' ) == "") {
			$this->session->set_userdata ( $this->module . "_search_field", post_value ( 'search_field' ) );
			$this->session->set_userdata ( $this->module . "_search_value", post_value ( 'search_value' ) );
		}
		
		if (get_session_value ( $this->module . "_search_field" ) != "" && get_session_value ( $this->module . "_search_value" ) != "") {
			$like = array (
					get_session_value ( $this->module . "_search_field" ) => get_session_value ( $this->module . "_search_value" ) 
			);
		}
		
		
		$totla_rows = $this->Mydb->get_num_rows ( $this->primary_key, $this->table, $where, null, null, null, $like );
		
		/* pagination part start  */
		$admin_records = admin_records_perpage ();
		$limit = (( int ) $admin_records == 0) ? 25 : $admin_records;
		$offset = (( int ) $page == 0) ? 0 : $page;  
		$uri_segment = $this->uri->total_segments ();
		$uri_string = camp_url () . $this->module . "/ajax_pagination";
		$config = pagination_config ( $uri_string, $totla_rows, $limit, $uri_segment );
		$this->pagination->initialize ( $config );
		$data ['paging'] = $this->pagination->create_links ();
		$data ['per_page'] = $data ['limit'] = $limit;
		$data ['start'] = $offset;
		$data ['total_rows'] = $totla_rows;
		
		/* pagination part end */
		
		$select_array = array ('cmspage_id ','cmspage_title','cmspage_description','cmspage_description_mobile','cmspage_status','cmspage_slug','cmspage_status','cmspage_created_on','cmspage_updated_on');
		$data ['records'] = $this->Mydb->get_all_records ( $select_array, $this->table, $where, $limit, $offset, $order_by, $like );
		// echo $qry = $this->db->last_query(); exit;
		$page_relod = ($totla_rows  >  0 && $offset > 0 && empty($data ['records']))  ? 'Yes' : 'No';
		$html = get_template ( $this->folder . '/' . $this->module . '-ajax-list', $data );
		echo json_encode ( array (
				'status' => 'ok',
				'offset' => $offset,
				'page_reload' => $page_relod,
				'html' => $html 
		) );
		exit ();
	}
	
	
/* Add admin user */
	
	public function add()
	{
		$data=array();
		$data = $this->load_module_info ();
		if ($this->input->post ( 'action' ) == "Add") 
		{ 
			check_ajax_request (); /* skip direct access */
         //echo check_ajax_request ();
        // exit;
			$this->form_validation->set_rules('cms_title','Title','required|trim|strip_tags');
			if($this->form_validation->run($this)==TRUE)
			{		
			  $data = array('cmspage_title'=>post_value('cms_title'),
			  		'cmspage_description'=> $this->input->post('cms_description'),
			  		'cmspage_description_mobile'=> $this->input->post('cms_description_mobile'),
			  		'cmspage_created_on'=>current_date(),
			  		'cmspage_created_by' => get_admin_id (),
					'cmspage_created_ip' => get_ip (), 
			  		'cmspage_status' =>post_value('status'),
			  		'cmspage_meta_title' =>post_value('cms_meta_title'),
			  		'cmspage_meta_description' =>post_value('cms_meta_description'),
			  		'cmspage_meta_keyword' =>post_value('cms_meta_keyword'));
			  
			  $title=post_value('cms_title');
			  $data['cmspage_slug']=make_slug($title,$this->table,'cmspage_slug');
			  
			  $this->Mydb->insert($this->table,$data);
			  $this->session->set_flashdata ( 'admin_success', sprintf ( $this->lang->line ( 'success_message_add' ), $this->module_label ) );
			  $result ['status'] = 'success';
		    }else {
				$result ['status'] = 'error';
				$result ['message'] = validation_errors ();
			}
			//print_r($result);
			//exit;
			echo json_encode ( $result );
			exit ();
		}	
		
		$data ['breadcrumb'] = $data ['form_heading'] = get_label ( 'add' ) . ' ' . $this->module_label;
		$data ['module_action'] = get_label ( 'add' );
		$this->layout->display_admin ( $this->folder . $this->module . '-add', $data );
	}

/* Edit admin users  */
	
	public function edit($edit_id)
	{
		$data = $this->load_module_info ();
		$id = addslashes ( decode_value ( $edit_id ) );
		$response =$image_arr = array ();

		$record = $this->Mydb->get_record ( '*', $this->table, array (
				$this->primary_key => $id
		) );
		
		(empty ( $record )) ? redirect ( camp_url () . $this->module ) : '';
		
		if ($this->input->post ( 'action' ) == "edit") 
		{
			
			$this->form_validation->set_rules('cms_title','Title','required|trim|strip_tags');
			if($this->form_validation->run($this)==TRUE)
			{
			  $data = array('cmspage_title' => post_value('cms_title'),'cmspage_slug' => make_slug(post_value('cms_slug'),$this->table,'cmspage_slug',array('cmspage_id !=' => $id)),'cmspage_description'=>$this->input->post('cms_description',false),'cmspage_description_mobile'=> $this->input->post('cms_description_mobile'),'cmspage_status' =>post_value('status'),'cmspage_updated_on' => current_date(),'cmspage_meta_title' =>post_value('cms_meta_title'),'cmspage_meta_description' =>post_value('cms_meta_description'),'cmspage_meta_keyword' =>post_value('cms_meta_keyword'),'cmspage_updated_by' => get_admin_id (),'cmspage_updated_ip' => get_ip () );	
			  
			  //exit;
			  $this->Mydb->update($this->table,array('cmspage_id' => $id),$data);
			  $this->session->set_flashdata ( 'admin_success', sprintf ( $this->lang->line ( 'success_message_edit' ), $this->module_label ) );
			  $response ['status'] = 'success';
			}else {
				$response ['status'] = 'error';
				$response ['message'] = validation_errors ();
			}
			
			echo json_encode ( $response );
			exit ();
		}	
				
		$data ['result'] = $record;
		
		/* Common labels */
		$data ['breadcrumb'] = $data ['form_heading'] = get_label ( 'edit' ) . ' ' . $this->module_label;
		$data ['module_action'] = 'edit/' . encode_value ( $record[$this->primary_key] );
		$this->layout->display_admin ( $this->folder . $this->module . '-edit', $data );
	}
	
	

	/* this method used update multible actions */
	function action() {
		$ids = ($this->input->post ( 'multiaction' ) == 'Yes' ? $this->input->post ( 'id' ) : decode_value ( $this->input->post ( 'changeId' ) ));
		
		$postaction = $this->input->post ( 'postaction' );
		
		$response = array (
				'status' => 'error',
				'msg' => get_label ( 'something_wrong' ),
				'action' => '',
				'multiaction' => $this->input->post ( 'multiaction' ) 
		);
		
		/* Delete */

		if ($postaction == 'Delete' && ! empty ( $ids )) {
			if (is_array ( $ids )) {
				$this->Mydb->delete_where_in($this->table,'cmspage_id',$ids);
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_delete' ), $this->module_label );
			} else {
				$this->Mydb->delete($this->table,array('cmspage_id'=>$ids));
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_delete' ), $this->module_label );
			}
			$response ['status'] = 'success';
			$response ['action'] = $postaction;
		}

		/* Activation */
		if ($postaction == 'Activate' && ! empty ( $ids )) {
			$update_values = array (
					"cmspage_status" => 'A',
					"cmspage_updated_on" => current_date (),
					'cmspage_updated_by' => get_admin_id (),
					'cmspage_updated_ip' => get_ip () 
			);
			
			if (is_array ( $ids )) {
				$this->Mydb->update_where_in ( $this->table, $this->primary_key, $ids, $update_values);
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_activate' ), $this->module_labels );
			} else {
				
				$this->Mydb->update_where_in ( $this->table, $this->primary_key, array (
						$ids 
				), $update_values);
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_activate' ), $this->module_label );
			}
			
			$response ['status'] = 'success';
			$response ['action'] = $postaction;
		}
		
		/* Deactivation */
		if ($postaction == 'Deactivate' && ! empty ( $ids )) {
			$update_values = array (
					"cmspage_status" => 'I',
					"cmspage_updated_on" => current_date (),
					'cmspage_updated_by' => get_admin_id (),
					'cmspage_updated_ip' => get_ip () 
			);
			
			if (is_array ( $ids )) {
				$this->Mydb->update_where_in ( $this->table, $this->primary_key, $ids, $update_values);
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_deactivate' ), $this->module_labels );
			} else {
				$this->Mydb->update_where_in ( $this->table, $this->primary_key, array (
						$ids 
				), $update_values );
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_deactivate' ), $this->module_label );
			}
			
			$response ['status'] = 'success';
			$response ['action'] = $postaction;
		}
	
		echo json_encode ( $response );
		exit ();
	}

	function refresh()
   {
		$this->session->unset_userdata ( $this->module . "_search_field" );
		$this->session->unset_userdata ( $this->module . "_search_value" );
		redirect ( admin_url () . $this->module );
	}
	
	/* this method used to common module labels */
	private function load_module_info() 
	{
		$data = array ();
		$data ['module_label'] = $this->module_label;
		$data ['module_labels'] = $this->module_labels;
		$data ['module'] = $this->module;
		return $data;
	}
}
