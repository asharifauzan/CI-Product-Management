<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->helper(['url', 'file']);
    $this->load->library(['form_validation', 'session']);
    $this->load->model('m_product');
    if( !$this->session->userdata('is_login') ){
      echo "Forbidden";
      echo anchor(base_url(), 'back to login');
      die();
    }
  }

  function index(){
    $this->load->view('v_header');
    $this->load->view('v_dashboard');
    $this->load->view('v_footer');
  }

  public function get($id = NULL, $NamaBarang = NULL){
    $data = $this->m_product->getProduct($id, $NamaBarang);
    echo json_encode($data);
  }

  public function add(){
    $this->form_validation->set_rules('NamaBarang', 'Nama', 'required');
    $this->form_validation->set_rules('HargaJual', 'Harga_Jual', 'required');
    $this->form_validation->set_rules('HargaBeli', 'Harga_Beli', 'required');
    $this->form_validation->set_rules('Stok', 'Stok', 'required');

    if( !$this->form_validation->run() ){
      $this->responseError("Harap isi form dengan benar");
    }

    $data = [
      'NamaBarang' => $this->input->post('NamaBarang'),
      'FotoBarang' => $this->do_upload('FotoBarang'),
      'HargaJual' => $this->input->post('HargaJual'),
      'HargaBeli' => $this->input->post('HargaBeli'),
      'Stok' => $this->input->post('Stok')
    ];

    if( !$this->m_product->addProduct($data) ){
      echo "Gagal menambah data";
    } else {
      echo "Berhasil menambah data";
    }
  }

  public function do_upload($file) {
    $config['upload_path']    = './assets/img';
    $config['allowed_types']  = 'jpg|png';
    $config['max_size']       = 100; // 100KB

    $this->load->library('upload', $config);

    // jika file gagal upload/error
    if(!$this->upload->do_upload($file)) {
      $error = $this->upload->display_errors();
      $this->responseError($error);
    }

    return $this->upload->data()['file_name'];
  }

  public function delete($id){
    // delete image first
    $foto = $this->m_product->getProduct($id);
    if($foto){
      $foto_barang = $foto[0]['FotoBarang'];
      unlink("./assets/img/$foto_barang");
    }

    if ( !$this->m_product->deleteProduct($id) ) {
      echo "Gagal menghapus data";
      return;
    }

    echo "Berhasil menghapus data";

  }

  public function edit($id){
    $this->form_validation->set_rules('NamaBarang', 'Nama', 'required');
    $this->form_validation->set_rules('HargaJual', 'Harga_Jual', 'required');
    $this->form_validation->set_rules('HargaBeli', 'Harga_Beli', 'required');
    $this->form_validation->set_rules('Stok', 'Stok', 'required');

    if( !$this->form_validation->run() ){
      $this->responseError("Harap isi form dengan benar");
    }

    $data = [
      'NamaBarang' => $this->input->post('NamaBarang'),
      'HargaJual' => $this->input->post('HargaJual'),
      'HargaBeli' => $this->input->post('HargaBeli'),
      'Stok' => $this->input->post('Stok')
    ];

    // var_dump($data); var_dump($id); die();

    if($_FILES['FotoBarang']['name']){
      $data['FotoBarang'] = $this->do_upload('FotoBarang');
    }

    if( !$this->m_product->editProduct($id, $data) ){
      echo "Gagal mengedit data";
    } else {
      echo "Berhasil mengedit data";
    }
  }

  public function responseError($message_error){
    $this->output
              ->set_status_header(400)
              ->set_output($message_error)
              ->_display();
    die();
  }
}?>
