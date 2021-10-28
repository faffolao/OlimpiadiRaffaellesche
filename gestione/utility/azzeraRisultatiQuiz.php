<?php
    require_once '../../db_con.php';
    require_once '../../logger.php';
    
    $logger = new Logger();
    
    if(isset($_POST["cancellazione"]) && $_POST["cancellazione"] == "true"){
        if($conn->query("DELETE FROM caricato WHERE 1") && $conn->query("DELETE FROM risposte WHERE 1") && $conn->query("DELETE FROM svolgimento WHERE 1")){
            $logger->writeToLog("../../log.json", "log-mod-impostazioni-utenti", "Tabella risposte del quiz svuotata.");
            $logger->writeToLog("../../log.json", "log-mod-impostazioni-utenti", "Tabella caricato del quiz svuotata.");
            $logger->writeToLog("../../log.json", "log-mod-impostazioni-utenti", "Tabella svolgimento del quiz svuotata.");
            http_response_code(200);
        }else{
            $logger->writeToLog("../../log.json", "log-errori", "Impossibile svuotare la tabella dei risultati del quiz: " . 
                    $conn->error);
            http_response_code(500);
        }
    }
?>