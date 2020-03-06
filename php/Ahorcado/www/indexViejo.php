<?php

include_once("Ahorcado.php");

echo "<h1>Hola</h1>";

echo "<br>";
echo "<pre>";
print_r($_GET);

$ahorcado = new Ahorcado($_GET["palabra"],5);

$ahorcado->jugar($_GET["letra"]);
echo $ahorcado->mostrar();

echo "<pre>";