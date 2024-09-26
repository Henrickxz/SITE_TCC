<?php
include 'conexao.php'; // Inclui o arquivo de conexão ao banco de dados

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe os dados do formulário
    $nome_departamento = $_POST["nome-departamento"];

    // Sanitiza os dados para evitar injeção de SQL
    $nome_departamento = mysqli_real_escape_string($con, $nome_departamento);

    // SQL para inserir os dados na tabela 'departamento'
    $sql = "INSERT INTO departamento (nome) VALUES ('$nome_departamento')";

    if (mysqli_query($con, $sql)) {
        // Mensagem de sucesso
        echo "Sucesso ao cadastrar o departamento: " . htmlspecialchars($nome_departamento);
    } else {
        echo "Erro ao cadastrar: " . mysqli_error($con);
    }
}