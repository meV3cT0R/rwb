<?php
    if(isset($_POST["login"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $login( $username, $password );
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

        <div class="body formContainer">
            <form action="" method="post">
                <h1> Login </h1>
                <div>
                    <label> 
                        Username
                    </label>

                    <input type="text" name="username" />
                </div>
                <div>
                    <label> 
                        Username
                    </label>

                    <input type="text" name="username" />
                </div>

                <div>
                    <button name="login">
                        Log in
                    </button>
                </div>

                <div>
                    <a href="/realEstate/register"> 
                        Register
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