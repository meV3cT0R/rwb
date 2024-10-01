<?php
logMessage("inside countryService.php");
include(__dir__."/../../constants.php");
include(__dir__."/../models/Country.php");

class CountryService {
    private $db;

    function __construct($dbConnection) {
        if($dbConnection == null) {
            throw new ErrorException("No Database Connection");
        }
        $this->db = $dbConnection;
    }
    function getCountry(): Country{
        $country = new Country();
        return $country;
    }

}
echo (new CountryService())->getCountry()->getName();
