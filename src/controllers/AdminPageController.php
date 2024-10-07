<?php

class AdminPageController {
    private mysqli $db;
    private $aboutUs;
    private $contactUs;

    public function __construct() {
        $this->db = (new DB())->connect(); // Initialize database connection
    }

    public function home() {
        $aboutUsQuery = "SELECT * from aboutUs"; // Query to fetch aboutUs data
        $contactUsQuery = "SELECT * from contactUs"; // Query to fetch contactUs data

        $aboutUsResult = $this->db->query($aboutUsQuery); // Execute aboutUs query
        $contactUsResult = $this->db->query($contactUsQuery); // Execute contactUs query

        if ($aboutUsResult->num_rows == 0) {
            // Insert default values if aboutUs table is empty
            $this->db->query("INSERT INTO aboutUs (aboutUs, image, mission, team) values('', '', '', '');");
            return $this->home(); // Re-run home method after insertion
        } else {
            $this->aboutUs = $aboutUsResult->fetch_assoc(); // Fetch aboutUs data
        }

        if ($contactUsResult->num_rows == 0) {
            // Insert default values if contactUs table is empty
            $this->db->query("INSERT INTO contactUs (email, phone, address) values('', '', '');");
            return $this->home(); // Re-run home method after insertion
        } else {
            $this->contactUs = $contactUsResult->fetch_assoc(); // Fetch contactUs data
        }

        logMessage($this->aboutUs["id"]); // Log aboutUs ID

        // Function to update aboutUs data
        $updateAboutUs = function ($about, $image, $mission, $team) {
            $query = "UPDATE aboutUs set aboutUs='$about', image='$image', mission='$mission', team='$team' where id=" . $this->aboutUs["id"] . ";";
            echo $query; // Print the query
            $bool = $this->db->query($query); // Execute the update query
            logMessage("Errors : " . $bool); // Log query execution result
            logMessage($this->db->error); // Log any database errors
            logMessage($this->db->info); // Log database info
        };

        logMessage($this->contactUs["id"]); // Log contactUs ID

        // Function to update contactUs data
        $updateContactUs = function ($email, $phone, $address) {
            $this->db->query("UPDATE contactUs set email='$email', phone='$phone', address='$address' where id=" . $this->contactUs["id"]);
        };

        $aboutUs = $this->aboutUs; // Assign aboutUs data to local variable
        $contactUs = $this->contactUs; // Assign contactUs data to local variable

        require_once __DIR__ . "/../../public/admin/pages.php"; // Include the admin pages
    }
}
