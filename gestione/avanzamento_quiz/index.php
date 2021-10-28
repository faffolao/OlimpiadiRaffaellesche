<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Avanzamento del quiz</title>
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
	<link rel="stylesheet" href="../style.css">
	<script src="../openMenu.js"></script>
	<script src="../../js/tableSearch.js"></script>
	<script src="search.js"></script>
        <script src="svuotaTabellaQuiz.js"></script>
        <script src="check.js"></script>
	<!-- fine importazione stili e script personali-->
		
	<!-- inizio importazione fa per icone -->
	<script src="https://kit.fontawesome.com/bea6002302.js"></script>
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
		<div class="sidenav">
			<div id="open-menu-btn">
				<a href="javascript:void(0)" onClick="visualizzaMenu()"><i class="fas fa-bars"></i></a>
			</div>
			<div id="hidden-btn">
				<a href="../" title="Dashboard" class="active"><i class="fas fa-home"></i></a>
				<a href="../controllo_accessi/" title="Controllo accessi"><i class="fas fa-sign-in-alt"></i></a>
				<a href="../avanzamento_quiz/" title="Controllo avanzamento quiz"><i class="fas fa-tasks"></i></a>
				<a href="../statistiche_quiz/" title="Statistiche quiz"><i class="fas fa-chart-line"></i></a>
				<a href="../log/" title="Log generale"><i class="fas fa-receipt"></i></a>
				<hr>
				<a href="../gestione_scuole/" title="Gestione scuole"><i class="fas fa-school"></i></a>
				<a href="../gestione_studenti/" title="Gestione scuole"><i class="fas fa-graduation-cap"></i></a>
				<a href="../gestione_domande/" title="Gestione domande"><i class="fas fa-list"></i></a>
				<a href="../impostazioni_quiz/" title="Impostazioni quiz"><i class="fas fa-sliders-h"></i></a>
				<hr>
				<a href="../avvio_quiz/" title="Avvio quiz"><i class="fas fa-play"></i></a>
			</div>
		</div>
		<!-- fine sidebar -->
		
		<div class="main">
			<!-- inizio barra superiore -->
			<div class="topbar">
				<div class="dropdown">
					<button type="button" class="btn dropdown-toggle" data-toggle="dropdown"><img src="../img/user_avatar.png" width="40">&nbsp;&nbsp;
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
                    
                    </button>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="../impostazioni_account">Impostazioni account</a>
						<a class="dropdown-item" href="../../Logout/">Logout</a>
					</div>
				</div>
			</div>
			<!-- fine barra superiore-->
			
			<h1>Avanzamento del quiz</h1>
			<p>In questa pagina è possibile controllare in tempo reale a che punto sono gli studenti nel quiz e 
                            altre proprietà come il tempo rimasto. In caso di necessità in questa pagina è possibile annullare 
                            il quiz per uno studente. Per controllare gli studenti che hanno effettuato il log-in, vedere 
                            <a href="../controllo_accessi/">Controllo accessi</a>.<br><br>
                            Per cancellare il contenuto della tabella delle risposte del quiz: 
                            <a href="#" id="svuotaTabellaQuiz">cancellazione contenuto tabelle risposte quiz</a>.
                        </p>
			
			<!-- inizio sezione ricerca -->
			<input class="form-control" type="text" id="search-box" onKeyUp="ricercaNomi()" placeholder="Ricerca ID studente...">
			
			<div style="margin-top: 15px;">
				<span>Cerca: </span>
				<div class="form-check-inline">
					<label>
						<input type="radio" name="search-radio" value="search-id" checked> <span class="label-text">ID studente</span>
					</label>
				</div>
				<div class="form-check-inline">
					<label>
						<input type="radio" name="search-radio" value="search-name"> <span class="label-text">Nome studente</span>
					</label>
				</div>
				<div class="form-check-inline">
					<label>
						<input type="radio" name="search-radio" value="search-istituto"> <span class="label-text">Istituto</span>
					</label>
				</div>
			</div>
			
			<!-- fine sezione ricerca -->
			
			<!-- inizio tabella -->
			<?php 
			     require_once "../../db_con.php";
			     require_once '../utility/ottieniScuola.php';
			     
			     $query = sprintf("SELECT * FROM domande");
			     $result_domande = $conn->query($query);
			     
			     if($result_domande->num_rows > 0):
                                 while($row_domande = $result_domande->fetch_assoc()){
                                    $id_domande[] = $row_domande["id"];
                                 }
			?>
			<div class="table-responsive">
				<table class="table table-hover" id="tabella">
					<thead>
						<tr>
							<th>ID</th>
							<th>Studente</th>
							<th>Istituto</th>
							<?php
							 $nDomande = $result_domande->num_rows;
							 for($i = 0;$i < $nDomande; $i++): 
							?>
							<th>D. <?php echo $i + 1; ?></th>
							<?php endfor; ?>
						</tr>
					</thead>
					<tbody>
						<?php 
						  $query = sprintf("SELECT * FROM utenti WHERE tipoUtente = 0");
						  $result = $conn->query($query);

						  if ($result->num_rows > 0):
						      while($row = $result->fetch_assoc()):
						?>
						<tr>
							<td><?php echo $row["id"]; ?></td>
							<td><?php echo $row["username"]; ?></td>
							<td><?php echo $row['cod_scuola']; ?>
							<?php foreach($id_domande as $v): ?>
							<td id="s-<?php echo $row["id"]; ?>.d-<?php echo $v; ?>"><img src="../img/no.svg" width="30"></td>
							<?php endforeach; ?>
						</tr>
						<?php 
						      endwhile;
						  endif;
						?>
					</tbody>
				</table>
			</div>
			
			<?php else: ?>
			<p>Non è stata aggiunta alcuna domanda.</p>
			<?php endif;?>
			<!-- fine tabella -->
		</div>
	</div>
</body>
</html>