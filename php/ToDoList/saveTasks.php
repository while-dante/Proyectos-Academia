<?php

session_start();

$_SESSION["tasks"][$_POST["title"]] = $_POST["description"];

?>

<html>
<body>

<a href="http://localhost:8080/createTasks.html">Create another task.</a><br>
<a href="http://localhost:8080/">Return to list.</a>

</body>
</html>
