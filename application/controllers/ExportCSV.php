<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ExportCSV extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('datamodel');
    
  }


  function export()
  {
   
    $file_name = 'customer_data' . date('Ymd') . '.csv';
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=$file_name");
    header("Content-Type: application/csv;");

    // get data 


    // file creation 

    $file = fopen('php://output', 'w');
    fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));


    $header = array( "ชื่อ","นามสกุล", "เบอร์โทรศัพท์","อีเมล์","ที่อยู่");
    fputcsv($file, $header);
    ////////////////////////////////////////
    
    $dataI = $this->datamodel->getAllData();
    if (!empty($dataI)) {
      foreach($dataI as $data) {
        $value = array(
          'firstname' => $data['firstname'],
          'lastname' => $data['lastname'],
          'phone' => $data['phone'],
          'email' => $data['email'],
          'address' =>  $data['address']
          
        );
        fputcsv($file, $value);
      }
    }
    fclose($file);
    return;
  }
}



