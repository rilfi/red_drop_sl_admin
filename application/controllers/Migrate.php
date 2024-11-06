<?php

/**
 * @property CI_Migration migration
 */
class Migrate extends CI_Controller
{
    public function index()
    {
        // load migration library
        $this->load->library('migration');

        if (!$this->migration->current()) {
            echo 'Error' . $this->migration->error_string();
        } else {
            redirect("auth/login");
//            echo 'Migrations ran successfully!';
        }
    }
}