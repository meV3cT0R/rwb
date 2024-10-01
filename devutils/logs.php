<?php
    include(__DIR__."/../constants.php");
    function logMessage($msg): void {
        if(ENV == "PROD") return;
        echo "$msg <br />";
    }

    function logError($msg): void {
        if(ENV == "PROD") return;
        echo "$msg <br />";
    }
    function logWarning($msg): void {
        if(ENV == "PROD") return;
        echo "$msg <br />";
    }