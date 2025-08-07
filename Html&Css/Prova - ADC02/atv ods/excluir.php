<?php

$codigo = $_POST['txtcodigo'];

$conexao = mysqli_connect ('localhost', 'root', 'root', 'prova');

$excluir = "delete from clientes where codigo = $codigo";

mysqli_query($conexao, $excluir);
require('formulario_consulta.php');

?>