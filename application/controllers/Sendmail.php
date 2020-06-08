<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sendmail extends CI_Controller {

 public function index()
 {}
    public function SendEmail($receiver_email,$subject,$message,$sender)
 {
    $this->load->library('email');
    $config['protocol'] = 'smtp';
    $config['smtp_host'] = 'smtp.gmail.com';
    $config['smtp_port'] = 465;
    $config['smtp_crypto'] = 'ssl';
    $config['smtp_user'] = 'mmeowapp06@gmail.com';
    $config['smtp_pass'] = 'mmeowapp060541';
    $config['charset'] = 'utf-8';
    $config['wordwrap'] = FALSE;
    $config['crlf'] = '\r\n';
    $config['newline'] = "\r\n";
    $config['mailtype']  ='html';
    
    $this->email->initialize($config);
    $this->email->set_mailtype("html");
    $this->email->set_newline("\r\n");
    $this->email->from('<mmeowapp06@gmail.com>', 'Wilddog Bankaccount');

    $this->email->to($receiver_email);
  

    $this->email->subject($subject);
    $this->email->message($message);

    if ($this->email->send(FALSE)) {
        echo 'OK';
        echo $this->email->print_debugger(array('headers'));
    } else {
        echo 'Not OK';
        echo $this->email->print_debugger(array('headers'));
    }
 }
}