<?php
$nome = $_POST['txtnome'];
$email = $_POST['txtemail'];

$conexao = mysqli_connect ('localhost', 'root', 'root', 'prova');

$insere = "insert into clientes (nome, email) values ('$nome', '$email')";

mysqli_query($conexao, $insere);
require('formulario_cadastro.php');

?>
