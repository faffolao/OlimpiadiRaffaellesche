<?php 
    session_start();
    require '../../db_con.php';
    require '../../logger.php';
    
    // registrazione degli errori su file
    ini_set("display_errors","0");
    ini_set("error_log", "../../php_error_log.txt");
    
    $type = $_POST["type"];
    
    if(!empty($type)){
        if($type == "open"){
            if(!$conn->query("UPDATE settings SET dataApertura = NOW()")){
                Logger::writeToLog("../../log.json","log-errori","Impossibile aprire il quiz in questo momento: ".
                    $conn->error);
                die("errore della query: " . $conn->error);
            }else{
                Logger::writeToLog("../../log.json","log-statoquiz","Il quiz è stato aperto dall'amministratore.");
            }
        }else if($type == "start"){
            $conn->query("UPDATE settings SET dataApertura = NOW(), oraInizio = NOW()");
            Logger::writeToLog("../../log.json","log-statoquiz","Il quiz è stato avviato dall'amministratore.");
        }else if($type == "end") {
            $conn->query("UPDATE settings SET oraFine = NOW()");
            Logger::writeToLog("../../log.json","log-statoquiz","Il quiz è stato chiuso dall'amministratore.");
        }
    }else{
        die("parametro vuoto");
    }
?>