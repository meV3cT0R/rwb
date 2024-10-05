<?php
require_once __DIR__ . "/../../constants.php";
?>
<html>

<head>
    <title>Property Type</title>
    <link href=<?php echo URL . "public/css/index.css" ?> rel="stylesheet" type="text/css" />
    <link href=<?php echo URL . "public/css/admin/index.css" ?> rel="stylesheet" type="text/css" />
</head>


<body>
    <?php
    require_once __DIR__ . "/../../components/admin/sidebar.php";
    ?>
    <div id="body">
        <?php
        require_once __DIR__ . "/../../components/admin/header.php";
        ?>
        <div>
            <h1> List <?php
                if(isset($title)) {
                    echo "of ".$title;
                }
            ?></h1>
            <?php
                include __DIR__."/../../components/admin/table/table.php";
            ?>

        </div>

        <?php
        require_once __DIR__ . "/../../components/admin/footer.php";
        ?>
    </div>

    <script src=<?php echo URL . "public/js/admin/index.js" ?>></script>
</body>

</html>