<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Migration extends CI_Controller {
    public function __construct() {
        parent::__construct();
         $this->load->library('migration');
    }
    public function index() {
      // $data = $this->migration->find_migrations();
      // var_dump($data);
      // $this->migration->version('001');
      if ($this->migration->current() === FALSE)
                {
                        echo show_error($this->migration->error_string());
                }
    }
}
