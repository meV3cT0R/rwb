<?php
require_once __DIR__ . "/../../constants.php";
require_once __DIR__ . "/../../src/models/User.php";


logMessage("hello how are you");
if(isset($_POST["submit"])) {
    try {
        $userToBeSent = new User();
        $userToBeSent->setId($user->getId());

        $userToBeSent->setFirstName($_POST["firstName"]);
        $userToBeSent->setLastName($_POST["lastName"]);
        $userToBeSent->setEmail("");
        $userToBeSent->setUsername($_POST["username"]);
        $images = Helper::uploadImage($_FILES["file"]);

        if($images==null) {
            $userToBeSent->setAvatar($user->getAvatar());
        }else {
            $userToBeSent->setAvatar($images);
        }
        $editUser($userToBeSent);
        header("Location: /".APP."/admin/updateprofile");
    }catch(Exception $e) {
        $error = $e->getMessage();
    }

}
// $user = $_SESSION["user"];
// echo "user".$user;

// $id = $params['id'];
// echo "fuck".$id;
// $user = $_SESSION["user"];
// echo $user;


// $user = (new AdminUserController())->getUserById($id);

// if (!$user) {
//     header("Location: error.php");
//     exit;
// }

if (isset($_POST["submit"])) {
  try {
      $firstName = $_POST['firstName'];
      $lastName = $_POST['lastName'];
      $username = $_POST['username'];

      if (empty($firstName) || empty($lastName) || empty($username)) {
          throw new Exception("All fields are required.");
      }

      logMessage($firstName);
      logMessage($lastName);
      logMessage($username);
      $image = Helper::uploadImage($_FILES["image"]);

      $userToBeSent = new User();
      $userToBeSent->setId($user->getId());
      $userToBeSent->setFirstName($firstName);
      if(isset($email)) {
        $userToBeSent->setEmail($email);
      }else {
        $userToBeSent->setEmail($user->getEmail());

      }
      $userToBeSent->setLastName($lastName);
      $userToBeSent->setUsername($username);
      if($image!=null){
          $userToBeSent->setAvatar($image);
      }else {
          $userToBeSent->setAvatar($user->getAvatar());
      }
      $editUser($userToBeSent);
      // header("Location: /realEstate/admin");
  } catch (Exception $e) {
      $error = $e->getMessage();
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
        <link href="http://localhost/realEstate/public/css/index.css" rel="stylesheet" type="text/css" />
    <link href="http://localhost/realEstate/public/css/admin/index.css" rel="stylesheet" type="text/css" />
    <link href="http://localhost/realEstate/public/css/admin/profile.css" rel="stylesheet" type="text/css" />

    
</head>
<body>
      <?php
    include __DIR__ . "/../../components/admin/sidebar.php";
    ?>
    <div id="body">

        <?php
        include __DIR__ . "/../../components/admin/header.php";
        ?>
    <h1 style="margin:30px;"><?= $user-> getFirstName() ?> profile</h1>
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

 <form id="contact-form" method="post" enctype="multipart/form-data">
        <div>
           <?php 
              if(isset($error)) {
                echo $error;
              }
           ?>
        </div>
      <!-- <div class="names"> -->
            <label for="firstName">firstName<input type="text" id="firstName" name="firstName"  value="<?php echo $user->getFirstName(); ?>"></label>
        
            <label for="lastName">lastName <input type="text" id="lastName" name="lastName"  value="<?php echo $user->getLastName(); ?>"></label> 
            
      <!-- </div> -->

         <label for="username">Username</label><br>
    <input type="text" id="username" name="username" value="<?php echo $user->getUsername(); ?>">

   <label for="image">Image:</label>
  <input type="file" id="image" name="image">
  <img src="<?php echo URL.$user->getAvatar(); ?>" alt="Current Image" width="100" height="100">
  <button type="submit" class="button" name="submit">Update</button>

</form>

<?php
        include __DIR__ . "/../../components/admin/footer.php";
        ?>
        </div>

            <script src=<?php echo URL . "public/js/admin/index.js" ?>></script>

        </body>
</html>