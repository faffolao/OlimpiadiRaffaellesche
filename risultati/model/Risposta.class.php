<?php
	class Risposta {
		
		private $idDomanda;
		private $idStudente;
		private $rispostaData;
		private $tempoRisposta;
		
		function __construct($idDomanda, $idStudente , $rispostaData, $tempoRisposta) {
        	$this->idDomanda = $idDomanda;
			$this->idStudente = $idStudente;
			$this->rispostaData = $rispostaData;
			$this->tempoRisposta = $tempoRisposta;
		}
		
		
		public function getIdDomanda() {
				return $this->idDomanda;
		}
		
		public function getIdStudente() {
				return $this->idStudente;
		}
		
		public function getRispostaData() {
				return $this->rispostaData;
		}
		
		public function getTempoRisposta() {
				return $this->tempoRisposta;
		}
		
	}

?>