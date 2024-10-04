<html>
    <head>
        <link href="./css/index.css" rel="stylesheet" type="text/css"/>
    </head>

    <body>
        <?php 
            include __DIR__."/../../components/admin/header.php";
        ?>
        <?php 
            include __DIR__."/../../components/admin/sidebar.php";
        ?>
        <div>
            <h2> <strong>Total Property Type</strong> : <span> <?php  echo $totalPropertyTypes; ?></span></h2>
        </div>
        <div>
            <h2> <strong>Total Country</strong> : <span> <?php  echo $totalCountry; ?></span></h2>
        </div>
        <div>
            <h2> <strong>Total State</strong> : <span> <?php  echo $totalState; ?></span></h2>
        </div>
        <div>
            <h2> <strong>Total City</strong> : <span> <?php  echo $totalCity; ?></span></h2>
        </div>
        <div>
            <h2> <strong>Total Agent</strong> : <span> <?php  echo $totalAgent; ?></span></h2>
        </div>
        <div>
            <h2> <strong>Total Owner</strong> : <span> <?php  echo $totalOwner; ?></span></h2>
        </div>
        <div>
            <h2> <strong>Total User</strong> : <span> <?php  echo $totalUser; ?></span></h2>
        </div>
        <div>
            <h2> <strong>Total Properties</strong> : <span> <?php  echo $totalProperties; ?></span></h2>
        </div>

        <?php 
            include __DIR__."/../../components/admin/footer.php";
        ?>
        <script src="./js/index.js"></script>
    </body>
</html>