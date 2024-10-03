<?php
    class PropertyTypeDAO {
        private mysqli $db;
        public function __construct(
            mysqli $db
        ) {
            if ($db == null) {
                throw new ErrorException("No Database Connection");
            }
        }

        public function getPropertyTypes() :array {
            return [];
        }

        public function getPropertyTypeById() : Property {
            return new Property();
        }

        
    }