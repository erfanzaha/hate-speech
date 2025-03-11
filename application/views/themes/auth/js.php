<?php
$uri  = $this->uri->segment(1);
if($uri == ""){
    $uri = "login";
}else{
    $uri = $uri;
}
$this->load->view('auth/js/js-'.$uri);
?>