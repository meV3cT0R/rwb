<?php
include __DIR__ . "/../src/index.php";
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href=<?php echo URL . "public/css/index.css" ?> rel="stylesheet" type="text/css" />
    <link href=<?php echo URL . "public/css/about.css" ?> rel="stylesheet" type="text/css" />


</head>

<body>
    <?php
    include __DIR__ . "/../components/header.php";
    ?>
    <main class="body">
        <div>

            <h1> Welcome to RE</h1>
            <div class="title">

                <p class="description">At RE, we believe that finding your dream home should be a seamless and enjoyable experience. Our team of dedicated professionals is committed to providing exceptional service, expert knowledge, and unparalleled results to make your real estate journey a success.</p>
                <img src=<?php echo URL . "public/images/real-state.jpg" ?> alt="image">
            </div>
            </div>
            <div class="story">

        </div>
        <hr>
        <div class="mission">
            <h1>Our mission</h2>
            <p class="desc">Our mission is to provide a superior real estate experience that exceeds our clients' expectations. We strive to build long-term relationships based on trust, respect, and open communication. Our goal is to make the process of buying or selling a property as smooth and stress-free as possible, while ensuring that our clients achieve their goals and realize their dreams.</p>
        </div>
        <hr>
        <div class="team">
            <h1>Our Team</h1>
            <p class="desc">Our team of experienced agents and support staff are dedicated to providing exceptional service and expert guidance throughout every step of the real estate process. With extensive knowledge of the local market and a passion for delivering results, our team is committed to helping you achieve your real estate goals.   </p>
        </div>
        <hr>
        <div class="sets-apart">
            <h1>What sets Us Apart</h1>
            <ul>
    <li>
        <h3>Personalized Service:</h3>
        <p>We take the time to understand your unique needs and goals, tailoring our approach to meet your individual requirements.</p>
    </li>
    <li>
        <h3>Expert Knowledge:</h3>
        <p>Our team has extensive knowledge of the local market, ensuring that you receive the best possible guidance and advice.</p>
    </li>
    <li>
        <h3>Proven Results:</h3>
        <p>Our track record of success speaks for itself, with a long history of satisfied clients and successful transactions.</p>
    </li>
    <li>
        <h3>Community Focus:</h3>
        <p>We are committed to giving back to our community, supporting local charities and initiatives that make a positive impact.</p>
    </li>
</ul>

        </div>
        <!-- <div class="touch"></div> -->
    </main>
    <?php
    include __DIR__ . "/../components/footer.php";
    ?>
    <script src=<?php echo URL . "public/js/index.js" ?>></script>
</body>

</html>