<?php
    require_once "../../db_con.php";
    ini_set("display_errors","1");
    error_reporting(E_ALL); 
    
    /*****************************
     * PARTE 1: CARICAMENTO DEL FILE ZIP E DEL FILE CSV
     */
    
    //$target_dir = "";
    $target_file_zip = "./" . basename($_FILES["zipfile"]["name"]);
    $target_file_csv = "./" . basename($_FILES["csvfile"]["name"]);
    
    $uploadOk_zip = 1;
    $uploadOk_csv = 1;  
    
    $zipFileType = strtolower(pathinfo($target_file_zip,PATHINFO_EXTENSION));
    $csvFileType = strtolower(pathinfo($target_file_csv,PATHINFO_EXTENSION));
    
    // controllo se i file esistono già
    if (file_exists($target_file_zip)) {
        echo "Il file ZIP esiste già.<br>";
        $uploadOk_zip = 0;
    }
    if (file_exists($target_file_csv)) {
        echo "Il file CSV esiste già.<br>";
        $uploadOk_csv = 0;
    }
    
    // controllo il tipo di file
    if($zipFileType != "zip"){
        echo "Sono ammessi solo file ZIP.<br>";
        $uploadOk_zip = 0;
    }
    if($csvFileType != "csv"){
        echo "Sono ammessi solo file CSV.<br>";
        $uploadOk_csv = 0;
    }
    
    // controllo se l'upload è possibile
    if($uploadOk_csv == 0 || $uploadOk_zip == 0){
        die("I tuoi file non sono stati accettati.");
    }else{
        if (move_uploaded_file($_FILES["zipfile"]["tmp_name"], $target_file_zip) &&  
            move_uploaded_file($_FILES["csvfile"]["tmp_name"], $target_file_csv)) {
            // caricamento file completato
            // scompattazione zip, copia dei file in immagini_quiz ed eliminazione zip
            importaImmagini(basename( $_FILES["zipfile"]["name"]));
            // importazione dati csv nel database
            importaInDatabase(basename( $_FILES["csvfile"]["name"]), $conn);
            // cancello file csv vecchio
            if (!unlink(basename( $_FILES["csvfile"]["name"]))) {  
                die (basename( $_FILES["csvfile"]["name"]) . " cannot be deleted due to an error");  
            }  
            // FINEEEEEEEEE!!!
            header("Location: .");
        } else {
            die("C'è stato un problema durante il caricamento dei tuoi file");
        }
    }
    
    function importaImmagini($filename){
        // scompattazione archivio in cartella temporanea
        $zip = new ZipArchive;
        if ($zip->open($filename) === TRUE) {
            $zip->extractTo('../../immagini_quiz/');
            $zip->close();
        } else {
            die("Errore durante l'estrazione dell'archivio ZIP");
        }
        
        // cancellazione zip
        if (!unlink($filename)) {  
            die ("$filename cannot be deleted due to an error");  
        }  
    }
    
    function importaInDatabase($filename, $conn){
        if (($handle = fopen($filename, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $domanda = $data[0];
                $r1 = $data[1];
                $r2 = $data[2];
                $r3 = $data[3];
                $r4 = $data[4];
                $resatta = $data[5];
                $link_immagine = $data[6];
                
                // insert query
                $sql = sprintf("INSERT INTO domande (domanda, risp1,risp2,risp3,risp4,r_esatta,linkImmagine) "
                        . "VALUES ('%s', '%s','%s','%s','%s',%d,'%s')", $domanda, $r1, $r2, $r3, $r4, $resatta, $link_immagine);
                if($conn->query($sql) === FALSE){
                    echo "Errore di inserimento di una domanda: " . $conn->error;
                }
            }
            fclose($handle);
        }

    }
?>