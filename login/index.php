<!--Pagina di login con form-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
	session_start();
    echo $_SESSION['logged'];
	$session_name = "qruser";
	if(isset($_SESSION['logged']) && isset($_SESSION[$session_name]) && $_SESSION['logged'] == true) {
	    header('Location:./already_logged.php');
    }
?>


<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Accedi alle Olimpiadi Raffaellesche</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="icon" href="../img/logo_black.png" />
	
	<!-- inizio importazione bootstrap e jquery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<!-- fine importazione bootstrap e jquery-->
	
	<!-- inizio importazione stili e script personali -->
	<link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet" />
	<link rel="stylesheet" href="style.css" />
	<script src="../js/loginbtnsecure.js"></script>
	<!-- fine importazione stili e script personali -->
</head>

<body>
	<div class="container-fluid">
		<div class="loginform">
			<img src="../img/logo.png" width="60" />
			<hr width="50%" />
			<form method="post" action="./action_login.php">
			 <input class="textbox" type="text" name="username" placeholder="Nome utente" required autofocus="on"/><br />
			 <input class="textbox" type="password" name="password" placeholder="Password" required /><br />
             <?php
				 session_start();
				 echo $_SESSION['errore_login'];
				 $_SESSION['errore_login'] = "";
			 ?>
			 <button class="btn btn-dark" type="submit">Login</button>
			</form>
		</div>
		<div class="returnhome">
			<a href="../"><button class="btn" type="button" style="width:auto"><i class="fa fa-chevron-circle-left"></i> Torna alla home</button></a>
		</div>
		
	</div>
</body>
</html>
