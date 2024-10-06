<?php
class PropertyDAO
{
    private mysqli $db;
    public function __construct(
        mysqli $db
    ) {
        if ($db == null) {
            throw new ErrorException("No Database Connection");
        }
        $this->db=$db;
    }

    public function getProperties(): array
    {
        $properties = [];
        try {
            $propertyResult = $this->db->query("SELECT * FROM property;");
            if ($propertyResult->num_rows > 0) {
                while ($row = $propertyResult->fetch_assoc()) {
                    $property = new Property();
                    $property->setId($row["id"]);
                    $property->setStatus($row["status"]);
                    $property->setYearBuilt($row["yearBuilt"]);
                    $property->setDescription($row["description"]);
                    $property->setPrice($row["price"]);
                    $property->setTotalSqFt($row["totalSqFt"]);
                    $property->setLotSizeUnit($row["lotSizeUnit"]);
                    $property->setLotSize($row["lotSize"]);
                    $property->setAddress($row["address"]);
                    $property->setCity(new City($row["cityId"]));
                    $property->setPropertyType(new PropertyType($row["propertyType"]));
                    $property->setMarketedBy(new User($row["marketedBy"]));

                    array_push($properties, $property);
                }
            }
        } catch (PDOException $pdoe) {
            throw new ErrorException("Database Error : " . $pdoe->getMessage());
        } catch (ErrorException $e) {
            throw $e;
        }
        return $properties;
    }

    public function getPropertyById(int $id): Property
    {
        $property = null;
        try {
            $propertyResult = $this->db->query("SELECT * FROM property;");
            if ($propertyResult->num_rows > 0) {
                $row = $propertyResult->fetch_assoc();
                $property = new Property();
                $property->setId($row["id"]);
                $property->setStatus($row["status"]);
                $property->setYearBuilt($row["yearBuilt"]);
                $property->setDescription($row["description"]);
                $property->setPrice($row["price"]);
                $property->setTotalSqFt($row["totalSqFt"]);
                $property->setLotSizeUnit($row["lotSizeUnit"]);
                $property->setLotSize($row["lotSize"]);
                $property->setAddress($row["address"]);
                $property->setCity(new City($row["cityId"]));
                $property->setPropertyType(new PropertyType($row["propertyType"]));
                $property->setMarketedBy(new User($row["marketedBy"]));
            }
        } catch (PDOException $pdoe) {
            throw new ErrorException("Database Error : " . $pdoe->getMessage());
        } catch (ErrorException $e) {
            throw $e;
        }
        return $property;
    }

    public function postProperty(Property $property) : Property {
        try {
            $propertyStmt = $this->db->prepare("INSERT
            INTO property(
                    propertyType,
                    status,
                    yearBuilt,
                    marketedBy,
                    description,
                    price,
                    totalSqFt,
                    lotSizeUnit,
                    lotSize,
                    address,
                    cityId    
                )

                values(
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?
                );
            ");
            $propertyType=null;
            if($property->getPropertyType()!=null){
                $propertyType =  $property->getPropertyType()->getId();
            }
            $status = $property->getStatus();
            $yearBuilt = $property->getYearBuilt();
            $marketedBy = $property->getMarketedBy();
            $description = $property->getDescription();
            $price = $property->getPrice();
            $totalSqFt = $property->getTotalSqFt();
            $lotSizeUnit = $property->getLotSizeUnit();
            $lotSize = $property->getLotSize();
            $address = $property->getAddress();
            $cityId = null;
            if($property->getCity()!=null)
                $cityId = $property->getCity()->getId();
            

            $propertyStmt->bind_param("isiisffsfsi",
                $propertyType,
                $status,
                $yearBuilt,
                $marketedBy,
                $description,
                $price,
                $totalSqFt,
                $lotSizeUnit,
                $lotSize,
                $address,
                $cityId
            );
            if(!$propertyStmt->execute()){
                throw new ErrorException("Data Insertion Failed");
            }

        } catch (PDOException $pdoe) {
            throw new ErrorException("Database Error : " . $pdoe->getMessage());
        } catch (ErrorException $e) {
            throw $e;
        }
        return $property;
    }

    public function updateProperty(Property $property): Property
    {
        try {
            $propertyStmt = $this->db->prepare("UPDATE property
            set propertyType=?,
                    status=?,
                    yearBuilt=?,
                    marketedBy=?,
                    description=?,
                    price=?,
                    totalSqFt=?,
                    lotSizeUnit=?,
                    lotSize=?    
                where id=?
            ");
            $id = $property->getId();
            $propertyType=null;
            if($property->getPropertyType()!=null){
                $propertyType =  $property->getPropertyType()->getId();
            }
            $status = $property->getStatus();
            $yearBuilt = $property->getYearBuilt();
            $marketedBy = $property->getMarketedBy();
            $description = $property->getDescription();
            $price = $property->getPrice();
            $totalSqFt = $property->getTotalSqFt();
            $lotSizeUnit = $property->getLotSizeUnit();
            $lotSize = $property->getLotSize();
            

            $propertyStmt->bind_param("isiisffsfi",
                $propertyType,
                $status,
                $yearBuilt,
                $marketedBy,
                $description,
                $price,
                $totalSqFt,
                $lotSizeUnit,
                $lotSize,
                $id
            );

            if(!$propertyStmt->execute()){
                throw new ErrorException("Data Insertion Failed");
            }

        } catch (PDOException $pdoe) {
            throw new ErrorException("Database Error : " . $pdoe->getMessage());
        } catch (ErrorException $e) {
            throw $e;
        }
        return $property;
    }

    function deleteProperty(int $id) : Property {
        logMessage("Deleting Property with the id $id");
        $property = null;
        try{
            $property = $this->getPropertyById($id);
            if($property===null){
                throw new ErrorException("Property with given id not found");
            }
            $stmt = $this->db->prepare("DELETE FROM property where id=?");
            $stmt->bind_param("s",$id);
            if(!$stmt->execute()) {
                throw new ErrorException("Data Deletion Failed");
            }
        }catch(PDOException $pdoe) {
            throw new ErrorException("Database Error :  ".$pdoe->getMessage());
        }catch(ErrorException $e) {
            throw $e;
        }
        return $property;
    }
}