<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Impostazioni avanzate di Quizzone</title>
	<META name="viewport" content="width=device-width, initial-scale=1.0" />
	<LINK rel="icon" href="../../../img/logo_black.png">
	
	<!-- inizio importazione bootstrap e jquery -->
	<SCRIPT src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></SCRIPT>
	<SCRIPT src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" INTEGRITY="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" CROSSORIGIN="anonymous"></SCRIPT>
	<LINK rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" INTEGRITY="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" CROSSORIGIN="anonymous">
	<SCRIPT src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" INTEGRITY="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" CROSSORIGIN="anonymous"></SCRIPT>
	<!-- fine importazione bootstrap e jquery-->
	
	<!-- inizio importazione stili e script personali -->
	<LINK href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">
	<LINK rel="stylesheet" href="../../style.css">
	<SCRIPT src="../../openMenu.js"></SCRIPT>
	<script src="manage.js"></script>
	<!-- fine importazione stili e script personali-->
		
	<!-- inizio importazione fa per icone e tinymce-->
	<SCRIPT src="https://kit.fontawesome.com/bea6002302.js"></SCRIPT>
	<!-- importazione fa per icone -->
	
	<!-- importazione pnotify -->
	<script src="https://unpkg.com/pnotify@4.0.0/dist/umd/PNotify.js"></script>	
	<link href="https://unpkg.com/pnotify@4.0.0/dist/PNotifyBrightTheme.css" rel="stylesheet">
	<script src="https://unpkg.com/pnotify@4.0.0/lib/umd/PNotifyMobile.js"></script>
	<!-- fine importazione pnotify -->
	
</head>
	
<body>
	<div class="container-fluid">
		<!-- inizio sidebar -->
		<DIV class="sidenav">
			<DIV id="open-menu-btn">
				<A href="javascript:void(0)" onClick="visualizzaMenu()"><I class="fas fa-bars"></I></A>
			</DIV>
			<DIV id="hidden-btn">
				<A href="../../" title="Dashboard" class="active"><I class="fas fa-home"></I></A>
				<A href="../../controllo_accessi/" title="Controllo accessi"><I class="fas fa-sign-in-alt"></I></A>
				<A href="../../avanzamento_quiz/" title="Controllo avanzamento quiz"><I class="fas fa-tasks"></I></A>
				<A href="../../statistiche_quiz/" title="Statistiche quiz"><I class="fas fa-chart-line"></I></A>
				<A href="../../log/" title="Log generale"><I class="fas fa-receipt"></I></A>
				<HR>
				<a href="../../gestione_scuole/" title="Gestione scuole"><i class="fas fa-school"></i></a>
				<A href="../../gestione_studenti/" title="Gestione studenti"><I class="fas fa-graduation-cap"></I></A>
				<A href="../../gestione_domande/" title="Gestione domande"><I class="fas fa-list"></I></A>
				<A href="../../impostazioni_quiz/" title="Impostazioni quiz"><I class="fas fa-sliders-h"></I></A>
				<HR>
				<A href="../../avvio_quiz/" title="Avvio quiz"><I class="fas fa-play"></I></A>
			</DIV>
		</DIV>
		<!-- fine sidebar -->
		
		<div class="main">
			<!-- inizio barra superiore -->
			<DIV class="topbar">
				<DIV class="dropdown">
					<BUTTON type="button" class="btn dropdown-toggle" DATA-TOGGLE="dropdown"><IMG src="../../img/user_avatar.png" width="40">&nbsp;&nbsp;
                    	<?php 
							session_start();
							$session_name = "qruser";
							if(!isset($_SESSION['logged']) && !isset($_SESSION[$session_name]) && $_SESSION['logged'] == true){
								 header('Location:../../../');
							} else {
								$user = json_decode($_SESSION[$session_name], true);
                                if($user['tipoUtente'] == 1){
									echo $user['username'];
                                } else{
                                	header('Location:../../../');
                                }
                               
							}
					?>
                    
                    </BUTTON>
					<DIV class="dropdown-menu">
						<A class="dropdown-item" href="../../impostazioni_account/">Impostazioni account</A>
						<A class="dropdown-item" href="../../../Logout/">Logout</A>
					</DIV>
				</DIV>
			</DIV>
			<!-- fine barra superiore-->
			
			<!--  impostazioni avanzate di Olimpiadi Raffaellesche  -->
			<h1>Impostazioni avanzate</h1>
			<p>In questa pagina è possibile regolare alcune impostazioni di carattere tecnico di Olimpiadi Raffaellesche. É consigliato l'accesso a questa pagina ai soli utenti esperti.</p>
			<br>
			<h5>Gestione ID incrementali (AUTO_INCREMENT ID)</h5>
			<p>Le tabelle degli utenti (amministratori e studenti), delle domande e delle scuole si basano su identificatori (ID) autoincrementali, ovvero che aumentano di una unità indipendentemente dall'aggiunta o dalla rimozione di un elemento dalle tabelle.</p>
			
			<div class="table-responsive">
				<table class="table" id="tabella">
					<thead>
						<tr>
							<td>Tabella</td>
							<td>Valore AUTO_INCREMENT</td>
							<td>Operazioni</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Domande</td>
							<td>
								<?php 
								    session_start();
								    require("../../../db_con.php");
								    
								    $result=$conn->query("SELECT `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES 
                                                        WHERE TABLE_SCHEMA = 'olimpiadiraffaellesche' AND TABLE_NAME = 'domande'");
								    $row = $result->fetch_assoc();
								    echo $row["AUTO_INCREMENT"];
								?>
							</td>
							<td>
    							<div class="form-inline">
    								<input type="number" value="1" name="new_auto_increment" id="AI_domande" min="1" class="form-control">
    								<button onclick="updateAI('domande');" id="update_AI_domande" class="btn btn-card">Imposta</button>
    							</div>
							</td>
						</tr>
						
						<tr>
							<td>Scuole</td>
							<td>
								<?php 
								    $result=$conn->query("SELECT `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES 
                                                        WHERE TABLE_SCHEMA = 'olimpiadiraffaellesche' AND TABLE_NAME = 'scuole'");
								    $row = $result->fetch_assoc();
								    echo $row["AUTO_INCREMENT"];
								?>
							</td>
							<td>
    							<div class="form-inline">
    								<input type="number" value="1" name="new_auto_increment" id="AI_scuole" min="1" class="form-control">
    								<button onclick="updateAI('scuole');" id="update_AI_scuole" class="btn btn-card">Imposta</button>
    							</div>
							</td>
						</tr>
						
						<tr>
							<td>Utenti</td>
							<td>
								<?php 
								    $result=$conn->query("SELECT `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES 
                                                        WHERE TABLE_SCHEMA = 'olimpiadiraffaellesche' AND TABLE_NAME = 'utenti'");
								    $row = $result->fetch_assoc();
								    echo $row["AUTO_INCREMENT"];
								?>
							</td>
							<td>
    							<div class="form-inline">
    								<input type="number" value="1" name="new_auto_increment" id="AI_utenti" min="1" class="form-control">
    								<button onclick="updateAI('utenti');" id="update_AI_utenti" class="btn btn-card">Imposta</button>
    							</div>
							</td>
						</tr>
					</tbody>
				</table>
				<br>
				<h5>Immagini quiz</h5>
				<p>In questa sezione è possibile gestire tutte le immagini associate alle domande memorizzate in Olimpiadi Raffaellesche.</p>
				<pre><?php echo str_replace("\n","<br>",shell_exec("ls -goh ../../../immagini_quiz")); ?></pre>
				<button class="btn btn-danger" id="svuotaImmaginiQuiz">Svuota cartella Immagini quiz</button>
				<br><br>
				<h5>Aggiorna tabella appoggio domande</h5>
				<p>In questa sezione e' possibile aggiornare la tabella domande appoggio. Utilizzare quando si aggiorna l'orario di inizio Quiz.</p>
				<pre>* Rapprasentazione tabella appoggio *</pre>
				<form method="post" role="form" action="action_aggiorna.php">
					<button class="btn btn-warning" name="aggiorna">Aggiorna Tabella Appoggio-Domande</button>
				</form>
				<br><br><br>
			</div>
		</div>
	</div>
</body>
</html>