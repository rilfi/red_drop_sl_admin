<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Codeigniter 3 usage for datatables of ozdemir:
//   Set config/config.app:
//   $config['composer_autoload'] = 'vendor/autoload.php';
//use Ozdemir\Datatables\Datatables;
//use Ozdemir\Datatables\DB\CodeigniterAdapter;

class Blogs extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->session->set_userdata('upload_image_file_manager', true);
    }

    function index()
    {
        $data['content'] = "admin/blogs/list";
        $data['bblogs']   = true;
        $data['title']   = "Blogs";
        $this->load->view("template", $data);
    }

    function save($id = null)
    {
        if ($this->input->post()) {
            if ($this->input->post("id") == "") {


                $blog_image = rand(0, 99999) . "_" . $_FILES['blog_image']['name'];

                if (!file_exists("images")) {
                    @mkdir("images", 0777);
                }
                if (!file_exists("images/thumb")) {
                    @mkdir("images/thumb", 0777);
                }

                //Main Image
                $tpath1 = 'images/' . $blog_image;
                $pic1   = compress_image($_FILES["blog_image"]["tmp_name"], $tpath1, 80);

                //Thumb Image
                $thumbpath = 'images/thumb/' . $blog_image;
                create_thumb_image($tpath1, $thumbpath, '200', '200');
                $content = $this->input->post('blog_content');
                $content = str_replace("'", "\'", $content);


                $today = date("Y-m-d H:i:s");
                $data  = array(
                    'blog_title' => $this->input->post('blog_title'),
                    'blog_content' => $content,
                    'posted_at' => $today,
                    'blog_image' => $blog_image,
                );


                $this->db->insert("tbl_blog", $data);
                $insert_id = $this->db->insert_id();

                if ($insert_id) {
                    $this->session->set_flashdata('msg', "Blog saved!");
                } else {
                    $this->session->set_flashdata('msg', "No changes saved");
                }

            } else {

                if ($_FILES['blog_image']['name'] != "") {

                    if (!$id)
                        $id = $this->input->post("id");
                    $prev = $this->db->where("id", $id)->get("tbl_blog")->row();

                    if ($prev->blog_image != "") {
                        @unlink('images/thumb/' . $prev->blog_image);
                        @unlink('images/' . $prev->blog_image);
                    }


                    $blog_image = rand(0, 99999) . "_" . $_FILES['blog_image']['name'];

                    if (!file_exists("images")) {
                        @mkdir("images", 0777);
                    }
                    if (!file_exists("images/thumb")) {
                        @mkdir("images/thumb", 0777);
                    }

                    //Main Image
                    $tpath1 = 'images/' . $blog_image;
                    compress_image($_FILES["blog_image"]["tmp_name"], $tpath1, 80);

                    //Thumb Image
                    $thumbpath = 'images/thumb/' . $blog_image;
                    create_thumb_image($tpath1, $thumbpath, '200', '200');
                    $content = $this->input->post('blog_content');
                    $content = str_replace("'", "\'", $content);


                    $today = date("Y-m-d H:i:s");
                    $data  = array(
                        'blog_title' => $this->input->post('blog_title'),
                        'blog_content' => $content,
                        'posted_at' => $today,
                        'blog_image' => $blog_image,
                    );


                } else {
                    $content = $this->input->post('blog_content');
                    $content = str_replace("'", "\'", $content);

                    $today = date("Y-m-d H:i:s");
                    $data  = array(
                        'blog_title' => $this->input->post('blog_title'),
                        'blog_content' => $content,
                        'posted_at' => $today,
                    );
                }

                $this->db->where("id", $this->input->post("id", true));
                $this->db->update("tbl_blog", $data);
                $affected_rows = $this->db->affected_rows();

                if ($affected_rows > 0) {
                    $this->session->set_flashdata('msg', "Updated!");
                } else {
                    $this->session->set_flashdata('msg', "No changes saved");
                }
            }

            redirect("admin/blogs", "refresh");

        } else {
            $data          = array();
            $data['bblog'] = true;
            if ($id) {
                $blog          = $this->db->where("id", $id)->get("tbl_blog")->row_array();
                $data['blog']  = $blog;
                $data['title'] = "Edit Blog";
            }
            $data['content'] = "admin/blogs/save";
            $this->load->view("template", $data);
        }
    }

    function get_blogs()
    {

        $this->datatables->from("tbl_blog");
        $this->datatables->select("id, blog_title, blog_content, blog_image, posted_at, created_at");

        $this->datatables->add_column("Actions", '<div class="btn-group btn-group-sm"><a class="btn bg-gradient-primary" data-title="Edit Blog" data-tooltip="tooltip" title="Edit" data-id="$1" href="admin/blogs/save/$1"> <i class="fas fa-edit"></i></a><a class="btn bg-gradient-danger" data-tooltip="tooltip" data-id="$1" title="Delete" href="admin/blogs/delete/$1" onclick="return confirm(\'Are you sure you want to delete this?\');"><i class="fas fa-trash-alt"></i></a></div>', "id");
//        $this->datatables->add_column("Actions", '<div class="btn-group btn-group-sm"><a class="btn bg-gradient-primary" data-what="edit_blog" data-modal-size="extra-large" data-modal="ajaxModal" data-title="Edit Blog" data-tooltip="tooltip" title="Edit" data-id="$1" href="#"> <i class="fas fa-edit"></i></a><a class="btn bg-gradient-danger" data-tooltip="tooltip" data-id="$1" title="Delete" href="admin/blogs/delete/$1" onclick="return confirm(\'Are you sure you want to delete this?\');"><i class="fas fa-trash-alt"></i></a></div>', "id");

        echo $this->datatables->generate();
    }


    function delete($id)
    {
        $id = html_escape($id);
        $prev = $this->db->where("id", $id)->get("tbl_blog")->row();

        if ($prev->blog_image != "") {
            @unlink('images/thumb/' . $prev->blog_image);
            @unlink('images/' . $prev->blog_image);
        }

        $this->db->delete("tbl_blog", array("id" => $id));
        redirect("admin/blogs");
    }

}
