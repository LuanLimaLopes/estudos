<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP</title>
</head>

<body>
    <pre>
        <?php

        require_once('pessoa.php');
        require_once('aluno.php');
        require_once('professor.php');
        require_once('funcionario.php');


        $p1 = new pessoa();
        $p2 = new aluno();
        $p3 = new professor();
        $p4 = new funcionario();

        $p1->fazerAniversario();

        $p1->set_nome("Taisi");
        $p2->set_nome("sofia");
        $p3->set_nome("samuel");
        $p4->set_nome("milde");

        $p1->set_genero("f");
        $p2->set_curso("ADS");
        $p3->set_salario(2500);
        $p4->set_setor("TI");


        print_r($p1);
        print_r($p2);
        print_r($p3);
        print_r($p4);
        ?>
    </pre>
</body>

</html>