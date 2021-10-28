<?php 
    session_start();
    require '../../db_con.php';
    require "../../logger.php";
    
    // registrazione degli errori su file
    ini_set("display_errors","0");
    ini_set("error_log", "../../php_error_log.txt");
    
    if($_POST["aperte"] == "true") {
        if ($conn->query("UPDATE settings SET betaAperta=1")) {
            Logger::writeToLog("../../log.json","log-mod-impostazioni-utenti","Beta Sito Attivata.");
            exit();
        }else{
            Logger::writeToLog("../../log.json","log-errori","Impossibile attivare la beta: " . $conn->error);
            die("impossibile attivare la beta: " . $conn->error);
        }
    }else if($_POST["aperte"] == "false"){
        if ($conn->query("UPDATE settings SET betaAperta=0")) {
            Logger::writeToLog("../../log.json","log-mod-impostazioni-utenti","Beta Sito Disattivata.");
            exit();
        }else{
            Logger::writeToLog("../../log.json","log-errori","Impossibile disattivare la beta: " . $conn->error);
            die("impossibile chiudere la beta: " . $conn->error);
        }
    }else{
        die("non è stato passato alcun parametro");
    }
?>