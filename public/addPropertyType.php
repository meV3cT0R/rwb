<?php
require_once __DIR__ . "/../constants.php";

// Handle form submission
if (isset($_POST["submitPropertyType"])) {
    try {
        $propertyTypeName = $_POST["propertyTypeName"];
        if (empty($propertyTypeName)) {
            throw new Exception("Property Type name is required.");
        }

        // Assuming PropertyType is a class handling property types
        $propertyType = new PropertyType();
        $propertyType->setName($propertyTypeName);

        // Assuming savePropertyType is the function to save it in the database
        savePropertyType($propertyType);
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>

<html>
    <head>
        <title>Add Property Type</title>
        <link href=<?php echo URL . "public/css/index.css" ?> rel="stylesheet" type="text/css" />
        <link href=<?php echo URL . "public/css/admin/index.css" ?> rel="stylesheet" type="text/css" />
        <link href=<?php echo URL . "public/css/admin/admin-form.css" ?> rel="stylesheet" type="text/css" />
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
                    <h1>Add Property Type</h1>

                    <?php if (isset($error)) : ?>
                        <div class="error">
                            <?php echo $error; ?>
                        </div>
                    <?php endif; ?>

                    <div>
                        <label for="propertyTypeName">Property Type Name</label>
                        <input type="text" name="propertyTypeName" id="propertyTypeName" />
                    </div>

                    <div>
                        <button type="submit" name="submitPropertyType">Submit</button>
                    </div>

                    <div>
                        <a href="/realEstate/admin/propertyType">View Property Types</a>
                    </div>
                </form>
            </div>


            <?php
            // Include the footer
            require_once __DIR__ . "/../components/admin/footer.php";
            ?>
        </div>

        <script src=<?php echo URL . "public/js/admin/index.js" ?>></script>
    </body>
</html>
