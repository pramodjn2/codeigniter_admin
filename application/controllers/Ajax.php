<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {

	var $user_id = '';
    public function __construct() {
    	parent::__construct();
     	$this->load->helper(array());
		$this->user_id = $this->session->userdata('user_id');
	    //$this->output->enable_profiler(TRUE);	
        
	}
	
   /**
   * article comment like count get article_comment_like
   */
	public function like_count($table_name, $comment_id = 0 )
	{
		if( $comment_id == 0 ) return false;
		$where = "WHERE comment_id = '" . (int)$comment_id . "'";
		return $result = $this->Common->count($table_name, $where);
	}

   /**
   * article comment like and unlike 
   */
   public function comment_like()
   {

		$user_id = $this->session->userdata('user_id');
		$user_id = 1;
		$comment_id = $this->input->post('comment_id',TRUE);
		if(!empty($user_id)){
			$where = "WHERE user_id = '".$user_id."' && comment_id = '".$comment_id."'";
			$result = $this->Common->select('article_comment_like',$where);
			if(empty($result)){
			
				$data = array('comment_id' => $comment_id, 'user_id' => $user_id, 'likes' => '1','create_dt' => time());	  
				$this->Common->insert('article_comment_like',$data);
			
				$totalLikes = $this->like_count('article_comment_like',$comment_id); 
				$msg = array("message" => "Thank you for voting.", "class" => "alert alert-success","totalLikes"=>$totalLikes, "success" => 1, "error" => 0, "action" => "LIKE_SUBMITTED");
				
			} else {
				
				$this->db->delete('article_comment_like', array('comment_id'=>$comment_id,'user_id'=>$user_id)); 	
				$totalLikes = $this->like_count('article_comment_like',$comment_id);  
				$msg = array("message" => "Thank you. Your like has been removed successfully.", "class" => "alert alert-warning","totalLikes"=>$totalLikes, "success" => 1, "error" => 0, "action" => "LIKE_REMOVED");
			} 
		} else {
			$msg = array( "message" => "Sorry. You need to login first.", "class" => "alert alert-danger", "totalLikes"=>'', "success" => 0, "error" => 1, "action" => "FAILED_LOGIN_REQUIRED" ); 
		}
		echo json_encode($msg);
		die;
	}
	
   /** 
   * comment post
   */
   function comment_post()
   {
	
		$user_id = $this->session->userdata('user_id');
		$user_id = 1;
		$parent_id = 0;
		$article_id = $this->input->post('article_id',TRUE);
		$comment_id = $this->input->post('comment_id',TRUE);
		$comment_id = $comment_id ? $comment_id : 0;
		$comment = $this->input->post('comment',TRUE);

		$data = array('user_id' => $user_id, 'article_id' => $article_id, 'parent_id' => $comment_id, 'comment' => $comment, 'create_dt' => time());	  
		$id = $this->Common->insert('article_comment',$data);

		 $this->load->model(array('articleModel'));
		 $data['result'] = $this->articleModel->article_comment($article_id,' ',$id);

		 $user_img = image_check($data['result'][0]['picture_url'],USER_IMAGE);
		 	
		$str= "";
		$str .= '<li id="comments_'.$data['result'][0]['id'].'">';
		$str .= '<div class="comment-avatar"><img src="'.$user_img.'" alt="'.ucwords($data['result'][0]['created_dt']).'"></div>';
		$str .= '<div class="comment-box">';
		$str .= '<div class="comment-head">';
		$str .= '<h6 class="comment-name"><a href="http://creaticode.com/blog">'.ucwords($data['result'][0]['created_dt']).'</a></h6>';
		$str .= '<span>'.ago($data['result'][0]['created_dt']).'</span>';
		$str .= '<i class="fa fa-reply"></i>';
		$str .= '<i id="heart_'.$data['result'][0]['id'].'" class="fa fa-heart" title="0 user likes" onClick="article_likes('.$data['result'][0]['id'].');">';
		$str .= '<p id="like_count_'.$data['result'][0]['id'].'"></p></i>';
		$str .= '</div>';
		$str .= '<div class="comment-content">';
		$str .=  $data['result'][0]['comment'];
		$str .= '</div>';
		$str .= '</div>';
		$str .= '</li>';  
		echo $str;
		return $str; 
	} 



  /**
   * article like and unlike 
   */
   public function article_like()
   {

		$user_id = $this->session->userdata('user_id');
		$user_id = 1;
		$article_id = $this->input->post('article_id',TRUE);
		if(!empty($user_id)){
			$where = "WHERE user_id = '".$user_id."' && article_id = '".$article_id."'";
			$result = $this->Common->select('article_like',$where);
			if(empty($result)){
			
				$data = array('article_id' => $article_id, 'user_id' => $user_id, 'likes' => '1','create_dt' => time());	  
				$this->Common->insert('article_like',$data);
			
				//$totalLikes = $this->like_count('article_like',$article_id); 
				$where = " where article_id = $article_id";
				$totalLikes = $this->Common->count('article_like',$where);
				$msg = array("message" => "Thank you for voting.", "class" => "alert alert-success","totalLikes"=>$totalLikes, "success" => 1, "error" => 0, "action" => "LIKE_SUBMITTED");
				
			} else {
				
				$this->db->delete('article_like', array('article_id'=>$article_id,'user_id'=>$user_id)); 	
				//$totalLikes = $this->like_count('article_like',$article_id);  
				
				$where = " where article_id = $article_id";
				$totalLikes = $this->Common->count('article_like',$where);
				
				$msg = array("message" => "Thank you. Your like has been removed successfully.", "class" => "alert alert-warning","totalLikes"=>$totalLikes, "success" => 1, "error" => 0, "action" => "LIKE_REMOVED");
			} 
		} else {
			$msg = array( "message" => "Sorry. You need to login first.", "class" => "alert alert-danger", "totalLikes"=>'', "success" => 0, "error" => 1, "action" => "FAILED_LOGIN_REQUIRED" ); 
		}
		echo json_encode($msg);
		die;
	}
	
	
	

   
  /**
   * article share
   */
	public function article_share()
	{
		$article_id = $this->input->post('article_id',TRUE);
		if(empty($article_id)){ return false; }
		$this->load->model(array('articleModel'));
		
		$data['result'] = $this->articleModel->article($article_id);
		if(!empty($data['result'])){
		 
		 foreach($data['result'] as $key){
			   $article_img = image_check($key['article_img'],ARTICLE);
			   $article_seo_url = seo_friendly_urls($key['article_title'],$key['id']);
				
			  $result = array('success' => 1,
			  				  'id' => $key['id'],
			  				  'title' => urlencode($key['cat_title']),
							  'summary' => urlencode(substr(trim($key['article_title']).' - '.trim($key['article_content']),0,50)),
							  'url' =>  base_url('article/detail/'.$article_seo_url),
							  'image' => $article_img
							  );
		   }
		}else{
		    $result = array('success' => 0);	
		}
		echo $msg = json_encode($result); 
		die;
	}

	
}