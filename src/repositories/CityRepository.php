<?php
    class StateRepository {
        private CityDAO $cityDAO;

        public function __construct(
            CityDAO $cityDAO,
        ) {
            Helper::checkDependencies(array(
                "CityDAO" => $cityDAO,
            ));
            $this->cityDAO = $cityDAO;
        }

        public function getCityById(int $id): City {
            return $this->cityDAO->getCityById($id);
        }

        public function getCities() : array {
            return $this->cityDAO->getCities();

        }

        public function postCity(City $city) : City {
            return $this->cityDAO->postCity($city);
        }

        public function updateCity(City $city) : City {
            return $this->cityDAO->updateCity($city);
        }

        public function deleteCity(int $id) : City {
            return $this->cityDAO->deleteCity($id);
        }
    }