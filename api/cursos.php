<?php
	header("Content-Type: application/json; charset=UTF-8");
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: GET');
	
// definições de host (servidor onde está o banco), database (nome), usuário e senha 
$host = "127.0.0.1";  
$user = "root"; 
$pass= ""; 
$db = "teste";

$con = new mysqli($host, $user, $pass, $db); 

if ($con->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

		$query = "SELECT * FROM cursos"; 
		$dados = mysqli_query($con, $query); 
		
		while($d = mysqli_fetch_assoc($dados)){
			$valores[] = $d;
		}
		
		echo json_encode($valores);
		
		mysqli_close($con);
		die();	
?>