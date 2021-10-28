<?php

	session_start();

	include("../../db_con.php");

	include "../../logger.php";
        
        // registrazione degli errori su file
        ini_set("display_errors","0");
        ini_set("error_log", "../../php_error_log.txt");



	$username = $_POST['username'];

	$password = $_POST['password'];

	$email = $_POST['email'];

	

	if(!empty($username) && !empty($password) && !empty($email)){
            $sql= "INSERT INTO `utenti` (`username`, `password`, `email`, `tipoUtente`) "
                . "VALUES ('" . $username . "','" . $password . "','" . $email . "',1)";
	    if($conn->query($sql)){

            Logger::writeToLog("../../log.json","log-mod-impostazioni-utenti","E' stato registrato un nuovo amministratore: " . 

                $username . " (" . $email . ")");

            header("location: .");

	    }else{

	        Logger::writeToLog("../../log.json","log-errori","Errore durante l'inserimento di un amministratore: " . $conn->error);

	        die("Errore durante inserimento amministratore: " . $conn->error);

	    }

	}else{

	    die("Nessun parametro passato");

	}

?>