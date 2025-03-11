<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function __construct(){
        parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
        is_logged();
	}

    public function index(){
        $uri                = $this->uri->segment(1);
        $data['title']      = "Login";
        $this->themes->Auth('auth/login',$data);
        
    }
}