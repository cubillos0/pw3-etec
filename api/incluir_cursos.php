<?php
header("Content-Type: application/json");

// definições de host (servidor onde está o banco), database (nome), usuário e senha 
$host = "127.0.0.1";  
$user = "root"; 
$pass= ""; 
$db = "teste";

$con = new mysqli($host, $user, $pass, $db); 

// Verifique a conexão
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// Obtenha os dados enviados via POST
$data = json_decode(file_get_contents("php://input"), true);

// Prepare a consulta SQL
$stmt = $conn->prepare("INSERT INTO cursos (curso, vagas, periodo, ano, semestre) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sisis", $data['curso'], $data['vagas'], $data['periodo'], $data['ano'], $data['semestre']);

// Execute a consulta
if ($stmt->execute()) {
    // Curso cadastrado com sucesso
    echo json_encode(array("message" => "Curso cadastrado com sucesso"));
} else {
    // Erro ao cadastrar o curso
    echo json_encode(array("message" => "Erro ao cadastrar o curso: " . $stmt->error));
}

// Feche a conexão e a instrução
$stmt->close();
$conn->close();
?>
