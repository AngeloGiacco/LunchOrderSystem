<?php
header('location: index.php');
array_map("htmlspecialchars", $_POST);
include_once("connection.php");
print_r($_POST);
try{
	$stmt = $conn->prepare("INSERT INTO pupils (StudentID,Surname,Forename,House,email,password)VALUES (null,:surname,:forename,:house,:email,:password)");
	$stmt->bindParam(':forename', $_POST["forename"]);
	$stmt->bindParam(':surname', $_POST["surname"]);
	$stmt->bindParam(':house', $_POST["house"]);
	$stmt->bindParam(':email', $_POST["email"]);
	$stmt->bindParam(':password', $_POST["psw"]);
	$stmt->execute();
	$conn=null;
}
catch(PDOException $e)
	{
		echo "error".$e->getMessage();
	}
?>

