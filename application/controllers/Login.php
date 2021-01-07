<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller{
    public function __construct(){
      parent::__construct();
      // echo password_hash('nutech123', PASSWORD_BCRYPT); die();
      $this->load->helper('url');
      $this->load->library(['form_validation', 'session']);
      $this->load->model('m_users');
      if ( $this->session->userdata('is_login') ) redirect(base_url('dashboard'));
    }

    public function index(){
      $this->form_validation->set_rules('email', 'Email', 'required');
      $this->form_validation->set_rules('password', 'Password', 'required');

      if (!$this->form_validation->run()) {
        $this->load->view('login');
      } else {
          $email = $this->input->post('email');
          $password = $this->input->post('password');

          // auth true will goes to dashboard
          if( $this->m_users->auth($email, $password) ){
            $newdata = array(
                    'email'     => $email,
                    'is_login' => TRUE
            );

            $this->session->set_userdata($newdata);
            redirect(base_url('dashboard'));
          }
          // alert email&password
          echo "Email/Password is incorrect";
      }
    }
}?>
