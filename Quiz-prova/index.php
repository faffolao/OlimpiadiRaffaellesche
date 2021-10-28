<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Olimpiadi Raffaellesche | Quiz</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" href="../img/logo_black.png">
		<link rel="stylesheet" href="./css/Animate.css">
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
		<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

		<LINK href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="main.css">
		<script src="imageModal.js"></script>
	</head>
	<?php
		session_start();
		$session_name = "qruser";
		$user = json_decode($_SESSION[$session_name], true);
		if($user['tipoUtente'] == 1){
		    header("Location: /");
		}
		require ("../db_con.php");
		
	?>
	<body>
            <div class="backgroundImage">

		<!-- timer -->
		<span class="timerbox" id="timer"></span>
		
		<!-- scheda immagine e risposte -->
		<div>
			<div class="questionbox fadeInDown animated">

			<p><span id="id" class="badge badge-primary"><?php echo $_SESSION['id']; ?></span> • <span id="domanda"><?php echo $_SESSION['domanda']; ?></span></p>
			
			<button onclick="send(1)" id="r1" class="btn btn-answer"><?php echo $_SESSION['r1']; ?></button>
			<button onclick="send(2)" id="r2" class="btn btn-answer"><?php echo $_SESSION['r2']; ?></button>
			<button onclick="send(3)" id="r3" class="btn btn-answer"><?php echo $_SESSION['r3']; ?></button>
			<button onclick="send(4)" id="r4" class="btn btn-answer"><?php echo $_SESSION['r4']; ?></button>
			<button id="r-1" style="visibility:hidden"></button>
                        
                        <br><em>Puoi ingrandire l'immagine cliccandoci sopra.</em>
                        <img draggable="false" id="question-image" src="../immagini_quiz/<?php echo $_SESSION['link']; ?>" ><br>
			</div>
		</div>
		
		
		<!-- logo olimpiadi raffaellesche -->
		<div class="logobox">
			<img src="../res/logo_big.png" width="100">
                </div>


		
		
		<!-- modale immagine -->
		<div id="image-modal" class="modal">
			<span class="close">&times;</span>
			<img class="modal-content" draggable="false" id="modal-image">
		</div>
		
            </div>
		
		<script>
			document.addEventListener('contextmenu', event => event.preventDefault());
			document.getElementById('question-image').ondragstart = function() { return false; };
		</script>
				<script type="text/javascript" src="js/script.js"></script>

	</body>
</html>
