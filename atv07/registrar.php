<?php 
// registrar.php 
require_once 'conexao.php'; // (Requer o arquivo de conexão PDO da Aula 6) 
$mensagem = ""; 
// 1. Verifica se o formulário foi enviado 
if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
$nome = $_POST['nome']; 
$email = $_POST['email']; 
$senha = $_POST['senha']; 
// 2. CONCEITO DA AULA 9: Criar o HASH da senha 
// Nunca salve a senha pura! 
$hash_senha = password_hash($senha, PASSWORD_DEFAULT); 
// 3. Salva no banco de dados 
try { 
$sql = "INSERT INTO usuarios (nome_completo, email, senha_hash) VALUES (?, ?, ?)"; 
$stmt = $pdo->prepare($sql); 
$stmt->execute([$nome, $email, $hash_senha]); 
$mensagem = "Usuário registrado com sucesso!"; 
} catch (PDOException $e) { 
$mensagem = "Erro ao registrar: " . $e->getMessage(); 
} 
} 
?> 
<!DOCTYPE html> 
<html lang="pt-br"> 
<head><title>Registrar</title></head> 
<body> 
<h1>Registre-se</h1> 
<?php if ($mensagem) echo "<p>$mensagem</p>"; ?> 
<form method="POST"> 
<label>Nome:</label> 
<input type="text" name="nome" required><br><br> 
<label>Email:</label> 
<input type="email" name="email" required><br><br> 
<label>Senha:</label> 
<input type="password" name="senha" required><br><br> 
<button type="submit">Registrar</button> 
</form> 
<br> 
<a href="login.php">Já tem conta? Faça login</a> 
</body> 
</html>
