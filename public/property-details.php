<?php require_once __DIR__ . "/../constants.php";
require_once __DIR__ . "/../src/models/Property.php";
session_start();
if (isset($_POST["comment"])) {
    try {
        $commentString = $_POST["comment"];
        $enquiryId = $_POST["enquiryId"];
        $comment = new Comment();
        $comment->setComment($commentString);
        $comment->setCommentFor(new Enquiry($enquiryId));
        logMessage($_SESSION["user"]->getId());
        if (isset($_SESSION["user"])) {
            $createdBy = new User($_SESSION["user"]->getId());
            $comment->setCreatedBy($createdBy);
        }
        $saveComment($comment);
        header("Location: /realEstate/property-details?id=".$property->getId());
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

if (isset($_POST["enquiry"])) {
    try {
        $enquiryString = $_POST["enquiryString"];
        $enquiry = new Enquiry();
        $enquiry->setEnquiry($enquiryString);
        $enquiry->setEnquiryFor($property);
        logMessage($_SESSION["user"]->getId());
        if (isset($_SESSION["user"])) {
            $createdBy = new User($_SESSION["user"]->getId());
            $enquiry->setCreatedBy($createdBy);
        }
        $saveEnquiry($enquiry);
        header("Location: /realEstate/property-details?id=".$property->getId());
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

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

<>
    <?php include __DIR__ . "/../components/header.php"; ?>

    <div class="container">
        <h1>Property Details</h1>
        <div>
            <p class="error">
                    <?php
                        if(isset($error)){
                            echo $error;
                        }
                    ?>
            </p>
        </div>
        <?php if ($property instanceof Property): ?>
            <div class="property-detail">
                <div class="property-image">
                    <img src="<?php echo $property->getPropertyPhotos() != null ? $property->getPropertyPhotos()[0]->getUrl() : ''; ?>"
                        alt="Property Image" />
                </div>
                <div class="property-info">
                    <h2><?php echo $property->getAddress(); ?></h2>
                    <p><strong>Description:</strong> <?php echo $property->getDescription(); ?></p>
                    <p><strong>Status:</strong> <?php echo $property->getStatus(); ?></p>
                    <p><strong>Price:</strong> $<?php echo number_format($property->getPrice(), 2); ?></p>
                    <p><strong>Year Built:</strong> <?php echo $property->getYearBuilt(); ?></p>
                    <p><strong>Total Sq Ft:</strong> <?php echo $property->getTotalSqFt(); ?></p>
                    <p><strong>Lot Size:</strong>
                        <?php echo $property->getLotSize() . ' ' . $property->getLotSizeUnit(); ?>
                    </p>
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
                                <img src="<?php echo base64_decode($photo->getUrl()); ?>" alt="Gallery Image" />
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No additional images available.</p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="enquiries">
                <h3> Enquiries</h3>
                <?php
                if ($property->getEnquiries() != null) {
                    foreach ($property->getEnquiries() as $enquiry) {
                        if ($enquiry instanceof Enquiry) {
                            ?>
                            <div class="enquiries-boxes">
                                <div class="enquiry-box">
                                    <div class="enquiry">

                                        <div>
                                            <h4><!--- Name --->
                                <?php echo $enquiry->getCreatedBy()->getUsername(); ?>
                            </h4>
                            <p><!--- date --->
                                <?php echo date('Y-m-d'); ?>
                            </p>
                        </div>
                        <div>
                            <div>
                                <!--- Enquiry --->
                                <?php
                                    echo $enquiry->getEnquiry();
                                ?>
                            </div>
                        </div>

                        <div class="comments">
                            <?php
                            if ($enquiry->getComments() != null) {
                                foreach ($enquiry->getComments() as $comment) {
                                    if ($comment instanceof Comment) {
                                        ?>


                            <div class="comment">
                                <div>
                                    <h4><!--- Name --->

                                        <?php
                                        echo $comment->getCreatedBy()->getUsername();
                                        ?>
                                    </h4>
                                    <p><!--- date --->
                                        <?php echo date('Y-m-d'); ?>
                                    </p>
                                </div>
                                <div>
                                    <?php
                                    echo $comment->getComment();
                                    ?>
                                </div>
                            </div>
                            <?php
                                    }

                                }
                            }
                            ?>
                        </div>

                        <div class="commentBox">
                            <form class="commentBoxForm" action="" method="post">
                                <div class="commentInputContainer">
                                    <input type="text" name="comment" />
                                    <input type="hidden" name="enquiryId" value="<?php echo $enquiry->getId() ?>" />
                                    <button name="submit">submit</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>

                <?php
                        }
                    }
                }
                ?>

                <div class="enquiryInputBox">
                    <form class="enquiryForm" method="post">
                        <div action="" method="post">
                            <label for="enquiry" style="display:block;padding:10px 0;">New Enquiry:</label>
                            <textarea id="enquiry" name="enquiryString" placeholder="Write your enquiry..."
                                required></textarea>

                        </div>
                        <div style="margin-top:10px;">
                            <button type="submit" name="enquiry">Submit Enquiry</button>
                        </div>
                    </form>
                </div>
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