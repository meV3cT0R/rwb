<?php
    require_once "devutils/logs.php";
    require_once "src/utils/Helper.php";

    require_once "config/db.php";
    
    require_once "src/models/Country.php";
    require_once "src/models/City.php";
    require_once "src/models/State.php";

    require_once "src/controllers/HomeController.php";
    require_once "src/controllers/AdminController.php";

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

    $homeController = new HomeController();
    $adminController = new AdminController(
        $propertyTypeRepository,
        $countryRepository,
        $stateRepository,
        $cityRepository,
        $userRepository,
        $propertyRepository
    );

    $uri = $_SERVER['REQUEST_URI'];
    $uri = explode("/",$uri);
    $uri = array_slice($uri,2);
    $uri = implode("/",$uri);
    echo $uri."<br/>";

    $route = array(
        "" => function():void{
            global $homeController;
            $homeController->home();
        },
        "admin" => function() :void {
            global $adminController;
            $adminController->dashboard();

        }
    );

    if(isset($route[strtolower($uri)])) {
        $route[strtolower($uri)]();
    }else {
        echo "404 : Page Not Found";
    }
    exit();