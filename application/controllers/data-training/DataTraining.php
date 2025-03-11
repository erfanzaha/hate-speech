<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataTraining extends CI_Controller {
	public function __construct(){
        parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		isAuth();
	}

	public function index(){
        $data['title']      = "Data Training";
		$data['subTitle']   = "Data Training";	
		$data['active']     = "data training";
		$this->themes->Def('data-training/index',$data);
	}

	public function prosesdeteksi(){
		$data = $this->M_data_training->prosesdeteksi();
		$msg = array(
			'msg'  => "Data training berhasil disimpan",
			'icon' => "success",
			'title'=> 'Berhasil',
			'status'=> "oke",
		);
		echo json_encode($msg);
	}
}
