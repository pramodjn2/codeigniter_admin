<?php
  
  function dd($post){
   echo "<pre>";
   print_r($post);
   die();
  }

/**
*	Genrate rand number
**/	
function genrateRandNumber(){
	return  random_string('alnum',20);
}

/**
	* User profile image 
**/
function image_check($image,$url){
	/*$filename="$url$image";
	if(!empty($image)){
			if(@getimagesize($filename)){
			  return $url.$image ;
			}else{
			  return $url.'default.png';
			}
	}else{
	   return $url.'default.png';
	}*/
	
	
	$imageName = $image;
	$imagePath = $url;
	if($imageName !='' && $imagePath !=''){
			$imagePath =  str_replace(HTTP_HOST,DOCUMENT_ROOT,$imagePath);
			$filePath = trim($imagePath).SEPARATOR.trim($imageName);
			if(@getimagesize($filePath)){
				$filePath =  str_replace(DOCUMENT_ROOT,HTTP_HOST,$filePath);
				return $filePath;
			}else{
				$imagePath =  str_replace(DOCUMENT_ROOT,HTTP_HOST,$imagePath);
				return trim($imagePath).'default.png';
			}
		}
		$imagePath =  str_replace(DOCUMENT_ROOT,HTTP_HOST,$imagePath);
		return trim($imagePath).'default.png';
	
	
}

function safe_b64encode($string) {
 
        $data = base64_encode($string);
        $data = str_replace(array('+','/','='),array('-','_',''),$data);
        return $data;
}
 
function safe_b64decode($string) {
        $data = str_replace(array('-','_'),array('+','/'),$string);
        $mod4 = strlen($data) % 4;
        if ($mod4) {
            $data .= substr('====', $mod4);
        }
        return base64_decode($data);
}


function encrypt($string, $key='')
{
	$CI = & get_instance();	
	$CI->load->library('encrypt');	 
	$key = (isset($key) && $key !='')? $key : $CI->config->item('encryption_key');
	return $CI->encrypt->encode($string, $key);
	
}
 
function decrypt($string, $key='')
{
	$CI = & get_instance();	
	$CI->load->library('encrypt');	 
	$key = (isset($key) && $key !='')? $key : $CI->config->item('encryption_key');
	return $CI->encrypt->decode($string, $key);		
}
	
/**
* User login check
**/
function check_user_login(){
	$CI = & get_instance();
	$user_id = $CI->session->userdata('user_id');
	if($user_id ==''){
		$CI->session->set_flashdata('warning', USER_SESSION_EXPAIR);
		redirect(base_url('login'), 'refresh');
	}else{
		return $user_id;
	}
}


/**
* reverse geocoding
*/
function reverseGeocoding($address){
  //$address = urlencode($address);
  $request_url = "http://maps.googleapis.com/maps/api/geocode/xml?latlng=".$address."&sensor=true";
  $xml = simplexml_load_file($request_url);
  $status = $xml->status;
  if ($status=="OK") {
      $address = $xml->result->formatted_address;
   
   return $address;
  }
  return true;
}

/** 
* Time stamp to m-d-y convert
*/

function convert_datetime($timestamp,$hms = NULL){
	if(empty($timestamp)){
      return false;
     }
	 if(!empty($hms)){
		return date('M-d-Y',$timestamp); 
	  }
	  return date('M-d-Y H:i:s', $timestamp);  
}

/**
* date time ago 
*/
function ago($timestamp = ''){
 if(empty($timestamp)){
  return false;
 }
 // $difference = time() - strtotime($timestamp);
  $difference = time() - $timestamp;
  $periods = array('second', 'minute', 'hour', 'day', 'week', 'month', 'years', 'decade');
  $lengths = array('60', '60', '24', '7', '4.35', '12', '10');

  for($j = 0; $difference >= $lengths[$j]; $j++) $difference /= $lengths[$j];

  $difference = round($difference);
  if($difference != 1) $periods[$j] .= "s";

  return "$difference $periods[$j] ago";
}

/**
 * Function:	sendEmailCI
 * params:	
 * 				$to			can be string, array or comma saparated value, 
 * 				$from 		array('name'=>'', email=>''), 
 * 				$subject 	string, 
 * 				$body 		string, 
 * 				$attachment array
 */
function send_email($to, $from, $subject = '', $body = '', $attachments = array(), $filePath = ''){
	$CI = & get_instance();
	$CI->load->library('email');
	
	$websetting = $CI->session->userdata('websetting');
	if(!empty($websetting)){
		$site_email = $websetting['site_email']; 
		$site_name =  $websetting['site_name']; 
		
	}
	$CI->email->from($site_email, $site_name);
	$CI->email->to($to);
	$CI->email->subject($subject);
	$CI->email->message($body);	
	
	if(!empty($attachments))
	{
		foreach($attachments as $attachment){
			$file_path = $filePath ? $filePath : config_item('root_url');
			$CI->email->attach($file_path.$attachment);
		}
	}
	
	$result = $CI->email->send();
	if($result){
	  return $result;
	}else{
	 return false; //echo $CI->email->print_debugger();
	}
}

/**
* status get
*/
function status($sel = NULL){
	$arr = array('Active','inActive');
	$option = '';
	foreach($arr as $val){
		$selVal = '';
		if($sel == $val){
		  $selVal = 'selected';	
		}	
		$option .= '<option value="'.$val.'" '.$selVal.' >'.ucfirst($val).'</option>';
	}
return $option;	
}


/**
* status get
*/
function isFeatures($sel = NULL){
	$arr = array('No','Yes');
	$option = '';
	foreach($arr as $val){
		$selVal = '';
		if($sel == $val){
		  $selVal = 'selected';	
		}	
		$option .= '<option value="'.$val.'" '.$selVal.' >'.ucfirst($val).'</option>';
	}
return $option;	
}


/**
* select  box option
*/
function select_grid($tableName, $column, $sel = NULL){
	$CI = & get_instance();
	$CI->db->select('*');
	$CI->db->from($tableName);
	//$CI->db->where('u.user_id', $user_id); 
	$query = $CI->db->get();
	$option = '';
	if($query->num_rows()>0){
	 $result =  $query->result_array();
		foreach($result as $val){
			$selVal = '';
			if($sel == $val['id']){
			  $selVal = 'selected';	
			}	
			$option .= '<option value="'.$val['id'].'" '.$selVal.' >'.ucfirst($val[$column]).'</option>';
		}
	}
return $option;	
}

/**
* Create A URL Slug
*/
function create_url_slug($string)
{
   $slug=preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
   return $slug;
}

/**
* get notification
*/
function get_notification()
{
	
	$CI = & get_instance();
	$user_id = $CI->session->userdata('user_id');
	
	$CI->db->select('n.*,CONCAT(u.first_name, " ",u.last_name) as sender_name');
	$CI->db->from('notification as n');
	$CI->db->join('user u', 'u.id = n.sender_id', 'LEFT');
	$CI->db->where('n.reciver_id', $user_id); 
	$CI->db->where('n.read_status', '0');
	$CI->db->order_by("n.id","DESC");
	
	
	$query = $CI->db->get();
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
* login attempts insert
*/
function login_attempts($user_id)
{
	$CI = & get_instance();
	$data = array('user_id' => $user_id,
	 				'ip_address' => $_SERVER['REMOTE_ADDR'],
					'login_dt' => time(),
	 				);
	$CI->db->insert('user_login_attempts', $data); 
	return true;
}

	/**
	*  get children comment
	*/
  
   function get_children_comment($parent_id)
   {
	   $CI = & get_instance();
	   $CI->db->select('u.picture_url, CONCAT(u.first_name, " ",u.last_name) as sender_name,c.*,
	                      (SELECT COUNT(l.id) from article_comment_like as l where c.id = l.comment_id and likes="1"  GROUP BY l.comment_id) as likes');
	   $CI->db->from('article_comment c');
	   $CI->db->join('user u', 'c.user_id = u.id', 'LEFT'); 
	   $CI->db->where('c.parent_id = '. $parent_id);
  
		$query = $CI->db->get();
		if($query->num_rows()>0)
		{
			return  $query->result_array();
		}
		else
		{ 
		  return false;
	    }		
  }
  
  	/* select query */
	function select($table, $where ='',$coloumn = '*')
	{
		$CI = & get_instance();
	    $sql = "SELECT $coloumn FROM $table";
		if(!empty($where))
		{
		   $sql .= " $where";
		}
		$query = $CI->db->query($sql);
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
* seo friendly url
*/
function seo_friendly_urls($name,$id = NULL)
{ 
    $text = '';
    if(!empty($name))
    {
	  $text .= $name;
	}
	 
  // replace non letter or digits by -
  $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
  // trim
  $text = trim($text, '-');
  // transliterate
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
  // lowercase
  $text = strtolower($text);
  // remove unwanted characters
  $text = preg_replace('~[^-\w]+~', '', $text);
  if (empty($text))
  {
    return FALSE;
  }
  
  if(!empty($id))
  {
	  $encode_id = safe_b64encode($id);
	  $encode = $encode_id.'/'.$text;
  }
  else
  {
	  $encode = $text;
  }
  return $encode;
}


 function menu($category_id)
 {
    $CI = & get_instance();
	$CI->db->select('p.*,c.cat_title',false);
	
	$CI->db->from('manage_menu_order o');
	$CI->db->join('manage_static_pages p', 'p.id = o.page_id`', 'LEFT');
	$CI->db->join('manage_static_pages_category c', 'c.id = o.category_id', 'LEFT');
	//$CI->db->where('u.status', 'Active');
	
	$CI->db->where('o.category_id', $category_id);
	$query = $CI->db->get();
	if($query->num_rows()>0)
	{
		return $query->result_array();
	}
	else
	{
		return false;
	}
 }

?>