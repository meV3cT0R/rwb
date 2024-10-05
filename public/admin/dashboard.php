<?php
require_once __DIR__ . "/../../constants.php";
?>
<html>

<head>
    <title>Admin Dashboard</title>
    <link href="http://localhost/realEstate/public/css/index.css" rel="stylesheet" type="text/css" />
    <link href="http://localhost/realEstate/public/css/admin/index.css" rel="stylesheet" type="text/css" />
    <link href="http://localhost/realEstate/public/css/admin/dashboard.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <?php
    include __DIR__ . "/../../components/admin/sidebar.php";
    ?>

    <div id="body">

        <?php
        include __DIR__ . "/../../components/admin/header.php";
        ?>
        <div class="info">
            <div>
                <h2> <strong>Total Property Type</strong> : <span> <?php echo $totalPropertyTypes; ?></span></h2>
            </div>
            <div>
                <h2> <strong>Total Country</strong> : <span> <?php echo $totalCountry; ?></span></h2>
            </div>
            <div>
                <h2> <strong>Total State</strong> : <span> <?php echo $totalState; ?></span></h2>
            </div>
            <div>
                <h2> <strong>Total City</strong> : <span> <?php echo $totalCity; ?></span></h2>
            </div>
            <div>
                <h2> <strong>Total Agents</strong> : <span> <?php echo $totalAgent; ?></span></h2>
            </div>
            <div>
                <h2> <strong>Total Owners</strong> : <span> <?php echo $totalOwner; ?></span></h2>
            </div>
            <div>
                <h2> <strong>Total Users</strong> : <span> <?php echo $totalUser; ?></span></h2>
            </div>
            <div>
                <h2> <strong>Total Properties</strong> : <span> <?php echo $totalProperties; ?></span></h2>
            </div>
        </div>
        <?php
        include __DIR__ . "/../../components/admin/footer.php";
        ?>
    </div>

    <script src=<?php echo URL . "public/js/admin/index.js" ?>></script>
</body>

</html>