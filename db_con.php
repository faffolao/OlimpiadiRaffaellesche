<?php
    // registrazione degli errori su file
    ini_set("display_errors","0");
    ini_set("error_log", "php_error_log.txt");
    
    $SERVERNAME = "localhost";
    $USERNAME = "raffaello";
    $PASSWORD = "L4v4gn4@2o2o";
    $DBNAME = "olimpiadiraffaellesche";

    // Crea la connessione
    $conn = new mysqli($SERVERNAME, $USERNAME, $PASSWORD, $DBNAME);
    // Check connection
    if ($conn->connect_error) {
        die("Connessione fallita: " . $conn->connect_error);
    }

?>
