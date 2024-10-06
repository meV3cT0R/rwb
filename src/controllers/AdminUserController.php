<?php
    class AdminUserController {
        private UserRepository $userRepository;

        public function __construct(UserRepository $userRepository) {
            Helper::checkDependencies(array(
                "UserRepository" => $userRepository,
            ));
            $this->userRepository = $userRepository;
        }

        private function helper(array $users,&$cols,&$arr) :void {
            $cols = ["First Name","Last Name","E-mail","Username","avatar"];
            $arr = array_map(function(User $user){
                    $subArr = [];
                    array_push($subArr,  $user->getFirstName());
                    array_push($subArr, $user->getLastName());
                    array_push($subArr, $user->getEmail());
                    array_push($subArr, $user->getUsername());
                    array_push($subArr, $user->getAvatar());

                    return $subArr;
            },$users);
        }

        public function getUsers() :void {
            $users = $this->userRepository->getUsersByRoleId(2);
            $title = "Users";
            $cols = [];
            $arr = [];
            $this->helper( $users,$cols,$arr);
            require_once __DIR__."/../../public/admin/table.php";
        }        
        public function getAgents():void {
            $users = $this->userRepository->getUsersByRoleId(4);
            $title = "Agents";
            $cols = [];
            $arr = [];
            $this->helper( $users,$cols,$arr);
            require_once __DIR__."/../../public/admin/table.php";
        }        
        public function getOwners(): void {
            $users = $this->userRepository->getUsersByRoleId(3);
            $title = "Owners";
            $cols = [];
            $arr = [];
            $this->helper( $users,$cols,$arr);
            require_once __DIR__."/../../public/admin/table.php";
        }        
    }