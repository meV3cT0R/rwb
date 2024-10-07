<?php

    class PropertyTypeController {
        private mysqli $db;
        private PropertyTypeRepository $propertyTypeRepository;
        
        public  function __construct(
            mysqli $dbConnection=null,
            PropertyTypeRepository $propertyTypeRepository
            ) {
                Helper::checkDependencies(array(
                    "PropertyTypeRepository"=> $propertyTypeRepository
                ));
                $this->propertyTypeRepository = $propertyTypeRepository;
                if($dbConnection===null){
                    throw new ErrorException("No Database Connection");
                }
    
                $this->db = $dbConnection;
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
        public function addPropertyType(PropertyType $propertyType):ResDTO {
            $dto = new ResDTO("Property Type Data");
            try {
                $propertyType = $this->propertyTypeRepository->postPropertyType($propertyType);
                $dto->setData($propertyType);
            }catch(Exception $e) {
                $dto->setErrorDTO(new ErrorDTO(403,$e->getMessage()));
            }
            return $dto;
        }
    }