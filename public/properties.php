<?php
require_once __DIR__ . "/../constants.php";
require_once __DIR__ . "/../src/models/Property.php";
?>
<html>

<head>
    <link href=<?php echo URL . "public/css/index.css" ?> rel="stylesheet" type="text/css" />
    <link href=<?php echo URL . "public/css/properties.css" ?> rel="stylesheet" type="text/css" />

</head>

<body>
    <?php
    include __DIR__ . "/../components/header.php";
    ?>
    <div class="body">
        <h1> Properties</h1>
        <?php
        if (isset($properties)) {
            foreach ($properties as $property) {
                if ($property instanceof Property) {
                    ?>
                    <div class="propertyCard">
                        <div class="propertyCardImage">
                            <img src=<?php
                            if ($property->getPropertyPhotos() != null)
                                echo URL . $property->getPropertyPhotos()[0]->getUrl();
                            ?> />
                        </div>
                        <div class="propertyCardBody">
                            <div class="propertyCardBodyHeader">
                                <?php
                                    echo $property->getAddress();
                                ?>
                            </div>
                            <div>
                                <div>
                                    <?php
                                        echo $property->getDescription();
                                    ?>
                                </div>
                                <div>
                                    <div>
                                        <?php echo $property->getStatus(); ?>
                                    </div>
                                    <div>
                                        <?php echo $property->getPrice(); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="propertyCardBodyFooter">

                            </div>
                        </div>
                    </div>

                    <?php
                }

            }
        }
        ?>
    </div>
    <?php
    include __DIR__ . "/../components/footer.php";
    ?>
    <script src=<?php echo URL . "public/js/index.js" ?>></script>
</body>

</html>