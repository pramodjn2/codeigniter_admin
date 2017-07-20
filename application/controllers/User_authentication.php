<?php defined('BASEPATH') OR exit('No direct script access allowed');
class User_Authentication extends CI_Controller
{
    function __construct() {
        parent::__construct();
        // Load user model
        $this->load->model('user');
        $this->load->model('mail');
    	$this->load->library('Facebook');
		  // Load linkedin config
        $this->load->config('linkedin');

        $this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');

		// Load session library
		$this->load->library('session');
	}
    
    public function index(){
		// Include the google api php libraries
        $userData = array();
		/* gmail */
		include_once APPPATH."libraries/google-api-php-client/Google_Client.php";
        include_once APPPATH."libraries/google-api-php-client/contrib/Google_Oauth2Service.php";
        //Gmail API Configuration
        $clientId = $this->config->item('gclientId');
        $clientSecret = $this->config->item('gclientSecret');
		$redirectUrl = $this->config->item('goauthCallback');
		
  	   // Google Client Configuration
        $gClient = new Google_Client();
        $gClient->setApplicationName('Login to codexworld.com');
        $gClient->setClientId($clientId);
        $gClient->setClientSecret($clientSecret);
        $gClient->setRedirectUri($redirectUrl);
        $google_oauthV2 = new Google_Oauth2Service($gClient);

		/* facebook */
		 $data['fbauthUrl'] =  $this->facebook->login_url();
		 
		 /* linkedin */
		include_once APPPATH."libraries/linkedin-oauth-client/http.php";
        include_once APPPATH."libraries/linkedin-oauth-client/oauth_client.php";
		$data['linkedinoauthURL'] = base_url().$this->config->item('linkedin_redirect_url').'?oauth_init=1';
		 
		/* twitter*/
		include_once APPPATH."libraries/twitter-oauth-php-codexworld/twitteroauth.php";
		
		 //Twitter API Configuration
	    $consumerKey = $this->config->item('tconsumerKey');
        $consumerSecret = $this->config->item('tconsumerSecret');
        $oauthCallback = $this->config->item('toauthCallback');
		
		
	   //Get existing token and token secret from session
		$sessToken = $this->session->userdata('token');
		$sessTokenSecret = $this->session->userdata('token_secret');
		
		//Get status and user info from session
		$sessStatus = $this->session->userdata('status');
		$sessUserData = $this->session->userdata('userData');
		
		$this->session->unset_userdata('token');
			$this->session->unset_userdata('token_secret');
			
			//Fresh authentication
			$connection = new TwitterOAuth($consumerKey, $consumerSecret);
			$requestToken = $connection->getRequestToken($oauthCallback);
			
			//Received token info from twitter
			$this->session->set_userdata('token',$requestToken['oauth_token']);
			$this->session->set_userdata('token_secret',$requestToken['oauth_token_secret']);
			
			//Any value other than 200 is failure, so continue only if http code is 200
			if($connection->http_code == '200'){
				//redirect user to twitter
				$twitterUrl = $connection->getAuthorizeURL($requestToken['oauth_token']);
				$data['twitteroauthURL'] = $twitterUrl;
			}else{
				$data['twitteroauthURL'] = base_url().'user_authentication';
				$data['error_msg'] = 'Error connecting to twitter! try again later!';
			}	
		
       $data['authUrl'] = $gClient->createAuthUrl();
       $this->load->view('login',$data);
    }
    
    public function logout()
    {
        $this->session->unset_userdata('token');
        $this->session->unset_userdata('userData');
        $this->session->sess_destroy();
        redirect('/user_authentication');
    }

    public function login()
    {
    	$this->load->view('login/login');
    }

    
    /**
     * Login Action
     *
     * @Method Post
     * @param Request $data array['username'=> 'xxxxx',password='xxxxx']
     *
     */
    public function do_login()
    {
    	$post_data = $this->input->post();
    	$this->load->library('form_validation');
    	// Check validation for user input in SignUp form
		$this->form_validation->set_rules('username', 'username', 'trim');
		$this->form_validation->set_rules('password', 'password', 'trim');
		
		if ($this->form_validation->run() == FALSE) {
			// Will set flash data to shwo error message
			redirect('home/login');
		} else {
			$result = $this->user->do_login($post_data);
			if($result)
			{
					$session_data = array(
						'username' => $result->username,
						'email' => $result->email,
						'role_id' => $result->role_id,
						'first_name' => $result->first_name,
						'status' => $result->status,
					);
					// Add user data in session
					$this->session->set_userdata('logged_in', $session_data);
					redirect('home');
			}
			else
			{
				redirect('/user_authentication');
			}
		}
	}

	/**
     * Login Action
     *
     * @Method Post/Get
     * @param Request $data array['username'=> 'xxxxx','password'='xxxxx','confirmpassword'=>'xxxxxxx']
     *
     */
	public function register()
	{
		$post_data = $this->input->post();

		if(empty($post_data))
		{
			// Show registration from
			$this->load->view('login/register');
		}
		else
		{
			// Show registration from
			$this->form_validation->set_rules('user_name', 'Username', 'trim');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			$this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required');
			if ($this->form_validation->run() == FALSE)
			{	
				var_export($this->form_validation->error); die;
				$this->load->view('login/register');
			}
			else
			{
				$post_data['create_dt'] = time();
				$this->user->insertUser($post_data);
				$last_id = $this->db->insert_id();
				$array = array('slug'=>'signup','status'=>'Active');
				$result = $this->mail->getMailTemplateBySlug($array);
				if($result)
				{
					$subject = $result['subject'];
					$message = $result['message'];

					$username = $post_data['user_name'];

					$site_name = "EM";
					$site_url = base_url();
					$password = $post_data['password'];
					$code = base64_encode($username."|".$last_id."|".$post_data['create_dt']);

					$message = str_replace('{USERNAME}', $username, $message);
					$message = str_replace('{EMAIL}', $username, $message);
					$message = str_replace('{PASSWORD}', $password, $message);
					$message = str_replace('{SITENAME}', $site_name, $message);
					$message = str_replace('{SITEURL}', $site_url, $message);
					$message = str_replace('{CODE}', $code, $message);
					$to = $username;
					sendEmailCI($to, $from, $subject = '', $body = '', $attachments = array(), $filePath = '');

					// resturn json data
				}
				else
				{
					// resturn json data
				}
			}
		}	
	}

	public function verification()
	{
		$get_data = $this->input->get();
		$verifier =  $get_data['verifier'];
		$result = $this->user->verifyUser($verifier);
		if($result)
		{
			// Set success message
		}
		else
		{
			// Set error message
		}

		// Load view
		echo "Please load view here";die;
	}

	public function forget()
	{
		$post_data = $this->input->post();
		if($post_data && !empty($post_data))
		{
			$username = $post_data['username'];
			$user_result = $this->user->getUserByEmail($username);
			$data = array('slug'=>'forgot_password');
			$emailTemplate = $this->mail->getMailTemplateBySlug($data);
			echo "<pre>";
			print_r($emailTemplate);
			echo "</pre>";
			die;
		}

		// 	
		$user_result = $this->load->view('login/forget');
	}

}

