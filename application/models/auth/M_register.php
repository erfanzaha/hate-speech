<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_register extends CI_Model{
    public function __construct(){
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
    }

    public function checkAccount(){
        $email      = trim($this->input->post('email','true'));
        $username   = trim($this->input->post('username','true'));
        return $this->db->where('email',$email)
                        ->or_where('username',$username)
                        ->get('user');
    }

    public function proses(){
        $created_at = date('Y-m-d H:i:s');
        $updated_at = date('Y-m-d H:i:s');

        $nama       = trim($this->input->post('nama','true'));
        $email      = trim($this->input->post('email','true'));    
        $username   = trim($this->input->post('username','true'));
        $password   = trim($this->input->post('password','true'));
        $alamat     = trim($this->input->post('alamat','true'));
        $no_telp    = trim($this->input->post('no_telp','true'));
        $title      = "Registasi customer baru";
        $keterangan = "Registrasi customer baru dengan nama : <strong> ".$nama." </strong>";

        $this->db->trans_begin();
        $this->db->insert('user',
                        [
                        'email'         => $email,
                        'username'      => $username,
                        'password'      => password_hash($password,PASSWORD_DEFAULT),
                        'id_role'       => '1',
                        'no_telp'       => $notelp,
                        'alamat'        => $alamat
                        'created_at'    => $created_at,
                        'updated_at'    => $updated_at,
                        ]
                );
        $getLastData = $this->db->get_where('user',['email'=>$email])
                                ->row();
        $this->db->insert('costumer',
                        [
                        'id_user'   => $getLastData->id,
                        'nama'      => $nama,
                        'no_telp'   => $no_telp,
                        'alamat'    => $alamat,
                        'created_at'=> $created_at,
                        'updated_at'=> $updated_at,
                        ]
                );
        $saveNotifikasi = $this->m_notifikasi->saveNotifikasi($title,$keterangan);

        if($this->db->trans_status() === FALSE || $saveNotifikasi === FALSE){
			$this->db->trans_rollback();
			return FALSE;
		}else{
			$this->db->trans_commit();
			return TRUE;
		}
    }

}