<?php
logMessage("inside countryDAO.php");

class CountryDAO {
    private mysqli $db;

    function __construct($dbConnection) {
        if($dbConnection == null) {
            throw new ErrorException("No Database Connection");
        }
        $this->db = $dbConnection;
    }
    function getCountries() : array {
        logMessage("Getting Countries");
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

    function getCountryById(int $id) : Country {
        logMessage("Getting Country by Id");
        $result  = $this->db->query("SELECT * FROM country where id='$id';") or trigger_error("Something Went wrong while trying to execute SELECT query");
        $country = new Country();
        if($result->num_rows> 0) {
            $row=$result->fetch_assoc();
            $country->setId((int)$row["id"]);
            $country->setName($row["name"]);
        }else {
            throw new ErrorException("Country with Provided Id not found");
        }
        return $country;
    }


    function postCountry(Country $country) : Country{
        logMessage("Posting Country");
        try{
            $stmt = $this->db->prepare("INSERT INTO country(name) values(?)");
            $name = $country->getName();
            $stmt->bind_param("s",$name);

            if (!$stmt->execute()) {
                throw new ErrorException("Data Insertion Failed");
            }
            $country->setId($this->db->insert_id);
        }catch(PDOException $pdoe) {
            throw new ErrorException("Database Error :  ".$pdoe->getMessage());
        }catch(ErrorException $e) {
            throw $e;
        }
        return $country;
    }

    function updateCountry(Country $country) : Country {
        logMessage("Updating Country");
        try{
            $stmt = $this->db->prepare("UPDATE country set name=? where id=?");
            $name= $country->getName();
            $id = $country->getId();
            $stmt->bind_param("si", $name,$id);

            if(!$stmt->execute()) {
                throw new ErrorException("Data Updation Failed");
            }
        }catch(PDOException $pdoe) {
            throw new ErrorException("Database Error :  ".$pdoe->getMessage());
        }catch(ErrorException $e) {
            throw $e;
        }
        return $country;
    } 

    function deleteCountry(int $id) : Country {
        logMessage("Deleting data with the id $id");
        $country = null;
        try{
            $country = $this->getCountryById($id);
            $stmt = $this->db->prepare("DELETE FROM country where id=?");
            $stmt->bind_param("s",$id);
            if(!$stmt->execute()) {
                throw new ErrorException("Data Deletion Failed");
            }
        }catch(PDOException $pdoe) {
            throw new ErrorException("Database Error :  ".$pdoe->getMessage());
        }catch(ErrorException $e) {
            throw $e;
        }
        return $country;
    }
}



