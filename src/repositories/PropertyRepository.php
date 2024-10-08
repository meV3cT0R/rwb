<?php
    class PropertyRepository {
        private PropertyDAO $propertyDAO;
        private PropertyTypeDAO $propertyTypeDAO;
        private RoleDAO $roleDAO;
        private UserDAO $userDAO;
        private EnquiryDAO $enquiryDAO;
        private CommentDAO $commentDAO;

        private PropertyPhotosDAO $propertyPhotosDAO;
        private CityDAO $cityDAO;

        public function __construct(
            PropertyDAO $propertyDAO,
            PropertyTypeDAO $propertyTypeDAO,
            PropertyPhotosDAO $propertyPhotosDAO,
            UserDAO $userDAO,
            RoleDAO $roleDAO,
            EnquiryDAO $enquiryDAO,
            CommentDAO $commentDAO,
            CityDAO $cityDAO
        ) {
            Helper::checkDependencies(array(
                "PropertyDAO" => $propertyDAO,
                "PropertyTypeDAO" => $propertyTypeDAO,
                "UserDAO" => $userDAO,
                "RoleDAO" => $roleDAO,
                "CommentDAO" => $commentDAO,
                "CityDAO" => $cityDAO,
            ));
            $this->propertyDAO = $propertyDAO;
            $this->propertyTypeDAO = $propertyTypeDAO;
            $this->userDAO = $userDAO;
            $this->roleDAO = $roleDAO;
            $this->enquiryDAO = $enquiryDAO;
            $this->commentDAO = $commentDAO;
            $this->propertyPhotosDAO = $propertyPhotosDAO;
            $this->cityDAO = $cityDAO;
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
                $enquiries = $this->enquiryDAO->getEnquiriesByPropertyId($property->getId());
                if($enquiries!=null ) {
                    foreach($enquiries as $enquiry) {
                        if($enquiry->getId()!=null) {
                            $enquiry->setCreatedBy($this->userDAO->getUserById($enquiry->getCreatedBy()->getId()));
                            $enquiry->setComments($this->commentDAO->getCommentsByEnquiryId($enquiry->getId()));
                        }
                    }
                }
                $property->setEnquiries($enquiries);


                if($property->getCity() !=null && $property->getCity()->getId()!=null) {
                    $city = $this->cityDAO->getCityById($property->getCity()->getId());
                    $property->setCity($city);
                }
                $propertyPhotos = $this->propertyPhotosDAO->getPhotosByPropertyId($property->getId());
                $property->setPropertyPhotos($propertyPhotos);

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

            $enquiries = $this->enquiryDAO->getEnquiriesByPropertyId($property->getId());
            if($enquiries!=null ) {
                foreach($enquiries as $enquiry) {
                    if($enquiry->getId()!=null) {
                        $enquiry->setCreatedBy($this->userDAO->getUserById($enquiry->getCreatedBy()->getId()));
                        $enquiry->setComments($this->commentDAO->getCommentsByEnquiryId($enquiry->getId()));
                    }
                }
            }
            $property->setEnquiries($enquiries);

            if($property->getCity() !=null && $property->getCity()->getId()!=null) {
                $city = $this->cityDAO->getCityById($property->getCity()->getId());
                $property->setCity($city);
            }

            $propertyPhotos = $this->propertyPhotosDAO->getPhotosByPropertyId($property->getId());
            
            $property->setPropertyPhotos($propertyPhotos);
            return $property;
        }

        public function postProperty(Property $property) : Property {
            $property = $this->propertyDAO->postProperty($property);
            if($property->getPropertyPhotos()!=null) {        
                $photos = $property->getPropertyPhotos();

                foreach($photos as $photo) {
                    $photo->setProperty($property);
                    $this->propertyPhotosDAO->postPropertyPhoto($photo);
                }
            }

            return $property;
        }

        public function updateProperty(Property $property) : Property {
            $property = $this->propertyDAO->updateProperty($property);
            if($property->getPropertyPhotos()!=null) {        
                $photos = $property->getPropertyPhotos();

                foreach($photos as $photo) {
                    $photo->setProperty($property);
                    $this->propertyPhotosDAO->postPropertyPhoto($photo);
                }
            
             return $property;
        }
    }

        public function deleteProperty(int $id) : Property {
            return $this->propertyDAO->deleteProperty($id);
        }

        public function getStatuses() : array {
            return $this->propertyDAO->getAllStatuses();
        }
    }