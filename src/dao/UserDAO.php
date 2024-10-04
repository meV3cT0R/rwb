<!------
    Required Dependencies
        
---->
<?php
class UserDAO
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
    private function rowMapHelper(array $row): User
    {
        $user = new User();

        $user->setId($row["id"]);
        $user->setFirstName($row["firstName"]);
        $user->setLastName($row["lastName"]);
        $user->setEmail($row["email"]);
        $user->setUsername($row["username"]);
        $user->setPassword($row["password"]);
        $user->setRole(new Role($row["roleId"]));
        $user->setAvatar($row["avatar"]);

        return $user;
    }

    private function queryHelper($initQuery,$map,&$query="",&$bindArr=[],&$bindString="") {
        $query = $initQuery. " ";
        $i =0;
        foreach ($map as $key => $value) {
            if($i=0){
                $query .= "where ";
            }
            $query .= "$key=?";
            if($i!=count($map)-1) {
                $query .= " and ";
            }
        }
        foreach ($map as $key => $value) {
            array_push($bindArr,$value["value"]);
            array_push($bindString,$value["type"]);
        }
        $query .=";";
    }

    public function getUsersHelper(array $map) :array{
        $query = "";
        $bindArr = [];
        $bindString = "";

        $this->queryHelper("SELECT * FROM user",$map,$query,$bindArr,$bindString);

        $users = [];
        try {
            $stmt = $this->db->prepare($query);
            if($bindString !=""){
                $stmt->bind_param($bindString, $bindArr);
            }

            if (!$stmt->execute()) {
                throw new Exception("Someting went wrong while trying to get the data");
            }
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    array_push($users, $this->rowMapHelper($row));
                }
            }
        } catch (PDOException $pdoe) {
            throw new ErrorException("Database Error : " . $pdoe->getMessage());
        } catch (ErrorException $e) {
            throw $e;
        }
        return $users;
    }
    public function getUsers(): array
    {
        return $this->getUsersHelper(array(

        ));
    }
    public function getUsersByRole(int $roleId): array
    {
        return $this->getUsersHelper(array(
            "role" => array(
                "type" => "i",
                "value" => $roleId
            )
        ));
    }
    private function getUserHelper(array $map): User{
        $query = "";
        $bindArr = [];
        $bindString = "";

        $this->queryHelper("SELECT * FROM user",$map,$query,$bindArr,$bindString);

        $user = null;
        try {
            $stmt = $this->db->prepare($query);


            $stmt->bind_param($bindString, $bindArr);

            if (!$stmt->execute()) {
                throw new Exception("Someting went wrong while trying to get the data");
            }
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $user = $this->rowMapHelper($row);
            }
        } catch (PDOException $pdoe) {
            throw new ErrorException("Database Error : " . $pdoe->getMessage());
        } catch (ErrorException $e) {
            throw $e;
        }
        return $user;
    }
    public function getUserById(int $id): User
    {
        return $this->getUserHelper(array(
            "id"=> array(
                "type" => "i",
                "value" => $id
            )
        ));
    }

    public function getUserByUsername(string $username): User {
        return $this->getUserHelper(array(
            "username"=> array(
                "type" => "s",
                "value" => $username
            )
        ));
    }

    public function getUserByUsernameAndPassword(string $username,string $password): User {
        return $this->getUserHelper(array(
            "username"=> array(
                "type" => "s",
                "value" => $username
            ),
            "password"=> array(
                "type" => "s",
                "value" => $password
            ),
        ));
    }
    public function postUser(User $user): User
    {
        try {
            $stmt = $this->db->prepare("INSERT
            INTO user(
                    firstName,
                    lastName,
                    email,
                    username,
                    password,
                    role,
                    avatar
                )
                values(
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?
                );
            ");

            $roleId = null;
            if ($user->getRole() != null) {
                $roleId = $user->getRole()->getId();
            }
            $firstName = $user->getFirstName();
            $email = $user->getEmail();
            $lastName = $user->getLastName();
            $username = $user->getUsername();
            $password = $user->getPassword();
            $avatar = $user->getAvatar();


            $stmt->bind_param(
                "sssssis",
                $firstName,
                $lastName,
                $email,
                $username,
                $password,
                $roleId,
                $avatar,
            );
            if (!$stmt->execute()) {
                throw new ErrorException("Data Insertion Failed");
            }

        } catch (PDOException $pdoe) {
            throw new ErrorException("Database Error : " . $pdoe->getMessage());
        } catch (ErrorException $e) {
            throw $e;
        }
        return $user;
    }

    public function updateUser(User $user): User
    {
        try {
            $stmt = $this->db->prepare("UPDATE users
            set firstName=?,
                    lastName=?,
                    email=?,
                    username=?,
                    password=?,
                    role=?,
                    avatar=?
                where id=?
            ");
            $id = $user->getId();
            $roleId = null;
            if ($user->getRole() != null) {
                $roleId = $user->getRole()->getId();
            }
            $firstName = $user->getFirstName();
            $email = $user->getEmail();
            $lastName = $user->getLastName();
            $username = $user->getUsername();
            $password = $user->getPassword();
            $avatar = $user->getAvatar();


            $stmt->bind_param(
                "sssssisi",
                $firstName,
                $lastName,
                $email,
                $username,
                $password,
                $roleId,
                $avatar,
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
        return $user;
    }

    function deleteUser(int $id): User
    {
        logMessage("Deleting Users with the id $id");
        $user = null;
        try {
            $user = $this->getUserById($id);
            if ($user === null) {
                throw new ErrorException("Property with given id not found");
            }
            $stmt = $this->db->prepare("DELETE FROM user where id=?");
            $stmt->bind_param("i", $id);
            if (!$stmt->execute()) {
                throw new ErrorException("Data Deletion Failed");
            }
        } catch (PDOException $pdoe) {
            throw new ErrorException("Database Error :  " . $pdoe->getMessage());
        } catch (ErrorException $e) {
            throw $e;
        }
        return $user;
    }
}