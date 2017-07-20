<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ArticleModel extends CI_Model {


   /**
   * Article infomation get 
   */
    function article($id = NULL){

	$this->db->select('a.*,u.first_name,u.last_name,c.title as cat_title, au.id as article_upload_id,au.file_name,au.file_type',false);
	$this->db->from('article a');
	$this->db->join('user u', 'u.id = a.user_id', 'LEFT');
	$this->db->join('article_category c', 'c.id = a.category_id', 'LEFT');
	$this->db->join('article_upload au', 'au.article_id = a.id', 'LEFT');
	//$this->db->where('u.status', 'Active');
	
	if(!empty($id)){
		$this->db->where('a.id', $id); 
	}
	$query = $this->db->get();	
		if($query->num_rows()>0){
				return $query->result_array();
		}else{
				return false;
		}
		
    }



 /**
   * Article category get 
   */
    function category($id = NULL){

	$this->db->select('a.*',false);
	$this->db->from('article_category a');
	//$this->db->where('u.status', 'Active');
	
	if(!empty($id)){
		$this->db->where('a.id', $id); 
	}
	$query = $this->db->get();	
		if($query->num_rows()>0){
				return $query->result_array();
		}else{
				return false;
		}
		
    }
	
   



}