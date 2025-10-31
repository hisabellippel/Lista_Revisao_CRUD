<?php
include '../includes/conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $user = $_POST["nome"] ?? "";
    $pass = $_POST["senha"] ?? "";
    $email = $_POST['email'] ?? "";
    $cep = $_POST['cep'] ?? "";

    $url = "https://viacep.com.br/ws/" . $cep . "/json/";
    $dados_json = file_get_contents($url);
    $dados = json_decode($dados_json, true);

    // API ViaCep
    $url = "https://viacep.com.br/ws/" . $cep . "/json/";
    $dados_json = @file_get_contents($url); 
    $dados = json_decode($dados_json, true);

  
    $pass = password_hash($pass, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nome, senha, email) VALUES ('$user', '$pass', '$email')";

    if ($dados && !isset($dados['erro'])) {
        echo "<h2>Resultado da Pesquisa</h2>";
        echo "<p><b>CEP:</b> " . $dados['cep'] . "<br>";
    }

    if ($conn->query($sql) === true) {
        echo "Novo registro criado com sucesso.";
    } else {
        echo "Erro ao inserir no banco: " . $conn->error;
    }

    $conn->close();
}
?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="../style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<header class= "cabecalho">
    <h1>Sistema de Gerenciamento de Tarefas</h1>
</header>

<body>
<h3>Cadastrar-se</h3>
    <div class="menu-container">
        <form method="post">
            <div class="c2">
                <input type="text" name="nome" placeholder="Insira seu nome" required>
            </div>
            <br>
            <div class="c2">
                <input type="password" name="senha" placeholder="Insira sua senha" required>
            </div>
            <br>
            <div class="c2">
                <input type="email" name="email" placeholder="Insira seu Email" required>
            </div>
            <br>
            <div class="c2">
                <input type="text" name="cep" placeholder="Buscar CEP" required>
            </div>

            <button type="submit">Entrar</button> <br>
            <a href="login.php">Clique aqui caso já tenha cadastro!</a>
        </form>
    </div>

</body>
</html>

