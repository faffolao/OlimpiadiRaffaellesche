<?php 
    include("../db_con.php");

    //TIMESTAMP DATE & ORA CORRENTE
    $query = "SELECT DATE_FORMAT(NOW(), '%Y-%m-%d') AS data, DATE_FORMAT(NOW(), '%H:%i:%s') as ora from settings";
    $result = $conn->query($query) or die("Error: " . mysqli_error($conn));
    $row = $result->fetch_assoc();
    
    //ORA DB PER JSON
    $oraDB = $row['ora'];
    
    $data = strval($row['data']);
    $ora = strval($row['ora']);

    list($dd, $mm, $yy) = explode("-", $data);
    list($h, $m, $s) = explode(":", $ora);

    $timeCurrent = mktime($h, $m, $s, $mm-6, $dd+9, $yy-4);
    
    //echo "TIMESTAMP: --> " . $timeCurrent . "<br>";
    
    //TIMESTAMP DATA & ORA QUIZ
    $query = "SELECT DATE_FORMAT(dataApertura, '%Y-%m-%d') AS data, DATE_FORMAT(oraInizio, '%H:%i:%s') as ora from settings";
    $result = $conn->query($query) or die("Error: " . mysqli_error($conn));
    $row = $result->fetch_assoc();
    
    $data = strval($row['data']);
    $ora = strval($row['ora']);
    
    list($dd, $mm, $yy) = explode("-", $data);
    list($h, $m, $s) = explode(":", $ora);
    
    $timeQuiz = mktime($h, $m, $s, $mm-6, $dd+9, $yy-4);
    
#    echo "TIMESTAMP: --> " . $timeQuiz;
    
    $current = (int)$timeCurrent;
    $quiz = (int)$timeQuiz;
    $rest = ($quiz-$current)*1000;
    
    $risposta["time"] = $rest;
    $risposta["currentTime"] = $oraDB;
    
    echo json_encode($risposta);
    
?>