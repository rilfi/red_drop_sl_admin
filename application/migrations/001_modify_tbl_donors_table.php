<?php

/**
 * @property CI_DB_forge dbforge
 * @property CI_DB_query_builder db
 */
class Migration_Modify_tbl_donors_table extends CI_Migration
{
    public function up()
    {
        $this->db->query("ALTER TABLE `tbl_donors` ADD `gender` VARCHAR(10)  NULL  DEFAULT 'male'  AFTER `blood_group`");
//        $this->dbforge->add_field(
//            array(
//                'id' => array(
//                    'type' => 'INT',
//                    'constraint' => 5,
//                    'unsigned' => true,
//                    'auto_increment' => true
//                ),
//                'name' => array(
//                    'type' => 'VARCHAR',
//                    'constraint' => '100',
//                ),
//                'email' => array(
//                    'type' => 'TEXT',
//                    'null' => true,
//                ),
//            )
//        );
//
//        $this->dbforge->add_key('id', TRUE);
//        $this->dbforge->create_table('users');
    }

    public function down()
    {
        $this->dbforge->drop_column("tbl_donors", "gender");
    }
}