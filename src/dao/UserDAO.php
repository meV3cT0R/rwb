<!----
    Required Dependencies
----->
<?php
    class UserDAO{
        private mysqli $db;

        public function __construct() {
        }

        public function register(User $user) : void {
        
        }

        public function logout(User $user) : void {
        
        }

        public function getUserByUsername(string $username) : User {
            return new User();
        }
        
        public function getUserByEmail(string $email) : User {
            return new User();
        }
        public function getUserByUsernameAndPassword(string $username, string $password) : User  {
            return new User();
        }

        public function getUserById(int $id) : User {
            return new User();
        }


    }