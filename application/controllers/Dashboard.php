<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller
{
    function __construct() {
        parent::__construct();
        // Load user model
        $this->load->model('user');
     	$this->load->library('Facebook');
		 // Load linkedin config
        $this->load->config('linkedin');

    }
    
    public function gmail(){
		// Include the google api php libraries
        include_once APPPATH."libraries/google-api-php-client/Google_Client.php";
        include_once APPPATH."libraries/google-api-php-client/contrib/Google_Oauth2Service.php";
        
        // Google Project API Credentials
         $clientId = $this->config->item('gclientId');
         $clientSecret = $this->config->item('gclientSecret');
		 $redirectUrl = $this->config->item('goauthCallback');;
		  
        // Google Client Configuration
        $gClient = new Google_Client();
        $gClient->setApplicationName('Login to codexworld.com');
        $gClient->setClientId($clientId);
        $gClient->setClientSecret($clientSecret);
        $gClient->setRedirectUri($redirectUrl);
        $google_oauthV2 = new Google_Oauth2Service($gClient);

        if (isset($_REQUEST['code'])) {
            $gClient->authenticate();
            $this->session->set_userdata('token', $gClient->getAccessToken());
            redirect($redirectUrl);
        }

        $token = $this->session->userdata('token');
        if (!empty($token)) {
            $gClient->setAccessToken($token);
        }

        if ($gClient->getAccessToken()) {
            $userProfile = $google_oauthV2->userinfo->get();
			//echo '<pre/>';
			//print_r($userProfile); die;
            // Preparing data for database insertion
            $userData['oauth_provider'] = 'google';
            $userData['oauth_uid'] = $userProfile['id'];
            $userData['first_name'] = $userProfile['given_name'] ? $userProfile['given_name'] : '';
            $userData['last_name'] = $userProfile['family_name'] ? $userProfile['family_name'] : '';
            $userData['email'] = $userProfile['email'] ? $userProfile['email'] : '';
            $userData['gender'] = $userProfile['gender'] ? $userProfile['gender'] : '';
            $userData['locale'] = $userProfile['locale'] ? $userProfile['locale'] : '';
            $userData['profile_url'] = $userProfile['link'] ? $userProfile['link'] : '';
            $userData['picture_url'] = $userProfile['picture'] ? $userProfile['picture'] : '';
            // Insert or update user data
            $userID = $this->user->checkUser($userData);
            if(!empty($userID)){
                $data['userData'] = $userData;
                $this->session->set_userdata('userData',$userData);
            } else {
               $data['userData'] = array();
            }
        } else {
            $data['authUrl'] = $gClient->createAuthUrl();
        }
        $this->load->view('login',$data);
    }
	
	
	public function twitter(){
        $userData = array();
        
        //Include the twitter oauth php libraries
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
        
        if(isset($sessStatus) && $sessStatus == 'verified'){
            //Connect and get latest tweets
            $connection = new TwitterOAuth($consumerKey, $consumerSecret, $sessUserData['accessToken']['oauth_token'], $sessUserData['accessToken']['oauth_token_secret']); 
            $data['tweets'] = $connection->get('statuses/user_timeline', array('screen_name' => $sessUserData['username'], 'count' => 5));

            //User info from session
            $userData = $sessUserData;
        }elseif(isset($_REQUEST['oauth_token']) && $sessToken == $_REQUEST['oauth_token']){
            //Successful response returns oauth_token, oauth_token_secret, user_id, and screen_name
            $connection = new TwitterOAuth($consumerKey, $consumerSecret, $sessToken, $sessTokenSecret);
            $accessToken = $connection->getAccessToken($_REQUEST['oauth_verifier']);
            if($connection->http_code == '200'){
                //Get user profile info
                $userInfo = $connection->get('account/verify_credentials');

                //Preparing data for database insertion
                $name = explode(" ",$userInfo->name);
                $first_name = isset($name[0])?$name[0]:'';
                $last_name = isset($name[1])?$name[1]:'';
                $userData = array(
                    'oauth_provider' => 'twitter',
                    'oauth_uid' => $userInfo->id,
                    'username' => $userInfo->screen_name,
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'locale' => $userInfo->lang,
                    'profile_url' => 'https://twitter.com/'.$userInfo->screen_name,
                    'picture_url' => $userInfo->profile_image_url
                );
                
                //Insert or update user data
                $userID = $this->user->checkUser($userData);
                
                //Store status and user profile info into session
                $userData['accessToken'] = $accessToken;
                $this->session->set_userdata('status','verified');
                $this->session->set_userdata('userData',$userData);
                
                //Get latest tweets
                $data['tweets'] = $connection->get('statuses/user_timeline', array('screen_name' => $userInfo->screen_name, 'count' => 5));
            }else{
                $data['error_msg'] = 'Some problem occurred, please try again later!';
            }
        }else{
            //unset token and token secret from session
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
                //Get twitter oauth url
                $twitterUrl = $connection->getAuthorizeURL($requestToken['oauth_token']);
                $data['oauthURL'] = $twitterUrl;
            }else{
                $data['oauthURL'] = base_url().'user_authentication';
                $data['error_msg'] = 'Error connecting to twitter! try again later!';
            }
        }

        $data['userData'] = $userData;
        $this->load->view('login',$data);
    }
	
	
	public function facebook(){
        $userData = array();

        // Check if user is logged in
        if($this->facebook->is_authenticated()){
            // Get user facebook profile details
            $userProfile = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email,gender,locale,picture');
           // echo '<pre/>'; print_r($userProfile); die;
            // Preparing data for database insertion
            $userData['oauth_provider'] = 'facebook';
            $userData['oauth_uid'] = $userProfile['id'] ? $userProfile['id'] : '';
            $userData['first_name'] = $userProfile['first_name'] ? $userProfile['first_name'] : '';
            $userData['last_name'] = $userProfile['last_name'] ? $userProfile['last_name'] : '';
            $userData['email'] = $userProfile['email'] ? $userProfile['email'] : '';
            $userData['gender'] = $userProfile['gender'] ? $userProfile['gender'] : '';
            $userData['locale'] = $userProfile['locale'] ? $userProfile['locale'] : '';
            $userData['profile_url'] = 'https://www.facebook.com/'.$userProfile['id'];
            $userData['picture_url'] = $userProfile['picture']['data']['url'] ? $userProfile['picture']['data']['url'] : '';

            // Insert or update user data
            $userID = $this->user->checkUser($userData);

            // Check user data insert or update status
            if(!empty($userID)){
                $data['userData'] = $userData;
                $this->session->set_userdata('userData',$userData);
            }else{
               $data['userData'] = array();
            }

            // Get logout URL
            $data['logoutUrl'] = $this->facebook->logout_url();
        }else{
			echo 'else'; die;
            $fbuser = '';

            // Get login URL
            $data['authUrl'] =  $this->facebook->login_url();
        }

        // Load login & profile view
        $this->load->view('login',$data);
    }
	
	
	public function linkedin(){
        $userData = array();
        
        //Include the linkedin api php libraries
        include_once APPPATH."libraries/linkedin-oauth-client/http.php";
        include_once APPPATH."libraries/linkedin-oauth-client/oauth_client.php";
        
        //Get status and user info from session
        $oauthStatus = $this->session->userdata('oauth_status');
        $sessUserData = $this->session->userdata('userData');
        
        if(isset($oauthStatus) && $oauthStatus == 'verified'){
            //User info from session
            $userData = $sessUserData;
        }elseif((isset($_REQUEST["oauth_init"]) && $_REQUEST["oauth_init"] == 1) || (isset($_REQUEST['oauth_token']) && isset($_REQUEST['oauth_verifier']))){
            $client = new oauth_client_class;
            $client->client_id = $this->config->item('linkedin_api_key');
            $client->client_secret = $this->config->item('linkedin_api_secret');
            $client->redirect_uri = base_url().$this->config->item('linkedin_redirect_url');
            $client->scope = $this->config->item('linkedin_scope');
            $client->debug = false;
            $client->debug_http = true;
            $application_line = __LINE__;
            
            //If authentication returns success
            if($success = $client->Initialize()){
                if(($success = $client->Process())){
                    if(strlen($client->authorization_error)){
                        $client->error = $client->authorization_error;
                        $success = false;
                    }elseif(strlen($client->access_token)){
                        $success = $client->CallAPI('http://api.linkedin.com/v1/people/~:(id,email-address,first-name,last-name,location,picture-url,public-profile-url,formatted-name)', 
                        'GET',
                        array('format'=>'json'),
                        array('FailOnAccessError'=>true), $userInfo);
                    }
                }
                $success = $client->Finalize($success);
            }
            
            if($client->exit) exit;
    
            if($success){
                //Preparing data for database insertion
                $first_name = !empty($userInfo->firstName)?$userInfo->firstName:'';
                $last_name = !empty($userInfo->lastName)?$userInfo->lastName:'';
                $userData = array(
                    'oauth_provider' => 'linkedin',
                    'oauth_uid'      => $userInfo->id,
                    'first_name'     => $first_name,
                    'last_name'      => $last_name,
                    'email'          => $userInfo->emailAddress,
                    'locale'         => $userInfo->location->name,
                    'profile_url'    => $userInfo->publicProfileUrl,
                    'picture_url'    => $userInfo->pictureUrl
                );
                
                //Insert or update user data
                $userID = $this->user->checkUser($userData);
                
                //Store status and user profile info into session
                $this->session->set_userdata('oauth_status','verified');
                $this->session->set_userdata('userData',$userData);
                
                //Redirect the user back to the same page
                redirect('/user_authentication');

            }else{
                 $data['error_msg'] = 'Some problem occurred, please try again later!';
            }
        }elseif(isset($_REQUEST["oauth_problem"]) && $_REQUEST["oauth_problem"] <> ""){
            $data['error_msg'] = $_GET["oauth_problem"];
        }else{
            $data['oauthURL'] = base_url().$this->config->item('linkedin_redirect_url').'?oauth_init=1';
        }
        
        $data['userData'] = $userData;
        
        // Load login & profile view
        $this->load->view('login',$data);
    }

 
}