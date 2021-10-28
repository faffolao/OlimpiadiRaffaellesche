<?php
	session_start();
	require "../db_con.php";
	require "../lib/costanti.php";
	$session_name = "qruser";
	
	if(!isset($_SESSION[$session_name])) {

		  header("location:../login/");

	} else {
		$user = json_decode($_SESSION[$session_name], true);
		
		
		$sql = sprintf("INSERT INTO svolgimento (id_studente, domanda_corrente) VALUES (%d, %d)", $user['id'], $_SESSION['ND']);
		$conn -> query($sql) or die("ERROR: " .mysqli_error($conn));
	
	}
	
#	echo "<br>"; 
#	print_r($_SESSION);
	
?>
