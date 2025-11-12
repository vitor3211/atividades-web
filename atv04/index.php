<?php
// --- PARTE 1: LÓGICA DE UPLOAD ---
// Define o diretório para onde os arquivos serão movidos
$diretorio_uploads = "uploads/";
$mensagem = ""; // Para guardar o status do upload
// 1. Verifica se o formulário foi enviado (método POST)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
// 2. Verifica se um arquivo foi realmente enviado e se não houve erro
if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
// 3. Pega o nome temporário do arquivo no servidor
$arquivo_tmp = $_FILES['foto']['tmp_name'];
// 4. Pega o nome original do arquivo
// basename() é uma segurança para evitar nomes de arquivo maliciosos
$nome_arquivo = basename($_FILES['foto']['name']);
// 5. Define o caminho completo de destino
$caminho_destino = $diretorio_uploads . $nome_arquivo;
// 6. Tenta mover o arquivo do local temporário para o destino
if (move_uploaded_file($arquivo_tmp, $caminho_destino)) {
$mensagem = "Arquivo enviado com sucesso!";
} else {
$mensagem = "Erro ao mover o arquivo.";
}
} else {
$mensagem = "Erro no upload ou nenhum arquivo selecionado.";
}
}
// --- PARTE 2: LÓGICA DE EXIBIÇÃO DA GALERIA ---
// 7. Lê todos os arquivos da pasta 'uploads'
// glob() é uma função que busca arquivos que batem com um padrão
$imagens = glob($diretorio_uploads . "*.{jpg,jpeg,png,gif}", GLOB_BRACE);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Aula 4 - Mini Galeria</title>
<style>
body { font-family: sans-serif; margin: 20px; }
h1, h2 { color: #333; }
/* Estilo da galeria */
.galeria { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 20px; }
.galeria img { width: 200px; height: 150px; object-fit: cover; border: 2px solid #CCC; }
</style>
</head>
<body>
<h1>🖼 Mini Galeria de Imagens</h1>
<form action="index.php" method="POST" enctype="multipart/form-data">
<label for="foto">Escolha uma imagem:</label>
<input type="file" id="foto" name="foto" accept="image/*" required>
<button type="submit">Enviar Imagem</button>
</form>
<?php if ($mensagem != ""): ?>
<p><strong><?php echo $mensagem; ?></strong></p>
<?php endif; ?>
<hr>
<h2>Imagens Enviadas</h2>
<div class="galeria">
<?php
if (empty($imagens)) {
echo "<p>Nenhuma imagem foi enviada ainda.</p>";
} else {
foreach ($imagens as $img) {
// Exibe a tag <img> com o caminho da imagem
echo "<img src='" . htmlspecialchars($img) . "' alt='Imagem da galeria'>";
}
}
?>
</div>
</body>
</html>
