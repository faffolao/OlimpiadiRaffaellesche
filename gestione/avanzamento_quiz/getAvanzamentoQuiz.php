<?php
    require_once '../../db_con.php';
    
    $sql = "SELECT id_studente, id_domanda FROM risposte";
    if($result = $conn->query($sql)){
        while($row = $result->fetch_assoc()){
            $list[] = $row;
        }            
        echo json_encode($list);
    }
?>