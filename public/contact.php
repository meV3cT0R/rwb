<?php
include __DIR__ . "/../src/index.php";
?>
<html>

<head>
       <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href=<?php echo URL . "public/css/index.css" ?> rel="stylesheet" type="text/css" />
    <link href=<?php echo URL . "public/css/contact-us.css" ?> rel="stylesheet" type="text/css" />


</head>

<body>
    <?php
    include __DIR__ . "/../components/header.php";
    ?>
    <div class="body">

    <div style="margin:30px 0;">

<h1>Contact RE</h1>
</div>
    <form id="contact-form" method="post" >
      <div>
        <p>We're here to help and answer any question you might have. We look forward to hearing from you 😊</p>

      </div>
      <div class="names">
          <div>
            <label for="firstName">First Name </label>
            <input type="text" id="firstName" name="firstName" required>
          </div>
        <div>

            <label for="lastName">Last Name </label>
             <input type="text" id="lastName" name="lastName" required>
             </div>
            
      </div>
         <label for="email">E-mail</label><br>
    <input type="email" id="email" name="email" required>

    <label for="message">Message</label><br>
    <textarea id="message" name="message" required></textarea>

      <button type="submit">Send Message</button>
</form>

  </div>
    <?php
    include __DIR__ . "/../components/footer.php";
    ?>
    <script src=<?php echo URL . "public/js/index.js" ?>></script>

</body>

</html>