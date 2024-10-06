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
                $user = $this->userRepository->getUserByUsernameAndPassword($username,password_hash($password,PASSWORD_BCRYPT));
            } catch (Exception $e) {
                throw new Exception("Invalid Username or Password");
            }
            return new UserDTO($user);
        }
        

        public function register(User $user) : ?UserDTO {
            return null;
        }
    }