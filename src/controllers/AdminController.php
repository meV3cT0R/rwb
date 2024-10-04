<?php
    class AdminController {
        private PropertyTypeRepository $propertyTypeRepository;
        private CountryRepository $countryRepository;
        private StateRepository $stateRepository;
        private CityRepository $cityRepository;
        private UserRepository $userRepository;
        private PropertyRepository $propertyRepository;

        public function __construct(
            PropertyTypeRepository $propertyTypeRepository,
            CountryRepository $countryRepository,
            StateRepository $stateRepository,
            CityRepository $cityRepository,
            UserRepository $userRepository,
            PropertyRepository $propertyRepository,
        ) {
            Helper::checkDependencies(array(
                "PropertyTypeRepository" => $propertyTypeRepository,
                "CountryRepository" => $countryRepository,
                "StateRepository" => $stateRepository,
                "CityRepository" => $cityRepository,
                "UserRepository" => $userRepository,
                "PropertyRepository" => $propertyRepository
            ));
            $this->propertyTypeRepository = $propertyTypeRepository;
            $this->countryRepository = $countryRepository;
            $this->stateRepository = $stateRepository;
            $this->cityRepository = $cityRepository;
            $this->userRepository = $userRepository;
            $this->propertyRepository = $propertyRepository;
        }

        public function dashboard() : void {
            $totalPropertyTypes = count($this->propertyTypeRepository->getPropertyTypes());
            $totalCountry = count($this->countryRepository->getCountries());
            $totalState = count($this->stateRepository->getStates());
            $totalCity = count($this->cityRepository->getCities());
            $totalAgent = count($this->userRepository->getUsersByRoleName("AGENT"));
            $totalOwner = count($this->userRepository->getUsersByRoleName("OWNER"));
            $totalUser = count($this->userRepository->getUsersByRoleName("USER"));
            $totalProperties = count($this->propertyRepository->getProperties());
            require_once __DIR__."/../../public/admin/dashboard.php";
        }
    }