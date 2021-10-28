<?php
	session_start();
	include("../../db_con.php");
	include "../../logger.php";
        
        // registrazione degli errori su file
        ini_set("display_errors","0");
        ini_set("error_log", "../../php_error_log.txt");

	$id = $_POST["id"];

	if(!empty($id) && $conn->query("DELETE FROM utenti WHERE id='" . $id . "';")) {
	    Logger::writeToLog("../../log.json","log-mod-impostazioni-utenti","E' stato eliminato lo studente n. " . $id);
		exit;
	}else{
	    Logger::writeToLog("../../log.json","log-errori","Impossibile eliminare lo studente n. " . $id . ": " . $conn->error);
		die("Errore nell'eliminazione dello studente: " . $conn->error);
	}
?>