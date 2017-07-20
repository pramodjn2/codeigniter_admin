<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Demo extends CI_Controller
{
	var $user_id = '';
    public function __construct() {
        parent::__construct();
        // Load user model
        $this->load->model('user');
		$this->user_id = $this->session->userdata('user_id');
		$this->user_id = 1;
		$this->output->enable_profiler(TRUE);	
     }
    
	/**
	* article comment
	*/
	public function comment(){
	   $this->load->model(array('articleModel'));
	   $article_id = 1;
	   $data['article_id'] = $article_id;
	   $data['comment'] = $this->articleModel->article_comment($article_id);
	 
	   $where = "where user_id = ".$this->user_id;
	   $data['user_comment_like'] = $this->user->user_comment_likes($this->user_id);
	   
	   
	    $data['result'] = $this->articleModel->article_comment(2,'',16);
	 
	   
	   $this->load->view('example/comment',$data);
	}
    
	/**
	* article grid
	*/
	public function article(){
	   $this->load->model(array('articleModel'));
	   $data['result'] = $this->articleModel->article();
	   dd($data['result']);
	}
	
	/**
	* carousel slider
	*/
	public function carousel_slider(){
	   
	   $where = "where status = 'Active' ORDER BY id DESC";
	   $data['carousel_slider'] = $this->Common->select('manage_carousel_slider',$where);
	   dd($data['carousel_slider']);
	}
	
	
	function sing_up_mail(){
	        $websetting = $this->session->userdata('websetting');
			$site_name =  $websetting['site_name'];
			
			$firstName = 'Pramod Jain';
			$email = 'pramod.jain@consagous.com';
			$password = '123456';
			$activation_code = mt_rand();
			
			
			$data['username'] = ucwords($firstName);
			$data['siteurl'] = base_url();
			$data['sitename'] = $site_name;
			$data['email']	= $email;
			$data['password'] = $password;
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
			$this->parser->parse('mail_template/sign_up', $data);
						
	}
 
}