<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bloodbanks extends MY_Controller
{

    function index()
    {
        $data['content'] = "admin/bloodbanks/list";
        $data['bblist']  = true;
        $data['title'] = "Blood banks";
        $this->load->view("template", $data);
    }

    function save($id=null)
    {
        if ($this->input->post()) {
            if ($this->input->post("id") == "") {
                $data = array(
                    'name' => $this->input->post('bb_name', true),
                    'address' => $this->input->post('bb_address', true),
                    'contact' => $this->input->post('bb_contact', true),
                    'location' => $this->input->post('location', true),
                    'latitude' => $this->input->post('latitude', true),
                    'longitude' => $this->input->post('longitude', true),
                    'city' => $this->input->post('city', true),
                    'state' => $this->input->post('state', true),
                    'country' => $this->input->post('country', true),
                    'status' => $this->input->post("status", true)
                );
                $this->db->insert("tbl_bloodbanks", $data);
                $insert_id = $this->db->insert_id();

                if ($insert_id) {
                    $this->session->set_flashdata('msg', "Blood bank saved!");
                } else {
                    $this->session->set_flashdata('msg', "No changes saved");
                }

            } else {
                $data = array(
                    'name' => $this->input->post('bb_name', true),
                    'address' => $this->input->post('bb_address', true),
                    'contact' => $this->input->post('bb_contact', true),
                    'location' => $this->input->post('location', true),
                    'latitude' => $this->input->post('latitude', true),
                    'longitude' => $this->input->post('longitude', true),
                    'city' => $this->input->post('city', true),
                    'state' => $this->input->post('state', true),
                    'country' => $this->input->post('country', true),
                    'status' => $this->input->post("status", true)
                );

                $this->db->where("id", $this->input->post("id", true));
                $this->db->update("tbl_bloodbanks", $data);
                $affected_rows = $this->db->affected_rows();

                if ($affected_rows > 0) {
                    $this->session->set_flashdata('msg', "Blood bank Updated!");
                } else {
                    $this->session->set_flashdata('msg', "No changes saved");
                }
            }

            redirect("admin/bloodbanks", "refresh");

        } else {
            $data                = array();
            $data['bbsave']  = true;
            if($id){
                $bloodbank           = $this->db->where("id", $id)->get("tbl_bloodbanks")->row_array();
                $data['bloodbank']   = $bloodbank;
                $data['title']       = "Edit Blood Bank";
                $data['country_res'] = $this->db->get("countries")->result_array();
                $data['states_res'] = $this->db->where("country_id", $bloodbank['country'])->get("states")->result_array();
                $data['cities_res'] = $this->db->where("state_id", $bloodbank['state'])->get("cities")->result_array();
            }
            $data['content'] = "admin/bloodbanks/save";
            $this->load->view("template", $data);
        }
    }

    function get_bloodbanks()
    {

        $this->datatables->select("tbl_bloodbanks.id, tbl_bloodbanks.name, tbl_bloodbanks.latitude, tbl_bloodbanks.longitude, tbl_bloodbanks.contact, tbl_bloodbanks.status");
        $this->datatables->select("concat(tbl_bloodbanks.latitude, ', ', tbl_bloodbanks.longitude) as latlon");
        $this->datatables->select("countries.name as country_name");
        $this->datatables->select("states.name as state_name");
        $this->datatables->select("cities.name as city_name");
        $this->datatables->select("concat(cities.name, ', ', states.name, ', ', countries.name) as regionData");
        $this->datatables->from('tbl_bloodbanks');
        $this->datatables->join('countries', 'countries.id=tbl_bloodbanks.country', 'left');
        $this->datatables->join('states', 'states.id=tbl_bloodbanks.state', 'left');
        $this->datatables->join('cities', 'cities.id=tbl_bloodbanks.city', 'left');

        $this->datatables->add_column("Actions", '
<div class="btn-group btn-group-xs">
<a class="btn btn-xs bg-gradient-indigo" data-what="view_bloodbank" data-modal="ajaxModal" data-title="View Blood Bank" data-tooltip="tooltip" title="View" data-id="$1" href="#"> <i class="fas fa-eye"></i></a>
<a class="btn btn-xs bg-gradient-primary" data-what="edit_bloodbank" data-modal="ajaxModal" data-title="Edit Blood Bank" data-tooltip="tooltip" title="Edit" data-id="$1" href="#"> <i class="fas fa-edit"></i></a>
<a class="btn btn-xs bg-gradient-danger" data-tooltip="tooltip" data-id="$1" title="Delete" href="admin/bloodbanks/delete/$1" onclick="return confirm(\'Are you sure you want to delete this?\');"><i class="fas fa-trash-alt"></i></a>
</div>', "id");

        echo $this->datatables->generate();
    }

  function excel_import()
  {
    $msg = "";
    if ($this->input->post('submit')) {

      if (!file_exists("uploads"))
        mkdir("uploads", 0777);

      $path = 'uploads/';
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
        $upload_data['file_src_name'] = $this->my_upload->file_src_name;
        $upload_data['file_src_name_body'] = $this->my_upload->file_src_name_body;
        $upload_data['file_src_pathname'] = $this->my_upload->file_src_pathname;
        $upload_data['file_src_size'] = $this->my_upload->file_src_size;
        $upload_data['file_src_mime'] = $this->my_upload->file_src_mime;
        $upload_data['file_src_name_ext'] = $this->my_upload->file_src_name_ext;
        $this->my_upload->process("uploads");
        $upload_data['file_dst_name'] = $this->my_upload->file_dst_name;
        $upload_data['file_dst_name_body'] = $this->my_upload->file_dst_name_body;
        $upload_data['file_dst_pathname'] = $this->my_upload->file_dst_pathname;
        $upload_data['file_src_size'] = $this->my_upload->file_src_size;
        $upload_data['file_src_mime'] = $this->my_upload->file_src_mime;
        $upload_data['file_dst_name_ext'] = $this->my_upload->file_dst_name_ext;

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
            $insertData[$i]['name']      = $value['A'];
            $insertData[$i]['country']   = $value['B'];
            $insertData[$i]['state']     = $value['C'];
            $insertData[$i]['city']      = $value['D'];
            $insertData[$i]['address']   = $value['E'];
            $insertData[$i]['contact']   = $value['F'];
            $insertData[$i]['location']  = $value['G'];
            $insertData[$i]['latitude']  = $value['H'];
            $insertData[$i]['longitude'] = $value['I'];
            $insertData[$i]['status']    = $value['J'];
            $i++;
          }
          $result = false;
          if ($insertData)
            $result = $this->db->insert_batch('tbl_bloodbanks', $insertData);

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

    redirect("admin/bloodbanks");
  }


  function delete($id)
    {
        $id = html_escape($id);
        $this->db->delete("tbl_bloodbanks", array("id" => $id));
        redirect("admin/bloodbanks");
    }

}
