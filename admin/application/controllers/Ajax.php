<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {

	var $user_id = '';
    public function __construct() {
    	parent::__construct();
    	check_user_login();
		
		$this->load->helper(array());
		$this->user_id = $this->session->userdata('user_id');
	    //$this->output->enable_profiler(TRUE);	
    }

   /**
   * notification unread 
   */
	public function notification_unread()
	{ 
	    $post = $this->input->post();
		$where = array('id' => $post['id']);
		$data = array('read_status' => 1);
    	$this->Common->update('notification', $data, $where);
		return true;
	}
}