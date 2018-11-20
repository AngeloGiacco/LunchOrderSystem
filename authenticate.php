<?php
array_map("htmlspecialchars", $_POST);
include_once("connection.php");
try {
  if ($_POST["uname"] == "admin" and $_POST["psw"] == "nimda") {// if user login information correct
    header("location: updateOptions.php");
    exit();
  } else {
    $stmt = $conn->prepare("SELECT password FROM pupils WHERE email = :email");
    $stmt->bindParam(':email',$_POST["email"]);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    print_r($row);
    if ($row["password"] = $_POST["psw"]) {
      header("location: order.php");
      exit();
    } else {
      header("location:index.html");
      exit();
    }
  }
}
catch(PDOException $e)
  	{
  		echo "error".$e->getMessage();
  	}
?>
