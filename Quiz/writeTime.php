<?php
	session_start();
	require "../db_con.php";
	require "../lib/costanti.php";
	$session_name = "qruser";

	if(!isset($_SESSION[$session_name])) {

		header("location:../login/");
		
	} else {

		$user = json_decode($_SESSION[$session_name], true);
		
		$sql = "INSERT INTO `caricato`".
		"( `id_studente`, `id_domanda`, `ora_caricamento`)".
		" VALUES (" . $user["id"] . "," . $_SESSION['ND'] . ",CURRENT_TIMESTAMP)";
		$conn->query($sql);
	}
		
#echo "<br>";
#print_r($_SESSION);    <-- QUI LA VARIABILE $_SESSION['ND'] ESISTE ED E' VALORIZZATA
?>