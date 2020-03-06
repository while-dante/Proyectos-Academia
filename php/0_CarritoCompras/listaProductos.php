<?php

session_start();

if ($_SESSION["log"] != True){
    header("Location: ./indexFail.php");
}

require_once("./productos.php");

?>

<html>

<head><title>Articulos</title></head>

<body>

<p><a href="./logout.php">Cerrar Sesion.</a><br><br><a href="./verCarro.php">Ver Carrito.</a></p>

<h2>Medias</h2>

<ul>
<?php
foreach($productos as $id => $producto){
    $enCarro = False;
    $cantidad = 0;

    foreach($_SESSION["carro"] as $idGuardada){

        if($idGuardada == $id){
            $enCarro = True;
            $cantidad += 1;
        }
    }

    if($enCarro){
        echo "<li>".$producto["nombre"]." $".$producto["precio"]." En carro: $cantidad</li>";
        echo "<a href=./carro.php?idProducto=$id>Agregar al carro</a><p><br></p>";

    }else{
        echo "<li>".$producto["nombre"]." $".$producto["precio"]."</li>";
        echo "<a href=./carro.php?idProducto=$id>Agregar al carro</a><p><br></p>";
    }
}

//print_r($_SESSION["carro"]);

?>
</ul>

<a href="./verCarro.php">Ver Carrito.</a>
</body>

</html>