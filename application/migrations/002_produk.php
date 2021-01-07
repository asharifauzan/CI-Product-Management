<?php
defined('BASEPATH') OR die('No direct script access allowed');

class Migration_produk extends CI_Migration{

  public function up(){
    $this->dbforge->add_field(array(
      'id' =>
          array( 'type' => 'INT',
            'constraint' => 11,
            'unsigned' => TRUE,
            'auto_increment' => TRUE ),
      'NamaBarang' =>
          array( 'type' => 'VARCHAR',
            'constraint' => 30,
            'unique' => TRUE ),
      'FotoBarang' =>
          array( 'type' => 'varchar',
            'constraint' => 256 ),
      'HargaBeli' =>
          array( 'type' => 'INT' ),
      'HargaJual' =>
          array( 'type' => 'INT' ),
      'Stok' =>
          array( 'type' => 'INT' )
    ));
    $this->dbforge->add_key('id', TRUE);
    $this->dbforge->create_table('product', TRUE);
  }

  public function down(){
    $this->dbforge->drop_table('product');
  }

}?>
