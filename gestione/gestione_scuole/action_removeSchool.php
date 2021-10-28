<?php 
    require '../../db_con.php';
    require "../../logger.php";
    
    // registrazione degli errori su file
    ini_set("display_errors","0");
    ini_set("error_log", "../../php_error_log.txt");
    
    $cod_meccanografico = $_POST["cod_meccanografico"];
    
    if(!empty($cod_meccanografico) && $conn->query("DELETE FROM `scuole` WHERE cod_meccanografico='" . $cod_meccanografico . "'")){
        Logger::writeToLog("../../log.json","log-mod-impostazioni-utenti","E' stata eliminata la scuola " . $cod_meccanografico);
        exit;
    }else{
        Logger::writeToLog("../../log.json","log-errori","Impossibile eliminare la scuola " . $cod_meccanografico . ": " . $conn->error);
    }
?>