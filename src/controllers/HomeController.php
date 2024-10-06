<?php
    class HomeController {

        private PropertyRepository $propertyRepository;
        private UserService $userService;
        public function __construct(
            PropertyRepository $propertyRepository,
            UserService $userService
        ) {
            Helper::checkDependencies(
                array(
                    "PropertyRepository" => $propertyRepository,
                    "UserService" => $userService

                )
                );
            $this->propertyRepository = $propertyRepository;
            $this->userService = $userService;
        }

        public function home() : void {
            require_once __DIR__."/../../public/index.php";
        }
        public function getLogin() : void {
            $login = function (string $username,string $password): GenDTO {
                $user = null;
                try {
                    $user = $this->userService->login($username,$password);
                    
                }catch(Exception $e) {
                    $error = $e->getMessage();
                }
                return $user;

            };
            require_once __DIR__."/../../public/login.php";
        }
        public function getRegister() : void {
            require_once __DIR__."/../../public/register.php";
        }

        public function getAbout() : void {
            require_once __DIR__."/../../public/about.php";
        }

        public function getProperties() : void {
            $properties = $this->propertyRepository->getProperties();
            require_once __DIR__."/../../public/properties.php";
        }

        public function getContact() : void {
            require_once __DIR__."/../../public/contact.php";
        }
    }