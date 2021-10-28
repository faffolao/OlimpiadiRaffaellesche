<?php 
    require("../../db_con.php");
    require "../../logger.php";
    
    // registrazione degli errori su file
    ini_set("display_errors","0");
    ini_set("error_log", "../../php_error_log.txt");
    
    $cod_meccanografico = $_POST["cod_meccanografico"];
    $nome = $_POST["nome"];
    $via = $_POST["via"];
    $nCivico = $_POST["nCivico"];
    $cap = $_POST["cap"];
    $nomeComune = $_POST["nomeComune"];
    $provincia = $_POST["provincia"];
    $old_cod = $_POST["old_cod_meccanografico"];
    
    if(!empty($cod_meccanografico) && !empty($nome) && !empty($via) && !empty($nCivico) && !empty($cap) && !empty($nomeComune) && !empty($provincia) && !empty($old_cod)){
        if($conn->query("UPDATE `scuole` SET `cod_meccanografico`='" . $cod_meccanografico . "',`nome`='" . $nome . "',`via`='" . $via . "',`nCivico`='" . $nCivico . "',
                        `nomeComune`='" . $nomeComune . "',`provincia`='" . $provincia . "',`cap`='" . $cap . "' WHERE cod_meccanografico='" . $old_cod . "'")){
            Logger::writeToLog("../../log.json","log-mod-impostazioni-utenti","E' stata modificata la scuola n. " . $id);
            header("location: .");
        }else{
            die("Errore durante la modifica della scuola: " . $conn->error);
        }
    }
?>