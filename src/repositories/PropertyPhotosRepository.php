<?php
    class PropertyPhotosRepository {
        private PropertyPhotosDAO $propertyPhotosDAO;
        private PropertyDAO $propertyDAO;

        public function __construct(
            PropertyPhotosDAO $propertyPhotosDAO,
            PropertyDAO $propertyDAO,
        ) {
            Helper::checkDependencies(array(
                "PropertyPhotosDAO" => $propertyPhotosDAO,
                "PropertyDAO" => $propertyDAO,
            ));
            $this->propertyPhotosDAO = $propertyPhotosDAO;
            $this->propertyDAO = $propertyDAO;

        }

        public function getPhotosByPropertyId(int $id): array {
            $propertyPhotos = $this->propertyPhotosDAO->getPhotosByPropertyId($id);
            $propertyPhotosToBeSent = array();
            foreach($propertyPhotos as $propertyPhoto) {
                $property = $this->propertyDAO->getPropertyById($propertyPhoto->getProperty()->getId());
                $propertyPhoto->setProperty($property);
                array_push($propertyPhotosToBeSent,$propertyPhoto);
            }
            return $propertyPhotosToBeSent;
        }

        public function getPropertyPhotoById(int $id) : PropertyPhotos {
            $propertyPhoto = $this->propertyPhotosDAO->getPropertyPhotosById($id);
            $property = $this->propertyDAO->getPropertyById($propertyPhoto->getProperty()->getId());
            $propertyPhoto->setProperty($property);
            return $propertyPhoto;
        }

        public function postPropertyPhoto(PropertyPhotos $propertyPhoto) : PropertyPhotos {
            return $this->propertyPhotosDAO->postPropertyPhoto($propertyPhoto);
        }

        public function updatePropertyPhotos(PropertyPhotos $propertyType) : PropertyPhotos {
            return $this->propertyPhotosDAO->updatePropertyPhotos($propertyType);
        }

        public function deletePropertyPhotos(int $id) : PropertyPhotos {
            return $this->propertyPhotosDAO->deletePropertyPhotos($id);
        }
    }