<!----
    Required Dependencies
----->
<?php
    class UserService{
        private mysqli $db;

        public function __construct() {
        }

        public function register(User $user) : void {
        
        }

        public function logout(User $user) : void {
        
        }

        public function getUserByUsername(string $username) : User {
            
        }
        
        public function getUserByEmail(string $email) : User {
        
        }
        public function getUserByUsernameAndPassword(string $username, string $password) : User  {

        }

        public function getUserById(int $id) : User {
            
        }


    }