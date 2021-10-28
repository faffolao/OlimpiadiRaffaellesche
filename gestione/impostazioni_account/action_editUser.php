<?php
	session_start();
	include("../../db_con.php");
	include '../../logger.php';
        
        // registrazione degli errori su file
        ini_set("display_errors","0");
        ini_set("error_log", "../../php_error_log.txt");

	$new_username = $_POST['new_username'];
	$new_password = $_POST['new_password'];
	$new_email = $_POST['new_email'];
	$old_email = $_POST['old_email'];
        //ottenimento id
        $id_result = $conn->query("SELECT `id` FROM `utenti` WHERE `email`='" . $old_email . "'");
	$row = $id_result->fetch_assoc();

	if(!empty($new_username) && !empty($new_password) && !empty($new_email) && !empty($row["id"])){
	    if($conn->query("UPDATE `utenti` SET `username`='" . $new_username. "',`password`='" . $new_password . "',`email`='" . $new_email . "',`tipoUtente`=1 WHERE id='" . $row["id"] . "'")){
	        Logger::writeToLog("../../log.json","log-mod-impostazioni-utenti","L'amministratore " . $id . " è stato modificato.");
	        header("location: .");
	    }else{
	        Logger::writeToLog("../../log.json","log-errori","Impossibile modificare l'amministratore " . $id . ": ".$id_result->error);
	        die("Errore di modifica amministratore: " . $id_result->error);
	    }
	}else{
	    
	    die("nessun parametro");
	}
?>