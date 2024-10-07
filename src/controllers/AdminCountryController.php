<?php
    class AdminCountryController {
        private CountryRepository $countryRepository;

        public function __construct(
            CountryRepository $countryRepository,
        ) {
            // Check if dependencies are provided
            Helper::checkDependencies(array(
                "CountryRepository" => $countryRepository,
            ));
            $this->countryRepository = $countryRepository;
        }

        // Method to display the home page with countries list
        public function home() {
            $countries = $this->countryRepository->getCountries();
            // Columns for the table
            $cols = ["Country","No. of States","No. of Cities","Actions"];
            $add = true;
            // Map countries to table rows
            $arr = array_map(function(Country $country){
                    $subArr = [];
                    array_push($subArr, $country->getName());
                    if($country->getStates() != null){
                        array_push($subArr, count($country->getStates()));
                    } else {
                        array_push($subArr,"-");
                    }
                    if($country->getCities() != null){
                        array_push($subArr, count($country->getCities()));
                    } else {
                        array_push($subArr,"-");
                    }
                    // Add action links for edit and delete
                    array_push($subArr, "<a class='action-link edit' href='/realEstate/admin/country/edit?id=".$country->getId()."'>Edit</a> | <a class='action-link delete' href='/realEstate/admin/country/delete?id=".$country->getId()."'>Delete</a>");
                    return $subArr;
            }, $countries);
            $title = "Countries";
            // Include the table view
            require_once __DIR__."/../../public/admin/table.php";
        }

        // Method to add a new country
        public function addCountry(bool $add=true, int $id = NULL) : void {
            // Function to save the country
            $saveCountry = function(Country $country) : Country {
                return $this->countryRepository->postCountry($country);
            };
            
            require_once __DIR__."/../../public/addCountry.php";
        }
        public function editCountry(bool $add=true, int $id = NULL) : void {
            $country = $this->countryRepository->getCountryById($id);
            $updateCountry = function(Country $country) : Country {
                return $this->countryRepository->updateCountry($country);
            };
            require_once __DIR__."/../../public/addCountry.php";
        }
        public function deleteCountry(int $id) :Country {
            return $this->countryRepository->deleteCountry($id);
        }
    }