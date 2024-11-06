<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Blooddonors extends MY_Controller
{

    function index()
    {
        $data['content'] = "admin/blooddonors/list";
        $data['bdlist']  = true;
        $data['title']   = "Blood donors";
        $this->load->view("template", $data);
    }


//    public function get_by_id($id)
//    {
//        $this->db->select("tbl_donors.*");
//        $this->db->select("countries.name as country_name");
//        $this->db->select("states.name as state_name");
//        $this->db->select("cities.name as city_name");
//        $this->db->select("concat(cities.name, ', ', states.name, ', ', countries.name) as regionData");
//
//        $this->db->join('countries', 'countries.id=tbl_donors.country', 'left');
//        $this->db->join('states', 'states.id=tbl_donors.state', 'left');
//        $this->db->join('cities', 'cities.id=tbl_donors.city', 'left');
//
//        $this->db->limit(1);
//        $this->db->where("tbl_donors.id", $id);
//        $q = $this->db->get("tbl_donors");
//
//        $data['donor']   = $q->row_array();
//        $data['success'] = $q->num_rows() > 0;
//
////        header("Content-type: application/json");
////        echo json_encode($data);
//
//        return $this->load->view("admin/blooddonors/view", $data);
//    }

    function save($id = null)
    {
        if ($this->input->post()) {
            if ($this->input->post("id") == "") {
                $data = array(
                    'full_name'        => $this->input->post('full_name', true),
                    'mobile'           => $this->input->post('mobile', true),
                    'city'             => $this->input->post('city', true),
                    'state'            => $this->input->post('state', true),
                    'country'          => $this->input->post('country', true),
                    'status'           => $this->input->post('status', true),
                    'address'          => $this->input->post('address', true),
                    'habits'           => $this->input->post('habits', true),
                    'latitude'         => $this->input->post('latitude', true),
                    'longitude'        => $this->input->post('longitude', true),
                    'date_of_birth'    => $this->input->post('date_of_birth', true),
                    'lastDonationDate' => $this->input->post('lastDonationDate', true),
                    'blood_group'      => $this->input->post('blood_group', true),
                    'gender'      => $this->input->post('gender', true),                );
                $this->db->insert("tbl_donors", $data);
                $insert_id = $this->db->insert_id();

                if ($insert_id) {
                    $this->session->set_flashdata('msg', "Donor saved!");
                } else {
                    $this->session->set_flashdata('msg', "No changes saved");
                }
            } else {
                $data = array(
                    'full_name'        => $this->input->post('full_name', true),
                    'mobile'           => $this->input->post('mobile', true),
                    'city'             => $this->input->post('city', true),
                    'state'            => $this->input->post('state', true),
                    'country'          => $this->input->post('country', true),
                    'status'           => $this->input->post('status', true),
                    'address'          => $this->input->post('address', true),
                    'habits'           => $this->input->post('habits', true),
                    'latitude'         => $this->input->post('latitude', true),
                    'longitude'        => $this->input->post('longitude', true),
                    'date_of_birth'    => $this->input->post('date_of_birth', true),
                    'lastDonationDate' => $this->input->post('lastDonationDate', true),
                    'blood_group'      => $this->input->post('blood_group', true),
                    'gender'      => $this->input->post('gender', true),
                );

                $this->db->where("id", $this->input->post("id", true));
                $this->db->update("tbl_donors", $data);
                $affected_rows = $this->db->affected_rows();

                if ($affected_rows > 0) {
                    $this->session->set_flashdata('msg', "Donor Updated!");
                } else {
                    $this->session->set_flashdata('msg', "No changes saved");
                }
            }

            redirect("admin/blooddonors", "refresh");
        } else {
            $data           = array();
            $data['bdsave'] = true;
            if ($id) {
                $blooddonor          = $this->db->where("id", $id)->get("tbl_donors")->row_array();
                $data['blooddonor']  = $blooddonor;
                $data['title']       = "Edit Blood Bank";
                $data['country_res'] = $this->db->get("countries")->result_array();
                $data['states_res']  = $this->db->where("country_id", $blooddonor['country'])->get("states")->result_array();
                $data['cities_res']  = $this->db->where("state_id", $blooddonor['state'])->get("cities")->result_array();
            }
            $data['content'] = "admin/blooddonors/save";
            $this->load->view("template", $data);
        }
    }

    function get_blooddonors()
    {
        $this->datatables->select(
            "tbl_donors.id, tbl_donors.full_name, tbl_donors.mobile, tbl_donors.views, tbl_donors.latitude, tbl_donors.longitude, tbl_donors.date_of_birth, tbl_donors.lastDonationDate, tbl_donors.status, tbl_donors.points, tbl_donors.type, upper(tbl_donors.blood_group) as blood_group"
        );
        $this->datatables->select("concat ( upper(substring(gender,1,1)), lower(right(gender,length(gender)-1))) as gender");
        $this->datatables->select("concat(tbl_donors.latitude, ', ', tbl_donors.longitude) as latlon");
        $this->datatables->select("countries.name as country_name");
        $this->datatables->select("states.name as state_name");
        $this->datatables->select("cities.name as city_name");
        $this->datatables->select("concat(cities.name, ', ', states.name, ', ', countries.name) as regionData");
        $this->datatables->from('tbl_donors');
        $this->datatables->join('countries', 'countries.id=tbl_donors.country', 'left');
        $this->datatables->join('states', 'states.id=tbl_donors.state', 'left');
        $this->datatables->join('cities', 'cities.id=tbl_donors.city', 'left');

        $this->datatables->add_column(
            "Actions",
            '
<div class="btn-group btn-group-xs">
<a class="btn btn-xs bg-gradient-indigo" data-what="view_blooddonor" data-modal="ajaxModal" data-title="View Blood Donor" data-tooltip="tooltip" title="View" data-id="$1" href="#"> <i class="fas fa-eye"></i></a>
<a class="btn btn-xs bg-gradient-primary" data-what="edit_blooddonor" data-modal="ajaxModal" data-title="Edit Blood Donor" data-tooltip="tooltip" title="Edit" data-id="$1" href="#"> <i class="fas fa-edit"></i></a>
<a class="btn btn-xs bg-gradient-danger" data-tooltip="tooltip" data-id="$1" title="Delete" href="admin/blooddonors/delete/$1" onclick="return confirm(\'Are you sure you want to delete this?\');"><i class="fas fa-trash-alt"></i></a>
</div>',
            "id"
        );

        echo $this->datatables->generate();
    }


    function excel_import()
    {
        $msg = "";
        if ($this->input->post('submit')) {
            if (!file_exists("uploads")) {
                mkdir("uploads", 0777);
            }

            $path = 'uploads/';
            unset($this->my_upload);
            unset($this->upload);
            $this->my_upload = null;
            $this->upload    = null;

            $mconf['upload_path']   = $path;
            $mconf['allowed_types'] = 'xlsx|xls|csv';
            $mconf['remove_spaces'] = true;

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
                        $insertData[$i]['full_name']        = $value['A'];
                        $insertData[$i]['mobile']           = $value['B'];
                        $insertData[$i]['address']          = $value['C'];
                        $insertData[$i]['date_of_birth']    = $value['D'];
                        $insertData[$i]['blood_group']      = $value['E'];
                        $insertData[$i]['country']          = $value['F'];
                        $insertData[$i]['state']            = $value['G'];
                        $insertData[$i]['city']             = $value['H'];
                        $insertData[$i]['habits']           = $value['I'];
                        $insertData[$i]['type']             = $value['J'];
                        $insertData[$i]['lastDonationDate'] = $value['K'];
                        $insertData[$i]['status']           = $value['L'];
                        $insertData[$i]['location']         = $value['M'];
                        $insertData[$i]['latitude']         = $value['N'];
                        $insertData[$i]['longitude']        = $value['O'];
                        $i++;
                    }
                    $result = false;
                    if ($insertData) {
                        $result = $this->db->insert_batch('tbl_donors', $insertData);
                    }

                    @unlink($inputFileName);

                    if ($result) {
                        $msg = "Imported successfully";
                        $this->session->set_flashdata("success", $msg);
                    } else {
                        $msg = "ERROR !";
                        $this->session->set_flashdata("error", $msg);
                    }
                } catch (Exception $e) {
                    $msg = ('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
                    $this->session->set_flashdata("error", $msg);
                }
            } else {
                $msg = $error['error'];
                $this->session->set_flashdata("error", $msg);
            }
        }

        redirect("admin/blooddonors");
    }


    function delete($id)
    {
        $id = html_escape($id);
        $this->db->delete("tbl_donors", array("id" => $id));
        redirect("admin/blooddonors");
    }

}
