<?php
    class PropertyDAO {
        private mysqli $db;
        public function __construct(
            mysqli $db
        ) {
            if ($db == null) {
                throw new ErrorException("No Database Connection");
            }
        }

        public function getProperties() :array {
            return [];
        }

        public function getPropertyById(int $id) : Property {
            return new Property();
        }

    }