<?php
require_once __DIR__ . "/../constants.php";
require_once __DIR__ . "/../src/models/User.php";

if(isset($_POST["submit"])) {
    $oldPassword = $_POST["oldPassword"];
    $newPassword = $_POST["newPassword"];
    $confirmPassword = $_POST["confirmPassword"];

    if(strcmp($oldPassword,$newPassword)) {
        try{
          $changePassword($user,$oldPassword,$newPassword);
        }catch(
          Exception $e
        ){
            $error = $e->getMessage();
        }
      }else{
      $error = "Confirm Password and Password didn't Match";
    }

    
}
// Uncomment this if you need to fetch the user details
// $user = $_SESSION["user"];
// if (!$user) {
//     header("Location: error.php");
//     exit;
// }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="http://localhost/realEstate/public/css/index.css" rel="stylesheet" type="text/css" />
    <link href="http://localhost/realEstate/public/css/admin/profile.css" rel="stylesheet" type="text/css" />
    <title>Change Password</title>
</head>
<body>
    <?php include __DIR__ . "/../components/header.php"; ?>
    
    <div id="body" class="body">
        <h1 style="margin:30px;">Change Password</h1>

        <form id="contact-form" method="post">
            <label for="oldPassword">Old Password <input type="password" id="oldPassword" name="oldPassword" required style="margin-top:10px;"></label>
            <label for="newPassword">New Password <input type="password" id="newPassword" name="newPassword" required style="margin-top:10px;"></label>
            <label for="confirmPassword">Confirm Password <input type="password" id="confirmPassword" name="confirmPassword" required style="margin-top:10px;"></label>
            <button type="submit" class="button" name="submit"> Change Password </button>
        </form>
    </div>

    <?php include __DIR__ . "/../components/footer.php"; ?>
    
    <script src="<?php echo URL . 'public/js/admin/index.js'; ?>"></script>
</body>
</html>
