<?php
    // ottengo lo username
    session_start();
    $session_name = "qruser";
    $user = json_decode($_SESSION[$session_name], true);
    
    // registrazione evento fine quiz nel log
    require_once '../../logger.php';
    Logger::writeToLog("../../log.json", "log-statoquiz", "L'utente " . $user["username"] . " ha terminato il quiz");  
    
    // registrazione evento nell'access tracker che ho finito il quiz
    require_once '../../accessTracker.php';
    $at = new accessTracker();
    $at->registraAccesso("../../accessi.json", $user["id"], 4);
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it">

	<head>
		<title>Fine Quiz</title>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<meta name="generator" content="Geany 1.33" />
                <link rel="icon" href="../../img/logo_black.png">
		<link rel="stylesheet" href="stile.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	</head>

	<body>
		
		<script>
			setTimeout(function(){
				
				window.location.href = '/Logout';
				
			}, 5000);
		</script>
		
		<div class="container">
			
				<span>I</span><span>l</span><span>&nbsp;</span>
				<span>Q</span><span>u</span><span>i</span><span>z</span><span>&nbsp;</span>
				<span>è</span><span>&nbsp;</span>
				<span>f</span><span>i</span><span>n</span><span>i</span><span>t</span><span>o</span>
			
		</div>
		
		<script>
			var elem = document.documentElement;
			function closeFullscreen() {
				if (document.exitFullscreen) {
					document.exitFullscreen();
				} else if (document.mozCancelFullScreen) {
					document.mozCancelFullScreen();
				} else if (document.webkitExitFullscreen) {
					document.webkitExitFullscreen();
				} else if (document.msExitFullscreen) {
					document.msExitFullscreen();
				}
			}
		</script>
	</body>

</html>
