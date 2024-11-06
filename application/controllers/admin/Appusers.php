<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Appusers extends MY_Controller
{

    function index()
    {
        $data['content'] = "admin/app_users/list";
        $data['busers']  = true;
        $data['title']   = "App Users";
        $this->load->view("template", $data);
    }

    function save($id = null)
    {
        if ($this->input->post()) {
            if ($this->input->post("id") == "") {
                $data = array(
                    'name' => $this->input->post('name', true),
                    'mobile' => $this->input->post('mobile', true),
                    'country' => $this->input->post('country', true),
                    'status' => $this->input->post('status', true),
                    'state' => $this->input->post('state', true),
                    'city' => $this->input->post('city', true),
                    'address' => $this->input->post('address', true),
                    'location' => $this->input->post('location', true),
                    'latitude' => $this->input->post('latitude', true),
                    'longitude' => $this->input->post('longitude', true),
                    'dob' => ($this->input->post('dob', true)),
                    'blood_group' => $this->input->post('blood_group', true),
                );
                $this->db->insert("tbl_users", $data);
                $insert_id = $this->db->insert_id();

                if ($insert_id) {
                    $this->session->set_flashdata('msg', "User saved!");
                } else {
                    $this->session->set_flashdata('msg', "No changes saved");
                }

            } else {
                $data = array(
                    'name' => $this->input->post('name', true),
                    'mobile' => $this->input->post('mobile', true),
                    'country' => $this->input->post('country', true),
                    'status' => $this->input->post('status', true),
                    'state' => $this->input->post('state', true),
                    'city' => $this->input->post('city', true),
                    'address' => $this->input->post('address', true),
                    'location' => $this->input->post('location', true),
                    'latitude' => $this->input->post('latitude', true),
                    'longitude' => $this->input->post('longitude', true),
                    'dob' => ($this->input->post('dob', true)),
                    'blood_group' => $this->input->post('blood_group', true),
                );

                $this->db->where("id", $this->input->post("id", true));
                $this->db->update("tbl_users", $data);
                $affected_rows = $this->db->affected_rows();

                if ($affected_rows > 0) {
                    $this->session->set_flashdata('msg', "User Updated!");
                } else {
                    $this->session->set_flashdata('msg', "No changes saved");
                }
            }

            redirect("admin/appusers", "refresh");

        } else {
            $data           = array();
            $data['busers'] = true;
            if ($id) {
                $user                = $this->db->where("id", $id)->get("tbl_users")->row_array();
                $data['user']        = $user;
                $data['title']       = "Edit User";
                $data['country_res'] = $this->db->get("countries")->result_array();
                $data['states_res']  = $this->db->where("country_id", $user['country'])->get("states")->result_array();
                $data['cities_res']  = $this->db->where("state_id", $user['state'])->get("cities")->result_array();
            }
            $data['content'] = "admin/app_users/save";
            $this->load->view("template", $data);
        }
    }

    function get_app_users()
    {
        $this->datatables->select("tbl_users.id, tbl_users.name, tbl_users.mobile, tbl_users.latitude, tbl_users.longitude, tbl_users.dob, tbl_users.status, tbl_users.blood_group");
        $this->datatables->select("DATE_FORMAT(dob, '%d-%m-%Y') as dob");
        $this->datatables->select("concat(tbl_users.latitude, ', ', tbl_users.longitude) as latlon");
        $this->datatables->select("countries.name as country_name");
        $this->datatables->select("states.name as state_name");
        $this->datatables->select("cities.name as city_name");
        $this->datatables->select("concat(cities.name, ', ', states.name, ', ', countries.name) as regionData");
        $this->datatables->from('tbl_users');
        $this->datatables->join('countries', 'countries.id=tbl_users.country', 'left');
        $this->datatables->join('states', 'states.id=tbl_users.state', 'left');
        $this->datatables->join('cities', 'cities.id=tbl_users.city', 'left');

        $this->datatables->add_column("Actions", '<div class="btn-group btn-group-sm"><a class="btn bg-gradient-primary" data-what="edit_user" data-modal="ajaxModal" data-title="Edit User" data-tooltip="tooltip" title="Edit" data-id="$1" href="#"> <i class="fas fa-edit"></i></a><a class="btn bg-gradient-danger" data-tooltip="tooltip" data-id="$1" title="Delete" href="admin/appusers/delete/$1" onclick="return confirm(\'Are you sure you want to delete this?\');"><i class="fas fa-trash-alt"></i></a></div>', "id");

        echo $this->datatables->generate();
    }


    function delete($id)
    {
        $id = html_escape($id);
        $this->db->delete("tbl_users", array("id" => $id));
        redirect("admin/appusers");
    }
}
