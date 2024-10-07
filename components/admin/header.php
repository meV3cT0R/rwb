<?php


//     session_start();

//     if(isset($_SESSION['user'])) {
//         $user = $_SESSION['user'];
// $id=$user->getId();
//     }

$id = 1;

?>


<div class="header" id="admin-header">
    <button id="toggleSidebar" >
        <img width="32" height="32" src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b2/Hamburger_icon.svg/1024px-Hamburger_icon.svg.png"/>
    </button>

    <span class="dropdown">
        <button id="dropdownButton">
            <img src="<?php echo URL . 'public/images/profile.png'; ?>" alt="profile" height="32" width="32">
        </button>
        <div id="dropdownMenu" class="dropdown-content">
            <a href="/realEstate/admin/updateprofile">Update Profile</a>
            <a href="/realEstate/admin/changepassword">Change Password</a>
        </div>
    </span>
</div>