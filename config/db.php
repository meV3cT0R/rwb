<?php  
    class DB {
        private string $servername = "localhost";
        private string $username = "root";
        private string $password = "root";
        private mysqli $conn;

        function __construct($servername=null,$username=null,$password=null) {   
            if($servername==null && $username==null && $password==null){
                return;
            }else if($username==null && $password==null) {
                $this->servername = $servername;
            }else if($password==null) {
                $this->servername = $servername;
                $this->username = $username;
            }
            $this->servername = $servername;
            $this->username = $username;
            $this->password = $password;
        }
        function connect() : mysqli {
            $conn = new mysqli($this->servername, $this->username, $this->password);
            if($conn->connect_error)  {
                throw new ErrorException($conn->connect_error);
            }
            $this->conn=$conn;
            return $conn;
        }
    }
     
     
    logMessage("Connection Succesfull");