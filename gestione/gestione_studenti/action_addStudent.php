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
	

	if(!empty($username) && !empty($password) && !empty($email) && !empty($email2) && !empty($cod_meccanografico) &&
                !empty($docente)){
		
		$sql= sprintf("INSERT INTO utenti (username, password, email, email_secondaria, tipoUtente, cod_scuola, docente) "
                            . "VALUES ('%s', '%s', '%s', '%s', 0, '%s', '%s')", $username, $password, $email, $email2, $cod_meccanografico, $docente);
		if($conn->query($sql)){

            

            Logger::writeToLog("../../log.json", "log-mod-impostazioni-utenti","E' stato aggiunto lo studente " . $username . " della scuola " . $cod_meccanografico);

            

            header("Location: .");

            

	    }else{

	        Logger::writeToLog("../../log.json","log-errori","Impossibile aggiungere lo studente " . $username . ": " . $conn->error);

	        die("Errore durante l'inserimento dello studente: " . $conn->error);

	    }

	}

?>