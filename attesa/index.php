<?php 
    require ("../db_con.php");
    require_once '../logger.php';
    
    $msg="Nessun quiz presente.";
    $query = "SELECT betaAperta AS beta from settings";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
     
   	require("verificaQuiz.php"); 
	
	if(!$_SESSION['aperto']){
	    $_SESSION['msgClass'] = "alert-danger";
		header('location:/');
	} else {
	    unset($_SESSION['msgClass']);   
	}
	
	session_start();
	
	$session_name = "qruser";
	$user = json_decode($_SESSION[$session_name], true);
	
	$query = sprintf("SELECT * from caricato WHERE id_studente = %d", $user['id']);
	$controllo = sprintf("SELECT * from risposte WHERE id_studente = %d", $user['id']);
	
	//SERVE COME CONTROLLO IN FASE DI BETA
	$analisi_quiz = $conn->query($query) or die("ERROR: " . mysqli_error($conn));
    $analisi_controllo = $conn->query($controllo) or die("ERROR: " . mysqli_error($conn));    
        // registrazione evento ingresso sala attesa nel log
        
        Logger::writeToLog("../log.json", "log-statoquiz", "L'utente " . $user["username"] . " è in attesa del quiz");
?>
<!DOCTYPE html>
<html lang="it">

<head>
	<meta charset="utf-8"/>
	<title>Olimpiadi Raffaellesche | In attesa del quiz</title>
	<link rel="icon" href="../img/logo_black.png">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="./styles/style.css">
	
	<!-- importazione bootstrap -->
	<SCRIPT src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></SCRIPT>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

	<!-- SCRIPT pagina attesa -->
<?php if($row['beta'] == 0): ?>
    	<script src="js/clock.js"></script>
    	<script src="js/triggerAbbandono.js"></script>
    	<script src="js/timer.js"></script>
<?php endif; ?>
<?php if($row['beta'] == 1): ?>
    	<script src="https://unpkg.com/pnotify@4.0.0/dist/umd/PNotify.js"></script>	
    	<link href="https://unpkg.com/pnotify@4.0.0/dist/PNotifyBrightTheme.css" rel="stylesheet">
    	<script src="https://unpkg.com/pnotify@4.0.0/lib/umd/PNotifyMobile.js"></script>
<?php endif; ?>
<?php if($row['beta'] == 1 && $analisi_quiz->num_rows == 0 && $analisi_controllo->num_rows == 0): ?>
    	<script src="js/countdownBeta.js"></script>
<?php endif; ?>

</head>

<body onLoad="openFullscreen();">
	<!-- pulsante torna alla home -->
	<div class="top-left">
		<button onclick="window.location='../'" class="btn-home"><img src="img/home.png" width="30">&nbsp;&nbsp;Home page</button>
	</div>
		
	<!-- contenitore bottone utente -->
	<div class="top-right">
		<BUTTON style="color: white" type="button" class="btn dropdown-toggle" DATA-TOGGLE="dropdown"><IMG src="../img/user_avatar.png" width="50" height="50">&nbsp;&nbsp;
        	<?php 
				session_start();
				$session_name = "qruser";
				$user = json_decode($_SESSION[$session_name], true);
				if($user['tipoUtente'] == ""){
					 header('Location:../');
				} else {
                    if($user['tipoUtente'] == 0){
						echo $user['username'];
						require_once '../accessTracker.php';
						$at = new accessTracker();
						$at->registraAccesso("../accessi.json", $user["id"], 2);
                    } else{
                    	header('Location:../');
                    }
				}
			?>
        </BUTTON>	
        <DIV class="dropdown-menu">
        	<A class="dropdown-item" href="../Logout/">Logout</A>
        </DIV>
	</div>
    
    <!-- div contenente info quiz e avvio -->
    <div class="center">
    	<h2 id="timer"><?php echo $msg; ?></h2>
    	<hr width="50%">
		<?php if($row['beta'] == 0): ?>
        	<h3 id="prova"></h3>
        	<h3 id="time">
    			<div class="spinner-grow text-light" role="status">
                  <span class="sr-only">Loading...</span>
                </div>
    		</h3>
    	<?php endif; ?>
		<?php if($row['beta'] == 1): ?>
        	<h3 id="time">
    			<div class="spinner-grow text-light" role="status">
                  <span class="sr-only">Loading...</span>
                </div>
    		</h3>
		<?php endif; ?>    
    </div>

     <div class="middle-bottom">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">    
                    <!-- contenitore pulsanti quiz -->
                    <div id="info">
                		<button onclick="$('#info-modal').show();" type="button" class="btn-quizinfo">Info del quiz</button></a>
                    </div>
                    <div id="resetQuiz">
                    	<?php if($row['beta'] == 1 && $analisi_quiz->num_rows != 0 || $analisi_controllo->num_rows != 0): ?>
                    		<button onclick="resetQuizBeta()" type="button" class="btn-avviasimulazione">Reset Tentativo Quiz</button></a>
                    	<?php endif; ?>    
                	</div>    
        	    </div>
            </div>
        </div>    
    </div>    

    <!-- modale info quiz -->
    <div id="quiz-modal" class="modal">
    	<div class="modal-contenuto">
    		<span onclick="$('#quiz-modal').hide();" class="close">&times;</span>
            <h2>Avviso Quiz -- Quiz Già Effettuato</h2>
            <h3>Hai già effettuato una prova del Quiz. Per effettuare un'altro tentativo resettare
            	le risposte assegnate al tentativo precedente premendo il pulsante [ RESET TENTATIVO QUIZ ]</h3>
    	</div>
    </div>
    
    <div id="info-modal" class="modal">
    	<div class="modal-contenuto">
    		<span id="modale-info" onclick="$('#info-modal').hide();" class="close">&times;</span>
            <h2>Regolamento</h2>
            <?php 
                require "../db_con.php";
                $result = $conn->query("SELECT regolamento FROM settings");
                $rules = $result->fetch_assoc();
                echo $rules["regolamento"];
            ?>
    	</div>
    </div>
    <?php 
        if($analisi_quiz->num_rows >= 1 && $row['beta'] == 1){
            echo "<script language='javascript'>$('#quiz-modal').show();</script>";
        }
    ?>

    <?php 
        if($row['beta'] == 1){
            echo "<script language='javascript'>$('#info-modal').show();</script>";
        }
    ?>
    <script>

		function controlloStatusInfo(){
    		$.ajax({
    			url:"verificaInfo.php",
    			dataType: "json",
    			success: function(risposta){
    				if(!(risposta.info)){
    					document.getElementById("info").style="visibility:hidden";
    				} else {
    					document.getElementById("info").style="visibility:visible";
    				}
    			},
    			error: function(jqXHR, exception){alert(jqXHR.responseText + "  - " + exception);}
    		});
		}
		controlloStatusInfo();
		setInterval(controlloStatusInfo, 1000);

		function resetQuizBeta(){
    		$.ajax({
    			url:"resetRisposteBeta.php",
    			dataType: "json",
    			success: function(risposta){
    				if(!(risposta.status)){
						PNotify.error({
							title: "Tentativo Quiz:",
							text: risposta.text,
							delay: 3000,
							module:{
								Mobile:{
									swipeDismiss:true,
									styling:true
								}
							}
						});
    				} else {
						PNotify.success({
							title: "Tentativo Quiz:",
							text: risposta.text,
							delay: 3000,
							module:{
								Mobile:{
									swipeDismiss:true,
									styling:true
								}
							}
						});
    				}
    			},
    			error: function(jqXHR, exception){alert(jqXHR.responseText + "  - " + exception);}
    		});
		}
		
		var elem = document.documentElement;
				function openFullscreen() {
				if (elem.requestFullscreen) {
					elem.requestFullscreen();
				} else if (elem.mozRequestFullScreen) { /* Firefox */
					elem.mozRequestFullScreen();
				} else if (elem.webkitRequestFullscreen) { /* Chrome, Safari & Opera */
					elem.webkitRequestFullscreen();
				} else if (elem.msRequestFullscreen) { /* IE/Edge */
					elem.msRequestFullscreen();
				}
			}
		
		$(document).keydown(function(e){
			e.preventDefault();
		  });
		
    </script>
</body>

</html>