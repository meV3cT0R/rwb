<?php
    class AdminCountryController {
        private CountryRepository $countryRepository;

        public function __construct(
            CountryRepository $countryRepository,
        ) {
            Helper::checkDependencies(array(
                "CountryRepository" => $countryRepository,

            ));
            $this->countryRepository = $countryRepository;
        }
        public function home() {
            $countries = $this->countryRepository->getCountries();
            // echo implode($countries);
            $cols = ["Country","No. of States","No. of Cities","Actions"];
            $add = true;
            $arr = array_map(function(Country $country){
                    $subArr = [];
                    array_push($subArr, $country->getName());
                    if($country->getStates() != null){
                        array_push($subArr, count($country->getStates()));
                    }else {
                        array_push($subArr,"-");
                    }
                    if($country->getCities() != null){
                        array_push($subArr, count($country->getCities()));
                    }else {
                        array_push($subArr,"-");
                    }
                    array_push($subArr, "<a class='action-link edit' href='/realEstate/admin/country/edit?id=".$country->getId()."'>Edit</a> | <a class='action-link delete' href='/realEstate/admin/country/delete?id=".$country->getId()."'>Delete</a>");
                    return $subArr;
            },$countries);
            $title = "Countries";
            require_once __DIR__."/../../public/admin/table.php";
        }
        public function addCountry(bool $add=true, int $id = NULL) : void {
            $saveCountry = function(Country $country) : Country {
                return $this->countryRepository->postCountry($country);
            };

            require_once __DIR__."/../../public/addCountry.php";
        }
    }