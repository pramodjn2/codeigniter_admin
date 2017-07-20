<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Article extends CI_Controller
{
	var $user_id = '';
    public function __construct() {
        parent::__construct();
        // Load user model
       $this->load->model(array('articleModel','user'));
		$this->user_id = $this->session->userdata('user_id');
		//$this->output->enable_profiler(TRUE);	
     }
    
	
	/**
	* article grid
	*/
	public function index(){
	   echo 'article';
	}
	
	/**
	* Article details
	*/
	public function detail(){
	   $id = $this->uri->segment(3);
		$data['id'] = $id;
		$id = safe_b64decode($id); 	
         
	   $data['result'] = $this->articleModel->article($id);
	    
		$data['og_title'] = $data['result'][0]['article_title'];
		$data['og_description'] = $data['result'][0]['article_content'];
		$data['og_image'] =  image_check($data['result'][0]['meta_title'],ARTICLE);
		
		$data['title'] = $data['result'][0]['meta_title'];
		$data['keywords'] = $data['result'][0]['meta_keywords'];
		$data['description'] = $data['result'][0]['meta_description'];
		
		
	  
	   $this->load->view('article/article_details',$data);
	}
	
	/**
	* article category
	*/
	public function category(){
		$id = $this->uri->segment(3);
		$data['id'] = $id;
		$id = safe_b64decode($id); 	
		
		$data['javascript'] = array('assets/js/custom/article.js');
		$data['category'] = $this->articleModel->category($id);
		
		$data['article'] = $this->articleModel->article_category_according($id);
		//dd($data['article']);
		
	   $this->load->view('article/article_category',$data);
	}
	
	
	
 
}