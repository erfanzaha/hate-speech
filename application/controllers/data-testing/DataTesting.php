<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataTesting extends CI_Controller {
	public function __construct(){
        parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		isAuth();
	}

	public function index(){
        $data['title']      = "Data Testing";
		$data['subTitle']   = "Data Testing";	
		$data['active']     = "Data Testing";
		$this->themes->Def('data-testing/index',$data);
	}

	public function prosesDeteksi(){
		$data = $this->M_data_testing->prosesDeteksi();
		$pesan = "Gain general : ".$data['gain_general']."\n"; 
		$pesan .= "Entropy General : ".$data['ent_gen']."\n";
		$pesan .= "\n";
		$pesan .= " Bobot Information Gain : ".$data['bobot_information_gain']."\n";
		$pesan .= "Bobot Entropy : ".$data['bobot_entropy_atribut']."\n";
		$pesan .= " Bobot Gain : ".$data['bobot_gain']."\n";
		$pesan .= "\n";
		$pesan .= " Jumlah Muncul Information Gain : ".$data['muncul_information_gain']."\n";
		$pesan .= " Jumlah Muncul Entropy : ".$data['muncul_entropy_atribut']."\n";
		$pesan .= " Jumlah Muncul Gain : ".$data['muncul_gain']."\n";
				  
		if ($data['hasil'] == "valid") :
			
			$msg = array(   
				'msg'  => $pesan,
				'icon' => 'success',
				'title'=> "Berita ini ".$data['hasil'],
				'status'=> "oke",
			);
		else:
			$msg = array(
				'msg'  => $pesan,
				'icon' => "error",
				'title'=> "Berita ini ".$data['hasil'],
				'status'=> "oke",
			);
		endif;
		echo json_encode($msg);
	}
}
