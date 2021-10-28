<?php
    // importazione phpmailer
    require '../../../phpmailer/PHPMailerAutoload.php';
    require '../../../phpmailer/credential.php';
    
    // funzione per inviare le mail contenenti le credenziali per gli studenti
    function inviaEmail($username, $email_destinataria, $password,$template){
    $mail = new PHPMailer;
		
	#$mail->SMTPDebug = 4; //Controllo status invio mail
	
	$mail->isSMTP();   
	$mail->Host = 'smtp.gmail.com';    //Definizione smtp server
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = EMAIL;                 // SMTP username
	$mail->Password = PASS;                           // SMTP password
	$mail->Priority = "1";
	$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption
	$mail->Port = 465;                                    // TCP port
	
	$mail->ContentType = 'text/html';
	$mail->setFrom(EMAIL);
	$mail->addAddress($email_destinataria);
	$mail->addCustomHeader("Importance: High");
	$mail->ConfirmReadingTo = "olimpmailer@gmail.com";
	$mail->addCustomHeader('Content-type', "text/html; method=REQUEST; charset=UTF-8");
	$mail->isHTML(true);                  // Set email format to HTML
	
	$mail->Subject = 'Olimpiadi Raffaellesche 30 aprile 2020 riepilogo';
	
	$appoggio = "";
	$appoggio2 = "";
	//$tmp = explode("@username", $template);
	//$mail->Body = $tmp[0];
		
	if($tmp = explode("@username", $template)){
		$max_l = count($tmp);
		$last = $tmp[$max_l];
		$appoggio = $tmp[0];
		for($i = 1; $i < $max_l; $i++){
			$appoggio .= $username;
			$appoggio .= $tmp[$i];
		}
	}
		
	if($tmp = explode("@password", $appoggio)){
		$max_l = count($tmp);
		$last = $tmp[$max_l];
		$appoggio2 = $tmp[0];
		for($i = 1; $i < $max_l; $i++){
			$appoggio2 .= $password;
			$appoggio2 .= $tmp[$i];
		}
	}
		
	$mail->Body = $appoggio2;
	$mail->addCustomHeader("Message-ID: <7e9b8ad346803e733becc6a8ebdeb240@olimpiadi-raffaellesche.itisurbino.edu.it>");
	$mail->addCustomHeader("Date: ".$mail->RFCDate());
	
	return $mail->send();
    }
?>