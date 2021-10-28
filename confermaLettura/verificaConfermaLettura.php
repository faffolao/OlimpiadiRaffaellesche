<?php
    require_once '../db_con.php';
    require_once '../logger.php';
    
    if(isset($_GET["confirm"]) && !empty($_GET["confirm"])){
        // controllo se lo username che ha richiesto la conferma di lettura esiste
        $sql = sprintf("SELECT username FROM utenti WHERE tipoUtente = 0 AND username = '%s'", $_GET["confirm"]);
        $result = $conn->query($sql) or die($conn->error);
        
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            
            // username esistente, conferma inviata correttamente
            // la vado a registrare nel log e riinvio a pagina successo
            Logger::writeToLog("../log.json", "log-mod-impostazioni-utenti", "CONFERMA DI LETTURA:<br>L'utente "
                    . $row["username"] . " ha confermato di aver ricevuto correttamente le credenziali di accesso");
            header("Location: successo.php");
        }else{
            die("Impossibile confermare.");
        }
    }
?>