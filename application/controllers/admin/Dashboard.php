<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_Controller
{

  function index()
  {
    $data['content'] = "admin/dashboard";

    $data['total_blood_banks'] = $this->countTable("tbl_bloodbanks");
    $data['total_donors']      = $this->countTable("tbl_donors");
    $data['total_requests']    = $this->countTable("tbl_blood_requests");
    $data['total_users']       = $this->countTable("tbl_users");
    $data['total_cities']      = $this->countTable("cities");
    $data['total_states']      = $this->countTable("states");
    $data['total_countries']   = $this->countTable("countries");
    $data['total_blogs']       = $this->countTable("tbl_blog");
    $data['total_calls']       = $this->countTable("tbl_calls");


    $this->db->limit(10);
    $this->db->select("tbl_donors.*, cities.name as city_name");
    $this->db->join("cities", "cities.id=tbl_donors.city", "left");
    $this->db->where("tbl_donors.status", 1);
    $this->db->order_by("tbl_donors.id", "desc");
    $data['recent_donors'] = $this->db->get("tbl_donors")->result_array();


    $this->db->limit(10);
    $this->db->select("tbl_users.*, cities.name as city_name");
    $this->db->join("cities", "cities.id=tbl_users.city", "left");
    $this->db->where("tbl_users.status", 1);
    $this->db->order_by("tbl_users.id", "desc");
    $data['recent_users'] = $this->db->get("tbl_users")->result_array();


    $this->db->limit(10);
    $this->db->select("tbl_blood_requests.*, cities.name as city_name");
    $this->db->join("cities", "cities.id=tbl_blood_requests.city", "left");
    $this->db->where("tbl_blood_requests.status", 1);
    $this->db->order_by("tbl_blood_requests.id", "desc");
    $data['recent_blood_reqeusts'] = $this->db->get("tbl_blood_requests")->result_array();

    $months = array();

    $dateTime = new DateTime('first day of this month');
    for ($i = 1; $i <= 6; $i++) {

      $firstDate = $dateTime->format("d");
      $lastDate  = $dateTime->format("t");
      $year      = $dateTime->format("Y");
      $month     = $dateTime->format('m');
      $monthName = $dateTime->format('M');


      $this->db->select("count(*) as TOTAL_DONORS");
      $this->db->select("type");
      $this->db->where("created between '" . date("" . $year . "-" . $month . "-" . $firstDate) . "' and '" . date("" . $year . "-" . $month . "-" . $lastDate) . "'");
      $this->db->group_by("type");

      $months[] = array(
        "month"   => $month,
        "results" => $this->db->get("tbl_donors")->result_array(),
        "name"    => $monthName,
      );


      $dateTime->modify('-1 month');
    }
    $data['recent_donors_chart'] = array_reverse($months, "month");


    $months = array();

    $dateTime = new DateTime('first day of this month');
    for ($i = 1; $i <= 6; $i++) {

      $firstDate = $dateTime->format("d");
      $lastDate  = $dateTime->format("t");
      $year      = $dateTime->format("Y");
      $month     = $dateTime->format('m');
      $monthName = $dateTime->format('M');


      $this->db->select("count(*) as TOTAL_USERS");
      $this->db->where("created between '" . date("" . $year . "-" . $month . "-" . $firstDate) . "' and '" . date("" . $year . "-" . $month . "-" . $lastDate) . "'");

      $months[] = array(
        "month"   => $month,
        "results" => $this->db->get("tbl_users")->result_array(),
        "name"    => $monthName,
      );


      $dateTime->modify('-1 month');
    }
    $data['recent_users_chart'] = array_reverse($months, "month");

//    ewodie($data['chart_donors_data']);
    $data['bbdashboard'] = true;
    $this->load->view("template", $data);
  }


  private function countTable($table)
  {
    return $this->db->count_all($table);
  }
}
