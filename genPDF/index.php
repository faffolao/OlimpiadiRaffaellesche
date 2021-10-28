<html>
	
	<head>
		<title>Tabella risultati</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1">
	  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	</head>
	
	<body>

	<div class="container">
		<?php

			require "../db_con.php";	//connessione al database
			require "../lib/costanti.php";	//costanti riferite alle colonne della tabella risposte
			
			
			$arrayStudenti = [];	//array di studenti
			$arrayDomande = [];	//array di domande
			$arrayRisposte = [];	//array di risposte
			

			$sql = "SELECT id, r_esatta FROM domande"; //id domanda e risposta esatta
			$result = $conn->query($sql);
		
			while($row = $result->fetch_assoc()){
				array_push($arrayRisposte,$row);	//prendo la prima riga della tabella e la metto dentro row
			}
		
//========================================================================================================================
			//stampa l'header della tabella
		
			echo "<table class='table table-bordered text-center'>"
				. "<thead><tr>"
				. "<th>Nome squadra</th>";
		
			$sql = "SELECT COUNT(id) AS ndomande FROM domande";	//conto quante domande ci sono
			$result = $conn->query($sql);
			$row = $result->fetch_assoc();
			$num_domande = $row['ndomande'];	//dopo aver contato quante domande ci sono, butto tutto dentro num_domande
			
			for($x=1; $x <= $num_domande; $x++){	//ciclo per stampare tot colonne quante sono le domande (quindi è automatizzato)
				
				echo "<th>R. N°".$x."</th><th>T. N°".$x."</th>";
			}
		
			echo "<th>Punteggio totale</th><th>Tempo totale</th></tr>";

//========================================================================================================================
			//stampa il corpo della tabella
			
			
			$sql = "SELECT username,id FROM utenti WHERE tipoUtente = 0 ORDER BY (id) ASC";	//prende solo gli studenti (tipo 0)
			$result = $conn->query($sql);
			
			echo "<tbody>";
			$arrayClassifica =[];	//array per effettuare la classifica
			while ($row = $result->fetch_assoc()) {
				$sql = "SELECT risposte.id_domanda, risposte.risposta_data, risposte.tempo_risposta FROM risposte WHERE risposte.id_studente = ".$row['id']." ORDER BY risposte.id_domanda ASC";
				$result2 = $conn ->query($sql);
								
				$num_record = $result2->num_rows;
				
				echo "<tr><td>".$row['username']."</td>";
//========================================================
//ciclo per elencare le risposte date e il tempo impiegato di un utente
				$totTempo = 0;	//Tempo totale
				$totPunti = 0;	//Punteggio totale
				
				for ($i=0;$i<$num_domande;$i++) {
					
					if($i<$num_record){
						$res = $result2->fetch_assoc();
						$cellarisp = $res['risposta_data'];
						$cellatempo = $res['tempo_risposta'];
					}else {
						$cellarisp = "/";
						$cellatempo = "/";
					}
					
					if ($cellarisp == $arrayRisposte[$i]['r_esatta']){
						$totPunti += (int) 1;
						$totTempo += (int)$cellatempo;
						echo "<td class=\"success\">" . $cellarisp . "</td><td>" . $cellatempo . "</td>";
					}else{
						echo "<td class=\"danger\">" . $cellarisp . "</td><td>" . $cellatempo . "</td>";
					}
						
				}
				
				$usertmp = new Utente();
				$usertmp -> email = $row['username'];
				$usertmp -> id = $row['id'];
				$usertmp -> punteggiotot = $totPunti;
				$usertmp -> tempotot = $totTempo;
					
				array_push($arrayClassifica, $usertmp);
				
				
				
				echo "<td>".$totPunti."</td>";
				echo "<td>".$totTempo."</td>";
//========================================================
				
				
				echo "</tr>";
				
			}
			
		
			echo "<table class='table table-bordered text-center'>"
				. "<thead><tr>"
				. "<th>Posizione</th>"
				. "<th>Nome squadra</th>"
				. "<th>Punteggio</th>"
				. "<th>Tempo</th>";
		
			echo "<tbody>";
			
			
			
			/*$tmpClassifica = new Utente();
			$tmpClassifica->id = -1;
			$tmpClassifica->punteggiotot = -1;
			$tmpClassifica->tempotot = -1;
			$primo = $tmpClassifica;
			$secondo = $tmpClassifica;
			$terzo = $tmpClassifica;
			$quarto = $tmpClassifica;
			print_r($arrayClassifica);
			$primo = getBest($arrayClassifica);
			echo $primo->email . "<br>";*/
			//$j = 0;
			//$trovato = false;
			/*while($j < count($arrayClassifica) && !$trovato){
				
				if($arrayClassifica[$j]->id == $primo->id){
					die("enrta");
					unset($arrayClassifica[$j]);
					
					$trovato = true;
				}
				$j++;
			}*/
			//print_r($arrayClassifica); 
			//$secondo = getBest($arrayClassifica);
			//echo $secondo->email . "<br>";

			 
			
//=====================================================		
		//creo classe Utente per creare l'oggetto
		class Utente {
			public $username;
			public $punteggiotot;
			public $tempotot;
			
			public static function compare($utente1,$utente2){
				if($utente1->punteggiotot > $utente2->punteggiotot){
					$res = $utente1;
				}else if($utente1->punteggiotot < $utente2->punteggiotot){
					//echo("utente 1 ->".$utente1->id." utente 2 ->".$utente2->id."<br>");
					$res = $utente2;
				}else{
					if($utente1->tempotot < $utente2->tempotot){
						$res = $utente1;
					}else if($utente1->tempotot > $utente2->tempotot){
						$res = $utente2;
					}else{
						die("errore inatteso");
					} 
				}
				return $res;
			}
		}
		
		
		function getBest($arrayClassifica){
			
			$tmp = $arrayClassifica[0];
			for ($i=1;$i<count($arrayClassifica);$i++) {
				$tmp = Utente::compare($tmp,$arrayClassifica[$i]);
				
			}
			
			echo "<br>";
			
			return $tmp;
		}
		
		
		?>
		</div>
	</body>
</html>
