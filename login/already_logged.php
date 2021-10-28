<!DOCTYPE html>

<html>

<head>

	<meta charset="utf-8">

	<meta name="generator" content="AlterVista - Editor HTML"/>

	<title>Accesso già effettuato</title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<link rel="icon" href="../img/logo_black.png" />

<body>

	

		

		<?php

			session_start();

			$session_name = "qruser";

		

			if(!isset($_SESSION[$session_name])) {

				 header('Location:../');

			} else {

				$user = json_decode($_SESSION[$session_name], true);

				

				if($user['tipoUtente'] == 1){

					header("location: /");

				} else{

					header('Location:/');

				}

			}

                               

		?>

	

</body>

</html>

