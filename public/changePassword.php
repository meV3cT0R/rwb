<?php
require_once __DIR__ . "/../constants.php";
require_once __DIR__ . "/../src/models/User.php";

// session_start();

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
    
    <div id="body">
        <h1 style="margin:30px;">Change Password</h1>

        <form id="contact-form" method="post">
            <label for="oldPassword">Old Password <input type="password" id="oldPassword" name="oldPassword" required></label>
            <label for="newPassword">New Password <input type="password" id="newPassword" name="newPassword" required></label>
            <label for="confirmPassword">Confirm Password <input type="password" id="confirmPassword" name="confirmPassword" required></label>
            <button type="submit" class="button">Change Password</button>
        </form>
    </div>

    <?php include __DIR__ . "/../components/footer.php"; ?>
    
    <script src="<?php echo URL . 'public/js/admin/index.js'; ?>"></script>
</body>
</html>
