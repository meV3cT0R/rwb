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
            if(isset($_SESSION["user"])){
                logMessage($_SESSION["user"]->getRole());

            }else {
                logMessage("session not set");
            }
            require_once __DIR__."/../../public/index.php";
        }
        public function getLogin() : void {
            session_start();
            if(isset($_SESSION["user"])){
                if($_SESSION["user"]->getRole()=="ADMIN"){
                    header("Location: /realEstate/admin");
                }else {
                    header("Location: /realEstate");
                }
                return;
            }
            $login = function (string $username,string $password): ResDTO {
                $dto = new ResDTO("User Data");
                try {
                    $user = $this->userService->login($username,$password);
                    session_start();
                    $_SESSION["user"]=$user;
                    $dto->setData($user);
                }catch(Exception $e) {
                    $dto->setErrorDTO(new ErrorDTO(403,$e->getMessage()));
                }

                return $dto;
            };
            session_destroy();
            require_once __DIR__."/../../public/login.php";
        }
        public function getRegister() : void {
            session_start();
            if(isset($_SESSION["user"])){
                if($_SESSION["user"]->getRole()=="ADMIN"){
                    header("Location: /realEstate/admin");
                }else {
                    header("Location: /realEstate");
                }
                return;
            }
            $register = function (User $user): ResDTO {
                $dto = new ResDTO("User Data");
                try {
                    $user = $this->userService->register($user);
                    $dto->setData($user);
                }catch(Exception $e) {
                    $dto->setErrorDTO(new ErrorDTO(403,$e->getMessage()));
                }

                return $dto;
            };
            session_destroy();
            require_once __DIR__."/../../public/register.php";
        }

        public function getAbout() : void {
            require_once __DIR__."/../../public/about.php";
        }

        public function getProperties() : void {
            $properties = $this->propertyRepository->getProperties();
            require_once __DIR__."/../../public/properties.php";
        }

        public function getPropertyDetails($id) : void {
            logMessage($id);
            $property = $this->propertyRepository->getPropertyById($id);
            require_once __DIR__."/../../public/property-details.php";
        }

        public function getContact() : void {
            require_once __DIR__."/../../public/contact.php";
        }


        public function logout() : void {
            session_start();
            session_destroy();
            header("Location: /realEstate/login");
        }

        public function getUpdateProfile(): void {
            require_once __DIR__."/../../public/updateProfile.php";
        }


        public function getChangePassword() :void {
            require_once __DIR__."/../../public/changePassword.php";
        }
    }