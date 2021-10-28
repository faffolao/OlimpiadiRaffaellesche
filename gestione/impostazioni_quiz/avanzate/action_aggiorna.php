<?php 
    include("../../../db_con.php");
    $count = 0; $i = 1;
    
    /* FASE 0 */
    $query = "TRUNCATE appoggio";
    $result = $conn->query($query) or die("ERROR [query_00]: " . mysqli_error($conn));
    
    /* FASE 1 */
    $query = "SELECT oraInizio as ora, DATE_FORMAT(NOW(), '%Y-%m-%d') as data FROM settings";
    $result = $conn->query($query) or die("ERROR [query_01]: " . mysqli_error($conn));
    $row = $result->fetch_assoc();
    $data = strval($row['data']);
    $ora = strval($row['ora']);
    
    /* FASE 2 */
    $query = "SELECT count(*) as n_domande FROM domande";
    $result = $conn->query($query) or die("ERROR [query_02]: " . mysqli_error($conn));
    $row = $result->fetch_assoc();
    $n_domande = $row['n_domande'];
    
    /* FASE 3 */
    while($count < $n_domande){
        $query = sprintf("SELECT MAX(id) as id FROM domande WHERE id = %d", $i);
        $result = $conn->query($query) or die("ERROR [query_while_".$i."]: " . mysqli_error($conn));
        $row = $result->fetch_assoc();
        //$row['id'] = id domanda ==> minuti da aggiungere
        
        list($dd, $mm, $yy) = explode("-", $data);
        list($h, $m, $s) = explode(":", $ora);
        
        $time = mktime($h, $m+($row['id']-1), $s, $mm, $dd, $yy);
        $time_prova = date("H:i:s", $time);
        
        $query = sprintf("INSERT INTO appoggio (id_domanda, ora) value (%d, '%s')", $row['id'], $time_prova);
        $conn->query($query) or die("ERROR [query_insert]: " . mysqli_error($conn));
        
        $i++; $count++;
    }
    
    header("Location: ./");
?>