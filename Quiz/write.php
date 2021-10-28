<?php
	session_start();
	require "../db_con.php";
	require "../lib/costanti.php";
	//echo $_SESSION["email"];
	$session_name = "qruser";
	if(!isset($_SESSION[$session_name])) {

		  header("location:../login/");

	} else {
	    $user = json_decode($_SESSION[$session_name], true);
	    
	    $rispostaData = $_REQUEST['risp'];
		$tempoRisposta = $_REQUEST['tempo'];
		$domanda_attuale = $_SESSION['ND'];   //controllare --> non viene valorizzata
		
		
		$sql = "SELECT * FROM `risposte` WHERE risposte.id_studente = ".$user['id']." AND risposte.id_domanda = ".$domanda_attuale;
		$result = $conn->query($sql);
		
		if($result->num_rows == 0){
			//die("entra lo stesso");
			
			/*$sql = "SELECT MAX(risposte.id_domanda)+1 as id_domande FROM `risposte` WHERE risposte.id_studente = " . $user["id"];
			$result = $conn->query($sql);*/
			if (/*$result->num_rows > 0*/true) {
				
				//$row = $result -> fetch_assoc();
				//echo $row["MAX(risposte.id_domanda)+1"];
				//if(!is_null($row["id_domande"])){
					//$num_domanda = $row["id_domande"];
				//}else{
				//	$num_domanda = 1;

				//}
				
				$num_domanda = $domanda_attuale;
				
				$sql = "SELECT COUNT(*) FROM `domande`";
				$result = $conn->query($sql);

				
				if ($result->num_rows > 0) {
					$row = $result -> fetch_assoc();

				//echo $row["MAX(risposte.id_domanda)+1"];
					$num_records = $row["COUNT(*)"];
				}
//DOVREBBE FUNZIONARE
				if($num_domanda <= $num_records){

						$sql = "INSERT INTO `risposte`( `id_studente`, `id_domanda`, `risposta_data`, `tempo_risposta`) VALUES ('".$user['id']."','".$num_domanda."','".$rispostaData."',". $tempoRisposta .")";
						$result = $conn->query($sql);
						$risposta->check = true;
					//	echo json_encode($risposta); 

				}
			}
		}else{
		//	echo json_encode("");
		}
	}
#echo "<br>";
#print_r($_SESSION); <-- VARIABILE $_SESSION['ND'] IMPOSTATA E VALORIZZATA - FORSE PUO' DARE PROBLEMI
?>