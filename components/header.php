<?php
?>
<div class="header">
    <div>
        <div>
            <h1> RE </h1>
        </div>

        <div class="gap">
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

        <div class="buttons" style="max-width:300px">
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
<button id="toggleSidebarNormal" >
        <img width="32" height="32" src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b2/Hamburger_icon.svg/1024px-Hamburger_icon.svg.png"/>
    </button>

</nav>