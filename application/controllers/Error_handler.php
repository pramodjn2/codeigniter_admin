<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Error_handler extends CI_Controller {
	
    public function __construct() 
    {
        parent::__construct(); 
    } 

    public function index() 
    { 
        $this->output->set_status_header('404'); 
        $data['title'] = 'Page Not Found'; // View name 
		
		  $data['heading'] = 'Error-404'; // View name 
		  $data['message'] = 'message Error-404'; // View name 
		
		
        
        $this->load->view('errors/html/error_404', $data);
		
    } 
} 
