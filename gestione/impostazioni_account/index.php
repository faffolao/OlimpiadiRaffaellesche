<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Impostazioni account Amministratori</title>
	<META name="viewport" content="width=device-width, initial-scale=1.0" />
	<LINK rel="icon" href="../../img/logo_black.png">
	
	<!-- inizio importazione bootstrap e jquery -->
	<SCRIPT src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></SCRIPT>
	<SCRIPT src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" INTEGRITY="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" CROSSORIGIN="anonymous"></SCRIPT>
	<LINK rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" INTEGRITY="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" CROSSORIGIN="anonymous">
	<script src="../js/popper.min.js"></script>
	<SCRIPT src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" INTEGRITY="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" CROSSORIGIN="anonymous"></SCRIPT>
	<!-- fine importazione bootstrap e jquery-->
	
	<!-- inizio importazione stili e script personali -->
	<LINK href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="../style.css">
	<script src="settings.js"></script>
	<script src="../openMenu.js"></script>
	<script src="../../js/loginbtnsecure.js"></script>
	<!-- fine importazione stili e script personali-->
		
	<!-- inizio importazione fa per icone -->
	<script src="https://kit.fontawesome.com/bea6002302.js"></script>
	<!-- importazione fa per icone -->
    
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
				<a href="../gestione_studenti/" title="Gestione scuole"><i class="fas fa-graduation-cap"></i></a>
				<a href="../gestione_domande/" title="Gestione domande"><i class="fas fa-list"></i></a>
				<a href="../impostazioni_quiz/" title="Impostazioni quiz"><i class="fas fa-sliders-h"></i></a>
				<hr>
				<a href="../avvio_quiz/" title="Avvio quiz"><i class="fas fa-play"></i></a>
			</div>
		</div>
		<!-- fine sidebar -->
		
		<!-- contenuto pagina -->
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
						<a class="dropdown-item" href=".">Impostazioni account</a>
						<a class="dropdown-item" href="../../Logout">Logout</a>
					</div>
				</div>
			</div>
			<!-- fine barra superiore-->
			
			<!-- inizio area admin registrati -->
			<h1>Impostazioni account Amministratori</h1><br>
			<h4>Amministratori registrati</h4><br>
			
			<button id="addBtn" class="btn btn-card"><i class="fas fa-plus"></i>&nbsp;&nbsp;Aggiungi nuovo</button>
			<button id="editBtn" class="btn btn-card" disabled><i class="fas fa-pencil-alt"></i>&nbsp;&nbsp;Modifica</button>
			<button id="deleteBtn" class="btn btn-card" disabled><i class="fas fa-trash"></i>&nbsp;&nbsp;Elimina</button>
			
			<div class="table-responsive">
				<table class="table table-hover table-sm" id="tabella">
				<thead>
					<tr>
						<th>Username</th>
						<th>Password</th>
						<th>Email</th>
					</tr>
				</thead>
				<tbody>
					<?php
						session_start();
						include("../../db_con.php");
					
						$result = $conn->query("SELECT * FROM `utenti` WHERE tipoUtente=1 ORDER BY `utenti`.`id` ASC");
					
						if($result->num_rows > 0){
							while($row = $result->fetch_assoc()): 
					?>
					<tr id="<?php echo $row["id"] ?>">
						<td class="td-username"><?php echo $row["username"]; ?></td>
						<td class="td-password">
							<input type="password" class="password-field" readonly value="<?php echo $row["password"]; ?>" id="password<?php echo $row["id"]; ?>">
							<a href="javascript:void(0)" onclick="visualizzaPassword('password<?php echo $row["id"]; ?>')"><img id="password<?php echo $row["id"]; ?>-img" width="30" src="./img/view.svg"></a>
						</td>
						<td class="td-email"><?php echo $row["email"]; ?></td>
					</tr>
					<?php endwhile;
						
						}else{
							echo "Nessun utente";
						}
					?>
				</tbody>
			</table>
			</div>
			
			<!-- fine area admin registrati -->
			
		</div>
	</div>
	
	<!-- inizio modale aggiungi utente -->
	<div id="addUserModal" class="modal">
		<div class="modal-content">
			<h4>Aggiungi amministratore</h4>
			<form method="post" action="./action_addUser.php" class="form-group">
				Username: <input id="username" class="form-control" type="text" name="username" required>
				Password (<a href="javascript:void(0)" onClick="generaPassword('addUserModal','password')">clicca qui</a> per generarne una automatica): <input id="password" class="form-control" type="password" name="password" required>
				Email: <input id="email" class="form-control" type="email" name="email" required><br>
				<button type="submit" id="addUserBtn" class="btn btn-card">Aggiungi utente</button><button id="closeModalBtn" class="btn btn-card">Annulla</button>
			</form>
		</div>
	</div>
	<!-- fine modale aggiungi utente -->
	
	<!-- inizio modale modifica utente -->
	<div id="editUserModal" class="modal">
		<div class="modal-content">
			<h4>Modifica utente</h4>
			<form method="post" action="./action_editUser.php" class="form-group">
				Username: <input id="new_username" class="form-control" type="text" name="new_username" required>
				Password (<a href="javascript:void(0)" onClick="generaPassword('editUserModal','new_password')">clicca qui</a> per generarne una automatica): <input id="new_password" class="form-control" type="password" name="new_password" required>
				
				<input id="old_email" class="form-control" type="email" name="old_email" readonly style="display: none;">
				
				Email: <input id="new_email" class="form-control" type="email" name="new_email" required><br>
				<button type="submit" id="addUserEditBtn" class="btn btn-card">Modifica utente</button>
				<button type="button" id="closeEditModalBtn" class="btn btn-card">Annulla</button>
			</form>
		</div>
	</div>
	<!-- fine modale modifica utente -->
	
</body>
</html>