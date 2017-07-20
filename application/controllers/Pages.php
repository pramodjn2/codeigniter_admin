<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Pages extends CI_Controller
{
   public function __construct() {
        parent::__construct();
        // Load user model
		$this->load->library('googlemaps');
        }
    
	public function content(){
       $id = $this->uri->segment(3);
		$data['id'] = $id;
		$id = safe_b64decode($id); 
		
		
		$config['center'] = '22.7266802, 75.8842188';
        $config['zoom'] =19;
        $this->googlemaps->initialize($config);

        $marker = array();
        $marker['position'] = '22.7266802, 75.8842188';
        $this->googlemaps->add_marker($marker);
        $data['map'] = $this->googlemaps->create_map();
		
		
		
        $where="where id = ".$id;
		$data['result'] = $this->Common->select('manage_static_pages',$where);
		//dd($data['result']);
		
		if(!empty($data['result'][0]['static_templates'])){
			
			$name = trim(strtolower($data['result'][0]['static_templates']));
				if (!file_exists(APPPATH.'views/static_pages/'.$name.'.php'))
				{
				// Whoops, we don't have a page for that!
				redirect('Error_handler');
				}
			$this->load->view('static_pages/'.$name,$data);	
		}else{
			$this->load->view('example/pages',$data);		
		}
		
	}

 
}