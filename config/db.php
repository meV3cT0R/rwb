<?php  
    class DB {
        private $servername = "localhost";
        private $username = "root";
        private $password = "root";
        private $conn;

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
        function connect() {
            $conn = new mysqli($this->servername, $this->username, $this->password);
            $this->conn=$conn;
            return $conn;
        }
    }
     
     
    logMessage("Connection Succesfull");