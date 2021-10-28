<?php 
    session_start();
    include("../db_con.php");
    
    $risposta = array();
    
    $query = "SELECT betaAperta AS beta, DATE_FORMAT(dataApertura, '%Y-%m-%d') AS dataApertura, DATE_FORMAT(dataApertura, '%H:%i:%s') 
                AS oraApertura, DATE_FORMAT(NOW(), '%Y-%m-%d') AS dataCorrente, DATE_FORMAT(NOW(), '%H:%i:%s') 
                AS oraCorrente, oraInizio, oraFine FROM settings";
    
    $result = $conn->query($query) or die("Error: " . mysqli_error($conn));
    $row = $result->fetch_assoc();
    
    $dataApertura = $row["dataApertura"];   //data DB 
    $oraApertura = $row["oraApertura"];   //ora DB
    $oraInizio = $row['oraInizio'];
    $oraFine = $row['oraFine'];
    $currentData = $row["dataCorrente"];  //data attuale
    $currentOra = $row["oraCorrente"];  //ora attuale
    $betaAperta = $row["beta"];
    
    $session_name = "qruser";
    $user = json_decode($_SESSION[$session_name], true);
    
    $query_quiz = sprintf("SELECT * from caricato WHERE id_studente = %d", $user['id']);
    
    //SERVE COME CONTROLLO IN FASE DI BETA
    $analisi_quiz = $conn->query($query_quiz) or die("ERROR: " . mysqli_error($conn));
    
    
/*    
 * 
    $query = "SELECT DATE_FORMAT(oraInizio, '%i') AS minutiInizio, DATE_FORMAT(oraInizio, '%s') as secondiInizio, DATE_FORMAT(NOW(), '%i') AS minutiCorrenti, DATE_FORMAT(NOW(), '%s') AS secondiCorrenti FROM settings";
    
    $result = $conn->query($query) or die("Error: " . mysqli_error($conn));
    $row = $result->fetch_assoc();
    
    $minutiCorrenti = $row['minutiCorrenti'];
    $secondiCorrenti = $row['secondiCorrenti'];
    $minutiInizio = $row['minutiInizio'];
    $secondiInizio = $row['secondiInizio'];
*/    
    
    #echo $dataApertura . " data corrente --> ".$currentData ;
    #echo 'Valore booleano: '.(boolval($currentData == $dataApertura) ? 'true' : 'false')."\n";
    #die($minutiCorrenti . " " . $secondiCorrenti . " ciao " . $minutiInizio . " " . $secondiInizio);
    if($betaAperta == 1){
#        $risposta["aperto"] = true;
        $msg = "-- Sala D'Attesa Beta -- <br>La versione di BETA ha come unico scopo la verifica del funzionamento generale della piattaforma. <br>Questa e' la sala d'attesa, verrai reindirizzato alla beta del quiz: ";
        $_SESSION['aperto'] = true;         
    } else if($betaAperta == 0){
        if($currentData < $dataApertura){
            //QUIZ NON ANCORA DISPONIBILE (ES: GIORNO PRIMA)
#            $risposta["aperto"] = false;
#            $risposta["text"] = "Il Quiz iniziera' il giorno " . $dataApertura . " alle ore " . $oraApertura;
             $_SESSION['aperto'] = false;
             $_SESSION['text'] = "Il Quiz iniziera' il giorno " . $dataApertura . " alle ore " . $oraApertura;
#            echo json_encode($risposta);    
            #die("quiz disponibile il giorno " . $dataApertura . " alle ore " . $oraApertura);
        } else if($currentData > $dataApertura) {
            //QUIZ TERMINATO (ES: GIORNO DOPO)
#            $risposta["aperto"] = false;
#            $risposta["text"] = "Quiz terminato il giorno " . $dataApertura . " alle ore " . $oraFine;
            $_SESSION['aperto'] = false;
            $_SESSION['text'] = "Quiz terminato il giorno " . $dataApertura . " alle ore " . $oraFine;
            
#            echo json_encode($risposta);
        } else if($currentData == $dataApertura){
            //die($currentData . " " . $dataApertura);
            if($currentOra < $oraApertura){
                //QUIZ CHIUSO / NON DISPONIBILE 
#               $risposta["aperto"] = false;
#               $risposta["text"] = "Quiz non ancora disponibile. Apertura alle ore: " . $oraApertura;
                $_SESSION['aperto'] = false;
                $_SESSION['text'] = "Quiz non ancora disponibile. Apertura alle ore: " . $oraApertura;
                
#                echo json_encode($risposta);
                #die("Quiz non aperto"); //POP-UP NELLA INDEX X DIRE CHE IL QUIZ NON E' ANCORA APERTO
            } else {
                //ENTRA SOLO SE IL QUIZ E' APERTO
                if($currentOra > $oraFine){
#                    $risposta["aperto"] = false;
#                    $risposta["text"] = "Quiz terminato il giorno " . $dataApertura . " alle ore ". $oraFine;
                    $_SESSION['aperto'] = false;
                    $_SESSION['text'] = "Quiz terminato il giorno " . $dataApertura . " alle ore ". $oraFine;
                    
#                    echo json_encode($risposta);
                }else if($currentOra < $oraInizio){
                    //GESTIONE REDIRECT PAGINA REVISIONE
#                    $msg = "Quiz Aperto -- Attendere per l'inizio del quiz: [".$oraInizio."]";
#                    $risposta["aperto"] = true;
                    $msg = "Quiz Aperto -- Attendere per l'inizio del quiz: [".$oraInizio."]";
                    $_SESSION['aperto'] = true;
                    //header("location:./attesa");  
                }else if($currentOra > $oraInizio && $currentOra < $oraFine){
#                    $risposta["aperto"] = false;
#                    $risposta["text"] = "Impossibile participare al Quiz: Quiz in fase di svolgimento.";
                    $_SESSION['aperto'] = false;
                    $_SESSION['text'] = "Impossibile participare al Quiz: Quiz in fase di svolgimento.";
                    
#                    echo json_encode($risposta);
                }
            }
        }
    }
?>