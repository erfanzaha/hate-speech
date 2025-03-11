<?php
if(!defined('BASEPATH')) exit('no file allowed');
/*
* manampilkan form dibagian admin
*/
function formAdmin(){
    $Ci   =& get_instance();
    $uri  = $Ci->uri->segment(1);
    $uri2 = $Ci->uri->segment(2);
    $uri3 = $Ci->uri->segment(3);
    $uri4 = $Ci->uri->segment(4);
    $Ci->load->view($uri.'/form/form-'.$uri);
}

function tableAdmin(){
    $Ci   =& get_instance();
    $uri  = $Ci->uri->segment(1);
    $uri2 = $Ci->uri->segment(2);
    $uri3 = $Ci->uri->segment(3);
    $uri4 = $Ci->uri->segment(4);
    $Ci->load->view($uri.'/table/tbl-'.$uri);
}

/**
 * random character
 */
function randomChar($length_of_string) 
{ 
    return substr(md5(time()), 0, $length_of_string); 
} 

/**
 * ekripsi url
 */
function encryptUrl($url) {
    $cryptKey    ='d8578edf8458ce06fbc5bb76a58c5ca4';
    $qEncoded    =base64_encode($url);
    return($qEncoded);
}

/**
 * dekripsi url
 */
function decryptUrl($url) {
    $cryptKey    ='d8578edf8458ce06fbc5bb76a58c5ca4';
    $qDecoded    = base64_decode($url);
    return($qDecoded);
}