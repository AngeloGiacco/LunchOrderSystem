<?php
$servername = "fdb22.awardspace.net"; //removed http://
$username="2829205_pupils";
$password = "7eDrHxZsZVSExFn";
$dbname = "2829205_pupils";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully <br>";
    }
catch(PDOException $e)
    {
    echo "Connection failed: ".$e->getMessage();
    }
?>
