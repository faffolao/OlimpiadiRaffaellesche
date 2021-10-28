<?php
	session_start();
	require "../db_con.php";
	require "../lib/costanti.php";
	$session_name = "qruser";

	if(!isset($_SESSION[$session_name])) {

		  header("location:../login/");

	} else {
		
		$user = json_decode($_SESSION[$session_name], true);
		
		
		//=================================================
		//parte nuova 03/02/2020 21:04:44 
		
		
		//prende la data e  l'ora attuale  del db
		/*$query = "SELECT DATE_FORMAT(NOW(), '%Y-%m-%d') AS data,DATE_FORMAT(`ora_caricamento`, '%H:%i:%s') as ora_tabella, DATE_FORMAT(NOW(), '%H:%i:%s') as ora_corrente from caricato WHERE caricato.id_studente = ".$user['id']." AND caricato.id_domanda = (SELECT MAX(caricato.id_domanda) FROM caricato WHERE caricato.id_studente = ".$user['id'].")";

		$result = $conn->query($query);
		if($result->num_rows >0){
		
		$row = $result->fetch_assoc();
		
			

		$data = strval($row['data']);

		$oraTabella = strval($row['ora_tabella']);
		
		$oraCorrente = strval($row['ora_corrente']);

		//die($oraTabella . " ora ");

		list($dd, $mm, $yy) = explode("-", $data);

		list($h, $m, $s) = explode(":", $oraTabella);
		
			
		$timePlusOne = mktime($h, $m, $s, $mm-6, $dd+9, $yy-4);
		
		list($h1, $m1, $s1) = explode(":", $oraCorrente);
			
		$oraAttuale = mktime($h1, $m1, $s1, $mm-6, $dd+9, $yy-4);
		
		$oraAttuale = $oraAttuale*-1;
		$timePlusOne = $timePlusOne*-1;
		
			
		//die($oraAttuale . " -> ora attuale :" . $timePlusOne ." -> time plus one");	
			
		if($oraAttuale > $timePlusOne){
			//die("oraAttuale > timePlusOne");
			$sql = "SELECT MAX(risposte.id_domanda) as id_domande FROM `risposte` WHERE risposte.id_studente = " . $user["id"];
		}else{
			//die("oraAttuale < timePlusOne");
			$sql = "SELECT MAX(risposte.id_domanda)+1 as id_domande FROM `risposte` WHERE risposte.id_studente = " . $user["id"];
		}
			
		}else{		
		*/
			//die("nessuna delle 2");
			$sql = "SELECT MAX(svolgimento.domanda_corrente)+1 as id_domande FROM `svolgimento` WHERE svolgimento.id_studente = " . $user["id"];
		
		//}//ho aggiunto questa parentesi
		
		//fine parte nuova 03/02/2020 21:04:44 
		//=================================================
		
		$result = $conn->query($sql);

			
		
		if ($result->num_rows > 0) {
			
			$row = $result -> fetch_assoc();
			//echo $row["MAX(risposte.id_domanda)+1"];
			if(!is_null($row["id_domande"])){
				$num_domanda = $row["id_domande"];
				
			}else{
				$num_domanda = 1;
				
			}
			
			$sql = "SELECT COUNT(*) FROM `domande`";
			$result = $conn->query($sql);
			
			
			
			if ($result->num_rows > 0) {
			$row = $result -> fetch_assoc();
			//echo $row["MAX(risposte.id_domanda)+1"];
				$num_records = $row["COUNT(*)"];
			}
			
			
			
			if($num_domanda <= $num_records){
			    $sql = "SELECT domanda, `id`,`risp1`,`risp2`,`risp3`,`risp4`,`linkImmagine` FROM `domande` WHERE domande.id = ". $num_domanda;
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
				    //echo "ok";
					$row = $result -> fetch_assoc();
					
					/*$tmp = array();
				    $tmp['id'] = $row['id'];
					$tmp['r1'] = $row['risp1'];
                    $tmp['r2'] = $row['risp2'];
                    $tmp['r3'] = $row['risp3'];
                    $tmp['r4'] = $row['risp4'];
                    $tmp['link'] = $row['linkImmagine'];
					*/
					
					
					
					$controllo = "SELECT risposte.risposta_data FROM `risposte` WHERE risposte.id_studente = ".$user['id']." AND risposte.id_domanda = ".$row['id'];
					
					$risultato_controllo = $conn->query($controllo);
					//die($risultato_controllo->num_rows . "okay va");
					if($risultato_controllo->num_rows > 0 ){
						
						$risultato_riga = $risultato_controllo -> fetch_assoc();
						
						$controllo_domanda = true;
						$controllo_numero = $risultato_riga['risposta_data'];
					}else{
						$controllo_domanda = false;
					}
					
					
					
					
					$_SESSION['ND'] = $row['id'];
					
					$arr = array('controllo' => $controllo_domanda,'controllo_n' =>$controllo_numero,'id' => $row['id'], 'domanda' => $row['domanda'], 'r1' => $row['risp1'], 'r2' => $row['risp2'], 'r3' => $row['risp3'], 'r4' => $row['risp4'], 'link'=>$row['linkImmagine']); 
					$data = json_encode($arr);
					echo $data;
					///print_r($arr);
					//$data = json_encode($tmp);
					//echo $data;
					//die("okay -> " . $tmp);
				}else{
					//to do
					//echo "nessun record";
				}
			}		
			
		}
		
		//jhj
	}
	//echo $risposta[R1_COL];
	
	//return $risposta;
#echo "<br>";
#print_r($_SESSION);  //<---- QUI $_SESSION['ND'] ESISTE
?>
