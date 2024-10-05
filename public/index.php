<?php
    include __DIR__."/../src/index.php";
?>
<html>
    <head>
        <link href=<?php echo URL . "public/css/index.css" ?> rel="stylesheet" type="text/css"/>
        
    </head>

    <body>
        <?php 
            include __DIR__."/../components/header.php";
        ?>

        <h1> Hello World</h1>

        <?php 
            include __DIR__."/../components/footer.php";
        ?>
        <script src=<?php echo URL . "public/js/index.js" ?>></script>
    </body>
</html>