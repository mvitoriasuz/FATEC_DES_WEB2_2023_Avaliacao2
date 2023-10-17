<?php
require_once('header.php');
require_once('dados_banco.php');

$aluno = $_POST['aluno'];
$placa = $_POST['placa'];

//Validar session
if (!isset($_SESSION["username"])) {
    
    // Redireciona o usuário para a página "cadastro.php" se a variável de sessão não estiver definida.
    header("location: cadastro.php");
    
    // Encerra a execução do script.
    exit; 
    
}

 // Verifica se a requisição é um POST (geralmente quando um formulário é submetido).
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    // Recupera os valores enviados via POST
    $aluno = $_POST['aluno'];
    $placa = $_POST['placa']; 
    
    // Verifica se o comprimento da string na variável $aluno é maior que 15.
    if (strlen($aluno) > 15) {
        header("location: cadastro.php");
        exit; 
    }

    try {
        // Inicia uma seção "try" para capturar exceções (erros) que podem ocorrer.
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

        // Cria uma conexão com o banco de dados usando o PDO.
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Prepara uma consulta SQL para inserir dados na tabela "veiculos" com parâmetros nomeados ":aluno" e ":placa".
        $stmt = $pdo->prepare("INSERT INTO veiculos (aluno, placa) VALUES (:aluno, :placa)");

        // Vincula os valores das variáveis aos parâmetros nomeados na consulta.
        $stmt->bindParam(':aluno', $aluno);
        $stmt->bindParam(':placa', $placa);

        // Executa a consulta.
        $stmt->execute();
        

        header("location: cadastro.php");
        
      // Captura exceções PDO (erros) que podem ocorrer durante a execução do código no "try".  
    } catch (PDOException $e) {

        // Exibe uma mensagem de erro caso ocorra uma exceção.
        echo "Erro: " . $e->getMessage();
    }
}

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
        <h1>
            <?php echo $_SESSION["username"]; ?>
            <br>
        </h1>
    </div>
    <p>
        Aluno: <b>
            <?php echo $aluno; ?>
    </b>cadastrado com sucesso.
    <br><br>
        <a href="principal.php" class="btn btn-primary">Voltar</a>
    <br><br>
    </p>
</body>
</html>