<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_product extends CI_Model{

  public function getProduct($id = NULL, $NamaBarang = NULL){
    if($id) {
      return $this->db->get_where('product', ['id' => $id])->result_array();
    }
    if($NamaBarang) {
        return $this->db->like('NamaBarang', $NamaBarang, 'both')
                        ->get('product')->result_array();
    }
    return $this->db->get('product')->result_array();
  }

  public function addProduct($data){
    $this->db->insert('product', $data);
    return $this->db->affected_rows();
  }

  public function deleteProduct($id){
    $this->db->delete('product', ['id' => $id]);
    return $this->db->affected_rows();
  }

  public function editProduct($id, $data){
    $this->db->update('product', $data, ['id' => $id]);
    return $this->db->affected_rows();
  }

}
