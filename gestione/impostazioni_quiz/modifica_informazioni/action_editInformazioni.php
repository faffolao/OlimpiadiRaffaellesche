<?php
	session_start();
	include("../../../db_con.php");
	include "../../../logger.php";

	$new_informazioni = $conn->real_escape_string($_POST['new_informazioni']);




        // registrazione degli errori su file
        ini_set("display_errors","0");
        ini_set("error_log", "../../../php_error_log.txt");
	
	if(!empty($new_informazioni) && $conn->query("UPDATE settings SET informazioni='" . $new_informazioni . "'")){
	    Logger::writeToLog("../../log.json","log-mod-impostazioni-utenti","IKnformazioni modificate.");
	    exit;
	}else{
	    Logger::writeToLog("../../log.json","log-errori","Impossibile modificare le informazioni: " . $conn->error);
	    die("errore di modifica regolamento: ".$conn->error);
	}
?>