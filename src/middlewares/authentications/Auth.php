<?php
    class Auth {
        public function verifyAdmin() : bool {
            session_start();
            if(isset($_SESSION["user"])) {
                $user = $_SESSION["user"];
                if($user instanceof User) {
                    logMessage("User ". $user->getFirstName());                
                    return $user->getRole()->getName()=="ADMIN";
                }
            }
            logMessage("no session user");
            header("Location: /realEstate/login");
            return false;
        }
    }