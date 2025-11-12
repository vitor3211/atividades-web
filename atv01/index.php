<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aula 1 - Gerador de Tabuada </title>
    <style>
        body {font-family: san-serif; margin-left:20px;}
        h1 {color: : #004499;}
        h2 {color: #333;}
    </style>
</head>
<body>
    <h1>Meu Gerador de Tabuada - Multiplicação</h1>
    <?php
        require_once 'funcoes.php';
        $j = 1;
        while ($j <= 10) {
            echo "<h2>Tabuada do número: $j</h2>";
            for ($i = 1; $i <= 10; $i++) {
                $minha_tabuada = gerarTabuada($j);
            }
            echo $minha_tabuada; 
            $j++;
        }
    ?>
</body>
</html>
