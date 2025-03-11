<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ForgotPassword extends CI_Controller {
	public function __construct(){
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
    }

    public function index(){
        $uri           = $this->uri->segment(1);
        if($uri == 'administrator-forgot-password'):
            $data['title'] = 'Administrator Forgot Password';
            $this->themes->Auth('auth/administrator-forgot-password',$data);
        else:
            $data['title']      = 'Forgot Password';
            $data['payment']    = payment();	
            $data['shipping']   = shipping();	
            $data['keunggulan'] = keunggulan();	
            $this->themes->Portal('auth/forgot-password',$data);
        endif;        
    }

    public function proses(){
		$check      = $this->m_forgot_password->proses();	
        $num        = $check->num_rows();
        $getAkun    = $check->row();
        if($num > 0):
            $this->session->set_userdata(array('id_user'=>$getAkun->id));
            $msg  = array(
                'msg'   => 'Lanjutkan reset password anda',
                'icon'  => 'success',
            );
        else:
            $msg = array(
                'msg'  => 'Email yang anda masukkan tidak terdaftar',
                'icon' => 'warning',
            );    
        endif;
        echo json_encode($msg);
    }

}