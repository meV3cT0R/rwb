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
            
            $usersToBeSent = array();
            foreach($users as $user) {
                $user->setRole($this->roleDAO->getRoleById($user->getRole()->getId()));

                array_push($users,$user);
            }
            return $usersToBeSent;
        }

        public function getUserById(int $id) : User {
            $user = $this->userDAO->getUserById($id);

            $user->setRole($this->roleDAO->getRoleById($user->getRole()->getId()));

            return $user;
        }

        public function getUserByUsername(string $username) : User {
            $user = $this->userDAO->getUserByUsername($username);
            $user->setRole($this->roleDAO->getRoleById($user->getRole()->getId()));
            return $user;
        }

        public function getUserByUsernameAndPassword(string $username,string $password) : User {
            $user = $this->userDAO->getUserByUsernameAndPassword($username,$password);
            $user->setRole($this->roleDAO->getRoleById($user->getRole()->getId()));
            return $user;
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
    }