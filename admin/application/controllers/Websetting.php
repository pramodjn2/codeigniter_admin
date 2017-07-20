<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Websetting extends CI_Controller {

	public function __construct()
	{
    	parent::__construct();
    	check_user_login();
		$this->load->helper(array());
		$this->load->library(array('form_validation'));
		$this->load->model(array('UserModel'));
		//$this->output->enable_profiler(TRUE);	
    }


	public function index()
	{
		$data['title'] = 'Web Setting'; 
		$data['settingResult'] = $this->Common->select('manage_website_setting'); 
		$this->load->view('setting/websetting',$data);
	}

	/**
	* Add New websetting
	*/    
    public function addWebsetting(){
		
		$data['title'] = 'Add New Web Setting';
		$post = $this->input->post();

    	if($post && !empty($post))
    	{
    		$where = " where setting_name='".$post['setting_name']."'";
			$data['result'] = $this->Common->select('manage_website_setting', $where);
			
			if(empty($data['result']))
			{			
	    		$data = array('setting_name' => $post['setting_name'],
							  'setting_value' => $post['setting_value']
							 );
	    		$this->Common->insert('manage_website_setting', $data);
	         	$this->session->set_flashdata('success', INSERT_SUCCESS_MSG);
			}
			else
			{
				$this->session->set_flashdata('error', KEY_ALREADY_EXISTS);
			}
		}
    	$this->load->view('setting/websetting_add',$data);	
    }

	/**
	* Edit websetting
	*/
    public function editWebsetting()
    {
    	$id = $this->uri->segment(3);
    	$data['id'] = $id;
    	$id = safe_b64decode($id);
    	$data['title'] = 'Edit Web Setting';
    	$post = $this->input->post();
        if($post && !empty($post))
        {
			$data = array('setting_value'=>$post['setting_value']);
			$where = array('id'=>$post['setting_id']);
			if($this->Common->update('manage_website_setting', $data, $where))
			{
				$this->session->set_flashdata('success', UPDATE_SUCCESS_MSG);
			}
			else
			{
				$this->session->set_flashdata('error', UPDATE_FAIL);
         	}
       }
	   $where = " where id='".$id."'";
	   $data['result'] = $this->Common->select('manage_website_setting', $where);
	   $this->load->view('setting/websetting_edit', $data);
    }
	
	
	/*********************************************** Email templates*********************************************
	*
	*/
	public function template()
	{
	     $data['title'] = 'Mail Template'; 
		 $data['templateResult'] = $this->Common->select('manage_email_templates'); 
		 $this->load->view('mail_template/template',$data);
	}
	
	/**
	* Add New email Template
	*/    
    public function addTemplate()
    {
		$data['title'] = 'Add New Email Template';
		$post = $this->input->post();
    	if($post && !empty($post))
    	{
    		$data = array('name' => $post['name'],
			 			   'slug' => create_url_slug($post['name']),
						   'subject' => $post['subject'],
						   'message' => $post['message'],
						   'status'=>$post['status'],
						   'create_dt' => time()
						   );
					   
		    $this->Common->insert('manage_email_templates', $data);
         	$this->session->set_flashdata('success', INSERT_SUCCESS_MSG);
		}
    	$this->load->view('mail_template/template_add',$data);	
    }
	
	/**
	* Edit email Template  'slug'=> create_url_slug($post['name'])
	*/
    public function editTemplate()
    {
		$id = $this->uri->segment(3);
		$data['id'] = $id;
		$id = safe_b64decode($id);
		$data['title'] = 'Edit Email Template';
		$post = $this->input->post();
		if($post && !empty($post))
		{
		 	$data = array('name' => $post['name'],
		 			   'subject' => $post['subject'],
					   'message' => $post['message'],
					   'status'=>$post['status'],
					   'update_dt' => time()
					   );

		 	$where = array('id'=>$post['setting_id']);
			if($this->Common->update('manage_email_templates', $data, $where))
			{
				$this->session->set_flashdata('success', UPDATE_SUCCESS_MSG);
		 	}
		 	else
		 	{
				$this->session->set_flashdata('error', UPDATE_FAIL);
		 	}
		}
		$where = " where id='".$id."'";
		$data['result'] = $this->Common->select('manage_email_templates', $where);
		$this->load->view('mail_template/template_edit', $data);
    }
}