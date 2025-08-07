<!doctype html>
<html>
    <meta charset="UTF-8">
    <title>Aula 3 de POO</title>
<head>

</head>
<body>

<?php
require_once'caneta.php'; //instanciar um objeto a partir da classe

$c1 = new caneta; //instaciar <--
$c1->modelo = "XCD";
// $c1->cor = "Azul"; !erro! pq cor é privado.
// $c1->ponta = 0.8; erro pq é privado.
// $c1->marca = "bico"; erro pq é protegido.
// $c1->tampada = false;
$c1->tampar();
$c1->destampar();
echo"<p>";
print_r($c1);

?>
</body>
</html>