<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserModel extends CI_Model {


   /**
   * user infomation get 
   */
    function userInfomation($user_id = NULL){

	$this->db->select('u.*,ur.role_name ',false);
	$this->db->from('user u');
	$this->db->join('user_role ur', 'ur.id = u.role_id', 'LEFT');
	//$this->db->where('u.status', 'Active');
	
	if(!empty($user_id)){
		$this->db->where('u.id', $user_id); 
	}
	$query = $this->db->get();	
		if($query->num_rows()>0){
				return $query->result_array();
		}else{
				return false;
		}
		
    }


   



}