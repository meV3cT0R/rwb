<html>
    <head>
        <link href="./css/index.css" rel="stylesheet" type="text/css"/>
    </head>

    <body>
        <?php 
            include __DIR__."/../../components/admin/header.php";
        ?>
        <div>
            <h2> <strong>Total Property Type</strong> : <span> <?php  echo $totalPropertyTypes; ?></span></h2>
        </div>

        <?php 
            include __DIR__."/../../components/admin/footer.php";
        ?>
        <script src="./js/index.js"></script>
    </body>
</html>