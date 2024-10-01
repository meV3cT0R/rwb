<?php
echo "inside countryService.php";
include(__dir__."/../models/Country.php");
function getCountry(): Country{
    $country = new Country();
    return $country;
}

echo getCountry()->getName();
