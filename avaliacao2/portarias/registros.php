<?php
    require_once('header.php');
    require_once('dados_banco.php');

    try {
        // Define a string de conexão com as variáveis do servidor e do banco de dados.
        $dsn = "mysql:host=$servername;dbname=$dbname";

        // Cria uma instância da classe PDO para estabelecer a conexão com o banco de dados.
        $conn = new PDO($dsn, $username, $password);

        // Define o modo de erro do objeto PDO para "ERRMODE_EXCEPTION".
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Define a consulta SQL para selecionar os registros
        $sql = "SELECT * FROM veiculos";
    }catch(PDOException $e){

        // Se ocorrer uma exceção (erro), exibe a consulta SQL que causou o erro e a mensagem de erro.
        echo $sql . "<br>" . $e->getMessage();
    }

    // Executa a consulta SQL e armazena o resultado em $stmt.
    $stmt = $conn->query($sql);
    $conn = NULL;
?>
 
<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <title>Portaria Fatec</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <div class="page-header">
        <h2>
            <?php echo $_SESSION["username"]; ?>
            <br>
        </h2>
    </div>
    <p>

    <form action="registros_encontrados.php" method="POST">
        <div class="form-group">
            <label>Selecione o aluno</label>
            <br>
            <select name="placa_id">
                <?php
                    while ($row = $stmt->fetch()) {
                        print "<option value=". $row['id'].">". $row['placa']."</option>";
                    }
                ?>
            </select>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Acessar">
        </div>
    </form>

    <a href="principal.php" class="btn btn-primary">Voltar</a>
    <br><br>

    </p>
</body>
</html>