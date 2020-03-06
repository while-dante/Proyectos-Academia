<?php

//JUGUEMOS TATETI

require_once("Tateti.php");

$tateti = new Tateti();

while (is_null($tateti->ganoX()) and is_null($tateti->ganoO()) and is_null($tateti->empate())){
    $tateti->jugar(random_int(0,2),random_int(0,2));

    $ganoX = $tateti->ganoX();
    $ganoO = $tateti->ganoO();
    $empate = $tateti->empate();
}

print_r($tateti->mostrar());
print "$ganoX\n";
print "$ganoO\n";
print "$empate\n";