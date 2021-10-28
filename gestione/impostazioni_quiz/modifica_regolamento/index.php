<!doctype html>
<html>
	
<?php
	session_start();
	include("../../../db_con.php");
	
	$conn->query("SET NAMES 'utf8';");
	
	$result = $conn->query("SELECT regolamento FROM settings");
	$row = $result->fetch_assoc();
	$regolamento = $row["regolamento"];
?>
	
<head>
	<meta charset="utf-8">
	<title>Modifica regolamento</title>
	<META name="viewport" content="width=device-width, initial-scale=1.0" />
	<LINK rel="icon" href="../../../img/logo_black.png">
	
	<!-- inizio importazione bootstrap e jquery -->
	<SCRIPT src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></SCRIPT>
	<SCRIPT src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" INTEGRITY="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" CROSSORIGIN="anonymous"></SCRIPT>
	<LINK rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" INTEGRITY="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" CROSSORIGIN="anonymous">
	<SCRIPT src="../js/popper.min.js"></SCRIPT>
	<SCRIPT src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" INTEGRITY="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" CROSSORIGIN="anonymous"></SCRIPT>
	<!-- fine importazione bootstrap e jquery-->
	
	<!-- inizio importazione stili e script personali -->
	<LINK href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">
	<LINK rel="stylesheet" href="../../style.css">
	<SCRIPT src="../../openMenu.js"></SCRIPT>
	<script src="edit.js"></script>
	<!-- fine importazione stili e script personali-->
		
	<!-- inizio importazione fa per icone e tinymce -->
	<SCRIPT src="https://kit.fontawesome.com/bea6002302.js"></SCRIPT>
	<script src="https://cdn.tiny.cloud/1/2q28elim21809082se1f5fyzjfvopm2ey81bsn3hrdlazxnq/tinymce/5/tinymce.min.js"></script>
	<!-- importazione fa per icone -->
		
	<!-- inizializzazione tinymce -->
	<script>
		tinymce.init({
			selector:'textarea', 
			height: 450, 
			plugins: 'link image charmap autolink insertdatetime',
			init_instance_callback : function(editor) {
				editor.setContent(`<?php echo $regolamento ?>`);
		  	}
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
				<A href="../../" title="Dashboard" class="active"><I class="fas fa-home"></I></A>
				<A href="../../controllo_accessi/" title="Controllo accessi"><I class="fas fa-sign-in-alt"></I></A>
				<A href="../../avanzamento_quiz/" title="Controllo avanzamento quiz"><I class="fas fa-tasks"></I></A>
				<A href="../../statistiche_quiz/" title="Statistiche quiz"><I class="fas fa-chart-line"></I></A>
				<A href="../../log/ title="Log generale"><I class="fas fa-receipt"></I></A>
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
				
		<div class="main" style="margin-top: 65px;">
			<h1>Modifica regolamento</h1><br>
			<textarea id="regolamento"></textarea><br>
			<div class="form-inline">
				<button id="edit" class="btn btn-card">Modifica</button>
				<button id="cancel" class="btn btn-card">Annulla</button>
			</div>
		</div><br>
	</div>
</body>
</html>