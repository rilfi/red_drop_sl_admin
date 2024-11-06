<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notifications extends MY_Controller
{


    function save($id = null)
    {
        if ($this->input->post()) {

            $dataSave = array();

            if ($this->input->post('external_link') != "") {
                $external_link = $this->input->post('external_link');
            } else {
                $external_link = null;
            }

//
//            if ($this->input->post('cat_id') != 0) {
//
////                $cat_name = get_cat_name($this->input->post('cat_id'));
//                $cat_name = '';
//
//            } else {
//                $cat_name = '';
//            }


            if ($_FILES['big_picture']['name'] != "") {

                $big_picture = rand(0, 999999) . "_" . $_FILES['big_picture']['name'];
                $tpath2      = 'images/' . $big_picture;
                move_uploaded_file($_FILES["big_picture"]["tmp_name"], $tpath2);

//                $file_path = 'http://' . $_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI']) . '/images/' . $big_picture;

//                $file_path = "http://" . "192.168.43.5/" . ("images/" . $big_picture);
                $file_path = base_url("images/" . $big_picture);
                $content   = array(
                    "en" => $this->input->post('notification_msg')
                );

                $fields = array(
                    'app_id'            => $this->settings->onesignal_app_id,
                    'included_segments' => array('All'),
                    'data'              => array("foo" => "bar", "cat_id" => $this->input->post('cat_id'), "cat_name" => $cat_name, "external_link" => $external_link),
                    'headings'          => array("en" => $this->input->post('notification_title')),
                    'contents'          => $content,
                    'big_picture'       => $file_path
                );

                $dataSave['image']   = $big_picture;
                $dataSave['url']     = $external_link ? $external_link : "";
                $dataSave['title']   = $this->input->post("notification_title");
                $dataSave['message'] = $this->input->post("notification_msg");

                $fields = json_encode($fields);
//                print("\nJSON to be sent:\n");
//                print($fields);

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8', 'Authorization: Basic ' . $this->settings->onesignal_rest_key));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                curl_setopt($ch, CURLOPT_HEADER, FALSE);
                curl_setopt($ch, CURLOPT_POST, TRUE);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

                $response = curl_exec($ch);
                curl_close($ch);


            } else {


                $content = array(
                    "en" => $this->input->post('notification_msg')
                );

                $fields = array(
                    'app_id'            => $this->settings->onesignal_app_id,
                    'included_segments' => array('All'),
                    'data'              => array("foo" => "bar", "external_link" => $external_link),
                    'headings'          => array("en" => $this->input->post('notification_title')),
                    'contents'          => $content
                );

                $dataSave['image']   = null;
                $dataSave['url']     = $external_link ? $external_link : "";
                $dataSave['title']   = $this->input->post("notification_title");
                $dataSave['message'] = $this->input->post("notification_msg");


                $fields = json_encode($fields);
//                print("\nJSON to send:\n");
//                print($fields);

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json; charset=utf-8',
                    'Authorization: Basic ' . $this->settings->onesignal_rest_key
                ));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                curl_setopt($ch, CURLOPT_HEADER, FALSE);
                curl_setopt($ch, CURLOPT_POST, TRUE);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

                $response = curl_exec($ch);


                curl_close($ch);

            }

            $this->db->insert("tbl_noti", $dataSave);
            $this->session->set_flashdata("success", "Notification Sent & Saved");
//            print ("complete");


            redirect("admin/notifications", "refresh");

        } else {

            $data['content'] = "admin/notifications/save";
            $data['bnotification'] = true;
            $data['noti']   = $this->db->where("id", $id)->get("tbl_noti")->row();
            $data['title']   = "Send Notifications";
            $this->load->view("template", $data);

        }
    }

    function index($id = null)
    {

        $data                  = array();
        $data['bnotification'] = true;
        $data['title']         = "Notification";
//        if ($id) {
//            $noti          = $this->db->where("id", $id)->get("tbl_blog")->row_array();
//            $data['noti']  = $noti;
//            $data['title'] = "Resend Notiication";
//        }
        $data['content'] = "admin/notifications/list";
        $this->load->view("template", $data);

    }

    function get_notifications()
    {

        $this->datatables->from("tbl_noti");
        $this->datatables->select("id, title, message, url, image, created_at");

        // <a disabled class="btn bg-gradient-primary" data-what="resend" data-modal-size="extra-large" data-modal="ajaxModal" data-title="Resend" data-tooltip="tooltip" title="Resend" data-id="$1" href="#"> <i class="fas fa-edit"></i></a>
        $this->datatables->add_column("Actions",
            '<div class="btn-group btn-group-sm"> <a class="btn bg-gradient-danger" data-tooltip="tooltip" data-id="$1" title="Delete" href="admin/notifications/delete/$1" onclick="return confirm(\'Are you sure you want to delete this?\');"><i class="fas fa-trash-alt"></i></a></div>', "id");

        echo $this->datatables->generate();
    }

    function delete($id)
    {
        $id   = html_escape($id);
        $prev = $this->db->where("id", $id)->get("tbl_noti")->row();

        if ($prev->image != "") {
            @unlink('images/thumb/' . $prev->image);
            @unlink('images/' . $prev->image);
        }

        $this->db->delete("tbl_noti", array("id" => $id));
        redirect("admin/notifications");
    }


}
