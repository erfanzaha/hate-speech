<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {
	public function __construct(){
        parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		isAuth();
	}

	public function index(){
        $data['title']      = "Report";
		$data['subTitle']   = "Report";	
		$data['active']     = "Report";
		$this->themes->Def('report/index',$data);
	}

	public function viewReport(){
		$data['data'] = $this->m_report->viewReport()->result();
		echo json_encode($data);
	}
}
