<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cities extends MY_Controller
{

    function index()
    {
        $data['content'] = "admin/cities/list";
        $data['bcities'] = true;
        $data['title']   = "Cities";
        $this->load->view("template", $data);
    }

    function save($id = null)
    {
        if ($this->input->post()) {
            if ($this->input->post("id") == "") {
                $data = array(
                    'name' => $this->input->post('name', true),
                    'state_id' => $this->input->post('state', true),
                );
                $this->db->insert("cities", $data);
                $insert_id = $this->db->insert_id();

                if ($insert_id) {
                    $this->session->set_flashdata('msg', "City saved!");
                } else {
                    $this->session->set_flashdata('msg', "No changes saved");
                }

            } else {
                $data = array(
                    'name' => $this->input->post('name', true),
                    'city_id' => $this->input->post('city', true),
                );

                $this->db->where("id", $this->input->post("id", true));
                $this->db->update("cities", $data);
                $affected_rows = $this->db->affected_rows();

                if ($affected_rows > 0) {
                    $this->session->set_flashdata('msg', "Updated!");
                } else {
                    $this->session->set_flashdata('msg', "No changes saved");
                }
            }

            redirect("admin/cities", "refresh");

        } else {
            $data            = array();
            $data['bcities'] = true;
            if ($id) {
                $city          = $this->db->where("id", $id)->get("cities")->row_array();
                $data['city']  = $city;
                $data['title'] = "Edit City";
            }
            $data['content'] = "admin/cities/save";
            $this->load->view("template", $data);
        }
    }

    function get_cities()
    {

        $this->datatables->from("cities");
        $this->datatables->select("cities.id, cities.name, countries.name as country_name, states.name as state_name");
        $this->datatables->join("states", "states.id=cities.state_id", "left");
        $this->datatables->join("countries", "countries.id=states.country_id", "left");

        $this->datatables->add_column("Actions", '<div class="btn-group btn-group-sm"><a class="btn bg-gradient-primary" data-what="edit_city" data-modal="ajaxModal" data-title="Edit City" data-tooltip="tooltip" title="Edit" data-id="$1" href="#"> <i class="fas fa-edit"></i></a><a class="btn bg-gradient-danger" data-tooltip="tooltip" data-id="$1" title="Delete" href="admin/cities/delete/$1" onclick="return confirm(\'Are you sure you want to delete this?\');"><i class="fas fa-trash-alt"></i></a></div>', "id");

        echo $this->datatables->generate();
    }


    function delete($id)
    {
        $id = html_escape($id);
        $this->db->delete("cities", array("id" => $id));
        redirect("admin/cities");
    }

}
