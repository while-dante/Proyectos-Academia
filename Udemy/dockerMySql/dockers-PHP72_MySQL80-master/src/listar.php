<?php
$servidor = "172.18.0.2";
$usuario = "root";
$conexion = mysqli_connect( $servidor, $usuario,"123","curso_udemy") or die ("No se ha podido conectar al servidor de Base de datos");

$consulta = "SELECT name, age FROM people";

if ($resultado = $conexion->query($consulta)){
    while ($fila = $resultado->fetch_row()){
        echo "Nombre: " . $fila[0] . " -- Edad: " . $fila[1] . "<br/>"; 
    }
    $resultado->close();
}
?>  