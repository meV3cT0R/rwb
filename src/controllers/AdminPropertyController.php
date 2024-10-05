<?php
    class AdminPropertyController {
        private PropertyRepository $propertyRepository;

        public function __construct(PropertyRepository $propertyRepository) {
            Helper::checkDependencies(array(
                "PropertyRepository"=>$propertyRepository
            ));
            $this->propertyRepository = $propertyRepository;
        }

        public function home () {
            $title= "Properties";
            $cols = ["Property Type","Status","Year Built","Marketed By","Description","Price","Total Sq Ft","Lot Size" ,"Lot Size Unit"];
            $arr = array_map(function(Property $property){
                    $subArr = [];
                    array_push($subArr, values: $property->getPropertyType());
                    array_push($subArr, values: $property->getStatus());
                    array_push($subArr, values: $property->getYearBuilt());
                    array_push($subArr, values: $property->getMarketedBy());
                    array_push($subArr, values: $property->getDescription());
                    array_push($subArr, values: $property->getPrice());
                    array_push($subArr, values: $property->getTotalSqFt());
                    array_push($subArr, values: $property->getLotSize());
                    array_push($subArr, values: $property->getLotSizeUnit());
                    return $subArr;
            },$this->propertyRepository->getProperties());
            require_once __DIR__."/../../public/admin/table.php";

        }
    }