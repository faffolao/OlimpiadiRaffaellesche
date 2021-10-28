<?php 
    session_start();
    require '../../db_con.php';
    require "../../logger.php";
    
    // registrazione degli errori su file
    ini_set("display_errors","0");
    ini_set("error_log", "../../php_error_log.txt");
    
    if($_POST["aperte"] == "true") {
        if ($conn->query("UPDATE settings SET informazioniAttive=1")) {
            Logger::writeToLog("../../log.json","log-mod-impostazioni-utenti","Informazioni Generali Attivate.");
            exit();
        }else{
            Logger::writeToLog("../../log.json","log-errori","Impossibile attivare le informazioni generali: " . $conn->error);
            die("impossibile attivare le info generali: " . $conn->error);
        }
    }else if($_POST["aperte"] == "false"){
        if ($conn->query("UPDATE settings SET informazioniAttive=0")) {
            Logger::writeToLog("../../log.json","log-mod-impostazioni-utenti","Informazioni Generali Disattivate.");
            exit();
        }else{
            Logger::writeToLog("../../log.json","log-errori","Impossibile disattivare le informazioni generali: " . $conn->error);
            die("impossibile attivare le info generali: " . $conn->error);
        }
    }else{
        die("non è stato passato alcun parametro");
    }
?>