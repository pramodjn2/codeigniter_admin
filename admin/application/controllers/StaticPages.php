<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StaticPages extends CI_Controller {

	var $user_id = '';
    public function __construct() {
    	parent::__construct();
    	check_user_login();
		
		$this->load->helper(array());
		$this->load->library(array('form_validation'));
		$this->load->model(array('staticPageModel'));
		$this->user_id = $this->session->userdata('user_id');
		//$this->output->enable_profiler(TRUE);	
    }


  public function index()
	{
     $data['title'] = 'Static Page'; 
	 $data['result'] = $this->staticPageModel->page_info(); 
	 $this->load->view('static_page/spage',$data);
	}

/**
* Add New websetting
*/    
public function addspage()
{
	$data['title'] = 'Add New Page';
	$post = $this->input->post();
	if($post){
		
		$data = array('user_id' => $this->user_id,
					  'page_title' => $post['name'],
					  'page_slug' => slug_create($post['name']),
					  'page_content' => $post['message'],
					  'static_templates' => $post['static_templates'],
					  'meta_title' => $post['meta_title'],
					  'meta_keywords' => $post['meta_keywords'],
					  'meta_description' => $post['meta_description'],
					  'status' => $post['status'],
					  'create_dt' => time()
					 );
		$this->Common->insert('manage_static_pages', $data);
     	$this->session->set_flashdata('success', INSERT_SUCCESS_MSG);
		redirect('staticPages');
	}
	$this->load->view('static_page/spage_add',$data);	
}
/**
* Edit websetting
*/
public function editspage()
{
	$id = $this->uri->segment(3);
	$data['id'] = $id;
	$id = safe_b64decode($id);
	$data['title'] = 'Edit Page';
	$post = $this->input->post();

	if($post && !empty($post))
	{
	 
		$data = array('user_id' => $this->user_id,
			  'page_title' => $post['name'],
			  'page_slug' => slug_create($post['name']),
			  'page_content' => $post['message'],
			  'static_templates' => $post['static_templates'],
			  'meta_title' => $post['meta_title'],
			  'meta_keywords' => $post['meta_keywords'],
			  'meta_description' => $post['meta_description'], 
			  'status' => $post['status'],
			  'update_dt' => time()
		);
		$where = array('id' => $id);
		if($this->Common->update('manage_static_pages', $data, $where))
		{
			$this->session->set_flashdata('success', UPDATE_SUCCESS_MSG);
			redirect('staticPages');
		}
		else
		{
			$this->session->set_flashdata('error', 'Updation failed.');
		}
	}
	$data['result'] = $this->staticPageModel->page_info($id);
	$this->load->view('static_page/spage_edit', $data);
}

	
/*********************************************** carousel slider*********************************************
*
*/
	
	public function slider()
	{
		 $data['title'] = 'Carousel Images List'; 
		 $data['result'] = $this->Common->select('manage_carousel_slider'); 
		 $this->load->view('slider/slider',$data);
	}
	
	/**
	* Add New slider
	*/    
    public function addSlider(){
		$data['title'] = 'Add Carousel Image'; 
		$success = '';
		$data['message'] = '';
		$upload_file_name = '';
		$post = $this->input->post();

    	if($post && !empty($post)){
    		
    		$target_dir = DOCUMENT_ROOT."media/slider/";
		    $responce = $this->Common->imageUpload($_FILES['img'],$target_dir);
			
			$success = $responce['success'];
			$data['message'] = $responce['message'];
			$upload_file_name = $responce['name'];
			
			if($success == 1)
			{
				$data = array('position' => $post['position'],
							  'title' => $post['title'],
							  'description' => $post['description'],
							  'img_name' => $upload_file_name,
							  'status' => $post['status'],
							  'create_dt' => time()
							 );
	    		$this->Common->insert('manage_carousel_slider', $data);
	         	$this->session->set_flashdata('success', INSERT_SUCCESS_MSG);
				redirect('staticPages/slider');
			}
		}
    	$this->load->view('slider/slider_add',$data);	
    }
	
	/**
	* Edit slider
	*/    
    public function editSlider()
    {
		$id = $this->uri->segment(3);
    	$data['id'] = $id;
    	$id = safe_b64decode($id);
		$data['title'] = 'Edit Carousel Image'; 
		$success = '';
		$data['message'] = '';
		$upload_file_name = '';
		$target_dir = DOCUMENT_ROOT."media/slider/";
		$post = $this->input->post();		
		   	
    	if($post && !empty($post))
    	{
    		
			if(!empty($_FILES['img']['name']))
			{
				$responce = $this->Common->imageUpload($_FILES['img'],$target_dir);
				$success = $responce['success'];
				$data['message'] = $responce['message'];
				$upload_file_name = $responce['name'];
			}
			else
			{
				$success = 1;
			}
			
			if($success == 1)
			{
					$data = array('position' => $post['position'],
						  'title' => $post['title'],
						  'description' => $post['description'],  
						  'status' => $post['status'],
						  'update_dt' => time()
					);
						 
					if(!empty($upload_file_name))
					{
						$where = "where id = $id";
						$uploadResult = $this->Common->select('manage_carousel_slider', $where);
						if(!empty($uploadResult))
						{
						 $old_upload_file_name = $uploadResult[0]['img_name'];
							  @unlink($target_dir.$old_upload_file_name);
						}
				
						$image_upload = array('img_name' => $upload_file_name);	
						$data = array_merge($data, $image_upload);
					}
						 
				    $where = array('id' => $id);
					$this->Common->update('manage_carousel_slider', $data, $where);
			
		    		$this->session->set_flashdata('success', UPDATE_SUCCESS_MSG);
					redirect('staticPages/slider');
			}
		}
		
		$where = "where id = $id";
		$data['result'] = $this->Common->select('manage_carousel_slider', $where); 
    	$this->load->view('slider/slider_edit',$data);	
    }
	
	/*********************************************** Menu Magement *********************************************
	*
	*/
	
	
	public function menu()
	{
		 $data['title'] = 'Menu Magement'; 
		 $data['result'] = $this->Common->select('manage_static_pages_category'); 
		 $this->load->view('menu/menu',$data);
	}
	
	/**
	* Edit slider
	*/    
    public function editMenu(){
	
		$id = $this->uri->segment(3);
    	$data['id'] = $id;
    	$id = safe_b64decode($id);
		$data['category_id'] = $id;
		$data['title'] = 'Menu Magement';  
		
				
		$data['menu_result'] = $this->staticPageModel->menu_order($id); 
		$page_id = '';
		if(!empty($data['menu_result']))
		{
			foreach($data['menu_result'] as $key)
			{
				$page_id .= $key['page_id'].',';
			}
			$page_id = substr($page_id, 0, -1);
		}
		
		$where = "where status = 'Active'";
		$data['result'] = $this->staticPageModel->menu_not_in_page($page_id); 
		
		$this->load->view('menu/menu_edit',$data);	
    }
	
	/**
	* save menu order
	*/
	public function saveMenyOrder()
	{
		$post = $this->input->post();
		if($post && !empty($post))
		{
			$order = $post['order'];
			$category_id = $post['category_id'];
		
			$order = @explode(',', trim($order));
			$i = 1;
			if($order)
			{
				$this->Common->delete('manage_menu_order',$category_id,'category_id');
				$menu_data = array();
				foreach($order as $key)
				{
				    $menu_data[] = array('page_id' => $key,
										  'category_id' => $category_id,
										  'create_dt' => time(),
										  'menu_order' => $i);
				     $i++;
				}
				$this->db->insert_batch('manage_menu_order', $menu_data);
			}
		}
	}
}