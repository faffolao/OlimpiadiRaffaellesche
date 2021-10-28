<?php
    if(isset($_POST["confirm"]) && $_POST["confirm"] == "true"){
        require_once "../../accessTracker.php";
        require_once "../../logger.php";
        
        $at = new accessTracker();
        $at ->svuotaLogAccessi("../../accessi.json");
        Logger::writeToLog("../../log.json","log-mod-impostazioni-utenti","File JSON accessi svuotato.");
    }
?>