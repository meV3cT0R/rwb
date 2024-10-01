<?php
    $uri = "/realEstate/public";
    echo $uri. "<br />";
    echo $_ENV["home"];
    header("Location: ". $uri);
    exit;