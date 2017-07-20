<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ArticleModel extends CI_Model {


   /**
   * Article infomation get 
   */
    function article($id = NULL, $offset = NULL)
    {

		$this->db->select('a.*,u.first_name,u.last_name,u.picture_url,c.title as cat_title, au.id as article_upload_id,au.file_name,au.file_type,
		(SELECT COUNT(l.id) from article_like as l where a.id = l.article_id and likes="1"  GROUP BY l.article_id) as likes,
		(SELECT COUNT(ac.id) from article_comment as ac where a.id = ac.article_id GROUP BY ac.article_id) as article_comment',false);
		$this->db->from('article a');
		$this->db->join('article_category c', 'c.id = a.category_id', 'LEFT');
		$this->db->join('user u', 'u.id = a.user_id', 'LEFT');
		$this->db->join('article_upload au', 'au.article_id = a.id', 'LEFT');
		
		
		$today_date = strtotime(date('M-d-Y H:i:s'));
		$this->db->where('a.published_on <=', $today_date);
		$this->db->where('a.status', 'Active');
		$this->db->order_by("a.published_on","DESC");
		
		if(!empty($id))
		{
			$this->db->where('a.id', $id); 
		}
		
		$this->db->limit(5);  
		
		$query = $this->db->get();	
		if($query->num_rows()>0)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
		
    }


   /**
   * Article get category according 
   */
    function article_category_according($category_id = NULL, $offset = NULL)
    {

		$this->db->select('a.*,u.first_name,u.last_name,u.picture_url,c.title as cat_title, au.id as article_upload_id,au.file_name,au.file_type,
		(SELECT COUNT(l.id) from article_like as l where a.id = l.article_id and likes="1"  GROUP BY l.article_id) as likes,
		(SELECT COUNT(ac.id) from article_comment as ac where a.id = ac.article_id GROUP BY ac.article_id) as article_comment',false);
		$this->db->from('article a');
		$this->db->join('article_category c', 'c.id = a.category_id', 'LEFT');
		$this->db->join('user u', 'u.id = a.user_id', 'LEFT');
		$this->db->join('article_upload au', 'au.article_id = a.id', 'LEFT');
		
		
		$today_date = strtotime(date('M-d-Y H:i:s'));
		$this->db->where('a.published_on <=', $today_date);
		$this->db->where('a.status', 'Active');
		$this->db->order_by("a.published_on","DESC");
		
		if(!empty($category_id))
		{
			$this->db->where('a.category_id', $category_id); 
		}
		
		//$this->db->limit(5);  
		
		$query = $this->db->get();	
		if($query->num_rows()>0)
		{
			return $query->result_array();
		}
		else
		{
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
	
  
  /**
	*  Article comment
	*/
	public function article_comment($article_id, $parent_id = 0, $id = NULL){
		
   $this->db->select('u.picture_url, CONCAT(u.first_name, " ",u.last_name) as sender_name,c.*,
                      (SELECT COUNT(l.id) from article_comment_like as l where c.id = l.comment_id and likes="1"  GROUP BY l.comment_id) as likes');
   $this->db->from('article_comment c');
   $this->db->join('user u', 'c.user_id = u.id', 'LEFT'); 
   
   if($parent_id === 0){
   $this->db->where('c.parent_id', $parent_id);
   }
   
   $this->db->where('c.article_id', $article_id);
   
   if(!empty($id)){
	$this->db->where('c.id', $id);   
   }
   $this->db->order_by("c.id", "DESC");
  
    $query = $this->db->get();
	   if($query->num_rows()>0){
		return  $query->result_array();
	   }else{ 
		  return false;
	   }		
  } 



}