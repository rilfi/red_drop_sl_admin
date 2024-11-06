<?php
defined('BASEPATH') or exit('No direct script access allowed');

class States extends MY_Controller
{

    function index()
    {
        $data['content'] = "admin/states/list";
        $data['bstates'] = true;
        $data['title']   = "States";
        $this->load->view("template", $data);
    }

    function save($id = null)
    {
        if ($this->input->post()) {
            if ($this->input->post("id") == "") {
                $data = array(
                    'name'       => $this->input->post('name', true),
                    'country_id' => $this->input->post('country', true),
                );
                $this->db->insert("states", $data);
                $insert_id = $this->db->insert_id();

                if ($insert_id) {
                    $this->session->set_flashdata('msg', "State saved!");
                } else {
                    $this->session->set_flashdata('msg', "No changes saved");
                }

            } else {
                $data = array(
                    'name'       => $this->input->post('name', true),
                    'country_id' => $this->input->post('country', true),
                );

                $this->db->where("id", $this->input->post("id", true));
                $this->db->update("states", $data);
                $affected_rows = $this->db->affected_rows();

                if ($affected_rows > 0) {
                    $this->session->set_flashdata('msg', "Updated!");
                } else {
                    $this->session->set_flashdata('msg', "No changes saved");
                }
            }

            redirect("admin/states", "refresh");

        } else {
            $data            = array();
            $data['bstates'] = true;
            if ($id) {
                $country         = $this->db->where("id", $id)->get("states")->row_array();
                $data['country'] = $country;
                $data['title']   = "Edit State";
            }
            $data['content'] = "admin/states/save";
            $this->load->view("template", $data);
        }
    }

    function get_states()
    {

        $this->datatables->from("states");
        $this->datatables->select("states.id, states.name, countries.name as country_name");
        $this->datatables->join("countries", "countries.id=states.country_id", "left");

        $this->datatables->add_column("Actions", '<div class="btn-group btn-group-sm"><a class="btn bg-gradient-primary" data-what="edit_state" data-modal="ajaxModal" data-title="Edit State" data-tooltip="tooltip" title="Edit" data-id="$1" href="#"> <i class="fas fa-edit"></i></a><a class="btn bg-gradient-danger" data-tooltip="tooltip" data-id="$1" title="Delete" href="admin/states/delete/$1" onclick="return confirm(\'Are you sure you want to delete this?\');"><i class="fas fa-trash-alt"></i></a></div>', "id");

        echo $this->datatables->generate();
    }

    function delete($id)
    {
        $id = html_escape($id);

        $this->db->delete("cities", array("state_id" => $id));
        $this->db->delete("states", array("id" => $id));

        redirect("admin/states");
    }


}
