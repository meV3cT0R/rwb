<?php
if (isset($_POST["submitCity"])) {
    try {
        $cityName = $_POST["cityName"];
        $countryId = $_POST["countryId"];
        $stateId = $_POST["stateId"];

        if (empty($cityName) || empty($countryId) || empty($stateId)) {
            throw new Exception("All fields are required.");
        }

        if ($add) {

            $city = new City();
            $city->setName($cityName);

            $city->setCountry(new Country($countryId));
            $city->setState(new State($stateId));

            $saveCity($city);
        }else {
            $city->setName($cityName);

            $city->setCountry(new Country($countryId));
            $city->setState(new State($stateId));
            $updateCity($city);
        }

        header("Location: /realEstate/admin/city");
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

<div class="formContainer body" style="margin-bottom: 50px">
            <form method="post" action="" class="city-form">
                <h1>Add City</h1>

                <?php if (isset($error)): ?>
                    <div class="error">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>

                <div>
                    <label for="cityName">City Name</label>
                    <input type="text" name="cityName" id="cityName" />
                </div>

                <div>
                    <label for="countryId">Country</label>
                    <select name="countryId" id="countryDropdown"
                            
                    class="city-form-select" onchange="filterStates()">
                        <option value="">Select Country</option>
                        <?php foreach ($countries as $country): ?>
                            <option 
                            selected="
                                <?php
                                        if(isset($city) && $city->getCountry()) {
                                            echo $country->getId()==$city->getCountry()->getId();
                                        }
                                ?>
                            "
                            value="<?php echo $country->getId(); ?>"><?php echo $country->getName(); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label for="stateId">State</label>
                    <select name="stateId" id="stateDropdown" class="city-form-select">
                        <option value="">Select State</option>
                        <?php foreach ($states as $state): ?>
                            <option value="<?php echo $state->getId(); ?>" selected="
                                <?php
                                        if(isset($city) && $city->getState()) {
                                            echo $state->getId()==$city->getState()->getId();
                                        }
                                ?>
                            "
                                data-country-id="<?php echo $state->getCountry()->getId(); ?>">
                                <?php echo $state->getName(); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <button type="submit" name="submitCity">Submit</button>
                </div>

                <div>
                    <a href="/realEstate/admin/city">View Cities</a>
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
