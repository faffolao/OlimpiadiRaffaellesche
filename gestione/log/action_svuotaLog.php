<?php 
    require_once '../../logger.php';
    // registrazione degli errori su file
    ini_set("display_errors","0");
    ini_set("error_log", "../php_error_log.txt");
    
    
    if (isset($_POST["test"]) && $_POST["test"] === "qr"){
        Logger::emptyLog("../../log.json");
        exit;
    }
?>