<?php
	session_start();
	include("../../db_con.php");
	include '../../logger.php';
        
        // registrazione degli errori su file
        ini_set("display_errors","0");
        ini_set("error_log", "../../php_error_log.txt");
        date_default_timezone_set('Europe/Rome');
        

	/* controllo se i campi sono pieni */
        $domanda = $conn->real_escape_string($_POST['domanda']);
	$r1 = $conn->real_escape_string($_POST['r1']);
	$r2 = $conn->real_escape_string($_POST['r2']);
	$r3 = $conn->real_escape_string($_POST['r3']);
	$r4 = $conn->real_escape_string($_POST['r4']);
	$resatta = $conn->real_escape_string($_POST['resatta']);
	
	if(empty($domanda) || empty($r1) || empty($r2) || empty($r3) || empty($r4) || empty($resatta)){
	    die("non è stato passato alcun parametro");
	}
	
	/* parte 1: caricamento dell'immagine */
	error_reporting(E_ALL);
	$target_dir = "../../immagini_quiz/";						//cartella dove viene caricata l'immagine
	$target_file = $target_dir . basename($_FILES["chooseFile"]["name"]);		//percorso file
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));		//tipologia file
	
	// controllo se l'immagine è effettivamente un'immagine
	if(isset($_POST["submit"])){
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if($check !== false) {
			echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
		} else {
			$uploadOk = 0;
			die('Non è stata selezionato un file valido.<br><a href=".">Torna indietro</a>');
		}
	}

	// controllo se il file già esiste
	if (file_exists($target_file)) {
		$uploadOk = 0;
		die('Il file selezionato è già stato caricato.<br><a href=".">Torna indietro</a>');
	}

	// controllo se il file è di tipo immagine
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
		$uploadOk = 0;
		die('Sono accettati solamente i file immagini (es. JPG, PNG, JPEG, GIF).<br><a href=".">Torna indietro</a>');
	}

	// controllo se non ci sono errori
	if ($uploadOk == 0) {
		echo "Sorry, your file was not uploaded.";
	// se va tutto bene caricare l'immagine
	} else {
		if (move_uploaded_file($_FILES["chooseFile"]["tmp_name"], $target_file)) {
			echo "The file ". basename( $_FILES["chooseFile"]["name"]). " has been uploaded.";
		} else {
			die('Si è verificato un errore nel caricamento del file.<br><a href=".">Torna indietro</a>');
                        Logger::writeToLog("../../log.json","log-errori", "Impossibile aggiungere l'immagie della domanda.");
		}
	}


	/* parte 2: caricamento delle domande */
	$risposta = $conn->query("SELECT COUNT(*) as conto FROM `domande` WHERE 1");
	$riga = $risposta->fetch_assoc();
	$numero_domande = $riga['conto'] + 1; 
	$sql = "INSERT INTO domande (id, domanda, risp1, risp2, risp3, risp4, r_esatta, linkImmagine) 
            VALUES (".$numero_domande.", '" . $domanda . "', '" . $r1 . "', '" . $r2 . "', '" . $r3 . "', '" . $r4 . "', '" . $resatta . "', 
            '" . $conn->real_escape_string(basename( $_FILES["chooseFile"]["name"])) . "')";
	 
	/*
	
	$query_verifica = "SELECT * FROM appoggio";
	$risultato = $conn->query($query_verifica);
	
	$query = "SELECT DATE_FORMAT(NOW(), '%Y-%m-%d') AS data, DATE_FORMAT(oraInizio, '%H:%i:%s') as ora from settings";
	$result = $conn->query($query) or die("Error: " . mysqli_error($conn));
	$row = $result->fetch_assoc();
		
	$data = strval($row['data']);
	$ora = strval($row['ora']);
	
	list($dd, $mm, $yy) = explode("-", $data);
	list($h, $m, $s) = explode(":", $ora);
	
	$timeCurrent = mktime($h, $m+($risultato->num_rows), $s, $mm, $dd, $yy); //Tempo Corrente
	$prova = date("H:i:s", $timeCurrent);
	$aggiunta = "INSERT INTO appoggio (id_domanda, ora) values (".$numero_domande.", '". $prova."')";
	   
	*/
	
	if (mysqli_query($conn, $sql)) {
	    Logger::writeToLog("../../log.json","log-mod-impostazioni-utenti","E' stata aggiunta una domanda.");
	 //   $conn -> query($aggiunta) or die("ERROR IN AGGIUNTA " . mysqli_error($conn) . " afas " . $prova);
	    header("location: .");
	} else {
	    Logger::writeToLog("../../log.json","log-errori", "Impossibile aggiungere la domanda: " . mysqli_error());
		die("Error: " . $sql . "<br>" . mysqli_error());
	}
?>