<?php
		
	require "Risposta.class.php";
	
	class ElencoRisposte {
		
		public $elencoRisposte = [];
		
		public function addRisposta($idStudente, $idDomanda , $rispostaData, $tempoRisposta){
			array_push($this->elencoRisposte, new Risposta($idDomanda, $idStudente , $rispostaData, $tempoRisposta));
		}
		
		
		public function getElencoRisposte($idStudente) {
			$elencoTmp = [];
			$num = count($this->elencoRisposte);
			for($i = 0 ; $i < $num; $i++ ){
				$tmp = $this->elencoRisposte[$i];
				if($tmp->getIdStudente() == $idStudente ){
					array_push($elencoTmp, $tmp);
				}
			}
			
			return $elencoTmp;
			
		}
		
		
	}



	

?>