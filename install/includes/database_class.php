<?php

class Database
{

    // Function to the database and tables and fill them with the default data
    function create_database($data)
    {
        // Connect to the database
        $mysqli = new mysqli($data['hostname'], $data['username'], $data['password'], '');

        // Check for errors
        if (mysqli_connect_errno()) {
            return false;
        }

        // Create the prepared statement
        $mysqli->query("CREATE DATABASE IF NOT EXISTS " . $data['database']);

        // Close the connection
        $mysqli->close();

        return true;
    }

    // Function to create the tables and fill them with the default data
    function create_tables($data)
    {
        // Connect to the database
        $mysqli = new mysqli($data['hostname'], $data['username'], $data['password'], $data['database']);

        // Check for errors
        if (mysqli_connect_errno()) {
            return false;
        }

        $query = "";

        // Open the default SQL file
        if ($data['database_type'] == "with_regions") {
            $query = file_get_contents('sql/install_with_regions.sql');
        } elseif ($data['database_type'] == "without_regions") {
            $query = file_get_contents('sql/install_without_regions.sql');
        }

        $qry2 = "UPDATE `tbl_admin` SET `username` = '" . $data['admin_username'] . "', `password` = '" . md5($data['admin_password']) . "', `email` = '" . $data['admin_email'] . "' WHERE `tbl_admin`.`id` = 1";

        $query .= "
        " . $qry2;

        // Execute a multi query
        if (!empty($query)) {
            $mysqli->multi_query($query);
        }

        // Close the connection
        $mysqli->close();

        return true;
    }
}
