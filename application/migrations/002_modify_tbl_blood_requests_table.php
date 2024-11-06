<?php

/**
 * @property CI_DB_forge dbforge
 * @property CI_DB_query_builder db
 */
class Migration_Modify_tbl_blood_requests_table extends CI_Migration
{
    public function up()
    {
        $this->db->query("ALTER TABLE `tbl_blood_requests` ADD `request_for_gender` VARCHAR(10)  NULL  DEFAULT 'male'  AFTER `hospital_name`");
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
        $this->dbforge->drop_column("tbl_blood_requests", "request_for_gender");
    }
}