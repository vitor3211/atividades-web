<?php 
// restrito.php 
session_start(); 
// 1. Proteção da página: verifica se o usuário está logado 
if (!isset($_SESSION['usuario_id'])) { 
die("Acesso negado. Faça o login primeiro. <a href='login.php'>Login</a>"); 
} 
// 2. CONCEITO DA AULA 9: Prevenção de XSS 
// Pega o nome da sessão e trata com htmlspecialchars 
$nome_seguro = htmlspecialchars($_SESSION['usuario_nome'], ENT_QUOTES, 'UTF-8'); 
?> 
<!DOCTYPE html> 
<html lang="pt-br"> 
<head><title>Área Restrita</title></head> 
<body> 
<h1>Bem-vindo à Área Restrita!</h1> 
<p>Olá, <strong><?php echo $nome_seguro; ?></strong>!</p> 
<a href="logout.php">Sair</a> 
</body> 
</html>
