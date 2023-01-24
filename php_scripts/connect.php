<?php
	$servername = "";
	$username = "";
	$password = "";
	$db = "";

	// Cria a conexão;
	$conn = new mysqli($servername, $username, $password, $db);

	// Verifica a conexão;
	if ($conn->connect_error) {
		die("Falha ao conectar: " . $conn->connect_error);
	}
?>
