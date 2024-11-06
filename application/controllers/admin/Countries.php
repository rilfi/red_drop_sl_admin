<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Countries extends MY_Controller
{

    function index()
    {
        $data['content']  = "admin/countries/list";
        $data['bcountry'] = true;
        $data['title']    = "Countries";
        $this->load->view("template", $data);
    }

    function save($id = null)
    {
        if ($this->input->post()) {
            if ($this->input->post("id") == "") {
                $data = array(
                    'name' => $this->input->post('name', true),
                    'short_name' => $this->input->post('short_name', true),
                    'phone_code' => $this->input->post('phone_code', true),
                );
                $this->db->insert("countries", $data);
                $insert_id = $this->db->insert_id();

                if ($insert_id) {
                    $this->session->set_flashdata('msg', "Country saved!");
                } else {
                    $this->session->set_flashdata('msg', "No changes saved");
                }

            } else {
                $data = array(
                    'name' => $this->input->post('name', true),
                    'short_name' => $this->input->post('short_name', true),
                    'phone_code' => $this->input->post('phone_code', true),
                );

                $this->db->where("id", $this->input->post("id", true));
                $this->db->update("countries", $data);
                $affected_rows = $this->db->affected_rows();

                if ($affected_rows > 0) {
                    $this->session->set_flashdata('msg', "Updated!");
                } else {
                    $this->session->set_flashdata('msg', "No changes saved");
                }
            }

            redirect("admin/countries", "refresh");

        } else {
            $data             = array();
            $data['bcountry'] = true;
            if ($id) {
                $country         = $this->db->where("id", $id)->get("countries")->row_array();
                $data['country'] = $country;
                $data['title']   = "Edit Country";
            }
            $data['content'] = "admin/countries/save";
            $this->load->view("template", $data);
        }
    }

    function get_countries()
    {

        $this->datatables->from("countries");
        $this->datatables->select("id, name, short_name, phone_code");

        $this->datatables->add_column("Actions", '<div class="btn-group btn-group-sm"><a class="btn bg-gradient-primary" data-what="edit_country" data-modal="ajaxModal" data-title="Edit Country" data-tooltip="tooltip" title="Edit" data-id="$1" href="#"> <i class="fas fa-edit"></i></a><a class="btn bg-gradient-danger" data-tooltip="tooltip" data-id="$1" title="Delete" href="admin/countries/delete/$1" onclick="return confirm(\'Are you sure you want to delete this?\');"><i class="fas fa-trash-alt"></i></a></div>', "id");

        echo $this->datatables->generate();
    }

    function delete($id)
    {
        $id = html_escape($id);

        $states   = $this->db->where("country_id", $id)->get("states")->result();
        $stateIds = array();
        foreach ($states as $state) {
            $stateIds[] = $state->id;
        }

        $this->db->where_in("state_id", $stateIds);
        $this->db->delete("cities");

        $this->db->delete("states", array("country_id" => $id));

        $this->db->delete("countries", array("id" => $id));
        redirect("admin/countries");
    }

}
