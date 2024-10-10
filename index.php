<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    header('Location: login.html');
    exit;
}

// Configurações do banco de dados
$servername = "localhost";
$username = "root"; // seu usuário do banco de dados
$password = ""; // sua senha do banco de dados
$dbname = "vendas";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Inserir produtos e vendas no banco
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['cadastrar_produto'])) {
        // Captura os dados do produto
        $codigo = $_POST['codigo'];
        $descricao = $_POST['descricao'];
        $preco = $_POST['preco'];
        $peso = $_POST['peso'];

        // Verifica se o código já existe
        $check_sql = "SELECT * FROM Produto WHERE Codigo_Produto = '$codigo'";
        $check_result = $conn->query($check_sql);

        if ($check_result->num_rows > 0) {
            echo "Código do produto já existe. Tente outro.";
        } else {
            $sql = "INSERT INTO Produto (Codigo_Produto, Descricao_Produto, Preco_Produto, Peso) VALUES ('$codigo', '$descricao', '$preco', '$peso')";
            if ($conn->query($sql) === TRUE) {
                echo "Produto cadastrado com sucesso.";
            } else {
                echo "Erro: " . $conn->error;
            }
        }
    }

    if (isset($_POST['cadastrar_venda'])) {
        // Captura os dados da nota fiscal
        $numero_nf = $_POST['numero_nf'];
        $valor_nf = $_POST['valor_nf'];
        $icms = $_POST['icms'];
        
        $sql = "INSERT INTO Venda (Numero_NF, ValorTotal_NF, ICMS) VALUES ('$numero_nf', '$valor_nf', '$icms')";
        if ($conn->query($sql) === TRUE) {
            echo "Venda cadastrada com sucesso.";
        } else {
            echo "Erro: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login-style.css">
    <title>Cadastrar Produtos e Vendas</title>
</head>
<body>
    <div class="container">
        <h1>Cadastrar Produtos e Vendas</h1>
        
        <h2>Cadastrar Produto</h2>
        <form action="index.php" method="post">
            <label for="codigo">Código</label>
            <input type="number" id="codigo" name="codigo" required>
            
            <label for="descricao">Descrição</label>
            <input type="text" id="descricao" name="descricao" required>
            
            <label for="preco">Preço</label>
            <input type="number" id="preco" name="preco" step="0.01" required>
            
            <label for="peso">Peso</label>
            <input type="number" id="peso" name="peso" step="0.01" required>
            
            <input type="submit" name="cadastrar_produto" value="Cadastrar Produto">
        </form>

        <h2>Cadastrar Venda</h2>
        <form action="index.php" method="post">
            <label for="numero_nf">Número da Nota Fiscal</label>
            <input type="number" id="numero_nf" name="numero_nf" required>
            
            <label for="valor_nf">Valor da Nota Fiscal</label>
            <input type="number" id="valor_nf" name="valor_nf" step="0.01" required>
            
            <label for="icms">ICMS</label>
            <input type="number" id="icms" name="icms" step="0.01" required>
            
            <input type="submit" name="cadastrar_venda" value="Cadastrar Venda">
        </form>
        
        <br>
        <a href="visualizar.php" class="btn-voltar">Visualizar Banco</a>
        <a href="login.html" class="btn-voltar">Voltar para o Login</a>
    </div>
</body>
</html>

<?php
$conn->close();
?>
