<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_login extends CI_Model{
    public function __construct(){
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
    }

    public function getUser($data){
        $this->db->where($data);
		$this->db->from('user');		
		$query = $this->db->get();
		return $query;
	}

    public function proses(){
        $created_at = date('Y-m-d H:i:s');
        $updated_at = date('Y-m-d H:i:s');

        //data 
        $data = array(
                    'username' => trim($this->input->post('username','true'))
                );
        $pass = trim($this->input->post('password','true'));
        
		$check   = $this->m_login->getUser($data)->num_rows();			
        $getData = $this->m_login->getUser($data)->row();	
        
        if($check > 0 ){
            $this->db->trans_begin();
            $updateLogin = $this->db->where(['id'=>$getData->id])
                                    ->update('user',
                                        ['updated_at' => $updated_at]
                                        );
            if($this->db->trans_status() === TRUE && password_verify($pass,$getData->password)){
                $this->db->trans_commit();
                $msg = ['status'=>TRUE,'id'=>$getData->id,'user'=>$getData->username];
            }else{
                $this->db->trans_rollback();
                if($check <= 0){
                    $txt    =  'Akun tidak ditemukan';
                    $icon   =  'warning';
                }else{
                    $txt    = 'Terjadi kesalahan saat login';
                    $icon   = 'error';
                }
                $msg = ['msg' => $txt,'status'=>FALSE,'icon'=>$icon];   
            }
        }else{
            $txt    = 'Akun tidak ditemukan';
            $icon   = 'error';
            $msg    = ['msg' => $txt,'status'=>FALSE,'icon'=>$icon];   
        }
        return $msg;            
    }
}