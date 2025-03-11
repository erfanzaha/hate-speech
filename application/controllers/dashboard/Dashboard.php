<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct(){
        parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		isAuth();
	}

	public function index(){
		$data['title']       = "Welcome";
		$data['subTitle']    = "Welcome";	
		$data['active']		 = "Welcome";	
		$this->themes->Def('dashboard/index',$data);
	}

	public function importExcel(){
        $fileName = $_FILES['file']['name'];
          
        $config['upload_path'] = './assets/'; //path upload
        $config['file_name'] = $fileName;  // nama file
        $config['allowed_types'] = 'xls|xlsx|csv'; //tipe file yang diperbolehkan
        $config['max_size'] = 10000; // maksimal sizze
 
        $this->load->library('upload'); //meload librari upload
        $this->upload->initialize($config);
          
        if(! $this->upload->do_upload('file') ){
            echo $this->upload->display_errors();exit();
        }
              
        $inputFileName = './assets/'.$fileName;
 
        try {
                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
            } catch(Exception $e) {
                die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
            }
 
            $sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();
 
            for ($row = 1; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                                NULL,
                                                TRUE,
                                                FALSE);   
 
                 // Sesuaikan key array dengan nama kolom di database                                                         
                 $data = array(
                    "keyword"=> $rowData[0][0],
                    "handle"=> $rowData[0][1],
					"name"=> $rowData[0][2],
					"content"=> $rowData[0][3],
					"replies"=> $rowData[0][4],
					"retweets"=> $rowData[0][5],
                    "favorite"=> $rowData[0][6],
                    "unix_timestamp"=> $rowData[0][7],
                    "date"=> $rowData[0][8],
                    "url"=> $rowData[0][9],
                    "search_url"=> $rowData[0][10],
                    "hastags"=> $rowData[0][11],
                );
 
                $insert = $this->db->insert("dataset",$data);
                      
            }
            if($insert){
				echo "oke";
			}else{
				echo"fail";
			}
    }

}