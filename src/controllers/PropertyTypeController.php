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
            $cols = ["id","Name","Action"];
            $add = true;
            $arr = array_map(function(PropertyType $propertyType){
                    $subArr = [];
                    array_push($subArr, $propertyType->getId());
                    array_push($subArr, $propertyType->getName());
                    array_push($subArr, "<a class='action-link edit' href='/realEstate/admin/propertyType/edit?id=".$propertyType->getId()."'>Edit</a> | <a class='action-link delete' href='/realEstate/admin/propertyType/delete?id=".$propertyType->getId()."'>Delete</a>");
                    return $subArr;
            },$propertyTypes);
            require_once __DIR__."/../../public/admin/table.php";
        }
        public function addPropertyType(bool $add=true, int $id = NULL) : void {
            $addPropertyType = function(PropertyType $propertyType): PropertyType {
                return $this->propertyTypeRepository->postPropertyType($propertyType);
                 
            }; 

            require_once __DIR__."/../../public/addPropertyType.php";
        }

        public function deletePropertyType($id): PropertyType {
            return $this->propertyTypeRepository->deletePropertyType($id);
        }

        public function editPropertyType(bool $add=true, int $id = NULL) : void {
            $propertyType = $this->propertyTypeRepository->getPropertyTypeById($id);
            $editPropertyType = function(PropertyType $propertyType): PropertyType {
                return $this->propertyTypeRepository->updatePropertyType($propertyType);
                 
            }; 
            require_once __DIR__."/../../public/addPropertyType.php";
        }
    }