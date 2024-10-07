<?php
require_once __DIR__ . "/../../constants.php";


if(isset($_POST["aboutUsSubmit"])) {
    try{
        $updateAboutUs($_POST["aboutUs"],$_POST["image"],$_POST["mission"],$_POST["team"]);
        header("Location: /realEstate/admin/pages");
    }catch(Exception $e){
        $error = $e->getMessage();
    }
}

if(isset($_POST["contactUsSubmit"])) {
    try{
        $updateContactUs($_POST["email"],$_POST["phone"],$_POST["address"]);
        header("Location: /realEstate/admin/pages");

    }catch(Exception $e){
        $error = $e->getMessage();
    }
}
?>
<html>

<head>
    <title>Property Type</title>
    <link href=<?php echo URL . "public/css/index.css" ?> rel="stylesheet" type="text/css" />
    <link href=<?php echo URL . "public/css/admin/index.css" ?> rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php echo URL . "/public/css/admin/pages.css" ?>">

</head>


<body>
    <?php
    require_once __DIR__ . "/../../components/admin/sidebar.php";
    ?>
    <div id="body">

        <?php
        require_once __DIR__ . "/../../components/admin/header.php";
        ?>



<div class="about-contact-form">

        <div class="container ">
            <?php
            require_once __DIR__ . "/../../components/admin/header.php";
            ?>
            <!-- About Us Form -->
            <form class="form" id="aboutUsForm" method="post">
                <h2>About Us</h2>

                <div class="error">
                    <?php
                        if(isset($aboutUsError)) {
                            echo $aboutUsError;
                        }
                    ?>
                </div>
                <label for="aboutUs">About Us</label>
                <textarea id="aboutUs" name="aboutUs" maxlength="500"
                    placeholder="Write about your organization" value="<?php echo $aboutUs["aboutUs"]; ?>"><?php echo $aboutUs["aboutUs"]; ?></textarea>

                <label for="image">Image URL</label>
                <input type="text" id="image" name="image" maxlength="100" placeholder="Image URL">

                <label for="mission">Mission</label>
                <textarea id="mission" name="mission" maxlength="500" placeholder="Your mission">

                <?php echo $aboutUs["mission"]; ?>
                </textarea>

                <label for="team">Team</label>
                <textarea id="team" name="team" maxlength="500" placeholder="Describe your team">
                <?php echo $aboutUs["team"]; ?>

                </textarea>

                <button type="submit" name="aboutUsSubmit">Submit About Us</button>
            </form>

            <!-- Contact Us Form -->
            <form class="form" id="contactUsForm" method="post">
                <h2>Contact Us</h2>

                <div class="error">
                    <?php
                        if(isset($contactUsError)) {
                            echo $contactUsError;
                        }
                    ?>
                </div>
                
                <label for="email">Email</label>
                <input value="<?php echo $contactUs["email"];?>" type="email" id="email" name="email" maxlength="100" placeholder="Enter your email">

                <label for="phone">Phone</label>
                <input value="<?php echo $contactUs["phone"];?>" type="tel" id="phone" name="phone" maxlength="20" placeholder="Enter your phone number">

                <label for="address">Address</label>
                <input value="<?php echo $contactUs["address"];?>" type="text" id="address" name="address" maxlength="20" placeholder="Enter your address">

                <button type="submit" name="contactUsSubmit">Submit Contact Us</button>
                <form>

        </div>
</div>
        
        <?php
        require_once __DIR__ . "/../../components/admin/footer.php";
        ?>
    </div>

    <script src=<?php echo URL . "public/js/admin/index.js" ?>></script>
</body>

</html>