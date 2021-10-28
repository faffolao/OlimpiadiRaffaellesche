<!--pagina per effettuare il logout-->

<?php 
    require "../logger.php";
    require "../accessTracker.php";
    
    // registrazione degli errori su file
    ini_set("display_errors","1");
    ini_set("error_log", "../php_error_log.txt");
    
	session_start();// come sempre prima cosa, aprire la sessione 
	

	// verifico se il cookie esiste

	$name = 'qruser';

	$session_name = "qruser";

	$user = json_decode($_SESSION[$session_name], true);
	$email = $user["email"];
	
	if($user["tipoUtente"] == 0){
	    $id = $user["id"];
	    $at = new accessTracker();
	    $at->registraAccesso("../accessi.json",$id, 0);
	}
	
	   
	//echo 'logged : ' . $_SESSION["logged"];

	//echo "<br>";

	//echo 'user : ' . $_SESSION[$name]['email'];

	//echo "<br>";

	

if(isset($_SESSION['logged']) && isset($_SESSION[$session_name])) {

	//unsetto il cookie con le informazioni utente

  	//setcookie($name, '', time()-3600, '/');

	//unset($_COOKIE[$name]);

	$_SESSION[$name] = null;

	$_SESSION["logged"] = false;

	unset($_SESSION["logged"]);

	unset($_SESSION[$name]);

    session_destroy();

	//echo 'logged : ' . $_SESSION["logged"];

	//echo "<br>";

	//echo 'user : ' . $_SESSION[$name]['email'];

	//header("location:/index.php");

	echo "<br>";

	echo "<br>";

	echo "<br>";

	echo "<br>";
	Logger::writeToLog("../log.json","log-login-logout","Utente " . $email . " disconnesso.");
	

}else{
	
	header("location:../index.php");
	
}





?>





<!DOCTYPE html>

<html>

	<head>
		<title>Logout</title>
    	<meta charset="UTF-8">
  		<meta name="viewport" content="width=device-width, initial-scale=1">
	
		<link rel="stylesheet" href="style.css">
		<link href="https://fonts.googleapis.com/css?family=Gayathri&display=swap" rel="stylesheet"> 
		<link rel="icon" href="../img/logo_black.png">
  		<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
		
  		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>-->
		
	</head>

	<body>
		
		<script>
			setTimeout(function(){
			window.location.href = '..';
			}, 6000);
		</script>
		
		<div class="sp-container">
			<div class="sp-content">
				<div class="sp-globe"></div>
				<h2 class="frame-1">Logout effettuato con successo</h2>
				<h2 class="frame-2">Verrai reindirizzato alla Home Page</h2>
		  	</div>
		</div>
	
	</body>

</html>

