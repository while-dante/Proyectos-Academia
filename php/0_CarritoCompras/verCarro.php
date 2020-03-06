<?php

session_start();

require_once("./productos.php");

?>

<html>

<head><title>Carrito-Chan uwu</title></head>

<body>

<p>
<a href=./logout.php>Cerrar Sesion.</a><br><br>
<a href=./listaProductos.php>Seguir Comprando.</a>
</p>

<h2>Su Carro</h2>

<ul>
<?php

$total = 0;
foreach ($productos as $id => $producto){
    
    $productoEsta = False;
    $cantidad = 0;

    foreach ($_SESSION["carro"] as $idProducto){

        if($idProducto == $id){
            $productoEsta = True;
            $cantidad += 1;
        }
    }

    if ($productoEsta === True){
        echo "<li>Articulo: ".$producto["nombre"]."<br>";
        echo "<ul>
        <li>Cantidad: $cantidad</li>\n
        <li>Total: $".$producto["precio"]*$cantidad."</li><br>
        <li><a href=./carroSacar.php?idProducto=$id>Sacar del carro</a></li><br>
        </ul></li>";
        $total += $producto["precio"]*$cantidad;
    }
}

if($total>0){
    echo "<h3>Total: $$total</h3>";
}else{
    echo "<h3>No hay pructos en el carro.</h3>";
}

?>
</ul>

<a href=./listaProductos.php>Seguir Comprando.</a>

</body>

</html>

<?php

