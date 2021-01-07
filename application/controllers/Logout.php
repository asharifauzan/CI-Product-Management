<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Logout extends CI_Controller{
  public function __construct(){
    parent::__construct();
    $this->load->helper('url');
    $this->load->library(['form_validation', 'session']);
    $this->load->model('m_users');
  }

  public function index(){
    $this->session->sess_destroy();
    redirect(base_url());
  }
}?>
