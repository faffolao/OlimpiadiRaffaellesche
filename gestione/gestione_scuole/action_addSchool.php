<?php 
    require ("../../db_con.php");
    require '../../logger.php';
    
    // registrazione degli errori su file
    ini_set("display_errors","0");
    ini_set("error_log", "../../php_error_log.txt");
    
    $cod_meccanografico = $_POST["cod_meccanografico"];
    $nome_scuola = $_POST["nome"];
    $via = $_POST["via"];
    $nCivico = $_POST["nCivico"];
    $cap = $_POST["cap"];
    $comune = $_POST["nomeComune"];
    $provincia = $_POST["provincia"];
    
    if(!empty($cod_meccanografico) && !empty($nome_scuola) && !empty($via) && !empty($nCivico) && !empty($cap) && !empty($comune) && !empty($provincia)){
        if($conn->query("INSERT INTO `scuole`(`cod_meccanografico`, `nome`, `via`, `nCivico`, `nomeComune`, `provincia`, `cap`) 
                         VALUES ('" . $cod_meccanografico . "','" . $nome_scuola . "','" . $via . "','" . $nCivico . "','" . $comune . "','" . $provincia . "',
                         '" . $cap . "')")){
            Logger::writeToLog("../../log.json","log-mod-impostazioni-utenti","E' stata aggiunta la scuola " . $cod_meccanografico . " del comune di " . $comune);
            header("location: .");
        }else{
            die("Errore durante la creazione della scuola: " . $conn->error);
        }
    }
?>