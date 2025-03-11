<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_forgot_password extends CI_Model{
    public function __construct(){
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
    }

    public function proses(){
        $email = trim($this->input->post('email','true'));    
        return $this->db->get_where('user',['email'=>$email]);
    }
}