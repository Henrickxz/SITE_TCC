<meta charset="utf-8">
<?php
    include 'conexao.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $login = $_POST["email"];
        $senha = $_POST["password"];
        $chave = $_POST["access-code"];

        // Consulta para verificar as credenciais
        $sql = "SELECT * FROM usuario WHERE login = '$login' AND chave = '$chave'";
        $result = mysqli_query($con, $sql);

        // Verificar se o usuário existe
        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            
            // Verificar se a senha está correta
            if ($user['senha'] === $senha) {
                // Login bem-sucedido, iniciar sessão e redirecionar
                session_start();
                $_SESSION['usuario'] = $user['login'];
                header("Location: index.html"); // Redireciona para a página principal
                exit();
            } else {
                echo"<script>alert('Senha incorreta.');</script>";
            }
        } else {
            echo"<script>alert('Usuário ou código de acesso inválido.');</script>";
        }
    }

    // Fechar a conexão (opcional, pois PHP fecha automaticamente no final)
    mysqli_close($con);
?>
