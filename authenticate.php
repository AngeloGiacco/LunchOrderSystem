<?php
session_start();
array_map("htmlspecialchars", $_POST);
include_once("connection.php");
try {
  if ($_POST["uname"] == "admin" and $_POST["psw"] == "nimda") {// if user login information correct
    header("location: updateOptions.php");
    exit();
  } else {
    $stmt = $conn->prepare("SELECT password FROM pupils WHERE email = :email");
    $stmt->bindParam(':email',$_POST["uname"]);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row["password"] = $_POST["psw"]) {
      $_SESSION["email"] = $_POST["uname"];
      header("location: order.php");
      exit();
    } else {
      header("location:index.php");
      exit();
    }
  }
  $conn=null;
}
catch(PDOException $e)
  	{
  		echo "error".$e->getMessage();
  	}
?>

