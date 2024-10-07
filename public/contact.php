<?php
include __DIR__ . "/../src/index.php";
session_start();
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
  <div class="contact-container body" style="padding:20px 0px;">
    <h1>Contact Us</h1>
    <div class="contact-info">
      <p><strong>Email:</strong> <?php 
          if(isset($email)) {
            echo "". $email ."";
          }else {
            echo "yourname@example.com";
          }
      ?></p>
      <p><strong>Phone:</strong><?php 
          if(isset($phone)) {
            echo "". $phone ."";
          }else {
            echo "11111111111";
          }
      ?></p>
      <p><strong>Address:</strong> <?php 
          if(isset($address)) {
            echo "". $address ."";
          }else {
            echo "Addresss";
          }
      ?></p>
    </div>
    <form class="contact-form">
      <label for="name">Name</label>
      <input type="text" id="name" placeholder="Your Name">

      <label for="email">Email</label>
      <input type="email" id="email" placeholder="Your Email">

      <label for="message">Message</label>
      <textarea id="message" placeholder="Your Message"></textarea>

      <button type="submit">Submit</button>
    </form>
  </div>

  <?php
  include __DIR__ . "/../components/footer.php";
  ?>
  <script src=<?php echo URL . "public/js/index.js" ?>></script>

</body>

</html>