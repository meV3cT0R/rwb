<?php
    class EnquiryDAO {
        private mysqli $db;
        public function __construct(
            mysqli $db,
        ) {
            if ($db == null) {
                throw new ErrorException("No Database Connection");
            }
        }

        public function getEnquiriesByPropertyId() :array {
            return [];
        }

        public function getEnquiriesByUserId() : Property {
            return new Property();
        }

        
    }