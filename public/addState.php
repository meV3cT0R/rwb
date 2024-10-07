<?php
require_once __DIR__ . "/../constants.php";


if (isset($_POST["submitState"])) {
    try {
        $stateName = $_POST["stateName"];
        $countryId = $_POST["countryId"];

        if (empty($stateName) || empty($countryId)) {
            throw new Exception("Both State name and Country are required.");
        }

        // Assuming State is a class handling state operations
        $state = new State();
        $state->setName($stateName);
        $state->setCountry(new Country($countryId));

        $saveState($state);

        header("Location: /realEstate/admin/state");
        exit();
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>

<html>
<head>
    <title>Add State</title>
    <link href="<?php echo URL . 'public/css/index.css'; ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo URL . 'public/css/admin/index.css'; ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo URL . 'public/css/admin/admin-form.css'; ?>" rel="stylesheet" type="text/css" />
</head>

<body>
    <?php
    // Include the sidebar
    require_once __DIR__ . "/../components/admin/sidebar.php";
    ?>

    <div id="body">
        <?php
        // Include the header
        require_once __DIR__ . "/../components/admin/header.php";
        ?>

        <div class="formContainer body" style="margin-bottom: 50px;">
            <form method="post" action="" class="city-form">
                <h1>Add State</h1>

                <?php if (isset($error)) : ?>
                    <div class="error">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>

                <div>
                    <label for="stateName">State Name</label>
                    <input type="text" name="stateName" id="stateName" />
                </div>

                <div>
                    <label for="countryId">Country</label>
                    <select name="countryId" id="countryId" class="city-form-select">
                        <option value="">Select Country</option>
                        <?php foreach ($countries as $country) : ?>
                            <option value="<?php echo $country->getId(); ?>" class="city-form-option">
                                <?php echo $country->getName(); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <button type="submit" name="submitState">Submit</button>
                </div>

                <div>
                    <a href="/realEstate/admin/state">View States</a>
                </div>
            </form>
        </div>

        <?php
        // Include the footer
        require_once __DIR__ . "/../components/admin/footer.php";
        ?>
    </div>

    <script src="<?php echo URL . 'public/js/admin/index.js'; ?>"></script>
</body>
</html>
