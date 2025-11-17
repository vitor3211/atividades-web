<?php 
require_once 'conexao.php';

if (isset($_GET['id'])) { 
    $id = $_GET['id']; 
     
    $sql = "DELETE FROM usuarios WHERE id = ?"; 
    $stmt = $pdo->prepare($sql); 
     
    $stmt->execute([$id]); 
} 
 
?> 
