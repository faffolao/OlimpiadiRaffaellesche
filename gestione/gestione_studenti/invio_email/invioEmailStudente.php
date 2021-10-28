<?php
    require_once "emailSender.php";
    require "./../../../db_con.php";
    set_time_limit ( 0 );
	$sql = "SELECT settings.testo_email FROM settings;";
	$result = $conn -> query($sql);
	if ($result->num_rows > 0){
		$testo = $result->fetch_assoc()['testo_email'];
		
	}
    if(isset($_REQUEST["email1"]) && !empty($_REQUEST["email1"])){
		$username = $conn->real_escape_string($_REQUEST["username"]);
		$password = $conn->real_escape_string($_REQUEST["password"]);
		
		$password = hex2bin($password);
		$username = hex2bin($username);
		//die($password);
        if(inviaEmail($username, $_REQUEST["email1"], $password,$testo) && inviaEmail($username, $_REQUEST["email2"], $password,$testo)){
            // mail inviate correttamente, registro l'evento nel database
            $castedTesto = $conn->real_escape_string($testo);
            
            $sql = sprintf("INSERT INTO email_logs (data_ora, email1, email2, testo_email)"
                        . "VALUES (NOW(), '%s', '%s', '%s')", $_REQUEST["email1"],
                    $_REQUEST["email2"], $castedTesto);
            
            $sql2 = sprintf("INSERT INTO conferme_email (data_ora, email) VALUES "
                    . "(NOW(), '%s')", $_REQUEST["email1"]);
            
            $sql3 = sprintf("INSERT INTO conferme_email (data_ora, email) VALUES "
                    . "(NOW(), '%s')", $_REQUEST["email2"]);
            
            if (!$conn->query($sql)) {echo "Errore 1a query: " . $conn->error;}
            if (!$conn->query($sql2)) {echo "Errore 2a query: " . $conn->error;}
            if (!$conn->query($sql3)) {echo "Errore 3a query: " . $conn->error;}
            
            // email inviata correttamente
            http_response_code(200);
        }else{
            // errore invio email
            http_response_code(500);
        }
    }else{
        http_response_code(403);
    }
?>