<?php

session_start();

$title = $_GET["title"];

unset($_SESSION["tasks"][$title]);

echo "<h4>Task deleted.</h4>";
echo "<a href='http://localhost:8080/'>Return to list.</a>";