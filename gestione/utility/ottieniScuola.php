<?php 
/* funzione per ottenere i dati della scuola tramite foreign key */

// registrazione degli errori su file
ini_set("display_errors","0");
ini_set("error_log", "../php_error_log.txt");

function ottieniScuola($id, $conn){
    $query = sprintf("SELECT nome, nomeComune, provincia FROM scuole WHERE id = %d", $id);
    $result = $conn->query($query);
    
    $row = $result->fetch_assoc();
    echo $row["nome"] . " - " . $row["nomeComune"] . ", " . $row["provincia"];
}
?>