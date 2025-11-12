<?php
    //1. Inicia a sessão para poder gerenciá-la
    session_start();

    //2. Destrói todos os dados da sessão
    session_destroy();

    //3. Redireciona o usuário de volta para a loja
    header('Location: index.php');
    exit;
?>
