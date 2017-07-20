<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* USE FOR LOGIN FUNCTIONS
*/

class Login_Model extends CI_Model
{
	var $details;
	/**
		* CHECK AUTHENTICATION OF THE USERS
        **/
	function authenticate_user($email, $type = 'email', $password){

	    $this->db->select('*');
        $this->db->from('user');
		
		if($email !='' && $type == 'email'){
        	$this->db->where('email', $email);	
		}else{
			$this->db->where('user_id', $email);
		}	
		
		
        $result = $this->db->get();
		$records = $result->num_rows();
		$recordsData = $result->result();
		
		//echo $records;
		//dd($recordsData);
		if($records > 0) {	
						
			if($email !='' && $type=='email' && $password !='')
			{	
			//echo decrypt($recordsData[0]->password); die;
			
			//dd($recordsData);
				if($recordsData[0]->password == trim($password)){
					
					if($recordsData[0]->status == 'inActive'){
						$msg = 'Your account is deactivated. Please verify email after that login.';
						//$this->email_verification($recordsData[0]->user_id);
						return $msg;	  
			        }
					if($recordsData[0]->status == 'Active'){
					   $this->details = $recordsData[0];				
					   $this->set_session($recordsData[0]);
					   return 1;
					}else if($recordsData[0]->status == 'Delete'){
						$msg = 'Your A/C has been Delete, Kindly contact to wed-admin <a href="'.site_url('pages/contact_us').'" >Click here</a>';
						return $msg;	
					}
				}else{
					$msg = 'Incorrect password';
					return $msg;
				}
			}else{				
			
				$this->details = $recordsData[0];				
             	$this->set_session($recordsData[0]);
				return 1;				
			}
        }
		$msg = 'This email is not registered with us.';
		return $msg;
    }
	
	/**
		* SET SESSION VALUES
    **/
	
    function set_session($userData = '')
	{
		$this->details = (!isset($this->details) && empty($this->details))? $userData : $this->details;
		$user_data = array('user_id' => $this->details->id,
						'first_name'	=> $this->details->first_name,
						'last_name'		=> $this->details->last_name,
						'fullName'		=> $this->details->first_name.' '.$this->details->last_name,
						'email'			=> $this->details->email, 
						'role_id'		=> $this->details->role_id,
						'status'		=> $this->details->status,
						'create_dt' =>$this->details->create_dt,
						'picture_url' => $this->details->picture_url);
						
		$this->session->set_userdata('logged_in',$user_data);
		$this->session->set_userdata('user_id', $this->details->id);
		$this->login_attempts($this->details->id);
	}

	/**
	* login attempts insert
	*/
	public function login_attempts($user_id){
		 $data = array('user_id' => $user_id,
						'ip_address' => $_SERVER['REMOTE_ADDR'],
						'login_dt' => time(),
						);
		 $this->db->insert('user_login_attempts', $data); 
		 return true;
	}


	/**
		* USER EMAIL VARIFICATION
    **/
	protected function email_verification($user_id){
		
		$websetting = $this->session->userdata('websetting');		
		$result= $this->Common->select('user',"where user_id='$user_id'");	
		
		$site_name =  $websetting['site_name'];			
		$data['username'] = ucwords($result[0]['firstName'].' '.$result[0]['lastName']);
		$data['email'] = $result[0]['email'];
		$data['code'] = $result[0]['activation_code'];
		$data['siteurl'] = base_url();
		$data['sitename'] = $site_name;
		$data['data']['title']	= "Email verification";
		
		
		$where = "WHERE template_id = 14";
		$data['welcome_user'] = $this->Common->select('email_templates',$where);
		
		$message = $this->parser->parse('mail_template/mail_verify_message', $data,true);
		$toEmail = $result[0]['email'];
		$fromEmail = array('email' => config_item('no_reply'),'name' => config_item('site_name'));
		$subject = 'Email verification';
		$subject = $site_name.' - '.$subject;
		$attachment = array();
		$result = send_user_email_ci($toEmail, $fromEmail, $subject, $message, $attachment);
		return true;
	}
	
	
}