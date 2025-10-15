<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <pre>
        <?php
        require_once('reptil.php');
        require_once('mamifero.php');

        $m = new mamifero();
        $r = new reptil();

        $m->locomover();
        $r->locomover();

        $m->emitir_som();
        $r->emitir_som();

        $m->alimentar();
        $r->alimentar();
        ?>
    </pre>
</body>

</html>