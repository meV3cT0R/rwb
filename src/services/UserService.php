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
    }