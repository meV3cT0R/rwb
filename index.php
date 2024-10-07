<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    require_once "devutils/logs.php";
    require_once "src/utils/Helper.php";

    require_once "config/db.php";
    
    require_once "src/models/Country.php";
    require_once "src/models/City.php";
    require_once "src/models/State.php";
    require_once "src/models/PropertyType.php";
    require_once "src/models/Property.php";
    require_once "src/models/User.php";
    require_once "src/models/Role.php";

    require_once "src/dao/PropertyTypeDAO.php";
    require_once "src/dao/UserDAO.php";
    require_once "src/dao/RoleDAO.php";
    require_once "src/dao/PropertyDAO.php";
    require_once "src/dao/CountryDAO.php";
    require_once "src/dao/CityDAO.php";
    require_once "src/dao/StateDAO.php";


    require_once "src/repositories/PropertyTypeRepository.php";
    require_once "src/repositories/CountryRepository.php";
    require_once "src/repositories/StateRepository.php";
    require_once "src/repositories/CityRepository.php";
    require_once "src/repositories/UserRepository.php";
    require_once "src/repositories/PropertyRepository.php";
    
    require_once "src/dto/ErrorDTO.php";
    require_once "src/dto/ResDTO.php";
    require_once "src/dto/UserDTO.php";

    require_once "src/services/UserService.php";

    require_once "src/controllers/HomeController.php";
    require_once "src/controllers/AdminController.php";
    require_once "src/controllers/PropertyTypeController.php";
    require_once "src/controllers/AdminCountryController.php";
    require_once "src/controllers/AdminStateController.php";
    require_once "src/controllers/AdminCityController.php";
    require_once "src/controllers/AdminUserController.php";
    require_once "src/controllers/AdminPropertyController.php";

    require_once "src/middlewares/authentications/Auth.php";

    $dbConnection = (new DB())->connect();


    $propertyTypeDAO = new PropertyTypeDAO($dbConnection);
    $userDAO = new UserDAO($dbConnection);
    $roleDAO = new RoleDAO($dbConnection);
    $propertyDAO = new PropertyDAO($dbConnection);
    $countryDAO = new CountryDAO($dbConnection);
    $stateDAO = new StateDAO($dbConnection);
    $cityDAO = new CityDAO($dbConnection);




    $propertyTypeRepository = new PropertyTypeRepository(
        $propertyTypeDAO,
        $userDAO,
        $roleDAO
    );
    $countryRepository = new CountryRepository(
        $countryDAO,
        $cityDAO,
        $stateDAO
    );
    $stateRepository = new StateRepository(
        $cityDAO,
        $stateDAO,
    );
    $cityRepository = new CityRepository(
        $cityDAO,
    );
    $propertyRepository = new PropertyRepository(
        $propertyDAO,
        $propertyTypeDAO,
        $userDAO,
        $roleDAO
    );
    $propertyRepository = new PropertyRepository(
        $propertyDAO,
        $propertyTypeDAO,
        $userDAO,
        $roleDAO
    );
    $userRepository = new UserRepository(
        $userDAO,
        $roleDAO,
    );

    $userService = new UserService(
        $userRepository
    );

    $homeController = new HomeController(
        $propertyRepository,
                            $userService
    );
    $adminController = new AdminController(
        $propertyTypeRepository,
        $countryRepository,
        $stateRepository,
        $cityRepository,
        $userRepository,
        $propertyRepository
    );
    $propertyTypeController = new PropertyTypeController(
        $propertyTypeRepository
    );
    $adminCountryController = new AdminCountryController(
        $countryRepository
    );
    $adminStateController = new AdminStateController(
        $stateRepository
    );
    $adminCityController = new AdminCityController(
        $cityRepository
    );

    $adminUserController = new AdminUserController(
        $userRepository
    );
    $adminPropertyController = new AdminPropertyController(
        $propertyRepository
    );


    $auth = new Auth();

    $uri = $_SERVER['REQUEST_URI'];
    
    $uri = explode("?",$uri);
    if(count($uri)>1){
        $params = Helper::getParams($uri[1]);
    }

    $uri = explode("/",$uri[0]);
    $uri = array_slice($uri,2);
    

    $uri = implode("/",$uri);

    $route = array(
        "" => function():void{
            global $homeController;
            $homeController->home();
        },
        "admin" => function() :void {
            // global $auth;
            // $auth->verifyAdmin();
            global $adminController;
            $adminController->dashboard();

        },
        "admin/propertytype"=> function():void {
            global $propertyTypeController;
            $propertyTypeController->home();
        },
        "admin/propertytype/create"=> function():void {
            global $propertyTypeController;
            $propertyTypeController->addPropertyType();
        },
        "admin/country"=> function():void {
            global $adminCountryController;
            $adminCountryController->home();
        },
        "admin/country/create"=> function():void {
            global $adminCountryController;
            $adminCountryController->addCountry();
        },
        "admin/state"=> function():void {
            global $adminStateController;
            $adminStateController->home();
        },
        "admin/state/create"=> function():void {
            global $adminStateController;
            $adminStateController->addState();
        },
        "admin/city"=> function():void {
            global $adminCityController;;
            $adminCityController->home();
        },
        "admin/city/create"=> function():void {
            global $adminCityController;;
            $adminCityController->addCity();
        },
        "admin/users"=> function():void {
            global $adminUserController;;
            $adminUserController->getUsers();
        },
        "admin/agents"=> function():void {
            global $adminUserController;;
            $adminUserController->getAgents();
        },
        "admin/owners"=> function():void {
            global $adminUserController;;
            $adminUserController->getOwners();
        },
        "admin/properties"=> function():void {
            global $adminPropertyController;
            $adminPropertyController->home();
        },
        "admin/properties/create"=> function():void {
            global $adminPropertyController;
            $adminPropertyController->addProperty();
        },
     "admin/updateprofile" => function () use ($adminUserController) { 
        global $params;
        $id = $params["id"];
        $user = $adminUserController->getUserById($id); 
        require_once __DIR__ . '/public/admin/userProfile.php'; 
    },
       "admin/changepassword" => function () use ($adminUserController) { 
        global $params;
        $id = $params["id"];
        $user = $adminUserController->getUserById($id); 
        require_once __DIR__ . '/public/admin/changePassword.php'; 
    },
        "admin/createsuperadmin"=> function():void {
            global $userService;
            $userService->createSuperAdmin();
        },
        "login"=>function() :void {
            global $homeController;
            $homeController->getLogin();
        },
        "register"=>function() :void {
            global $homeController;
            $homeController->getRegister();
        },
        "about"=>function() :void {
            global $homeController;
            $homeController->getAbout();
        },
        "properties"=>function() :void {
            global $homeController;
            $homeController->getProperties();
        },
        "property-details"=>function() :void {
            global $homeController;
            global $params;
            $id = $params["id"];
            logMessage($id);
            $homeController->getPropertyDetails($id);
        },
        "contact"=>function() :void {
            global $homeController;
            $homeController->getContact();
        }
    );

    if(isset($route[strtolower($uri)])) {
        $route[strtolower($uri)]();
    }else {
        echo "404 : Page Not Found";
    }
    exit();