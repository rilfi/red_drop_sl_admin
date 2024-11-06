<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bloodrequests extends MY_Controller
{

    function index()
    {
        $data['content'] = "admin/blood_requests/list";
        $data['brlist']  = true;
        $data['title']   = "Blood requests";
        $this->load->view("template", $data);
    }

    function save($id = null)
    {
        if ($this->input->post()) {
            if ($this->input->post("id") == "") {
                $data = array(
                    'full_name' => $this->input->post('full_name', true),
                    'mobile' => $this->input->post('mobile', true),
                    'hospital_name' => $this->input->post('hospital_name', true),
                    'no_of_bags' => $this->input->post('no_of_bags', true),
                    'blood_group' => $this->input->post('blood_group', true),
                    'message' => $this->input->post('message', true),
                    'city' => $this->input->post('city', true),
                    'state' => $this->input->post('state', true),
                    'country' => $this->input->post('country', true),
                    'location' => $this->input->post('location', true),
                    'latitude' => $this->input->post('latitude', true),
                    'longitude' => $this->input->post('longitude', true),
                    'status' => $this->input->post('status', true),
                );
                $this->db->insert("tbl_blood_requests", $data);
                $insert_id = $this->db->insert_id();

                if ($insert_id) {
                    $this->session->set_flashdata('msg', "Blood request saved!");
                } else {
                    $this->session->set_flashdata('msg', "No changes saved");
                }

            } else {
                $data = array(
                    'full_name' => $this->input->post('full_name', true),
                    'mobile' => $this->input->post('mobile', true),
                    'hospital_name' => $this->input->post('hospital_name', true),
                    'no_of_bags' => $this->input->post('no_of_bags', true),
                    'blood_group' => $this->input->post('blood_group', true),
                    'message' => $this->input->post('message', true),
                    'city' => $this->input->post('city', true),
                    'state' => $this->input->post('state', true),
                    'country' => $this->input->post('country', true),
                    'location' => $this->input->post('location', true),
                    'latitude' => $this->input->post('latitude', true),
                    'longitude' => $this->input->post('longitude', true),
                    'status' => $this->input->post('status', true),
                );

                $this->db->where("id", $this->input->post("id", true));
                $this->db->update("tbl_blood_requests", $data);
                $affected_rows = $this->db->affected_rows();

                if ($affected_rows > 0) {
                    $this->session->set_flashdata('msg', "Blood request Updated!");
                } else {
                    $this->session->set_flashdata('msg', "No changes saved");
                }
            }

            redirect("admin/bloodrequests", "refresh");

        } else {
            $data           = array();
            $data['brsave'] = true;
            if ($id) {
                $blood_request         = $this->db->where("id", $id)->get("tbl_blood_requests")->row_array();
                $data['blood_request'] = $blood_request;
                $data['title']         = "Edit Blood Bank";
                $data['country_res']   = $this->db->get("countries")->result_array();
                $data['states_res']    = $this->db->where("country_id", $blood_request['country'])->get("states")->result_array();
                $data['cities_res']    = $this->db->where("state_id", $blood_request['state'])->get("cities")->result_array();
            }
            $data['content'] = "admin/blood_requests/save";
            $this->load->view("template", $data);
        }
    }

    function get_blood_requests()
    {

        $this->datatables->select("tbl_blood_requests.id, tbl_blood_requests.full_name, tbl_blood_requests.latitude, tbl_blood_requests.longitude, tbl_blood_requests.mobile,tbl_blood_requests.blood_group,tbl_blood_requests.no_of_bags,tbl_blood_requests.date_of_birth,tbl_blood_requests.hospital_name,tbl_blood_requests.message, tbl_blood_requests.views,tbl_blood_requests.fulfilled, tbl_blood_requests.status");
        $this->datatables->select("concat(tbl_blood_requests.latitude, ', ', tbl_blood_requests.longitude) as latlon");
        $this->datatables->select("countries.name as country_name");
        $this->datatables->select("states.name as state_name");
        $this->datatables->select("cities.name as city_name");
        $this->datatables->select("concat(cities.name, ', ', states.name, ', ', countries.name) as regionData");
        $this->datatables->from('tbl_blood_requests');
        $this->datatables->join('countries', 'countries.id=tbl_blood_requests.country', 'left');
        $this->datatables->join('states', 'states.id=tbl_blood_requests.state', 'left');
        $this->datatables->join('cities', 'cities.id=tbl_blood_requests.city', 'left');

        $this->datatables->add_column("Actions",
                                      '
<div class="btn-group btn-group-sm">
<a class="btn btn-sm bg-gradient-indigo" data-what="view_blood_request" data-modal="ajaxModal" data-title="View Blood Request" data-tooltip="tooltip" title="View" data-id="$1" href="#"> <i class="fas fa-eye"></i></a>
<a class="btn btn-sm bg-gradient-primary" data-what="edit_blood_request" data-modal="ajaxModal" data-title="Edit Blood Request" data-tooltip="tooltip" title="Edit" data-id="$1" href="#"> <i class="fas fa-edit"></i></a>
<a class="btn btn-sm bg-gradient-danger" data-tooltip="tooltip" data-id="$1" title="Delete" href="admin/bloodrequests/delete/$1" onclick="return confirm(\'Are you sure you want to delete this?\');"><i class="fas fa-trash-alt"></i></a>
</div>', "id");

        echo $this->datatables->generate();
    }


  function excel_import()
  {
    $msg = "";
    if ($this->input->post('submit')) {

      if (!file_exists("uploads"))
        mkdir("uploads", 0777);

      $path            = 'uploads/';
      unset($this->my_upload);
      unset($this->upload);
      $this->my_upload = null;
      $this->upload    = null;

      $mconf['upload_path']   = $path;
      $mconf['allowed_types'] = 'xlsx|xls|csv';
      $mconf['remove_spaces'] = TRUE;

      $this->load->library('my_upload', $mconf);
      $this->my_upload->allowed = array("xlsx", "xls", "csv");

      $this->my_upload->upload($_FILES['uploadFile']);
      if (!$this->my_upload->uploaded) {
        $error = array('error' => $this->my_upload->error);
      } else {
        $upload_data['file_src_name']      = $this->my_upload->file_src_name;
        $upload_data['file_src_name_body'] = $this->my_upload->file_src_name_body;
        $upload_data['file_src_pathname']  = $this->my_upload->file_src_pathname;
        $upload_data['file_src_size']      = $this->my_upload->file_src_size;
        $upload_data['file_src_mime']      = $this->my_upload->file_src_mime;
        $upload_data['file_src_name_ext']  = $this->my_upload->file_src_name_ext;
        $this->my_upload->process("uploads");
        $upload_data['file_dst_name']      = $this->my_upload->file_dst_name;
        $upload_data['file_dst_name_body'] = $this->my_upload->file_dst_name_body;
        $upload_data['file_dst_pathname']  = $this->my_upload->file_dst_pathname;
        $upload_data['file_src_size']      = $this->my_upload->file_src_size;
        $upload_data['file_src_mime']      = $this->my_upload->file_src_mime;
        $upload_data['file_dst_name_ext']  = $this->my_upload->file_dst_name_ext;

        $data = array('upload_data' => $upload_data);
      }
      if (empty($error)) {
        if (!empty($data['upload_data']['file_dst_name'])) {
          $import_xls_file = $data['upload_data']['file_dst_name'];
        } else {
          $import_xls_file = 0;
        }
        $inputFileName = $path . $import_xls_file;

        try {
          $spreadsheet    = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);
          $allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
          $flag           = true;
          $i              = 0;

          $insertData = null;
          foreach ($allDataInSheet as $value) {
            if ($flag) {
              $flag = false;
              continue;
            }
            $insertData[$i]['full_name']     = $value['A'];
            $insertData[$i]['mobile']        = $value['B'];
            $insertData[$i]['hospital_name'] = $value['C'];
            $insertData[$i]['date_of_birth'] = $value['D'];
            $insertData[$i]['blood_group']   = $value['E'];
            $insertData[$i]['country']       = $value['F'];
            $insertData[$i]['state']         = $value['G'];
            $insertData[$i]['city']          = $value['H'];
            $insertData[$i]['no_of_bags']    = $value['I'];
            $insertData[$i]['message']       = $value['J'];
            $insertData[$i]['fulfilled']     = $value['K'];
            $insertData[$i]['status']        = $value['L'];
            $insertData[$i]['location']      = $value['M'];
            $insertData[$i]['latitude']      = $value['N'];
            $insertData[$i]['longitude']     = $value['O'];
            $i++;
          }
          $result = false;
          if ($insertData)
            $result = $this->db->insert_batch('tbl_blood_requests', $insertData);

          @unlink($inputFileName);

          if ($result) {
            $msg = "Imported successfully";
            $this->session->set_flashdata("success", $msg);
          } else {
            $msg = "ERROR !";
            $this->session->set_flashdata("error", $msg);
          }

        } catch (Exception $e) {
          $msg = ('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
            . '": ' . $e->getMessage());
          $this->session->set_flashdata("error", $msg);
        }
      } else {
        $msg = $error['error'];
        $this->session->set_flashdata("error", $msg);
      }
    }

    redirect("admin/bloodrequests");
  }

    function delete($id)
    {
        $id = html_escape($id);
        $this->db->delete("tbl_blood_requests", array("id" => $id));
        redirect("admin/bloodrequests");
    }

}
