<?php
    session_start();
    include("../../db_con.php");
    include '../../logger.php';

    // registrazione degli errori su file
    ini_set("display_errors","0");
    ini_set("error_log", "../../php_error_log.txt");

    // eliminazione di tutte le immagini della cartella immagini_quiz
    shell_exec("rm -rf ../../immagini_quiz/*.*");
    
    // truncate della tabella
    if($conn->query("TRUNCATE caricato") && $conn->query("TRUNCATE svolgimento") && $conn->query("SET FOREIGN_KEY_CHECKS = 0")
            && $conn->query("TRUNCATE domande") && $conn->query("SET FOREIGN_KEY_CHECKS = 1")){
        Logger::writeToLog("../../log.json","log-mod-impostazioni-utenti","Domande cancellate.");
    }else{
        Logger::writeToLog("../../log.json","log-errori","Impossibile cancellare le domande: " . $conn->error);
    }
    
?>