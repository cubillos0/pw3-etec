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
$curso_id = $_GET['curso'];

// Verificar se o código do curso foi informado
if (empty($curso_id)) {
    echo "Erro: Código do curso não informado.";
    exit;
}

// Consulta para listar os alunos do curso
$sql = "SELECT * FROM alunos WHERE curso_id = '$curso_id'";
$result = $conn->query($sql);

// Verificar se há resultados
if ($result->num_rows > 0) {
    echo "<h1>Alunos do curso $curso_id</h1>";
    echo "<ul>";
    while($row = $result->fetch_assoc()) {
        echo "<li>". $row["nome"]. " (". $row["matricula"]. ")</li>";
    }
    echo "</ul>";
} else {
    echo "Nenhum aluno encontrado para o curso $curso_id.";
}

// Fechar conexão com o banco de dados
$conn->close();
?>