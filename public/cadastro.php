<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../style/style.css">
<title>Cadastro</title>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caso você não tenha cadastro ainda, crie seu cadastro:</title>
</head>

<body>
<div class="card">
    
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
    <h3>Crie seu cadastro</h3>
    <form method="post" action="create_tarefas.php">
      <input type="text" name="nome" placeholder="Usuário" required>
      <input type="password" name="senha" placeholder="Senha" required>
      <input type="email" name="email" placeholder="Email" required>

      <button type="submit">Entrar</button>
    </form>
    <a href="login.php">Clique aqui caso já tenha cadastro</a>
</div>

</body>
</html>

