<!--gestione studenti-->
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Gestione studenti</title>
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
	<script src="tableSelection.js"></script>
	<script src="gestione.js"></script>
	<script src="../../js/tableSearch.js"></script>
	<script src="../../js/loginbtnsecure.js"></script>
	<!-- fine importazione stili e script personali-->
		
	<!-- inizio importazione fa per icone -->
	<script src="https://kit.fontawesome.com/bea6002302.js"></script>
	<!-- importazione fa per icone -->
        
        <!-- importazione pnotify -->
	<script src="https://unpkg.com/pnotify@4.0.0/dist/umd/PNotify.js"></script>	
	<link href="https://unpkg.com/pnotify@4.0.0/dist/PNotifyBrightTheme.css" rel="stylesheet">
	<script src="https://unpkg.com/pnotify@4.0.0/lib/umd/PNotifyMobile.js"></script>
	<!-- fine importazione pnotify -->
	
	<style>
        .password-field{
            background-color: transparent;
            border: none;
            color: black;
            width: 90%;
        }
	</style>
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
				<a href="../gestione_studenti/" title="Gestione studenti"><i class="fas fa-graduation-cap"></i></a>
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
						<a class="dropdown-item" href="../../Logout">Logout</a>
					</div>
				</div>
			</div>
			<!-- fine barra superiore-->
			
			<h1>Gestione studenti</h1><br>
			<p>In questa pagina è possibile gestire tutti gli studenti iscritti alle Olimpiadi Raffaellesche. Per gestire le scuole a cui fanno parte, vedere <a href="../gestione_scuole/">gestione scuole</a>.</p>
                        <!-- inizio sezione ricerca -->
			<input class="form-control" type="text" id="search-box" onKeyUp="ricercaNomi()" placeholder="Ricerca ID studente...">
			
			<div style="margin-top: 15px;">
				<span>Cerca: </span>
                                <div class="form-check-inline">
					<label>
						<input type="radio" name="search-radio" value="search-id" checked> <span class="label-text">ID</span>
					</label>
				</div>
				<div class="form-check-inline">
					<label>
						<input type="radio" name="search-radio" value="search-username"> <span class="label-text">Username</span>
					</label>
				</div>
				<div class="form-check-inline">
					<label>
						<input type="radio" name="search-radio" value="search-email"> <span class="label-text">Email</span>
					</label>
				</div>
				<div class="form-check-inline">
					<label>
						<input type="radio" name="search-radio" value="search-codmeccanografico"> <span class="label-text">Cod. meccanografico scuola</span>
					</label>
				</div>
                                <div class="form-check-inline">
					<label>
						<input type="radio" name="search-radio" value="search-docente"> <span class="label-text">Docente</span>
					</label>
				</div>
			</div><br>
			
			<!-- fine sezione ricerca -->
			
			<button id="addUserBtn" class="btn btn-card"><i class="fas fa-plus"></i>&nbsp;&nbsp;Aggiungi nuovo</button>
			<button id="editBtn" class="btn btn-card" disabled><i class="fas fa-pencil-alt"></i>&nbsp;&nbsp;Modifica</button>
			<button id="deleteBtn" class="btn btn-card" disabled><i class="fas fa-trash"></i>&nbsp;&nbsp;Rimuovi</button>
                        
                        <!-- pulsanti invio credenziali accesso -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-card dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope-open-text"></i>&nbsp;&nbsp;Invia credenziali di accesso
                            </button>
                            <div class="dropdown-menu">
                                <a id="inviaCredenzialiTutti" class="dropdown-item"
                                   href="javascript:void(0)" onclick="inviaEmailATutti()">A tutti gli studenti</a>
                                <a id="inviaCredenzialiSelezionato" class="dropdown-item disabled" href="javascript:void(0)"
                                   onclick="inviaEmailAStudente()">
                                    Allo studente selezionato
                                </a>
								<a id="modificaTestoEmail" class="dropdown-item" href="./modifica_testo_email">Modifica il testo delle email</a>
                            </div>
                        </div>
                        
                        <button id="importStudent" class="btn btn-card"><i class="fas fa-file-import"></i>&nbsp;&nbsp;Importa da file</button>
			
                        <!-- tabella studenti -->
			<div class="table-responsive">
				<table class="table table-hover table-sm" id="tabella">
					<thead>
						<tr>
                                                        <th>ID</th>
							<th>Username</th>
							<th>Password</th>
							<th>Email</th>
							<th>Email Secondaria</th>
							<th>Cod. meccanografico scuola</th>
							<th>Docente</th>
						</tr>
					</thead>
					<tbody>
						<?php
							session_start();
							include("../../db_con.php");
							include "../utility/ottieniScuola.php";
							
							$result = $conn->query("SELECT * FROM `utenti` WHERE tipoUtente = 0 ORDER BY `id` ASC");
						
							if($result->num_rows > 0){
								while($row = $result->fetch_assoc()):
						?>
						<tr id="<?php echo $row["id"]; ?>">
                                                        <td class="td-id"><?php echo $row["id"]; ?></td>
							<td class="td-username"><?php echo $row["username"]; ?></td>
							<td class="td-password">
								<input style="width: 80%" type="password" class="password-field" readonly value="<?php echo $row["password"]; ?>" id="password<?php echo $row["id"]; ?>">
								<a href="javascript:void(0)" onclick="visualizzaPassword('password<?php echo $row["id"]; ?>')"><img id="password<?php echo $row["id"]; ?>-img" width="30" src="./img/view.svg"></a>
							</td>
							<td class="td-email-1"><?php echo $row["email"]; ?></td>
							<td class="td-email-2"><?php echo $row["email_secondaria"]; ?></td>
							<td class="td-codScuola"><?php echo $row["cod_scuola"]; ?></td>
							<td class="td-docente"><?php echo $row["docente"]; ?></td>
							
						</tr>
						<?php endwhile;
							}
					    ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	
	<!-- inizio modale aggiungi studente -->
	<div id="addStudentModal" class="modal">
		<div class="modal-content">
			<h4>Aggiungi studente</h4>
			<form method="post" action="action_addStudent.php" class="form-group">
				Username: <input id="username" class="form-control" type="text" name="username" required>
				Password (<a href="javascript:void(0)" onClick="generaPassword()">clicca qui</a> per generarne una automatica): <input id="password" class="form-control" type="password" name="password" required>
				E-mail: <input id="email" class="form-control" type="email" name="email" required>
				E-mail secondaria: <input id="email2" class="form-control" type="email" name="email2" required>
				<hr>
				Scuola:
                                <select id="cod_meccanografico" class="form-control" name="cod_meccanografico">
                                    <?php
                                        $result_school_list = $conn->query("SELECT * FROM scuole");
                                        if($result_school_list > 0):
                                            while($school_row = $result_school_list -> fetch_assoc()):
                                    ?>
                                    <option value="<?php echo $school_row["cod_meccanografico"]; ?>">
                                        <?php echo "(" . $school_row["cod_meccanografico"] . ") " . 
                                                $school_row["nome"] . " - " . $school_row["nomeComune"]; ?>
                                    </option>
                                    <?php 
                                    endwhile;
                                    endif;
                                    ?>
                                </select>
				Docente: <input id="docente" class="form-control" type="text" name="docente" required>
				
				<button type="submit" id="addUserBtn" class="btn btn-card">Aggiungi studente</button>
				<button type="button" id="closeAddModalBtn" class="btn btn-card">Annulla</button>
			</form>
		</div>
	</div>
	<!-- fine modale aggiungi studente -->
	
	<!-- inizio modale modifica studente -->
	<div id="editStudentModal" class="modal">
		<div class="modal-content">
			<h4>Modifica studente</h4>
			<form method="POST" action="action_editStudent.php" class="form-group">
				Username: <input id="old-username" class="form-control" type="text" name="username" required>
				Password (<a href="javascript:void(0)" onClick="generaPasswordModificata()">clicca qui</a> per generarne una automatica): <input id="old-password" class="form-control" type="password" name="password" required>
				E-mail: <input id="old-email" class="form-control" type="email" name="email" required>
				E-mail secondaria: <input id="old-email2" class="form-control" type="email" name="email2" required>
				<hr>
				Scuola:
                                <select id="old-cod_meccanografico" class="form-control" name="cod_meccanografico">
                                    <?php
                                        $result_school_list_2 = $conn->query("SELECT * FROM scuole");
                                        if($result_school_list_2 > 0):
                                            while($school_row_2 = $result_school_list_2 -> fetch_assoc()):
                                    ?>
                                    <option value="<?php echo $school_row_2["cod_meccanografico"]; ?>">
                                        <?php echo "(" . $school_row_2["cod_meccanografico"] . ") " . 
                                                $school_row_2["nome"] . " - " . $school_row_2["nomeComune"]; ?>
                                    </option>
                                    <?php 
                                    endwhile;
                                    endif;
                                    ?>
                                </select>
				Docente:<input id="old-docente" class="form-control" type="text" name="docente" required>
				<br>
				
				<input type="hidden" id="old-id" name="id">
				<button type="submit" id="editUserBtn" class="btn btn-card">Modifica studente</button>
				<button type="button" id="closeEditModalBtn" class="btn btn-card">Annulla</button>
			</form>
		</div>
	</div>
	<!-- fine modale modifica studente -->
        
        <!-- inizio modale importazione studenti -->
        <div id="importStudentModal" class="modal">
            <div class="modal-content">
                <h4>Importa studenti da CSV</h4>
                <form enctype="multipart/form-data" action="action_importStudent.php" method="POST" class="form-group">
                    E' possibile importare gli studenti a partire da un file CSV. Per l'importazione nel file CSV i
                    campi relativi allo studente devono essere disposti nell'ordine seguente:
                    <ul>
                        <li>Username</li>
                        <li>Email principale</li>
                        <li>Email secondaria</li>
                        <li>Codice meccanografico della scuola a cui appartiene</li>
                        <li>Docente referente</li>
                    </ul>
                    La password per accedere verrà generata automaticamente.
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