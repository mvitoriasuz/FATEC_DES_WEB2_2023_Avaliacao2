<?php

    
    require_once('header.php');
    require_once('dados_banco.php');

//session_start();


// Verifica se a solicitação HTTP não é um POST.
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("location: registros.php");
    exit();
}

// Verifica se o "online" não está definida ou se é falsa.
if (!isset($_SESSION["online"]) || !$_SESSION["online"]) {
    header("location: index.php");
    exit();
}

try {

    // Define a string de conexão com o banco de dados usando informações de "dados_banco.php".
    $dsn = "mysql:host=$servername;dbname=$dbname";

    // Cria uma instância da classe PDO para conectar no BD.
    $conn = new PDO($dsn, $username, $password);

     // Define o modo de erro da conexão como "ERRMODE_EXCEPTION".
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    //Vendo se é do tipo POST
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        
        //Valor do campo "placa_id" enviado no formulário POST.
        $placa_id = $_POST["placa_id"];
        
        // Define uma consulta SQL para selecionar
        $sql = "SELECT * FROM registro WHERE veiculos_id = :placa_id";
        
        // Prepara a consulta 
        $stmt = $conn->prepare($sql);
        
        // Vincula o valor de "placa_id" na consulta SQL.
        $stmt->bindParam(":placa_id", $placa_id);
        
        //Realiza a consulta 
        $stmt->execute();
    }

    
} catch (PDOException $e) {
    // Em caso de erro, exibe a mensagem de erro.
    echo $sql . "<br>" . $e->getMessage();
}
$conn = null;

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

    <div class="form-group">
            <label>Data e Hora em que existe registro de entrada/saída</label><br>
            <?php

            //Verifica se a solicitação é um POST e se $stmt está definido
            if ($_SERVER["REQUEST_METHOD"] === "POST" && $stmt) {

                // Inicia um loop para percorrer os resultados da consulta.
                while ($row = $stmt->fetch()) {

                    // Exibe a data e hora dos registros encontrados.
                    echo "<strong>Data e Hora:</strong> " . $row["data_hora"] . "<br>";
                }
              // Se a condição não for atendida (não é um POST ou $stmt está vazio), exibe a mensagem abaixo
            } else {
                echo "Não há registros de entrada/saída.";
            }
            ?>
    </div>
    <a href="principal.php" class="btn btn-primary">Voltar</a>
    <br><br>

    </p>
</body>
</html>