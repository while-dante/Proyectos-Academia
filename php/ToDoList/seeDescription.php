<?php

session_start();

$title = $_GET["title"];

$description = $_GET["description"];

echo "<h3>$title:<br></h3>";

echo "<p>$description</p>";

echo "<a href='http://localhost:8080/'>Return to list.</a>";

