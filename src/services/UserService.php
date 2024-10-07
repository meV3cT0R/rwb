<?php
    class UserService {
        private UserRepository $userRepository;

        public function __construct(
            UserRepository $userRepository
            ) {
                // Check if dependencies are provided
                Helper::checkDependencies(array(
                    "UserRepository" => $userRepository
                ));
                $this->userRepository= $userRepository;
        }

        public function login(string $username, string $password): UserDTO {
            try {
                // Fetch user by username
                $user = $this->userRepository->getUserByUsername($username);
                // Verify password
                if (!password_verify($password, $user->getPassword())) {
                    throw new Exception("Invalid Username or Password");
                }
            } catch (Exception $e) {
                throw new Exception("Invalid Username or Password");
            }
            return new UserDTO($user);
        }

        public function register(User $user): ?UserDTO {
            $userDTO = null;
            try {
                // Hash user password
                $user->setPassword(password_hash($user->getPassword(), PASSWORD_BCRYPT));
                // Save user to repository
                $user = $this->userRepository->postUser($user);
                $userDTO = new UserDTO($user);
            } catch (Exception $e) {
                throw $e;
            }
            return $userDTO;
        }

        public function createSuperAdmin() {
            try {
                // Check if super admin already exists
                $user = $this->userRepository->getUserByUsername("superadmin");
                if ($user != null) {
                    throw new Exception("Super Admin Already Exists");
                }
            } catch (Exception $e) {
                // Handle exception
            }
            $user = new User();

            // Set super admin details
            $user->setFirstName("super");
            $user->setLastName("admin");
            $user->setEmail("superadmin@example.com");
            $user->setAvatar("email");

            $user->setUsername("superadmin");
            $user->setPassword(password_hash("superadmin", PASSWORD_BCRYPT));
            $user->setRole(new Role(1));
            // Save super admin to repository
            $this->userRepository->postUser($user);
        }

        public function createUser() {
            try {
                // Check if user already exists
                $user = $this->userRepository->getUserByUsername("user");
                if ($user != null) {
                    throw new Exception("User Already Exists");
                }
            } catch (Exception $e) {
                // Handle exception
            }
            $user = new User();

            // Set user details
            $user->setFirstName("test");
            $user->setLastName("user");
            $user->setEmail("testuser@example.com");
            $user->setAvatar("avatar1.png");

            $user->setUsername("user");
            $user->setPassword(password_hash("user", PASSWORD_BCRYPT));
            $user->setRole(new Role(2));
            // Save user to repository
            $this->userRepository->postUser($user);
        }

        public function createOwner() {
            try {
                // Check if owner already exists
                $user = $this->userRepository->getUserByUsername("owner");
                if ($user != null) {
                    throw new Exception("Owner Already Exists");
                }
            } catch (Exception $e) {
                // Handle exception
            }
            $user = new User();

            // Set owner details
            $user->setFirstName("test");
            $user->setLastName("owner");
            $user->setEmail("testowner@example.com");
            $user->setAvatar("avatar1.png");

            $user->setUsername("owner");
            $user->setPassword(password_hash("owner", PASSWORD_BCRYPT));
            $user->setRole(new Role(3));
            // Save owner to repository
            $this->userRepository->postUser($user);
        }

        public function createAgent() {
            try {
                // Check if agent already exists
                $user = $this->userRepository->getUserByUsername("agent");
                if ($user != null) {
                    throw new Exception("Agent Already Exists");
                }
            } catch (Exception $e) {
                // Handle exception
            }
            $user = new User();

            // Set agent details
            $user->setFirstName("test");
            $user->setLastName("agent");
            $user->setEmail("agent@example.com");
            $user->setAvatar("avatar1.png");

            $user->setUsername("agent");
            $user->setPassword(password_hash("agent", PASSWORD_BCRYPT));
            $user->setRole(new Role(4));
            // Save agent to repository
            $this->userRepository->postUser($user);
        }

        public function getUserById(int $id): User {
            // Fetch user by ID
            return $this->userRepository->getUserById($id);
        }

        public function updateUser(User $user): User {
            // Update user details
            return $this->userRepository->updateUser($user);
        }

        public function changePassword(User $user,string $oldPassword,string $newPassword): User {
            try{
                $userFromDB = $this->userRepository->getUserById($user->getId());
                
                if($userFromDB == null) {
                    throw new Exception("User with given Id not found");
                }

                if(password_verify($oldPassword,$user->getPassword())) {
                    $user->setPassword(password_hash($newPassword,PASSWORD_BCRYPT));
                    $this->userRepository->updatePassword($user);
                }else {
                    throw new Exception("Old Password Didn't Match");
                }
            } catch (Exception $e) {
                throw $e;
            }
            return $user;
        }
    }