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
            $cols = ["Id","Property Type","Status","Year Built","Marketed By","Description","Price","Total Sq Ft","Lot Size" ,"Lot Size Unit"];
            $arr = array_map(function(Property $property){
                    $subArr = [];
                    array_push($subArr,  $property->getId());
                    array_push($subArr,  $property->getPropertyType()->getName());
                    array_push($subArr,  $property->getStatus());
                    array_push($subArr,  $property->getYearBuilt());
                    array_push($subArr,  $property->getMarketedBy()->getFirstName());
                    array_push($subArr,  $property->getDescription());
                    array_push($subArr,  $property->getPrice());
                    array_push($subArr,  $property->getTotalSqFt());
                    array_push($subArr,  $property->getLotSize());
                    array_push($subArr,  $property->getLotSizeUnit());
                    return $subArr;
            },$this->propertyRepository->getProperties());
            require_once __DIR__."/../../public/admin/table.php";

        }
        
    }