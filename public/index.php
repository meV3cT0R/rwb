<?php
include __DIR__ . "/../src/index.php";
?>
<html>

<head>
    <link href=<?php echo URL . "public/css/index.css" ?> rel="stylesheet" type="text/css" />

</head>

<body>
    <?php
    include __DIR__ . "/../components/header.php";
    ?>
    <div class="body">


    <div class="team-container" style="margin:0px auto;">
        <h2 class="team-title">Meet Our Team</h2>
        <div class="team-member">
            <h3>Loveson</h3>
            <p>Student ID: K220374</p>
        </div>
        <div class="team-member">
            <h3>Mr Mathankumar Anilkumar Patel</h3>
            <p>Student ID: K210542</p>
        </div>
        <div class="team-member">
            <h3>Bishal Nayabha</h3>
            <p>Student ID: K220089</p>
        </div>
        <div class="team-member">
            <h3>Mr. Bipesh Lama</h3>
            <p>Student ID: K220049</p>
        </div>
    </div>
    </div>
    <?php
    include __DIR__ . "/../components/footer.php";
    ?>
    <script src=<?php echo URL . "public/js/index.js" ?>></script>
</body>

</html>