<?php

	require "../db_con.php";
    require "../lib/costanti.php";
    
    // registrazione degli errori su file
    ini_set("display_errors","0");
    ini_set("error_log", "../php_error_log.txt");
	
	$arrayStudenti = [];
	$arrayDomande = [];
	$rankArray = [];
	$arrayDomande = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20];
	$risposteCorrette = [];

	$sql = "SELECT id_studente FROM risposte GROUP BY( id_studente)";
	$result = $conn->query($sql);

	$tempo = "SELECT tempo_risposta FROM risposte WHERE id_studente = ".$arrayStudenti[$n]. "AND id_domanda = " .$arrayDomande[$c];
	$result2 = $conn->query($tempo);

	while($row = $result->fetch_assoc()){
		array_push($arrayStudenti,$row["id_studente"]);
	}

	$sql = "SELECT r_esatta FROM domande_albe";
	$resultRisposte = $conn->query($sql);

	while($row = $resultRisposte->fetch_assoc()){
		array_push($risposteCorrette,$row["r_esatta"]);
	}
	
	echo "
		<!DOCTYPE html>
		<html>
		<head>
		<style>
		table, th, td {
		border: 1px solid black;
		}
		</style>
		</head>
		<body>
	";
	
	echo "<table class='table table-bordered text-center'><thead><tr><th>id_studente</th>";
	for($x=1; $x < 21; $x++){
		echo "<th>risposta".$x."</th><th>tempo".$x."</th>";
	}
	echo "<th>punteggio_totale</th><th>tempo_totale</th></tr>";
	
	for($n = 0; $n < count($arrayStudenti);$n++){
		//echo $arrayStudenti[$n];
		$sql = "SELECT SUM(tempo_risposta) AS t FROM risposte WHERE id_studente = ". $arrayStudenti[$n];
		$result1 = $conn->query($sql);
		$sql = "SELECT id_studente, id_domanda, risposta_data, tempo_risposta FROM risposte WHERE id_studente = ".$arrayStudenti[$n] ;
		if($result = $conn->query($sql)){
			
			write($result,$result1,$risposteCorrette,$rankArray);
		
		}else{
			echo "errore di query";
		}
	
	}
	echo "</table>";

	echo "</body>";
				
	$conn->close();
					



	function write($result,$result1,$risposteCorrette,$rankArray){
		$row = $result->fetch_assoc();
		$row1 = $result1->fetch_assoc();
		$id_studente =  $row["id_studente"];
		echo "<tr><td>" . $row["id_studente"] . "</td>";
		$totTempo = 0;
		$totTempoE = 0; 
		if($row["risposta_data"] == $risposteCorrette[1]){
			$totPunti +=1;
			$totTempo += $tempo;
			$totTempoE += $tempo;
			echo " <td style='background-color:#76ad32'>".$row["risposta_data"] . "</td><td>" . $row["tempo_risposta"] . "</td>";
		}else{
			$totTempo +=60;
			$totTempoE += $tempo;
			echo " <td style='background-color:red'>".$row["risposta_data"] . "</td><td>" . $row["tempo_risposta"] . "</td>";
		}
		$numero_domanda = 1;
		$totPunti = 0;
		while($row = $result->fetch_assoc()) {
			if($row["risposta_data"] == $risposteCorrette[$numero_domanda]){
				$totTempo += $tempo;
				$totTempoE += $tempo;
				$totPunti +=1;
				echo " <td style='background-color:#76ad32'>".$row["risposta_data"] . "</td><td>" . $row["tempo_risposta"] . "</td>";
			}else{
				$totTempo += 60;
				$totTempoE += $tempo;
				echo " <td style='background-color:red'>".$row["risposta_data"] . "</td><td>" . $row["tempo_risposta"] . "</td>";
			}
			//echo " <td style='background-color:#76ad32'>".$row["risposta_data"] . "</td><td>" . $row["tempo_risposta"] . "</td>";
			$numero_domanda++;
		}

		$tmp = new Rank();
		$tmp->idStudente = $id_studente;
		$tmp->punteggioTotale = $totPunti;
		$tmp->tempoTotale = $totTempo;
		$tmp->tempoTotaleEffettivo = $totTempoE;
		echo $tmp->idStudente. " ". $tmp->punteggioTotale. " ". $tmp->tempoTotale. " ". $tmp->tempoTotaleEffettivo;

		echo "<td>".$totPunti."</td>";
		echo "<td>".$row1["t"]."</td>";
		echo "</tr>";
		
		$result->close();
	}

	echo "<table class='table table-bordered text-center'><thead><tr><th>ID STUDENTE</th><th>PUNTEGGIO TOTALE</th><th>TEMPO IMPIEGATO</TH>";	
	for($m = 0; $m < count($arrayStudenti);$m++){
		echo "<tr><td>" . $row["id_studente"] . "</td><td>".$totPunti."</td><td>".$row1["t"]."</td>";
	}
	echo "</tr>";
	echo "</table>";





	class Rank {
		// Properties
		public $idStudente;
		public $punteggioTotale;
		public $tempoTotale;
		public $tempoTotaleEffettivo;
	}
?>