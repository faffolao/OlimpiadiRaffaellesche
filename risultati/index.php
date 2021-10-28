<?php
   header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
	header("Content-Disposition: attachment; filename=ClassificaOlimpiadiRaffaellesche.xls");  //File name extension was wrong
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Cache-Control: private",false);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang=it><head>
<title>Titolo</title></head>
<body>
<?php

	require "../db_con.php";
	require "model/Persona.class.php";
	require "model/ElencoRisposte.class.php";
	require "model/Calcola.class.php";



	$sql = "SELECT COUNT(id) AS NDomande FROM domande";	//conto quante domande ci sono
	$result = $conn->query($sql);

	$row = $result->fetch_assoc();
	$num_domande = $row['NDomande'];	//dopo aver contato quante domande ci sono, butto tutto dentro num_domande



	$sql  = "SELECT utenti.id, utenti.username, scuole.nome, scuole.cod_meccanografico FROM utenti INNER JOIN scuole ON utenti.cod_scuola = scuole.cod_meccanografico WHERE utenti.tipoUtente = 0";
	$result = $conn->query($sql);

	$arrayscuole = []; //array per le scuole

	$i = 0;	//contatore per scorrere i record
	while($row = $result->fetch_assoc()) {
		$arrayscuole [$i] = new Persona($row['id'],$row['username'],$row['nome'],$row['cod_meccanografico']);
		$i++;
	}


	$sql = "SELECT id_studente, id_domanda, risposta_data, tempo_risposta FROM risposte";
	$result = $conn->query($sql);

	$elencoRisposte = new ElencoRisposte();	//classe per le domande, le risposte e il tempo

	while($row = $result->fetch_assoc()) {
		$elencoRisposte->addRisposta($row['id_studente'],$row['id_domanda'],$row['risposta_data'],$row['tempo_risposta']);
	}

	for($i = 0; $i < count($arrayscuole); $i++){
		$tmpId = $arrayscuole[$i]->getIdUtente();
		$tmpArray = $elencoRisposte->getElencoRisposte($tmpId);
		for($j = 0; $j < count($tmpArray); $j++){
			$arrayscuole[$i]->setRisposta($tmpArray[$j]);		
		}

	}


	maketable($arrayscuole);

	//print_r($arrayscuole[41]->getRisposte()[0]->getTempoRisposta());
	//print_r($arrayscuole[95]->getRisposte());
	//print_r($elencoRisposte);
	/*if($arrayscuole[95]->getRisposte()[1] != NULL){
		echo "diverso da null";
	} else {
		echo "uguale a null";
	}*/



	function maketable($array){
		$table = "";
		$calcola = new Calcola($conn);

		$table .= "<table border='1'>"
				."<tr>"
				."<th>ID</th>"
				."<th>Username</th>"
				."<th>Scuola</th> "
				."<th>Codice Meccanografico</th>";
		for($i = 1 ; $i <= 20 ; $i++){
			$table .= "<th>Risposta ".$i."</th>"
					."<th>Tempo ".$i."</th>";
		}
		$table .= "<th>Punteggio</th>";
		$table .= "<th>Tempo Impiegato</th>";
		$table .= "</tr>";

		for($j = 0; $j < count($array); $j++){
			$table .= "<tr>";
			$table .= "<td>".$array[$j]->getIdUtente()."</td>";
			$table .= "<td>".$array[$j]->getUsername()."</td>";
			$table .= "<td>".$array[$j]->getNomeScuola()."</td>";
			$table .= "<td>".$array[$j]->getCodiceMeccanografico()."</td>";

			$tmpRisposte = $array[$j]->getRisposte();

			for($k = 0; $k < 20;$k++){
				if($tmpRisposte[$k] != NULL){
					$table .= "<td>". $tmpRisposte[$k]->getRispostaData()."</td>";
					$table .= "<td>". $tmpRisposte[$k]->getTempoRisposta()."</td>";
				}else{
					$table .= "<td>NA</td>";
					$table .= "<td>NA</td>";
				}
			}

			$score = $calcola->score($tmpRisposte);

			$table .= "<td>".$score["punti"]."</td>";
			$table .= "<td>".$score["tempo"]."</td>";


			$table .= "</tr>";

		}

		$table .= "</table>";


		echo $table;


	}	


?>
</body></html>