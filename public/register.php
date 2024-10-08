<?php
    if(isset($_POST["register"])) {
        $user = new User();
        try{
            // logMessage("register clicked");
            // logMessage($image);

                $firstName = trim($_POST["firstName"] ?? null);
                $lastName = trim($_POST["lastName"] ?? null);
                $username = trim($_POST["username"] ?? null);
                $email = trim($_POST["email"] ?? null);
                $password = trim($_POST["password"] ?? null);
                $role = trim($_POST["role"] ?? null);

                $errYes = false;
                $error = "";

                if (empty($firstName)) {
                    $error = "First name is required.";
                    $errYes = true;
                }

                if (empty($lastName)) {
                    $error = "Last name is required.";
                    $errYes = true;
                }

                if (empty($username)) {
                    $error = "Username is required.";
                    $errYes = true;
                }

                if (empty($email)) {
                    $error = "Email is required.";
                    $errYes = true;
                } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $error = "Invalid email format.";
                    $errYes = true;
                }

                if (empty($password)) {
                    $error = "Password is required.";
                    $errYes = true;
                }

                if (empty($role)) {
                    $error = "Role is required.";
                    $errYes = true;
                }
                logMessage("ERror validating");
                logMessage($error);
                logMessage($errYes);

                if (!$errYes) {
                    logMessage("NO ERror");
                    // If validation passes, set values to the user object
                    $user->setFirstName($firstName);
                    $user->setLastName($lastName);
                    $user->setUsername($username);
                    $user->setEmail($email);  // Fixed: should setEmail, not setUsername
                    $user->setPassword($password);
                    $user->setRole(new Role($role));
                    $images = Helper::uploadImage($_FILES["file"]);

                    if($images != null) {
                        $user->setAvatar($images);
                    }
                    
                    $res = $register($user);
        
                    if($res->getErrorDTO()!=null){
                        $error = $res->getErrorDTO()->getMessage();
                    logMessage("Yes Error");

                    }else {
                        if($res->getData()!=null) {
                            logMessage("Yes Data");
                            logMessage($res->getData()->getId());
                            logMessage($res->getData()->getUsername());
                            
                        }
                        header("Location: /realEstate/login");

                    }
                    // Proceed with further processing, e.g., save user to the database
                }

            

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

        <div class="formContainer body" style="margin-bottom:50px;">
            <form method="post" action="" enctype="multipart/form-data">
                <h1> Register </h1>
                <div class="error">
                        <?php
                            if(isset($error)) {
                                echo $error;
                            }
                        ?>
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
                        email
                    </label>

                    <input type="text" name="email" />
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