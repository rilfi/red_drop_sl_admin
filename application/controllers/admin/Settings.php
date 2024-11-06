<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Settings extends MY_Controller
{

    function index()
    {
        $data['content']  = "admin/settings/home";
        $data['bsetting'] = true;
        $data['title']    = "Settings";
        $this->load->view("template", $data);
    }

    function profile()
    {

        if ($this->input->post()) {

            if (!isDemo()) {
                if ($_FILES['image']['name'] != "") {

                    $img_res_row = $this->db->where("id", $this->session->userdata("admin_id"))->get("tbl_admin")->row_array();

                    if ($img_res_row['image'] != "") {
                        unlink('images/' . $img_res_row['image']);
                    }

                    $image  = "profile.png";
                    $pic1   = $_FILES['image']['tmp_name'];
                    $tpath1 = 'images/' . $image;

                    copy($pic1, $tpath1);

                    $data = array(
                        'username' => $this->input->post('username'),
                        'email'    => $this->input->post('email'),
                        'image'    => $image
                    );

                    if ($this->input->post("password") != "") {
                        $data['password'] = md5($this->input->post("password"));
                    }


                    $this->db->update('tbl_admin', $data, array("id" => $this->session->userdata('admin_id')));


                } else {
                    $data = array(
                        'username' => $this->input->post('username'),
                        'email'    => $this->input->post('email')
                    );

                    if ($this->input->post("password") != "") {
                        $data['password'] = md5($this->input->post("password"));
                    }


                    $this->db->update('tbl_admin', $data, array("id" => $this->session->userdata('admin_id')));
                }
            }
            redirect("admin/settings/profile", "refresh");

        } else {
            $data['user']    = $this->db->where('id', $this->session->userdata("admin_id"))->get("tbl_admin")->row_array();
            $data['title']   = "Admin Profile";
            $data['content'] = "admin/settings/profile";
            $this->load->view("template", $data);
        }
    }

    function admob_save()
    {
        if (!isDemo()) {
            $data = array(
                'publisher_id'         => $this->input->post('publisher_id', true),
                'interstital_ad'       => $this->input->post('interstital_ad', true),
                'interstital_ad_id'    => $this->input->post('interstital_ad_id', true),
                'interstital_ad_click' => $this->input->post('interstital_ad_click', true),
                'banner_ad'            => $this->input->post('banner_ad', true),
                'banner_ad_id'         => $this->input->post('banner_ad_id', true),
                //            'publisher_id_ios' => $this->input->post('publisher_id_ios', true),
                'app_id_android'       => $this->input->post('app_id_android', true),
                //            'app_id_ios' => $this->input->post('app_id_ios', true),
                //            'interstital_ad_ios' => $this->input->post('interstital_ad_ios', true),
                //            'interstital_ad_id_ios' => $this->input->post('interstital_ad_id_ios', true),
                //            'interstital_ad_click_ios' => $this->input->post('interstital_ad_click_ios', true),
                //            'banner_ad_ios' => $this->input->post('banner_ad_ios', true),
                //            'banner_ad_id_ios' => $this->input->post('banner_ad_id_ios', true)
            );


            $settings_edit = $this->db->update('tbl_settings', $data, "id=1");
        }
        redirect("admin/settings", "refresh");

//        if ($this->>$this->input->post('api_submit')) {
//
//            $data = array(
//                'home_latest_limit' => $this->>$this->input->post('home_latest_limit'),
//                'home_most_viewed_limit' => $this->>$this->input->post('home_most_viewed_limit'),
//                'home_most_rated_limit' => $this->>$this->input->post('home_most_rated_limit'),
//                'api_latest_limit' => $this->>$this->input->post('api_latest_limit'),
//                'api_cat_order_by' => $this->>$this->input->post('api_cat_order_by'),
//                'api_cat_post_order_by' => $this->>$this->input->post('api_cat_post_order_by'),
//                'api_gif_post_order_by' => $this->>$this->input->post('api_gif_post_order_by')
//            );
//
//
//            $settings_edit = Update('tbl_settings', $data, "WHERE id = '1'");
//
//
//            $_SESSION['msg'] = "11";
//            header("Location:settings.php");
//            exit;
//
//
//        }
    }

    function saveNotification()
    {
        if (!isDemo()) {
            $data = array(
                'onesignal_app_id'   => $this->input->post('onesignal_app_id', true),
                'onesignal_rest_key' => $this->input->post('onesignal_rest_key', true),
            );

            $settings_edit = $this->db->update('tbl_settings', $data, "id=1");
        }

        redirect("admin/settings", "refresh");


    }

    function save_api_keys()
    {
        if (!isDemo()) {
            $data = array(
                'google_maps_api_key' => $this->input->post('google_maps_api_key', true),
            );

            $this->db->update('tbl_settings', $data, "id=1");
        }
        redirect("admin/settings", "refresh");

    }

    function privacy_policy()
    {
        if ($this->input->post()) {

            if (!isDemo()) {
                $data = array(
                    'app_privacy_policy' => addslashes($this->input->post('app_privacy_policy'))
                );

                $this->db->update('tbl_settings', $data, "id=1");
            }
            redirect("admin/settings", "refresh");

        } else {
            $data['bsetting'] = true;
            $data['title']    = "Privacy Policy";
            $data['content']  = "admin/settings/privacy_policy";
            $this->load->view("template", $data);
        }
    }

    function save()
    {

        $img_row = $this->db->where("id", 1)->get("tbl_settings")->row_array();

        if (!isDemo()) {
            if ($_FILES['app_logo']['name'] != "") {

                unlink('images/' . $img_row['app_logo']);

                $app_logo = $_FILES['app_logo']['name'];
                $pic1     = $_FILES['app_logo']['tmp_name'];

                $tpath1 = 'images/' . $app_logo;
                copy($pic1, $tpath1);

                $data = array(

                    'app_name'         => $this->input->post('app_name', true),
                    'app_logo'         => $app_logo,
                    'app_description'  => addslashes($this->input->post('app_description')),
                    'app_version'      => $this->input->post('app_version', true),
                    'app_author'       => $this->input->post('app_author', true),
                    'app_contact'      => $this->input->post('app_contact', true),
                    'app_email'        => $this->input->post('app_email', true),
                    'app_website'      => $this->input->post('app_website', true),
                    'app_developed_by' => $this->input->post('app_developed_by', true)

                );

            } else {

                $data = array(

                    'app_name'         => $this->input->post('app_name', true),
                    'app_description'  => addslashes($this->input->post('app_description')),
                    'app_version'      => $this->input->post('app_version', true),
                    'app_author'       => $this->input->post('app_author', true),
                    'app_contact'      => $this->input->post('app_contact', true),
                    'app_email'        => $this->input->post('app_email', true),
                    'app_website'      => $this->input->post('app_website', true),
                    'app_developed_by' => $this->input->post('app_developed_by', true)

                );

            }

            $this->db->update('tbl_settings', $data, "id=1");
        }
        redirect("admin/settings", "refresh");
    }


    public function update(){
        $qry="";
        if(get_setting("db_version")){
            $qry.="ALTER TABLE `tbl_donors` ADD `gender` VARCHAR(10)  NULL  DEFAULT 'male'  AFTER `blood_group`;";
            $qry.="ALTER TABLE `tbl_blood_requests` ADD `request_for_gender` VARCHAR(10)  NULL  DEFAULT 'male'  AFTER `hospital_name`;";

        }
    }
}
