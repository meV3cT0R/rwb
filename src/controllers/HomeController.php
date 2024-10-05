<?php
    class HomeController {
        public function home() : void {
            require_once __DIR__."/../../public/index.php";
        }
        public function getLogin() : void {
            require_once __DIR__."/../../public/login.php";
        }
        public function getRegister() : void {
            require_once __DIR__."/../../public/register.php";
        }
    }