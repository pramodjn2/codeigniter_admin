<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {
	
	public function __construct()
    {
		parent::__construct();	
		$this->base_url = base_url();
		$this->load->library('googlemaps');
	}
	/**
		* CALL METHOD ID USER WANT TO CONTACT US BY EMAIL
		* EMAIL SEND TO ADMIN FOR CONTACT US REQUEST AND TO USER ALSO FOR ACKNOWLEDGED
	**/
	
	public function index()
	{

		$config['center'] = '22.7266802, 75.8842188';
        $config['zoom'] =19;
        $this->googlemaps->initialize($config);

        $marker = array();
        $marker['position'] = '22.7266802, 75.8842188';
        $this->googlemaps->add_marker($marker);
        $data['map'] = $this->googlemaps->create_map();
         
		
		 
		if($_POST){
		   $checkFormValidation = $this->__setFormRules('contact');	

		   $post=$this->input->post();

		    $this->googlemaps->initialize($config);
		    $this->googlemaps->add_marker($marker);
	        $data['map'] = $this->googlemaps->create_map();
	
		   if($checkFormValidation){

			   $insert_array=array('name'=>$post['name'],
							 'email'=>$post['email'],
							 'mobile_number'=>$post['mobile_number'],
							 'subject'=>$post['subject'],
							 'message'=>nl2br($post['message']),
							 'create_dt' => time()
							 ); 
			 $insert_id = $this->Common->insert('contact_us',$insert_array);
               if($insert_id>0){
				    /* Admin Email Start */
					$websetting = $this->session->userdata('websetting');
                    $site_name =  $websetting['site_name'];
					$data['username'] = $site_name. 'Administrator';
					$data['siteurl'] = base_url();
					$data['sitename'] = $site_name;
					$data['name'] = $post['name'];
					$data['email'] = $post['email'];
					$data['subject'] = $post['subject'];

					$data['msg'] = $post['message'];
					$data['data']['title']	= "Enquiry";
					
					$where = "WHERE slug = 'contact_us'";
					$data['mail_result'] = $this->Common->select('manage_email_templates',$where);
					$message = $this->parser->parse('mail_template/contact_us', $data, TRUE);
					
					$toEmail = $websetting['site_email'];
					$fromEmail = array('email' => $websetting['site_email'],'name' => ucwords($site_name));
					$subject = $post['subject'];
					$attachment = array();
					$result = send_email($toEmail, $fromEmail, $subject, $message, $attachment);
					/* Admin Email End */
					
					/* User Email Start */
					$where = "WHERE slug = 'contact_us_thankyou'";
					$data['mail_result'] = $this->Common->select('manage_email_templates',$where);
					$data['username'] = $post['name'];
					$data['sitename'] = $site_name;
					$message = $this->parser->parse('mail_template/contact_us_thank_you', $data, TRUE);
					
					$toEmail = $post['email'];
					$fromEmail = array('email' => $websetting['site_email'],'name' => ucwords($site_name));
					$subject = $post['subject'];
					$attachment = array();
					
					$result = send_email($toEmail, $fromEmail, $subject, $message, $attachment);
					/* User Email End */
				   
				   
				   $this->session->set_flashdata('success', 'Your message has been sent successfully');
			   }else{
				   $this->session->set_flashdata('warning', 'Message sending failed');
			   }
		  }
		}
		$data['title']='Contact us';
		$this->load->view('static_pages/contact_us',$data);//,$data
	}
	


/**
	* SET RULES FOR INPUT POST DATA	
**/
	function __setFormRules($setRulesFor = ''){
		switch($setRulesFor){				
			case'contact':
				$this->form_validation->set_rules('name', 'Name', 'trim|required');
				$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
				$this->form_validation->set_rules('subject', 'Subject', 'trim|required');
				$this->form_validation->set_rules('message', 'Message', 'trim|required');
			break;
			
			default:
				$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
			break;
		}
				$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button data-dismiss="alert" class="close">×</button><i class="fa fa-times-circle"></i> ', '</div>');
				
		return $this->form_validation->run();
	}
	

	/**
		* CHECK CAPTCHA IS CORRECT OR NOT
	**/
	function check_captcha($val)
	{
	  	if ($this->recaptcha->check_answer($this->input->ip_address(), $this->input->post('recaptcha_challenge_field'), $val))
		{
	    	return TRUE;
	  	}
		
	    $this->form_validation->set_message('check_captcha', $this->lang->line('recaptcha_incorrect_response'));
	    return FALSE;
	}
}
