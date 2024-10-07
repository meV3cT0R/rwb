<html>
<head>
    <link href="<?php echo URL . 'public/css/index.css'; ?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo URL . 'public/css/admin/property.css'; ?>" rel="stylesheet" type="text/css"/>
</head>

<body>
        
        <?php include __DIR__ . "/../components/header.php"; ?>
        <div class="formContainer body" style="margin-bottom: 50px;">
            <form method="post" action="" class="property-form">
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
                                <option value="<?php echo $type['id']; ?>"><?php echo $type['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="status" class="label">Status</label>
                        <input type="text" name="status" id="status" class="input-field" />
                    </div>

                    <div class="form-group">
                        <label for="yearBuilt" class="label">Year Built</label>
                        <input type="number" name="yearBuilt" id="yearBuilt" class="input-field" />
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="marketedBy" class="label">Marketed By</label>
                        <select name="marketedBy" id="marketedBy" class="select-field">
                            <option value="">Select Agent</option>
                            <?php foreach ($marketedByOptions as $agent) : ?>
                                <option value="<?php echo $agent['id']; ?>"><?php echo $agent['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="description" class="label">Description</label>
                        <textarea name="description" id="description" class="textarea-field"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="price" class="label">Price</label>
                        <input type="number" name="price" id="price" class="input-field" />
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="totalSqFt" class="label">Total Sq Ft</label>
                        <input type="number" name="totalSqFt" id="totalSqFt" class="input-field" />
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
                        <input type="number" name="lotSize" id="lotSize" class="input-field" />
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="cityId" class="label">City</label>
                        <select name="cityId" id="cityId" class="select-field">
                            <option value="">Select City</option>
                            <?php foreach ($cities as $city) : ?>
                                <option value="<?php echo $city['id']; ?>"><?php echo $city['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="address" class="label">Address</label>
                        <input type="text" name="address" id="address" class="input-field" />
                    </div>
                </div>

                <div>
                    <button type="submit" name="submitProperty" class="submit-button">Submit</button>
                </div>

                <div>
                    <a href="#" class="link">Cancel</a>
                </div>
            </form>
        </div>
        <?php include __DIR__ . "/../components/footer.php"; ?>
</body>
</html>
