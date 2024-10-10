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

// Consultar dados da tabela Produto e Venda
$sql_produto = "SELECT * FROM Produto";
$result_produto = $conn->query($sql_produto);

$sql_venda = "SELECT * FROM Venda";
$result_venda = $conn->query($sql_venda);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login-style.css">
    <title>Visualizar Produtos e Vendas</title>
</head>
<body>
    <div class="container">
        <h1>Visualização de Produtos e Vendas</h1>
        
        <h2>Produtos</h2>
        <table>
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th>Peso</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result_produto->num_rows > 0): ?>
                    <?php while($row = $result_produto->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['Codigo_Produto']; ?></td>
                            <td><?php echo $row['Descricao_Produto']; ?></td>
                            <td><?php echo number_format($row['Preco_Produto'], 2, ',', '.'); ?></td>
                            <td><?php echo $row['Peso']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">Nenhum produto cadastrado.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <h2>Vendas</h2>
        <table>
            <thead>
                <tr>
                    <th>Número da Nota Fiscal</th>
                    <th>Valor Total</th>
                    <th>ICMS</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result_venda->num_rows > 0): ?>
                    <?php while($row = $result_venda->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['Numero_NF']; ?></td>
                            <td><?php echo number_format($row['ValorTotal_NF'], 2, ',', '.'); ?></td>
                            <td><?php echo $row['ICMS']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">Nenhuma venda cadastrada.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <br>
        <a href="index.php" class="btn-voltar">Voltar ao Cadastro</a>
    </div>
</body>
</html>

<?php
$conn->close();
?>
