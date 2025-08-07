<Html>
<head>
    <meta charset = "utf-8">
    <title>formulario alterar</title>
</head>

</body>
<?php

$codigo = $_POST['txtcodigo'];

$conexao = mysqli_connect ('localhost', 'root', 'root', 'prova');
$consulta = "select codigo, nome, email from clientes where codigo = '$codigo'";

$resultado = mysqli_query($conexao, $consulta);

$linha = mysqli_fetch_row($resultado);

printf("
<form name='frmAlterar' method = 'post' action = 'alterar.php'>
    <h1>Alteração de Clientes</h1>
    <p>
        <input type='text' name='txtcodigo' value='$linha[0]' hidden>
    </p>
    <p>nome:
        <input type='text' name='txtnome' value='$linha[1]'>
    </p>
    <p>email:
        <input type='text' name='txtemail' value='$linha[2]'>
    </p>
    <p> <input type='submit' name='submit' value='alterar'></p>
</form>
");
?>

</body></html>