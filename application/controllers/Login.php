<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper(array('cookie'));
		$this->load->library(array('parser'));	
	}
	
	/*public function index()
	{
		$this->load->view('login');
	}
	*/
	
	/**
	 	* CALL FOR USER LOGIN
	**/
	
	public function index(){
		$data['page_title']='Login';
		$this->load->model('Login_Model');
		$post = $this->input->post();
		
		if($post && !empty($post)){	
			
			$email = $post['email'];
		 	$password  = $post['password'];
			$remember = @$post['remember'];
			
	     	$responce = $this->Login_Model->authenticate_user($email, 'email' , $password);
			if($responce == 1) {    
    		  // If the user is valid, redirect to the main view
               $url = base_url();
				   if($remember)
				   {
						$cokiesYear = time() + 60*60*24*30;
						$cookies = array('name'   => 'userID',
									   'value'  => $this->session->userdata('user_id'),
									   'expire'   => $cokiesYear);
						$this->input->set_cookie($cookies);
					 
					}
					else
					{
						delete_cookie("userID");
					}
				   
					$responce_array[] = array(
					    'message' => USER_LOGIN_SUCCESS_MSG, 
					    'message_div_id' => 'sign_in_message', 
					    'message_class' => 'alert alert-success',
					    'url_full' => 1,
					    'redirect' =>$url);
					
					if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
					{
						echo json_encode($responce_array); die;
					}
					else
					{
						redirect($url);	
					} 
			    	
			    }
			    else
			    {
			    // Otherwise show the login screen with an error message. 
			    //$data['msg']['warning'] = 'Incorrect Email-ID and Password';
			    //login_attempt_count($email);
			    $data['msg']['warning'] = $responce;
			    $responce_array[] = array('message' => $responce, 
					'message_div_id' => 'sign_in_message', 
					'message_class' => 'alert alert-danger');
					
					if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
					echo json_encode($responce_array); die;
					}
					else
					{
						$data['msg'] = $responce;
					    $data['class'] = 'alert alert-danger';	
					}
				}
		}
		
		$this->load->view('register',$data);
	}
	
	/**
	 	* CALL FOR USER REGISTRATION
	**/
	public function signup(){

		$websetting = $this->session->userdata('websetting');
		$post = $this->input->post();
		if($post && !empty($post))
		{

			$firstName = explode("@",$post['email']);
			$firstName = $firstName[0];
			$email = $post['email'];
			$group_id = 4;
			$password = $post['psw'];
			$activation_code = mt_rand();
			
			// 1) unique email check
			$where = " where email = '$email'"; 
			$result = $this->Common->select('user',$where);
			
			if(empty($result))
			{
				
				$data = array('first_name' => $firstName,
							  'email' => $email,
							  'password' => $password,
							  'role_id' => $group_id,
							  'status' => 'inActive',
							  'activation_code' => $activation_code);
		 
				$result = $this->Common->insert('user', $data);
			 	
				if($result)
				{
					
					/* mail */
                    $site_name =  $websetting['site_name'];
					$data['username'] = ucwords($firstName);
					$data['siteurl'] = base_url();
					$data['sitename'] = $site_name;
					$data['email']	= $email;
					$data['password'] = $post['password'];
					$data['code'] = $activation_code;
					
				    $where = "WHERE slug = 'signup'";
			        $data['mail_result'] = $this->Common->select('manage_email_templates',$where);
			
		            $data['data']['title']	= $data['mail_result'][0]['subject'];
					$message = $this->parser->parse('mail_template/sign_up', $data, TRUE);
					$toEmail = $email;
					$fromEmail = array('email' => $websetting['site_email'],'name' => ucwords($site_name));
					$subject = $data['mail_result'][0]['subject'];
					$attachment = array();
					$result = send_email($toEmail, $fromEmail, $subject, $message, $attachment);
			
					// An email has been sent to your mail address. please check your mail and use the enclosed link to finish registration
					$responce_array[] = array('message' => 'Thank you for registeration. An email has been sent to your mail address. please check your mail and use the enclosed link to finish registration.', 
										  'message_div_id' => 'sign_up_message', 
										  'message_class' => 'alert alert-success',
										  'form_id' => 'registration-form',
										  'form_reset' => 1,
										  'hide_div' => '',
										  'show_div' => ''
										  );	
										  
										 				  				  
										  
				}
				else
				{
					$responce_array[] = array('message' => 'Email confirmation message sending failed to your email, please enter email id', 
										  'message_div_id' => 'sign_up_message', 
										  'message_class' => 'alert alert-success',
										  'form_id' => 'registration-form',
										  'form_reset' => 1);				  
				}
			}
			else
			{
			    $msg['type'] = 'alert alert-danger';
				$msg['reset'] = 0;
				$msg['redirect'] = '';
				$msg['form_id'] = 0;
				$msg['hide_div'] = 0;
				$msg['msg'] = "This e-mail address already exists.";
				$responce_array[] = array('message' => 'This e-mail address already exists', 
									  'message_div_id' => 'sign_up_message', 
									  'message_class' => 'alert alert-danger',
									  'form_id' => 'registration-form',
									  'form_reset' => 0);
			}
			echo json_encode($responce_array); die;
		}
		else
		{
			$data['page_title'] = 'Login';
			$this->load->view('register',$data);
		}
	}
	

	/**
	 	* CALL FOR VARIFICATION IF USER REGISTERED
	**/
	public function verification(){
		
		$verifier = @$_POST['verifier'] ? @$_POST['verifier'] : @$_GET['verifier'];
		if($verifier){
		
		        $where = " where activation_code = '$verifier'"; 
				$result = $this->Common->select('user',$where);
				if(!empty($result)){
					
					$user_id = $result[0]['id'];
					$where = array('id' => $user_id);	
					$update_data = array('activation_code' => '',
					                     'status' => 'Active');
				 					 
				    $this->Common->update('user',$update_data,$where);
                    
					$websetting = $this->session->userdata('websetting');
                  
				    $site_name =  ucwords($websetting['site_name']);
                    
					$email = $result[0]['email'];
					$data['email'] = $email;
					$data['username'] = ucwords($result[0]['first_name'].' '.$result[0]['last_name']);
					$data['sitename'] = $site_name;
					$data['siteurl'] = base_url();
					
					$data['data']['title'] = 'Email Verification';
					
					$where = "WHERE slug = 'email_verification'";
					$data['mail_result'] = $this->Common->select('manage_email_templates',$where);
					
					$message = $this->parser->parse('mail_template/email_verification', $data, TRUE);
					
					$toEmail = $email;
					$fromEmail = array('email' => $websetting['site_email'],'name' => ucwords($site_name));
					
					$subject = $data['mail_result'][0]['subject'];
					
					$attachment = array();
					$result = send_email($toEmail, $fromEmail, $subject, $message, $attachment);
					
					$user_id = $this->session->userdata('user_id');
					if(!empty($user_id)){
					$data['msg'] = 'Well done! You have successfully verified your email address';	
					}else{
					$data['msg'] = 'Well done! You have successfully verified your email address Please login <a href="'.base_url('login').'">Sign In</a>.';
					}
				    $data['class'] = 'alert alert-success';
				}else{
					$data['msg'] = 'Invalid verification code.';
				    $data['class'] = 'alert alert-danger';
					}
	      	}else{
				$data['msg'] = 'Please Insert verification code.';
				$data['class'] = 'alert alert-danger';
			}
			$this->load->view('register',$data);
			
	}
	
	/**
	 	* CALL IF USER FORGOT THE PASSWORD OF THEIR LOGIN ACCOUNT 
	**/
	public function forgot_password(){
		$post = $this->input->post();
		$submittype = @$_POST['submittype'];
		$uCheck = $this->db->get_where('user', array('email' => $post['email']))->result_array();
		if(!empty($uCheck)){            
			$websetting = $this->session->userdata('websetting');
            $site_name =  $websetting['site_name'];
		    $Password = mt_rand(100000, 999999);
			$this->db->update('user', array('password' => $Password),array('id' => $uCheck[0]['id']));           
			
			// Email Configuration
			
		        $subject=$site_name.' Forgot Password';
				$data['username'] = ucwords($uCheck[0]['first_name'].' '.$uCheck[0]['last_name']);
				$data['siteurl'] = base_url();
				$data['sitename'] =$site_name;
				$data['email']	= $uCheck[0]['email'];
				$data['PASSWORD']	= $Password;
			
                $data['data']	= '';
			
			$data['firstname'] = $uCheck[0]['first_name'];
			$data['profile_image'] = $uCheck[0]['picture_url'];
			
			$username = $data['username'];
            $seousername = str_replace('&nbsp;', '-', $username);
            $data['recieverseo'] = seo_friendly_urls($seousername,'',$uCheck[0]['user_id']);

			$where = "WHERE slug = 'forgot_password'";
			$data['mail_result'] = $this->Common->select('manage_email_templates',$where);
					
					
			$message = $this->parser->parse('mail_template/forgot_password', $data, TRUE);
			$toEmail = $uCheck[0]['email'];
			$fromEmail = array('email' => $websetting['site_email'],'name' => ucwords($site_name));
			
			$subject = $data['mail_result'][0]['subject'];
			
			$attachment = array();
			$result = send_email($toEmail, $fromEmail, $subject, $message, $attachment);
			  
			if(!empty($submittype)){
			  	$responce_array[] = array('message' => 'Thank you ! your request has been processed a new password is emailed to you.', 
			              'message_div_id' => 'forget_message', 
							'message_class' => 'alert alert-success',
							'hide_div' => '',
							'tab_id' => ''
							);	
			}else{
				$responce_array[] = array('message' => 'Thank you ! your request has been processed a password is emailed to you.', 
										  'message_div_id' => 'forget_message',
										  'message_class' => 'alert alert-success',
										  'hide_div' => '',
										  'show_div' => '',
										  'form_reset' => 1,
										  'form_id' => 'forget-form'
										  );
			}
			echo json_encode($responce_array); die;
		}else{		     
			$responce_array[] = array('message' => 'No account found with that email address.', 
										  'message_div_id' => 'forget_message', 
										  'message_class' => 'alert alert-danger',
										   'hide_div' => '',
										  'show_div' => ''
										  );
			echo json_encode($responce_array); die;
										  
		}		
	}
	
	/**
	 	* CALL FOR USER LOGOUT 
	 	* SESSION WILL DISTROY
	 	* DELETE USER COOKIE
	 	* REDIRECT TO LOGIN PAGE AFTER LOGOUT
	**/
	public function logout(){
		$this->session->sess_destroy();
      	delete_cookie("userID");
		redirect(base_url('login'));		
	}
}
