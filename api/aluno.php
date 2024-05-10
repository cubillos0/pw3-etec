<?php

header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');

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
$id_curso = $_GET['cursos'];

// Verificar se o código do curso foi informado
if (empty($id_curso)) {
    echo json_encode(array("error" => "Código do curso não foi informado."));
    exit;
}

// Consulta para listar os alunos do curso
$query = "SELECT * FROM aluno WHERE cod_curso = '$id_curso'";
$result = $conn->query($query); // Correção aqui

// Verificar se há resultados
if ($result->num_rows > 0){
     $aluno = array();
     while ($row = $result->fetch_assoc()) {
         $aluno[] = array(
             "id" => $row["cod"],
             "nome" => $row["nome"],
             "curso" => $row["cod_curso"],
             "idade" => $row["idade"]
         );
     }
     echo json_encode($aluno); // Correção aqui
 } else {
     echo json_encode(array("message" => "Nenhum aluno encontrado para o curso $id_curso."));
}

// Fechar conexão com o banco de dados
$conn->close();
?>
