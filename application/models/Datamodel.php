<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Datamodel extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
    
  }
 

  function checkUser($username,$password,$table)
  {
    $this->db->select('*');
    $this->db->where('email',  $username);
    $this->db->where('password',  $password);
    $this->db->from($table);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
        return $query->result_array();
      }
      return FALSE;
  }
  //customer
  //get
  function getAllData() //get email customer
  {
    $this->db->select('*');
    $this->db->from('customer');
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
        return $query->result_array();
      }
      return FALSE;
  }

 
  function getDataCustomer($ID)
  {
    $this->db->select('*');
    $this->db->where('ID',  $ID);
    $this->db->from('customer');
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
        return $query->result_array();
      }
      return FALSE;
  }
  
  function getEmail($email,$table) //get email customer
  {
    $this->db->select('*');
    $this->db->where('email',  $email);
    $this->db->from($table);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
        return $query->result_array();
      }
      return FALSE;
  }
  function getDataFromPass($password) 
  {
    $this->db->select('*');
    $this->db->where('password',  $password);
    $this->db->from('customer');
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
        return $query->result_array();
      }
      return FALSE;
  }
  
  //add
  function addCustomer($data) //get email customer
  {
      return $this->db->insert('customer', $data);
    
  }
  //update
  
  function updateDataCustomer($ID,$data) //get email customer
  {
    $this->db->where('ID', $ID);
    return $this->db->update('customer', $data);
    
  }
  
  //delete
  function deleteCustomer($ID) //get email customer
  {
    $this->db->where('ID', $ID);
    return $this->db->delete('customer');
    
  }


}//class