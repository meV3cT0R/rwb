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
        <div style="margin-top:20px;">

            <h1>Contact RE</h1>
            <p>We're here to help and answer any question you might have. We look forward to hearing from you 😊</p>
        </div>
    
    <form id="contact-form">
      <div class="names">
            <label for="firstName">FIRST NAME* <input type="text" id="firstName" name="firstName" required></label>
        
            <label for="lastName">LAST NAME* <input type="text" id="lastName" name="lastName" required></label> 
            
      </div>

         <label for="email">EMAIL*</label><br>
    <input type="email" id="email" name="email" required>

    <label for="message">MESSAGE*</label><br>
    <textarea id="message" name="message" required></textarea>

      <button type="submit">Send Message</button>
    </form>
  </div>
    <?php
    include __DIR__ . "/../components/footer.php";
    ?>
    <script src=<?php echo URL . "public/js/index.js" ?>></script>
    <script src=<?php echo URL . "public/js/form.js" ?>></script>

</body>

</html>