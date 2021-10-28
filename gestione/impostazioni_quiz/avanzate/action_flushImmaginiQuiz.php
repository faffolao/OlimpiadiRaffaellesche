<?php
	session_start();
	require ("../../../db_con.php");
	require "../../../logger.php";
        
        // registrazione degli errori su file
        ini_set("display_errors","0");
        ini_set("error_log", "../../../php_error_log.txt");
	
	if($_POST["confirm"] == "yes"){
		shell_exec("rm -rf ../../../immagini_quiz/*.*");
		Logger::writeToLog("../../log.json","log-mod-impostazioni-utenti","La cartella delle immagini delle domande
                            è stata svuotata.");
	}
?>