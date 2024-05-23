<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *"); // Permitir acesso de qualquer origem
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header('Access-Control-Allow-Methods: POST');
header("Content-Type: application/json");

// definições de host (servidor onde está o banco), database (nome), usuário e senha 
$host = "127.0.0.1";  
$user = "root"; 
$pass= ""; 
$db = "teste";

$con = new mysqli($host, $user, $pass, $db); 

if ($con->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Verifica se os dados foram enviados
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe os dados enviados
    $data = json_decode(file_get_contents('php://input'), true);

    // Verifica se os dados estão presentes e têm o formato esperado
    if (isset($data[0]['nome']) && isset($data[0]['idade']) && isset($data[0]['cod_curso'])) {
        // Obtém os dados
        $nome = $data[0]['nome'];
        $idade = $data[0]['idade'];
        $cod_curso = $data[0]['cod_curso'];

        // Prepara a consulta SQL
        $query = "INSERT INTO aluno (nome, idade, cod_curso) VALUES ('$nome', $idade, $cod_curso)";
echo $query;
        // Executa a consulta SQL
        if (mysqli_query($con, $query)) {
            echo json_encode(array("message" => "Cadastrado com sucesso"));
        } else {
            echo json_encode(array("message" => "Erro ao cadastrar aluno: " . mysqli_error($con)));
        }
    } else {
        echo json_encode(array("message" => "Dados ausentes ou formato inválido"));
    }
} else {
    echo json_encode(array("message" => "Método de requisição inválido"));
}

// Fecha a conexão com o banco de dados
mysqli_close($con);
?>
