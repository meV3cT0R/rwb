<?php
    class UserRepository {
        private RoleDAO $roleDAO;
        private UserDAO $userDAO;

        public function __construct(
            UserDAO $userDAO,
            RoleDAO $roleDAO

        ) {
            Helper::checkDependencies(array(
                "UserDAO" => $userDAO,
                "RoleDAO" => $roleDAO
            ));
            $this->userDAO = $userDAO;
            $this->roleDAO = $roleDAO;
        }

        public function getUsers(): array {
            $users = $this->userDAO->getUsers();
            logMessage(implode($users));
            $usersToBeSent = array();
            foreach($users as $user) {
                $user->setRole($this->roleDAO->getRoleById($user->getRole()->getId()));

                array_push($usersToBeSent,$user);
            }
            return $usersToBeSent;
        }

        public function getUsersByRoleId(int $id) : array {
            return $this->userDAO->getUsersByRole($id);
        }
        public function getUserById(int $id) : User {
            $user = $this->userDAO->getUserById($id);
            if($user->getRole()!=null) {
                if($user->getRole()->getId()!=null) {
                    $user->setRole($this->roleDAO->getRoleById($user->getRole()->getId()));
                }else if($user->getRole()->getName()!=null){
                    $user->setRole($this->roleDAO->getRoleByName($user->getRole()->getId()));

                }
            }

            return $user;
        }

        public function getUserByUsername(string $username) : ?User {
            $user = $this->userDAO->getUserByUsername($username);
            $user->setRole($this->roleDAO->getRoleById($user->getRole()->getId()));
            return $user;
        }

        public function getUserByUsernameAndPassword(string $username,string $password) : User {
            try {
                $user = $this->userDAO->getUserByUsernameAndPassword($username,$password);
            }catch(Exception $e) {
                throw new Exception("User with given Username and Password not Found");
            }
            
            $user->setRole($this->roleDAO->getRoleById($user->getRole()->getId()));
            return $user;
        }

        public function getUsersByRoleName(string $roleName) : array {
            $users = $this->getUsers();
            logMessage($roleName);

            $usersWithSpecificRole = [];
            foreach($users as $user) {
                logMessage($user->getRole()->getName());
                if(strcmp(strtoupper($user->getRole()->getName()),strtoupper($roleName))==0){
                    array_push($usersWithSpecificRole,$user);
                }
            }
            return $usersWithSpecificRole;
        }
        public function postUser(User $user) : User {
            return $this->userDAO->postUser($user);
        }

        public function updateUser(User $user) : User {
            return $this->userDAO->updateUser($user);
        }

        public function deleteUser(int $id) : User {
            return $this->userDAO->deleteUser($id);
        }

        public function updatePassword(User $user): mixed {
            return $this->userDAO->updatePassword($user);
        }
    }