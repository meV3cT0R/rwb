<?php
require_once __DIR__ . "/../../constants.php";
require_once __DIR__ . "/../../src/models/User.php";

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
// $user = $_SESSION["user"];
// echo "user".$user;

// $id = $params['id'];
// $user = $_SESSION["user"];
// echo $user;


// $user = (new AdminUserController())->getUserById($id);

// if (!$user) {
//     header("Location: error.php");
//     exit;
// }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
        <link href="http://localhost/realEstate/public/css/index.css" rel="stylesheet" type="text/css" />
    <link href="http://localhost/realEstate/public/css/admin/index.css" rel="stylesheet" type="text/css" />
    <link href="http://localhost/realEstate/public/css/admin/profile.css" rel="stylesheet" type="text/css" />
<style>

    
</style>
    
</head>
<body>
      <?php
    include __DIR__ . "/../../components/admin/sidebar.php";
    ?>
    <div id="body">

        <?php
        include __DIR__ . "/../../components/admin/header.php";
        ?>
    <h1 style="margin:30px;">Change Password</h1>
    <!-- <form id="contact-form">
  <label for="firstname">Firstname:</label>
  <input type="text" id="firstname" name="firstname" value="<?php echo $user-> getFirstName(); ?>">

  <label for="lastname">Lastname:</label>
  <input type="text" id="lastname" name="lastname" value="<?php echo $user->getLastName(); ?>">

  <label for="username">Username:</label>
  <input type="text" id="username" name="username" value="<?php echo $user->getUsername(); ?>">

  <label for="image">Image:</label>
  <input type="file" id="image" name="image">
  <img src="<?php echo $user->getAvatar(); ?>" alt="Current Image" width="100" height="100">

  <button type="submit">Update</button>
</form> -->

 <form id="contact-form" method="post" >
        <div class="error">
            <?php
                  if(isset($error)){
                    echo $error;
                  }
            ?>
        </div>
      <!-- <div class="names"> -->
            <label for="oldPassword">Old Password<input type="password" id="oldPassword" name="oldPassword"></label>
        
            <label for="newPassword">New Password <input type="password" id="newPassword" name="newPassword" ></label> 
            
              <label for="confirmPassword">Confirm Password <input type="password" id="confirmPassword" name="confirmPassword"></label> 
      <!-- </div> -->

  <button type="submit" class="button" name="submit">Change Password</button>

</form>

<?php
        include __DIR__ . "/../../components/admin/footer.php";
        ?>
        </div>

            <script src=<?php echo URL . "public/js/admin/index.js" ?>></script>

        </body>
</html>