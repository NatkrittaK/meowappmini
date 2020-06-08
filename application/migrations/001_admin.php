
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_admin extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'ID' => array(
                                'type' => 'INT',
                                'constraint' => 5,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'email' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '250',
                        ),
                        'password' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '250',
                        ),
                ));
                $this->dbforge->add_key('ID', TRUE);
                $this->dbforge->create_table('admin');

                // $this->dbforge->add_field(array(
                //         'ID' => array(
                //                 'type' => 'INT',
                //                 'constraint' => 5,
                //                 'unsigned' => TRUE,
                //                 'auto_increment' => TRUE
                //         ),
                //         'firstname' => array(
                //                 'type' => 'VARCHAR',
                //                 'constraint' => '250',
                //         ),
                //         'lastname' => array(
                //                 'type' => 'VARCHAR',
                //                 'constraint' => '250',
                //         ),
                //         'phone' => array(
                //                 'type' => 'VARCHAR',
                //                 'constraint' => '250',
                //         ),
                //         'email' => array(
                //                 'type' => 'VARCHAR',
                //                 'constraint' => '250',
                //         ),
                //         'address' => array(
                //                 'type' => 'VARCHAR',
                //                 'constraint' => '250',
                //         ),
                //         'picture' => array(
                //                 'type' => 'VARCHAR',
                //                 'constraint' => '250',
                //         ),
                //         'password' => array(
                //                 'type' => 'VARCHAR',
                //                 'constraint' => '250',
                //         ),
                // ));
                // $this->dbforge->add_key('ID', TRUE);
                // $this->dbforge->create_table('customer');
        }

        public function down()
        {
                $this->dbforge->drop_table('admin');
                // $this->dbforge->drop_table('customer');
        }
}