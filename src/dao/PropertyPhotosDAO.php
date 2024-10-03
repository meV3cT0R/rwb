<!------
    Required Dependencies
        
---->
<?php
class PropertyPhotosDAO
{
    private mysqli $db;
    public function __construct(
        mysqli $db
    ) {
        if ($db == null) {
            throw new ErrorException("No Database Connection");
        }
    }
    private function rowMapHelper(array $row): PropertyPhotos
    {
        $propertyPhoto = new PropertyPhotos();

        $propertyPhoto->setId($row["id"]);
        $propertyPhoto->setUrl($row["url"]);
        $propertyPhoto->setProperty($row["propertyId"]);

        return $propertyPhoto;
    }
    public function getPhotosByPropertyId(int $propertyId): array
    {
        $propertyPhotos = [];
        try {
            $propertyPhotosStmt = $this->db->prepare("SELECT * FROM propertyPhotos where propertyId=?;");

            if (!$propertyPhotosStmt->execute()) {
                throw new Exception("Someting went wrong while trying to get the data");
            }
            $propertyPhotosResult = $propertyPhotosStmt->get_result();
            if ($propertyPhotosResult->num_rows > 0) {
                while ($row = $propertyPhotosResult->fetch_assoc()) {
                    array_push($propertyPhotos, $this->rowMapHelper($row));
                }
            }
        } catch (PDOException $pdoe) {
            throw new ErrorException("Database Error : " . $pdoe->getMessage());
        } catch (ErrorException $e) {
            throw $e;
        }
        return $propertyPhotos;
    }

    public function getPropertyPhotosById(int $id): PropertyPhotos
    {
        $propertyPhoto = null;
        try {
            $propertyPhotosStmt = $this->db->prepare("SELECT * FROM propertyPhotos where propertyId=?;");

            if (!$propertyPhotosStmt->execute()) {
                throw new Exception("Someting went wrong while trying to get the data");
            }
            $propertyPhotosResult = $propertyPhotosStmt->get_result();
            if ($propertyPhotosResult->num_rows > 0) {
                $row = $propertyPhotosResult->fetch_assoc();
                $propertyPhoto = $this->rowMapHelper($row);
            }
        } catch (PDOException $pdoe) {
            throw new ErrorException("Database Error : " . $pdoe->getMessage());
        } catch (ErrorException $e) {
            throw $e;
        }
        return $propertyPhoto;
    }

    public function postPropertyPhoto(PropertyPhotos $propertyPhotos): PropertyPhotos
    {
        try {
            $stmt = $this->db->prepare("INSERT
            INTO property(
                    url,
                    propertyId
                )
                values(
                    ?,
                    ?
                );
            ");

            $propertyId = null;
            if ($propertyPhotos->getProperty() != null) {
                $propertyId = $propertyPhotos->getProperty()->getId();
            }
            $url = $propertyPhotos->getUrl();


            $stmt->bind_param(
                "si",
                $propertyId,
                $url,
            );
            if (!$stmt->execute()) {
                throw new ErrorException("Data Insertion Failed");
            }

        } catch (PDOException $pdoe) {
            throw new ErrorException("Database Error : " . $pdoe->getMessage());
        } catch (ErrorException $e) {
            throw $e;
        }
        return $propertyPhotos;
    }

    public function updatePropertyPhotos(PropertyPhotos $propertyPhotos): PropertyPhotos
    {
        try {
            $stmt = $this->db->prepare("UPDATE propertyPhotos
            set url=?,
                    propertyId=?
                where id=?
            ");
            $id = $propertyPhotos->getId();
            $propertyId = null;
            if ($propertyPhotos->getProperty() != null) {
                $propertyId = $propertyPhotos->getProperty()->getId();
            }
            $url = $propertyPhotos->getUrl();


            $stmt->bind_param(
                "sii",
                $propertyId,
                $url,
                $id
            );

            if (!$stmt->execute()) {
                throw new ErrorException("Data Updation Failed");
            }

        } catch (PDOException $pdoe) {
            throw new ErrorException("Database Error : " . $pdoe->getMessage());
        } catch (ErrorException $e) {
            throw $e;
        }
        return $propertyPhotos;
    }

    function deletePropertyPhotos(int $id): PropertyPhotos
    {
        logMessage("Deleting PropertyPhotos with the id $id");
        $propertyPhotos = null;
        try {
            $propertyPhotos = $this->getPropertyPhotosById($id);
            if ($propertyPhotos === null) {
                throw new ErrorException("Property with given id not found");
            }
            $stmt = $this->db->prepare("DELETE FROM propertyPhotos where id=?");
            $stmt->bind_param("s", $id);
            if (!$stmt->execute()) {
                throw new ErrorException("Data Deletion Failed");
            }
        } catch (PDOException $pdoe) {
            throw new ErrorException("Database Error :  " . $pdoe->getMessage());
        } catch (ErrorException $e) {
            throw $e;
        }
        return $propertyPhotos;
    }
}