<?php
require_once __DIR__ . "/../../../constants.php";
?>
<html>

<head>
    <title>Property Type</title>
    <link href=<?php echo URL . "public/css/index.css" ?> rel="stylesheet" type="text/css"/>
    <link href=<?php echo URL . "public/css/admin/index.css" ?> rel="stylesheet" type="text/css"/>
</head>


<body>
        <?php 
            require_once __DIR__."/../components/admin/sidebar.php";
        ?> 
        <div id="body">

        <?php 
            require_once __DIR__."/../components/admin/header.php";
        ?>

        <h1> Template </h1>

        <?php 
            require_once __DIR__."/../../components/admin/header.php";
        ?>
        </div>

        <script src=<?php echo URL . "public/js/admin/index.js" ?>></script>
</body>

</html>