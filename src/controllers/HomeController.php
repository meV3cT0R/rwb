<?php
    class HomeController {

        private PropertyRepository $propertyRepository;
        public function __construct(
            PropertyRepository $propertyRepository
        ) {
            Helper::checkDependencies(
                array(
                    "PropertyRepository" => $propertyRepository
                )
                );
            $this->propertyRepository = $propertyRepository;
        }

        public function home() : void {
            require_once __DIR__."/../../public/index.php";
        }
        public function getLogin() : void {
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

        public function getPropertyDetails($id) : void {
            logMessage($id);
            $property = $this->propertyRepository->getPropertyById($id);
            require_once __DIR__."/../../public/property-details.php";
        }

        public function getContact() : void {
            require_once __DIR__."/../../public/contact.php";
        }
    }