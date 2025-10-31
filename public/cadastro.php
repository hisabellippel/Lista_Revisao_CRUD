<?php
include '../includes/conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $user = $_POST["nome"] ?? "";
    $pass = $_POST["senha"] ?? "";
    $email  = $_POST['email'] ?? "";

    $sql = " INSERT INTO usuarios (nome,senha,email) VALUE ('$user','$pass','$email')";

    if ($conn->query($sql) === true) {
        echo "Novo registro criado com sucesso.";
    } else {
        echo "Erro " . $sql . '<br>' . $conn->error;
    }
    $conn->close();
}
else {
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
        <form method="post" action="create_tarefas.php">
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
            <button type="submit">Entrar</button> <br>
            <a href="login.php">Clique aqui caso já tenha cadastro!</a>
        </form>
    </div>

</body>
</html>

