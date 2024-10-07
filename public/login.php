<?php
    if(isset($_POST["login"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        logMessage("Loggin in");

        $res = $login( $username, $password );

        if($res instanceof ResDTO){
            if($res->getErrorDTO()!=null) {
                $error = $res->getErrorDTO()->getMessage();
            }
            else {
                $userDTO = $res->getData();
                logMessage("Login Success");
                if($userDTO instanceof UserDTO) {
                    $_SESSION["user"] = $userDTO;
                    if($userDTO->getRole()=="ADMIN") {
                        header("Location: /realEstate/admin");
                    }else {
                        logMessage($userDTO->getRole());
                        header("Location: /realEstate");

                    }
                }
            }
        }

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
                    <p
                        class="error"
                    > 
                        <?php
                            if(isset($error)) {
                                echo $error;
                            }
                        ?>
                    </p>
                </div>
                <div>
                    <label> 
                        Username
                    </label>

                    <input type="text" name="username" />
                </div>
                <div>
                    <label> 
                        Password
                    </label>

                    <input type="password" name="password" />
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