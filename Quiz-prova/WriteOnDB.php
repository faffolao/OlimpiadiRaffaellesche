<?php
    session_start();
    require "../db_con.php";
    $session_name = "qruser";
    $user = json_decode($_SESSION[$session_name], true);
    $sql = "SELECT * FROM `risposte` WHERE id_studente = " . $user['id'] . " AND id_domanda = " . $_SESSION['domanda_corrente'];
    $result = $conn->query($sql) or die("ERROR q1: " . mysqli_error($conn));

    if($result->num_rows == 0){
        $sql = "SELECT COUNT(*) FROM `domande`";
        $result = $conn->query($sql) or die("ERROR q2: " . mysqli_error($conn));

        if($result->num_rows > 0){
            $row = $result -> fetch_assoc();
        }
        
        if($_SESSION['domanda_corrente'] <= $row['COUNT(*)']){
            $sql = "INSERT INTO `risposte`( `id_studente`, `id_domanda`, `risposta_data`, `tempo_risposta`) VALUES ('".$user['id']."','".$_SESSION['domanda_corrente']."','".$_REQUEST['risp']."',". $_SESSION['tempo'] .")";
            $result = $conn->query($sql) or die("ERROR q3: " . mysqli_error($conn));
            $risposta->check = true;                
        }
    }
?>