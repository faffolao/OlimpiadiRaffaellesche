<?php

class Domanda{
	
	public $idDomanda;
	public $rispostaCorretta;
	
	function __construct($idDomanda, $rispostaEsatta) {
		$this->idDomanda = $idDomanda;
		$this->rispostaCorretta = $rispostaEsatta;
	}
	
}


?>
