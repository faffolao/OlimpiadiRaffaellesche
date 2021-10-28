<?php require "invio_email.php"; ?>
<!--pagina di verifica a due fattori-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Area riservata</title>
	<meta charset="utf-8" />
	<META name="viewport" content="width=device-width, initial-scale=1.0" />
	<LINK rel="icon" href="../../img/logo_black.png">
	
	<!-- inizio importazione bootstrap e jquery -->
	<SCRIPT src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></SCRIPT>
	<SCRIPT src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" INTEGRITY="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" CROSSORIGIN="anonymous"></SCRIPT>
	<LINK rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" INTEGRITY="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" CROSSORIGIN="anonymous">
	<SCRIPT src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" INTEGRITY="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" CROSSORIGIN="anonymous"></SCRIPT>
	<!-- fine importazione bootstrap e jquery-->
	
	<!-- inizio importazione stili e script personali -->
	<LINK href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="style.css">
	<script src="../../js/loginbtnsecure.js"></script>
	<!-- fine importazione stili e script personali -->
</head>

<body>
	<div class="middle">
		<img src="../../img/logo.png" width="60">
		<h1>Avviso</h1>
		<p><strong>Stai tentando di accedere a un'area riservata esclusivamente agli amministratori di Olimpiadi Raffaellesche.</strong><br>Se sei un amministratore inserisci nel campo sottostante il codice di sicurezza che hai ricevuto.</p>
		
		<form autocomplete="off" id="form" method="post" action="./action_verifica.php">
			<p>Codice di verifica:</p>
			<input type="text" class="w-100 form-control" id="codice" placeholder="Enter code" name="codice" /><br>
			<button id="submitbtn" type="submit" class="btn btn-warning">Convalida</button>
		</form>
	</div>
</body>
</html>
