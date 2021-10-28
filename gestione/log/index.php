<!DOCTYPE html>
<html lang="it">

<head>
	<meta charset="utf-8" />
	<title>Log generale</title>
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
	<script src="filter.js"></script>
	<script src="manageLog.js"></script>
	<!-- fine importazione stili e script personali-->
		
	<!-- inizio importazione fa per icone -->
	<SCRIPT src="https://kit.fontawesome.com/bea6002302.js"></SCRIPT>
	<!-- importazione fa per icone -->
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
				<A href="." title="Log generale"><I class="fas fa-receipt"></I></A>
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
		
		<div class="main">
			<!-- inizio barra superiore -->
			<DIV class="topbar">
				<DIV class="dropdown">
					<BUTTON type="button" class="btn dropdown-toggle" DATA-TOGGLE="dropdown"><IMG src="../img/user_avatar.png" width="40">&nbsp;&nbsp;
                    	<?php 
							session_start();
							$session_name = "qruser";
							if(!isset($_SESSION['logged']) && !isset($_SESSION[$session_name]) && $_SESSION['logged'] == true){
								 header('Location:../../');
							} else {
								$user = json_decode($_SESSION[$session_name], true);
                                if($user['tipoUtente'] == 1){
									echo $user['username'];
                                } else{
                                	header('Location:../../');
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
			
			<!-- log generale - inizio pagina -->
			<h1>Log generale</h1>
			<br><p>In questa pagina sono visualizzati tutti gli eventi relativi a Olimpiadi Raffaellesche e al suo funzionamento. 
			Sono registrati anche gli accessi e le disconnessioni da parte degli utenti e gli eventi del quiz 
			(apertura, avvio e chiusura del quiz).</p>
			<br>
			<div class="btn-group-toggle" data-toggle="buttons">
				Visualizza: 
  				<label class="btn btn-info active">
    				<input type="checkbox" checked autocomplete="off" id="log-mod-impostazioni-utenti"> Modifiche impostazioni 
  				</label>
  				<label class="btn btn-dark active">
    				<input type="checkbox" checked autocomplete="off" id="log-login-logout"> Accessi e disconnessioni
  				</label>
  				<label class="btn btn-warning active">
    				<input type="checkbox" checked autocomplete="off" id="log-statoquiz"> Apertura/avvio/chiusura quiz 
  				</label>
  				<label class="btn btn-danger active">
    				<input type="checkbox" checked autocomplete="off" id="log-errori"> Errori
  				</label>
			</div><br>
			<a href="javascript:void(0)" onclick="window.open('.', '_blank', 'location=yes,height=1024,width=520,scrollbars=yes,status=yes');"><i class="far fa-window-restore"></i> Visualizza in una finestra separata</a>
			&nbsp;&nbsp;∙&nbsp;&nbsp;<a href="javascript:void(0)" onclick="svuotaLog()"><i class="fas fa-eraser"></i> Svuota log</a><br><br>
			
			<div id="log-container">
			</div>
		</div>
	</div>
</body>

</html>