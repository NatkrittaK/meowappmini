<?php
 defined('BASEPATH') OR exit('No direct script access allowed'); 

include_once(dirname(__FILE__) . "/Sendmail.php");
 
class Main extends Sendmail
  {
    public function __construct()
    {        
      parent::__construct();


      $this->load->library('session');
      $this->load->library('form_validation');
      $this->load->library('upload');
      
      $this->load->helper(array('form', 'url', 'string', 'security','file'));
      $this->load->helper('directory');
      $this->load->model('Datamodel');

      // header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
      // header('Cache-Control: no-cache, no-cache, must-revalidate');
      // header('Cache-Control: post-check=0, pre-check=0', false);
      // header('Pragma: no-cache');

      

     
    }
       public function index()
     {

        $this->load->view('header');
       $this->load->view('home');
        $this->load->view('footer');
        
     }

     public function login()
     {
      
    $this->form_validation->set_rules('email', 'email', 'required|valid_email');
    $this->form_validation->set_rules('pwd',  'pwd', 'required|trim|xss_clean');
    if ($this->form_validation->run() == FALSE) {
      // $this->load->view('header');
      // $this->load->view('home');
      //  $this->load->view('footer');
      redirect('/');
    }elseif($this->input->post(NULL, TRUE)){
    $salted = "icmeri4".$_POST['pwd']."irtvo31";
    $hashed = hash('sha512',$salted);
  if($this->Datamodel->checkUser($_POST['email'],$hashed,'admin')){
    $_SESSION['user'] = 'admin';
    unset($_POST['pwd']);
    $this->querylog->save_query_in_db();
    redirect('/Admin');
   
  }elseif($this->Datamodel->checkUser($_POST['email'],$hashed,'customer')){
    $_SESSION['user'] = $_POST['email'] ;
    unset($_POST['pwd']);
    $this->querylog->save_query_in_db();
    redirect('/Customer');
   
  }else{
    $this->session->set_flashdata('message', 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง');
    redirect('Main');
    
  }
 
  
}else{
  redirect('/');
}
        
     }
     public function Logout()
    {
        $this->session->sess_destroy();
        redirect('/Main');
    }

     public function register()
     {

        $this->load->view('header');
        $this->load->view('register');
        $this->load->view('footer');
      
     }
     public function signup()
     {
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
        $this->load->view('register');
        $this->load->view('footer');
      }elseif($this->input->post(NULL, TRUE)){
        if (empty($_FILES['userFile']['name'])) {
          $error = array('error' => 'บางอย่างผิดพลาด');
          redirect('/Main/register');
        }else{
          //config
      $config['upload_path']   = "uploads/"; //Folder สำหรับ เก็บ ไฟล์ที่  Upload
      $config['allowed_types'] = 'gif|jpg|png'; //รูปแบบไฟล์ที่ อนุญาตให้ Upload ได้
      // $config['max_size']      = 0; //ขนาดไฟล์สูงสุดที่ Upload ได้ (กรณีไม่จำกัดขนาด กำหนดเป็น 0)
    
      //rename file
      
      $new_name = time().$_FILES["userFile"]['name'];
      $config['file_name'] = $new_name;

      $this->load->library('upload', $config);
      $this->upload->initialize($config);

          if (!$this->upload->do_upload('userFile')) {

            $error = array('error' => $this->upload->display_errors());
            redirect('/Main/register');
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
            if($this->Datamodel->addCustomer($data)){
              $this->session->flashdata('success_message','ลงทะเบียนสำเร็จ');
              unset($_POST['password']);
              redirect('Main');
            }else{
              unset($_POST['password']);
              $this->session->flashdata('message','ผิดพลาด');
              redirect('/Main/register');
            }
          }
        }
        
      }
    }

     
     public function forgetpassword()
     {
        
        $this->form_validation->set_rules('email',  'email', 'required|trim|valid_email');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == FALSE) {
          $this->load->view('header');
          $this->load->view('forgetpassword');
          $this->load->view('footer');
          
        }
        else{
          if($this->Datamodel->getEmail($_POST['email'],'customer')){
            $token = rand(1000,9999);
            $data = array('password'  =>  $token); //add current password
            $ID = $this->Datamodel->getEmail($_POST['email'],'customer');//get id customer
            $this->Datamodel->updateDataCustomer($ID[0]['ID'], $data); //update new password
            $message = "กรุณาคลิกที่ลิ้งเพื่อตั้งค่ารหัสผ่าน <br><a href='".base_url('Main/reset?token=').$token."'>ตั้งค่ารหัสผ่าน</a>";
            $this->SendEmail($_POST['email'], 'แจ้งข้อมูลการรีเซ็ตรหัสผ่าน',  $message, 'Wilddog Bankaccount');
                
                $this->session->set_flashdata('message', 'แจ้งข้อมูลการรีเซ็ตรหัสผ่านแล้ว กรุณาเช็ค email.');
                redirect('Main/forgetpassword');
          }else{
            $this->session->set_flashdata('message', 'ไม่พบ email นี้ในระบบ');
            redirect('Main/forgetpassword');
          }
        
          
          
        }

     }

     public function reset(){
      $data['token'] =  $this->input->get('token');
      $_SESSION['token'] =  $data['token'];
      $passUser = $this->Datamodel->getDataFromPass($_SESSION['token']);
      if( $passUser!=false){ //check from current password
      $this->load->view('header');
      $this->load->view('setpassword'); 
      $this->load->view('footer');
      }else{
       redirect('Main'); 
      }
      
   }

   public function updatepassword(){
    $this->form_validation->set_rules('pass', 'พิมพ์รหัสผ่านที่ต้องการ', 'required');
    $this->form_validation->set_rules('passconf', 'พิมพ์รหัสผ่านใหม่ที่ต้องการอีกครั้งหนึ่ง', 'required|matches[pass]');
    $User = $this->Datamodel->getDataFromPass($_SESSION['token']);

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('err_message', 'รหัสผ่านที่กรอกไม่ตรงกัน');
                redirect('Main/reset?token='.$_SESSION['token']);
        }else{
           
            $salted = "icmeri4".$_POST['pass']."irtvo31";
            $hashed = hash('sha512',$salted);
            $data = array('password'  => $hashed );
           
           if($this->Datamodel->updateDataCustomer($User[0]['ID'], $data)) { 
            $this->session->set_flashdata('success_message', 'ตั้งค่ารหัสผ่านสำเร็จ');
            redirect('Main');
            unset($_SESSION['token']);
           }else{
            $this->session->set_flashdata('err_message', 'ตั้งค่ารหัสผ่านไม่สำเร็จ');
            redirect('Main/reset?token='.$_SESSION['token']);
           }
         
            
        }
   
  

}



    
         
     

    

    
}  