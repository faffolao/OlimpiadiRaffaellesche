<?php 
    session_start();
    require '../../db_con.php';
    require "../../logger.php";
    
    // registrazione degli errori su file
    ini_set("display_errors","0");
    ini_set("error_log", "../../php_error_log.txt");
    
    $dataApertura = strtr($_POST["dataApertura"], '/', '-');    //per evitare la data gennaio 1970
    $oraInizio = $_POST["oraInizio"];
    $oraFine = $_POST["oraFine"];
        
    if(!empty($dataApertura) && !empty($oraInizio) && !empty($oraFine)){
        $newDataApertura = date("Y-m-d H:i:s", strtotime($dataApertura));
        $newOraInizio = date("H:i:s", strtotime($oraInizio));
        $newOraFine = date("H:i:s", strtotime($oraFine));
        
        if($conn->query("UPDATE settings SET dataApertura='" . $newDataApertura . "', oraInizio='" . $newOraInizio . "',
                        oraFine='" . $newOraFine . "'")){
            Logger::writeToLog("../../log.json","log-mod-impostazioni-utenti","E' stato impostato un nuovo orario del quiz:
                                Apre alle " . $newDataApertura . ", si avvia alle " . $newOraInizio ." e finisce alle "
                                . $newOraFine);
            exit;
        }else{
            Logger::writeToLog("../../log.json","log-errori","Impossibile modificare le date del quiz: ".$conn->error);
            die("errore durante la modifica delle date: " . $conn->error);
        }
    }else{
        die("non è stato passato alcun parametro");
    }
?>