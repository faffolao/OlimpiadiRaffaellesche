<?php
	session_start();
	include("../../db_con.php");
	include "../../logger.php";
        
        // registrazione degli errori su file
        ini_set("display_errors","0");
        ini_set("error_log", "../../php_error_log.txt");
	
	$username = $_POST["username"];
	$password = $_POST["password"];
	$email = $_POST["email"];
	$email2 = $_POST["email2"];
	$cod_meccanografico = $_POST["cod_meccanografico"];
	$docente = $_POST["docente"];
	$id = $_POST["id"];

	
	if(!empty($username) && !empty($password) && !empty($email) && !empty($email2) && !empty($cod_meccanografico) && 
            !empty($docente) && !empty($id)){
		$sql = sprintf("UPDATE utenti SET username = '%s', password = '%s', email = '%s', email_secondaria = '%s',"
                        . "cod_scuola = '%s', docente = '%s' "
                        . "WHERE id = %d", $username, $password, $email, $email2, $cod_meccanografico, $docente, $id);
	    if($conn->query($sql) or die("errore nella query: " . $conn->error)){
			
                Logger::writeToLog("../../log.json", "log-mod-impostazioni-utenti","E' stato modificato lo studente " .
                $id . " della scuola " . $cod_meccanografico);
            
	        header("location: .");
	    }else{
	        Logger::writeToLog("../../log.json", "log-errori","Impossibile modificare lo studente n. " . $id . ": ".$conn->error);
	        die("Errore durante la modifica dello studente: " . $conn->error);
	    }
	}
?>