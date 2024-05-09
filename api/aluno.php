<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "teste";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Erro de conexão: ". $conn->connect_error);
}

// Receber o código do curso via GET
$cod_curso = $_GET['cod_curso'];

// Consulta para listar os aluno do curso
$query = "SELECT * FROM aluno WHERE cod_curso = '$cod_curso'";
$dados = mysqli_query($con, $query);
$valores = [];
while($d = mysqli_fetch_assoc($dados)){
    array_push($valores, $d);
}


echo json_encode($valores);

// Fechar conexão com o banco de dados
mysqli_close($con);
die();
?>