<?php
    class AdminController {
        public function dashboard() : void {
            echo __DIR__." <br/>";
            require_once __DIR__."/../../public/index.php";
        }
    }