<?php
    // Script per l'ottenimento di tutti i dati degli studenti dal DB per l'invio delle email
    
    // verifico che lo script non venga chiamato da un utente
    if (isset($_POST["robot"]) && $_POST["robot"] == 1){
        // connessione al database
        require_once ("../../../db_con.php");

        // query di selezione db
        $query = "SELECT username, password, email, email_secondaria FROM utenti WHERE tipoUtente = 0";
        $result = $conn->query($query);

        // costuzione json
        $dati = Array();
        while($row = $result->fetch_assoc()){
            array_push($dati, array($row["username"], $row["password"], $row["email"], $row["email_secondaria"]));
        }

        echo(json_encode($dati));
    }else{
        echo "Beda a gi";
    }
    
?>