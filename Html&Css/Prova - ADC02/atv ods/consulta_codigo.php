<?php

$codigo = $_POST['txtcodigo'];

$conexao = mysqli_connect ('localhost', 'root', 'root', 'prova');
$consulta = "select codigo, nome, email from clientes where codigo = '$codigo'";

$resultado = mysqli_query($conexao, $consulta);
echo"<table border = 1>";
echo"<tr><th>Código</th><th>nome</th><th>E-mail</th></tr>";

$linha = mysqli_fetch_row($resultado);
echo("<tr><td>$linha[0]</td><td>$linha[1]</td><td>$linha[2]</td></tr>");

echo"
<form action = 'excluir.php' method = 'post'>
    <tr>
        <th colspan = 3>
        <input type = 'text' name = 'txtcodigo' value = '$codigo' hidden>
        <input type = 'submit' value = 'Excluir'
            <a href = 'formulario_consulta.php'>
                <input type = 'button' value = 'Voltar'>
            </a>
        </th>
</form>
</table>";

echo"
<form action = 'formulario_alterar.php' method = 'get'>
    <tr>
        <th colspan = 3>
                <input type = 'submit' value = 'alterar'>
        </th>
</form>
</table>"


;?>
