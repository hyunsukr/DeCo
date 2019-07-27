<?php
$hostname = "localhost:3306";
$dbname = "project";

$username = "hyunsukr";
$password = "koreans1234";

$dsn = "mysql:host=$hostname;dbname=$dbname";

//Connect
try {
    $db = new PDO($dsn, $username, $password);
    //echo "<p> Connected to the database: " . $dbname . "</p>";
}
catch (PDOException $e) {
    $error_message = $e -> getMessage();
    echo "<p> An error occured while connecting to the databse: $error_message </p>";
}
catch (Exception $e) {
    $error_message = $e->getMessage();
    echo "<p>Error message: $error_message </p>";
}
?>