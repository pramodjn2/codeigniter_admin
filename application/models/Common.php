<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common extends CI_Model {


  	/* updating data in datebase */
  	public function update($table,$data,$where)
	{
		if(is_array($where))
		{
			foreach ($where as $key => $value)
			{
				$this->db->where($key, $value);
			}
		}
		$this->db->update($table, $this->db->escape_str($data));
		return true;
	}

	/* insert data in datebase */
	public function insert($table,$data)
	{
		$query = $this->db->insert($table, $data);
		$id = $this->db->insert_id();
		return $id;
	}

	/* delete data in datebase */
	public function delete($table,$id,$col = 'id')
	{
		$this->db->where($col, $id);
		$query = $this->db->delete($table); 
		return $query;
	}


	/* select query */
    function select($table, $where ='',$coloumn = '*')
    {
        $sql = "SELECT $coloumn FROM $table";
		if(!empty($where))
		{
		   $sql .= " $where";
		}
		$query = $this->db->query($sql);
        if($query->num_rows()>0)
        {
			return $query->result_array();
        }
        else
        {
            return false;
        }
    }
    
   /* count */
   function count($table, $where ='')
   {
        $sql = "SELECT COUNT(*) FROM $table";
		if(!empty($where))
		{
		   $sql .= " $where";
		}
		$query = $this->db->query($sql);
		if($query->num_rows()> 0)
		{
			return (int)$query->row(0)->{'COUNT(*)'};	
        }
        else
        {
            return 0;
        }
    }
	
   /* user infomation and  user contact infomation get */
    function userContactInfomation($userId)
    {

		$this->db->select('*',false);
		$this->db->from('user u');
		$this->db->where('u.status', 'Active');
		$this->db->where('u.id', $userId); 
		$query = $this->db->get();	
	    if($query->num_rows()>0){
	        return $query->result_array();
	    }else{
	        return false;
	    }
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
	public function imageUpload($files, $target_dir){
		$target_file = $target_dir . basename($files["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		
		
		// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
				return $msg = array('success' => 0, 'message' => 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.', 'name' => '');
				$uploadOk = 0;
			}
		
		$image_name = time().mt_rand().'.'.$imageFileType;
		if (move_uploaded_file($files["tmp_name"], $target_dir.$image_name)) {
			$msg = array('success' => 1, 'message' => 'The file has been uploaded.', 'name' => $image_name);
		} else {
			$msg = array('success' => 0, 'message' => 'Sorry, there was an error uploading your file.', 'name' => '');
		}
		return $msg;
	} 




}



