<?php
    if(isset($_POST["logout"])) {
        session_start();
        session_destroy();
        header("Location: /realEstate/login",true);
        exit();
    }

?>
<div id="sidebar">
    <div>
        <div id="logo">
            <div>
                <h1> CC </h1>
            </div>

        </div>
        <div class="nav">
            <ul>
                <li>
                    <a href="/realEstate/admin">
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="/realEstate/admin/propertyType">
                        Property Type
                    </a>
                </li>
                <li>
                    <a href="/realEstate/admin/country">
                        Countries
                    </a>
                </li>
                <li>
                    <a href="/realEstate/admin/state">
                        States
                    </a>
                </li>
                <li>
                    <a href="/realEstate/admin/city">
                        Cities
                    </a>
                </li>
                <li>
                    <a href="/realEstate/admin/enquiries">
                        Enquiries
                    </a>
                </li>
                <li>
                    <a href="/realEstate/admin/agents">
                        Agents
                    </a>
                </li>
                <li>
                    <a href="/realEstate/admin/owners">
                        Owners
                    </a>
                </li>
                <li>
                    <a href="/realEstate/admin/users">
                        users
                    </a>
                </li>
                <li>
                    <a href="/realEstate/admin/properties">
                        Properties
                    </a>
                </li>

                <li>
                    <a href="/realEstate/admin/pages">
                        pages
                    </a>
                </li>

            </ul>
        </div>
        <div >
            <form class="logoutDiv" method="POST" action="">
                <button name="logout">
                    logout
                </button>
            </form>

        </div>
    </div>
</div>