<?php
session_start();
?>
<div class="header">
    <div>
        <div>
            <h1> RE </h1>
        </div>

        <div>
            <ul>
                <li>
                    <a href="/realEstate">
                        Home
                    </a>
                    <div></div>
                </li>
                <li>
                    <a href="/realEstate/about">
                        About
                    </a>
                    <div></div>

                </li>
                <li>
                    <a href="/realEstate/properties">
                        Properties
                    </a>
                    <div></div>

                </li>
                <li>
                    <a href="/realEstate/contact">
                        Contact
                    </a>
                    <div></div>

                </li>
            </ul>
        </div>
        <div class="gap">

        </div>
        <div class="buttons">
            <?php

            if (!isset($_SESSION["user"])) {
                ?>
                <div>
                    <button onclick="window.open('/realEstate/login','_self')">
                        Login
                    </button>
                </div>

                <div>
                    <button onclick="window.open('/realEstate/register','_self')">
                        Register
                    </button>
                </div>
                <?php
            } else {
                ?>
                <span class="dropdown">
                    <button id="dropdownButton">
                        <img src="<?php echo URL . 'public/images/profile.png'; ?>" alt="profile" class="profile" height="32" width="32">
                    </button>
                    <div id="dropdownMenu" class="dropdown-content">
                        <a href="/realEstate/updateprofile">Update Profile</a>
                        <a href="/realEstate/changepassword">Change Password</a>
                        <?php
                        $user = $_SESSION['user'];
                        if ($user->getRole() == "OWNER") {
                            ?>
                                <a href="/realEstate/manageproperties"> Manage Properties </a>
                            <?php
                        }
                        ?>
                        <a href="/realEstate/logout">Log out</a>
                    </div>
                </span>
                <?php

            }

            ?>

        </div>
    </div>

</div>
<nav id="toggleContainer">
    <button id="toggleSidebarNormal">
        toggle
    </button>
</nav>