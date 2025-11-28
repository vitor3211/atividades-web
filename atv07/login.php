<?php 
// login.php 
session_start(); // Inicia a sessão (Conceito da Aula 3) 
require_once 'conexao.php'; 
$mensagem = ""; 
if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
$email = $_POST['email']; 
$senha_digitada = $_POST['senha']; 
// 1. Busca o usuário pelo e-mail 
$sql = "SELECT * FROM usuarios WHERE email = ?"; 
$stmt = $pdo->prepare($sql); 
$stmt->execute([$email]); 
$usuario = $stmt->fetch(); 
// 2. CONCEITO DA AULA 9: Verifica a senha 
if ($usuario && password_verify($senha_digitada, $usuario['senha_hash'])) { 
// 3. Senha correta! Salva na sessão 
$_SESSION['usuario_id'] = $usuario['id']; 
$_SESSION['usuario_nome'] = $usuario['nome_completo']; 
// Redireciona para a página restrita 
header("Location: restrito.php"); 
exit; 
} else { 
$mensagem = "E-mail ou senha incorretos."; 
} 
} 
?> 
<!DOCTYPE html> 
<html lang="pt-br"> 
<head><title>Login</title></head> 
<body> 
<h1>Login</h1> 
<?php if ($mensagem) echo "<p>$mensagem</p>"; ?> 
<form method="POST"> 
<label>Email:</label> 
<input type="email" name="email" required><br><br> 
<label>Senha:</label> 
<input type="password" name="senha" required><br><br> 
<button type="submit">Entrar</button> 
</form> 
<br> 
<a href="registrar.php">Não tem conta? Registre-se</a> 
</body> 
</html> 
