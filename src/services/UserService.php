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
    }