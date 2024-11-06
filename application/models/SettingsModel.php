<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class SettingsModel extends CI_Model
{
    function getSetting($id = 1)
    {
        $this->db->where("id", $id);
        $q = $this->db->get("tbl_settings");
        return $q->row();
    }
}