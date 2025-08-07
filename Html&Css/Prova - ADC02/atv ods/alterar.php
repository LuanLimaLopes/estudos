<?php

$codigo = $_POST['txtcodigo'];
$nome = $_POST['txtnome'];
$email = $_POST['txtemail'];

$conexao = mysqli_connect ('localhost', 'root', 'root', 'prova');

$alterar = "update clientes set nome = '$nome' email = '$nome' where codigo =  '$codigo' ";

mysqli_query($conexao, $alterar);
require('formulario_consulta.php');

?>
