<!-- pagina per la gestione delle domande -->
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Gestione domande</title>
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
	<SCRIPT src="../openMenu.js"></SCRIPT>
	<script src="../../js/tableSearch.js"></script>
	<script src="scripts.js"></script>
	<script src="../../js/loginbtnsecure.js"></script>
        <script src="tableSelection.js"></script>
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
				
			<!-- inizio contenuto -->
			<h1>Gestione domande</h1><br>
			
			<!-- inizio sezione ricerca -->
			<input class="form-control" type="text" id="search-box" onKeyUp="ricercaNomi()" placeholder="Ricerca per ID domanda...">
			<br>
				
			<button type="button" class="btn btn-card" id="addQuestionBtn"><i class="fas fa-plus"></i>&nbsp;&nbsp;Aggiungi</button>
			<button type="button" class="btn btn-card" id='editBtn' disabled><i class="fas fa-pencil-alt"></i>&nbsp;&nbsp;Modifica domanda</button>
			<button type="button" class="btn btn-card" id='deleteBtn'><i class="fas fa-trash"></i>&nbsp;&nbsp;Elimina TUTTE</button>
			<button id="importQuestions" class="btn btn-card"><i class="fas fa-file-import"></i>&nbsp;&nbsp;Importa da file</button>

			<!-- inizio tabella -->
			<div class="table-responsive">
				<table class="table table-hover table-sm" id="tabella">
					<thead>
						<th>ID domanda</th>
                                                <th>Domanda</th>
						<th>Risposta 1</th>
						<th>Risposta 2</th>
						<th>Risposta 3</th>
						<th>Risposta 4</th>
						<th>Risposta esatta</th>
						<th>Immagine</th>
					</thead>
					<tbody>
						<?php
							session_start();
							include("../../db_con.php");
						
							$result = mysqli_query($conn, "SELECT * FROM `domande` ORDER BY `id` ASC");
						
							if(mysqli_num_rows($result) > 0){
								while($row = mysqli_fetch_assoc($result)){
									echo "<tr id='" . $row['id'] . "'><td class='nDomanda'>" . $row["id"] . "</td>
                                            <td class='domanda'>" . $row["domanda"] . "</td><td class='risp1'>" . $row['risp1'] . "</td><td class='risp2'>" . $row['risp2'] . "</td>
                                            <td class='risp3'>" . $row['risp3'] . "</td><td class='risp4'>" . $row['risp4'] . "</td>
                                            <td class='rispCorretta'>" . $row['r_esatta'] . "</td>
                                            <td><a id='img-" . $row['id'] . "' class='viev-img' href='javascript:void(0)'><img class='image-domanda' src='../../immagini_quiz/" . $row['linkImmagine'] . "' width='60'></a></td></tr>";
								}
							}else{
								echo 'Nessuna domanda aggiunta.';
							}
						?>
					</tbody>
				</table>
			</div>
			<!-- fine tabella -->
		</div>
	</div>
    
    <!--inizio modal per inserimento parametri domanda-->
    
   	<div id="addQuestionModal" class="modal">
		<div class="modal-content" style="margin: 4% auto;">
			<h4>Aggiungi una domanda</h4>
			<form method="POST" action="action_addQuestion.php" enctype="multipart/form-data" class="form-group">
				Immagine: <input type="file" name="chooseFile" id="chooseFile" class="upload_file" required>
                                Domanda: <input type="text" class="form-control" name="domanda" id="domanda" required>
				Risposta 1: <input type="text" class="form-control" name="r1" id="r1" required>
				Risposta 2: <input type="text" class="form-control" name="r2" id="r2" required>
				Risposta 3: <input type="text" class="form-control" name="r3" id="r3" required>
				Risposta 4: <input type="text" class="form-control" name="r4" id="r4" required>
				Risposta esatta: 
				<select class="form-control" name="resatta" id="resatta" required>
					<option disabled>numero risposta esatta (1-4)</option>
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
				</select><br>
				
				<button type="submit" name="submit" class="btn btn-card">Aggiungi</button>
				<button type="button" class="btn btn-card" onClick="closeModal('addQuestionModal')">Annulla</button>
			</form>
		</div>
	</div>
    <!--fine modal per inserimento parametri domanda-->
    
	<!-- inizio modale immagine -->
	<div id="modalImage" class="modal">
		<span class="close">&times;</span>
		<img class="modal-content" id="internalImg">
	</div>
	<!-- fine modale immagine -->
    
    
    <!-- inizio modale modifica Domanda -->
	<div id="editQuestionModal" class="modal">
		<div class="modal-content" style="margin: 4% auto;">
			<h4>Modifica domanda</h4>
			<form class="form-group" method="post" action="action_editQuestion.php" enctype="multipart/form-data">
				Immagine: <br><img id="old-image" width="100%">
				Cambia immagine: <input type="file" name="chooseFile" class="upload_file" id="chooseFile2">

                                Domanda: <input type="text" class="form-control" name="domanda" id="old_domanda" required>
				Risposta 1: <input type="text" class="form-control" name="r1" id="old_r1" required>
				Risposta 2: <input type="text" class="form-control" name="r2" id="old_r2" required>
				Risposta 3: <input type="text" class="form-control" name="r3" id="old_r3" required>
				Risposta 4: <input type="text" class="form-control" name="r4" id="old_r4" required>
				Risposta esatta: 
				<select class="form-control" name="resatta" id="old_resatta" required>
					<option disabled>numero risposta esatta (1-4)</option>
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
				</select><br>
				
				<input type="hidden" name="question_id" id="question_id">
				<input type="hidden" name="old_img_src" id="old_img_src">
				
				<button type="submit" name="submit" class="btn btn-card">Modifica</button>
				<button type="button" class="btn btn-card" onClick="closeModal('editQuestionModal')">Annulla</button>
			</form>
		</div>
	</div>
	<!-- fine modale modifica domanda -->
        
        <!-- inizio modale importazione domande -->
        <div id="importQuestionsModal" class="modal">
            <div class="modal-content" style="margin: 5% auto;">
                <h4>Importa domande da CSV</h4>
                <form enctype="multipart/form-data" action="action_importQuestions.php" method="POST" class="form-group">
                    Per importare le domande sono necessari:
                    <ul>
                        <li>Un file ZIP contenente tutte le immagini del quiz</li>
                        <li>Un file CSV contenente:</li>
                        <ul>
                            <li>Testo della domanda</li>
                            <li>Testo della risposta 1</li>
                            <li>Testo della risposta 2</li>
                            <li>Testo della risposta 3</li>
                            <li>Testo della risposta 4</li>
                            <li>N. risposta esatta</li>
                            <li>Nome del file immagine associato alla domanda (che deve essere contenuto nel file ZIP delle
                            immagini)</li>
                        </ul>
                    </ul>
                    
                    Archivio ZIP delle immagini delle domande<br>
                    <input type="file" class="" name="zipfile" id="zipfile"><br>
                    File CSV delle domande:<br>
                    <input type="file" class="" name="csvfile" id="csvfile">
                    
                    <br><br>
                    <button type="submit" id="uploadCSVFileBtn" class="btn btn-card">Importa</button>
                    <button type="button" id="closeImportModalBtn" class="btn btn-card">Annulla</button>
                </form>
            </div>
        </div>
        <!-- fine modale importazione studenti -->

</body>
</html>