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
require_once "src/models/Comment.php";
require_once "src/models/Enquiry.php";
require_once "src/models/PropertyPhotos.php";

require_once "src/dao/PropertyTypeDAO.php";
require_once "src/dao/PropertyPhotosDAO.php";
require_once "src/dao/UserDAO.php";
require_once "src/dao/RoleDAO.php";
require_once "src/dao/PropertyDAO.php";
require_once "src/dao/CountryDAO.php";
require_once "src/dao/CityDAO.php";
require_once "src/dao/StateDAO.php";
require_once "src/dao/EnquiryDAO.php";
require_once "src/dao/CommentDAO.php";


require_once "src/repositories/PropertyTypeRepository.php";
require_once "src/repositories/CountryRepository.php";
require_once "src/repositories/StateRepository.php";
require_once "src/repositories/CityRepository.php";
require_once "src/repositories/UserRepository.php";
require_once "src/repositories/PropertyRepository.php";
require_once "src/repositories/EnquiryRepository.php";
require_once "src/repositories/CommentRepository.php";
require_once "src/repositories/PropertyPhotosRepository.php";

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
require_once "src/controllers/AdminPageController.php";

require_once "src/middlewares/authentications/Auth.php";

$dbConnection = (new DB())->connect();


$propertyTypeDAO = new PropertyTypeDAO($dbConnection);
$propertyPhotosDAO = new PropertyPhotosDAO($dbConnection);
$userDAO = new UserDAO($dbConnection);
$roleDAO = new RoleDAO($dbConnection);
$propertyDAO = new PropertyDAO($dbConnection);
$countryDAO = new CountryDAO($dbConnection);
$stateDAO = new StateDAO($dbConnection);
$cityDAO = new CityDAO($dbConnection);
$enquiryDAO = new EnquiryDAO($dbConnection);
$commentDAO = new CommentDAO($dbConnection);




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
    $propertyPhotosDAO,
    $userDAO,
    $roleDAO,
    $enquiryDAO,
    $commentDAO,
    $cityDAO

);

$userRepository = new UserRepository(
    $userDAO,
    $roleDAO,
);
$commentRepository = new CommentRepository(
    $commentDAO
);
$enquiryRepository = new EnquiryRepository(
    $enquiryDAO,
    $commentDAO
);




$userService = new UserService(
    $userRepository
);

$homeController = new HomeController(
    $propertyRepository,
    $userService,
    $propertyTypeRepository,
    $cityRepository,
    $commentRepository,
    $enquiryRepository
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
    $stateRepository,
    $countryRepository
);
$adminCityController = new AdminCityController(
    $cityRepository,
    $stateRepository,
    $countryRepository
);

$adminUserController = new AdminUserController(
    $userRepository
);
$adminPropertyController = new AdminPropertyController(
    $propertyRepository
);


$adminPagesController = new AdminPageController(

);

$auth = new Auth();

$uri = $_SERVER['REQUEST_URI'];

$uri = explode("?", $uri);
if (count($uri) > 1) {
    $params = Helper::getParams($uri[1]);
}

$uri = explode("/", $uri[0]);
$uri = array_slice($uri, 2);


$uri = implode("/", $uri);

$route = array(
    "" => function (): void {
        global $homeController;
        $homeController->home();
    },
    "admin" => function (): void {
        global $auth;
        $auth->verifyAdmin();
        global $adminController;
        $adminController->dashboard();
    },
    "admin/propertytype" => function (): void {
        global $auth;
        $auth->verifyAdmin();
        global $propertyTypeController;
        $propertyTypeController->home();
    },
    "admin/propertytype/create" => function (): void {
        global $propertyTypeController;
        $propertyTypeController->addPropertyType();
    },
    "admin/propertytype/edit" => function (): void {
        global $propertyTypeController;
        global $params;
        $id = $params["id"];
        $add = false;
        $propertyTypeController->editPropertyType($add, $id);
    },
    "admin/propertytype/delete" => function (): void {
        global $propertyTypeController;
        global $params;
        $id = $params["id"];
        $add = false;
        $propertyTypeController->deletePropertyType($id);
        header("Location: /realEstate/admin/propertyType");

    },
    "admin/country" => function (): void {
        global $auth;
        $auth->verifyAdmin();
        global $adminCountryController;
        $adminCountryController->home();
    },
    "admin/country/create" => function (): void {
        global $adminCountryController;
        $adminCountryController->addCountry();
    },
    "admin/country/edit" => function (): void {
        global $adminCountryController;
        global $params;
        $id = $params["id"];
        $add = false;
        $adminCountryController->editCountry($add, $id);
    },
    "admin/country/delete" => function (): void {
        global $adminCountryController;
        global $params;
        $id = $params["id"];

        $adminCountryController->deleteCountry($id);
        header("Location: /realEstate/admin/country");

    },
    "admin/state" => function (): void {
        global $auth;
        $auth->verifyAdmin();
        global $adminStateController;
        $adminStateController->home();
    },
    "admin/state/create" => function (): void {
        global $adminStateController;
        $adminStateController->addState();
    },
    "admin/state/edit" => function (): void {
        global $adminStateController;
        $add = false;
        global $params;
        $id = $params["id"];
        $adminStateController->editState($add, $id);
    },
    "admin/state/delete" => function (): void {
        global $adminStateController;
        global $params;

        $id = $params["id"];

        $adminStateController->deleteState($id);
        header("Location: /realEstate/admin/state");
    },
    "admin/city" => function (): void {
        global $auth;
        $auth->verifyAdmin();
        global $adminCityController;
        ;
        $adminCityController->home();
    },
    "admin/city/create" => function (): void {
        global $adminCityController;
        ;
        $adminCityController->addCity();
    },
    "admin/city/edit" => function (): void {
        global $adminCityController;
        global $params;
        $id = $params["id"];
        $add = false;
        $adminCityController->editCity($add, $id);
    },
    "admin/city/delete" => function (): void {
        global $params;
        global $stateRepository;
        $id = $params["id"];

        $stateRepository->deleteState($id);
        header("Location: /realEstate/admin/state");

    },

    "admin/users" => function (): void {
        global $auth;
        $auth->verifyAdmin();
        global $adminUserController;
        ;
        $adminUserController->getUsers();
    },

    "admin/agents" => function (): void {
        global $auth;
        $auth->verifyAdmin();
        global $adminUserController;
        ;
        $adminUserController->getAgents();
    },

    "admin/owners" => function (): void {
        global $auth;
        $auth->verifyAdmin();
        global $adminUserController;
        ;
        $adminUserController->getOwners();
    },

    "admin/properties" => function (): void {
        global $auth;
        $auth->verifyAdmin();
        global $adminPropertyController;
        $adminPropertyController->home();
    },

    "admin/updateprofile" => function () use ($adminUserController) {
        global $auth;
        $auth->verifyAdmin();
        $adminUserController->getUserById();
    },

    "logout" => function () use ($homeController) {
        $homeController->logout();
    },

    "admin/changepassword" => function () use ($adminUserController) {
        global $auth;
        $auth->verifyAdmin();
        global $userRepository;
        if (isset($_SESSION["user"])) {
            logMessage("Yes User");
            $user = $userRepository->getUserById($_SESSION["user"]->getId());
        }
        $changePassword = function (User $user,string $oldPassword,string $newPassword): User {
            global $userService;
            logMessage($user->getId());
            return $userService->changePassword($user,$oldPassword,$newPassword);
        };
        
        require_once __DIR__ . '/public/admin/changePassword.php';
    },
    "admin/createsuperadmin" => function (): void {
        global $userService;
        $userService->createSuperAdmin();
        header("Location: /realEstate/login");
    },
    "admin/createuser" => function (): void {
        global $userService;
        $userService->createUser();
        header("Location: /realEstate/login");

    },
    "admin/createowner" => function (): void {
        global $userService;
        $userService->createOwner();
        header("Location: /realEstate/login");

    },
    "admin/createagent" => function (): void {
        global $userService;
        $userService->createAgent();
        header("Location: /realEstate/login");

    },
    "login" => function (): void {
        global $homeController;
        $homeController->getLogin();
    },
    "register" => function (): void {
        global $homeController;
        $homeController->getRegister();
    },
    "about" => function (): void {
        global $homeController;
        $homeController->getAbout();
    },
    "properties" => function (): void {
        global $homeController;
        $homeController->getProperties();
    },
    "property-details" => function (): void {
        global $homeController;
        global $params;
        $id = $params["id"];
        logMessage($id);
        $homeController->getPropertyDetails($id);
    },
    "contact" => function (): void {
        global $homeController;
        $homeController->getContact();
    },
    "updateprofile" => function (): void {
        global $homeController;
        $homeController->getUpdateProfile();
    },
    "changepassword" => function (): void {
        global $homeController;
        $homeController->getChangePassword();
    },
    "manageproperties" => function (): void {
        global $auth;
        $auth->verifyOwner();
        global $homeController;
        $homeController->manageProperties();
    },
    "manageproperties/add" => function (): void {
        global $auth;
        $auth->verifyOwner();
        global $homeController;
        $homeController->addProperties();
    },
    "manageproperties/edit" => function (): void {
        global $auth;
        $auth->verifyOwner();
        global $homeController;
        global $params;
        $id = $params["id"];
        $add = false;
        $homeController->editProperties($add, $id);
    },
    "manageproperties/delete" => function (): void {
        global $auth;
        $auth->verifyOwner();
        global $homeController;
        global $params;
        $id = $params["id"];
        $homeController->deleteProperties($id);
    },
    "admin/pages" => function (): void {
        global $auth;
        $auth->verifyAdmin();
        global $adminPagesController;
        $adminPagesController->home();
    }
);

if (isset($route[strtolower($uri)])) {
    $route[strtolower($uri)]();
} else {
    echo "404 : Page Not Found";
}
exit();