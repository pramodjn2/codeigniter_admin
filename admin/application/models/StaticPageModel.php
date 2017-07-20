<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class StaticPageModel extends CI_Model {


   /**
   * static pages infomation get 
   */
    function page_info($id = NULL){

	$this->db->select('p.*',false);
	$this->db->from('manage_static_pages p');
	//$this->db->where('u.status', 'Active');
	
	if(!empty($id)){
		$this->db->where('p.id', $id); 
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
	
	
   /**
   * Manage Menu Order 
   */
    function menu_order($id = NULL){

	$this->db->select('m.*,p.page_title',false);
	$this->db->from('manage_menu_order m');
	$this->db->join('manage_static_pages p', 'p.id = m.page_id', 'LEFT');
	
	if(!empty($id)){
		$this->db->where('m.category_id', $id); 
	}
	$query = $this->db->get();	
		if($query->num_rows()>0){
				return $query->result_array();
		}else{
				return false;
		}
   }
   
   /**
   * Not In Page
   */
   
   function menu_not_in_page($id){
	   if(!empty($id)){
		 $sql = "SELECT * FROM manage_static_pages WHERE id NOT IN ($id)";
	   }else{
		 $sql = "SELECT * FROM manage_static_pages";   
		}
	  
	   $query = $this->db->query($sql);
        if($query->num_rows()>0){
            return $query->result_array();
        }else{
            return false;
        }
    
	}

}