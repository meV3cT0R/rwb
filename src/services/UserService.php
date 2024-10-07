<?php
    class UserService {
        private UserRepository $userRepository;

        public function __construct(
            UserRepository $userRepository
            ) {
                Helper::checkDependencies(array(
                    "UserRepository" => $userRepository
                ));
                $this->userRepository= $userRepository;
        }
        public function login(string $username,string $password): UserDTO {
            try {
                $user = $this->userRepository->getUserByUsername($username);
                if(!password_verify($password,$user->getPassword())) {
                    throw new Exception("Invalid Username or Password");
                }
            } catch (Exception $e) {
                throw new Exception("Invalid Username or Password");
            }
            return new UserDTO($user);
        }

        public function register(User $user) : ?UserDTO {
            $userDTO = null;
            try {
                $user->setPassword(password_hash($user->getPassword(), PASSWORD_BCRYPT));
                $user=$this->userRepository->postUser($user);
                $userDTO = new UserDTO($user);
            }catch(Exception $e) {
                throw $e;
            }
            return $userDTO;
        }

        public function createSuperAdmin() {
            try{
                $user = $this->userRepository->getUserByUsername("superadmin");
                if($user != null) {
                    throw new Exception("Super Admin Already Exists");
                }
            }catch(
                Exception $e
            ){

            }
            $user = new User();

            $user->setFirstName("super");
            $user->setLastName("admin");
            $user->setEmail("superadmin@example.com");
            $user->setAvatar("email");

            $user->setUsername("superadmin");
            $user->setPassword(password_hash("superadmin",PASSWORD_BCRYPT));
            $user->setRole(new Role(1));
            $this->userRepository->postUser($user);
        }

        public function createUser() {
            try{
                $user = $this->userRepository->getUserByUsername("user");
                if($user != null) {
                    throw new Exception("User Already Exists");
                }
            }catch(
                Exception $e
            ){

            }
            $user = new User();

            $user->setFirstName("test");
            $user->setLastName("user");
            $user->setEmail("testuser@example.com");
            $user->setAvatar("avatar1.png");

            $user->setUsername("user");
            $user->setPassword(password_hash("user",PASSWORD_BCRYPT));
            $user->setRole(new Role(2));
            $this->userRepository->postUser($user);
        }

        public function createOwner() {
            try{
                $user = $this->userRepository->getUserByUsername("owner");
                if($user != null) {
                    throw new Exception("Owner Already Exists");
                }
            }catch(
                Exception $e
            ){

            }
            $user = new User();

            $user->setFirstName("test");
            $user->setLastName("owner");
            $user->setEmail("testowner@example.com");
            $user->setAvatar("avatar1.png");

            $user->setUsername("owner");
            $user->setPassword(password_hash("owner",PASSWORD_BCRYPT));
            $user->setRole(new Role(3));
            $this->userRepository->postUser($user);
        }

        public function createAgent() {
            try{
                $user = $this->userRepository->getUserByUsername("agent");
                if($user != null) {
                    throw new Exception("Agent Already Exists");
                }
            }catch(
                Exception $e
            ){

            }
            $user = new User();

            $user->setFirstName("test");
            $user->setLastName("agent");
            $user->setEmail("agent@example.com");
            $user->setAvatar("avatar1.png");

            $user->setUsername("agent");
            $user->setPassword(password_hash("agent",PASSWORD_BCRYPT));
            $user->setRole(new Role(4));
            $this->userRepository->postUser($user);
        }

        public function getUserById(int $id):User{
                return $this->userRepository->getUserById($id);
        }

        public function updateUser(User $user):User{
            return $this->userRepository->updateUser($user);
    }
    }