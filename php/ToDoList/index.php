<?php

session_start();

if (empty($_SESSION["tasks"])){
    $_SESSION["tasks"] = array();
}

echo "<h2>To do list:</h2>";

echo "<ul>";

foreach($_SESSION["tasks"] as $title => $description){
    echo "<li><a href=http://localhost:8080/seeDescription.php?title="
    .urlencode($title)."&&description="
    .urlencode($description).">".$title."</a> 
    <a href=http://localhost:8080/delete.php?title="
    .urlencode($title).">Delet dis</a></li>";
}

echo "</ul>";   
?>

<html>

<body>

<a href="http://localhost:8080/createTasks.html">Create Tasks</a>

</body>

</html>
