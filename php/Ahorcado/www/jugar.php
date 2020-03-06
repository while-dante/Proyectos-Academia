<?php
include_once("Ahorcado.php");

session_start();

if (empty($_SESSION["letras"])){
    $_SESSION["letras"] = array();
}

$_SESSION["letras"][] = $_GET["letra"];

$ahorcado = new Ahorcado($_SESSION["palabra"],$_SESSION["vidas"]);

foreach($_SESSION["letras"] as $posicion => $letra){
    $ahorcado->jugar($letra);
}

echo "<pre>";

echo $ahorcado->mostrar()."\n\n";
echo "Vidas: ".$ahorcado->vidasRestantes()."\n\n";
echo "Incorrectas: ".$ahorcado->letrasJugadas()."\n";

if ($ahorcado->gane()){
    echo "<br><h2>GANASTE</h2>";
    echo "<br><img src='libre.jpg' alt='como el sol cuando amanece'>";
}

if ($ahorcado->perdi()){
    echo "<br><h2>PERDISTE</h2><br>";
    echo "<img src='ahorcado.jpg' alt='re sad man' height='500' width='500'>";
}

?>

<html>

<body>

<a href="http://localhost:8080/jugar.php?letra=a">a</a><a href="http://localhost:8080/jugar.php?letra=b">b</a><a href="http://localhost:8080/jugar.php?letra=c">c</a><a href="http://localhost:8080/jugar.php?letra=d">d</a><a href="http://localhost:8080/jugar.php?letra=e">e</a><a href="http://localhost:8080/jugar.php?letra=f">f</a><a href="http://localhost:8080/jugar.php?letra=g">g</a><a href="http://localhost:8080/jugar.php?letra=h">h</a><a href="http://localhost:8080/jugar.php?letra=i">i</a><a href="http://localhost:8080/jugar.php?letra=j">j</a><a href="http://localhost:8080/jugar.php?letra=k">k</a>
<a href="http://localhost:8080/jugar.php?letra=l">l</a><a href="http://localhost:8080/jugar.php?letra=m">m</a><a href="http://localhost:8080/jugar.php?letra=n">n</a><a href="http://localhost:8080/jugar.php?letra=o">o</a><a href="http://localhost:8080/jugar.php?letra=p">p</a><a href="http://localhost:8080/jugar.php?letra=q">q</a><a href="http://localhost:8080/jugar.php?letra=r">r</a><a href="http://localhost:8080/jugar.php?letra=s">s</a><a href="http://localhost:8080/jugar.php?letra=t">t</a><a href="http://localhost:8080/jugar.php?letra=u">u</a><a href="http://localhost:8080/jugar.php?letra=v">v</a><a href="http://localhost:8080/jugar.php?letra=w">w</a><a href="http://localhost:8080/jugar.php?letra=x">x</a><a href="http://localhost:8080/jugar.php?letra=y">y</a><a href="http://localhost:8080/jugar.php?letra=z">z</a>

</body>

</html>