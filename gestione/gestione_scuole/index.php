<!doctype html>

<html>
<head>
	<meta charset="utf-8">
	<title>Gestione scuole</title>
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
	<script src="../../js/tableSearch.js"></script>
	<script src="../../js/loginbtnsecure.js"></script>
	<script src="gestione.js"></script>
	<script src="../../js/capWriting.js"></script>
	<!-- fine importazione stili e script personali-->
		
	<!-- inizio importazione fa per icone -->
	<script src="https://kit.fontawesome.com/bea6002302.js"></script>
	<!-- importazione fa per icone -->
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
			
			<h1>Gestione scuole</h1><br>
			<p>In questa pagina è possibile gestire tutte le scuole a cui gli studenti fanno parte. Per gestire gli studenti visita la pagina <a href="../gestione_studenti/">gestione studenti</a>.</p>
			
			<!-- inizio sezione ricerca -->
			<input class="form-control" type="text" id="search-box" onKeyUp="ricercaNomi()" placeholder="Ricerca codice meccanografico...">
			
			<div style="margin-top: 15px;">
				<span>Cerca: </span>
                                <div class="form-check-inline">
					<label>
						<input type="radio" name="search-radio" value="search-codmeccanografico" checked> <span class="label-text">Codice meccanografico</span>
					</label>
				</div>
				<div class="form-check-inline">
					<label>
						<input type="radio" name="search-radio" value="search-schoolname"> <span class="label-text">Nome scuola</span>
					</label>
				</div>
				<div class="form-check-inline">
					<label>
						<input type="radio" name="search-radio" value="search-comune"> <span class="label-text">Comune</span>
					</label>
				</div>
				<div class="form-check-inline">
					<label>
						<input type="radio" name="search-radio" value="search-provincia"> <span class="label-text">Provincia</span>
					</label>
				</div>
			</div><br>
			<!-- fine sezione ricerca -->
			
			<button id="addSchoolBtn" class="btn btn-card"><i class="fas fa-plus"></i>&nbsp;&nbsp;Aggiungi nuova</button>
			<button id="editBtn" class="btn btn-card" disabled><i class="fas fa-pencil-alt"></i>&nbsp;&nbsp;Modifica</button>
			<button id="deleteBtn" class="btn btn-card" disabled><i class="fas fa-trash"></i>&nbsp;&nbsp;Rimuovi</button>
                        <button id="importSchool" class="btn btn-card"><i class="fas fa-file-import"></i>&nbsp;&nbsp;Importa da file</button>
                        <br>
			
			<div class="table-responsive">
				<table class="table table-hover table-sm" id="tabella">
					<thead>
						<tr>
                                                        <th>Codice meccanografico</th>
							<th>Nome scuola</th>
							<th>Via</th>
							<th>Numero civico</th>
							<th>CAP</th>
							<th>Comune</th>
							<th>Provincia</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						  session_start();
						  require("../../db_con.php");
						  
						  $result = $conn->query("SELECT * FROM `scuole` ORDER BY cod_meccanografico ASC");
						  if($result->num_rows > 0){
						      while($row = $result->fetch_assoc()):
						?>
						<tr id="<?php echo $row["cod_meccanografico"]; ?>">
                                                        <td class="td-cod-meccanografico"><?php echo $row["cod_meccanografico"]; ?></td>
							<td class="td-nome-scuola"><?php echo $row["nome"]; ?></td>
							<td class="td-via"><?php echo $row["via"]; ?></td>
							<td class="td-nCivico"><?php echo $row["nCivico"]; ?></td>
							<td class="td-cap"><?php echo $row["cap"]; ?></td>
							<td class="td-nomeComune"><?php echo $row["nomeComune"]; ?></td>
							<td class="td-provincia"><?php echo $row["provincia"]; ?></td>
						</tr>
						<?php 
						  endwhile;
						  }
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	
	<!-- inizio modale aggiungi scuola -->
	<div id="addSchoolModal" class="modal">
		<div class="modal-content" style="margin: 5% auto;">
			<h4>Aggiungi scuola</h4>
			<form method="POST" action="action_addSchool.php" class="form-group">
                                Codice meccanografico: <input type="text" maxlength="10" name="cod_meccanografico" id="cod_meccanografico" class="form-control" required>
				Nome: <input type="text" name="nome" id="nome" class="form-control" required>
				Via: <input type="text" name="via" id="via" class="form-control" required>
				Numero civico: <input type="number" name="nCivico" id="nCivico" class="form-control" min="1" required>
				CAP: <input type="text" name="cap" id="cap" class="form-control" maxlength="5" required>
				Comune: <input type="text" name="nomeComune" id="nomeComune" class="form-control" required>
				Provincia: 
				<select name="provincia" id="provincia" class="form-control" required>
					<option selected="selected" disabled>Provincia</option>
					<option>Agrigento</option>
					<option>Alessandria</option>
					<option>Ancona</option>
					<option>Aosta</option>
					<option>Arezzo</option>
					<option>Ascoli Piceno</option>
					<option>Asti</option>
					<option>Avellino</option>
					<option>Bari</option>
					<option>Barletta-Andria-Trani</option>
					<option>Belluno</option>
					<option>Benevento</option>
					<option>Bergamo</option>
					<option>Biella</option>
					<option>Bologna</option>
					<option>Bolzano</option>
					<option>Brescia</option>
					<option>Brindisi</option>
					<option>Cagliari</option>
					<option>Caltanissetta</option>
					<option>Campobasso</option>
					<option>Caserta</option>
					<option>Catania</option>
					<option>Catanzaro</option>
					<option>Chieti</option>
					<option>Como</option>
					<option>Cosenza</option>
					<option>Cremona</option>
					<option>Crotone</option>
					<option>Cuneo</option>
					<option>Enna</option>
					<option>Fermo</option>
					<option>Ferrara</option>
					<option>Firenze</option>
					<option>Foggia</option>
					<option>Forlì-Cesena</option>
					<option>Frosinone</option>
					<option>Genova</option>
					<option>Gorizia</option>
					<option>Grosseto</option>
					<option>Imperia</option>
					<option>Isernia</option>
					<option>L'Aquila</option>
					<option>La Spezia</option>
					<option>Latina</option>
					<option>Lecce</option>
					<option>Lecco</option>
					<option>Livorno</option>
					<option>Lodi</option>
					<option>Lucca</option>
					<option>Macerata</option>
					<option>Mantova</option>
					<option>Massa-Carrara</option>
					<option>Matera</option>
					<option>Messina</option>
					<option>Milano</option>
					<option>Modena</option>
					<option>Monza e Brianza</option>
					<option>Napoli</option>
					<option>Novara</option>
					<option>Nuoro</option>
					<option>Oristano</option>
					<option>Padova</option>
					<option>Palermo</option>
					<option>Parma</option>
					<option>Pavia</option>
					<option>Perugia</option>
					<option>Pesaro e Urbino</option>
					<option>Pescara</option>
					<option>Piacenza</option>
					<option>Pisa</option>
					<option>Pistoia</option>
					<option>Pordenone</option>
					<option>Potenza</option>
					<option>Prato</option>
					<option>Ragusa</option>
					<option>Ravenna</option>
					<option>Reggio Calabria</option>
					<option>Reggio Emilia</option>
					<option>Rieti</option>
					<option>Rimini</option>
					<option>Roma</option>
					<option>Rovigo</option>
					<option>Salerno</option>
					<option>Sassari</option>
					<option>Savona</option>
					<option>Siena</option>
					<option>Siracusa</option>
					<option>Sondrio</option>
					<option>Sud Sardegna</option>
					<option>Taranto</option>
					<option>Teramo</option>
					<option>Terni</option>
					<option>Torino</option>
					<option>Trapani</option>
					<option>Trento</option>
					<option>Treviso</option>
					<option>Trieste</option>
					<option>Udine</option>
					<option>Varese</option>
					<option>Venezia</option>
					<option>Verbano-Cusio-Ossola</option>
					<option>Vercelli</option>
					<option>Verona</option>
					<option>Vibo Valentia</option>
					<option>Vicenza</option>
					<option>Viterbo</option>
				</select>
				<br>
				
				<button type="submit" id="addSchoolBtn" class="btn btn-card">Aggiungi scuola</button>
				<button class="btn btn-card" type="button" id="closeModal" onclick="chiudiModale('addSchoolModal');">Annulla</button>
			</form>
		</div>
	</div>
	<!-- fine modale aggiungi scuola -->
	
	<!--  inizio modale modifica scuola -->
	<div id="editSchoolModal" class="modal">
		<div class="modal-content" style="margin: 5% auto;">
			<h4>Modifica scuola</h4>
			<form method="POST" action="action_editSchool.php" class="form-group">
                                Codice meccanografico: <input type="text" maxlength="10" name="cod_meccanografico" id="old-cod_meccanografico" class="form-control" required>
				Nome: <input type="text" name="nome" id="old-nome" class="form-control" required>
				Via: <input type="text" name="via" id="old-via" class="form-control" required>
				Numero civico: <input type="number" name="nCivico" id="old-nCivico" class="form-control" min="1" required>
				CAP: <input type="text" name="cap" id="old-cap" class="form-control" maxlength="5" required>
				Comune: <input type="text" name="nomeComune" id="old-nomeComune" class="form-control" required>
				Provincia: 
				<select name="provincia" id="old-provincia" class="form-control" required>
					<option selected="selected" disabled>Provincia</option>
					<option>Agrigento</option>
					<option>Alessandria</option>
					<option>Ancona</option>
					<option>Aosta</option>
					<option>Arezzo</option>
					<option>Ascoli Piceno</option>
					<option>Asti</option>
					<option>Avellino</option>
					<option>Bari</option>
					<option>Barletta-Andria-Trani</option>
					<option>Belluno</option>
					<option>Benevento</option>
					<option>Bergamo</option>
					<option>Biella</option>
					<option>Bologna</option>
					<option>Bolzano</option>
					<option>Brescia</option>
					<option>Brindisi</option>
					<option>Cagliari</option>
					<option>Caltanissetta</option>
					<option>Campobasso</option>
					<option>Caserta</option>
					<option>Catania</option>
					<option>Catanzaro</option>
					<option>Chieti</option>
					<option>Como</option>
					<option>Cosenza</option>
					<option>Cremona</option>
					<option>Crotone</option>
					<option>Cuneo</option>
					<option>Enna</option>
					<option>Fermo</option>
					<option>Ferrara</option>
					<option>Firenze</option>
					<option>Foggia</option>
					<option>Forlì-Cesena</option>
					<option>Frosinone</option>
					<option>Genova</option>
					<option>Gorizia</option>
					<option>Grosseto</option>
					<option>Imperia</option>
					<option>Isernia</option>
					<option>L'Aquila</option>
					<option>La Spezia</option>
					<option>Latina</option>
					<option>Lecce</option>
					<option>Lecco</option>
					<option>Livorno</option>
					<option>Lodi</option>
					<option>Lucca</option>
					<option>Macerata</option>
					<option>Mantova</option>
					<option>Massa-Carrara</option>
					<option>Matera</option>
					<option>Messina</option>
					<option>Milano</option>
					<option>Modena</option>
					<option>Monza e Brianza</option>
					<option>Napoli</option>
					<option>Novara</option>
					<option>Nuoro</option>
					<option>Oristano</option>
					<option>Padova</option>
					<option>Palermo</option>
					<option>Parma</option>
					<option>Pavia</option>
					<option>Perugia</option>
					<option>Pesaro e Urbino</option>
					<option>Pescara</option>
					<option>Piacenza</option>
					<option>Pisa</option>
					<option>Pistoia</option>
					<option>Pordenone</option>
					<option>Potenza</option>
					<option>Prato</option>
					<option>Ragusa</option>
					<option>Ravenna</option>
					<option>Reggio Calabria</option>
					<option>Reggio Emilia</option>
					<option>Rieti</option>
					<option>Rimini</option>
					<option>Roma</option>
					<option>Rovigo</option>
					<option>Salerno</option>
					<option>Sassari</option>
					<option>Savona</option>
					<option>Siena</option>
					<option>Siracusa</option>
					<option>Sondrio</option>
					<option>Sud Sardegna</option>
					<option>Taranto</option>
					<option>Teramo</option>
					<option>Terni</option>
					<option>Torino</option>
					<option>Trapani</option>
					<option>Trento</option>
					<option>Treviso</option>
					<option>Trieste</option>
					<option>Udine</option>
					<option>Varese</option>
					<option>Venezia</option>
					<option>Verbano-Cusio-Ossola</option>
					<option>Vercelli</option>
					<option>Verona</option>
					<option>Vibo Valentia</option>
					<option>Vicenza</option>
					<option>Viterbo</option>
				</select>
				<br>
				
				<input type="hidden" name="old_cod_meccanografico" id="edit_cod_meccanografico">
				<button type="submit" id="editSchoolBtn" class="btn btn-card">Modifica scuola</button>
				<button class="btn btn-card" type="button" id="closeModal" onclick="chiudiModale('editSchoolModal');">Annulla</button>
			</form>
		</div>
	</div>
	<!-- fine modale modifica scuola -->
        
        <!-- inizio modale importazione scuole -->
        <div id="importSchoolModal" class="modal">
            <div class="modal-content">
                <h4>Importa scuole da CSV</h4>
                <form enctype="multipart/form-data" action="action_importSchool.php" method="POST" class="form-group">
                    Da qua è possibile importare le scuole attraverso un file CSV.
                    I campi relativi alla scuola devono essere disposti secondo il seguente ordine:
                    <ul>
                        <li>Codice meccanografico</li>
                        <li>Nome scuola</li>
                        <li>Via</li>
                        <li>Numero civico</li>
                        <li>Nome del comune</li>
                        <li>Provincia</li>
                        <li>CAP</li>
                    </ul>
                    <br>
                    <input type="file" class="" name="csvfile" id="csvfile">
                    
                    <br><br>
                    <button type="submit" id="uploadCSVFileBtn" class="btn btn-card">Importa</button>
                    <button type="button" id="closeImportModalBtn" class="btn btn-card">Annulla</button>
                </form>
            </div>
        </div>
        <!-- fine modale importazione scuole -->
</body>
</html>