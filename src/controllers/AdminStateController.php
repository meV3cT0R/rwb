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

            $cols = ["State","Country","No. of Cities","Actions"];
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
                    array_push($subArr, "<a class='action-link edit' href='/admin/state/edit?id=".$state->getId()."'>Edit</a> | <a class='action-link delete' href='/admin/state/delete?id=".$state->getId()."'>Delete</a>");
                    return $subArr;
            },$states);

            $title = "States";
            require_once __DIR__."/../../public/admin/table.php";
        }
        function addState() {
            require_once __DIR__."/../../public/addState.php";
        }
    }