<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="utf-8" />
    <META name="viewport" content="width=device-width, initial-scale=1.0" />	
    <title>Importazione scuole</title>
    
    <LINK rel="icon" href="../../img/logo_black.png">
	
    <!-- inizio importazione bootstrap e jquery -->
    <SCRIPT src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></SCRIPT>
    <SCRIPT src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" INTEGRITY="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" CROSSORIGIN="anonymous"></SCRIPT>
    <LINK rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" INTEGRITY="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" CROSSORIGIN="anonymous">
    <SCRIPT src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" INTEGRITY="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" CROSSORIGIN="anonymous"></SCRIPT>
    <!-- fine importazione bootstrap e jquery-->
    
    <LINK href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">
    
    <style>
        @font-face{
            font-family: Butler;
            src: url("../../res/Butler.woff");
        }

        h2{font-family: Butler, sans-serif;}
        *{font-family: 'Nunito', sans-serif;}
        
        .correct{color: forestgreen;}
        .error{color: red; font-weight: bold;}
    </style>
</head>

<body>
    <div class="container">
        <img src="../../img/logo_black.png" width="50">
        <h2>Importazione scuole</h2>
        <p>Scuole importate:</p>
        <ul>
        <?php
        require_once '../../db_con.php';

        /****************************
         * PARTE 1: CARICAMENTO CSV IN UNA CARTELLA TEMPORANEA
         */

        ini_set("display_errors", "1");
        $target_dir = "./";
        $target_file = $target_dir . basename($_FILES["csvfile"]["name"]);
        $uploadOk = 1;
        $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // controllo se già esiste il file
        if (file_exists($target_file)) {
            echo "File già esistente.<br>";
            $uploadOk = 0;
        }

        // controllo se il file è csv
        if($fileType != "csv"){
            echo "E' possibile importare scuole solamente da file CSV.<br>";
            $uploadOk = 0;
        }

        // controllo se ci sono stati errori precedentemente
        if($uploadOk == 0){
            die("Impossibile processare il file CSV. Importazione annullata.");
        }else{
            if (move_uploaded_file($_FILES["csvfile"]["tmp_name"], $target_file)) {
                // file uploadato correttamente
                // esecuzione funzione di lettura csv
                $row = letturaFile($conn, basename($_FILES["csvfile"]["name"]));

                // eliminazione del file utilizzato per l'importazione
                unlink(basename($_FILES["csvfile"]["name"]));

                // fine importazione
            } else {
                die("Impossibile caricare il file CSV. Importazione annullata.");
            }
        }

        /*************************
         * PARTE 2: LETTURA CSV E INSERIMENTO DATI SU DB
         */

        function letturaFile($conn, $filepath){
            $row = 0;

            if(($handle = fopen($filepath, "r")) !== FALSE){
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    $cod_meccanografico = $data[0];
                    $nome = $data[1];
                    $via = $data[2];
                    $nCivico = $data[3];
                    $nomeComune = $data[4];
                    $provincia = $data[5];
                    $cap = $data[6];

                    inserisciSuDatabase($conn, $cod_meccanografico, $nome, $via, $nCivico, $nomeComune, $provincia, $cap);
                    $row++;
                }
                fclose($handle);
            }

            return $row;
        }

        function inserisciSuDatabase($conn, $cod_meccanografico, $nome, $via, $nCivico, $nomeComune, $provincia, $cap){
            $query = sprintf("INSERT INTO scuole (cod_meccanografico, nome, via, nCivico, nomeComune, provincia, cap) "
                    . "VALUES ('%s', '%s', '%s', %d, '%s', '%s', '%s')", $cod_meccanografico, $nome, $via, $nCivico, $nomeComune, 
                    $provincia, $cap);

            if($conn->query($query)):
            ?>
            <li class="correct"><?php echo $cod_meccanografico; ?></li>
            <?php
            else:
            ?>
            <li class="error">Impossibile importare la scuola <?php echo $cod_meccanografico; ?>: <?php echo $conn->error; ?> </li>
            <?php endif;
        }
        ?>
        </ul>
        <p>Sono state correttamente importate <?php echo $row; ?> scuole</p>
        <button class="btn btn-primary" onclick="window.location.href = '.';">Torna indietro</button>    
    </div>
    
</body>

</html>
