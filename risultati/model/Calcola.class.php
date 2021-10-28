<?php
require "Domanda.class.php";

class Calcola{

	private $elencoDomande = [];


	function __construct() {
		require "../db_con.php";
		
		$sql = "SELECT `id`,`r_esatta` FROM `domande`";
		$result = $conn->query($sql) or die("errore");
		while($row = $result->fetch_assoc()) {
			$this->elencoDomande[$row["id"] - 1] = new Domanda($row["id"],$row["r_esatta"]);
		}
		//print_r($this->elencoDomande);
	}



	public function score($array){
		
		$punti = 0;
		$tempo = 0;
		
		for($i = 0; $i < count($this->elencoDomande); $i++){
			if($array[$i] != NULL){
				if($array[$i]->getRispostaData() == $this->elencoDomande[$i]->rispostaCorretta){
					$punti++;
					$tempo = $tempo + $array[$i]->getTempoRisposta();
				}
			}
		}
		
		$tmp = [];
		$tmp["punti"] = $punti;
		$tmp["tempo"] = $tempo;
			
		return $tmp;
		
	}

}
?>