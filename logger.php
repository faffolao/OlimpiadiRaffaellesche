<?php 
// registrazione degli errori su file
ini_set("display_errors","0");
ini_set("error_log", "php_error_log.txt");
//ini_set( 'date.timezone', 'Europe/Rome' );

//setlocale(LC_TIME, 'ita', 'it_IT.utf8');

class Logger{
    private function getLog($file){
        $string = file_get_contents($file);
        $json_log = json_decode($string, true);
        
        return $json_log;
    }
    
    public static function writeToLog($file, $type, $text){     
        $log = self::getLog($file);
        $data = new DateTime("NOW");
        
        array_unshift($log, array("tipo" => $type, "testo" => $text, "dataOra" => $data->format('d-m-Y H:i:s')));
        
        self::save($file, $log);
    }
    
    private function save($file, $array){
        try{
            $fp = fopen($file,"w");
        
            fwrite($fp, json_encode($array));
            fclose($fp);
        } catch (Exception $ex) {
            die ("Errore durante la scrittura nel log: " . $ex->getMessage());
        }
    }
    
    public static function emptyLog($file){
        self::save($file, array());
    }
}

?>