<?php

$mysqli = new mysqli("localhost", "root", "root", "kanban_db");
if ($mysqli->connect_errno) {
    die("Erro de conexão: " . $mysqli->connect_error);
}

session_start();

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    echo "Sua sessão foi encerrada!";
    exit;
}

$msg = "";
if (isset($_GET['msg']) && $_GET['msg'] == 'expired') {
    $msg = "Sua sessão foi expirada!";
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST["nome"] ?? "";
    $email = $_POST["email"] ?? "";
    $pass = $_POST["password"] ?? "";

    
    $stmt = $mysqli->prepare("SELECT nome, email, senha FROM usuarios WHERE nome=? AND email=?");
    $stmt->bind_param("ss", $nome, $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $dados = $result->fetch_assoc();
    $stmt->close();

    //password_verify
    if (password_verify($pass, $dados["senha"])) {
    echo 'Senha válida!';
    } else {
    echo 'Senha inválida';
    }

    if ($dados) {
        $_SESSION["nome"] = $dados["nome"];
        $_SESSION["email"] = $dados["email"];
        header("Location: read_gerenciamento.php");
        exit;
    } else {
        $msg = "Usuário ou email incorretos!";
    }
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<header>
    <h1>Sistema de Gerenciamento de Tarefas</h1>
</header>

<body>
    <?php if (empty($_SESSION["email"])): ?>
       
        <div class="menu-container">
            
                <form method="POST">
    
                    <div class="c2">
                        <label for="nome"></label><br>
                        <input type="text" name="nome" id="nome" placeholder="Insira seu nome:" required>
                        <div class="error" id="erroNome"></div>
                    </div>
    
                    <br>
    
                    <div class="c2">
                        <label for="email"></label><br>
                        <input type="text" name="email" id="email" placeholder="Insira seu E-mail:" required>
                        <div class="error" id="erroEmail"></div> 
                    </div>
    
                    <br>
    
                    <div class="c2">
                        <label for="senha"></label><br>
                        <input type="password" name="password" id="senha" placeholder="Insira sua senha:" required> 
                        <div class="error" id="erroSenha"></div>
                    </div>
    
                    <br>
    
                    <button type="submit">Entrar</button> <br>
                    <a href="cadastro.php">Não tem cadastro? Se cadastre clicando aqui!</a>
                </form>
        </div>

    <?php else: ?>
        <?php if ($msg): ?><p class="msg"><?= $msg ?></p><?php endif; ?>
        <p>Você já está logado. <a href="?logout=1">Sair</a></p>
    <?php endif; ?>

</body>
</html>