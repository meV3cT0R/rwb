<?php

    class PropertyTypeController {
        private PropertyTypeRepository $propertyTypeRepository;
        
        public  function __construct(
            PropertyTypeRepository $propertyTypeRepository
            ) {
                Helper::checkDependencies(array(
                    "PropertyTypeRepository"=> $propertyTypeRepository
                ));
                $this->propertyTypeRepository = $propertyTypeRepository;
        }
        public function home():void {
            $propertyTypes = $this->propertyTypeRepository->getPropertyTypes();
            $cols = ["id","Name"];
            $arr = array_map(function(PropertyType $propertyType){
                    $subArr = [];
                    array_push($subArr, $propertyType->getId());
                    array_push($subArr, $propertyType->getName());

                    return $subArr;
            },$propertyTypes);
            require_once __DIR__."/../../public/admin/table.php";
        }
    }