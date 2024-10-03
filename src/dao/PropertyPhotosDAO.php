<!------
    Required Dependencies
        
---->
<?php
    class PropertyPhotosDAO {
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