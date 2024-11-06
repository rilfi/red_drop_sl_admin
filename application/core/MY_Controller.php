<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class MY_Controller
 * @property Auth_model auth_model
 * @property SettingsModel settings_model
 * @property CI_Input input
 * @property CI_Form_validation form_validation
 * @property CI_Session session
 * @property Datatables datatables
 * @property CI_DB_mysqli_driver db
 */
class MY_Controller extends CI_Controller
{
    public $settings = null;

    public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata("admin_id")){
            redirect("auth/login", "refresh");
        }
        $this->load->model("SettingsModel", "settings_model");
        $this->settings = $this->settings_model->getSetting();
        $this->session->set_userdata('KCFINDER', array('disabled' => false, 'uploadURL' => base_url() . "/uploads"));

        $this->load->model("file_model");
        $this->load->model("upload_model");

        $global_data['images'] = $this->file_model->get_images(48);
//        $global_data['audios'] = $this->file_model->get_audios(48);
//        $global_data['videos'] = $this->file_model->get_videos(48);
//        excptn_haer();
        $this->load->vars($global_data);

    }
}