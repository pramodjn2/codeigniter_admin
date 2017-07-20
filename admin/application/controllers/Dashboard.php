<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {
    	parent::__construct();
    	check_user_login();
    }


	public function index()
	{
		$data['rescuresult'] = '';
		$this->load->view('dashboard',$data);
	}

}