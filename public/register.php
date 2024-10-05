<?php
    if(isset($_POST["register"])) {
             
    }
?>
<html>
    <head>
        <link href=<?php echo URL . "public/css/index.css" ?> rel="stylesheet" type="text/css"/>
        <link href=<?php echo URL . "public/css/form.css" ?> rel="stylesheet" type="text/css"/>
    </head>

    <body>
        <?php 
            include __DIR__."/../components/header.php";
        ?>

        <div class="formContainer">
            <form method="post" action="">
                <h1> Register </h1>
                <div>
                    <label> 
                        First Name
                    </label>

                    <input type="text" name="firstName" />
                </div>
                <div>
                    <label> 
                        Last Name
                    </label>

                    <input type="text" name="lastName" />
                </div>
                <div>
                    <label> 
                        username
                    </label>

                    <input type="text" name="username" />
                </div>
                <div>
                    <label> 
                        password
                    </label>

                    <input type="password" name="password" />
                </div>

                <div>
                    <label> 
                        Avatar
                    </label>

                    <input type="file" name="password" />
                </div>

                <div>
                    <button 
                        name="register"
                    >
                        Register
                    </button>
                </div>

                <div>
                    <a href="/realEstate/login"> 
                        login
                    </a>
                </div>
            </form>
        </div>

        <?php 
            include __DIR__."/../components/footer.php";
        ?>
        <script src=<?php echo URL . "public/js/index.js" ?>></script>
        <script src=<?php echo URL . "public/js/form.js" ?>></script>
    </body>
</html>