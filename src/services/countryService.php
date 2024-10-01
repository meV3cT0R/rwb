<?php
logMessage("inside countryService.php");
include __DIR__."/../../constants.php";
include __DIR__."/../models/Country.php";
include __DIR__."/../../config/db.php";
include __DIR__."/../../devutils/logs.php";

class CountryService {
    private $db;

    function __construct($dbConnection) {
        if($dbConnection == null) {
            throw new ErrorException("No Database Connection");
        }
        $this->db = $dbConnection;
    }
    function getCountry(): Country{
        logMessage("Getting Country");
        $country = new Country();

        return $country;
    }

}
echo (new CountryService((new DB())->connect()))->getCountry()->getName();
