<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_report extends CI_Model{

    public function __construct(){
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
    }

    public function viewReport(){
      return $this->db->join('hasil','hasil.link = dataset.link')
                      ->get("dataset");
    }
}