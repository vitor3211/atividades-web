<?php 
require_once 'conexao.php'; 
$mensagem = ""; 
 
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['criar_nome'])) { 
      
    $nome = $_POST['criar_nome']; 
    $email = $_POST['criar_email']; 
 
    $sql = "INSERT INTO usuarios (nome_completo, email) VALUES (?, ?)"; 
    $stmt = $pdo->prepare($sql); 
     
    if ($stmt->execute([$nome, $email])) { 
        $mensagem = "Usuário criado com sucesso!"; 
    } else { 
        $mensagem = "Erro ao criar usuário."; 
    } 
} 
  
$stmt_read = $pdo->query($sql_read); 
$usuarios = $stmt_read->fetchAll(); 
 
?> 
<!DOCTYPE html> 
<html lang="pt-br"> 
<head> 
    <meta charset="UTF-8"> 
    <title>CRUD Completo (Aulas 6, 7, 8)</title> 
    <style>          body { font-family: sans-serif; margin: 20px; }          table, th, td { border: 1px solid #CCC; border-collapse: collapse; padding: 5px; }         th { background: #EEE; } 
        .form-box { background: #F9F9F9; padding: 15px; border: 1px solid #DDD; margin-top: 
20px; } 
    </style> 
</head> 
<body> 
    <h1>Gerenciador de Usuários</h1> 
    <?php if ($mensagem) echo "<p><strong>$mensagem</strong></p>"; ?> 
 
    <div class="form-box"> 
        <h2>Criar Novo Usuário</h2> 
        <form method="POST"> 
            <label>Nome:</label> 
            <input type="text" name="criar_nome" required> 
            <label>Email:</label> 
            <input type="email" name="criar_email" required> 
            <button type="submit">Salvar</button> 
        </form> 
    </div> 
 
    <h2>Usuários Cadastrados</h2> 
    <table> 
        <thead> 
            <tr> 
                <th>ID</th> 
                <th>Nome</th> 
                <th>Email</th> 
                <th>Ações</th> </tr> 
        </thead> 
        <tbody> 
            <?php foreach ($usuarios as $user): ?> 
                <tr> 
                    <td><?= $user['id'] ?></td> 
                    <td><?= htmlspecialchars($user['nome_completo']) ?></td> 
                    <td><?= htmlspecialchars($user['email']) ?></td> 
                    <td> 
                        <a href="editar.php?id=<?= $user['id'] ?>">Editar</a> 
                        <a href="excluir.php?id=<?= $user['id'] ?>" onclick="return confirm('Tem certeza?')">Excluir</a> 
                    </td> 
                </tr> 
            <?php endforeach; ?> 
        </tbody> 
    </table> 
</body> 
</html> 
