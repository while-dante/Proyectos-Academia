<?php

$servidor = "172.18.0.2";
$usuario = "root";

$name = $_GET["name"];
$age = $_GET["age"];

if (strlen($name) > 0 and $age > 0){
    $conexion = mysqli_connect( $servidor, $usuario,"123","curso_udemy") or die ("No se ha podido conectar al servidor de Base de datos");
    $sql = "INSERT INTO people (name,age) VALUES ('".$name."','".$age."')";
    if (mysqli_query($conexion,$sql)){
        header("Location: index.php?succes=1");
    }else{
        echo "Erro: " . $sql . "<br>" . mysqli_error($conexion);
    }
    mysqli_close($conexion);

}else{
    echo "Es incorrecto";
}


?>