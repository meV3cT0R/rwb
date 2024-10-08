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
            if($i==0){
                $query .= "where ";
            }
            $query .= "$key=?";
            if($i!=count($map)-1) {
                $query .= " and ";
            }
            $i++;
        }
        foreach ($map as $key => $value) {
            array_push($bindArr,$value["value"]);
            $bindString .= $value["type"];
        }
        $query .=";";
    }

    public function getUsersHelper(array $map) :array{
        $query = "";
        $bindArr = [];
        $bindString = "";

        $this->queryHelper("SELECT * FROM user",$map,$query,$bindArr,$bindString);
        logMessage($query);
        $users = [];
        try {
            $stmt = $this->db->prepare($query);
            if($bindString !=""){
                $params = array_merge([$bindString],$bindArr);
                call_user_func_array([$stmt,"bind_param"],Helper::refValues($params));
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

            logMessage("length : ".$result->num_rows);
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
            "roleId" => array(
                "type" => "i",
                "value" => $roleId
            )
        ));
    }
    private function getUserHelper(array $map): ?User{
        $query = "";
        $bindArr = [];
        $bindString = "";

        $this->queryHelper("SELECT * FROM user",$map,$query,$bindArr,$bindString);
        // logMessage("Generated Query :".$query);
        // logMessage("Generated bind types :".$bindString);
        // logMessage("Generated bind values :".implode($bindArr));

        $user = null;
        try {
            $stmt = $this->db->prepare($query);
            $params = array_merge([$bindString],$bindArr);
            call_user_func_array([$stmt,"bind_param"],Helper::refValues($params));

            if (!$stmt->execute()) {
                throw new Exception("Someting went wrong while trying to get the data");
            }
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $user = $this->rowMapHelper($row);
            }else {
                throw new Exception("User not found with given information");
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

    public function getUserByUsername(string $username): ?User {
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
                    roleId,
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

            
            logMessage($firstName);
            logMessage($lastName);
            logMessage($username);
            logMessage($email);
            logMessage($password);
            logMessage($roleId);
            logMessage($avatar);


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

            logMessage($this->db->error);
            logMessage($this->db->info);

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
            $stmt = $this->db->prepare("UPDATE user
            set firstName=?,
                    lastName=?,
                    email=?,
                    username=?,
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
            $avatar = $user->getAvatar();

            logMessage("firstNam: $firstName");
            logMessage("lastName : $lastName");
            logMessage("username: $username");
            logMessage("Inside Update User");

            $stmt->bind_param(
                "sssssi",
                $firstName,
                $lastName,
                $email,
                $username,
                $avatar,
                $id
            );
            logMessage("Inside Update User after bind_param");

            if (!$stmt->execute()) {
                throw new ErrorException("Data Updation Failed");
            }
            logMessage("Inside Update User after bind_param after stmt_execution");
            logMessage($this->db->error);
            logMessage($this->db->info);

        } catch (PDOException $pdoe) {
            throw new ErrorException("Database Error : " . $pdoe->getMessage());
        } catch (ErrorException $e) {
            throw $e;
        }
        return $user;
    }

    function deleteUser(int $id): User
    {
        // logMessage("Deleting Users with the id $id");
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

    public function updatePassword(User $user): User {
        try {
            $stmt = $this->db->prepare("UPDATE user
            set password=?
                where id=?
            ");
            $id = $user->getId();

            $password = $user->getPassword();

            logMessage("Inside Update Password");

            $stmt->bind_param(
                "si",
                $password,
                $id
            );
            logMessage("Inside Update User after bind_param");

            if (!$stmt->execute()) {
                throw new ErrorException("Data Updation Failed");
            }
            logMessage("Inside Update User after bind_param after stmt_execution");
            logMessage($this->db->error);
            logMessage($this->db->info);

        } catch (PDOException $pdoe) {
            throw new ErrorException("Database Error : " . $pdoe->getMessage());
        } catch (ErrorException $e) {
            throw $e;
        }
        return $user;
    }
}