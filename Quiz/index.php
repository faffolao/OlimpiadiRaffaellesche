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
		<script type="text/javascript" src="../js/scriptQuiz.js"></script>
	</head>
	<?php
		session_start();
		$session_name = "qruser";
		$user = json_decode($_SESSION[$session_name], true);
		if($user['tipoUtente'] == 1){
		    header("Location: /");
		}
		require ("../db_con.php");
                require '../logger.php';
                require_once '../accessTracker.php';
						
                // registrazione evento ingresso quiz nel log
                Logger::writeToLog("../log.json", "log-statoquiz", "L'utente " . $user["username"] . " sta svolgendo il quiz");
		
                // scrivo nell'access tracker che l'utente sta svolgendo il quiz
                $at = new accessTracker();
                $at->registraAccesso("../accessi.json", $user["id"], 3);
                
		/*$query = sprintf("SELECT * FROM caricato WHERE id_studente = %d", $user['id']);
        $result = $conn->query($query) or die("ERROR: " . mysqli_error($conn));
                    
        
        if($result->num_rows > 0){
            header("Location: ../");
        }*/
        
	?>
	<body onload="getNextQuestion();">
            <div class="backgroundImage">
        <!--<button id="submit">clicca</button>-->
		<!--<button onclick="getNextQuestion()">clicca</button>-->
		
		<!-- timer -->
		<span class="timerbox" id="timer">
			
		</span>
		
		<!-- scheda immagine e risposte -->
		<div>
			<div class="questionbox fadeInDown animated">

					<p><span id="id" class="badge badge-primary">01</span> • <span id="domanda"></span></p>
					
					<button onclick="send(1)" id="r1" class="btn btn-answer">d1</button>
					<button onclick="send(2)" id="r2" class="btn btn-answer">d2</button>
					<button onclick="send(3)" id="r3" class="btn btn-answer">d3</button>
					<button onclick="send(4)" id="r4" class="btn btn-answer">d4</button>
					<button type="hidden" id="r-1" style="visibility: hidden;"></button>
                                        
                                        <br><em>Puoi ingrandire l'immagine cliccandoci sopra.</em>
                                        <img draggable="false" id="question-image" src="../res/default_quiz_img.png" ><br>
				<!-- riga 1 dei pulsanti -->
				<!-- <div class="row">
					<div class="col-6">
						<button class="btn-answer"><span class="buttontext">Test1Test1Test1Test1Test1Test1Test1Test1Test1Test1</span></button>
					</div>
					<div class="col-6">
						<button class="btn-answer">Test1Test1Test1Test1Test1Test1Test1Test1Test1Test1</button>
					</div>
				</div>
				<!-- riga 2 dei pulsanti -->
				<!--  <div class="row">
					<div class="col-6">
						<button class="btn-answer">Test1Test1Test1Test1Test1Test1Test1Test1Test1Test1</button>
					</div>
					<div class="col-6">
						<button class="btn-answer">Test1Test1Test1Test1Test1Test1Test1Test1Test1Test1</button>
					</div>
				</div>	-->
			</div>
		</div>
		
		
		<!-- logo olimpiadi raffaellesche -->
		<div class="logobox">
			<img src="../res/logo_big.png" width="100">
                </div>


		<!-- <h1>Olimpiadi Raffaellesche</h1>
		<div class="container">       
			<img id="linkImg" >
			<div class="row">
			<div id="r1" class="col-sm-4 mx-auto d-block" style="background-color:lavender;">.col-sm-4</div>
			<div id="r2" class="col-sm-4 mx-auto d-block" style="background-color:lavenderblush;">.col-sm-8</div>
		  </div>
		  <div class="row">
			<div id="r3" class="col-sm-4 mx-auto d-block" style="background-color:lavenderblush;">.col-sm-4</div>
			<div id="r4" class="col-sm-4 mx-auto d-block" style="background-color:lavender;">.col-sm-8</div>
		  </div>
		</div>
		<div id="prova">
		</div> -->
		
		<!-- modale immagine -->
		<div id="image-modal" class="modal">
			<span class="close">&times;</span>
			<img class="modal-content" id="modal-image">
		</div>
		
            </div>
		
		<script>
			/*$(document).keydown(function(e){
				e.preventDefault();
			  });*/
			document.addEventListener('contextmenu', event => event.preventDefault());
			document.getElementById('question-image').ondragstart = function() { return false; };
		</script>
	</body>
</html>
