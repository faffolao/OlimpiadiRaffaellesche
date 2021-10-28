<?php 
    require("../db_con.php");
    
    session_start();
    
    $session_name = "qruser";
    $user = json_decode($_SESSION[$session_name], true);

    $query_risposte = sprintf("DELETE FROM risposte WHERE id_studente = %d", $user['id']);
    $query_caricato = sprintf("DELETE FROM caricato WHERE id_studente = %d", $user['id']);
	$query_svolgimento = sprintf("DELETE FROM svolgimento WHERE id_studente = %d", $user['id']);
    
    if($conn -> query($query_risposte) && $conn-> query($query_caricato) && $conn-> query($query_svolgimento)){
        $risposta["status"] = true;
        $risposta["text"] = "SUCCESS: Ripristino tentativo Quiz completato. Ricaricare la pagina per effettuare un nuovo tentativo del Quiz.";
        echo json_encode($risposta);
    }else{
        $risposta["status"] = false;
        $risposta["text"] = "ERROR: Tentativo di ripristino Quiz fallito";
        echo json_encode($risposta);
    }
?>