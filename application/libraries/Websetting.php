<?php 
/**
Users Online class *
Manages active users *
@package CodeIgniter
@subpackage Libraries
@category Add-Ons
@author Leonardo Monteiro Bersan de Araujo
@link hhttp://codeigniter.com/wiki/Library: Online_Users */ 

class Websetting { 
	public $data, $CI;
	function Websetting(){
		$CI =& get_instance();
		$this->CI = $CI;
		$class_session_loaded='';
		//Loads the USER_AGENT class if it's not loaded yet 
		if(!isset($this->CI->session)) { 
			$this->CI->load->library('session');
			$class_session_loaded = true; 
		}				
		$websetting = $this->CI->session->userdata('websetting');
		$this->data = $this->getDataFromDB();
			$this->CI->session->set_userdata(array('websetting' => $this->data));
		if(!isset($websetting) && count($websetting) < 1){			
			$this->data = $this->getDataFromDB();
			$this->CI->session->set_userdata(array('websetting' => $this->data));
		}else{
			$this->data = $this->CI->session->userdata('websetting');
		}
		/*$this->data = $this->getDataFromDB();
			$this->CI->session->set_userdata(array('websetting' => $this->data));*/
		
		if($class_session_loaded){ 
			unset($class_session_loaded, $this->CI->session); 
		}
	}
	
	function getDataFromDB(){
		$class_db_loaded='';
		//Loads the USER_AGENT class if it's not loaded yet 
		if(!isset($this->CI->db)) { 
			$this->CI->load->database;
			$class_db_loaded = true; 
		}
		
		$this->CI->db->where('status', 'Active');
		$result = $this->CI->db->get('manage_website_setting');
		$dataResult = array();
		foreach($result->result_array() as $value){
			$dataResult = array_merge($dataResult , array($value['setting_name'] => $value['setting_value']));
		}
		
		if($class_db_loaded){ 
			unset($class_db_loaded, $this->CI->db); 
		}
				
		return $dataResult;
	}
	
	function getSetting($setting_name = ''){
		$this->data = $this->CI->session->userdata('websetting');
		if(isset($setting_name) && $setting_name !=''){
			return $this->data[$setting_name];
		}else{
			return $this->data;
		}
	}
	function unsetSetting(){
		$this->CI->session->unset_userdata('websetting');
	}
			
}