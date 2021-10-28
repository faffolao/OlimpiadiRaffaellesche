<?php 
    require_once '../../db_con.php';
    $query = "SELECT * FROM domande";
    
    $result = $conn->query($query);
    
    echo $result->num_rows;
    exit;
?>