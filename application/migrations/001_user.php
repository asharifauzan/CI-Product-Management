<?php
defined('BASEPATH') OR die('No direct script access allowed');

class Migration_user extends CI_Migration{

  public function up(){
    $this->dbforge->add_field(array(
      'id' =>
      array(
        'type' => 'INT',
        'constraint' => 11,
        'unsigned' => TRUE,
        'auto_increment' => TRUE,
      ),
      'email' =>
      array(
        'type' => 'VARCHAR',
        'constraint' => 60,
      ),
      'password' =>
      array(
        'type' => 'VARCHAR',
        'constraint' => 265
      )
    ));
    $this->dbforge->add_key('id', TRUE);
    $this->dbforge->create_table('users', TRUE);
  }

  public function down(){
    $this->dbforge->drop_table('users');
  }

}?>
