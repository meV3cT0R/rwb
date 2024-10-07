<?php
require_once __DIR__ . "/../constants.php";
require_once __DIR__ . "/../src/models/User.php";
logMessage("hello how are you");
if(isset($_POST["submit"])) {
    try {
        $userToBeSent = new User();
        $userToBeSent->setId($user->getId());

        $userToBeSent->setFirstName($_POST["firstName"]);
        $userToBeSent->setLastName($_POST["lastName"]);
        $userToBeSent->setEmail("");
        $userToBeSent->setUsername($_POST["username"]);
        $userToBeSent->setRole(new Role($_POST["role"]));
        $images = Helper::uploadImage($_FILES["file"]);

        if($images==null) {
            $userToBeSent->setAvatar($user->getAvatar());
        }else {
            $userToBeSent->setAvatar($images);
        }
        $editUser($userToBeSent);
        header("Location: /".APP."/admin");
    }catch(Exception $e) {
        $error = $e->getMessage();
    }

}
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="http://localhost/realEstate/public/css/index.css" rel="stylesheet" type="text/css" />
    <!-- <link href="http://localhost/realEstate/public/css/admin/index.css" rel="stylesheet" type="text/css" /> -->
    <link href="http://localhost/realEstate/public/css/admin/profile.css" rel="stylesheet" type="text/css" />
        <title>Property Details</title>
    </head>

    <body>
        <?php include __DIR__ . "/../components/header.php"; ?>

    <h1 style="margin:30px;"><?= $user-> getFirstName() ?>'s profile</h1>
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
<div style="flex-grow:1;">
 <form id="contact-form"  method="post" enctype="multipart/form-data" >
        <div>
            <?php
                if(isset($error)) {
                    echo $error;
                }
            ?>
        </div>
      <!-- <div class="names"> -->
            <label for="firstName">First Name<input style="margin-top:10px;" type="text" id="firstName" name="firstName"  value="<?php echo $user-> getFirstName(); ?>"></label>
        
            <label for="lastName">Last Name <input style="margin-top:10px;" type="text" id="lastName" name="lastName"  value="<?php echo $user-> getLastName(); ?>"></label> 
            
      <!-- </div> -->

         <label for="username">Username</label><br>
    <input style="margin-top:10px;" type="text" id="username" name="username" value="<?php echo $user->getUsername(); ?>">

   <label for="image">Image:</label>
  <input style="margin-top:10px;" type="file" id="image" name="file">
  <img src="<?php echo $user->getAvatar(); ?>" alt="Current Image" width="100" height="100">
  <button type="submit" class="button" name="submit">Update</button>

</form>
</div>
<?php
        include __DIR__ . "/../components/footer.php";
        ?>

            <script src=<?php echo URL . "public/js/admin/index.js" ?>></script>

        </body>
</html>