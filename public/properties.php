<?php
require_once __DIR__ . "/../constants.php";
require_once __DIR__ . "/../src/models/Property.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href=<?php echo URL . "public/css/index.css" ?> rel="stylesheet" type="text/css" />
    <link href=<?php echo URL . "public/css/properties.css" ?> rel="stylesheet" type="text/css" />
    <title>Properties</title>
</head>

<body>
    <?php include __DIR__ . "/../components/header.php"; ?>

    <div class="container">
        <h1>Properties</h1>
        <div class="properties-grid">
            <?php
            if (isset($properties)) {
                foreach ($properties as $property) {
                    if ($property instanceof Property) {
                        $propertyId = $property->getId(); 
                        ?>
                        <a href="<?php echo URL . 'property-details?id=' . $propertyId; ?>" class="propertyCard">
                            <div class="propertyCardImage">
                                <img src=<?php
                                if ($property->getPropertyPhotos() != null)
                                    echo URL . $property->getPropertyPhotos()[0]->getUrl();
                                ?> alt="Property Image" />
                            </div>
                            <div class="propertyCardBody">
                                <h2 class="propertyCardBodyHeader">
                                    <?php echo $property->getAddress(); ?>
                                </h2>
                                <p class="property-description">
                                    <?php echo $property->getDescription(); ?>
                                </p>
                                <div class="property-info">
                                    <span class="property-status">
                                        Status: <?php echo $property->getStatus(); ?>
                                    </span>
                                    <span class="property-price">
                                        Price: $<?php echo number_format($property->getPrice(), 2); ?>
                                    </span>
                                </div>
                            </div>
                        </a>
                        <?php
                    }
                }
            }
            ?>
        </div>
    </div>

    <?php include __DIR__ . "/../components/footer.php"; ?>
    <script src=<?php echo URL . "public/js/index.js" ?>></script>
</body>
</html>
