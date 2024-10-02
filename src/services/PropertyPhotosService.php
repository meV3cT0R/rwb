<!------
    Required Dependencies
        
---->
<?php
    class PropertyPhotosServices {
        private mysqli $db;

        function __construct(
            mysqli $dbConnection,
        ) {
            if($dbConnection == null) {
                throw new ErrorException("No Database Connection");
            }
            $this->db = $dbConnection;
        }

        public function getPhotosByPropertyId(int $id) : array {
            return [];
        }
    }