<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
//        ob_start();
//        header("Access-Control-Allow-Origin: *");
//        header('Content-Type: application/json');
    }

    function index()
    {

    }


    function get_view()
    {
        if ($this->input->post()) {
            $view = $this->input->post("view");
            $html = "";

            if ($view == "add_new_bloodbank") {
                $data                = array();
                $data['title']       = "Add Blood Bank";
                $data['country_res'] = $this->db->get("countries")->result_array();
                $html                = $this->load->view("admin/bloodbanks/save_form", $data, true);
            } else if ($view == "edit_bloodbank") {
                $id                  = $this->input->post("id");
                $data                = array();
                $bloodbank           = $this->db->where("id", $id)->get("tbl_bloodbanks")->row_array();
                $data['bloodbank']   = $bloodbank;
                $data['title']       = "Edit Blood Bank";
                $data['country_res'] = $this->db->get("countries")->result_array();
                $data['states_res']  = $this->db->where("country_id", $bloodbank['country'])->get("states")->result_array();
                $data['cities_res']  = $this->db->where("state_id", $bloodbank['state'])->get("cities")->result_array();
                $html                = $this->load->view("admin/bloodbanks/save_form", $data, true);
            } else if ($view == "view_bloodbank") {
                $id                 = $this->input->post("id");
                $data               = array();
                $this->db->select("tbl_bloodbanks.*");
                $this->db->select("countries.name as country_name");
                $this->db->select("states.name as state_name");
                $this->db->select("cities.name as city_name");
                $this->db->select("concat(cities.name, ', ', states.name, ', ', countries.name) as regionData");
                $this->db->select("tbl_users.name as addedByUser");

                $this->db->join('countries', 'countries.id=tbl_bloodbanks.country', 'left');
                $this->db->join('states', 'states.id=tbl_bloodbanks.state', 'left');
                $this->db->join('cities', 'cities.id=tbl_bloodbanks.city', 'left');
                $this->db->join('tbl_users', 'tbl_users.id=tbl_bloodbanks.addedBy', 'left');

                $this->db->limit(1);
                $this->db->where("tbl_bloodbanks.id", $id);
                $q = $this->db->get("tbl_bloodbanks");

                $data['bloodbank'] = $q->row_array();

                $html                = $this->load->view("admin/bloodbanks/view", $data, true);
            } else if ($view == "add_new_blood_donor") {
                $data                = array();
                $data['title']       = "Add Blood Bank";
                $data['bg_result']   = $this->db->get("tbl_bloodgroups")->result_array();
                $data['country_res'] = $this->db->get("countries")->result_array();
                $html                = $this->load->view("admin/blooddonors/save_form", $data, true);
            } else if ($view == "edit_blooddonor") {
                $id                 = $this->input->post("id");
                $data               = array();
                $blooddonor         = $this->db->where("id", $id)->get("tbl_donors")->row_array();
                $data['blooddonor'] = $blooddonor;
                $data['title']      = "Edit Blood Donor";

                $data['bg_result']   = $this->db->get("tbl_bloodgroups")->result_array();
                $data['country_res'] = $this->db->get("countries")->result_array();
                $data['states_res']  = $this->db->where("country_id", $blooddonor['country'])->get("states")->result_array();
                $data['cities_res']  = $this->db->where("state_id", $blooddonor['state'])->get("cities")->result_array();
                $html                = $this->load->view("admin/blooddonors/save_form", $data, true);
            } else if ($view == "view_blooddonor") {
                $id                 = $this->input->post("id");
                $data               = array();
                $this->db->select("tbl_donors.*");
                $this->db->select("countries.name as country_name");
                $this->db->select("states.name as state_name");
                $this->db->select("cities.name as city_name");
                $this->db->select("concat(cities.name, ', ', states.name, ', ', countries.name) as regionData");
                $this->db->select("tbl_users.name as addedByUser");

                $this->db->join('countries', 'countries.id=tbl_donors.country', 'left');
                $this->db->join('states', 'states.id=tbl_donors.state', 'left');
                $this->db->join('cities', 'cities.id=tbl_donors.city', 'left');
                $this->db->join('tbl_users', 'tbl_users.id=tbl_donors.addedBy', 'left');

                $this->db->limit(1);
                $this->db->where("tbl_donors.id", $id);
                $q = $this->db->get("tbl_donors");

                $data['donor'] = $q->row_array();

                $html                = $this->load->view("admin/blooddonors/view", $data, true);
            } else if ($view == "add_new_blood_request") {
                $data                = array();
                $data['title']       = "Add Blood Request";
                $data['bg_result']   = $this->db->get("tbl_bloodgroups")->result_array();
                $data['country_res'] = $this->db->get("countries")->result_array();
                $html                = $this->load->view("admin/blood_requests/save_form", $data, true);
            } else if ($view == "edit_blood_request") {
                $id                    = $this->input->post("id");
                $data                  = array();
                $blood_request         = $this->db->where("id", $id)->get("tbl_blood_requests")->row_array();
                $data['blood_request'] = $blood_request;
                $data['title']         = "Edit Blood Request";

                $data['bg_result']   = $this->db->get("tbl_bloodgroups")->result_array();
                $data['country_res'] = $this->db->get("countries")->result_array();
                $data['states_res']  = $this->db->where("country_id", $blood_request['country'])->get("states")->result_array();
                $data['cities_res']  = $this->db->where("state_id", $blood_request['state'])->get("cities")->result_array();
                $html                = $this->load->view("admin/blood_requests/save_form", $data, true);
            }else if ($view == "view_blood_request") {
                $id                 = $this->input->post("id");
                $data               = array();
                $this->db->select("tbl_blood_requests.*");
                $this->db->select("countries.name as country_name");
                $this->db->select("states.name as state_name");
                $this->db->select("cities.name as city_name");
                $this->db->select("concat(cities.name, ', ', states.name, ', ', countries.name) as regionData");
                $this->db->select("tbl_users.name as addedByUser");

                $this->db->join('countries', 'countries.id=tbl_blood_requests.country', 'left');
                $this->db->join('states', 'states.id=tbl_blood_requests.state', 'left');
                $this->db->join('cities', 'cities.id=tbl_blood_requests.city', 'left');
                $this->db->join('tbl_users', 'tbl_users.id=tbl_blood_requests.addedBy', 'left');

                $this->db->limit(1);
                $this->db->where("tbl_blood_requests.id", $id);
                $q = $this->db->get("tbl_blood_requests");

                $data['request'] = $q->row_array();

                $html                = $this->load->view("admin/blood_requests/view", $data, true);
            } else if ($view == "add_new_app_user") {
                $data                = array();
                $data['title']       = "Add User";
                $data['bg_result']   = $this->db->get("tbl_bloodgroups")->result_array();
                $data['country_res'] = $this->db->get("countries")->result_array();
                $html                = $this->load->view("admin/app_users/save_form", $data, true);
            } else if ($view == "edit_user") {
                $id            = $this->input->post("id");
                $data          = array();
                $user          = $this->db->where("id", $id)->get("tbl_users")->row_array();
                $data['user']  = $user;
                $data['title'] = "Edit User";

                $data['bg_result']   = $this->db->get("tbl_bloodgroups")->result_array();
                $data['country_res'] = $this->db->get("countries")->result_array();
                $data['states_res']  = $this->db->where("country_id", $user['country'])->get("states")->result_array();
                $data['cities_res']  = $this->db->where("state_id", $user['state'])->get("cities")->result_array();
                $html                = $this->load->view("admin/app_users/save_form", $data, true);
            } else if ($view == "add_new_country") {
                $data          = array();
                $data['title'] = "Add Country";
                $html          = $this->load->view("admin/countries/save_form", $data, true);
            } else if ($view == "edit_country") {
                $id              = $this->input->post("id");
                $data            = array();
                $country         = $this->db->where("id", $id)->get("countries")->row_array();
                $data['country'] = $country;
                $data['title']   = "Edit Country";
                $html            = $this->load->view("admin/countries/save_form", $data, true);
            } else if ($view == "add_new_state") {
                $data          = array();
                $data['title'] = "Add State";
                $data['country_res'] = $this->db->get("countries")->result_array();
                $html          = $this->load->view("admin/states/save_form", $data, true);
            } else if ($view == "edit_state") {
                $id                  = $this->input->post("id");
                $data                = array();
                $state               = $this->db->where("id", $id)->get("states")->row_array();
                $data['state']       = $state;
                $data['country_res'] = $this->db->get("countries")->result_array();
                $data['title']       = "Edit State";
                $html                = $this->load->view("admin/states/save_form", $data, true);
            } else if ($view == "add_new_city") {
                $data                = array();
                $data['title']       = "Add City";
                $data['country_res'] = $this->db->get("countries")->result_array();

                $html = $this->load->view("admin/cities/save_form", $data, true);
            } else if ($view == "edit_city") {
                $id                  = $this->input->post("id");
                $data                = array();
                $city                = $this->db->where("id", $id)->get("cities")->row_array();
                $data['city']        = $city;
                $data['country_res'] = $this->db->get("countries")->result_array();
                $data['states_res']  = $this->db->where("id", $city['state_id'])->get("states")->result_array();
                $data['country_id']  = $data['states_res'][0]['country_id'];
                $data['title']       = "Edit State";
                $html                = $this->load->view("admin/cities/save_form", $data, true);
            } else if ($view == "add_new_blog") {
                $data          = array();
                $data['title'] = "Add Blog";
                $html          = $this->load->view("admin/blogs/save_form", $data, true);
            } else if ($view == "edit_blog") {
                $id              = $this->input->post("id");
                $data            = array();
                $blog         = $this->db->where("id", $id)->get("tbl_blog")->row_array();
                $data['blog'] = $blog;
                $data['title']   = "Edit Blog";
                $html            = $this->load->view("admin/blogs/save_form", $data, true);
            }else if ($view == "add_new_notification") {
                $data          = array();
                $data['title'] = "Add Notification";
                $html          = $this->load->view("admin/notifications/save_form", $data, true);
            } else if ($view == "edit_notification") {
                $id              = $this->input->post("id");
                $data            = array();
//                $notification         = $this->db->where("id", $id)->get("tbl_notification")->row_array();
//                $data['notification'] = $notification;
//                $data['title']   = "Edit Notification";
                $html            = $this->load->view("admin/notifications/save_form", $data, true);
            } else if ($view == "import_bloodbanks_excel") {
              $data                = array();
              $data['title']       = $this->input->post("title", true);
              $data['form_action'] = $this->input->post("form_action", true);
              $data['sample_file'] = $this->input->post("sample_file", true);
              $html                = $this->load->view("admin/extras/select_file", $data, true);
            } else if ($view == "import_requests_excel") {
              $data                = array();
              $data['title']       = $this->input->post("title", true);
              $data['form_action'] = $this->input->post("form_action", true);
              $data['sample_file'] = $this->input->post("sample_file", true);
              $html                = $this->load->view("admin/extras/select_file", $data, true);
            } else if ($view == "import_donors_excel") {
              $data                = array();
              $data['title']       = $this->input->post("title", true);
              $data['form_action'] = $this->input->post("form_action", true);
              $data['sample_file'] = $this->input->post("sample_file", true);
              $html                = $this->load->view("admin/extras/select_file", $data, true);
            }


          echo $html;
        }
    }

    // Fetch all countries list
    public function getCountries()
    {
        try {
            $res = $this->db->get("countries")->result();

            $countries = array();
            foreach ($res as $country) {
                $countries[$country->id] = $country->name;
            }

            $data = array(
                'status' => 'success',
                'tp' => 1,
                'msg' => "Countries fetched successfully.",
                'result' => $countries
            );
        } catch (Exception $e) {
            $data = array('status' => 'error', 'tp' => 0, 'msg' => $e->getMessage());
        } finally {
            echo json_encode($data);
        }
    }

    // Fetch all states list by country id
    public function getStates($countryId)
    {

        try {

            $res = $this->db->where("country_id", $countryId)->get("states")->result();

            $states = array();
            foreach ($res as $state) {
                $states[$state->id] = $state->name;
            }

            $data = array(
                'status' => 'success',
                'tp' => 1,
                'msg' => "States fetched successfully.",
                'result' => $states
            );

        } catch (Exception $e) {
            $data = array('status' => 'error', 'tp' => 0, 'msg' => $e->getMessage());
        } finally {
            echo json_encode($data);
        }
    }

    // Fetch all cities list by state id
    public function getCities($stateId)
    {
        try {

            $res = $this->db->where("state_id", $stateId)->get("cities")->result();

            $cities = array();
            foreach ($res as $city) {
                $cities[$city->id] = $city->name;
            }

            $data = array(
                'status' => 'success',
                'tp' => 1,
                'msg' => "Cities fetched successfully.",
                'result' => $cities
            );

        } catch (Exception $e) {
            $data = array('status' => 'error', 'tp' => 0, 'msg' => $e->getMessage());
        } finally {
            echo json_encode($data);
        }
    }
}
