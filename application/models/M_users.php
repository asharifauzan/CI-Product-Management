<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_users extends CI_Model{

  public function auth($email, $password){
    // get by email
    $user = $this->db->get_where('users', ['email' => $email])->row_array();
    
    // email not exist
    if(!$user) return FALSE;
    // email correct but wrong password
    if( !password_verify($password, $user['password']) ){
      return FALSE;
    }
    // email & password is correct
    return TRUE;
  }


}
