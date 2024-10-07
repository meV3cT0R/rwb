<?php
    class HomeController {

        private PropertyRepository $propertyRepository;
        private UserService $userService;
        private PropertyTypeRepository $propertyTypeRepository;
        private CityRepository $cityRepository;
        private CommentRepository $commentRepository;
        private EnquiryRepository $enquiryRepository;

        public function __construct(
            PropertyRepository $propertyRepository,
            UserService $userService,
            PropertyTypeRepository $propertyTypeRepository,
            CityRepository $cityRepository,
            CommentRepository $commentRepository,
            EnquiryRepository $enquiryRepository,
        ) {
            Helper::checkDependencies(
                array(
                    "PropertyRepository" => $propertyRepository,
                    "UserService" => $userService,
                    "PropertyTypeRepository" => $propertyTypeRepository,
                    "CityRepository" => $cityRepository,
                    "CommentRepository" => $commentRepository,
                    "EnquiryRepository" => $enquiryRepository

                )
            );
            $this->propertyRepository = $propertyRepository;
            $this->userService = $userService;
            $this->propertyTypeRepository = $propertyTypeRepository;
            $this->cityRepository = $cityRepository;
            $this->commentRepository = $commentRepository;
            $this->enquiryRepository = $enquiryRepository;

        }

        public function home() : void {
            session_start();
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
            require_once __DIR__."/../../public/register.php";
        }

        public function getAbout() : void {
            require_once __DIR__."/../../public/about.php";
        }

        public function getProperties() : void {
            $propertiesInitial = $this->propertyRepository->getProperties();
            $types = $this->propertyTypeRepository->getPropertyTypes();
            $status = $this->propertyRepository->getStatuses();
            $cities = $this->cityRepository->getCities();

            $search = function($type,$status,$city): array {
                $arr = [];

                $properties = $this->propertyRepository->getProperties();
                foreach ($properties as $property) {
                    if(
                        ($property->getPropertyType()->getId() == $type || $type=="all" ) &&
                        (strtolower($property->getStatus()) == strtolower($status) || $status=="all" ) &&
                        ($property->getCity()->getId() == $city || $city=="all" )
                    ) {
                        array_push($arr,$property);
                    }
                }

                return $arr;
            };
            require_once __DIR__."/../../public/properties.php";
        }

        public function getPropertyDetails($id) : void {
            logMessage($id);
            $property = $this->propertyRepository->getPropertyById($id);
            $saveComment = function (Comment $comment) : Comment{
                return $this->commentRepository->postComment($comment);
            };

            $saveEnquiry = function (Enquiry $enquiry):Enquiry {
                return $this->enquiryRepository->postEnquiry($enquiry);
            };
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
            session_start();
            $user = $this->userService->getUserById($_SESSION["user"]->getId());
            $editUser = function (User $user) {
                $this->userService->updateUser($user);
            };

            require_once __DIR__."/../../public/updateProfile.php";
        }


        public function getChangePassword() :void {
            require_once __DIR__."/../../public/changePassword.php";
        }
        public function manageProperties() : void {
            $properties = $this->propertyRepository->getProperties();
            $types = $this->propertyTypeRepository->getPropertyTypes();
            $status = $this->propertyRepository->getStatuses();
            $cities = $this->cityRepository->getCities();

            $search = function($type,$status,$city): array {
                $arr = [];

                $properties = $this->propertyRepository->getProperties();
                foreach ($properties as $property) {
                    if(
                        ($property->getPropertyType()->getId() == $type || $type=="all" ) &&
                        (strtolower($property->getStatus()) == strtolower($status) || $status=="all" ) &&
                        ($property->getCity()->getId() == $city || $city=="all" )
                    ) {
                        array_push($arr,$property);
                    }
                }

                return $arr;
            };
            require_once __DIR__."/../../public/manageProperties.php";
        }
        public function addProperties(bool $add = true, int $id = NULL ) : void {
            require_once __DIR__."/../../public/addProperty.php";
        }
        public function deleteProperties(int $id ) : void {
            // do stuff
        }
    }