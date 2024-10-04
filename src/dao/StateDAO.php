<!--- Required Dependecies 
    State
--->
<?php
    logMessage("inside StateDAO.php");

    class StateDAO {
        private mysqli $db;

        public function __construct($dbConnection=null) {
            if($dbConnection===null){
                throw new ErrorException("No Database Connection");
            }
            $this->db = $dbConnection;
        }
        function getStates() : array {
            logMessage("Getting States");
            $states = []; 
            try {
                $result = $this->db->query("SELECT 
                    state.id as stateId,
                    state.name as stateName,
                    country.id as countryId,
                    country.name as countryName
                    FROM state left join country on state.countryId=country.id;");
                if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $state = new State();
                        $state->setName($row["stateName"]);
                        $state->setId((int)$row["stateId"]);
                        $country = new Country();
                        $country->setId((int)$row["countryId"]);
                        $country->setName($row["countryName"]);
                        $state->setCountry($country);
                        array_push($states,$state);
                    }
                }
            }catch(PDOException $pdoe) {
                throw new ErrorException("Database Exception : ". $pdoe->getMessage());
            }catch(ErrorException $e) {
                throw $e;
            }
            return $states;
        }

        function getStateById(int $id) : State {
            logMessage("Getting State by Id");
            $result  = $this->db->query("SELECT 
             state.id as stateId,
                state.name as stateName,
                country.id as countryId,
                country.name as countryName
             FROM state left join country on state.countryId=country.id where state.id='$id';") or trigger_error("Something Went wrong while trying to execute SELECT query");
            $state = new state();
            if($result->num_rows> 0) {
                $row=$result->fetch_assoc();
                $state->setName($row["stateName"]);
                $state->setId((int)$row["stateId"]);
                $country = new Country();
                $country->setId((int)$row["countryId"]);
                $country->setName($row["countryName"]);
                $state->setCountry($country);
            }else {
                throw new ErrorException("State with Provided Id not found");
            }
            return $state;
        }

        function postState(State $state) : State{
            logMessage("Posting State");
            try{
                if($state->getCountry()===null) {
                    throw new ErrorException("[No Country Provided] State Should be part of Country");
                }
                $countryId = $state->getCountry()->getId();
                
                if($state->getCountry()->getId()===null) {
                    $countryStmt = $this->db->prepare("INSERT INTO country(name) values(?)");
                    $countryName = $state->getCountry()->getName();
                    $countryStmt->bind_param("s",$countryName);
        
                    if (!$countryStmt->execute()) {
                        throw new ErrorException("Data Insertion Failed");
                    }

                    $countryId = $this->db->insert_id;
                }

                $stateStmt = $this->db->prepare("INSERT INTO state(name,countryId) values(?,?)");
                $stateName = $state->getName();
                $stateStmt->bind_param("si",$stateName,$countryId);

                if (!$stateStmt->execute()) {
                    throw new ErrorException("Data Insertion Failed");
                }
            }catch(PDOException $pdoe) {
                throw new ErrorException("Database Error :  ".$pdoe->getMessage());
            }catch(ErrorException $e) {
                throw $e;
            }
            return $state;
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