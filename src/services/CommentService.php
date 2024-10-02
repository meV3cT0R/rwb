<!----
    Required Dependencies  
----->
<?php
logMessage("inside CommentService.php");

class CommentService
{
    private mysqli $db;
    private UserService $userService;
    private PropertyPhotosServices $propertyPhotosServices;

    function __construct(
        mysqli $dbConnection,
        UserService $userService,
        PropertyPhotosServices $propertyPhotosServices
    ) {
        if ($dbConnection == null) {
            throw new ErrorException("No Database Connection");
        }
        Helper::checkDependencies([
            'UserService' => $userService,
            'PropertyPhotosServices' => $propertyPhotosServices
        ]);
        $this->db = $dbConnection;
        $this->userService = $userService;
        $this->propertyPhotosServices = $propertyPhotosServices;

    }

    function getCommentsByEnquiryId(int $id): array{
        logMessage("Getting Comments");
        $comments = [];
        try {
            $commentStmt = $this->db->prepare("SELECT 
            comment.id as commentId,
            comment.createdBy as commentCreatedBy,
            comment.commentFor as commentFor,
            comment.comment as comment,
            user.id as userId,
            user.firstName as userFirstName,
            user.lastName as userLastName,
            user.email as userEmail,
            user.username as userUsername,
            user.password as userPassword,
            role.id as roleId,
            role.name as roleName,
            user.avatar as userAvatar,
            property.id as propertyId,
            propertyType.id as propertyTypeId,
            propertyType.name as propertyTypeName,
            property.status as propertyStatus,
            property.yearBuilt as propertyYearBuilt,
            property.marketedBy as propertyMarketedBy,
            property.description as propertyDescription,
            property.price as propertyPrice,
            property.totalSqFt as propertyTotalSqFt,
            property.lotSizeUnit as propertyLotSizeUnit,
            property.lotSize as lotSize
            marketedBy.id as marketedByUserId,
            marketedBy.firstName as marketedByUserFirstName,
            marketedBy.lastName as marketedByUserLastName,
            marketedBy.email as marketedByUserEmail,
            marketedBy.username as marketedByUserUsername,
            marketedBy.password as marketedByUserPassword,
            marketedByRole.id as marketedByRoleId,
            marketedByRole.name as marketedByRoleName,
            marketedBy.avatar as marketedByUserAvatar
            FROM comment
                left join user on user.id=comment.createdBy
                left join property on property.id=comment.commentFor
                left join role on user.roleId=role.id
                left join propertyType on property.propertyType=propertyType.id
                left join user as marketedBy on marketedBy.id=property.marketedBy
                left join role as marketedByRole on marketedBy.roleId=marketedByRole.id
            where commentFor=?;
            ");
            $commentStmt->bind_param("i", $id);

            if (!$commentStmt->execute()) {
                throw new ErrorException("Something went wrong while trying to run SELECT query");
            }

            $commentStmt->execute();
            $result = $commentStmt->get_result();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $role = new Role(
                        (int) $row["roleId"],
                        $row["roleName"]
                    );
                    $user = new User(
                        (int) $row["userId"],
                        $row["userFirstName"],
                        $row["userLastName"],
                        $row["userEmail"],
                        $row["userUsername"],
                        $row["userPassword"],
                        $role,
                        $row["userAvatar"]
                    );
                    $propertyType = new PropertyType(
                        (int) $row["propertyTypeId"],
                        $row["propertyTypeName"]
                    );
                    $PropertyMarketedByUserRole = new Role(
                        (int) $row["marketedByRoleId"],
                        $row["marketedByRoleName"]
                    );
                    $PropertyMarketedByUser = new User(
                        (int) $row["marketedByUserId"],
                        $row["marketedByUserFirstName"],
                        $row["marketedByUserLastName"],
                        $row["marketedByUserEmail"],
                        $row["marketedByUserUsername"],
                        $row["marketedByUserPassword"],
                        $PropertyMarketedByUserRole,
                        $row["marketedByUserAvatar"]
                    );
                    $property = new Property(
                        (int) $row["propertyId"],
                        $propertyType,
                        $row["propertyStatus"],
                        $row["propertyYearBuilt"],
                        $row["propertyMarketedBy"],
                        $row["propertyTypeName"],
                        $row["propertyTypeName"],
                        $row["propertyTypeName"],
                        (float) $row["propertyTypeName"],
                        $row["propertyTypeName"],
                        null,
                        $this->propertyPhotosServices->getPhotosByPropertyId((int) $row["propertyId"])
                    );
                    $comment = new Comment();
                }
            }
        } catch (PDOException $pdoe) {
            throw new ErrorException("Database Message : " . $pdoe->getMessage());
        } catch (ErrorException $e) {
            throw $e;
        }

        return $comments;
    }

    function getCountryById(int $id): Country{
        logMessage("Getting Country by Id");
        $result = $this->db->query("SELECT * FROM country where id='$id';") or trigger_error("Something Went wrong while trying to execute SELECT query");
        $country = new Country();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $country->setId((int) $row["id"]);
            $country->setName($row["name"]);
        } else {
            throw new ErrorException("Country with Provided Id not found");
        }
        return $country;
    }


    function postCountry(Country $country): Country{
        logMessage("Posting Country");
        try {
            $stmt = $this->db->prepare("INSERT INTO country(name) values(?)");
            $name = $country->getName();
            $stmt->bind_param("s", $name);

            if (!$stmt->execute()) {
                throw new ErrorException("Data Insertion Failed");
            }
            $country->setId($this->db->insert_id);
        } catch (PDOException $pdoe) {
            throw new ErrorException("Database Error :  " . $pdoe->getMessage());
        } catch (ErrorException $e) {
            throw $e;
        }
        return $country;
    }

    function updateCountry(Country $country): Country{
        logMessage("Updating Country");
        try {
            $stmt = $this->db->prepare("UPDATE country set name=? where id=?");
            $name = $country->getName();
            $id = $country->getId();
            $stmt->bind_param("si", $name, $id);

            if (!$stmt->execute()) {
                throw new ErrorException("Data Updation Failed");
            }
        } catch (PDOException $pdoe) {
            throw new ErrorException("Database Error :  " . $pdoe->getMessage());
        } catch (ErrorException $e) {
            throw $e;
        }
        return $country;
    }

    function deleteCountry(int $id): Country{
        logMessage("Deleting data with the id $id");
        $country = null;
        try {
            $country = $this->getCountryById($id);
            $stmt = $this->db->prepare("DELETE FROM country where id=?");
            $stmt->bind_param("s", $id);
            if (!$stmt->execute()) {
                throw new ErrorException("Data Deletion Failed");
            }
        } catch (PDOException $pdoe) {
            throw new ErrorException("Database Error :  " . $pdoe->getMessage());
        } catch (ErrorException $e) {
            throw $e;
        }
        return $country;
    }
}



