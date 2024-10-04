<?php
    class StateRepository {
        private CityDAO $cityDAO;
        private StateDAO $stateDAO;

        public function __construct(
            CityDAO $cityDAO,
            StateDAO $stateDAO
        ) {
            Helper::checkDependencies(array(
                "CityDAO" => $cityDAO,
                "StateDAO" => $stateDAO,
            ));
            $this->cityDAO = $cityDAO;
            $this->stateDAO = $stateDAO;
        }

        public function getStateById(int $id): State {
            $state = $this->stateDAO->getStateById($id);
            $cities = $this->cityDAO->getCities();
            $citiesOfState = [];
            foreach($cities as $city) {
                if($city->getState()->getId() == $state->getId()) {
                    array_push($citiesOfState, $city);
                }
            }

            $state->setCities($citiesOfState);
            return $state;
        }

        public function getStates() : array {
            $statesTemp = $this->stateDAO->getStates();
            $states = [];
            foreach ($statesTemp as $state) {
                array_push($states,$this->getStateById($state->getId()));
            }
            return $states;
        }

        public function postState(State $state) : State {
            return $this->stateDAO->postState($state);
        }

        public function updateState(State $state) : State {
            return $this->stateDAO->updateState($state);
        }

        public function deleteState(int $id) : State {
            return $this->stateDAO->deleteState($id);
        }
    }