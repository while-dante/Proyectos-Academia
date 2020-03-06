<?php

include "./vendor/autoload.php";

$conn = new MongoDB\Client("mongodb://localhost");

$collection = $conn->dante->usuarios;

// $collection->insertOne(
//      array("nombre" => "Marcelo",
//      "apellido" => "Agache")
// );

// $collection->updateOne(
//     array(
//         "nombre" => "Marcelo"
//     ),
//     array(
//         '$set' => array(
//             "nombre" => "Marcelito"
//         )
//     )
// );

// $collection->deleteOne(array("nombre" => "Marcelo=ito"));