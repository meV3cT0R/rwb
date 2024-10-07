<?php
    class PropertyRepository {
        private PropertyDAO $propertyDAO;
        private PropertyTypeDAO $propertyTypeDAO;
        private RoleDAO $roleDAO;
        private UserDAO $userDAO;

        public function __construct(
            PropertyDAO $propertyDAO,
            PropertyTypeDAO $propertyTypeDAO,
            UserDAO $userDAO,
            RoleDAO $roleDAO

        ) {
            Helper::checkDependencies(array(
                "PropertyDAO" => $propertyDAO,
                "PropertyTypeDAO" => $propertyTypeDAO,
                "UserDAO" => $userDAO,
                "RoleDAO" => $roleDAO
            ));
            $this->propertyDAO = $propertyDAO;
            $this->propertyTypeDAO = $propertyTypeDAO;
            $this->userDAO = $userDAO;
            $this->roleDAO = $roleDAO;
        }

        public function getProperties(): array {
            $properties = $this->propertyDAO->getProperties();
            
            $propertiesToBeSent = array();
            foreach($properties as $property) {
                $marketedBy = $this->userDAO->getUserById($property->getMarketedBy()->getId());
                $marketedBy->setRole($this->roleDAO->getRoleById($marketedBy->getRole()->getId()));
                $propertyType = $this->propertyTypeDAO->getPropertyTypeById($property->getPropertyType()->getId());
                
                $property->setMarketedBy($marketedBy);
                $property->setPropertyType($propertyType);
                array_push($propertiesToBeSent,$property);
            }
            return $propertiesToBeSent;
        }

        public function getPropertyById(int $id) : Property {
            $property = $this->propertyDAO->getPropertyById($id);

            $marketedBy = $this->userDAO->getUserById($property->getMarketedBy()->getId());
            $marketedBy->setRole($this->roleDAO->getRoleById($marketedBy->getRole()->getId()));
            $propertyType = $this->propertyTypeDAO->getPropertyTypeById($property->getPropertyType()->getId());
            
            $property->setMarketedBy($marketedBy);
            $property->setPropertyType($propertyType);
            return $property;
        }

        public function postProperty(Property $property) : Property {
            return $this->propertyDAO->postProperty($property);
        }

        public function updateProperty(Property $property) : Property {
            return $this->propertyDAO->updateProperty($property);
        }

        public function deleteProperty(int $id) : Property {
            return $this->propertyDAO->deleteProperty($id);
        }

        public function getStatuses() : array {
            return $this->propertyDAO->getAllStatuses();
        }
    }