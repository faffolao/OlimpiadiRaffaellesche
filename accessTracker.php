<?php 
// registrazione degli errori su file
ini_set("display_errors","0");
ini_set("error_log", "php_error_log.txt");

class accessTracker{
    
    /* tipologie :
     * 1 = login
     * 2 = attesa quiz
     * 3 = quiz iniziato
     * 4 = quiz terminato
     * 0 = logout
     * 100 = pagina attesa lasciata (tasto back del browser o home button premuta)
     * 101 = pagina quiz lasciata
     */
     
    public function registraAccesso($filename, $user, $type) {
        $array = $this->leggiJson($filename);
        $array[] = Array("utente" => intval($user), "tipologia" => $type);
        
        $this->scriviJson($filename, $array);
    }
    
    private function leggiJson($filename){
        $string = file_get_contents($filename);
        $json = json_decode($string, true);
        
        return $json;
    }
    
    private function scriviJson($filename, $array){
        try{
            $file = fopen($filename,"w");
            fwrite($file, json_encode($array));
            fclose($file);
        } catch (Exception $ex) {
            die ("Errore durante il salvataggio degli accessi: " . $ex->getMessage());
        }
    }
    
    public function svuotaLogAccessi($filename){
        $this->scriviJson($filename, array());
    }
}
    
?>