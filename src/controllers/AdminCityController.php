<?php
    class AdminCityController {
        private CityRepository $cityRepository;

        public function __construct(
            CityRepository $cityRepository,
        ) {
            Helper::checkDependencies(array(
                "CityRepository" => $cityRepository
            ));
            $this->cityRepository = $cityRepository;
        }

        public function home() {
            $cities = $this->cityRepository->getCities();
            // echo implode($countries);

            $cols = ["City","State","Country"];
            $arr = array_map(function(City $city){
                    $subArr = [];
                    array_push($subArr, $city->getName());
                    if($city->getState() != null){
                        array_push($subArr, $city->getState()->getName());
                    }else {
                        array_push($subArr,"-");
                    }
                    if($city->getCountry() != null){
                        array_push($subArr, $city->getCountry()->getName());
                    }else {
                        array_push($subArr,"-");
                    }
                    return $subArr;
            },$cities);

            $title = "Cities";
            require_once __DIR__."/../../public/admin/table.php";
        }
    }