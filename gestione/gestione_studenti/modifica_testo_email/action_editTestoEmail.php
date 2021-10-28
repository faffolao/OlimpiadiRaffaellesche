<?php
	session_start();
	include("../../../db_con.php");
	include "../../../logger.php";

	$new_regolamento = $conn->real_escape_string($_POST['new_regolamento']);




        // registrazione degli errori su file
        ini_set("display_errors","0");
        ini_set("error_log", "../../../php_error_log.txt");
	
	if(!empty($new_regolamento) && $conn->query("UPDATE settings SET settings.testo_email='" . $new_regolamento . "'")){
	    Logger::writeToLog("../../log.json","log-mod-impostazioni-utenti","Regolamento modificato.");
	    exit;
	}else{
	    Logger::writeToLog("../../log.json","log-errori","Impossibile modificare il regolamento: " . $conn->error);
	    die("errore di modifica regolamento: ".$conn->error);
	}
?>