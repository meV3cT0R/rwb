<?php
require_once __DIR__ . "/../constants.php";
require_once __DIR__ . "/../src/models/Property.php";

if (isset($_POST["search"])) {
    if (isset($search)) {
        $properties = $search($_POST["type"], $_POST["status"], $_POST["city"]);
    }
} else {
    if (isset($propertiesInitial)) {
        $properties = $propertiesInitial;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href=<?php echo URL . "public/css/index.css" ?> rel="stylesheet" type="text/css" />
    <link href=<?php echo URL . "public/css/properties-manage.css" ?> rel="stylesheet" type="text/css" />
    <title>Properties</title>
</head>

<body>
    <?php include __DIR__ . "/../components/header.php"; ?>

    <div class="container" style="flex-grow:1">
        <h1 style="margin-bottom:20px;">Properties</h1>

        <div class="searchBar">
            <form class="searchForm" action="" method="post">
                <?php if (isset($types)) { ?>
                    <select name="type">
                        <option value="all"> Type</option>
                        <?php foreach ($types as $type) { ?>
                            <option value="<?php echo $type->getId() ?>"> <?php echo $type->getName(); ?></option>
                        <?php } ?>
                    </select>
                <?php } ?>

                <?php if (isset($status)) { ?>
                    <select name="status">
                        <option value="all"> Status</option>
                        <?php foreach ($status as $s) { ?>
                            <option value="<?php echo $s ?>"> <?php echo $s; ?></option>
                        <?php } ?>
                    </select>
                <?php } ?>

                <?php if (isset($cities)) { ?>
                    <select name="city">
                        <option value="all"> City </option>
                        <?php foreach ($cities as $city) { ?>
                            <option value="<?php echo $city->getId() ?>"> <?php echo $city->getName(); ?></option>
                        <?php } ?>
                    </select>
                <?php } ?>
                <button class="search" name="search">Search</button>
            </form>
        </div>

        <div class="properties-list">
            <?php
            if (isset($properties)) {
                foreach ($properties as $property) {
                    if ($property instanceof Property) {
                        $propertyId = $property->getId();
                        ?>
                        <div class="property-row">
                            <div class="property-image">
                                <img src="<?php echo URL . ($property->getPropertyPhotos() != null ? $property->getPropertyPhotos()[0]->getUrl() : 'default-image.jpg'); ?>" alt="Property Image" />
                            </div>
                            <div class="property-details">
                                <h2><?php echo $property->getAddress(); ?></h2>
                                <p class="property-description"><?php echo $property->getDescription(); ?></p>
                                <div class="property-info">
                                    <span class="property-status">Status: <?php echo $property->getStatus(); ?></span>
                                    <span class="property-price">Price: $<?php echo number_format($property->getPrice(), 2); ?></span>
                                </div>
                            </div>
                            <div class="property-actions">
                                <a href="<?php echo URL . 'manageproperties/edit?id=' . $propertyId; ?>" class="edit-button">Edit</a>
                                <a href="<?php echo URL . 'manageproperties/delete?id=' . $propertyId; ?>" class="delete-button">Delete</a>
                            </div>
                        </div>
                        <?php
                    }
                }
            }
            ?>
        </div>

        <!-- Add Button -->
        <a href="<?php echo URL . 'manageproperties/add'; ?>" class="add-property-button">+</a>

    </div>

    <?php include __DIR__ . "/../components/footer.php"; ?>
    <script src=<?php echo URL . "public/js/index.js" ?>></script>
</body>

</html>
