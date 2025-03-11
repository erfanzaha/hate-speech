<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NotFound extends CI_Controller {
	public function __construct(){
        parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
	}

	public function index(){
		$data['title'] = "Page Not Found";						   
		if($this->session->userdata('id_user')!=NULL):
			$getData = $this->db->join('user_role','user_role.id = user.id_role')
								->get_where('user',['user.id'=>$this->session->userdata('id_user')])
								->row();
			if($getData->role != 'CUSTOMER'):
				$this->load->view('errors/error-404',$data);
			else:
				$data['payment']    = payment();	
				$data['shipping']   = shipping();	
				$data['keunggulan'] = keunggulan();	
				$this->themes->Portal('errors/error-404-customer',$data);
			endif;
		else:
			$this->themes->Portal('errors/error-404-customer',$data);
		endif;
		
	}

}
