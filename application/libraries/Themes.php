<?php
if(!defined('BASEPATH')) exit('no file allowed');
class Themes{
    protected $_ci;
     function __construct(){
        $this->_ci =&get_instance();
    }

        function Auth($theme, $data=null){
        $data['_config_content']    =$this->_ci->load->view($theme,$data,true);
        $data['js']                 =$this->_ci->load->view('themes/auth/js.php',$data,true);
        $data['css']                =$this->_ci->load->view('themes/auth/css.php',$data,true);
        $this->_ci->load->view('themes/auth.php', $data);
    }
    
    function Def($theme, $data=null){
        $data['_config_content']    =$this->_ci->load->view($theme,$data,true);
        $data['header']             =$this->_ci->load->view('themes/def/header.php',$data,true);
        $data['footer']             =$this->_ci->load->view('themes/def/footer.php',$data,true);
        $data['js']                 =$this->_ci->load->view('themes/def/js.php',$data,true);
        $data['css']                =$this->_ci->load->view('themes/def/css.php',$data,true);
        $data['navbar']             =$this->_ci->load->view('themes/def/navbar.php',$data,true);
        $data['breadcum']           =$this->_ci->load->view('themes/def/breadcum.php',$data,true);
        $data['modal']              =$this->_ci->load->view('themes/def/modal.php',$data,true);
        $this->_ci->load->view('themes/def.php', $data);
    }


}