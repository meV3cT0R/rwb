<!--- Required Dependecies 
    City
--->
<?php
    logMessage("inside City Service.php");
    class CityService {
        private mysqli $db;
        private CountryService $countryService;
        private StateService $stateService;

        public function __construct(
            mysqli $dbConnection=null,
            CountryService $countryService,
            StateService $stateService
        ) {
            if($dbConnection===null){
                throw new ErrorException("No Database Connection");
            }
            if($countryService===null) {
                throw new ErrorException("Required Dependency 'CountryService' is not Provided");
            }
            if($countryService===null) {
                throw new ErrorException("Required Dependency 'StateService' is not Provided");
            }
            $this->db = $dbConnection;
            $this->countryService = $countryService;
            $this->stateService = $stateService;
        }
        function getCities() : array {
            logMessage("Getting Cities");
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
            logMessage("Getting City by Id");
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
            logMessage("Posting city");
            try{
                if($city->getCountry()===null) {
                    throw new ErrorException("[No Country Provided] State Should be part of Country");
                }
                $countryId = $city->getCountry()->getId();
                
                if($countryId===null) {
                    $countryId = $this->countryService->postCountry(new Country(null,$city->getCountry()->getName()))->getId();
                }
                $city->getCountry()->setId($countryId);

                $stateId = $city->getState()->getId();
                if($city->getState()!=null && $stateId===null) {
                    $stateId= $this->stateService->postState(new State(null,$city->getState()->getName(),$city->getCountry()))->getId();
                }
                
                $cityName = $city->getName();
                $cityStmt = $this->db->prepare("INSERT INTO city(name,stateId,countryId) values(?,?,?);");

                $cityStmt->bind_param("sii",$cityName,$stateId,$countryId);
            }catch(PDOException $pdoe) {
                throw new ErrorException("Database Error :  ".$pdoe->getMessage());
            }catch(ErrorException $e) {
                throw $e;
            }
            return $city;
        }

        function updateState(State $state) : State {
            logMessage("Updating State");
            try{
                $stmt = $this->db->prepare("UPDATE state set name=?,countryId=? where id=?");
                $name= $state->getName();
                $id = $state->getId();
                $countryId = $state->getCountry()->getId();
                $stmt->bind_param("sii", $name,$countryId,$id);
    
                if(!$stmt->execute()) {
                    throw new ErrorException("Data Updation Failed");
                }
            }catch(PDOException $pdoe) {
                throw new ErrorException("Database Error :  ".$pdoe->getMessage());
            }catch(ErrorException $e) {
                throw $e;
            }
            return $state;
        } 
    
        function deleteState(int $id) : State {
            logMessage("Deleting data with the id $id");
            $state = null;
            try{
                $state = $this->getStateById($id);
                if($state===null){
                    throw new ErrorException("State with given id not found");
                }
                $stmt = $this->db->prepare("DELETE FROM state where id=?");
                $stmt->bind_param("s",$id);
                if(!$stmt->execute()) {
                    throw new ErrorException("Data Deletion Failed");
                }
            }catch(PDOException $pdoe) {
                throw new ErrorException("Database Error :  ".$pdoe->getMessage());
            }catch(ErrorException $e) {
                throw $e;
            }
            return $state;
        }
    }