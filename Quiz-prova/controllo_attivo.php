<?php
    session_start();

	if(!isset($_SESSION['registrato'])){ $_SESSION['registrato'] = false; }

	$session_name = "qruser";
	$user = json_decode($_SESSION[$session_name], true);
	
	if($user['tipoUtente'] == 1){
		 header('Location:/');
	} else {
		if($user['tipoUtente'] == 0){
			if($_SESSION['registrato'] == false){
				require_once '../accessTracker.php';
				$at = new accessTracker();
				$at->registraAccesso("../accessi.json", $user["id"], 2);
				$_SESSION['registrato'] = true;
			}
		} else{
			header('Location:../');
		}
	}

	require "../db_con.php";
    
    $ritorno = array();
	if(!isset($_SESSION['domanda_caricata'])){ $_SESSION['domanda_caricata'] = 0; } 
    //Step 1
    $sql = "SELECT oraInizio, oraFine, DATE_FORMAT(NOW(),'%H:%i:%s') as ora_corrente, DATE_FORMAT(NOW(), '%Y-%m-%d') AS data  FROM settings";
    $result = $conn->query($sql) or die("query 1 non riuscita");
    $row = $result->fetch_assoc();
    $data = strval($row['data']);
    $ora_inizio = $row['oraInizio'];
    $ora_fine = $row['oraFine'];
    $ora_corrente = $row["ora_corrente"];
    
    //Step 2
    $sql = "SELECT MAX(id) as id FROM appoggio WHERE `ora` BETWEEN '".$ora_inizio."' AND '".$ora_corrente."'";
	$result = $conn->query($sql) or die("errore nella query n°2");
    if($result->num_rows == 1){
        
        $row = $result->fetch_assoc();
        $id = $row["id"];
		
        //Step 3
        $sql = "SELECT domande.domanda,domande.id,domande.risp1,domande.risp2,domande.risp3,domande.risp4,domande.linkImmagine,appoggio.ora "
        ."FROM domande "
        ."JOIN appoggio ON domande.id = appoggio.id_domanda "
        ."WHERE domande.id = " . $id;
		
		$sql_verifica = "SELECT domande.domanda, domande.id, domande.risp1,domande.risp2,domande.risp3,domande.risp4,domande.linkImmagine,appoggio.ora "
        ."FROM domande "
        ."JOIN appoggio ON domande.id = appoggio.id_domanda "
        ."WHERE domande.id = " . ($id+1);
				
        $result = $conn->query($sql);
		$verifica = $conn->query($sql_verifica);
        if($result->num_rows == 1 && $ora_corrente <= $ora_fine){
			$row = $result->fetch_assoc();
			if($_SESSION['domanda_corrente'] != $id){
				
				$query = sprintf("SELECT * FROM risposte WHERE id_studente = %d", $user['id']);
                $ritorno['da_caricare'] = true;
				$_SESSION['domanda_corrente'] = $id;
                $ritorno['finito'] = false; //chiave per stabilire quando è finito il quiz (quiz non finito)
                
				$ritorno['id'] = $row['id'];
				$ritorno['domanda'] = $row['domanda'];
				$ritorno['r1'] = $row['risp1'];
                $ritorno['r2'] = $row['risp2'];
                $ritorno['r3'] = $row['risp3'];
                $ritorno['r4'] = $row['risp4'];
                $ritorno['link'] = $row['linkImmagine'];
				
				$_SESSION['id'] = $row['id'];
				$_SESSION['domanda'] = $row['domanda'];
				$_SESSION['r1'] = $row['risp1'];
                $_SESSION['r2'] = $row['risp2'];
                $_SESSION['r3'] = $row['risp3'];
                $_SESSION['r4'] = $row['risp4'];
                $_SESSION['link'] = $row['linkImmagine'];
            }
            //Step 4
            $str_ora_corrente = strval($ora_corrente);
            $str_ora_inizio = strval($row['ora']);
            list($dd, $mm, $yy) = explode("-", $data);  //esplodo la data
            list($h_corrente, $m_corrente, $s_corrente) = explode(":", $str_ora_corrente); //esplodo l'ora corrente
            list($h_inizio, $m_inizio, $s_inizio) = explode(":", $str_ora_inizio);  //esplodo l'ora di inizio
            $time_ora_corrente = mktime($h_corrente, $m_corrente, $s_corrente, $mm-6, $dd+9, $yy-4); //ora corrente
            $time_ora_inizio = mktime($h_inizio, $m_inizio, $s_inizio, $mm-6, $dd+9, $yy-4); //ora inizio
            $secondi_rimanenti = ((int)$time_ora_corrente - (int)$time_ora_inizio);
            $ritorno['tempo'] = $secondi_rimanenti;
			$_SESSION['tempo'] = $secondi_rimanenti;
			

			$controllo = "SELECT risposte.risposta_data FROM `risposte` WHERE risposte.id_studente = ".$user['id']." AND risposte.id_domanda = ".$row['id'];
			
			$risultato_controllo = $conn->query($controllo);
			if($risultato_controllo->num_rows > 0 ){			
				$risultato_riga = $risultato_controllo -> fetch_assoc();
						
				$controllo_domanda = true;
				$controllo_numero = $risultato_riga['risposta_data'];
			}else{
				$controllo_domanda = false;
			}
			
			$ritorno['controllo'] = $controllo_domanda;
			$ritorno['controllo_n'] = $controllo_numero;
        }else{
            $ritorno['finito'] = true;  //chiave per stabilire quando è finito il quiz (quiz finito)
        }

        echo json_encode($ritorno);
    }
?>