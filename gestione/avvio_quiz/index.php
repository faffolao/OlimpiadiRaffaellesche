<!doctype html>
<html>

	<?php 
	   session_start();
	   require "../../db_con.php";
	   
	   // ottenimento delle date
	   $result = $conn->query("SELECT `dataApertura`, `oraInizio`, `oraFine` FROM `settings` WHERE 1");
	   $row = $result->fetch_assoc();
	   
	   $dataApertura = $row["dataApertura"];
	   $oraInizio = $row["oraInizio"];
	   $oraFine = $row["oraFine"];
	   
	   $img = "no.svg";
	   $state = "CHIUSO";
	   
	   if(date('Ymd') == date('Ymd', strtotime($dataApertura))){
	       if(date('Hi') > date('Hi', strtotime($dataApertura))){
	           $img = "yes.svg";
	           $state = "APERTO";
	       }
	       
	       if(date('Hi') >= date('Hi', strtotime($oraInizio)) && date('Hi') <= date('Hi', strtotime($oraFine))){
	           $img = "yes.svg";
	           $state = "AVVIATO";
	       }
	       
	       if(date('Hi') >= date('Hi', strtotime($oraFine))){
	           $img = "no.svg";
	           $state = "CHIUSO";
	       }
	   }
	?>
	
	<head>
		<META CHARSET="utf-8">
    	<TITLE>Avvio quiz</TITLE>
    	<META name="viewport" content="width=device-width, initial-scale=1.0" />
    	<LINK rel="icon" href="../../img/logo_black.png">
    	
    	<!-- inizio importazione bootstrap e jquery -->
    	<SCRIPT src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></SCRIPT>
    	<SCRIPT src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" INTEGRITY="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" CROSSORIGIN="anonymous"></SCRIPT>
    	<LINK rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" INTEGRITY="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" CROSSORIGIN="anonymous">
    	<SCRIPT src="../../js/popper.min.js"></SCRIPT>
    	<SCRIPT src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" INTEGRITY="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" CROSSORIGIN="anonymous"></SCRIPT>
    	<!-- fine importazione bootstrap e jquery-->
    	
    	<!-- inizio importazione stili e script personali -->
    	<LINK href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">
    	<LINK rel="stylesheet" href="../style.css">
    	<SCRIPT src="../openMenu.js"></SCRIPT>
    	<script src="quizmanage.js"></script>
    	<!-- fine importazione stili e script personali-->
    		
    	<!-- inizio importazione fa per icone -->
    	<SCRIPT src="https://kit.fontawesome.com/bea6002302.js"></SCRIPT>
    	<!-- importazione fa per icone -->
    	
    	<!-- importazione pnotify -->
        <script src="https://unpkg.com/pnotify@4.0.0/dist/umd/PNotify.js"></script>	
        <link href="https://unpkg.com/pnotify@4.0.0/dist/PNotifyBrightTheme.css" rel="stylesheet">
        <script src="https://unpkg.com/pnotify@4.0.0/lib/umd/PNotifyMobile.js"></script>
        <!-- fine importazione pnotify -->
    	
    	<script>
    		//inizializzazione tooltip
    		$(document).ready(function(){
				$('[data-toggle="tooltip"]').tooltip();   
            });
    	</script>
	</head>
	<body>
		<div class="container-fluid">
			<!-- inizio sidebar -->
    		<DIV class="sidenav">
    			<DIV id="open-menu-btn">
    				<A href="javascript:void(0)" onClick="visualizzaMenu()"><I class="fas fa-bars"></I></A>
    			</DIV>
    			<DIV id="hidden-btn">
    				<A href="../" title="Dashboard" class="active"><I class="fas fa-home"></I></A>
    				<A href="../controllo_accessi/" title="Controllo accessi"><I class="fas fa-sign-in-alt"></I></A>
    				<A href="../avanzamento_quiz/" title="Controllo avanzamento quiz"><I class="fas fa-tasks"></I></A>
    				<A href="../statistiche_quiz/" title="Statistiche quiz"><I class="fas fa-chart-line"></I></A>
    				<A href="../log/" title="Log generale"><I class="fas fa-receipt"></I></A>
    				<HR>
    				<a href="../gestione_scuole/" title="Gestione scuole"><i class="fas fa-school"></i></a>
    				<A href="../gestione_studenti/" title="Gestione studenti"><I class="fas fa-graduation-cap"></I></A>
    				<A href="../gestione_domande/" title="Gestione domande"><I class="fas fa-list"></I></A>
    				<A href="../impostazioni_quiz/" title="Impostazioni quiz"><I class="fas fa-sliders-h"></I></A>
    				<HR>
    				<A href="../avvio_quiz/" title="Avvio quiz"><I class="fas fa-play"></I></A>
    			</DIV>
    		</DIV>
    		<!-- fine sidebar -->
    		
    		<!--  contenuto pagina -->
    		<div class="main">
    			<!-- inizio barra superiore -->
    			<DIV class="topbar">
    				<DIV class="dropdown">
    					<BUTTON type="button" class="btn dropdown-toggle" DATA-TOGGLE="dropdown"><IMG src="../img/user_avatar.png" width="40">&nbsp;&nbsp;
                        	<?php 
    							session_start();
    							$session_name = "qruser";
    							if(!isset($_SESSION['logged']) && !isset($_SESSION[$session_name]) && $_SESSION['logged'] == true){
    								 header('Location:../');
    							} else {
    								$user = json_decode($_SESSION[$session_name], true);
                                    if($user['tipoUtente'] == 1){
    									echo $user['username'];
                                    } else{
                                    	header('Location:../');
                                    }
                                   
    							}
    				       ?>
                        
                        </BUTTON>
    					<DIV class="dropdown-menu">
    						<A class="dropdown-item" href="../impostazioni_account">Impostazioni account</A>
    						<A class="dropdown-item" href="../../Logout/">Logout</A>
    					</DIV>
    				</DIV>
    			</DIV>
    			<!-- fine barra superiore-->
    			
    			<!-- avvio quiz -->
    			<h1>Avvio del quiz</h1>
    			<p>Il quiz si avvierà automaticamente alle ore stabilite nelle <a href="../impostazioni_quiz/">impostazioni del quiz</a>, in
    			caso di necessità è possibile avviare e/o interrompere immediatamente il quiz tramite questa pagina.</p>
    			
    			<p>Stato del quiz: <img src="img/<?php echo $img; ?>" width="40" id="quizStateImg"> <strong id="quizState"><?php echo $state; ?></strong></p><br><br>
    			
    			<button id="openquizbtn" class="btn btn-warning" data-toggle="tooltip" title="Apre immediatamente il quiz e lo rende disponibile">Apri quiz</button>
    			<button id="startquizbtn" class="btn btn-success" data-toggle="tooltip" title="Apre e avvia immediatamente il quiz, tutti gli utenti in attesa inizieranno il quiz.">Inizia quiz</button>
    			<button id="endquizbtn" class="btn btn-danger" data-toggle="tooltip" title="Termina e chiude immediatamente il quiz, tutte le domande non completate verranno considerate nulle e quindi errate">Termina e chiudi quiz</button>
    		</div>
		</div>
	</body>
</html>