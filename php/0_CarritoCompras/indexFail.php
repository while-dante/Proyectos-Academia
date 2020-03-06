<?php

session_start();

if ($_SESSION["log"] === True){
    header("Location: ./listaProductos.php");
}

?>

<html>

<head><title>Ingresar</title></head>

<body>

<h1>Medias Punk</h1>

<form action="login.php" method="POST">
    <label>Usuario:</label><input type="text" name="usuario"><br>
    <lable>Clave:</lable><input type="password" name="clave"><br>
    <input type="submit" value="Acceder">
</form>

<h4>Usuario y/o clave invalidos, intente de nuevo.</h4>

</body>
</html>