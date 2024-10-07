<?php
    class Auth {
        public function verifyAdmin() : bool {
            session_start();
            if(isset($_SESSION["user"])) {
                $user = $_SESSION["user"];
                if($user instanceof UserDTO) {
                    logMessage("User ". $user->getFirstName());
                    if($user->getRole()=="ADMIN") {
                        return true;
                    }
                }
            }
            logMessage("no session user");
            header("Location: /realEstate/login");
            return false;
        }

        public function verifyUser() : bool {
            session_start();
            if(isset($_SESSION["user"])) {
                $user = $_SESSION["user"];
                if($user instanceof UserDTO) {
                    logMessage("User ". $user->getFirstName(). " " . $user->getLastName());                
                    if($user->getRole()=="USER") {
                        return true;
                    }
                }
            }
            logMessage("no session user");
            header("Location: /realEstate/login");

            return false;
        }

        public function verifyOwner() : bool {
            session_start();
            if(isset($_SESSION["user"])) {
                $user = $_SESSION["user"];
                if($user instanceof UserDTO) {
                    logMessage("User ". $user->getFirstName(). " " . $user->getLastName());                
                    if($user->getRole()=="OWNER") {
                        return true;
                    }
                }
            }
            logMessage("no session user");
            header("Location: /realEstate/login");

            return false;
        }

    
    }