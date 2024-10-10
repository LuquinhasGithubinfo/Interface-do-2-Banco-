<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Autenticação simples (exemplo)
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verifica se as credenciais estão corretas
    if ($username == 'admin' && $password == '1234') {
        $_SESSION['loggedin'] = true;
        header('Location: index.php');
        exit(); // Adicionando exit para garantir que o script pare após o redirecionamento
    } else {
        echo "Usuário ou senha inválidos.";
    }
}
?>
