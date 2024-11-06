<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Auth
 * @property Auth_model auth_model
 * @property SettingsModel settings_model
 * @property CI_Session session
 * @property CI_Input input
 * @property CI_Form_validation form_validation
 */
class Auth extends CI_Controller
{

    public $settings = null;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model', 'auth_model');
        $this->load->model("SettingsModel", "settings_model");
        $this->settings = $this->settings_model->getSetting();

    }

    public function index()
    {
        if ($this->session->has_userdata('is_admin_login')) {
            redirect('admin/dashboard');
        } else {
            redirect('auth/login');
        }
    }

    public function login()
    {

        if ($this->input->post('submit')) {

            $this->form_validation->set_rules('username', 'Username/Email', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('admin/login');
            } else {
                $data = array(
                    'email' => $this->input->post('username'),
                    'password' => $this->input->post('password')
                );

                $result = $this->auth_model->login($data);
                if ($result == TRUE) {
                    $admin_data = array(
                        'admin_id' => $result['id'],
                        'name' => $result['username'],
                        'is_admin_login' => TRUE
                    );
                    $this->session->set_userdata($admin_data);
                    redirect(('admin/dashboard'), 'refresh');
                } else {
                    $data['msg'] = 'Invalid Email or Password!';
                    $this->load->view('admin/login', $data);
                }
            }
        } else {

            $this->load->view('admin/login');
        }
    }

//    public function change_pwd()
//    {
//        $id = $this->session->userdata('admin_id');
//        if ($this->input->post('submit')) {
//            $this->form_validation->set_rules('password', 'Password', 'trim|required');
//            $this->form_validation->set_rules('confirm_pwd', 'Confirm Password', 'trim|required|matches[password]');
//            if ($this->form_validation->run() == FALSE) {
//                $data['view'] = 'admin/auth/change_pwd';
//                $this->load->view('admin/template', $data);
//            } else {
//                $data   = array(
//                    'password' => md5($this->input->post('password'))
//                );
//                $result = $this->auth_model->change_pwd($data, $id);
//                if ($result) {
//                    $this->session->set_flashdata('msg', 'Password has been changed successfully!');
//                    redirect(base_url('admin/auth/change_pwd'));
//                }
//            }
//        } else {
//            $data['view'] = 'admin/auth/change_pwd';
//            $this->load->view('admin/layout', $data);
//        }
//    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(('auth/login'), 'refresh');
    }

}