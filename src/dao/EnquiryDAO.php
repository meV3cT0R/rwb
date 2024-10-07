<!------
    Required Dependencies
        
---->
<?php
class EnquiryDAO
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
    private function rowMapHelper(array $row): Enquiry
    {
        $propertyType = new Enquiry();
        $propertyType->setId($row["id"]);
        $propertyType->setEnquiry($row["enquiry"]);
        $propertyType->setCreatedBy(new User($row["createdBy"]));
        $propertyType->setEnquiryFor(new Property($row["enquiryFor"]));
        
        return $propertyType;
    }

    public function getEnquiriesByPropertyId(int $propertyId): array
    {
        $objs = [];
        try {
            $stmt = $this->db->prepare("SELECT * FROM enquiry where enquiryFor=?;");
            $stmt->bind_param("i", $propertyId);
            if (!$stmt->execute()) {
                throw new Exception("Someting went wrong while trying to get the data");
            }
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    array_push($objs, $this->rowMapHelper($row));
                }
            }
        } catch (PDOException $pdoe) {
            throw new ErrorException("Database Error : " . $pdoe->getMessage());
        } catch (ErrorException $e) {
            throw $e;
        }
        return $objs;
    }

    public function getEnquiryById(int $id): Enquiry
    {
        $obj = null;
        try {
            $stmt = $this->db->prepare("SELECT * FROM enquiry where id=?;");
            $stmt->bind_param("i", $id);

            if (!$stmt->execute()) {
                throw new Exception("Someting went wrong while trying to get the data");
            }
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $obj = $this->rowMapHelper($row);
            }
        } catch (PDOException $pdoe) {
            throw new ErrorException("Database Error : " . $pdoe->getMessage());
        } catch (ErrorException $e) {
            throw $e;
        }
        return $obj;
    }

    public function  PostEnquiry(Enquiry $obj): Enquiry
    {
        try {
            $stmt = $this->db->prepare("INSERT
            INTO enquiry(
                    enquiry,
                    createdBy,
                    enquiryFor
                )
                values(
                    ?,
                    ?,
                    ?
                );
            ");

            $createdBy = null;
            if ($obj->getCreatedBy() != null) {
                $createdBy = $obj->getCreatedBy()->getId();
            }

            $enquiryFor = null;
            if ($obj->getEnquiryFor() != null) {
                $enquiryFor = $obj->getEnquiryFor()->getId();
            }
            $enquiry = $obj->getEnquiry();


            $stmt->bind_param(
                "sii",
                $enquiry,
                $createdBy,
                $enquiryFor
            );
            if (!$stmt->execute()) {
                throw new ErrorException("Data Insertion Failed");
            }

        } catch (PDOException $pdoe) {
            throw new ErrorException("Database Error : " . $pdoe->getMessage());
        } catch (ErrorException $e) {
            throw $e;
        }
        return $obj;
    }

    public function updateEnquiry(Enquiry $obj): Enquiry
    {
        // logMessage(msg: "Updating PropertyType with the id ".$obj->getId());

        try {
            $stmt = $this->db->prepare("UPDATE propertyType
            set enquiry=?,
                    createdBy=?,
                    enquiryFor=?
                where id=?
            ");
            $id = $obj->getId();
            $createdBy = null;
            if ($obj->getCreatedBy() != null) {
                $createdBy = $obj->getCreatedBy()->getId();
            }

            $enquiryFor = null;
            if ($obj->getEnquiryFor() != null) {
                $enquiryFor = $obj->getEnquiryFor()->getId();
            }
            $enquiry = $obj->getEnquiry();


            $stmt->bind_param(
                "siii",
                $enquiry,
                $createdBy,
                $enquiryFor,
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
        return $obj;
    }

    function deleteEnquiry(int $id): Enquiry
    {
        // logMessage("Deleting PropertyType with the id $id");
        $obj = null;
        try {
            $obj = $this->getEnquiryById($id);
            if ($obj === null) {
                throw new ErrorException("Enquiry with given id not found");
            }
            $stmt = $this->db->prepare("DELETE FROM enquiry where id=?");
            $stmt->bind_param("i", $id);
            if (!$stmt->execute()) {
                throw new ErrorException("Data Deletion Failed");
            }
        } catch (PDOException $pdoe) {
            throw new ErrorException("Database Error :  " . $pdoe->getMessage());
        } catch (ErrorException $e) {
            throw $e;
        }
        return $obj;
    }
}