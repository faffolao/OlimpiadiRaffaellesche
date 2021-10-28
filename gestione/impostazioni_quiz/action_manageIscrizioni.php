<?php 
    session_start();
    require '../../db_con.php';
    require "../../logger.php";
    
    // registrazione degli errori su file
    ini_set("display_errors","0");
    ini_set("error_log", "../../php_error_log.txt");
    
    if($_POST["aperte"] == "true") {
        if ($conn->query("UPDATE settings SET iscrizioniAperte=1")) {
            Logger::writeToLog("../../log.json","log-mod-impostazioni-utenti","Info Attivate.");
            exit();
        }else{
            Logger::writeToLog("../../log.json","log-errori","Impossibile attivare le info: " . $conn->error);
            die("impossibile attivare le info: " . $conn->error);
        }
    }else if($_POST["aperte"] == "false"){
        if ($conn->query("UPDATE settings SET iscrizioniAperte=0")) {
            Logger::writeToLog("../../log.json","log-mod-impostazioni-utenti","Info chiuse.");
            exit();
        }else{
            Logger::writeToLog("../../log.json","log-errori","Impossibile disattivare le info: " . $conn->error);
            die("impossibile disattivare le info: " . $conn->error);
        }
    }else{
        die("non è stato passato alcun parametro");
    }
?>