<?php
if(!defined('BASEPATH')) exit('no file allowed');

/**
 * configuration basic
 */
function basicConfig($key){
    $Ci   =& get_instance();
    return $Ci->db->get_where('basic_information',['tipe'=>$key])->row();
}

function slider(){
    $Ci   =& get_instance();
    return $Ci->db->limit(3)   
                  ->order_by('id','desc')
                  ->get('slider')
                  ->result();
}

function testimoni(){
    $Ci   =& get_instance();
    return $Ci->db->order_by('id','desc')
                  ->get('testimoni')
                  ->result();
}

function payment(){
    $Ci   =& get_instance();
    return $Ci->db->order_by('id','desc')
                  ->get_where('metode',['metode'=>'pembayaran'])
                  ->result();
}

function shipping(){
    $Ci   =& get_instance();
    return $Ci->db->order_by('id','desc')
                  ->get_where('metode',['metode'=>'pengiriman'])
                  ->result();
}

function setting($key){
    $Ci   =& get_instance();
    return $Ci->db->get_where('pengaturan',['section'=>$key])->row();
}

function keunggulan(){
    $Ci   =& get_instance();
    return $Ci->db->get('keunggulan')
                  ->result();
}

function banner($key){
    $Ci   =& get_instance();
    return $Ci->db->get_where('banner',['id'=>$key])->row();
}