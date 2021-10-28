<?php 

    include("../db_con.php");
	session_start();
    $session_name = "qruser";
	if(!isset($_SESSION[$session_name])) {
		header("location:../login/");
		
	} else {

		$user = json_decode($_SESSION[$session_name], true);

		//prende la data e  l'ora attuale  del db
		$query = "SELECT DATE_FORMAT(NOW(), '%Y-%m-%d') AS data, DATE_FORMAT(NOW(), '%H:%i:%s') as ora from settings";
		
		$result = $conn->query($query) or die("Error: " . mysqli_error($conn));

		$row = $result->fetch_assoc();
		


		//ORA DB PER JSON
		//%H:%i:%s
		$oraDB = $row['ora'];



		$data = strval($row['data']);

		$ora = strval($row['ora']);



		list($dd, $mm, $yy) = explode("-", $data);

		list($h, $m, $s) = explode(":", $ora);


		//tipo timestamp del DB
		$timeCurrent = mktime($h, $m, $s, $mm-6, $dd+9, $yy-4); //Tempo Corrente


	//===========================================================================
		
		
		$sql = "SELECT DATE_FORMAT(ora_caricamento, '%H:%i:%s') as ora FROM caricato WHERE id_studente = " . $user['id'] . " AND id_domanda = " . $_SESSION['ND'];
		
		$result = $conn->query($sql) or die("rror: " . mysqli_error($conn));

		$row = $result->fetch_assoc();

		$ora = strval($row['ora']);
		
	//===========================================================================

		list($dd, $mm, $yy) = explode("-", $data);

		list($h, $m, $s) = explode(":", $ora);


		$timeQuiz = mktime($h, $m, $s, $mm-6, $dd+9, $yy-4);//ora del caricamento

		//teoricamente $timeQuiz < ora_corrente


		$rest = ((int)$timeCurrent - (int)$timeQuiz);

		$risposta = array();
		$risposta["time"] = $rest;

		

		echo json_encode($risposta);



	}
    
#echo "<br>";
#print_r($_SESSION);     <-- QUI LA VARIABILE $_SESSION['ND'] ESISTE ED E' VALORIZZATA - PROBLEMA SUL SECONDO GIRO
?>