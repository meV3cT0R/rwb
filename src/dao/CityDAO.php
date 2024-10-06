<!--- Required Dependecies 
    City
--->
<?php
    // logMessage("inside CityDAO.php");
    class CityDAO {
        private mysqli $db;

        public function __construct(
            mysqli $dbConnection=null,

        ) {
            if($dbConnection===null){
                throw new ErrorException("No Database Connection");
            }

            $this->db = $dbConnection;
        }
        function getCities() : array {
            // logMessage("Getting Cities");
            $cities = []; 
            try {
                $result = $this->db->query("SELECT 
                    city.id as cityId,
                    city.name as cityName,
                    state.id as stateId,
                    state.name as stateName,
                    country.id as countryId,
                    country.name as countryName
                    FROM city left join state on city.stateId=state.id   
                    left join country on city.countryId=country.id;");
                if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $city = new City((int)$row["cityId"],$row["cityName"]);
                        $country = new Country();
                        $country->setId((int)$row["countryId"]);
                        $country->setName($row["countryName"]);
                        $city->setCountry($country);
                        if($row["stateId"]!=null){
                            $state = new State();
                            $state->setName($row["stateName"]);
                            $state->setId((int)$row["stateId"]);
                            $state->setCountry($country);
                            $city->setState($state);
                        }
                        array_push($cities,$city);
                    }
                }
            }catch(PDOException $pdoe) {
                throw new ErrorException("Database Exception : ". $pdoe->getMessage());
            }catch(ErrorException $e) {
                throw $e;
            }
            return $cities;
        }

        function getCityById(int $id) : City {
            // logMessage("Getting City by Id");
            $result  = $this->db->query("SELECT 
                    city.id as cityId,
                    city.name as cityName,
                    state.id as stateId,
                    state.name as stateName,
                    country.id as countryId,
                    country.name as countryName
                    FROM city left join state on city.stateId=state.id   
                    left join country on city.countryId=country.id where city.id='$id';") or trigger_error("Something Went wrong while trying to execute SELECT query");
            $city = new City();
            if($result->num_rows> 0) {
                $row=$result->fetch_assoc();
                $city->setId((int)$row["cityId"]);
                $city->setName($row["cityName"]);
                $country = new Country();
                $country->setId((int)$row["countryId"]);
                $country->setName($row["countryName"]);
                $city->setCountry($country);

                if($row["stateId"]!=null){
                    $state = new State();
                    $state->setName($row["stateName"]);
                    $state->setId((int)$row["stateId"]);
                    $state->setCountry($country);
                    $city->setState($state);
                }
            }else {
                throw new ErrorException("City with Provided Id not found");
            }
            return $city;
        }

        function postCity(City $city) : City{
            // logMessage("Posting city");
            try{
                if($city->getCountry()===null) {
                    throw new ErrorException("[No Country Provided] City Should be part of Country");
                }

                $cityName = $city->getName();
                $countryId = $city->getCountry()->getId();
                
                $stateId = null;
                if($city->getState()!=null){
                    $stateId = $city->getState()->getId();  
                }

                $cityStmt = $this->db->prepare("INSERT INTO city(name,stateId,countryId) values(?,?,?);");
                $cityStmt->bind_param("sii",$cityName,$stateId,$countryId);

                if(!$cityStmt->execute()) {
                    throw new ErrorException("Data Insertion Failed");
                }
            }catch(PDOException $pdoe) {
                throw new ErrorException("Database Error :  ".$pdoe->getMessage());
            }catch(ErrorException $e) {
                throw $e;
            }
            return $city;
        }

        function updateCity(City $city) : City {
            // logMessage("Updating City");
            try{
                $stmt = $this->db->prepare("UPDATE city set name=?,countryId=?,stateId=? where id=?");
                $name= $city->getName();
                $id = $city->getId();
                $countryId = $city->getCountry()->getId();
                $stateId = null;
                if($city->getState()!=null) {
                    $stateId = $city->getState()->getId();
                }
                $stmt->bind_param("siii", $name,$countryId,$stateId,$id);
    
                if(!$stmt->execute()) {
                    throw new ErrorException("Data Updation Failed");
                }
            }catch(PDOException $pdoe) {
                throw new ErrorException("Database Error :  ".$pdoe->getMessage());
            }catch(ErrorException $e) {
                throw $e;
            }
            return $city;
        } 
    
        function deleteCity(int $id) : City {
            // logMessage("Deleting data with the id $id");
            $city = null;
            try{
                $city = $this->getCityById($id);
                if($city===null){
                    throw new ErrorException("City with given id not found");
                }
                $stmt = $this->db->prepare("DELETE FROM city where id=?");
                $stmt->bind_param("s",$id);
                if(!$stmt->execute()) {
                    throw new ErrorException("Data Deletion Failed");
                }
            }catch(PDOException $pdoe) {
                throw new ErrorException("Database Error :  ".$pdoe->getMessage());
            }catch(ErrorException $e) {
                throw $e;
            }
            return $city;
        }
    }