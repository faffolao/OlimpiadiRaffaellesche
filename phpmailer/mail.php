<?php     
	require 'PHPMailerAutoload.php';
	require 'credential.php';
    
	$mail = new PHPMailer;
	
	#$mail->SMTPDebug = 4; //Controllo status invio mail
	
	$mail->isSMTP();   
	$mail->Host = 'smtp.gmail.com';    //Definizione smtp server
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = EMAIL;                 // SMTP username
	$mail->Password = PASS;                           // SMTP password
	$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption
	$mail->Port = 465;                                    // TCP port
	
	$mail->setFrom($_POST['email']);
	$mail->addAddress("qraffaellesco@gmail.com");
	$mail->addReplyTo($_POST['email']);

	$mail->isHTML(true);                  // Set email format to HTML
	
	$mail->Subject = 'Richiesta di contatto da: '.$_POST['name']. " < ".$_POST['email']." > ";
	$mail->Body = 
	'
	   <h2>Richiesta di contatto per Olimpiadi Raffaellesche</h2>
       <p>RIcevuta richiesta di contatto per le Olimpiadi Raffaellesche da --> ' . $_POST['name']. '</p>
       <ul style="list-style-type:none">
            <li>Nome: '. $_POST['name'] .'</li>
            <li>Email: '. $_POST['email'] .'</li>
            <li>Categoria: '. $_POST['category'] .'</li>
            <li>Messaggio: '. $_POST['message'] .'</li>
       </ul>
    ';
	
	if(!$mail->send())
	   die("Error");
	else
	   header("Location: successo/");	
?>