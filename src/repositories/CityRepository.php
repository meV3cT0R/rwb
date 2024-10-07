<?php
    class CityRepository {
        private CityDAO $cityDAO;

        public function __construct(
            CityDAO $cityDAO,
        ) {
            // Check if dependencies are provided
            Helper::checkDependencies(array(
                "CityDAO" => $cityDAO,
            ));
            $this->cityDAO = $cityDAO;
        }

        // Retrieve a city by its ID
        public function getCityById(int $id): City {
            return $this->cityDAO->getCityById($id);
        }

        // Retrieve all cities
        public function getCities() : array {
            return $this->cityDAO->getCities();
        }

        // Add a new city
        public function postCity(City $city) : City {
            return $this->cityDAO->postCity($city);
        }

        // Update an existing city
        public function updateCity(City $city) : City {
            return $this->cityDAO->updateCity($city);
        }

        // Delete a city by its ID
        public function deleteCity(int $id) : City {
            return $this->cityDAO->deleteCity($id);
        }
    }