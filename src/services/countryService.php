<?php
logMessage("inside countryService.php");
include __DIR__."/../models/Country.php";
include __DIR__."/../../config/db.php";

class CountryService {
    private mysqli $db;

    function __construct($dbConnection) {
        if($dbConnection == null) {
            throw new ErrorException("No Database Connection");
        }
        $this->db = $dbConnection;
    }
    function getCountries() : array {
        logMessage("Getting Country");
        $result  = $this->db->query("SELECT * FROM country;") or trigger_error("Something Went wrong while trying to execute SELECT query");
        $countries = []; 
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $country = new Country();
                $country->setName($row["name"]);
                $country->setId((int)$row["id"]);
                array_push($countries,$country);
            }
        }
        return $countries;
    }

}
try {
    echo implode((new CountryService((new DB())->connect()))->getCountries());
} catch(Exception $e) {
    logMessage("". $e->getMessage());
}
