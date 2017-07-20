<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends CI_Model{
    function __construct() {
        $this->tableName = 'user';
        $this->primaryKey = 'id';
    }
    public function checkUser($data = array()){
        $this->db->select($this->primaryKey);
        $this->db->from($this->tableName);
       // $this->db->where(array('oauth_provider'=>$data['oauth_provider'],'oauth_uid'=>$data['oauth_uid']));
		 $this->db->where(array('email'=>$data['email']));
        $prevQuery = $this->db->get();
        $prevCheck = $prevQuery->num_rows();
        
        if($prevCheck > 0){
            $prevResult = $prevQuery->row_array();
            $data['update_dt'] =  time();
            $update = $this->db->update($this->tableName,$data,array('id'=>$prevResult['id']));
            $userID = $prevResult['id'];
        }else{
            $data['create_dt'] = time();
            $data['update_dt'] = time();
            $insert = $this->db->insert($this->tableName,$data);
            $userID = $this->db->insert_id();
        }

        return $userID?$userID:FALSE;
    }

    /**
     * Check username password from database
     *
     * @param Request $data array['username'=> 'xxxxx',password='xxxxx']
     * @param Return boolean ={'true','false'}
     *
     */
    public function do_login($data)
    {
        $this->db->select("*");
        $this->db->from($this->tableName);

        $this->db->where(array('email'=>$data['username']));
        $prevQuery = $this->db->get();
        $prevCheck = $prevQuery->num_rows();
        if($prevCheck > 0)
        {
            $result = $prevQuery->row();
            if($result->password === md5($data['password']))
            {
                return $result;
            }
            else
            {
                return false;
            }
        }
    }

    /**
     * Insert new user into database
     *
     * @param Request $data array
     * @param Return boolean ={'true','false'}
     *
     */
    public function insertUser($dataArray)
    {
        if(NULL == $dataArray['role_id'])
            $data['role_id'] = 4;
        $data = array(

                        'user_name' => $dataArray['user_name'],
                        'password' => md5($dataArray['password']),
                        'status'   => 'inActive',
                        'status'   => 'inActive',
                        'create_dt'  => time(),
                        'role_id'    => $data['role_id'],
                        'email' => $dataArray['user_name']
                     );

        return $this->db->insert($this->tableName, $data);
    }

    /**
     * Verify new user
     *
     * @param Request $verify
     * @param Return boolean ={'true','false'}
     *
     */
    public function verifyUser($verifier)
    {

        $verifier = base64_decode($verifier);
        $verifier = explode("|",$verifier);

        $this->db->select("*");
        $this->db->from($this->tableName);

        $this->db->where(array('email'=>$verifier[0], 'id' => $verifier[1], 'create_dt' => $verifier[2]));
        $id = $verifier[1];
        $prevQuery = $this->db->get();
        $prevCheck = $prevQuery->num_rows();

        if($prevCheck > 0)
        {
            $data=array('status'=> 'Active');
            $this->db->where('id',$id);
            $this->db->update('user',$data);
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * Fetch user by email
     *
     * @param Request $email
     * @param Return array
     *
     */
    public function getUserByEmail($email)
    {
        $this->db->select("*");
        $this->db->from($this->tableName);

        $this->db->where(array('email'=>$email));
        
        $prevQuery = $this->db->get();
        $prevCheck = $prevQuery->num_rows();

        if($prevCheck > 0)
        {
            return $prevQuery->row();
        }
    }
	
	
  
  /**
  * user comment get
  */
  function user_comment_likes($user_id){
	
   $this->db->select('comment_id');
   $this->db->from('article_comment_like');
   $this->db->where('user_id ='. $user_id);
   
    $query = $this->db->get();
	   if($query->num_rows()>0){
		foreach($query->result_array() as $val){
		   $data[] = $val['comment_id'];	
		 }
		 return $data;
	   }else{ 
		  return false;
	   }	
	     
  }
	
}