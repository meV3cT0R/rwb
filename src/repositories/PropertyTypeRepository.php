<?php
    class PropertyTypeRepository {
        private PropertyTypeDAO $propertyTypeDAO;
        private UserDAO $userDAO;
        private RoleDAO $roleDAO;

        public function __construct(
            PropertyTypeDAO $propertyTypeDAO,
            UserDAO $userDAO,
            RoleDAO $roleDAO,
        ) {
            Helper::checkDependencies(array(
                "CityDAO" => $propertyTypeDAO,
                "UserDAO" => $userDAO,
                "RoleDAO" => $roleDAO,
            ));
            $this->propertyTypeDAO = $propertyTypeDAO;
            $this->userDAO = $userDAO;
            $this->roleDAO = $roleDAO;

        }

        public function getPropertyTypes(): array {
            $propertyTypes = $this->propertyTypeDAO->getPropertyTypes();
            $propertyTypesToBeSent = array();
            foreach($propertyTypes as $propertyType) {
                if($propertyType->getCreatedBy() !=null && $propertyType->getCreatedBy()->getId()!=null){
                    $createdBy = $this->userDAO->getUserById($propertyType->getCreatedBy()->getId());
                    if($createdBy!=null && $createdBy->getRole() !=null && $createdBy->getRole()->getId() !=null) {
                        $createdBy->setRole($this->roleDAO->getRoleById($createdBy->getRole()->getId()));
                    }
                    $propertyType->setCreatedBy($createdBy);
                }
                array_push($propertyTypesToBeSent,$propertyType);
            }
            return $propertyTypesToBeSent;
        }

        public function getPropertyTypeById($id) : PropertyType {
            $propertyType = $this->propertyTypeDAO->getPropertyTypeById($id);
            if($propertyType->getCreatedBy() !=null && $propertyType->getCreatedBy()->getId()!=null){
                $createdBy = $this->userDAO->getUserById($propertyType->getCreatedBy()->getId());
                if($createdBy!=null && $createdBy->getRole() !=null && $createdBy->getRole()->getId() !=null) {
                    $createdBy->setRole($this->roleDAO->getRoleById($createdBy->getRole()->getId()));
                }
                $propertyType->setCreatedBy($createdBy);
            }
            return $propertyType;
        }

        public function postPropertyType(PropertyType $propertyType) : PropertyType {
            return $this->propertyTypeDAO->postPropertyType($propertyType);
        }

        public function updatePropertyType(PropertyType $propertyType) : PropertyType {
            return $this->propertyTypeDAO->updatePropertyType($propertyType);
        }

        public function deletePropertyType(int $id) : PropertyType {
            return $this->propertyTypeDAO->deletePropertyType($id);
        }
    }