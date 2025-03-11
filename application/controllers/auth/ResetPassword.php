<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ResetPassword extends CI_Controller {
	public function __construct(){
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
    }

    public function index(){    
        $uri           = $this->uri->segment(1);
        if($uri == 'administrator-reset-password'):
            $data['title'] = 'Administrator Reset Password';
            $this->themes->Auth('auth/administrator-reset-password',$data);
        else:
            $data['title']      = 'Reset Password';
            $data['payment']    = payment();	
            $data['shipping']   = shipping();	
            $data['keunggulan'] = keunggulan();	
            $this->themes->Portal('auth/reset-password',$data);
        endif;
    }

    public function proses(){
        try {
            $update = $this->m_reset_password->proses();
            if($update):
                $msg = array(
                    'msg'  => 'Reset password berhasil',
                    'icon' => 'success',
                );
            else:
                $msg = array(
                    'msg'  => 'Reset password gagal',
                    'icon' => 'error',
                );
            endif;
        } catch (Exception $e) {
            echo $e->getMessage();
            die();
        }
        echo json_encode($msg);
    }

}