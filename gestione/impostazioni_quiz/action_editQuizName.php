<?php
	session_start();
	include("../../db_con.php");
	include "../../logger.php";
        
        // registrazione degli errori su file
        ini_set("display_errors","0");
        ini_set("error_log", "../../php_error_log.txt");

	$new_nome = $_POST["newName"];
	
	if(!empty($new_nome) && $conn->query("UPDATE settings SET nomeQuiz='" . $new_nome . "'")){
	    Logger::writeToLog("../../log.json","log-mod-impostazioni-utenti","E' stato modificato il nome del quiz in: ".$new_nome);
	    exit;
	    
	    
	}else{
	    Logger::writeToLog("../../log.json","log-errori","Impossibile modificare il nome del quiz: ".$conn->error);
	    die("Errore durante la modifica del nome quiz: " . $conn->error);
	}
?>