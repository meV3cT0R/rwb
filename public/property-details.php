<?php
require_once __DIR__ . "/../constants.php";
require_once __DIR__ . "/../src/models/Property.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo URL . 'public/css/index.css'; ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo URL . 'public/css/property-details.css'; ?>" rel="stylesheet" type="text/css" />
    <title>Property Details</title>
</head>

<body>
    <?php include __DIR__ . "/../components/header.php"; ?>

    <div class="container">
        <h1>Property Details</h1>
        <?php if ($property instanceof Property): ?>
            <div class="property-detail">
                <div class="property-image">
                    <img src="<?php echo $property->getPropertyPhotos() != null ? URL . $property->getPropertyPhotos()[0]->getUrl() : ''; ?>" alt="Property Image" />
                </div>
                <div class="property-info">
                    <h2><?php echo $property->getAddress(); ?></h2>
                    <p><strong>Description:</strong> <?php echo $property->getDescription(); ?></p>
                    <p><strong>Status:</strong> <?php echo $property->getStatus(); ?></p>
                    <p><strong>Price:</strong> $<?php echo number_format($property->getPrice(), 2); ?></p>
                    <p><strong>Year Built:</strong> <?php echo $property->getYearBuilt(); ?></p>
                    <p><strong>Total Sq Ft:</strong> <?php echo $property->getTotalSqFt(); ?></p>
                    <p><strong>Lot Size:</strong> <?php echo $property->getLotSize() . ' ' . $property->getLotSizeUnit(); ?></p>
                    <p><strong>Marketed By:</strong> <?php echo $property->getMarketedBy()->getFirstName(); ?></p>
                    <p><strong>City:</strong> <?php echo $property->getCity()->getName(); ?></p>
                </div>      
            </div>

            
            <div class="gallery">
                <h3>Property Gallery</h3>
                <div class="gallery-grid">
                    <?php if ($property->getPropertyPhotos() != null): ?>
                        <?php foreach ($property->getPropertyPhotos() as $photo): ?>
                            <div class="gallery-item">
                                <img src="<?php echo URL . $photo->getUrl(); ?>" alt="Gallery Image" />
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No additional images available.</p>
                    <?php endif; ?>
                </div>
            </div>
        <?php else: ?>
            <p>Property not found.</p>
        <?php endif; ?>
    </div>

    <?php include __DIR__ . "/../components/footer.php"; ?>
    <script src="<?php echo URL . 'public/js/index.js'; ?>"></script>
</body>
</html>
