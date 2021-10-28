<!--Page php per effetuare il Login-->

<?php

	session_start();// come sempre prima cosa, aprire la sessione 
	if(isset($_SESSION['logged']) && isset($_SESSION[$session_name]) && $_SESSION['logged'] == true) {
	    header('Location:./already_logged.php');
	}
	
	require("../db_con.php"); // Include il file di connessione al database
	require "../logger.php";
	require "../accessTracker.php";
        
        // registrazione degli errori su file
        ini_set("display_errors","0");
        ini_set("error_log", "../php_error_log.txt");

	$_SESSION['logged'] = FALSE;

	$_SESSION["username"]=$_REQUEST["username"]; // con questo associo il parametro username che mi è stato passato dal form alla variabile SESSION email

	$password = $_REQUEST["password"]; // con questo associo il parametro password che mi è stato passato dal form alla variabile SESSION password	

	$infezione = false;

	

	/*if ((preg_match('/\s+/', $_SESSION["email"])) || preg_match('/\s+/', $password) ) {

      $infezione = true;

  	}*/

	

	$_SESSION["username"] = $conn->real_escape_string($_SESSION["username"]);

	$password = $conn->real_escape_string($password);

	

	if(!$infezione){

		$result = $conn->query("SELECT * FROM utenti WHERE username='".$_SESSION["username"]."' AND password ='".$password."'");

		$row = $result->fetch_assoc();

		//$query = mysql_query("SELECT * FROM users WHERE email='".$_SESSION["email"]."' AND password ='".$password."'");  //per selezionare nel db l'utente e pw che abbiamo appena scritto nel log

		//or DIE('query non riuscita'.mysql_error());

		// Con il SELECT qua sopra selezione dalla tabella users l utente registrato (se lo è) con i parametri che mi ha passato il form di login, quindi

		// Quelli dentro la variabile POST. username e password.

		

		if($result->num_rows > 0){        //se c'è una persona con quel nome nel db allora loggati

			if($row['tipoUtente'] == 1){

				$_SESSION['errore_login'] = "";

				//echo "sono un amministratore";
				$_SESSION["email"] = $row["email"];
                $_SESSION["username"] = $row["username"];
				Logger::writeToLog("../log.json","log-login-logout","Rilevato tentativo di accesso dell'amministratore
                " . $row["username"] );

				header("location: ./verifica/");

			}else{

				$_SESSION['errore_login'] = "";

				//echo "sono uno studente";

				//$_SESSION['user'] = $user;

				$_SESSION['logged'] = TRUE;

				$session_value = json_encode($row);

				$_SESSION["qruser"] = $session_value;

				//ini_set('session.gc_maxlifetime', '1');

				//$cookie_value = json_encode($user);

				//setcookie('qruser',$cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

				//echo $_COOKIE['qruser'];
				Logger::writeToLog("../log.json","log-login-logout","Lo studente " . $row["email"] . " si è loggato.");
                $at = new accessTracker();
                $at->registraAccesso("../accessi.json", $row["id"], 1);
				header("location:../attesa/"); 
			}

		}else{

			$_SESSION['errore_login'] = "<p style='color:#ff3333'>Email o Password errati.</p><br>";

			header("location:.");

		}

	}else{
	    Logger::writeToLog("../log.json","log-errori","ATTENZIONE: rilevata una probabile infezione nel procedimento di login.");

		$_SESSION['errore_login'] = "<p style='color:#ff3333'>Email o Password errati.</p><br>";

		header("location:.");

	}

?>