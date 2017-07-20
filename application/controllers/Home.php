<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    
	var $user_id = '';
    public function __construct() {
        parent::__construct();
        // Load user model
        $this->load->model('user');
		$this->user_id = $this->session->userdata('user_id');
		//$this->output->enable_profiler(TRUE);	
     }
    
	
	public function index()
	{
		$data['title'] = 'Home';
		$data['javascript'] = array('assets/js/custom/article.js');
		$this->load->model(array('articleModel'));
	    $data['article'] = $this->articleModel->article();
		
		$this->load->view('home',$data);
	}
}
