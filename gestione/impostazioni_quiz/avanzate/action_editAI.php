<?php 
    session_start();
    require '../../../db_con.php';
    require "../../../logger.php";
    
    // registrazione degli errori su file
    ini_set("display_errors","0");
    ini_set("error_log", "../../../php_error_log.txt");
    
    $table = $_POST["table"];
    $value = $_POST["value"];
    
    if(!empty($table) && !empty($value) && $value >= 1){
        if($conn->query("ALTER TABLE " . $table . " AUTO_INCREMENT=" . $value . ";")){
            Logger::writeToLog("../../log.json","log-mod-impostazioni-utenti","E' stato modificato l'auto increment
                                della tabella " . $table . " a " . $value);
            exit;
        }else{
            Logger::writeToLog("../../log.json","log-errori","Impossibile modificare l'auto increment di " . $table . ": "
                . $conn->error);
            die("Errore durante la modifica della AI: " . $conn->error);
        }
    }else{
        die("parametri non validi");
    }
?>