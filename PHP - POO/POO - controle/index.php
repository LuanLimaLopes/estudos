<!doctype html>
<html>

<head>
    <title>POO PHP</title>
</head>

<body>
    <h1>Projeto Controle remoto</h1>
    <pre>
    <?php

    require_once 'controle.php';

    $c = new controle(); #Instanciamento

    $c->ligar();
    $c->play();
    $c->maisVolume();
    $c->abrirMenu();

    print_r($c);

    ?>
    </pre>
</body>

</html>