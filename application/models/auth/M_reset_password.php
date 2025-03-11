<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_reset_password extends CI_Model{

    public function __construct(){
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
    }

    public function proses(){
        $created_at = date('Y-m-d H:i:s');
        $updated_at = date('Y-m-d H:i:s');

        $type    = trim($this->input->post('type','true'));
        $id      = trim($this->input->post('id_reset','true'));
        $newpass = trim($this->input->post('r_newpass','true'));

        $this->db->trans_begin();
        $this->db->where('id',$id)
                 ->update('user',
                        ['password'     => password_hash($newpass,PASSWORD_DEFAULT),
                        'updated_at'    => $updated_at]
                );
        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return FALSE;
		}else{
            $this->db->trans_commit();
            if($type == 0){
                $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . 'GMT');
                $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
                $this->output->set_header('Pragma: no-chace');
                session_destroy();
            }
            return TRUE;
		}
    }

}