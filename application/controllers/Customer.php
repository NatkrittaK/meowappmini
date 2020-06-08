<?php
 defined('BASEPATH') OR exit('No direct script access allowed'); 
 
class Customer extends CI_Controller
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

    //   header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
    //   header('Cache-Control: no-cache, no-cache, must-revalidate');
    //   header('Cache-Control: post-check=0, pre-check=0', false);
    //   header('Pragma: no-cache');

     
    }
    private function checklogin()
    {
        if (!isset($_SESSION['user'])) {
            redirect('/');
          }
       
    }

       public function index()
     {
        $data['userinfo'] = $this->datamodel->getEmail($_SESSION['user'],'customer');
        $this->load->view('header');
        $this->load->view('customer',$data);
        $this->load->view('footer');
        
     }

     public function update()
     {
       
        $this->form_validation->set_rules('fname',  'fname', 'required|trim|xss_clean');
        $this->form_validation->set_rules('lname',  'lname', 'required|trim|xss_clean');
        $this->form_validation->set_rules('phone',  'phone', 'required|trim|xss_clean');
       // $this->form_validation->set_rules('email', 'email', 'required|valid_email');
       $this->form_validation->set_rules('email', 'email', 'required|valid_email');
        $this->form_validation->set_rules('address',  'address', 'required|trim|xss_clean');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
  
        if ($this->form_validation->run() == FALSE) {
          $data['userinfo'] = $this->datamodel->getEmail($_SESSION['user'],'customer');
          $this->load->view('header');
          $this->load->view('customer',$data);
          $this->load->view('footer');
          // redirect('/Customer');
        }elseif($this->input->post(NULL, TRUE)){
          if (empty($_FILES['userFile']['name'])) {
            redirect('/Customer');
          }else{
            //config
        $config['upload_path']   = "uploads"; //Folder สำหรับ เก็บ ไฟล์ที่  Upload
        $config['allowed_types'] = 'gif|jpg|png'; //รูปแบบไฟล์ที่ อนุญาตให้ Upload ได้
        // $config['max_size']      = 0; //ขนาดไฟล์สูงสุดที่ Upload ได้ (กรณีไม่จำกัดขนาด กำหนดเป็น 0)
        //rename file
        
        $new_name = time().$_FILES["userFile"]['name'];
        $config['file_name'] = $new_name;
  
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
  
            if (!$this->upload->do_upload('userFile')) {
  
              $error = array('error' => $this->upload->display_errors());
              redirect('/Customer');
            }else{
                $userinfo  = $this->datamodel->getEmail($_SESSION['user'],'customer');
                $ID  = $userinfo[0]['ID'];
              $data = array(
                'firstname' => $_POST['fname'],
                'lastname'  =>  $_POST['lname'],
                'phone' => $_POST['phone'],
                'email' => $_POST['email'],
                'address'  =>  $_POST['address'],
                'picture'  =>  $new_name,
                
                //picture
                
              );
              if(!$this->datamodel->updateDataCustomer($ID,$data)){
                unset($_POST['password']);
                $this->session->flashdata('err_message','ผิดพลาด');
                redirect('/Customer');
              }else{
                unset($_POST['password']);
                $this->querylog->save_query_in_db();
                redirect('/Customer');
              }
            }
          }
          
        }
          
         
        
     }



     

    

    
}  