<?php
include 'conexao.php'; // Inclui o arquivo de conexão ao banco de dados

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe os dados do formulário
    $codigo = $_POST["codigo"];
    $fabricante = $_POST["fabricante"];
    $cor = $_POST["cor"];
    $numero_serie = $_POST["numero-serie"];
    $descricao = $_POST["descricao"];
    $departamento = $_POST["departamento"];

    // Sanitiza os dados para evitar injeção de SQL
    $codigo = mysqli_real_escape_string($con, $codigo);
    $fabricante = mysqli_real_escape_string($con, $fabricante);
    $cor = mysqli_real_escape_string($con, $cor);
    $numero_serie = mysqli_real_escape_string($con, $numero_serie);
    $descricao = mysqli_real_escape_string($con, $descricao);
    $departamento = mysqli_real_escape_string($con, $departamento);

    // SQL para inserir os dados na tabela 'patrimonio'
    $sql = "INSERT INTO patrimonio (codigo, fabricante, cor, n_serie, descricao, fk_departamento_nome	
) 
            VALUES ('$codigo', '$fabricante', '$cor', '$numero_serie', '$descricao', '$departamento')";

if (mysqli_query($con, $sql)) {
    $message = "Sucesso."; // Mensagem de sucesso
} else {
    $message = "Erro: " . mysqli_error($con); // Mensagem de erro
}

// Redireciona para o formulário com a mensagem
header("Location: index.html?message=" . urlencode($message));
exit();
}

// Fechar a conexão
mysqli_close($con);
?>
