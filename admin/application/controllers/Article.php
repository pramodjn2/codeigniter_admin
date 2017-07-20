<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends CI_Controller {

	var $user_id = '';
    public function __construct() {
    	parent::__construct();
    	check_user_login();
		
		$this->load->helper(array());
		$this->load->library(array('form_validation'));
		$this->load->model(array('articleModel'));
		$this->user_id = $this->session->userdata('user_id');
	    //$this->output->enable_profiler(TRUE);	
        
	}

   /**
   * Article grid
   */
	public function index()
	{ 
	   $data['title'] = 'Article';
       $data['articleResult'] = $this->articleModel->article();
	   $this->load->view('article/article',$data);
	}
    
	/**
	* image upload
	*/
	
	/*
	
    [img] => Array
        (
            [name] => rescue.png
            [type] => image/png
            [tmp_name] => E:\xampp\tmp\phpDD06.tmp
            [error] => 0
            [size] => 219177
        )

	*/
	public function imageUpload($files, $upload_type){
		$target_dir = DOCUMENT_ROOT."media/article/";
		$target_file = $target_dir . basename($files["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		
		
		// Allow certain file formats
		if($upload_type == 'image'){
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
				return $msg = array('success' => 0, 'message' => 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.', 'name' => '');
				$uploadOk = 0;
			}
		}
		
		if($upload_type == 'video'){
			if($imageFileType != "webm" && $imageFileType != "mp4" && $imageFileType != "ogv" ) {
				return $msg = array('success' => 0, 'message' => 'Sorry, only webm, mp4 & ogv files are allowed.', 'name' => '');
				$uploadOk = 0;
			}
		}
		
		if($upload_type == 'audio'){
			if($imageFileType != "mpeg" && $imageFileType != "x-mpeg" && $imageFileType != "mp3" && $imageFileType != "x-mp3" && $imageFileType != "mpeg3" && $imageFileType != "x-mpeg3" && $imageFileType != "mpg" && $imageFileType != "x-mpg" && $imageFileType != "x-mpegaudio" ) {
				return $msg = array('success' => 0, 'message' => 'Sorry, only mpeg, x-mpeg, mp3, mpeg3, mpg & x-mpegaudio files are allowed.', 'name' => '');
				$uploadOk = 0;
			}
		}
		
		$image_name = time().'.'.$imageFileType;
		if (move_uploaded_file($files["tmp_name"], $target_dir.$image_name)) {
			$msg = array('success' => 1, 'message' => 'The file has been uploaded.', 'name' => $image_name);
		} else {
			$msg = array('success' => 0, 'message' => 'Sorry, there was an error uploading your file.', 'name' => '');
		}
		return $msg;
	} 

	/**
	* Add new article
	*/
	 public function addArticle(){
		
		$data['title'] = 'Add new article';
		$data['stylesheet'] = array('assets/vendors/bootstrap-datepicker/css/bootstrap-datepicker3.min.css');
		$data['javascript'] = array('assets/vendors/bootstrap-datepicker/js/bootstrap-datepicker.min.js');
		
		
		$success = '';
		$data['message'] = '';
		$upload_file_name = '';
		$target_dir = DOCUMENT_ROOT."media/article/";			
		
		 if($_POST){
			$post = $this->input->post();
			$timestamp = time();
		     if(!empty($post['published_date'])){
			 	$timestamp = strtotime($post['published_date']);
			 }
			 
			 
			
			
			
			if(!empty($post['upload_type'])){
				
					$responce = $this->imageUpload($_FILES['img'],$post['upload_type']);
					
					$success = $responce['success'];
					$data['message'] = $responce['message'];
					$upload_file_name = $responce['name'];
					
			}else{
				$success = 1;	
			}
			
			if($success == 1){
			$data = array('user_id' => $this->user_id,
			              'category_id' => $post['category_id'],
						  'article_title' => $post['article_title'],
						  'article_content' => $post['article_description'],
						  'isFeatures' => $post['isFeatures'],
						  'meta_title' => $post['meta_title'],
						  'meta_keywords' => $post['meta_keywords'],
						  'meta_description' => $post['meta_description'], 
						  'banner_display_mode' => $post['banner_display_mode'], 
						  'published_on' => $timestamp, 
						  'status' => $post['status'],
						  'create_dt' => time()
						 );
						 
			
			if(!empty($_FILES['article_img']['name'])){
				$responce_img = $this->Common->imageUpload($_FILES['article_img'],$target_dir);
				
				$upload_image_name = $responce_img['name'];
				
				$image_upload = array('article_img' => $upload_image_name);	
			    $data = array_merge($data, $image_upload);
			
			}
			
			
			/* article banner image upload */
			if(!empty($_FILES['banner_img']['name'])){
				$responce_img = $this->Common->imageUpload($_FILES['banner_img'],$target_dir);
				$upload_image_name = $responce_img['name'];
				
				$image_upload = array('banner_img' => $upload_image_name);	
			    $data = array_merge($data, $image_upload);
			
			}
			
			
			
			$article_id = $this->Common->insert('article', $data);
			if(!empty($upload_file_name)){
				
				$data = array('article_id' => $article_id,
			              'file_name' => $upload_file_name,
						  'file_type' => $post['upload_type'],
						  );
    		    $this->Common->insert('article_upload', $data);
			   	
			}
			
			$this->session->set_flashdata('success', INSERT_SUCCESS_MSG);
			redirect('Article');
			}
		}
    	$this->load->view('article/article_add',$data);	
    }
	
	
	/**
	* Edit article
	*/
	 public function editArticle(){
		
		$id = $this->uri->segment(3);
		$data['id'] = $id;
		$id = safe_b64decode($id); 
		$target_dir = DOCUMENT_ROOT."media/article/";			
		
		
		$data['title'] = 'Edit article';
		$data['stylesheet'] = array('assets/vendors/bootstrap-datepicker/css/bootstrap-datepicker3.min.css');
		$data['javascript'] = array('assets/vendors/bootstrap-datepicker/js/bootstrap-datepicker.min.js');
		
		$success = '';
		$data['message'] = '';
		$upload_file_name = '';
		
		 if($_POST){
		
			$post = $this->input->post();
			$timestamp = time();
		     if(!empty($post['published_date'])){
			 	$timestamp = strtotime($post['published_date']);
			 }
			
			
			if(!empty($post['upload_type'])){
				
					$responce = $this->imageUpload($_FILES['img'],$post['upload_type']);
					$success = $responce['success'];
					$data['message'] = $responce['message'];
					$upload_file_name = $responce['name'];
					
			}else{
				$success = 1;	
			}
			
			if($success == 1){
			$data = array('user_id' => $this->user_id,
			              'category_id' => $post['category_id'],
						  'article_title' => $post['article_title'],
						  'article_content' => $post['article_description'],
						  'isFeatures' => $post['isFeatures'],
						  'meta_title' => $post['meta_title'],
						  'meta_keywords' => $post['meta_keywords'],
						  'meta_description' => $post['meta_description'], 
						  'banner_display_mode' => $post['banner_display_mode'], 
						  'published_on' => $timestamp, 
						  'status' => $post['status'],
						  'update_dt' => time()
						 );
    		
			
			if(!empty($_FILES['article_img']['name'])){
				$responce_img = $this->Common->imageUpload($_FILES['article_img'],$target_dir);
				$upload_image_name = $responce_img['name'];
				
				
				$where = "where id = $id";
				$uploadResult = $this->Common->select('article', $where);
				if(!empty($uploadResult)){
				 $old_upload_file_name = $uploadResult[0]['article_img'];
					  @unlink($target_dir.$old_upload_file_name);
				}
				
				
				$image_upload = array('article_img' => $upload_image_name);	
			    $data = array_merge($data, $image_upload);
			
			}
			
			
			/* article banner image upload */
			if(!empty($_FILES['banner_img']['name'])){
				$responce_img = $this->Common->imageUpload($_FILES['banner_img'],$target_dir);
				$upload_image_name = $responce_img['name'];
				
				
				$where = "where id = $id";
				$uploadResult = $this->Common->select('article', $where);
				if(!empty($uploadResult)){
				 $old_upload_file_name = $uploadResult[0]['banner_img'];
					  @unlink($target_dir.$old_upload_file_name);
				}
				
				
				$image_upload = array('banner_img' => $upload_image_name);	
			    $data = array_merge($data, $image_upload);
			
			}
			
			
			
			$where = array('id' => $id);
    		$this->Common->update('article', $data, $where);
			
			
			if(!empty($upload_file_name)){
				
				$where = " where article_id = $id";
				$uploadResult = $this->Common->select('article_upload', $where);
				if(!empty($uploadResult)){
				 $old_upload_file_name = $uploadResult[0]['file_name'];
				 $target_dir = DOCUMENT_ROOT."media/article/";
				  @unlink($target_dir.$old_upload_file_name);
				}
				
				$this->Common->delete('article_upload', $id);
				$data = array('article_id' => $id,
			              'file_name' => $upload_file_name,
						  'file_type' => $post['upload_type'],
						  );
    		    $this->Common->insert('article_upload', $data);
			   	
			}
			
			$this->session->set_flashdata('success', UPDATE_SUCCESS_MSG);
			redirect('article');
			}
		}
		$data['articleResult'] = $this->articleModel->article($id);
		$this->load->view('article/article_edit',$data);	
    }
	
	
	
	/************************************************************** category module ***************************************
	* category grid
	*/
	public function category(){
    	$data['title'] = 'Article Category';
		$data['catResult'] = $this->articleModel->category();
    	$this->load->view('article/category',$data);
   	}
	
	/**
	* Add new category
	*/
	 public function addCategory(){
		$data['title'] = 'Add new category';
		if($_POST){
    		$post = $this->input->post();
			$data = array('title' => $post['cat_title'],
						  'description' => $post['cat_description'],
						  'status' => $post['status'],
						  'create_dt' => time()
						 );
    		$this->Common->insert('article_category', $data);
			$this->session->set_flashdata('success', INSERT_SUCCESS_MSG);
			redirect('article/category');
		}
    	$this->load->view('article/category_add',$data);	
    }
	
	
	
	/**
	* Edit category
	*/
	 public function editCategory(){
		$id = $this->uri->segment(3);
		$data['id'] = $id;
		$id = safe_b64decode($id);
		$data['title'] = 'Edit category';
		$post = $this->input->post();
		if($post && !empty($post)){
    		
    		$data = array('title' => $post['cat_title'],
						  'description' => $post['cat_description'],
						  'status' => $post['status'],
						  'update_dt' => time()
						 );
			
			$where = array('id' => $id);
    		$this->Common->update('article_category', $data, $where);
			$this->session->set_flashdata('success', UPDATE_SUCCESS_MSG);
			redirect('article/category');
    	}
		$data['catResult'] = $this->articleModel->category($id);
		$this->load->view('article/category_edit',$data);	
    }
}