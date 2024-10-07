<?php
require_once __DIR__ . "/../constants.php";

if (isset($_POST["submitCountry"])) {
    try {
        $countryName = $_POST["countryName"];

        if (empty($countryName)) {
            throw new Exception("Country name is required.");
        }

        $country = new Country();
        $country->setName($countryName);

        $saveCountry($country);

        header("Location: /realEstate/admin/country");
        exit();
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>

<html>
<head>
    <link href="<?php echo URL . 'public/css/index.css'; ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo URL . 'public/css/admin/index.css'; ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo URL . 'public/css/admin/admin-form.css'; ?>" rel="stylesheet" type="text/css" />
</head>

<body>
    <?php require_once __DIR__ . "/../components/admin/sidebar.php"; ?>
    <div class="body">
        <?php require_once __DIR__ . "/../components/admin/header.php"; ?>
        
        <div class="formContainer body" style="margin-bottom: 50px;">
            <form method="post" action="" class="city-form">
                <h1>Add Country</h1>

                <?php if (isset($error)) : ?>
                    <div class="error">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>

                <div>
                    <label for="countryName">Country Name</label>
                    <input type="text" name="countryName" id="countryName" />
                </div>

                <div>
                    <button type="submit" name="submitCountry">Submit</button>
                </div>

                <div>
                    <a href="/realEstate/countryList">View Countries</a>
                </div>
            </form>
        </div>

        <?php require_once __DIR__ . "/../components/admin/footer.php"; ?>
    </div>

    <script src="<?php echo URL . 'public/js/index.js'; ?>"></script>
</body>
</html>
