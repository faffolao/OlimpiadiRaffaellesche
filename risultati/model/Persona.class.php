<?php
	
	class Persona {
			// attributi
		
		private $idUtente;
		private $username;
		private $nomeScuola;
		private $codiceMeccanografico;
		private $risposte = [];

		//metodi
		
		function __construct($idUtente, $username, $nomeScuola, $codiceMeccanografico) {
        	$this->idUtente = $idUtente;
			$this->username = $username;
			$this->nomeScuola = $nomeScuola;
			$this->codiceMeccanografico = $codiceMeccanografico;
		}

		public function getRisposte() {
				return $this->risposte;
		}

		public function setRisposta($array) {
				$this->risposte[$array->getIdDomanda() - 1] = new Risposta($array->getIdDomanda(), $array->getIdStudente(), $array->getRispostaData(), $array->getTempoRisposta());
		}
		
		public function getUsername(){
			return $this->username;
		}
		
		public function getCodiceMeccanografico(){
			return $this->codiceMeccanografico;
		}
		
		public function getNomeScuola(){
			return $this->idUtente;
		}
		
		public function getIdUtente(){
			return $this->idUtente;
		}
		
		
		
	}

?>