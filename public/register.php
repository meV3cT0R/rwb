<?php
    if(isset($_POST["register"])) {
        $user = new User();
        try{
            // logMessage("register clicked");
            $image = Helper::uploadImage($_FILES["file"]);
            // logMessage($image);
            $user->setFirstName($_POST["firstName"]);
            $user->setLastName($_POST["lastName"]);
            $user->setUsername($_POST["username"]);
            $user->setPassword($_POST["password"]);
            $register($user);
        }catch(Exception $e){
            $error = $e->getMessage();
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

        <div class="formContainer body">
            <form method="post" action="" enctype="multipart/form-data">
                <h1> Register </h1>
                <div>

                </div>
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
                        User Type
                    </label>
                    <select name="role">
                        <option value="2">
                            Customer
                        </option>
                        <option VALUE="3">
                            Owner
                        </option>
                        <option VALUE="4">
                            Agent
                        </option>
                    </select>
                </div>
                <div>
                    <label> 
                        Avatar
                    </label>

                    <input type="file" name="file" />
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