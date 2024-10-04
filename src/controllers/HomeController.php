<?php
    class HomeController {
        public function home() : void {
            echo __DIR__." <br/>";
            require_once __DIR__."/../../public/index.php";
        }
    }