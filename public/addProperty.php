<?php
// Check if the form is submitted

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try{
    // Extract the posted data
    $propertyTypeId = $_POST['propertyTypeId'] ?? null;
    $status = $_POST['status'] ?? null;
    $yearBuilt = $_POST['yearBuilt'] ?? null;
    $description = $_POST['description'] ?? null;
    $price = $_POST['price'] ?? null;
    $totalSqFt = $_POST['totalSqFt'] ?? null;
    $lotSizeUnit = $_POST['lotSizeUnit'] ?? null;
    $lotSize = $_POST['lotSize'] ?? null;
    $cityId = $_POST['cityId'] ?? null;
    $address = $_POST['address'] ?? null;
    $errYes = false;
    $error = '';

    $propertyTypeId = trim($_POST['propertyTypeId'] ?? null);
    $status = trim($_POST['status'] ?? null);
    $yearBuilt = trim($_POST['yearBuilt'] ?? null);
    $description = trim($_POST['description'] ?? null);
    $price = trim($_POST['price'] ?? null);
    $totalSqFt = trim($_POST['totalSqFt'] ?? null);
    $lotSizeUnit = trim($_POST['lotSizeUnit'] ?? null);
    $lotSize = trim($_POST['lotSize'] ?? null);
    $cityId = trim($_POST['cityId'] ?? null);
    $address = trim($_POST['address'] ?? null);

    if (
        empty($propertyTypeId) || empty($status) || empty($yearBuilt) ||
        empty($description) || empty($price) || empty($totalSqFt) ||
        empty($lotSizeUnit) || empty($lotSize) || empty($cityId) || empty($address)
    ) {
        $error = "All fields are required";
        $errYes = true;
    }

    if (!is_numeric($yearBuilt) || !is_numeric($price) || !is_numeric($totalSqFt) || !is_numeric($lotSize)) {
        $error = "Year Built, Price, Total Sq Ft, and Lot Size should be numbers";
        $errYes = true;
    }
    
    if(!$errYes){

        if($add){

                $property = new Property();
            }

    // Set the values using the setters
    $property->setPropertyType(new PropertyType((int)$propertyTypeId));
    $property->setStatus($status);
    $property->setYearBuilt((int)$yearBuilt);
    $property->setMarketedBy(new User($_SESSION["user"]->getId()));
    $property->setDescription($description);
    $property->setPrice((int)$price);
    $property->setTotalSqFt((int)$totalSqFt);
    $property->setLotSizeUnit($lotSizeUnit);
    $property->setLotSize((int)$lotSize);
    $property->setCity(new City((int)$cityId));
    $property->setAddress($address);

    // Now, $property object has all the posted data set
    // You can process it (e.g., save it to the database)
    
    $photos = [];

    if(isset($_FILES["propertyFiles"])) {
        $files = Helper::uploadImages($_FILES['propertyFiles']);
        foreach($files as $f) {
            $photo = new PropertyPhotos();
            $photo->setUrl($f);
            array_push($photos, $photo);

        }
    }
    $property->setPropertyPhotos($photos);

    if($add){
        $saveProperty($property);
    }else {
        $updateProperty($property);
    }
    header("Location: /realEstate/manageproperties");
}

}catch(
    Exception $e
) {
    $error = $e->getMessage();
    throw $e;
}
}

?>


<html>
<head>
    <link href="<?php echo URL . 'public/css/index.css'; ?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo URL . 'public/css/admin/property.css'; ?>" rel="stylesheet" type="text/css"/>
</head>

<body>
        
        <?php include __DIR__ . "/../components/header.php"; ?>
        <div class="formContainer body" style="margin-bottom: 50px;">
            <form method="post" action="" class="property-form" enctype="multipart/form-data">
                <h1 class="form-title">Add Property</h1>

                <?php if (isset($error)) : ?>
                    <div class="error-message">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>

                <div class="form-row">
                    <div class="form-group">
                        <label for="propertyTypeId" class="label">Property Type</label>
                        <select name="propertyTypeId" id="propertyTypeId" class="select-field">
                            <option value="">Select Property Type</option>
                            <?php foreach ($propertyTypes as $type) : ?>
                                <option value="<?php echo $type->getId(); ?>"
                                    selected="<?php
                                        if(isset($type) && isset($property) && $property->getPropertyType()!=null) {
                                            if($type->getId()!=null) {
                                                echo $type->getId()==$property->getPropertyType()->getId();
                                            }
                                        }
                                    ?>"
                                ><?php echo $type->getName(); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="status" class="label">Status</label>
                        <input
                         type="text" name="status" id="status" class="input-field" 

                         value="<?php
                            if(isset($property))
                                echo $property->getStatus();
                         ?>"
                         />
                    </div>

                    <div class="form-group">
                        <label for="yearBuilt" class="label">Year Built</label>
                        <input type="text" name="yearBuilt" id="yearBuilt" class="input-field"
                        value="<?php

                            if(isset($property)){
                                
                                echo $property->getYearBuilt();
                            }
                         ?>"
                        />
                    </div>
                </div>

                <div class="form-row">
                    

                    <div class="form-group">
                        <label for="description" class="label">Description</label>
                        <textarea name="description" id="description" class="textarea-field"><?php
                            if(isset($property))
                                echo $property->getDescription();
                         ?>
                        </textarea>
                    </div>

                    <!-- New Multiple File Upload Input -->
                    <div class="form-group">
                        <label for="propertyFiles" class="label">Upload Files</label>
                        <input 
                        type="file" name="propertyFiles[]" id="propertyFiles" class="input-field" multiple />
                    </div>

                    <div class="form-group">
                        <label for="price" class="label">Price</label>
                        <input type="text" name="price" id="price" class="input-field" 
                        value="<?php

                            if(isset($property))
                                echo $property->getPrice();
                         ?>
                        "

                        />
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="totalSqFt" class="label">Total Sq Ft</label>
                        <input type="text" name="totalSqFt" id="totalSqFt" class="input-field"
                        value=" <?php
                            if(isset($property))
                                echo $property->getTotalSqFt();
                         ?>
                        "    
                        />
                    </div>

                    <div class="form-group">
                        <label for="lotSizeUnit" class="label">Lot Size Unit</label>
                        <select name="lotSizeUnit" id="lotSizeUnit" class="select-field">
                            <option value="sqft">Sq Ft</option>
                            <option value="acre">Acre</option>
                            <option value="hectare">Hectare</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="lotSize" class="label">Lot Size</label>
                        <input type="text" name="lotSize" id="lotSize" class="input-field" 
                        
                        value="<?php
                            if(isset($property))
                                echo $property->getLotSize();
                         ?>
                        "/>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="cityId" class="label">City</label>
                        <select name="cityId" id="cityId" class="select-field">
                            <option value="">Select City</option>
                            <?php foreach ($cities as $city) : ?>
                                <option value="<?php echo $city->getId(); ?>"
                                selected="<?php
                                        if(isset($type) && isset($property) && $property->getCity()!=null) {
                                            if($city->getId()!=null) {
                                                echo $city->getId()==$property->getCity()->getId();
                                            }
                                        }
                                    ?>"
                                
                                ><?php echo $city->getName(); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="address" class="label">Address</label>
                        <input type="text" name="address" id="address" class="input-field" 
                            value="<?php
                            if(isset($property))
                                echo $property->getAddress();
                         ?>
                        "
                        />
                    </div>
                </div>

                <div>
                    <button type="submit" name="submitProperty" class="submit-button">Submit</button>
                </div>


            </form>
        </div>
        <?php include __DIR__ . "/../components/footer.php"; ?>
    <script src=<?php echo URL . "public/js/index.js" ?>></script>

</body>
</html>
