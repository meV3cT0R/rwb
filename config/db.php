<?php  
    class DB {
        private string $servername = "localhost";
        private string $username = "root";
        private string $password = "";
        private string $dbname = "realEstate";
        private mysqli $conn;

        function __construct($servername=null,$username=null,$password=null,$dbname=null) {   
            if($servername==null && $username==null && $password==null){
                return;
            }else if($username==null && $password==null && $dbname==null) {
                $this->servername = $servername;
            }else if($password==null && $dbname==null) {
                $this->servername = $servername;
                $this->username = $username;
            }else if($dbname==null) {
                $this->servername = $servername;
                $this->username = $username;
                $this->password = $password;
            }
            $this->servername = $servername;
            $this->username = $username;
            $this->password = $password;
            $this->dbname = $dbname;
        }
        function connect() : mysqli {
            $conn = new mysqli($this->servername, $this->username, $this->password,$this->dbname);
            if($conn->connect_error)  {
                throw new ErrorException($conn->connect_error);
            }
            $this->conn=$conn;
            return $conn;
        }
    }
     
     
    logMessage("Connection Succesfull");