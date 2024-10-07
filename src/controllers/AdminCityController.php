<?php
    class AdminCityController {
        private CityRepository $cityRepository; // Repository for city data
        private StateRepository $stateRepository; // Repository for state data
        private CountryRepository $countryRepository; // Repository for country data

        public function __construct(
            CityRepository $cityRepository,
            StateRepository $stateRepository,
            CountryRepository $countryRepository,
        ) {
            // Check if dependencies are properly injected
            Helper::checkDependencies(array(
                "CityRepository" => $cityRepository,
                "StateRepository" => $stateRepository,
                "CountryRepository" => $countryRepository
            ));
            $this->cityRepository = $cityRepository; // Initialize city repository
            $this->stateRepository = $stateRepository; // Initialize state repository
            $this->countryRepository = $countryRepository; // Initialize country repository
        }

        public function home() {
            $cities = $this->cityRepository->getCities(); // Fetch all cities

            $cols = ["City","State","Country","Actions"]; // Table columns
            $add = true; // Flag to allow adding new entries
            $arr = array_map(function(City $city){
                    $subArr = [];
                    array_push($subArr, $city->getName()); // Add city name
                    if($city->getState() != null){
                        array_push($subArr, $city->getState()->getName()); // Add state name if exists
                    }else {
                        array_push($subArr,"-"); // Placeholder if state is null
                    }
                    if($city->getCountry() != null){
                        array_push($subArr, $city->getCountry()->getName()); // Add country name if exists
                    }else {
                        array_push($subArr,"-"); // Placeholder if country is null
                    }
                    // Add action links for edit and delete
                    array_push($subArr, "<a class='action-link edit' href='/realEstate/admin/city/edit?id=".$city->getId()."'>Edit</a> | <a class='action-link delete' href='/realEstate/admin/city/delete?id=".$city->getId()."'>Delete</a>");
                    return $subArr;
            },$cities);

            $title = "Cities"; // Page title
            require_once __DIR__."/../../public/admin/table.php"; // Include table view
        }

        public function addCity(bool $add=true, int $id = NULL) : void {
            $states= $this->stateRepository->getStates(); // Fetch all states
            $countries = $this->countryRepository->getCountries(); // Fetch all countries

            // Function to save city data
            $saveCity = function(City $city) : City {
                return $this->cityRepository->postCity($city);
            };

            require_once __DIR__."/../../public/addCity.php"; // Include add city view
        }
    }