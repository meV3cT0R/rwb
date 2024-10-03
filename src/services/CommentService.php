<!----
    Required Dependencies  
    Comment
----->
<?php
logMessage("inside CommentService.php");

class CommentService
{
    private mysqli $db;
    private UserService $userService;

    private PropertyPhotosServices $propertyPhotosServices;
    private EnquiryService $enquiryService;

    private PropertyService $propertyService;

    function __construct(
        mysqli $dbConnection,
        UserService $userService,
        PropertyPhotosServices $propertyPhotosServices,
        EnquiryService $enquiryService,
        PropertyService $propertyService
    ) {
        if ($dbConnection == null) {
            throw new ErrorException("No Database Connection");
        }
        Helper::checkDependencies([
            'UserService' => $userService,
            'PropertyPhotosServices' => $propertyPhotosServices,
            'EnquiryService' => $enquiryService,
            'PropertyService' => $propertyService,
        ]);
        $this->db = $dbConnection;
        $this->userService = $userService;
        $this->propertyPhotosServices = $propertyPhotosServices;
        $this->enquiryService = $enquiryService;
        $this->propertyService = $propertyService;
    }

    function getCommentsByEnquiryId(int $id): array
    {
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
                    $propertyMarketedByUserRole = new Role(
                        (int) $row["marketedByRoleId"],
                        $row["marketedByRoleName"]
                    );
                    $propertyMarketedByUser = new User(
                        (int) $row["marketedByUserId"],
                        $row["marketedByUserFirstName"],
                        $row["marketedByUserLastName"],
                        $row["marketedByUserEmail"],
                        $row["marketedByUserUsername"],
                        $row["marketedByUserPassword"],
                        $propertyMarketedByUserRole,
                        $row["marketedByUserAvatar"]
                    );
                    $property = new Property(
                        (int) $row["propertyId"],
                        $propertyType,
                        $row["propertyStatus"],
                        $row["propertyYearBuilt"],
                        $propertyMarketedByUser,
                        $row["propertyTypeName"],
                        $row["propertyTypeName"],
                        $row["propertyTypeName"],
                        (float) $row["propertyTypeName"],
                        $row["propertyTypeName"],
                        null,
                        $this->propertyPhotosServices->getPhotosByPropertyId((int) $row["propertyId"])
                    );
                    $comment = new Comment(
                        (int) $row["commentId"],
                        $user,
                        $row["comment"],
                        $property
                    );
                    array_push($comments, $comment);
                }
            }
        } catch (PDOException $pdoe) {
            throw new ErrorException("Database Message : " . $pdoe->getMessage());
        } catch (ErrorException $e) {
            throw $e;
        }

        return $comments;
    }

    function getCommentById(int $id): Comment
    {
        logMessage("Getting Comment");
        $comment = null;
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
            where id=?;
            ");
            $commentStmt->bind_param("i", $id);

            if (!$commentStmt->execute()) {
                throw new ErrorException("Something went wrong while trying to run SELECT query");
            }

            $result = $commentStmt->get_result();
            $row = $result->fetch_assoc();
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
            $propertyMarketedByUserRole = new Role(
                (int) $row["marketedByRoleId"],
                $row["marketedByRoleName"]
            );
            $propertyMarketedByUser = new User(
                (int) $row["marketedByUserId"],
                $row["marketedByUserFirstName"],
                $row["marketedByUserLastName"],
                $row["marketedByUserEmail"],
                $row["marketedByUserUsername"],
                $row["marketedByUserPassword"],
                $propertyMarketedByUserRole,
                $row["marketedByUserAvatar"]
            );
            $property = new Property(
                (int) $row["propertyId"],
                $propertyType,
                $row["propertyStatus"],
                $row["propertyYearBuilt"],
                $propertyMarketedByUser,
                $row["propertyTypeName"],
                $row["propertyTypeName"],
                $row["propertyTypeName"],
                (float) $row["propertyTypeName"],
                $row["propertyTypeName"],
                null,
                $this->propertyPhotosServices->getPhotosByPropertyId((int) $row["propertyId"])
            );
            $comment = new Comment(
                (int) $row["commentId"],
                $user,
                $row["comment"],
                $property
            );
        } catch (PDOException $pdoe) {
            throw new ErrorException("Database Message : " . $pdoe->getMessage());
        } catch (ErrorException $e) {
            throw $e;
        }

        return $comment;
    }


    function postComment(Comment $comment): Comment
    {
        logMessage("Posting Comment");
        try {
            $stmt = $this->db->prepare("INSERT INTO Comment(comment,createdBy,commentFor) values(?,?,?)");
            $name = $comment->getComment();
            $createdById = $comment->getCreatedBy()->getId();
            $commentForId = $comment->getCommentFor()->getId();
            $stmt->bind_param("sii", $name, $createdById, $commentForId);

            if (!$stmt->execute()) {
                throw new ErrorException("Data Insertion Failed");
            }
            $comment->setId($this->db->insert_id);
        } catch (PDOException $pdoe) {
            throw new ErrorException("Database Error :  " . $pdoe->getMessage());
        } catch (ErrorException $e) {
            throw $e;
        }
        return $comment;
    }

    function updateComment(Comment $comment): Comment
    {
        logMessage("Updating Comment");
        try {
            $stmt = $this->db->prepare("UPDATE comment set comment=? where id=?");
            $name = $comment->getComment();
            $id = $comment->getId();

            $stmt->bind_param("s", $name, $id);

            if (!$stmt->execute()) {
                throw new ErrorException("Data Updation Failed");
            }
        } catch (PDOException $pdoe) {
            throw new ErrorException("Database Error :  " . $pdoe->getMessage());
        } catch (ErrorException $e) {
            throw $e;
        }
        return $comment;
    }

    function deleteCountry(int $id): Comment
    {
        logMessage("Deleting data with the id $id");
        $comment = null;
        try {
            $comment = $this->getCommentById($id);
            $stmt = $this->db->prepare("DELETE FROM comment where id=?");
            $stmt->bind_param("i", $id);
            if (!$stmt->execute()) {
                throw new ErrorException("Data Deletion Failed");
            }
        } catch (PDOException $pdoe) {
            throw new ErrorException("Database Error :  " . $pdoe->getMessage());
        } catch (ErrorException $e) {
            throw $e;
        }
        return $comment;
    }
}



