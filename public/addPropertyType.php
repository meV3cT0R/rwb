<?php
    if(isset($_POST["submitPropertyType"])) {
        try {
            $propertyTypeName = $_POST["propertyTypeName"];
            if(empty($propertyTypeName)) {
                throw new Exception("Property Type name is required.");
            }
            
            // Assuming PropertyType is a class handling property types
            $propertyType = new PropertyType();
            $propertyType->setName($propertyTypeName);
            // Assuming savePropertyType is the function to save it in the database
            savePropertyType($propertyType);
        } catch(Exception $e) {
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
            <form method="post" action="">
                <h1> Add Property Type </h1>

                <?php if (isset($error)) : ?>
                    <div class="error">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>

                <div>
                    <label> 
                        Property Type Name
                    </label>
                    <input type="text" name="propertyTypeName" />
                </div>

                <div>
                    <button name="submitPropertyType">
                        Submit
                    </button>
                </div>

                <div>
                    <a href="/realEstate/propertyTypeList"> 
                        View Property Types
                    </a>
                </div>
            </form>
        </div>

        <?php 
            include __DIR__."/../components/footer.php";
        ?>
        <script src=<?php echo URL . "public/js/index.js" ?>></script>
    </body>
</html>
