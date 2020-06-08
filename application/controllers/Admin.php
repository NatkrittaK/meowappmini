<?php
 defined('BASEPATH') OR exit('No direct script access allowed'); 

class Admin extends CI_Controller
  {
    public function __construct()
    {        
      parent::__construct();


      $this->load->library('session');
      $this->load->library('form_validation');
      $this->load->library('querylog');
      
      $this->load->helper(array('form', 'url', 'string', 'security'));
      $this->load->helper('directory');
      $this->load->model('datamodel');
      $this->checklogin();

    
     
    }
    private function checklogin()
    {
        if (!isset($_SESSION['user'])&&($_SESSION['user']!='admin')) {
            redirect('/');
          }
       
    }

       public function index()
     {
        $data['data_customer'] =  $this->datamodel->getAllData();
        $this->load->view('header');
        $this->load->view('admin',$data);
        $this->load->view('footer');
        
     }
     public function addCustomer(){
         
      $this->form_validation->set_rules('fname',  'fname', 'required|trim|xss_clean');
      $this->form_validation->set_rules('lname',  'lname', 'required|trim|xss_clean');
      $this->form_validation->set_rules('phone',  'phone', 'required|trim|xss_clean');
     // $this->form_validation->set_rules('email', 'email', 'required|valid_email');
     $this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique[customer.email]');
      $this->form_validation->set_rules('address',  'address', 'required|trim|xss_clean');
      $this->form_validation->set_rules('password', 'password', 'required');
      $this->form_validation->set_rules('confirmpassword', 'confirmpassword', 'required|matches[password]');
      $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

      
      

      if ($this->form_validation->run() == FALSE) {
        $this->load->view('header');
        $this->load->view('add_customer');
      }elseif($this->input->post(NULL, TRUE)){
        if (empty($_FILES['userFile']['name'])) {
          redirect('/Admin/addCustomer');
        }else{
          //config
      $config['upload_path']   = "uploads"; //Folder สำหรับ เก็บ ไฟล์ที่  Upload
      $config['allowed_types'] = 'gif|jpg|png'; //รูปแบบไฟล์ที่ อนุญาตให้ Upload ได้
      // $config['max_size']      = 0; //ขนาดไฟล์สูงสุดที่ Upload ได้ (กรณีไม่จำกัดขนาด กำหนดเป็น 0)
      //$config['encrypt_name'] = TRUE;
      //rename file
     
      
      
      $new_name = time().$_FILES["userFile"]['name'];
      $config['file_name'] = $new_name;

      $this->load->library('upload', $config);
      $this->upload->initialize($config);

          if (!$this->upload->do_upload('userFile')) {

            $error = array('error' => $this->upload->display_errors());
            // print_r( $error);
           redirect('/Admin/addCustomer');
          }else{
            $salted = "icmeri4".$_POST['password']."irtvo31";
            $hashed = hash('sha512',$salted);
            $data = array(
              'firstname' => $_POST['fname'],
              'lastname'  =>  $_POST['lname'],
              'phone' => $_POST['phone'],
              'email' => $_POST['email'],
              'address'  =>  $_POST['address'],
              'picture'  =>  $new_name,
              
              //picture
              'password' => $hashed,
            );
            if($this->datamodel->addCustomer($data)){
              unset($_POST['password']);
              $this->querylog->save_query_in_db();
              redirect('/Admin');
            }else{
              unset($_POST['password']);
              $this->session->flashdata('err_message','ผิดพลาด');
              redirect('/Admin/addCustomer');
            }
          }
        }
        
      }
     }


     public function update()
     {
        if (isset($_GET['q'])) {
            $ID = rawurldecode($this->encryption->decrypt($_GET['q']));
            if ($this->datamodel->getDataCustomer($ID)) {
              if ($this->input->post(NULL, TRUE)) {
                $this->form_validation->set_rules('fname',  'fname', 'required|trim|xss_clean');
      $this->form_validation->set_rules('lname',  'lname', 'required|trim|xss_clean');
      $this->form_validation->set_rules('phone',  'phone', 'required|trim|xss_clean');
     $this->form_validation->set_rules('email', 'email', 'required|valid_email');
     
      $this->form_validation->set_rules('address',  'address', 'required|trim|xss_clean');
      
                if ($this->form_validation->run() == FALSE) {
                   $this->session->set_flashdata('err_message', 'บางอย่างผิดพลาด กรุณากรอกข้อมูลใหม่');
                } else {
                    $data = array(
                        'firstname' => $_POST['fname'],
                        'lastname'  =>  $_POST['lname'],
                        'phone' => $_POST['phone'],
                        'email' => $_POST['email'],
                        'address'  =>  $_POST['address'],
                        //'picture'  =>  $new_name,
                        
                        //picture
                      );
                      if(!$this->datamodel->updateDataCustomer($ID,$data)){
                        $this->session->set_flashdata('err_message', 'บางอย่างผิดพลาด กรุณากรอกข้อมูลใหม่');
                        redirect('/Admin');
                      }else{
                        $this->querylog->save_query_in_db();
                      }
                }
      
      
                
              }
            } 
          }
          redirect('Admin');
        
     }
     public function delete()
     {
         if($_GET['q']){
            $id = rawurldecode($this->encryption->decrypt($_GET['q']));
            $fileimage = $this->datamodel->getDataCustomer($id);
            @unlink("uploads/$fileimage[0]['picture']");
            //print_r($fileimage);
           ;
            if( $this->datamodel->deleteCustomer($id)){
              $this->querylog->save_query_in_db();
            }
            
         }

        redirect('/Admin');
        
     }

    
     

     


     

    

    
}  