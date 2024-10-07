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

            $cols = ["City","State","Country","Actions"];
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
                    array_push($subArr, "<a class='action-link edit' href='/admin/city/edit?id=".$city->getId()."'>Edit</a> | <a class='action-link delete' href='/admin/city/delete?id=".$city->getId()."'>Delete</a>");
                    return $subArr;
            },$cities);

            $title = "Cities";
            require_once __DIR__."/../../public/admin/table.php";
        }
        public function addCity() {
            require_once __DIR__."/../../public/addCity.php";
        }
    }