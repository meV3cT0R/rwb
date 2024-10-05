<?php
    class AdminStateController {
        private StateRepository $stateRepository;

        public function __construct(
            StateRepository $stateRepository
        ) {
            Helper::checkDependencies(array(
                "StateRepository" => $stateRepository
            ));
            $this->stateRepository = $stateRepository;
        }

        public function home() {
            $states = $this->stateRepository->getStates();
            // echo implode($countries);

            $cols = ["State","Country","No. of Cities"];
            $arr = array_map(function(State $state){
                    $subArr = [];
                    array_push($subArr, $state->getName());
                    if($state->getCountry() != null){
                        array_push($subArr, $state->getCountry()->getName());
                    }else {
                        array_push($subArr,"-");
                    }
                    if($state->getCities() != null){
                        array_push($subArr, count($state->getCities()));
                    }else {
                        array_push($subArr,"-");
                    }
                    return $subArr;
            },$states);

            $title = "States";
            require_once __DIR__."/../../public/admin/table.php";
        }
    }