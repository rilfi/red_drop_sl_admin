<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_DB_mysqli_driver db
 * @property CI_Input input
 */
class Api extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        header('Content-Type: application/json; charset=utf-8');
    }

    /**
     * Getting data in splash
     */
    function index()
    {
        $jsonObj = array();

        $setting = $this->db->where("id", 1)->get("tbl_settings")->row();

        $setting->app_description = str_replace("\\\"\\\"", "''", $setting->app_description);
        $setting->app_description = str_replace("\\\"\\\"", "''", $setting->app_description);
        $setting->app_description = str_replace("\"", "'", $setting->app_description);
        $setting->app_description = str_replace("\'", "'", $setting->app_description);

        $setting->app_privacy_policy = str_replace("\\\"\\\"", "''", $setting->app_privacy_policy);
        $setting->app_privacy_policy = str_replace("\\\"\\\"", "''", $setting->app_privacy_policy);
        $setting->app_privacy_policy = str_replace("\"", "'", $setting->app_privacy_policy);
        $setting->app_privacy_policy = str_replace("\'", "'", $setting->app_privacy_policy);

        // remove this for security purposes
        $setting->app_api_key = $setting->onesignal_rest_key = $setting->onesignal_app_id = $setting->google_maps_api_key = null;


        array_push($jsonObj, $setting);

        $set['BloodBank'] = $jsonObj;

        echo $val = str_replace('\\/', '/', json_encode($set, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        die();
    }

    /**
     * Get Country, States & cities
     */
    function get_some_data()
    {
        $jsonObj = array();
        $set     = array();

        if (($this->input->post('what'))) {
            if ($this->input->post('what') == "countries") {
                $this->db->order_by("countries.name");

                $res = $this->db->get("countries")->result_array();

                foreach ($res as $data) {
                    array_push($jsonObj, $data);
                }

                $set['countries'] = $jsonObj;
            } elseif ($this->input->post('what') == "states") {
                $country_id = $this->input->post('country_id');
                $this->db->where("country_id", $country_id);
                $this->db->order_by("states.name");
                $res = $this->db->get("states")->result_array();


                foreach ($res as $data) {
                    array_push($jsonObj, $data);
                }

                $set['states'] = $jsonObj;
            } elseif ($this->input->post('what') == "cities") {
                $state_id = $this->input->post('state_id');
                $this->db->where("state_id", $state_id);
                $this->db->order_by("cities.name");

                $res = $this->db->get("cities")->result_array();

                foreach ($res as $data) {
                    array_push($jsonObj, $data);
                }

                $set['cities'] = $jsonObj;
            }
        }

        $data['List'] = $set;

        echo $val = str_replace('\\/', '/', json_encode($data, JSON_UNESCAPED_UNICODE));
        die();
    }

    /**
     * Main Activity data start
     */
    // donors home
    function home()
    {
        if ($this->input->post('user_id')) {
            $jsonObjRecent      = array();
            $jsonObjNearby      = array();
            $jsonObjPopular     = array();
            $jsonObjDonorByUser = array();
            $jsonObjBlog        = array();
            $set                = array();
            $data               = array();

            $user_id = $this->input->post('user_id');
            $lat     = $this->input->post('latitude');
            $lon     = $this->input->post('longitude');
            $radius  = $this->input->post('radius');


            $this->db->start_cache();
            $this->db->select(
                "tbl_donors.*, countries.name as country_name, states.name as state_name, cities.name as city_name, tbl_users.name as addedBy, 
                ( 3959 * ACOS( COS( RADIANS( $lat ) ) * COS( RADIANS( `tbl_donors`.`latitude` ) ) *
                COS( RADIANS( `tbl_donors`.`longitude` ) - RADIANS( $lon ) ) + SIN( RADIANS( $lat ) ) * SIN( RADIANS( `tbl_donors`.`latitude` ) ) ) ) AS distance"
            );
//            $this->db->from("tbl_donors");
            $this->db->join("tbl_users", "tbl_users.id=tbl_donors.addedBy", "left");
            $this->db->join("countries", "countries.id=tbl_donors.country", "left");
            $this->db->join("cities", "cities.id=tbl_donors.city", "left");
            $this->db->join("states", "states.id=tbl_donors.state", "left");
            $this->db->where("tbl_donors.status", 1);
//            $this->db->from("tbl_donors");
            $this->db->stop_cache();

//            $qry = "SELECT tbl_donors.*, countries.name as country_name, states.name as state_name, cities.name as city_name, tbl_users.name as addedBy,
//                ( 3959 * ACOS( COS( RADIANS( $lat ) ) * COS( RADIANS( `tbl_donors`.`latitude` ) ) *
//                COS( RADIANS( `tbl_donors`.`longitude` ) - RADIANS( $lon ) ) + SIN( RADIANS( $lat ) ) * SIN( RADIANS( `tbl_donors`.`latitude` ) ) ) ) AS distance
//                from tbl_donors
//                where tbl_donors.status=1
//                 left join tbl_users on tbl_users.id=tbl_donors.addedBy
//                 left join countries on countries.id=tbl_donors.country
//                 left join cities on cities.id=tbl_donors.city
//                 left join states on states.id=tbl_donors.state ";
//
//            $nearby_qry = $qry . " ORDER BY distance ASC limit 10";
//
//            $recent_qry = $qry . " ORDER BY tbl_donors.id DESC limit 10";
//
//            $popular_qry = $qry . " ORDER BY tbl_donors.views DESC limit 10";
//
//            $donors_by_user_qry = $qry . " where tbl_donors.addedBy=" . $user_id . " order by tbl_donors.id DESC limit 10";

            $nearby_q         = $this->db->order_by("distance", "asc")->limit(10)->get("tbl_donors");
            $recent_q         = $this->db->order_by("tbl_donors.id", "desc")->limit(10)->get("tbl_donors");
            $popular_q        = $this->db->order_by("tbl_donors.views", "desc")->limit(10)->get("tbl_donors");
            $donors_by_user_q = $this->db->where("tbl_donors.addedBy", $user_id)->order_by("tbl_donors.id", "desc")->limit(10)->get("tbl_donors");

            $this->db->flush_cache();
//            $recent_donors_res = $this->db->query($recent_qry)->result_array();

            foreach ($recent_q->result_array() as $row) {
                $row['time_ago'] = (string)time_Ago(strtotime($row['created']));

                $radius_data = $row['distance'] * 1.609344;
                $km          = round($radius_data, 1);

                $row["distance"] = (string)$km;


                $row['date_of_birth']    = date('jS M, Y', strtotime($row['date_of_birth']));
                $row['lastDonationDate'] = date('jS M, Y', strtotime($row['lastDonationDate']));
                array_push($jsonObjRecent, $row);
            }
            $set['RecentDonors'] = $jsonObjRecent;


            foreach ($nearby_q->result_array() as $row) {
                $row['time_ago'] = (string)time_Ago(strtotime($row['created']));

                $radius_data     = $row['distance'] * 1.609344;
                $km              = round($radius_data, 1);
                $row["distance"] = (string)$km;

                $row['date_of_birth']    = date('jS M, Y', strtotime($row['date_of_birth']));
                $row['lastDonationDate'] = date('jS M, Y', strtotime($row['lastDonationDate']));
                array_push($jsonObjNearby, $row);
            }
            $set['NearByDonors'] = $jsonObjNearby;


            foreach ($popular_q->result_array() as $row) {
                $row['time_ago'] = (string)time_Ago(strtotime($row['created']));

                $radius_data = $row['distance'] * 1.609344;
                $km          = round($radius_data, 1);

                $row["distance"] = (string)$km;

                $row['date_of_birth']    = date('jS M, Y', strtotime($row['date_of_birth']));
                $row['lastDonationDate'] = date('jS M, Y', strtotime($row['lastDonationDate']));
                array_push($jsonObjPopular, $row);
            }
            $set['PopularDonors'] = $jsonObjPopular;


            foreach ($donors_by_user_q->result_array() as $row) {
                $row['time_ago'] = (string)time_Ago(strtotime($row['created']));

                $radius_data     = $row['distance'] * 1.609344;
                $km              = round($radius_data, 1);
                $row["distance"] = (string)$km;

                $row['date_of_birth']    = date('jS M, Y', strtotime($row['date_of_birth']));
                $row['lastDonationDate'] = date('jS M, Y', strtotime($row['lastDonationDate']));
                array_push($jsonObjDonorByUser, $row);
            }
            $set['DonorByUser'] = $jsonObjDonorByUser;


            $blog_res = $this->db->limit(10)->order_by("id", "desc")->get("tbl_blog")->result_array();

            foreach ($blog_res as $row) {
                $row['blog_content'] = stripslashes($row['blog_content']);
                array_push($jsonObjBlog, $row);
            }
            $set['Blogs'] = $jsonObjBlog;

            $data['Home'] = $set;

            echo $val = str_replace('\\/', '/', json_encode($data, JSON_UNESCAPED_UNICODE));
            die();
        } else {
            die();
        }
    }

    // requests home
    function requests_home()
    {
        if ($this->input->post('user_id')) {
            $jsonObjRecent         = array();
            $jsonObjNearby         = array();
            $jsonObjPopular        = array();
            $jsonObjRequestsByUser = array();
            $jsonObjBlog           = array();
            $set                   = array();
            $data                  = array();

            $user_id = $this->input->post('user_id');
            $lat     = $this->input->post('latitude');
            $lon     = $this->input->post('longitude');
            $radius  = $this->input->post('radius');

            $this->db->start_cache();
            $this->db->select(
                "tbl_blood_requests.*, countries.name as country_name, states.name as state_name, cities.name as city_name, tbl_users.name as addedBy, 
                ( 3959 * ACOS( COS( RADIANS( $lat ) ) * COS( RADIANS( `tbl_blood_requests`.`latitude` ) ) *
                COS( RADIANS( `tbl_blood_requests`.`longitude` ) - RADIANS( $lon ) ) + SIN( RADIANS( $lat ) ) * SIN( RADIANS( `tbl_blood_requests`.`latitude` ) ) ) ) AS distance"
            );
            $this->db->join("tbl_users", "tbl_users.id=tbl_blood_requests.addedBy", "left");
            $this->db->join("countries", "countries.id=tbl_blood_requests.country", "left");
            $this->db->join("cities", "cities.id=tbl_blood_requests.city", "left");
            $this->db->join("states", "states.id=tbl_blood_requests.state", "left");
            $this->db->where("tbl_blood_requests.status", 1);

            $this->db->stop_cache();

//            $qry = "SELECT tbl_blood_requests.*, countries.name as country_name, states.name as state_name, cities.name as city_name, tbl_users.name as addedBy,
//                ( 3959 * ACOS( COS( RADIANS( $lat ) ) * COS( RADIANS( `tbl_blood_requests`.`latitude` ) ) *
//                COS( RADIANS( `tbl_blood_requests`.`longitude` ) - RADIANS( $lon ) ) + SIN( RADIANS( $lat ) ) * SIN( RADIANS( `tbl_blood_requests`.`latitude` ) ) ) ) AS distance
//                from tbl_blood_requests
//                where tbl_blood_requests.status=1
//                 left join tbl_users on tbl_users.id=tbl_blood_requests.addedBy
//                 left join countries on countries.id=tbl_blood_requests.country
//                 left join cities on cities.id=tbl_blood_requests.city
//                 left join states on states.id=tbl_blood_requests.state ";

//            $nearby_qry = $qry . " ORDER BY distance ASC limit 10";
//
//            $recent_qry = $qry . " ORDER BY tbl_blood_requests.id DESC limit 10";
//
//            $popular_qry = $qry . " ORDER BY tbl_blood_requests.views DESC limit 10";
//
//            $donors_by_user_qry = $qry . " where tbl_blood_requests.addedBy=" . $user_id . " order by tbl_blood_requests.id DESC limit 10";

            $nearby_q           = $this->db->order_by("distance", "asc")->limit(10)->get("tbl_blood_requests");
            $recent_q           = $this->db->order_by("tbl_blood_requests.id", "desc")->limit(10)->get("tbl_blood_requests");
            $popular_q          = $this->db->order_by("tbl_blood_requests.views", "asc")->limit(10)->get("tbl_blood_requests");
            $requests_by_user_q = $this->db->where("tbl_blood_requests.addedBy", $user_id)->order_by("tbl_blood_requests.id", "desc")->limit(10)->get("tbl_blood_requests");

            $this->db->flush_cache();
//

//            $recent_requests_res = $this->db->query($recent_qry)->result_array();
            foreach ($recent_q->result_array() as $row) {
                $row['time_ago'] = (string)time_Ago(strtotime($row['created']));

                $radius_data = $row['distance'] * 1.609344;
                $km          = round($radius_data, 1);

                $row["distance"] = (string)$km;

                $row['date_of_birth'] = date('jS M, Y', strtotime($row['date_of_birth']));
                array_push($jsonObjRecent, $row);
            }
            $set['RecentRequests'] = $jsonObjRecent;


//            $nearby_requests_res = $this->db->query($nearby_qry)->result_array();
            foreach ($nearby_q->result_array() as $row) {
                $row['time_ago'] = (string)time_Ago(strtotime($row['created']));

                $radius_data     = $row['distance'] * 1.609344;
                $km              = round($radius_data, 1);
                $row["distance"] = (string)$km;

                $row['date_of_birth'] = date('jS M, Y', strtotime($row['date_of_birth']));
                array_push($jsonObjNearby, $row);
            }
            $set['NearByRequests'] = $jsonObjNearby;


//            $popular_requests_res = $this->db->query($popular_qry)->result_array();
            foreach ($popular_q->result_array() as $row) {
                $row['time_ago'] = (string)time_Ago(strtotime($row['created']));

                $radius_data = $row['distance'] * 1.609344;
                $km          = round($radius_data, 1);

                $row["distance"] = (string)$km;

                $row['date_of_birth'] = date('jS M, Y', strtotime($row['date_of_birth']));
                array_push($jsonObjPopular, $row);
            }
            $set['PopularRequests'] = $jsonObjPopular;

//            $requests_by_user_res = $this->db->query($requests_by_user_qry)->result_array();

            foreach ($requests_by_user_q->result_array() as $row) {
                $row['time_ago'] = (string)time_Ago(strtotime($row['created']));

                $radius_data     = $row['distance'] * 1.609344;
                $km              = round($radius_data, 1);
                $row["distance"] = (string)$km;

                $row['date_of_birth'] = date('jS M, Y', strtotime($row['date_of_birth']));
                array_push($jsonObjRequestsByUser, $row);
            }
            $set['RequestsByUser'] = $jsonObjRequestsByUser;


            $data['Home'] = $set;

            echo $val = str_replace('\\/', '/', json_encode($data, JSON_UNESCAPED_UNICODE));
            die();
        } else {
            die();
        }
    }

    // blood banks home
    function blood_banks_home()
    {
        if ($this->input->post()) {
            $jsonObjRecent         = array();
            $jsonObjNearby         = array();
            $jsonObjPopular        = array();
            $jsonObjRequestsByUser = array();
            $jsonObjBlog           = array();
            $set                   = array();
            $data                  = array();

            $lat    = $this->input->post('latitude');
            $lon    = $this->input->post('longitude');
            $radius = $this->input->post('radius');

            $this->db->start_cache();
            $this->db->select(
                "tbl_bloodbanks.*, countries.name as country_name, states.name as state_name, cities.name as city_name, 
                ( 3959 * ACOS( COS( RADIANS( $lat ) ) * COS( RADIANS( `tbl_bloodbanks`.`latitude` ) ) *
                COS( RADIANS( `tbl_bloodbanks`.`longitude` ) - RADIANS( $lon ) ) + SIN( RADIANS( $lat ) ) * SIN( RADIANS( `tbl_bloodbanks`.`latitude` ) ) ) ) AS distance"
            );
            $this->db->join("countries", "countries.id=tbl_bloodbanks.country", "left");
            $this->db->join("cities", "cities.id=tbl_bloodbanks.city", "left");
            $this->db->join("states", "states.id=tbl_bloodbanks.state", "left");
            $this->db->where("tbl_bloodbanks.status", 1);

            $this->db->stop_cache();

            $nearby_q  = $this->db->order_by("distance", "asc")->limit(10)->get("tbl_bloodbanks");
            $recent_q  = $this->db->order_by("tbl_bloodbanks.id", "desc")->limit(10)->get("tbl_bloodbanks");
            $popular_q = $this->db->order_by("tbl_bloodbanks.views", "desc")->limit(10)->get("tbl_bloodbanks");

            $this->db->flush_cache();
//


            foreach ($recent_q->result_array() as $row) {
                $row['time_ago'] = (string)time_Ago(strtotime($row['created']));

                $radius_data = $row['distance'] * 1.609344;
                $km          = round($radius_data, 1);

                $row["distance"] = (string)$km;

                array_push($jsonObjRecent, $row);
            }

            $set['RecentBloodBanks'] = $jsonObjRecent;


            foreach ($nearby_q->result_array() as $row) {
                $row['time_ago'] = (string)time_Ago(strtotime($row['created']));

                $radius_data     = $row['distance'] * 1.609344;
                $km              = round($radius_data, 1);
                $row["distance"] = (string)$km;

                array_push($jsonObjNearby, $row);
            }
            $set['NearByBloodBanks'] = $jsonObjNearby;


            foreach ($popular_q->result_array() as $row) {
                $row['time_ago'] = (string)time_Ago(strtotime($row['created']));

                $radius_data = $row['distance'] * 1.609344;
                $km          = round($radius_data, 1);

                $row["distance"] = (string)$km;

                array_push($jsonObjPopular, $row);
            }
            $set['PopularBloodBanks'] = $jsonObjPopular;


            $data['Home'] = $set;

            echo $val = str_replace('\\/', '/', json_encode($data, JSON_UNESCAPED_UNICODE));
            die();
        } else {
            die();
        }
    }

    // get all blog posts
    function blog_posts()
    {
        $jsonObj = array();

        $this->db->order_by("id", "desc");

        $blog_res = $this->db->get("tbl_blog")->result_array();
        foreach ($blog_res as $data) {
            $data['title']        = limit_text($data['blog_title'], 7);
            $data['content']      = limit_text($data['blog_content'], 12);
            $data['blog_content'] = stripslashes($data['blog_content']);

            array_push($jsonObj, $data);
        }

        $set['Blogs'] = $jsonObj;


        echo $val = str_replace('\\/', '/', json_encode($set, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        die();
    }

    // added by user data
    function profile_data()
    {
        $jsonObj = array();
        $set     = array();

        if (($this->input->post('addedBy'))) {
            $lat     = $this->input->post('latitude');
            $lon     = $this->input->post('longitude');
            $addedBy = $this->input->post('addedBy');


            $this->db->select("tbl_donors.*, countries.name as country_name, states.name as state_name, cities.name as city_name, tbl_users.name as addedBy");
            $this->db->select(
                "( 3959 * ACOS( COS( RADIANS( $lat ) ) * COS( RADIANS( `tbl_donors`.`latitude` ) ) *
                    COS( RADIANS( `tbl_donors`.`longitude` ) - RADIANS( $lon ) ) + SIN( RADIANS( $lat ) ) * SIN( RADIANS( `tbl_donors`.`latitude` ) ) ) ) AS distance"
            );
            $this->db->join("tbl_users", "tbl_users.id=tbl_donors.addedBy", "left");
            $this->db->join("countries", "countries.id=tbl_donors.country", "left");
            $this->db->join("cities", "cities.id=tbl_donors.city", "left");
            $this->db->join("states", "states.id=tbl_donors.state", "left");
            $this->db->where("tbl_donors.addedBy", $addedBy);


            $sql = $this->db->get("tbl_donors")->result_array();

            foreach ($sql as $data) {
                $data['time_ago'] = (string)time_Ago(strtotime($data['created']));

                $radius_data = $data['distance'] * 1.609344;
                $km          = round($radius_data, 1);

                $data["distance"] = (string)$km;

                $data['date_of_birth']    = date('jS M, Y', strtotime($data['date_of_birth']));
                $data['lastDonationDate'] = date('jS M, Y', strtotime($data['lastDonationDate']));

                array_push($jsonObj, $data);
            }

            $set['Donors'] = $jsonObj;

            $jsonObj = array();

            $this->db->select("tbl_blood_requests.*, countries.name as country_name, states.name as state_name, cities.name as city_name, tbl_users.name as addedBy");
            $this->db->select(
                "( 3959 * ACOS( COS( RADIANS( $lat ) ) * COS( RADIANS( `tbl_blood_requests`.`latitude` ) ) *
                COS( RADIANS( `tbl_blood_requests`.`longitude` ) - RADIANS( $lon ) ) + SIN( RADIANS( $lat ) ) * SIN( RADIANS( `tbl_blood_requests`.`latitude` ) ) ) ) AS distance"
            );
            $this->db->join("tbl_users", "tbl_users.id=tbl_blood_requests.addedBy", "left");
            $this->db->join("countries", "countries.id=tbl_blood_requests.country", "left");
            $this->db->join("cities", "cities.id=tbl_blood_requests.city", "left");
            $this->db->join("states", "states.id=tbl_blood_requests.state", "left");
            $this->db->where("tbl_blood_requests.addedBy", $addedBy);


            $sql = $this->db->get("tbl_blood_requests")->result_array();

            foreach ($sql as $data) {
                $data['time_ago'] = (string)time_Ago(strtotime($data['created']));

                $radius_data = $data['distance'] * 1.609344;
                $km          = round($radius_data, 1);

                $data["distance"] = (string)$km;

                $data['date_of_birth'] = date('jS M, Y', strtotime($data['date_of_birth']));

                array_push($jsonObj, $data);
            }

            $set['Requests'] = $jsonObj;
        }


        $data['List'] = $set;

        echo $val = str_replace('\\/', '/', json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        die();
    }

    /**
     * Main Activity data end
     */

    /**
     * Search or Filter data start
     */
    // search donors by filter
    function donors_by_filter()
    {
        $jsonObjRecent = array();

        if (($this->input->post())) {
            $blood_group = $this->input->post('blood_group');
            $start_limit = $this->input->post('start_limit');
            $end_limit   = $this->input->post('end_limit');
            $lat         = $this->input->post('latitude');
            $lon         = $this->input->post('longitude');
            $radius      = $this->input->post('radius');
            $order_by    = $this->input->post('order_by');
            $city        = $this->input->post('city');
            $state       = $this->input->post('state');
            $country     = $this->input->post('country');
            $added_by    = $this->input->post('added_by');
            $donor_type  = $this->input->post('donor_type');


            $this->db->select(
                "tbl_donors.*, countries.name as country_name, states.name as state_name, cities.name as city_name, tbl_users.name as addedBy, 
                ( 3959 * ACOS( COS( RADIANS( $lat ) ) * COS( RADIANS( `tbl_donors`.`latitude` ) ) *
                COS( RADIANS( `tbl_donors`.`longitude` ) - RADIANS( $lon ) ) + SIN( RADIANS( $lat ) ) * SIN( RADIANS( `tbl_donors`.`latitude` ) ) ) ) AS distance"
            );
//            $this->db->from("tbl_donors");
            $this->db->join("tbl_users", "tbl_users.id=tbl_donors.addedBy", "left");
            $this->db->join("countries", "countries.id=tbl_donors.country", "left");
            $this->db->join("cities", "cities.id=tbl_donors.city", "left");
            $this->db->join("states", "states.id=tbl_donors.state", "left");

//      $donors_qry = "SELECT tbl_donors.*, countries.name as country_name, states.name as state_name, cities.name as city_name, tbl_users.name as addedBy,
//                    ( 3959 * ACOS( COS( RADIANS( $lat ) ) * COS( RADIANS( `tbl_donors`.`latitude` ) ) *
//                    COS( RADIANS( `tbl_donors`.`longitude` ) - RADIANS( $lon ) ) + SIN( RADIANS( $lat ) ) * SIN( RADIANS( `tbl_donors`.`latitude` ) ) ) ) AS distance
//                    from tbl_donors
//                    where tbl_donors.status=1
//                    left join tbl_users on tbl_users.id=tbl_donors.addedBy
//                    left join countries on countries.id=tbl_donors.country
//                    left join cities on cities.id=tbl_donors.city
//                    left join states on states.id=tbl_donors.state ";

            $is_where = false;
            if ($blood_group != "") {
                $this->db->where("tbl_donors.blood_group", $blood_group);
            }
            if ($country != "") {
                $this->db->where("tbl_donors.country", $country);
            }
            if ($state != "") {
                $this->db->where("tbl_donors.state", $state);
            }
            if ($city != "") {
                $this->db->where("tbl_donors.city", $city);
            }
            if ($donor_type != "") {
                $this->db->where("tbl_donors.type", $donor_type);
            }
            if ($added_by != "") {
                $this->db->where("tbl_donors.addedBy", $added_by);
            } else {
                $this->db->where("tbl_donors.status", 1);
            }


            if ($order_by == "a-z" || $order_by == "A-Z") {
                $this->db->order_by("tbl_donors.full_name", "ASC");
            } elseif ($order_by == "z-a" || $order_by == "Z-A") {
                $this->db->order_by("tbl_donors.full_name", "DESC");
            } elseif ($order_by == "nearby") {
                $this->db->order_by("distance", "ASC");
            } elseif ($order_by == "recent") {
                $this->db->order_by("tbl_donors.id", "desc");
            } elseif ($order_by == "popular") {
                $this->db->order_by("tbl_donors.views", "desc");
            }


            $this->db->limit($end_limit, $start_limit);

//      die(print_r($this->input->post()));
            $recent_donors_res = $this->db->get("tbl_donors")->result_array();
//      die(print_r($this->db->last_query()));
            foreach ($recent_donors_res as $data) {
                $data['time_ago'] = (string)time_Ago(strtotime($data['created']));

                $radius_data = $data['distance'] * 1.609344;
                $km          = round($radius_data, 1);

                $data["distance"] = (string)$km;


                $data['date_of_birth_simple']   = date("d/m/Y", strtotime($data['date_of_birth']));
                $data['date_of_birth']          = date('jS M, Y', strtotime($data['date_of_birth']));
                $data['lastDonationDateSimple'] = date("d/m/Y", strtotime($data['lastDonationDate']));
                $data['lastDonationDate']       = date('jS M, Y', strtotime($data['lastDonationDate']));


                if ($radius != "none" && $radius != 0) {
                    if ($km <= $radius) {
                        $put_data = true;
                    } else {
                        $put_data = false;
                    }
                } else {
                    $put_data = true;
                }
                if ($put_data) {
                    array_push($jsonObjRecent, $data);
                }
            }
            $set['Donors'] = $jsonObjRecent;

            $data['List'] = $set;


            echo $val = str_replace('\\/', '/', json_encode($data, JSON_UNESCAPED_UNICODE));
            die();
        } else {
            die();
        }
    }

    // search requests by filter
    function requests_by_filter()
    {
        $jsonObjRecent = array();

        if (($this->input->post())) {
            $blood_group = $this->input->post('blood_group');
            $start_limit = $this->input->post('start_limit');
            $end_limit   = $this->input->post('end_limit');
            $lat         = $this->input->post('latitude');
            $lon         = $this->input->post('longitude');
            $radius      = $this->input->post('radius');
            $order_by    = $this->input->post('order_by');
            $city        = $this->input->post('city');
            $state       = $this->input->post('state');
            $country     = $this->input->post('country');
            $added_by    = $this->input->post('added_by');


            $this->db->select("tbl_blood_requests.*, countries.name as country_name, states.name as state_name, cities.name as city_name, tbl_users.name as addedBy");
            $this->db->select(
                "( 3959 * ACOS( COS( RADIANS( $lat ) ) * COS( RADIANS( `tbl_blood_requests`.`latitude` ) ) *
                COS( RADIANS( `tbl_blood_requests`.`longitude` ) - RADIANS( $lon ) ) + SIN( RADIANS( $lat ) ) * SIN( RADIANS( `tbl_blood_requests`.`latitude` ) ) ) ) AS distance"
            );

            $this->db->join("tbl_users", "tbl_users.id=tbl_blood_requests.addedBy", "left");
            $this->db->join("countries", "countries.id=tbl_blood_requests.country", "left");
            $this->db->join("cities", "cities.id=tbl_blood_requests.city", "left");
            $this->db->join("states", "states.id=tbl_blood_requests.state", "left");


            $is_where = false;
            if ($blood_group != "") {
                $this->db->where("tbl_blood_requests.blood_group", $blood_group);
            }

            if ($country != "") {
                $this->db->where("tbl_blood_requests.country", $country);
            }
            if ($state != "") {
                $this->db->where("tbl_blood_requests.state", $state);
            }
            if ($city != "") {
                $this->db->where("tbl_blood_requests.city", $city);
            }
            if ($added_by != "") {
                $this->db->where("tbl_blood_requests.addedBy", $added_by);
            } else {
                $this->db->where("tbl_blood_requests.status", 1);
                $this->db->where("tbl_blood_requests.fulfilled", 0);
            }


            if ($order_by == "a-z" || $order_by == "A-Z") {
                $this->db->order_by("tbl_blood_requests.full_name", "ASC");
            } elseif ($order_by == "z-a" || $order_by == "Z-A") {
                $this->db->order_by("tbl_blood_requests.full_name", "DESC");
            } elseif ($order_by == "nearby") {
                $this->db->order_by("distance", "asc");
            } elseif ($order_by == "recent") {
                $this->db->order_by("tbl_blood_requests.id", "desc");
            } elseif ($order_by == "popular") {
                $this->db->order_by("tbl_blood_requests.views", "desc");
            }

            $this->db->limit($end_limit, $start_limit);

            $requests_qry = $this->db->get("tbl_blood_requests")->result_array();
            foreach ($requests_qry as $request) {
                $request['time_ago'] = (string)time_Ago(strtotime($request['created']));

                $radius_data = $request['distance'] * 1.609344;
                $km          = round($radius_data, 1);

                $request["distance"] = (string)$km;

                $request['date_of_birth_simple'] = date("d/m/Y", strtotime($request['date_of_birth']));

                $request['date_of_birth'] = date('jS M, Y', strtotime($request['date_of_birth']));


                $put_data = true;

                if ($radius != "none" && $radius != 0) {
                    if ($km <= $radius) {
                        $put_data = true;
                    } else {
                        $put_data = false;
                    }
                } else {
                    $put_data = true;
                }
                if ($put_data) {
                    array_push($jsonObjRecent, $request);
                }
            }
            $set['Requests'] = $jsonObjRecent;

            $data['List'] = $set;

            echo $val = str_replace('\\/', '/', json_encode($data, JSON_UNESCAPED_UNICODE));
            die();
        } else {
            die();
        }
    }

    // search blood banks by filter
    function blood_banks_by_filter()
    {
        $jsonObjRecent = array();

        if (($this->input->post())) {
            $start_limit = $this->input->post('start_limit');
            $end_limit   = $this->input->post('end_limit');
            $lat         = $this->input->post('latitude');
            $lon         = $this->input->post('longitude');
            $radius      = $this->input->post('radius');
            $order_by    = $this->input->post('order_by');
            $city        = $this->input->post('city');
            $state       = $this->input->post('state');
            $country     = $this->input->post('country');


            $this->db->select("tbl_bloodbanks.*, countries.name as country_name, states.name as state_name, cities.name as city_name");
            $this->db->select(
                "( 3959 * ACOS( COS( RADIANS( $lat ) ) * COS( RADIANS( `tbl_bloodbanks`.`latitude` ) ) *
                COS( RADIANS( `tbl_bloodbanks`.`longitude` ) - RADIANS( $lon ) ) + SIN( RADIANS( $lat ) ) * SIN( RADIANS( `tbl_bloodbanks`.`latitude` ) ) ) ) AS distance"
            );
            $this->db->from("tbl_bloodbanks");

            $this->db->join("countries", "countries.id=tbl_bloodbanks.country", "left");
            $this->db->join("cities", "cities.id=tbl_bloodbanks.city", "left");
            $this->db->join("states", "states.id=tbl_bloodbanks.state", "left");

            $this->db->where("tbl_bloodbanks.status", 1);


            if ($country != "") {
                $this->db->where("tbl_bloodbanks.country", $country);
            }
            if ($state != "") {
                $this->db->where("tbl_bloodbanks.state", $state);
            }
            if ($city != "") {
                $this->db->where("tbl_bloodbanks.city", $city);
            }

            if ($order_by == "a-z" || $order_by == "A-Z") {
                $this->db->order_by("tbl_bloodbanks.name", "ASC");
            } elseif ($order_by == "z-a" || $order_by == "Z-A") {
                $this->db->order_by("tbl_bloodbanks.name", "DESC");
            } elseif ($order_by == "nearby") {
                $this->db->order_by("distance", "ASC");
            } elseif ($order_by == "recent") {
                $this->db->order_by("tbl_bloodbanks.id", "desc");
            } elseif ($order_by == "popular") {
                $this->db->order_by("tbl_bloodbanks.views", "desc");
            }

            $this->db->limit($end_limit, $start_limit);

            $requests_qry = $this->db->get()->result_array();
            foreach ($requests_qry as $data) {
                $data['time_ago'] = (string)time_Ago(strtotime($data['created']));

                $radius_data = $data['distance'] * 1.609344;
                $km          = round($radius_data, 1);

                $data["distance"] = (string)$km;


                $put_data = true;

                if ($radius != "none" && $radius != 0) {
                    if ($km <= $radius) {
                        $put_data = true;
                    } else {
                        $put_data = false;
                    }
                } else {
                    $put_data = true;
                }
                if ($put_data) {
                    array_push($jsonObjRecent, $data);
                }
            }
            $set['BloodBanks'] = $jsonObjRecent;

            $data['List'] = $set;

            echo $val = str_replace('\\/', '/', json_encode($data, JSON_UNESCAPED_UNICODE));
            die();
        } else {
            die();
        }
    }

    /**
     * Search or Filter data end
     */

    /**
     * Add / Edit Donors Start
     */
    // add a new donor
    function add_donor()
    {
        $jsonObj = array();
        if (($this->input->post('full_name')) && ($this->input->post('mobile')) && ($this->input->post('city')) && ($this->input->post('address')) && ($this->input->post('date_of_birth')) && ($this->input->post('blood_group')) && ($this->input->post(
                'country'
            )) && ($this->input->post('state')) && ($this->input->post('lastDonationDate'))) {
            $fname            = $this->input->post('full_name');
            $mobile           = $this->input->post('mobile');
            $city             = $this->input->post('city');
            $address          = $this->input->post('address');
            $dob              = $this->input->post('date_of_birth');
            $bgroup           = $this->input->post('blood_group');
            $country          = $this->input->post('country');
            $state            = $this->input->post('state');
            $habits           = $this->input->post('habits');
            $lastDonationDate = $this->input->post('lastDonationDate');
            $added_by         = $this->input->post('addedBy');
            $latitude         = $this->input->post('latitude');
            $longitude        = $this->input->post('longitude');
            $donor_type       = $this->input->post('donor_type');

            $bb_data  = array(
                'full_name'        => $fname,
                'mobile'           => $mobile,
                'address'          => $address,
                'city'             => $city,
                'state'            => $state,
                'country'          => $country,
                'habits'           => $habits,
                'type'             => $donor_type,
                'lastDonationDate' => $lastDonationDate,
                'date_of_birth'    => $dob,
                'blood_group'      => $bgroup,
                'latitude'         => $latitude,
                'longitude'        => $longitude,
                'addedBy'          => $added_by,
            );
            $qrr      = $this->db->insert('tbl_donors', $bb_data);
            $affected = $this->db->affected_rows();
            if ($affected == 1) {
                $row['success'] = true;
            } else {
                $row['success'] = false;
            }
            array_push($jsonObj, $row);
        }
        $set['BloodBank'] = $jsonObj;

        die(str_replace('\\/', '/', json_encode($set, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)));
    }

    // edit a donor
    function edit_donor()
    {
        $jsonObj = array();
        if (($this->input->post('id')) && ($this->input->post('full_name')) && ($this->input->post('mobile')) && ($this->input->post('city')) && ($this->input->post('address')) && ($this->input->post('date_of_birth')) && ($this->input->post(
                'blood_group'
            )) && ($this->input->post('country')) && ($this->input->post('state')) && ($this->input->post('lastDonationDate'))) {
            $id               = $this->input->post('id');
            $fname            = $this->input->post('full_name');
            $mobile           = $this->input->post('mobile');
            $city             = $this->input->post('city');
            $address          = $this->input->post('address');
            $dob              = $this->input->post('date_of_birth');
            $bgroup           = $this->input->post('blood_group');
            $country          = $this->input->post('country');
            $state            = $this->input->post('state');
            $habits           = $this->input->post('habits');
            $lastDonationDate = $this->input->post('lastDonationDate');
            $added_by         = $this->input->post('addedBy');
            $latitude         = $this->input->post('latitude');
            $longitude        = $this->input->post('longitude');
            $donor_type       = $this->input->post('donor_type');

            $bb_data = array(
                'full_name'        => $fname,
                'mobile'           => $mobile,
                'address'          => $address,
                'city'             => $city,
                'state'            => $state,
                'country'          => $country,
                'habits'           => $habits,
                'type'             => $donor_type,
                'lastDonationDate' => $lastDonationDate,
                'date_of_birth'    => $dob,
                'blood_group'      => $bgroup,
                'latitude'         => $latitude,
                'longitude'        => $longitude,
                'addedBy'          => $added_by,
            );
            $qrr     = $this->db->update('tbl_donors', $bb_data, "id=" . $id);

            $affected = $this->db->affected_rows();
            if ($affected == 1) {
                $row['success'] = true;
            } else {
                $row['success'] = false;
            }
            array_push($jsonObj, $row);
        }
        $set['BloodBank'] = $jsonObj;

        die(str_replace('\\/', '/', json_encode($set, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)));
    }

    /**
     * Add / Edit Donors end
     */

    /**
     * Add / Edit blood requests start
     */
    // add a blood request
    function add_blood_request()
    {
        $jsonObj = array();

        if (($this->input->post('full_name')) && ($this->input->post('mobile')) && ($this->input->post('city')) && ($this->input->post('hospitalAddress')) && ($this->input->post('no_of_bags')) && ($this->input->post('blood_group'))) {
            $fname     = $this->input->post('full_name');
            $mobile    = $this->input->post('mobile');
            $city      = $this->input->post('city');
            $state     = $this->input->post('state');
            $country   = $this->input->post('country');
            $latitude  = $this->input->post('latitude');
            $longitude = $this->input->post('longitude');
            $hospital  = $this->input->post('hospitalAddress');
            $noOfBags  = $this->input->post('no_of_bags');
            $dob       = $this->input->post('date_of_birth');
            $bgroup    = $this->input->post('blood_group');
            $msg       = $this->input->post('message');
            $addedBy   = $this->input->post('addedBy');

            $bb_data = array(
                'full_name'     => $fname,
                'mobile'        => $mobile,
                'city'          => $city,
                'state'         => $state,
                'country'       => $country,
                'latitude'      => $latitude,
                'longitude'     => $longitude,
                'hospital_name' => $hospital,
                'no_of_bags'    => $noOfBags,
                'blood_group'   => $bgroup,
                'date_of_birth' => $dob,
                'message'       => $msg,
                'addedBy'       => $addedBy,
            );

            $qrr = $this->db->insert('tbl_blood_requests', $bb_data);

            $insert_id = $this->db->insert_id();

            if ($insert_id) {
                $row['success'] = true;
            } else {
                $row['success'] = false;
            }

            array_push($jsonObj, $row);
        }

        $set['BloodBank'] = $jsonObj;


        echo $val = str_replace('\\/', '/', json_encode($set, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        die();
    }

    // edit blood request
    function edit_blood_request()
    {
        $jsonObj = array();

        if (($this->input->post('full_name')) && ($this->input->post('id')) && ($this->input->post('mobile')) && ($this->input->post('city')) && ($this->input->post('hospitalAddress')) && ($this->input->post('no_of_bags')) && ($this->input->post(
                'blood_group'
            ))) {
            $id        = $this->input->post('id');
            $fname     = $this->input->post('full_name');
            $mobile    = $this->input->post('mobile');
            $city      = $this->input->post('city');
            $state     = $this->input->post('state');
            $country   = $this->input->post('country');
            $latitude  = $this->input->post('latitude');
            $longitude = $this->input->post('longitude');
            $hospital  = $this->input->post('hospitalAddress');
            $noOfBags  = $this->input->post('no_of_bags');
            $dob       = $this->input->post('date_of_birth');
            $bgroup    = $this->input->post('blood_group');
            $msg       = $this->input->post('message');
            $addedBy   = $this->input->post('addedBy');

            $bb_data = array(
                'full_name'     => $fname,
                'mobile'        => $mobile,
                'city'          => $city,
                'state'         => $state,
                'country'       => $country,
                'latitude'      => $latitude,
                'longitude'     => $longitude,
                'hospital_name' => $hospital,
                'no_of_bags'    => $noOfBags,
                'blood_group'   => $bgroup,
                'date_of_birth' => $dob,
                'message'       => $msg,
                'addedBy'       => $addedBy,
            );

            $qrr = $this->db->update('tbl_blood_requests', $bb_data, "id=" . $id);

            $affected = $this->db->affected_rows();

            if ($affected == 1) {
                $row['success'] = true;
            } else {
                $row['success'] = false;
            }

            array_push($jsonObj, $row);
        }

        $set['BloodBank'] = $jsonObj;


        echo $val = str_replace('\\/', '/', json_encode($set, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        die();
    }

    /**
     * Add / Edit blood requests end
     */

    /**
     * Other utility functions start
     */
    // donors by user
    function donors_by_user_id()
    {
        $jsonObj = array();

        if (($this->input->post('addedBy'))) {
            $addedBy = $this->input->post('addedBy');
            $this->db->where("addedBy", $addedBy);
            $sql = $this->db->get("tbl_donors")->result_array();

            foreach ($sql as $data) {
                $row['id']               = $data['id'];
                $row['full_name']        = $data['full_name'];
                $row['mobile']           = $data['mobile'];
                $row['city']             = $data['city'];
                $row['state']            = $data['state'];
                $row['country']          = $data['country'];
                $row['address']          = $data['address'];
                $row['habits']           = $data['habits'];
                $row['lastDonationDate'] = $data['lastDonationDate'];
                $row['date_of_birth']    = $data['date_of_birth'];
                $row['blood_group']      = $data['blood_group'];

                array_push($jsonObj, $row);
            }
        }

        $set['Donors'] = $jsonObj;

        $data['List'] = $set;

        echo $val = str_replace('\\/', '/', json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        die();
    }

    // count views of everything
    function count_view()
    {
        if (($this->input->post('id'))) {
            $id   = $this->input->post('id');
            $type = $this->input->post('type');

            if ($type == "donor") {
                $this->db->where("id", $id);
                $this->db->update("tbl_donors", "views=(views+1)");

//        $qry = "UPDATE `tbl_donors` SET `views`=(`views`+1) WHERE id=" . $id;
                $res = $this->db->affected_rows();
                if ($res > 0) {
                    $data['success'] = true;
                } else {
                    $data['success'] = false;
                }

                $set['BloodBank'] = $data;
                echo $val = str_replace("\\/", "/", json_encode($set, JSON_UNESCAPED_UNICODE));
                die();
            } elseif ($type == "request") {
                $this->db->where("id", $id);
                $this->db->update("tbl_blood_requests", "views=(views+1)");

//        $qry = "UPDATE `tbl_blood_requests` SET `views`=(`views`+1) WHERE id=" . $id;
                $res = $this->db->affected_rows();
                if ($res > 0) {
                    $data['success'] = true;
                } else {
                    $data['success'] = false;
                }

                $set['BloodBank'] = $data;
                echo $val = str_replace("\\/", "/", json_encode($set, JSON_UNESCAPED_UNICODE));
                die();
            } elseif ($type == "blood_bank") {
                $this->db->where("id", $id);
                $this->db->update("tbl_bloodbanks", "views=(views+1)");


//        $qry = "UPDATE `tbl_bloodbanks` SET `views`=(`views`+1) WHERE id=" . $id;
                $res = $this->db->affected_rows();
                if ($res) {
                    $data['success'] = true;
                } else {
                    $data['success'] = false;
                }

                $set['BloodBank'] = $data;
                echo $val = str_replace("\\/", "/", json_encode($set, JSON_UNESCAPED_UNICODE));
                die();
            }
        }
    }

    // update something
    function update_request()
    {
        $jsonObj = array();
        if (($this->input->post('id'))) {
            $id   = $this->input->post('id');
            $type = $this->input->post('type');
            $what = $this->input->post('what');

            if ($type == "donor") {
                if ($what == "deactivate") {
                    $this->db->update("tbl_donors", array("status" => 0), array("id" => $id));
//          $qry = "UPDATE `tbl_donors` SET `status`=0 WHERE id=" . $id;
                    $res = $this->db->affected_rows();
                    if ($res > 0) {
                        $data['success'] = true;
                    } else {
                        $data['success'] = false;
                    }
                } elseif ($what == "delete") {
                    $this->db->where("id", $id);
                    $this->db->delete("tbl_donors");


                    $res = $this->db->affected_rows();
                    if ($res > 0) {
                        $data['success'] = true;
                    } else {
                        $data['success'] = false;
                    }
                } else {
                    $data['success'] = false;
                }
            } elseif ($type == "request") {
                if ($what == "deactivate") {
                    $this->db->where("id", $id);
                    $this->db->update("tbl_blood_requests", array("status" => 0));

                    $res = $this->db->affected_rows();
                    if ($res > 0) {
                        $data['success'] = true;
                    } else {
                        $data['success'] = false;
                    }
                } elseif ($what == "delete") {
                    $this->db->where("id", $id);
                    $this->db->delete("tbl_blood_requests");

                    $res = $this->db->affected_rows();
                    if ($res > 0) {
                        $data['success'] = true;
                    } else {
                        $data['success'] = false;
                    }
                } elseif ($what == "fulfilled") {
                    $this->db->where("id", $id);
                    $this->db->update("tbl_blood_requests", array("fulfilled" => 1));

                    $res = $this->db->affected_rows();
                    if ($res > 0) {
                        $data['success'] = true;
                    } else {
                        $data['success'] = false;
                    }
                } else {
                    $data['success'] = false;
                }
            } else {
                $data['success'] = false;
            }
            array_push($jsonObj, $data);
            $set['BloodBank'] = $jsonObj;
            echo $val = str_replace("\\/", "/", json_encode($set, JSON_UNESCAPED_UNICODE));
            die();
        }
    }

    // toggle reminder on or off
    function toggle_reminder()
    {
        $jsonObj = array();

        $id               = $this->input->post('id');
        $value            = $this->input->post('value');
        $lastDonationDate = $this->input->post('lastDonationDate');

        $bb_data = array(
            'is_reminder'      => $value,
            'lastDonationDate' => $lastDonationDate,
        );


        $qrr = $this->db->update('tbl_donors', $bb_data, "id=" . $id);

        $affected = $this->db->affected_rows();

        if ($affected >= 1) {
            $row['success'] = true;
        } else {
            $row['success'] = false;
        }
        array_push($jsonObj, $row);

        $set['BloodBank'] = $jsonObj;


        echo $val = str_replace('\\/', '/', json_encode($set, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        die();
    }

    // get calls list (calls to donors list)
    function getCalls()
    {
        $jsonObj = array();

        $this->db->select("tbl_calls.*, tbl_donors.full_name as dName, tbl_donors.mobile as dMobile");
        $this->db->select("tbl_users.name as uName, tbl_users.mobile as uMobile");
        $this->db->join("tbl_donors", "tbl_donors.id=tbl_calls.call_to", "left");
        $this->db->join("tbl_users", "tbl_users.id=tbl_calls.call_from", "left");
        $this->db->where("tbl_calls.call_from", $this->input->post("user_id"));
        $q = $this->db->get("tbl_calls")->result_array();

        foreach ($q as $data) {
            $row['id']       = $data['id'];
            $row['to_name']  = $data['dName'];
            $row['to_phone'] = $data['dMobile'];
            $row['to_id']    = $data['call_to'];

            $row['from_id']     = $data['call_from'];
            $row['from_name']   = $data['uName'];
            $row['from_mobile'] = $data['uMobile'];

            $row['positive'] = $data['positive'];
            $row['subject']  = $data['subject'];
            $row['feedback'] = $data['feedback'];

            $row['date']    = $data['date'];
            $row['isRated'] = $data['isRated'];

            array_push($jsonObj, $row);
        }

        $set['BloodBank'] = $jsonObj;


        echo $val = str_replace('\\/', '/', json_encode($set, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        die();
    }

    /**
     * Other utility functions end
     */


    /**
     * Registering new user start
     */

    // check user if exists
    function checkUserPhone()
    {
        $jsonObj = array();

        $mobile = $this->input->post('mobile');


        $this->db->select("tbl_users.*, countries.name as country_name, states.name as state_name, cities.name as city_name");
        $this->db->join("countries", "countries.id=tbl_users.country", "left");
        $this->db->join("cities", "cities.id=tbl_users.city", "left");
        $this->db->join("states", "states.id=tbl_users.state", "left");
        $this->db->where("tbl_users.mobile", $mobile);
        $this->db->limit(1);


        $sql = $this->db->get("tbl_users");


        if ($sql) {
            if ($sql->num_rows() > 0) {
                $data                = $sql->row_array();
                $row['isRegistered'] = true;

                $row['user_data'] = $data;
            } else {
                $user   = $this->db->insert("tbl_users", array('mobile' => $mobile));
                $userId = $this->db->insert_id();

                $user = $this->db->where("id", $userId)->get("tbl_users")->row_array();

                $row['user_data']    = $user;
                $row['isRegistered'] = false;
            }
            $row['available'] = true;
        } else {
            $row['isRegistered'] = false;
            $row['available']    = false;
        }

        array_push($jsonObj, $row);
        $set['BloodBank'] = $jsonObj;


        echo $val = str_replace('\\/', '/', json_encode($set, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        die();
    }

    // save a call log
    function save_call()
    {
        $jsonObj = array();

        $from = $this->input->post('call_from');
        $to   = $this->input->post('call_to');

        $bb_data = array(
            'call_from' => $from,
            'call_to'   => $to,
        );


        $qrr = $this->db->insert('tbl_calls', $bb_data);


        if ($qrr) {
            $row['success'] = true;
        } else {
            $row['success'] = false;
        }
        array_push($jsonObj, $row);

        $set['BloodBank'] = $jsonObj;


        echo $val = str_replace('\\/', '/', json_encode($set, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        die();
    }

    // rate a call
    function rate_call()
    {
        $jsonObj = array();

        $id           = $this->input->post('id');
        $subject      = $this->input->post('subject');
        $feedback     = $this->input->post('feedback');
        $donatedOrNot = $this->input->post('donatedOrNot');

        $bb_data = array(
            'isRated'  => "1",
            'positive' => $donatedOrNot,
            'subject'  => $subject,
            'feedback' => $feedback,
        );


        $qrr = $this->db->update('tbl_calls', $bb_data, "id=" . $id);

        $affected = $this->db->affected_rows();

        if ($affected >= 1) {
            $row['success'] = true;
        } else {
            $row['success'] = false;
        }
        array_push($jsonObj, $row);

        if ($donatedOrNot == 1 || $donatedOrNot == "1") {
            $ccall = $this->db->where("tc.id", $id)->get("tbl_calls tc");
            if ($ccall->num_rows() > 0) {
                $row = $ccall->row_array();


                $this->db->where("id", $row['call_to']);
                $ress = $this->db->update("tbl_donors", "tbl_donors.points=tbl_donors.points+1");
            }
        }


        $set['BloodBank'] = $jsonObj;


        echo $val = str_replace('\\/', '/', json_encode($set, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        die();
    }

    // add new user (register)
    function addUser()
    {
        $jsonObj = array();

        $id            = $this->input->post('id');
        $name          = $this->input->post('name');
        $city          = $this->input->post('city');
        $state         = $this->input->post('state');
        $country       = $this->input->post('country');
        $address       = $this->input->post('address');
        $latitude      = $this->input->post('latitude');
        $longitude     = $this->input->post('longitude');
        $date_of_birth = $this->input->post('date_of_birth');
        $blood_group   = $this->input->post('blood_group');
        $password      = $this->input->post('password');
        $deviceId      = $this->input->post('deviceId');

        $data = array(
            'name'             => $name,
            'city'             => $city,
            'state'            => $state,
            'country'          => $country,
            'address'          => $address,
            'latitude'         => $latitude,
            'longitude'        => $longitude,
            'dob'              => $date_of_birth,
            'blood_group'      => $blood_group,
            'password'         => $password,
            'is_profile_saved' => "1",
            'devId'            => $deviceId,
        );


        $dd = $this->db->update("tbl_users", $data, "id=" . $id);

        if ($dd) {
            $ro['success'] = true;
            $ro['msg']     = "Profile Saved!";


            $this->db->select("tbl_users.*, countries.name as country_name, states.name as state_name, cities.name as city_name");
            $this->db->join("countries", "countries.id=tbl_users.country", "left");
            $this->db->join("cities", "cities.id=tbl_users.city", "left");
            $this->db->join("states", "states.id=tbl_users.state", "left");
            $this->db->where("tbl_users.id", $this->input->post("id", true));


            $user            = $this->db->get("tbl_users")->row();
            $ro['user_data'] = $user;

            array_push($jsonObj, $ro);
        } else {
            $ro['success']   = false;
            $ro['msg']       = "Something went wrong, Please try again!";
            $ro['user_date'] = null;
        }

        $set['BloodBank'] = $jsonObj;


        echo $val = str_replace('\\/', '/', json_encode($set, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        die();
    }

    /**
     * Registering new user end
     */

}
