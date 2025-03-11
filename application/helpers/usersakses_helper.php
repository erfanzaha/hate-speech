<?php
if(!defined('BASEPATH')) exit('no file allowed');
function isAuth(){
    $Ci =& get_instance();
    $status_login = $Ci->session->userdata('status_login');
    if ($status_login == false) {
        redirect('/');
    }
}

function is_logged(){
    $Ci =& get_instance();
    $status_login = $Ci->session->userdata('status_login');
    if ($status_login == true) {
        redirect('dashboard');
    }
}