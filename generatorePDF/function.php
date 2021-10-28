<?php 

    require "../db_con.php";
    require "../index.php";

    $sql = "SELECT r_esatta FROM domande_albe";

    $risposteCorrette = [];


    $result3 = $conn->query($sql);

    while($row3 = $result3->fetch_assoc()){
        array_push($risposteCorrette,$row3["r_esatta"]);

        print_r($risposteCorrette);
    }

    function writeTotalScore($result3){
		$numero_domanda = 1;
		$totPunti = 0;
		while($row = $result3->fetch_assoc()) {
			if($row["risposta_data"] == $risposteCorrette[$numero_domanda]){
				$totPunti +=1;
			}else{
				$totPunti = $totPunti;				
		}
			$numero_domanda++;
		}
		echo "<td>".$totPunti."</td>";
		$result3->close();
	}

?>