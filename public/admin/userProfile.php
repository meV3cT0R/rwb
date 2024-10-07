<?php
require_once __DIR__ . "/../../constants.php";
require_once __DIR__ . "/../../src/models/User.php";

session_start();
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

 <form id="contact-form" method="post" >

      <!-- <div class="names"> -->
            <label for="firstName">firstName<input type="text" id="firstName" name="firstName"  value="<?php echo $user-> getFirstName(); ?>"></label>
        
            <label for="lastName">lastName <input type="text" id="lastName" name="lastName"  value="<?php echo $user-> getLastName(); ?>"></label> 
            
      <!-- </div> -->

         <label for="username">Username</label><br>
    <input type="text" id="username" name="username" value="<?php echo $user->getUsername(); ?>">

   <label for="image">Image:</label>
  <input type="file" id="image" name="image">
  <img src="<?php echo $user->getAvatar(); ?>" alt="Current Image" width="100" height="100">
  <button type="submit" class="button">Update</button>

</form>

<?php
        include __DIR__ . "/../../components/admin/footer.php";
        ?>
        </div>

            <script src=<?php echo URL . "public/js/admin/index.js" ?>></script>

        </body>
</html>