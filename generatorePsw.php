<?
	// Imposto la lunghezza della password a 10 caratteri
	$lung_pass = 5;
	
	// Creo un ciclo for che si ripete per il valore di $lung_pass
	for ($x=1; $x<=$lung_pass; $x++)
	{
	  // Se $x è multiplo di 2...
	  if ($x % 2){
		 // Aggiungo una lettera casuale usando chr() in combinazione
		 // con rand() che genera un valore numerico compreso tra 97
		 // e 122, numeri che corrispondono alle lettere dell'alfabeto
		 // nella tabella dei caratteri ASCII
		 $mypass = $mypass . chr(rand(97,122));
	
	  // Se $x non è multiplo di 2...
	  }else{
		 // Aggiungo alla password un numero compreso tra 0 e 9
		 $mypass = $mypass . rand(0,9);
	  }
	}
	
	// Stampo a video il risultato
	echo $mypass;
?>