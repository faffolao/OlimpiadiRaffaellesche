<?php 
    require ("../db_con.php");
    
    $query = "SELECT iscrizioniAperte as info FROM settings";
    $result = $conn->query($query);
    
    $row = $result->fetch_assoc();
    
    if($row['info'] == 0){
        $risposta["info"] = false;        
        echo json_encode($risposta);
    } else {
        $risposta["info"] = true;
        echo json_encode($risposta);
    }
?>