<?php
	session_start();
	include("../../db_con.php");
	include "../../logger.php";
        
        // registrazione degli errori su file
        ini_set("display_errors","0");
        ini_set("error_log", "../../php_error_log.txt");

	$id = $_POST['id'];

	if($id != "" && $conn->query("DELETE FROM `utenti` WHERE `id`='" . $id . "'")){
	    Logger::writeToLog("../../log.json","log-mod-impostazioni-utenti","E' stato rimosso l'amministratore n. " . $id);
		exit;
	}else{
	    Logger::writeToLog("../../log.json","log-errori","Impossibile rimuovere l'amministratore " . $id . ": ".$conn->error);
		die("Errore nell'eliminazione dell'utente: " . $conn->error);
	}
?>