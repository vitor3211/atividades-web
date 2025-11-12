<?php
    // PARTE 1: LÓGICA DE PROCESSAMENTO DO FORMULÁRIO
    $nome_salvo = "";
    $cor_salva = '#FFFFFF'; // cor padrão: branco

    //1. Verifica se o formulário foi enviado (se o método foi POST)
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        //2. Verifica se os campos 'nome' e 'cor'  foram enviados
        if(isset($_POST['nome']) && isset($_POST['cor'])) {
            
            //3. Pega os valores do formulário
            $nome = $_POST['nome'];
            $cor = $_POST['cor'];

            //4. Define os cookies
            //time() + 3600 * 24 * 30 = expira em 30 dias;
            setcookie('nome_usuario', $nome, time() + (3600 * 24 * 30), "/");
            setcookie('cor_favorita', $cor, time() + (3600 * 24 * 30), "/");

            //5. Redireciona para a própria página para evitar reenvio do formulário
            header('Location:index.php');
            exit;
        }
    }
    // PARTE2: Lógica da leitura dos cookies
    // 6. Verifica se os cookies já existem
    if(isset($_COOKIE['nome_usuario']) && isset($_COOKIE['cor_favorita'])){
        $nome_salvo = $_COOKIE['nome_usuario'];
        $cor_salva = $_COOKIE['cor_favorita'];
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Aula2 - Cookies</title>
        <style>
            body {
                font-family: sans-serif;
                margin: 20px;
                /* 7. O PHP define o estile automaticamente!*/
                background-color: <?php echo htmlspecialchars($cor_salva); ?>
            }
            form {background-color: #FFF; padding: 15px; border-radius: 5px;}
        </style>
    </head>
    <body>
        <h1>Personalizador  de Site com Cookies &#x1F36A;</h1>
        <?php
            //8. Exibe a saudação se o cookie de nome existir
            if($nome_salvo != "") {
                echo "<p> Olá <strong>".htmlspecialchars($nome_salvo)."</strong>! Está é a sua cor favorita</p>";
            }
            else {
                echo "<p> Por favor, nos diga o seu nome e a sua cor favorita</p>";
            }
        ?>

        <form action="index.php" method="POST">
            <label for="nome"> Seu nome: </label>
            <input type="text" name="nome" required>
            <br><br>
            <label for="cor">Sua cor favorita: </label>
            <input type="color" name="cor" value="#CCCCCC">
            <br><br>
            <button type="submit">Salvar preferências</button>
        </form>
    </body>
</html>
