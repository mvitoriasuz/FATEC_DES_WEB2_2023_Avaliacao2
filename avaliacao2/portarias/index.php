<?php
 session_start();
 
 // Verifica se a solicitação é um POST
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Verifica se o login e senha estão conforme.
    if ($_POST["login"] == "fatec" && $_POST["senha"] == "portaria") {

        // Define a variável da sessão "online" como V.
         $_SESSION["online"] = true;

         // Define o nome do usuário nessa variável
         $_SESSION["username"] = "Portaria Fatec";

         // Redireciona o usuário para "principal.php".
         header("Location: principal.php");
         exit;
     } else {
         $mensagem = "Acesso incorreto! Tente novamente.";
     }
 } 
?>
 
<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <title>Acessar</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Acessar</h2>
        <p>Favor inserir login e senha.</p>
        <form action="index.php" method="POST">
            <div class="form-group">
                <label>Nome</label>
                <input type="text" name="login" class="form-control" value="fatec">
                <span class="help-block"></span>
            </div>    
            <div class="form-group">
                <label>Senha</label>
                <input type="password" name="senha" class="form-control" value="portaria">
                <span class="help-block"></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Acessar">
            </div>
        </form>
    </div>    
</body>
</html>