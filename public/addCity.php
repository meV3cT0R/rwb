<?php
// Simulating fetching data from the backend (replace these with real database queries)
$countries = [
    ['id' => 1, 'name' => 'USA'],
    ['id' => 2, 'name' => 'Canada'],
    ['id' => 3, 'name' => 'India']
];

$states = [
    ['id' => 1, 'country_id' => 1, 'name' => 'California'],
    ['id' => 2, 'country_id' => 1, 'name' => 'Texas'],
    ['id' => 3, 'country_id' => 2, 'name' => 'Ontario'],
    ['id' => 4, 'country_id' => 3, 'name' => 'Maharashtra']
];

if (isset($_POST["submitCity"])) {
    try {
        $cityName = $_POST["cityName"];
        $countryId = $_POST["countryId"];
        $stateId = $_POST["stateId"];

        if (empty($cityName) || empty($countryId) || empty($stateId)) {
            throw new Exception("All fields are required.");
        }

        $city = new City();
        $city->setName($cityName);
        $city->setCountryId($countryId);
        $city->setStateId($stateId);

        saveCity($city);
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>
<html>
<head>
    <link href="<?php echo URL . 'public/css/index.css'; ?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo URL . 'public/css/admin/index.css'; ?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo URL . 'public/css/admin/admin-form.css'; ?>" rel="stylesheet" type="text/css"/>
</head>

<?php require_once __DIR__ . "/../components/admin/sidebar.php"; ?>
<body>
    
    <div class="body">
        
        <?php require_once __DIR__ . "/../components/admin/header.php"; ?>
        <div class="formContainer body" style="margin-bottom: 50px;">
            <form method="post" action="" class="city-form">
                <h1>Add City</h1>

                <?php if (isset($error)) : ?>
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
                    <select name="countryId" id="countryDropdown" class="city-form-select" onchange="filterStates()">
                        <option value="">Select Country</option>
                        <?php foreach ($countries as $country) : ?>
                            <option value="<?php echo $country['id']; ?>"><?php echo $country['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label for="stateId">State</label>
                    <select name="stateId" id="stateDropdown" class="city-form-select">
                        <option value="">Select State</option>
                        <?php foreach ($states as $state) : ?>
                            <option value="<?php echo $state['id']; ?>" data-country-id="<?php echo $state['country_id']; ?>">
                                <?php echo $state['name']; ?>
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

        <?php require_once __DIR__ . "/../components/admin/footer.php"; ?>
    </div>

    <script src="<?php echo URL . 'public/js/index.js'; ?>"></script>
    <script src="<?php echo URL . 'public/js/form.js'; ?>"></script>
    <script src="<?php echo URL . 'public/js/admin/index.js'; ?>"></script>

    <script>
        // Function to filter states based on the selected country
        function filterStates() {
            var countryDropdown = document.getElementById("countryDropdown");
            var selectedCountry = countryDropdown.value;
            var stateDropdown = document.getElementById("stateDropdown");

            for (var i = 0; i < stateDropdown.options.length; i++) {
                var option = stateDropdown.options[i];
                var countryId = option.getAttribute('data-country-id');

                if (selectedCountry === "" || countryId === selectedCountry) {
                    option.style.display = 'block';
                } else {
                    option.style.display = 'none';
                }
            }
        }
    </script>
</body>
</html>
