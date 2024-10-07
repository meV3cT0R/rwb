<?php
    class Auth {
        public function verifyAdmin() : bool {
            session_start();
            if(isset($_SESSION["user"])) {
                $user = $_SESSION["user"];
                if($user instanceof UserDTO) {
                    logMessage("User ". $user->getFirstName());                
                    return $user->getRole()=="ADMIN";
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
                    return $user->getRole()=="USER";
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
                    return $user->getRole()=="OWNER";
                }
            }
            logMessage("no session user");
            header("Location: /realEstate/login");

            return false;
        }

    
    }