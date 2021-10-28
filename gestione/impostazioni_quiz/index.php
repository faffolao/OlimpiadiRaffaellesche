<!doctype html>
<html>
	
<?php
    #Per evitare la modifica dei campi si utilizza $iscrioni per la gestione di info quiz della sala d'attesa
    
    session_start();
	include("../../db_con.php");
	
	$result = $conn->query("SELECT betaAperta, informazioniAttive as info, informazioni, iscrizioniAperte, regolamento, nomeQuiz, DATE_FORMAT(`dataApertura`,'%d/%m/%Y %H:%i'),
                           DATE_FORMAT(`oraInizio`,'%H:%i'), DATE_FORMAT(`oraFine`,'%H:%i') FROM `settings`");
	$row = $result->fetch_assoc();

	$nome_quiz = $row["nomeQuiz"];
	$regolamento = $row["regolamento"];
	$informazioni = $row["informazioni"];
	$data_apertura = $row["DATE_FORMAT(`dataApertura`,'%d/%m/%Y %H:%i')"];
	$orario_inizio = $row["DATE_FORMAT(`oraInizio`,'%H:%i')"];
	$orario_fine = $row["DATE_FORMAT(`oraFine`,'%H:%i')"];
	$iscrizioniAperte = $row["iscrizioniAperte"]; 
	$betaAperta = $row["betaAperta"];
	$informazioniAttive = $row['info'];
	#Per evitare la modifica dei campi si utilizza $iscrioni per la gestione di info quiz della sala d'attesa
?>	
	
<head>
	<meta charset="utf-8">
	<title>Impostazioni quiz</title>
	<META name="viewport" content="width=device-width, initial-scale=1.0" />
	<LINK rel="icon" href="../../img/logo_black.png">
	
	<!-- inizio importazione bootstrap e jquery -->
	<SCRIPT src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></SCRIPT>
	<SCRIPT src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" INTEGRITY="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" CROSSORIGIN="anonymous"></SCRIPT>
	<LINK rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" INTEGRITY="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" CROSSORIGIN="anonymous">
	<SCRIPT src="../js/popper.min.js"></SCRIPT>
	<SCRIPT src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" INTEGRITY="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" CROSSORIGIN="anonymous"></SCRIPT>
	<!-- fine importazione bootstrap e jquery-->
	
	<!-- inizio importazione stili e script personali -->
	<LINK href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">
	<LINK rel="stylesheet" href="../style.css">
	<script src="moment.js"></script>
	<script src="settings.js"></script>
	<SCRIPT src="../openMenu.js"></SCRIPT>
	
	<!-- fine importazione stili e script personali-->
		
	<!-- inizio importazione fa per icone e tinymce-->
	<SCRIPT src="https://kit.fontawesome.com/bea6002302.js"></SCRIPT>
	<!-- importazione fa per icone -->
	
	<!-- importazione pnotify -->
	<script src="https://unpkg.com/pnotify@4.0.0/dist/umd/PNotify.js"></script>	
	<link href="https://unpkg.com/pnotify@4.0.0/dist/PNotifyBrightTheme.css" rel="stylesheet">
	<script src="https://unpkg.com/pnotify@4.0.0/lib/umd/PNotifyMobile.js"></script>
	<!-- fine importazione pnotify -->
	
	<!-- importazione jquery datetimepicker -->
	<link rel="stylesheet" href="jquery.datetimepicker.css">
	<script src="jquery.datetimepicker.full.js"></script>
	<!-- fine importazione jquery datetimepicker -->
		
	<!-- inizializzazione datetimepicker, tooltip  -->
	<script>
		$(document).ready(function(){
			$('[data-toggle="tooltip"]').tooltip();   
			
			
			
			$("#data_apertura").datetimepicker({
				format:'d/m/Y H:i',
				defaultDate: '<?php echo $data_apertura ?>',
				allowBlank: false
			});
			
			$("#orario_inizio").datetimepicker({
				format: 'H:i',
				defaultTime: '<?php echo $orario_inizio ?>',
				datepicker: false,
				allowBlank: false
			});
			
			$("#orario_fine").datetimepicker({
				format: 'H:i',
				defaultTime: '<?php echo $orario_fine ?>',
				datepicker: false,
				allowBlank: false
			});
		});
	</script>
		
	<style>
		.xdsoft_label{color: black;}	
	</style>
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
				
		<div class="main">
			<!-- inizio barra superiore -->
			<DIV class="topbar">
				<DIV class="dropdown">
					<BUTTON type="button" class="btn dropdown-toggle" DATA-TOGGLE="dropdown"><IMG src="../img/user_avatar.png" width="40">&nbsp;&nbsp;
                    	<?php 
							session_start();
							$session_name = "qruser";
							if(!isset($_SESSION['logged']) && !isset($_SESSION[$session_name]) && $_SESSION['logged'] == true){
								 header('Location:/');
							} else {
								$user = json_decode($_SESSION[$session_name], true);
                                if($user['tipoUtente'] == 1){
									echo $user['username'];
                                } else{
                                	header('Location:/');
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
			
			
				
			<!-- impostazioni -->
			<h1>Impostazioni quiz</h1>
			<p>É possibile regolare le impostazioni del quiz e le sue proprietà in questa pagina.<br>Per impostazioni avanzate di carattere tecnico (per il funzionamento di Olimpiadi Raffaellesche) è possibile utilizzare <a href="avanzate/">questa pagina</a>.</p>
				
			<h5>Nome del quiz</h5>
			<p>Il nome del quiz apparirà nella home page degli studenti partecipanti e nella pagina di iscrizione.</p>
			<div class="form-inline">
				<input type="text" class="form-control w-50" name="quiz_name" id="quiz_name" value="<?php echo $nome_quiz ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<button type="button" disabled class="btn btn-card" id="edit_nome" style="margin-bottom: 2px">Salva</button>
			</div>
				
			<br>
			<h5>Date del quiz</h5>
			<p>In questa parte è possibile impostare la funzione beta del sito (Apertura del sito in ogni momento) e tutte le date del quiz (data di apertura, ora di inizio e di fine). Per una regolazione dell'orario più fine è possibile modificarlo manualmente tramite la tastiera digitandolo secondo la sintassi HH:MM (H = ore, M = minuti).</p>
			<div class="row">
				<div class="col-1">
					<label class="switch">
						<input id="beta_aperta" type="checkbox" <?php if($betaAperta == 1) { echo 'checked="checked"'; } ?>>
						<span class="slider round"></span>
					</label>
				</div>
				<div class="col-11">
					<p id="beta_lbl" style="margin-top: 6px">Beta Sito <?php if($betaAperta == 1) {echo 'Abilitata';} else {echo 'Disattivata';} ?>&nbsp;&nbsp;&nbsp;<a href="#" data-toggle="tooltip" title="Indica la possibilita' di aprire o meno il sito indipendentemente dal giorno e dall'orario."><i class="fas fa-question-circle"></i></a></p>	
				</div>
			</div>
			<form>
				<div class="form-group row">
					<label for="data_apertura" class="col-sm-2 col-form-label">Data di apertura&nbsp;&nbsp;&nbsp;<a href="#" data-toggle="tooltip" title="Indica il giorno e l'ora in cui il quiz sarà visibile agli studenti e per l'iscrizione."><i class="fas fa-question-circle"></i></a></label>	
					<div class="col-sm-7">
						<input class="form-control" type="text" id="data_apertura" value="<?php echo $data_apertura ?>">
					</div>
				</div>
				<div class="form-group row">
					<label for="orario_inizio" class="col-sm-2 col-form-label">
						Orario inizio&nbsp;&nbsp;&nbsp;<a href="#" data-toggle="tooltip" title="Indica l'ora in cui il quiz inizierà. Il quiz inizia e termina allo stesso giorno della sua apertura."><i class="fas fa-question-circle"></i></a>
					</label>
					<div class="col-sm-7">
						<input class="form-control" type="text" id="orario_inizio" value="<?php echo $orario_inizio ?>">
					</div>
				</div>
				<div class="form-group row">
					<label for="orario_fine" class="col-sm-2 col-form-label">
						Orario fine&nbsp;&nbsp;&nbsp;<a href="#" data-toggle="tooltip" title="Indica l'orario di chiusura del quiz. Il quiz inizia e termina allo stesso giorno della sua apertura."><i class="fas fa-question-circle"></i></a>
					</label>
					<div class="col-sm-7">
						<input class="form-control" type="text" id="orario_fine" value="<?php echo $orario_fine ?>">
					</div>
				</div>
				<button type="button" disabled class="btn btn-card" id="edit_orario">Salva</button>
			</form>
			<br>
			
			<div class="row">
				<div class="col-sm-6">
					<h5 style="margin: 12px 0px">Regolamento</h5>
				</div>
				<div class="col-sm-6 text-right">
					<button id="btn_apri_regolamento" class="btn btn-card"><i class="fas fa-book-open"></i>&nbsp;&nbsp;Visualizza</button>
					<button id="btn_modifica_regolamento" class="btn btn-card"><i class="fas fa-edit"></i>&nbsp;&nbsp;Modifica</button>
				</div>
			</div><br>
				
			<div class="row">
				<div class="col-sm-6">
					<h5 style="margin: 12px 0px">Informazioni Generali</h5>
				</div>
				<div class="col-sm-6 text-right">
					<button id="btn_apri_informazioni" class="btn btn-card"><i class="fas fa-book-open"></i>&nbsp;&nbsp;Visualizza</button>
					<button id="btn_modifica_informazioni" class="btn btn-card"><i class="fas fa-edit"></i>&nbsp;&nbsp;Modifica</button>
				</div>
			</div><br>
			
			<h5>Informazioni Generali</h5>
			<p>Qui e' possibile attivare/disattivare le informazioni fornite tramite il modale della index principale del sito.</p>
			<div class="row">
				<div class="col-1">
					<label class="switch">
						<input id="informazioni_attive" type="checkbox" <?php if($informazioniAttive == 1) { echo 'checked="checked"'; } ?>>
						<span class="slider round"></span>
					</label>
				</div>
				<div class="col-11">
					<p id="informazioni_lbl" style="margin-top: 6px">Informazioni Generali <?php if($informazioniAttive == 1) {echo 'Attivate';} else {echo 'Disattivate';} ?></p>	
				</div>
            </div><br>
				
			<h5>Info del Quiz</h5>
			<p>Qui e' possibile attivare/disattivare le info del quiz.</p>
			<div class="row">
				<div class="col-1">
					<label class="switch">
						<input id="iscrizioni_aperte" type="checkbox" <?php if($iscrizioniAperte == 1) { echo 'checked="checked"'; } ?>>
						<span class="slider round"></span>
					</label>
				</div>
				<div class="col-11">
					<p id="iscrizioni_lbl" style="margin-top: 6px">Info <?php if($iscrizioniAperte == 1) {echo 'Abilitate';} else {echo 'Disattivate';} ?></p>	
				</div>
            </div><br>
                        
                        <h5>Cancellazione risultati quiz</h5>
                        <p>Tramite questo pulsante è possibile cancellare il contenuto delle tabelle contenenti i risultati del 
                            quiz.</p>
                        <button id="svuotaRisultati" class="btn btn-card">Svuota risultati quiz</button>
		</div>
	</div>
				
	<!-- inizio modale visualizza regolamento -->
	<div id="show_regolamento_modal" class="modal">
		<div class="modal-content" style="margin-top: 6%; width: 68%;">
			<span class="close close-modal" onClick="closeModal('show_regolamento_modal');">&times;</span>
			<h2>Regolamento</h2>
			<?php echo $regolamento ?>
		</div>			
	</div>
	<div id="show_informazioni_modal" class="modal">
		<div class="modal-content" style="margin-top: 6%; width: 68%;">
			<span class="close close-modal" onClick="$('#show_informazioni_modal').hide();">&times;</span>
			<h2>Informazioni</h2>
			<?php echo $informazioni ?>
		</div>			
	</div>
	<!--  fine modale visualizza regolamento -->
</body>
</html>