<html>
<head>
    <title>Curso - Datos de Personas </title>
</head>
<body>

    <?php
        if (isset($_GET["succes"]) and $_GET["succes"] == 1){
            echo "<p style: 'color: green; text-align: center;'> La persona se agrego correctamente.";
        } 
    ?>
    <form name="capturarDatos" method="GET" action="capturar.php">
        <div>
            <input type="text" name="name" placeholder="Escribí tu nombre" \>
        </div>
        <div>
            <input type="text" name="age" placeholder="Escribí tu edad" \>
        </div>
        <div>
            <input type="submit" value="Enviar formulario" \>
        </div>
    </form>

    <hr/>
    
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

</body>
</html> 