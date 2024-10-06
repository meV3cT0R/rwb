<?php


    session_start();

    if(isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
$id=$user->getId();

    }else {
        header("Location: login.php");
    }

?>


<div class="header" id="admin-header">
    <button
        id="toggleSidebar"
    >
        click
    </button>

    <span class="dropdown">
    <button id="dropdownButton">
        <img src="<?php echo URL . 'public/images/profile.png'; ?>" alt="profile" height="32" width="32">
    </button>
    <div id="dropdownMenu" class="dropdown-content">
        <a href="/realEstate/admin/updateprofile/?id={$id}">Update Profile</a>
        <a href="/realEstate/admin/changepassword/?id={$id}">Change Password</a>
    </div>
</span>
</div>