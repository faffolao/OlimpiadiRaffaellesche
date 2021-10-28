<?php
	session_start();
	include("../../db_con.php");
	include '../../logger.php';
        
	// registrazione degli errori su file
        ini_set("display_errors","0");
        ini_set("error_log", "../../php_error_log.txt");
	
	/* controllo se i campi sono pieni */
        $domanda = $conn->real_escape_string($_POST['domanda']);
	$r1 = $conn->real_escape_string($_POST['r1']);
	$r2 = $conn->real_escape_string($_POST['r2']);
	$r3 = $conn->real_escape_string($_POST['r3']);
	$r4 = $conn->real_escape_string($_POST['r4']);
	$resatta = $conn->real_escape_string($_POST['resatta']);
	$id = $conn->real_escape_string($_POST['question_id']);
	
	if(empty($domanda) || empty($r1) || empty($r2) || empty($r3) || empty($r4) || empty($resatta) || empty($id)){
	    die("non è stato passato alcun parametro");
	}

	/* passo 1: controllo se l'immagine è da sostituire, in caso di si cancello la vecchia e carico la nuova */
	if(!empty($_FILES['chooseFile']['name'])){
		//l'immagine è diversa da quella originale, la vado a sostituire
		$old_image = $_POST['old_img_src'];
		if(!unlink($old_image)){
			die("Si è verificato un errore durante l'eliminazione del file.<br><a href='.'>Torna indietro</a>");
                        Logger::writeToLog("../../log.json","log-errori", "Impossibile modificare la domanda n. " . $id . ": "
                                . "non sono riuscito a cancellare la sua vecchia immagine");
		}
		
		
		//carico la nuova immagine
		$target_dir = "../../immagini_quiz/";		//cartella di upload
		$target_file = $target_dir . basename($_FILES["chooseFile"]["name"]);		//file da caricare
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));	//estensione file
		
		// controllo se l'immagine è veramente un'immagine
		if(isset($_POST["submit"])) {
			$check = getimagesize($_FILES["chooseFile"]["tmp_name"]);
			if($check !== false) {
				echo "File is an image - " . $check["mime"] . ".";
				$uploadOk = 1;
			} else {
				$uploadOk = 0;
				die("Non è stata selezionato un file valido.<br><a href='.'>Torna indietro</a>");
			}
		}
		
		// controllo se esiste già il file desiderato
		if (file_exists($target_file)) {
			$uploadOk = 0;
			die("Il file esiste già.<br><a href='.'>Torna indietro</a>");
		}
		
		// controllo se è un file immagine
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
			$uploadOk = 0;
			die("Sono accettati solamente file immagini(JPG, PNG, JPEG, GIF).<br><a href='.'>Torna indietro</a>");
		}
		
		// se va tutto bene caricare il file
		if (move_uploaded_file($_FILES["chooseFile"]["tmp_name"], $target_file)) {
			echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		} else {
			die("Si è verificato un errore durante il caricamento del file.");
                        Logger::writeToLog("../../log.json","log-errori", "Impossibile modificare la domanda n. " . $id . ": " . 
                                "impossibile caricare la sua nuova immagine");
		}
	}


	/* passo 2: aggiorno i dati della domanda se non c'è nessun nuovo file da caricare */
	if(empty($_FILES['chooseFile']['name'])){
	    $new_image = str_replace("../../immagini_quiz/","",$_POST['old_img_src']);
	}else{
	    $new_image = $_FILES['chooseFile']['name'];
	}

	
	if(mysqli_query($conn, "UPDATE domande SET id='" . $id . "', domanda='" . $domanda . "', risp1='" . $r1 . "', risp2='" . $r2 . "', risp3='" . $r3 . "', risp4='" . $r4 . "', 
                    r_esatta='" . $resatta . "', linkImmagine='" . $new_image . "' WHERE id='" . $id . "';")){
        Logger::writeToLog("../../log.json","log-mod-impostazioni-utenti","E' stata modificata la domanda n. " . $id);
	   header("location: .");
	}else{
	    Logger::writeToLog("../../log.json","log-errori","Impossibile modificare la domanda n. " . $id . ": " . 
	        mysqli_error());
		die("errore durante la query: " . mysqli_error());
	}
?>