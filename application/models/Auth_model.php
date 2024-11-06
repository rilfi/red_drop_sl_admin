<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_DB_query_builder db
 */
class Auth_model extends CI_Model
{

    public function login($data)
    {
        $this->db->group_start();
        $this->db->where("email", $data['email']);
        $this->db->or_where("username", $data['email']);
        $this->db->group_end();
        $this->db->limit(1);
        $query = $this->db->get("tbl_admin");
//			$query = $this->db->get_where('tbl_admin', array('email' => $data['email']));
        if ($query->num_rows() == 0) {
            return false;
        } else {
            //Compare the password attempt with the password we have stored.
            $result        = $query->row_array();
            $validPassword = md5($data['password']) == ($result['password']);

            if ($validPassword) {
                return $result = $query->row_array();
            }
        }
    }

    public function change_pwd($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('tbl_admin', $data);
        return true;
    }

}

?>