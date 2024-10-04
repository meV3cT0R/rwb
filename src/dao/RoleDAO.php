<!--- Required Dependecies 
    State
--->
<?php
    logMessage("inside RoleDAO.php");

    class RoleDAO {
        private mysqli $db;

        public function __construct($dbConnection=null) {
            if($dbConnection===null){
                throw new ErrorException("No Database Connection");
            }
            $this->db = $dbConnection;
        }
        function getRoles() : array {
            logMessage("Getting roles");
            $roles = []; 
            try {
                $result = $this->db->query("SELECT 
                   * from roles;
                   ");
                if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $role = new Role();
                        $role->setId($row["id"]);
                        $role->setName($row["name"]);
                        array_push($roles,$role);
                    }
                }
            }catch(PDOException $pdoe) {
                throw new ErrorException("Database Exception : ". $pdoe->getMessage());
            }catch(ErrorException $e) {
                throw $e;
            }
            return $roles;
        }

        function getRoleById(int $id) : Role {
            logMessage("Getting Role by Id");
            $result  = $this->db->query("SELECT 
                   * from roles where id=$id;
                   ") or trigger_error("Something Went wrong while trying to execute SELECT query");
            $role = new Role();
            if($result->num_rows> 0) {
                $row=$result->fetch_assoc();
                $role->setId($row["id"]);
                $role->setName($row["name"]);
            }else {
                throw new ErrorException("State with Provided Id not found");
            }
            return $role;
        }



    }