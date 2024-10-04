<?php
    class CountryRepository {
        private CountryDAO $countryDAO;
        private CityDAO $cityDAO;
        private StateDAO $stateDAO;

        public function __construct(
            CountryDAO $countryDAO,
            CityDAO $cityDAO,
            StateDAO $stateDAO
        ) {
            Helper::checkDependencies(array(
                "CountryDAO" => $countryDAO,
                "CityDAO" => $cityDAO,
                "StateDAO" => $stateDAO,
            ));
            $this->countryDAO = $countryDAO;
            $this->cityDAO = $cityDAO;
            $this->stateDAO = $stateDAO;
        }

        public function getCountryById(int $id): Country {
            $country = $this->countryDAO->getCountryById($id);
            $cities = $this->cityDAO->getCities();
            $citiesOfCountry = [];

            foreach($cities as $city) {
                if($city->getCountry()->getId() == $country->getId()) {
                    array_push($citiesOfCountry, $city);
                }
            }

            $states = $this->stateDAO->getStates();
            $statesOfCountry = [];

            foreach($states as $state) {
                if($state->getCountry()->getId() == $country->getId()) {
                    array_push($statesOfCountry, $state);
                }
            }

            $country->setCities($citiesOfCountry);
            $country->setStates($statesOfCountry);
            return $country;
        }

        public function getCountries() : array {
            $countriesTemp = $this->countryDAO->getCountries();
            $countries = [];
            foreach ($countriesTemp as $country) {
                array_push($countries,$this->getCountryById($country->getId()));
            }
            return $countries;
        }

        public function postCountry(Country $country) : Country {
            return $this->countryDAO->postCountry($country);
        }

        public function updateCountry(Country $country) : Country {
            return $this->countryDAO->updatecountry($country);
        }

        public function deleteCountry(int $id) : Country {
            return $this->countryDAO->deleteCountry($id);
        }
    }