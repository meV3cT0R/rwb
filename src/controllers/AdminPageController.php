<?php

    class AdminPageController {
        private mysqli $db;
        private $aboutUs;
        private $contactUs;
        public function __construct() {
            $this->db = (new DB())->connect();
        
        }

        public function home() {
            $aboutUsQuery = "SELECT * from aboutUs";
            $contactUsQuery = "SELECT * from contactUs";

            


            $aboutUsResult = $this->db->query($aboutUsQuery); 
            $contactUsResult= $this->db->query($contactUsQuery); 

            if($aboutUsResult->num_rows == 0) {
                $this->db->query("INSERT
                 INTO aboutUs 
                     (aboutUs,image,mission,team)
                    values('','','','');
                ");
                return $this->home();
            }else {
                $this->aboutUs = $aboutUsResult->fetch_assoc();
            }

            if($contactUsResult->num_rows == 0) {
                $this->db->query("INSERT
                 INTO contactUs 
                     (email,phone,address)
                    values('','','');
                ");
                return $this->home();
            }else {
                $this->contactUs = $contactUsResult->fetch_assoc();
            }

            logMessage($this->aboutUs["id"]);
            $updateAboutUs = function ($about,$image,$mission,$team) {
                $query = "UPDATE aboutUs
                 set  
                    aboutUs='$about',
                    image='$image',
                    mission='$mission',
                    team='$team'
                    where id=
                ".$this->aboutUs["id"].";";

                echo $query;
                $bool = $this->db->query($query);
                logMessage("Errors : ".$bool);
                logMessage($this->db->error);
                logMessage($this->db->info);
            };
            logMessage($this->contactUs["id"]);

            $updateContactUs = function ($email,$phone,$address) {
                $this->db->query("UPDATE contactUs
                 set  
                    email='$email',
                    phone='$phone',
                    address='$address'
                    where id=
                ".$this->contactUs["id"]);
            };

            $aboutUs = $this->aboutUs;
            $contactUs = $this->contactUs;

            require_once __DIR__."/../../public/admin/pages.php";
        }
    }