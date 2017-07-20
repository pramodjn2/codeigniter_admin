<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
    {
		parent::__construct();		
		$this->load->helper(array());
		$this->load->library(array('form_validation'));
		//$this->output->enable_profiler(TRUE);	
    }
	
	public function index()
	{
		$data['msg']['error'] = '';
		$post = $this->input->post();
		if($post && !empty($post)){
       		
       		$email    = $post['username'];
			$password = $post['password'];

			$where = " where role_id = 1 && email = '".$email."' && password = '".$password."'";
			$result = $this->Common->select('user',$where);
			if($result)
			{
				login_attempts($result[0]['id']);
				$this->session->set_userdata('user_id',$result[0]['id']);
				$this->session->set_userdata('name',$result[0]['first_name'].' '.$result[0]['last_name']);
				$this->session->set_userdata('email',$result[0]['email']);
				redirect('Dashboard');
			}
			else
			{
             $data['msg']['error'] = LOGIN_UNVALID_DETAIL;
			}
        }
		$data['stylesheet'] = array('assets/vendors/animate/css/animate.min.css');
		$this->load->view('login',$data);
	}

	public function logout(){
		$this->session->sess_destroy();
      	redirect(base_url('login'));
	}
}
