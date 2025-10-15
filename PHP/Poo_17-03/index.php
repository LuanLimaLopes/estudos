<!doctype html>
<html>
    <meta charset="UTF-8">
    <title>Página WEB php.</title>
<head>

</head>
<body>

<?php
require_once'../Poo_caneta/POO.php'; //instanciar um objeto a partir da classe

$c1 = new caneta; //instaciar <--

$c1->cor = "Preto";  //não usar $ ao alterar atributos
$c1->marca = "bic";
$c1->ponta = "0.5";
$c1->$tampada();

print_r($c1);  //exibir os atributos do objeto c1
echo("<br>");

$c1->rabiscar();   //Chamar função

$c2 = new caneta; //criando novo objeto
echo("<br>");

$c2->cor = "vermelho";
$c2->ponta = "0.9";
$c2->marca = "corinthians";
$c2->modelo = "garro la ocho";
$c2->destampar();

//print_r($c2);  //mostrar o status atual do objeto.

?>

</body>
</html>