<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct() {
    	parent::__construct();
    	check_user_login();
		
		$this->load->helper(array());
		$this->load->library(array('form_validation'));
		$this->load->model(array('UserModel'));
		//$this->output->enable_profiler(TRUE);	
    }


	public function index()
	{    $data['title'] = 'User';  
	     $data['userResult'] = $this->UserModel->userInfomation();
		 $this->load->view('user/user',$data);
	}
	
	/**
	* Add New user
	*/    
    public function addUser(){
		$data['title'] = 'Create New User';  
		$data['message'] = '';
		$post = $this->input->post();

    	if($post && !empty($post)){
    		extract($post);
	        $where = "where email = '".$post['email']."'";
			$uploadResult = $this->Common->select('user', $where);
			if(!empty($uploadResult))
			{
				$data['message'] = EMAIL_ERROR_MSG;
			}
			else
			{
				$data = array( 'role_id'=>$post['user_role'],
								'first_name'=>$post['first_name'],
								'last_name'=>$post['last_name'],
								'email'=>$post['email'],
								'password'=>$post['password'],
								'status'=>$post['status'],
								'create_dt' => time() );
	    		$this->Common->insert('user', $data);
	         	$this->session->set_flashdata('success', INSERT_SUCCESS_MSG);
				redirect('User', 'refresh');
			}
		}
    	$this->load->view('user/user_add',$data);	
		
    }
	
	
	/**
	* Edit user
	*/    
    public function editUser(){
		$id = $this->uri->segment(3);
    	$data['id'] = $id;
    	$id = safe_b64decode($id);
		$data['title'] = 'Update User Information';  
		$data['message'] = '';
		$post = $this->input->post();

    	if($post && !empty($post))
    	{
    		$post = $this->input->post();
			$data = array( 'role_id'=>$post['user_role'],
							'first_name'=>$post['first_name'],
							'last_name'=>$post['last_name'],
							'email'=>$post['email'],
							'password'=>$post['password'],
							'status'=>$post['status'],
							'update_dt' => time() );
    		
			 $where = array('id'=>$id);
             $this->Common->update('user', $data, $where);
		 
		 
         	$this->session->set_flashdata('success', UPDATE_SUCCESS_MSG);
			redirect('User', 'refresh');
		}
		$data['result'] = $this->UserModel->userInfomation($id);
		$this->load->view('user/user_edit',$data);
	}
	
	
/********************************************************* Role ***********************
* Show Role Data
*/
public function role(){
	$data['title'] = 'User Role';
	$data['userRole'] = $this->Common->select('user_role');
	$this->load->view('role/role',$data);
}

/**
* Add New Role
*/    
public function addRole(){
	$data['title'] = 'Add New User Role';
	$post = $this->input->post();
	if($post && !empty($post)){
		$data = array( 'role_name'=>$post['role'] );
		$this->Common->insert('user_role', $data);
		$this->session->set_flashdata('success', INSERT_SUCCESS_MSG);
		redirect('User/role', 'refresh');
	}
	$this->load->view('role/role_add',$data);
}

/**
* Edit User Role
*/
public function editRole(){
	$id = $this->uri->segment(3);
	$data['id'] = $id;
	$id = safe_b64decode($id);
	$data['title'] = 'Edit User Role';
	$post = $this->input->post();
	if($post && !empty($post))
	{
	   	 $data = array('role_name'=>$post['role']);
	     $where = array('id'=>$post['roleId']);
	     if($this->Common->update('user_role', $data, $where))
	     {
	     	$this->session->set_flashdata('success', UPDATE_SUCCESS_MSG);
	     	redirect('User/role','refresh');
	     }
	     else
	     {
	     	$this->session->set_flashdata('error', UPDATE_FAIL);
	     }
	}
	$where = " where id='".$id."'";
	$data['result'] = $this->Common->select('user_role', $where);
	$this->load->view('role/role_edit', $data);
}

public function editor()
{
	
}

}