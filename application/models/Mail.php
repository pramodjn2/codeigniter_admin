<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mail extends CI_Model{
    function __construct() {
        $this->tableName = 'manage_email_templates';
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

    public function getMailTemplateBySlug($data)
    {
        $this->db->select("*");
        $this->db->from($this->tableName);

        $this->db->where(array('slug'=>$data['slug']));
        $prevQuery = $this->db->get();
       
        $prevCheck = $prevQuery->num_rows();
        if($prevCheck > 0)
        {
            return $prevQuery->row_array();
        }
        else
        {
            return false;
        }    
    }
	
}