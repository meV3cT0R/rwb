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
            $login = function (string $username,string $password): ResDTO {
                $dto = new ResDTO("User Data");
                try {
                    $user = $this->userService->login($username,$password);
                    $dto->setData($user);
                }catch(Exception $e) {
                    $error = $e->getMessage();
                    $dto->setErrorDTO(new ErrorDTO(403,$e->getMessage()));
                }

                return $dto;

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