<!------
    Required Dependencies
        
---->
<?php
class PropertyTypeDAO
{
    private mysqli $db;
    public function __construct(
        mysqli $db
    ) {
        if ($db == null) {
            throw new ErrorException("No Database Connection");
        }
        $this->db = $db;
    }
    private function rowMapHelper(array $row): PropertyType
    {
        $propertyType = new PropertyType();

        $propertyType->setId($row["id"]);
        $propertyType->setName($row["name"]);
        $propertyType->setCreatedBy(new User($row["createdBy"]));

        return $propertyType;
    }

    public function getPropertyTypes(): array
    {
        $propertyTypes = [];
        try {
            $stmt = $this->db->prepare("SELECT * FROM propertyType;");

            if (!$stmt->execute()) {
                throw new Exception("Someting went wrong while trying to get the data");
            }
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    array_push($propertyTypes, $this->rowMapHelper($row));
                }
            }
        } catch (PDOException $pdoe) {
            throw new ErrorException("Database Error : " . $pdoe->getMessage());
        } catch (ErrorException $e) {
            throw $e;
        }
        return $propertyTypes;
    }

    public function getPropertyTypeById(int $id): PropertyType
    {
        $propertyType = null;
        try {
            $stmt = $this->db->prepare("SELECT * FROM propertyType where id=?;");
            $stmt->bind_param("i", $id);

            if (!$stmt->execute()) {
                throw new Exception("Someting went wrong while trying to get the data");
            }
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $propertyType = $this->rowMapHelper($row);
            }
        } catch (PDOException $pdoe) {
            throw new ErrorException("Database Error : " . $pdoe->getMessage());
        } catch (ErrorException $e) {
            throw $e;
        }
        return $propertyType;
    }

    public function postPropertyType(PropertyType $propertyType): PropertyType
    {
        try {
            $stmt = $this->db->prepare("INSERT
            INTO propertyType(
                    name,
                    createdBy
                )
                values(
                    ?,
                    ?
                );
            ");

            $createdBy = null;
            if ($propertyType->getCreatedBy() != null) {
                $createdBy = $propertyType->getCreatedBy()->getId();
            }
            $name = $propertyType->getName();


            $stmt->bind_param(
                "si",
                $name,
                $createdBy,
            );
            if (!$stmt->execute()) {
                throw new ErrorException("Data Insertion Failed");
            }

        } catch (PDOException $pdoe) {
            throw new ErrorException("Database Error : " . $pdoe->getMessage());
        } catch (ErrorException $e) {
            throw $e;
        }
        return $propertyType;
    }

    public function updatePropertyType(PropertyType $propertyType): PropertyType
    {
        logMessage(msg: "Updating PropertyType with the id ".$propertyType->getId());

        try {
            $stmt = $this->db->prepare("UPDATE propertyType
            set name=?,
                    createdBy=?
                where id=?
            ");
            $id = $propertyType->getId();
            $createdBy = null;
            if ($propertyType->getCreatedBy() != null) {
                $createdBy = $propertyType->getCreatedBy()->getId();
            }
            $name = $propertyType->getName();


            $stmt->bind_param(
                "sii",
                $name,
                $createdBy,
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
        return $propertyType;
    }

    function deletePropertyType(int $id): PropertyType
    {
        logMessage("Deleting PropertyType with the id $id");
        $propertyType = null;
        try {
            $propertyType = $this->getPropertyTypeById($id);
            if ($propertyType === null) {
                throw new ErrorException("Property with given id not found");
            }
            $stmt = $this->db->prepare("DELETE FROM propertyPhotos where id=?");
            $stmt->bind_param("i", $id);
            if (!$stmt->execute()) {
                throw new ErrorException("Data Deletion Failed");
            }
        } catch (PDOException $pdoe) {
            throw new ErrorException("Database Error :  " . $pdoe->getMessage());
        } catch (ErrorException $e) {
            throw $e;
        }
        return $propertyType;
    }
}